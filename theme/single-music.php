<?php
get_template_part('_sitehensu');
$url_share=urlencode( get_the_permalink() );
$title_share=urlencode(get_the_title()).'｜'.get_bloginfo('name');
?>

<?php get_header(); ?>
<?php get_template_part('module_pageTit'); ?>
<?php get_template_part('module_panList'); ?>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/song.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/no_git.css" type="text/css" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/cd_accordion.js"></script>

<!-- Metaデータ -->
<meta name="description" content="<?php echo "$ryakusyou"; ?>曲「<?php the_title(); ?>」の曲情報です。歌詞サイト、ニコ動へのリンク、作詞・作曲・編曲・ユニット名などを掲載しています。">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@<?php echo "$site_twitter"; ?>" />
<meta name="twitter:creator" content="@<?php echo "$creator_twitter"; ?>" />
<meta property="og:title" content="「<?php the_title(); ?>」｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo "$ryakusyou"; ?>曲「<?php the_title(); ?>」の歌詞サイト、ニコ動へのリンク、作詞・作曲・編曲・ユニット名などを掲載しています。">
<meta property="og:image" content="<?php if ( has_post_thumbnail() ) {
	$image_id = get_post_thumbnail_id ();
	$image_url = wp_get_attachment_image_src ($image_id, true);
	echo $image_url[0];
} else {
	echo get_bloginfo( 'template_directory' ) . '/images/thumbnail.png';
} ?>
">


<div class="section siteContent">
<div class="container">
<div class="row">

<div class="col-md-8 mainSection" id="main" role="main">

<!-- タイトル -->
<?php
if( apply_filters( 'is_lightning_extend_single' , false ) ):
    do_action( 'lightning_extend_single' );
else:
if (have_posts()) : while ( have_posts() ) : the_post();?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
	<?php get_template_part('module_loop_post_meta');?>
	<h1 class="entry-title"><ruby><rb><?php the_title(); ?></rb>
<rp>（</rp><rt><?php the_field('Kana',$post->ID); ?></rt><rp>）</rp></ruby></h1>
	</header>

<?php get_template_part('share'); ?>

	<div class="entry-body">
<!-- カスタムフィールド -->

<?php if(wp_is_mobile()): ?>
<!-- モバイル向けジャケット画像表示 -->
<div style="text-align:center;">
<div class="case">
      <div>
        <div class="img">
        <?php the_post_thumbnail( 'full' ); ?>
        </div>
      </div>
</div>
</div>

<br>
<?php endif; ?>

<div class="msgbox">
  <div class="msgboxtop">曲情報</div>
  <div class="msgboxbody" style="overflow:hidden;">
<table>
	<tbody>
		<tr>
			<td>ニコ動タグ</td>
			<td><a href="http://www.nicovideo.jp/tag/<?php the_field('NicoTag',$post->ID); ?>" rel="nofollow" id="button" style="display:block;padding:0px 15px;text-align:center;"><span style="line-height: 0px;"><?php the_field('NicoTag',$post->ID); ?></span></a></td>
		</tr>
		<tr>
			<td>作詞</td>
			<td><?php echo get_the_term_list( $post->ID, lyrics, '', '、', ''); ?></td>
		</tr>
		<tr>
			<td>作曲</td>
			<td><?php echo get_the_term_list( $post->ID, composer, '', '、', ''); ?></td>
		</tr>
		<tr>
			<td>編曲</td>
			<td><?php echo get_the_term_list( $post->ID, arrange, '', '、', ''); ?></td>
		</tr>
		<tr>
			<td>歌唱ユニット</td>
			<td><?php echo get_the_term_list( $post->ID, unit, '', '、', ''); ?></td>
		</tr>
		<tr>
			<td>オリジナルアーティスト</td>
			<td><?php the_field('orig-artist',$post->ID); ?></td>
		</tr>
		<tr>
			<td>関連</td>
			<td><?php echo get_the_term_list( $post->ID, music, '', '<br>', ''); ?></td>
		</tr>

	</tbody>
</table>
<p style="text-align:left;font-size: 150%;border-bottom: dotted 3px gray;">歌唱メンバー</p>
<div class="idollist">
<?php 
$taxonomy = 'idol';
if ($terms = get_the_terms($post->ID, $taxonomy)) {
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームID取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ 」の取得
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得
$CV = get_field('cv',$term_idmenu.$term_id);//声優の名前を取得
$idol_term = get_field('idol-thum',$term_idmenu.$term_id);//アイドル固有ID（画像のファイル名）を取得
$idol_color = get_field('idol_color',$term_idmenu.$term_id);//アイドルのテーマカラーを取得
$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得

//出力
echo '<div class="idol"><a href="'.$link.'"><img src="'.$upload_dir['baseurl'].'/idol/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';" title="'.$term->term_id.'"></a>';
echo "\n";
echo '<div class="info"><div class="idolname"><a href="'.$link.'">'.esc_html($term->name).'</a></div>';
echo "\n";
echo '<div class="moreinfo">CV：'.$CV.'</div></div></div>';
echo "\n";
    }
}
?>
<?php $partinfo = get_post_meta($post->ID, 'partinfo', true);?>
<?php if(!empty($partinfo)):?>
<p>この曲には、CDごとのメンバー情報があります。くわしくは<a href="#CD">CD情報</a>で確認ください。</p>
<?php endif;?>

</div>
</div>
  <div class="msgboxfoot">
  </div>
</div>
<br>

<div class="msgbox" id="link">
  <div class="msgboxtop">リンク集</div>

  <div class="msgboxbody" style="text-align: center;">
<?php if(wp_is_mobile()): //デザイン分岐のための記述
?>
<!-- モバイル向けリンク集 -->
<p style="text-align: left;font-size: 150%;border-bottom: dotted 3px gray;">Twitterでさがす</p>
<a href="https://twitter.com/search?vertical=default&amp;q=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:100%;">話題のツイート</a>
<a href="https://twitter.com/search?f=tweets&amp;vertical=default&amp;q=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:100%;">リアルタイム検索</a>
<a href="https://twitter.com/search?f=videos&amp;vertical=default&amp;q=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:45%;">動画検索</a>
<a href="https://twitter.com/search?f=images&amp;vertical=default&amp;q=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:45%;">画像検索</a>

<p style="text-align: left;font-size: 150%;border-bottom: dotted 3px gray;">ニコニコでさがす</p>
<a href="http://www.nicovideo.jp/search/<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:45%;">ワード検索</a>
<a href="http://www.nicovideo.jp/tag/<?php the_field('NicoTag',$post->ID); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:45%;">タグ検索</a>
<a href="http://dic.nicovideo.jp/a/<?php the_field('NicoTag',$post->ID); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:45%;">大百科</a>
<a href="http://www.nicovideo.jp/tag/<?php the_field('NicoTag',$post->ID); ?> <?php echo "$MV_Tag"; ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:45%;">MV検索</a>
<a href="http://www.nicovideo.jp/tag/<?php the_field('NicoTag',$post->ID); ?> アイマスRemix" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:100%;">Remix検索</a>

<p style="text-align: left;font-size: 150%;border-bottom: dotted 3px gray;">その他のサイトでさがす</p>
<a href="https://www.google.co.jp/search?q=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:45%;">Google検索</a>
<a href="https://www.pixiv.net/search.php?s_mode=s_tc&amp;word=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:45%;">Pixiv検索</a>
<a href="https://www.youtube.com/results?search_query=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:100%;">Youtube検索</a>

<p style="text-align: left;font-size: 150%;border-bottom: dotted 3px gray;">歌詞をみる</p>
<?php $ctm = get_post_meta($post->ID, 'kasi', true);?>
<?php if(!empty($ctm)):?>
<p><a href="<?php the_field('kasi',$post->ID); ?>" rel="nofollow" id="button">歌詞サイトでFULL歌詞を見る</a></p>
<?php endif;?>
<?php if(empty($ctm)):?>
<p>この曲はFULL歌詞リンクに対応していません。<br>必要であればボタンからGoogle検索を行ってください<br>
<a href="https://www.google.co.jp/search?q=<?php wp_title( '' ); ?> 歌詞" rel="nofollow" id="button">Google検索で歌詞を検索する</a></p>
<?php endif;?>

<?php endif; ?>
<?php if(!wp_is_mobile()): ?>
<!-- PC向けリンク集 -->
<p style="text-align: left;font-size: 150%;border-bottom: dotted 3px gray;">Twitterでさがす</p>
<a href="https://twitter.com/search?vertical=default&amp;q=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:23%;">話題のツイート</a>
<a href="https://twitter.com/search?f=tweets&amp;vertical=default&amp;&q=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:23%;">リアルタイム検索</a>
<a href="https://twitter.com/search?f=videos&amp;vertical=default&amp;q=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:23%;">動画検索</a>
<a href="https://twitter.com/search?f=images&amp;vertical=default&amp;q=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:23%;">画像検索</a>

<p style="text-align: left;font-size: 150%;border-bottom: dotted 3px gray;">ニコニコでさがす</p>
<a href="http://www.nicovideo.jp/search/<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:18%;">ワード検索</a>
<a href="http://www.nicovideo.jp/tag/<?php the_field('NicoTag',$post->ID); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:18%;">タグ検索</a>
<a href="http://dic.nicovideo.jp/a/<?php the_field('NicoTag',$post->ID); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:18%;">大百科</a>

<a href="http://www.nicovideo.jp/tag/<?php the_field('NicoTag',$post->ID); ?> アイマスRemix" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:18%;">Remix検索</a>
<a href="http://www.nicovideo.jp/tag/<?php the_field('NicoTag',$post->ID); ?> <?php echo "$MV_Tag"; ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:18%;">MV検索</a>

<p style="text-align: left;font-size: 150%;border-bottom: dotted 3px gray;">その他のサイトからさがす</p>
<a href="https://www.google.co.jp/search?q=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:30%;">Google検索</a>
<a href="https://www.pixiv.net/search.php?s_mode=s_tc&amp;word=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:30%;">Pixiv検索</a>
<a href="https://www.youtube.com/results?search_query=<?php wp_title( '' ); ?>" rel="nofollow" id="button" style="text-align:center;display:inline-block;width:30%;">Youtube検索</a>


<p style="text-align: left;font-size: 150%;border-bottom: dotted 3px gray;">歌詞をみる</p>
<?php $kasi_umu = get_post_meta($post->ID, 'kasi', true);?>
<?php if(!empty($kasi_umu)):?>
<p><a href="<?php the_field('kasi',$post->ID); ?>" rel="nofollow" id="button">歌詞サイトでFULL歌詞を見る</a></p>
<?php endif;?>
<?php if(empty($kasi_umu)):?>
<p>この曲は歌詞サイトへのリンクが入力されていないため、リンクに対応していません。<br>必要であれば下のボタンからGoogle検索を行ってください<br>
<a href="https://www.google.co.jp/search?q=<?php wp_title( '' ); ?> 歌詞" rel="nofollow" id="button">Google検索で歌詞を検索する</a></p>
<?php endif;?>

<?php endif; ?>

  </div>
  <div class="msgboxfoot">
  </div>
</div>
<br>

<div class="msgbox" id="movie">
  <div class="msgboxtop">公式動画</div>
  <div class="msgboxbody">
<?php $movie = get_post_meta($post->ID, 'movie', true);//公式動画が入力されているか判定
?>
<?php if(!empty($movie))://動画がある場合は動画を表示
?>
<?php the_field('movie',$post->ID); ?>
<?php endif;?>
<?php if(empty($movie))://動画がない場合場合の記述　この場合は配信の埋め込みを取得。
?>
<p>この曲に動画はありません。</p><?php the_field('haishin',$post->ID); ?>
<?php endif;?>
  </div>
  <div class="msgboxfoot">
  </div>
</div>
<br>

<!-- CD情報用CSS（OSにより分岐） -->
<?php if(wp_is_mobile()): ?>
<style type="text/css">
<!-- スマホ用CSS -->
.cdname{font-size:15px;}
</style>
<?php endif; ?>

<?php if(!wp_is_mobile()): ?>
<!-- PC用CSS -->
<style type="text/css">
.cdname{font-size:20px;}
</style>
<?php endif; ?>
<!-- ここまでCD情報用CSS -->

<!-- CD情報 -->
<div class="msgbox" id="CD">
  <div class="msgboxtop">CD情報</div>
  <div class="msgboxbody">

<?php the_field('partinfo',$post->ID); //パート分け情報の出力
?>

<!-- すべて操作ボタン -->
<div class="vmenu_all_action" style="text-align: center;">
<span id="button" onclick="doReplaceClassName('vmenu_off', 'vmenu_on')" style="display:inline-block;width:45%;">CD詳細情報をすべて表示</span>
<span id="button" onclick="doReplaceClassName('vmenu_on',  'vmenu_off')" style="display:inline-block;width:45%;">CD詳細情報をすべて非表示</span>
</div>

<?php if(get_post_meta($post->ID, 'haishin', true)): ?>
<!-- 配信がある場合の情報 -->
<div class="vmenu_off">
<div class="vmenuitem" onclick="doToggleClassName(getParentObj(this),'vmenu_on','vmenu_off')">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/ipod_icon.png" class="cdicon"><div class="cdname">iTunes等の配信サイトで配信あり</div></div>
<div class="info_C"><?php the_field('haishin',$post->ID); ?></div></div><br>
<?php endif; ?>

<?php 
$taxonomy = 'disc';
if ($terms = get_the_terms($post->ID, $taxonomy)) {
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームIDを取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」にする
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得
$shop = get_field('shop',$term_idmenu.$term_id);//販売情報を取得

//繰り返しフィールド（CDごとのパート情報）を変数にセット
$cd_group = SCF::get( 'CD_group',$id );
foreach ( $cd_group as $field_name => $field_value ) {

$tax_id_temp = $field_value['cd_term'];
$idol_temp =  $field_value['cd_mem'];

${"cdidol_".$tax_id_temp."_".$id} = explode(',', $idol_temp);
}

//出力
echo '<div class="vmenu_off">';
echo '<div class="vmenuitem" onclick="doToggleClassName(getParentObj(this),\'vmenu_on\',\'vmenu_off\')"><img src="'.get_stylesheet_directory_uri().'/resources/cd_icon.png" class="cdicon"  title="'.$term->term_id.'"><div class="cdname">' . esc_html($term->name) . '</div></div>';
echo "\n";
echo '<div class="info_C"><a href="'.$link.'" id="button" style="text-align:center;display:inline-block;width:100%;">このCDのすべての収録曲を見る</a>';//リンク
echo "\n";

$kiji_id = get_the_ID();

//アイドル画像出力ループ
foreach (${"cdidol_".$term_id."_".$kiji_id} as $idol_name_roop) {

//指定したアイドルのデータを引き出す
$term = get_term_by('name',$idol_name_roop,'idol');

        // タームのURLを取得
$term_link = get_term_link( $term );
        
//必要なカスタムフィールドを取得
				$cv = get_field('cv', $term);
				$idol_term = get_field('idol-thum', $term);
				$idol_color = get_field('idol_color', $term);
        // 結果を出力
        echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$idol_term.'.png" class="idolicon_cd" style="background:'.$idol_color.';" title="'.$term->name.'(CV.'.$cv.')" alt="'.$term->name.'"></a>';

}

echo $shop;
echo '</div></div><br>';
echo "\n";

    }
}
?>

  </div>
  <div class="msgboxfoot">
  </div>
</div>
<br>

<div class="msgbox" id="live">
  <div class="msgboxtop">この曲が披露されたライブ・イベント</div>
  <div class="msgboxbody">
先頭に「★」がついているライブは、DVD・BD等の円盤メディアが発売されています。<br>
披露された会場の確認と、円盤の価格確認や購入についてはライブ名のリンク先でできます。
	  <table>
	<tbody>

<?php 
$taxonomy = 'live';
if ($terms = get_the_terms($post->ID, $taxonomy)) {
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームIDを取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」にする
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得
$live_bd = get_field('shop',$term_idmenu.$term_id);
if(empty($live_bd)) {//もしライブBDが発売されているのなら
$star = '';}else{
$star = '★';}//星を出力する

//出力
echo '<tr><td>'.$star.'</td><td><a href="'.$link.'">'.esc_html($term->name).'</a></td></tr>';
echo "\n";
    }
}
?>
			</tbody>
</table>
  </div>
  <div class="msgboxfoot">
  </div>
</div>
<br>
<!--ここまで-->
<br>
<div class="msgbox">
  <div class="msgboxtop">その他情報</div>
  <div class="msgboxbody">
	<?php the_content();//ここがWPの本文とその前後に付随するプラグインの出力先になる。
?>
  </div>
  <div class="msgboxfoot">
  </div>
</div>


	</div><!-- [ /.entry-body ] -->
	<div class="entry-footer">
	<?php
	$args = array(
		'before'           => '<nav class="page-link"><dl><dt>Pages :</dt><dd>',
		'after'            => '</dd></dl></nav>',
		'link_before'      => '<span class="page-numbers">',
		'link_after'       => '</span>',
		'echo'             => 1 );
	wp_link_pages( $args ); ?>


	<?php $tags_list = get_the_tag_list();
	if ( $tags_list ): ?>
	<div class="entry-meta-dataList entry-tag">
	<dl>
	<dt><?php _e('Tags','lightning') ;?></dt>
	<dd class="tagcloud"><?php echo $tags_list; ?></dd>
	</dl>
	</div><!-- [ /.entry-tag ] -->
	<?php endif; ?>
	</div><!-- [ /.entry-footer ] -->

	<?php comments_template( '', true ); ?>
</article>
<?php endwhile;endif;
endif;
?>


</div><!-- [ /.mainSection ] -->

<div class="col-md-3 col-md-offset-1 subSection">
<?php if(!wp_is_mobile()): //PC版ではジャケット画像をサイドバーに表示します。
?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
    <?php if (has_post_thumbnail()) : ?>
    <div class="case">
      <div>
        <div class="img">
        <?php the_post_thumbnail( 'full' ); ?>
        </div>
      </div>
    </div>
    <?php endif ; ?>
<?php endwhile; endif; ?>
<?php endif; ?>

<?php get_sidebar(get_post_type()); ?>
</div><!-- [ /.subSection ] -->

</div><!-- [ /.row ] -->
</div><!-- [ /.container ] -->
</div><!-- [ /.siteContent ] -->
<?php get_footer(); ?>
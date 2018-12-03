<?php //MVのタグを指定
if(is_singular( 'music_cg' )){ //シンデレラガールズの場合
	$MV_Tag = 'デレステMV';
	} elseif(is_singular( 'music_ml' )){ //ミリオンライブの場合
	$MV_Tag = 'ミリシタMV';
	} elseif(is_singular( 'music_shiny' )){ //シャイニーカラーズの場合
	$MV_Tag = '';
	} elseif(is_singular( 'music_as' )){ //ASの場合
	$MV_Tag = 'ミリシタMV';
	} elseif(is_singular( 'music_godo' )){ //合同の場合
	$MV_Tag = '';
	}
	
?>

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

<?php if (is_object_in_term($post->ID, 'musictype','rearrange')): //リアレンジ曲の場合、Rubyタグを使わない
?>

<span class="ruby"><?php echo get_post_meta($post->ID,'Kana',true); ?></span>
<h1><span class="entry-title"><?php the_title(); ?></span></h1>

<?php else: //リアレンジ曲以外の処理
?>
	<h1 class="entry-title"><ruby><rb><?php the_title(); ?></rb>
<rp>（</rp><rt><?php echo get_post_meta($post->ID,'Kana',true); ?></rt><rp>）</rp></ruby></h1>
<?php endif; ?>

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
<?php get_template_part('parts/music_page/ad'); ?>

<?php endif; ?>

<div class="msgbox">
  <div class="msgboxtop">曲情報</div>
  <div class="msgboxbody" style="overflow:hidden;">
<table>
	<tbody>
		<tr>
			<td>ニコ動タグ</td>
			<td><a href="http://www.nicovideo.jp/tag/<?php echo get_post_meta($post->ID,'NicoTag',true); ?>" rel="nofollow" id="button" style="display:block;padding:0px 15px;text-align:center;"><span style="line-height: 0px;"><?php echo get_post_meta($post->ID,'NicoTag',true);; ?></span></a></td>
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
			<td>ユニット</td>
			<td><?php if(is_singular( 'music_shiny' )){
//シャイニーカラーズ出力用タグ
$taxonomy = 'idol_sc';
$terms = wp_get_object_terms($post->ID, $taxonomy);
if ($terms) {
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームID取得
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得

if($term->parent == 0){ //子タクソノミーがある（ユニット）のみ出力
echo '<div><a href="'.$link.'">'.esc_html($term->name).'</a></div>';
    }}}
} else { //シンデレラガールズ出力タグ
echo get_the_term_list( $post->ID, unit, '', '<br>', '');
}?></td>
		</tr>
		<tr>
			<td>オリジナル</td>
			<td><?php echo get_post_meta($post->ID,'orig-artist',true); ?></td>
		</tr>
		<tr>
			<td>関連</td>
			<td><?php echo get_the_term_list( $post->ID, music, '', '<br>', ''); ?><?php echo get_the_term_list( $post->ID, music_ml, '', '<br>', ''); ?></td>
		</tr>

	</tbody>
</table>

</div>
  <div class="msgboxfoot">
  </div>
</div>
<br>

<div class="msgbox" id="member">
  <div class="msgboxtop">メンバー情報</div>
<div class="msgboxbody">
<?php
if(is_singular( 'music' )){ //シンデレラガールズの場合
get_template_part('parts/music_page/member/cin');
get_template_part('parts/music_page/member/765');
get_template_part('parts/music_page/member/shiny');
} elseif(is_singular( 'music_shiny' )){ //シャイニーカラーズの場合
get_template_part('parts/music_page/member/shiny');
} else{ //ミリオンライブ、合同、765ASの場合
get_template_part('parts/music_page/member/765');
get_template_part('parts/music_page/member/cin');
get_template_part('parts/music_page/member/shiny');
}
?>


<?php
//繰り返しフィールド（CDごとのパート情報）を変数にセット
$cd_group = SCF::get( 'CD_group',$id );
foreach ( $cd_group as $field_name => $field_value ) {

$tax_id_temp = $field_value['cd_term'];
$idol_temp =  $field_value['cd_mem'];
${"cdidol_".$tax_id_temp."_".$id} = explode(',', $idol_temp);
}
if(!empty($idol_temp)):?>
<p>この曲には、CDごとのメンバー情報があります。くわしくは<a href="#CD">CD情報</a>で確認ください。</p>
<?php endif;?>

</div>
  <div class="msgboxfoot">
  </div>
</div>
<br>

<div class="msgbox" id="link">
  <div class="msgboxtop">リンク集</div>

  <div class="msgboxbody" style="text-align: center;">

<!-- リンク集 -->

<div class="tab_wrap">
<input id="tabni" type="radio" name="tab_btn" checked>
<input id="tabtw" type="radio" name="tab_btn">

<div class="tab_area link_label">
<span class="btn_item_5" style="border-top: medium solid thistle;border-left: medium solid thistle;padding:2px 0px 2px 2px;"><label class="tabni_label btn_item_in" for="tabni" id="button" style="border-radius:10px 0px 0px 15px;margin:0px;"><img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/nico_logo.png" width="25px"></label></span>
<span class="btn_item_5" style="border-top: medium solid thistle;border-right: medium solid thistle;padding:2px 2px 2px 0px;"><label class="tabtw_label btn_item_in" for="tabtw" id="button" style="border-radius:0px 15px 15px 0px;margin:0px;"><i class="fab fa-twitter"></i></label></span>
<span class="btn_item_5 under_line"><a href="https://www.google.co.jp/search?q=<?php the_title(); ?>" rel="nofollow"  id="button" class="btn_item_in"><i class="fab fa-google"></i></a></span>
<span class="btn_item_5 under_line"><a href="https://www.pixiv.net/search.php?s_mode=s_tc&amp;word=<?php the_title(); ?>" rel="nofollow"  id="button" class="btn_item_in"><img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/pixiv_logo.jpg" width="25px"></a></span>
<span class="btn_item_5 under_line"><a href="https://www.youtube.com/results?search_query=<?php the_title(); ?>" rel="nofollow" id="button" class="btn_item_in"><i class="fab fa-youtube"></i></a></span>
</div>


<div class="panel_area">
<div id="panelni" class="tab_panel">
<!-- niconicoのタブの中身 -->
<p class="tab_title">niconicoでさがす</p>
<div class="tab_area_long">
<?php
$NicoTag = get_post_meta($post->ID,'NicoTag',true);
if(is_singular( 'music_shiny' ) or is_singular( 'music_godo' )): //シャイニーカラーズまたは合同曲の場合
?>
<a href="http://www.nicovideo.jp/search/<?php the_title(); ?>" rel="nofollow" id="button" class="btn_item_long2">ワード</a>
<a href="http://www.nicovideo.jp/tag/<?php echo $NicoTag; ?>" rel="nofollow" id="button" class="btn_item_long2">タグ</a>
<a href="http://dic.nicovideo.jp/a/<?php echo $NicoTag; ?>" rel="nofollow" id="button" class="btn_item_long2">大百科</a>
<a href="http://www.nicovideo.jp/tag/<?php echo $NicoTag; ?> アイマスRemix" rel="nofollow" id="button" class="btn_item_long2">Remix</a>
<?php else //シンデレラガールズやミリオンライブの場合
: ?>
<a href="http://www.nicovideo.jp/search/<?php the_title(); ?>" rel="nofollow" id="button" class="btn_item_long">ワード</a>
<a href="http://www.nicovideo.jp/tag/<?php echo $NicoTag; ?>" rel="nofollow" id="button" class="btn_item_long">タグ</a>
<a href="http://dic.nicovideo.jp/a/<?php echo $NicoTag; ?>" rel="nofollow" id="button" class="btn_item_long">大百科</a>
<a href="http://www.nicovideo.jp/tag/<?php echo $NicoTag; ?> アイマスRemix" rel="nofollow" id="button" class="btn_item_long">Remix</a>
<a href="http://www.nicovideo.jp/tag/<?php echo $NicoTag; ?> <?php echo "$MV_Tag"; ?>" rel="nofollow" id="button" class="btn_item_long">MV</a>
<?php endif; ?>
</div>
</div>

<div id="paneltw" class="tab_panel">
<!-- Twitterのタブの中身 -->
<p class="tab_title">Twitterでさがす</p>
<div class="tab_area_long">
<a href="https://twitter.com/search?vertical=default&amp;q=&quot;<?php the_title(); ?>&quot;" rel="nofollow" id="button" class="btn_item_long2">人気</a>
<a href="https://twitter.com/search?f=tweets&amp;vertical=default&amp;&q=&quot;<?php the_title(); ?>&quot;" rel="nofollow" id="button"class="btn_item_long2">リアルタイム</a>
<a href="https://twitter.com/search?f=videos&amp;vertical=default&amp;q=&quot;<?php the_title(); ?>&quot;" rel="nofollow" id="button"class="btn_item_long2">動画</a>
<a href="https://twitter.com/search?f=images&amp;vertical=default&amp;q=&quot;<?php the_title(); ?>&quot;" rel="nofollow" id="button" class="btn_item_long2">画像</a>
</div>
</div>

</div>

</div>



<p class="tab_title">歌詞をみる</p>
<?php $kasi_umu = get_post_meta($post->ID, 'kasi', true);?>
<?php if(!empty($kasi_umu)):?>
<p><a href="<?php echo get_post_meta($post->ID, 'kasi', true); ?>" rel="nofollow" id="button">歌詞サイトでFULL歌詞を見る</a></p>
<?php endif;?>
<?php if(empty($kasi_umu)):?>
<p>この曲は現時点でリンクに対応していません。<br>検索すると見つかるかもです。<br>
<a href="https://www.google.co.jp/search?q=<?php the_title(); ?> 歌詞" rel="nofollow" id="button">Google検索で歌詞を検索する</a></p>
<?php endif;?>


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
<?php echo apply_filters('the_content',$movie); ?>
<?php endif;?>
<?php if(empty($movie))://動画がない場合場合の記述　この場合は配信の埋め込みを取得。
?>
<p>この曲に動画はありません。</p>
<?php echo apply_filters('the_content',get_post_meta($post->ID, 'haishin', true)); ?>
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

<?php echo apply_filters('the_content',get_post_meta($post->ID, 'partinfo', true)); //パート分け情報の出力
?>

<!-- すべて操作ボタン -->
<div class="vmenu_all_action" style="text-align: center;">
<span id="button" onclick="doReplaceClassName('vmenu_off', 'vmenu_on')" style="display:inline-block;width:45%;">詳細を全て表示</span>
<span id="button" onclick="doReplaceClassName('vmenu_on',  'vmenu_off')" style="display:inline-block;width:45%;">詳細を全て非表示</span>
</div>

<?php if(get_post_meta($post->ID, 'haishin', true)): ?>
<!-- 配信がある場合の情報 -->
<div class="vmenu_off">
<div class="vmenuitem" onclick="doToggleClassName(getParentObj(this),'vmenu_on','vmenu_off')">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/ipod_icon.png" class="cdicon"><div class="cdname">iTunes等の配信サイトで配信あり</div></div>
<div class="info_C">
<?php $kiji_id = get_the_ID();
$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得

//アイドル画像出力ループ
foreach (${"cdidol_h_".$kiji_id} as $idol_name_roop) {

if(get_term_by('name',$idol_name_roop,'idol_cg')){ //シンデレラガールズにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_cg');
$thum_dir = 'cinderella';
} elseif (get_term_by('name',$idol_name_roop,'idol_765')){ //ミリオンライブにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_765');
$thum_dir = 'millionlive';
} elseif (get_term_by('name',$idol_name_roop,'idol_283')){ //シャイニーカラーズにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_283');
$thum_dir = 'shinycolors';
} else {
}
        // タームのURLを取得
$term_link = get_term_link( $term );
        
//必要なカスタムフィールドを取得
				$cv = get_field('cv', $term);
				$idol_term = get_field('idol-thum', $term);
				$idol_color = get_field('idol_color', $term);
        // 結果を出力
        echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$thum_dir.'/'.$idol_term.'.png" class="idolicon_cd" style="background:'.$idol_color.';" title="'.$term->name.'(CV.'.$cv.')" alt="'.$term->name.'"></a>';

}
?>
<?php echo apply_filters('the_content',get_post_meta($post->ID, 'haishin', true)); ?></div></div><br>
<?php endif; ?>

<?php 
$taxonomy = 'disc';
if ($terms = get_the_terms($post->ID, $taxonomy)) {
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームIDを取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」にする
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得
$shop = get_field('shop',$term_idmenu.$term_id);//販売情報を取得


//出力
echo '<div class="vmenu_off">';
echo '<div class="vmenuitem" onclick="doToggleClassName(getParentObj(this),\'vmenu_on\',\'vmenu_off\')"><img src="'.get_stylesheet_directory_uri().'/resources/cd_icon.png" class="cdicon"  title="'.$term->term_id.'"><div class="cdname">' . esc_html($term->name) . '</div></div>';
echo "\n";
echo '<div class="info_C"><a href="'.$link.'" id="button" style="text-align:center;display:inline-block;width:100%;">このCDのすべての収録曲を見る</a>';//リンク
echo "\n";

//アイドル画像出力ループ
foreach (${"cdidol_".$term_id."_".$kiji_id} as $idol_name_roop) {

if(get_term_by('name',$idol_name_roop,'idol_cg')){ //シンデレラガールズにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_cg');
$thum_dir = 'cinderella';
} elseif (get_term_by('name',$idol_name_roop,'idol_765')){ //ミリオンライブにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_765');
$thum_dir = 'millionlive';
} elseif (get_term_by('name',$idol_name_roop,'idol_283')){ //シャイニーカラーズにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_283');
$thum_dir = 'shinycolors';
} else {
}

        // タームのURLを取得
$term_link = get_term_link( $term );
        
//必要なカスタムフィールドを取得
				$cv = get_field('cv', $term);
				$idol_term = get_field('idol-thum', $term);
				$idol_color = get_field('idol_color', $term);
        // 結果を出力
        echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$thum_dir.'/'.$idol_term.'.png" class="idolicon_cd" style="background:'.$idol_color.';" title="'.$term->name.'(CV.'.$cv.')" alt="'.$term->name.'"></a>';

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
先頭に「<i class="fas fa-compact-disc"></i>」がついているライブは、DVD・BD等の円盤メディアが発売されています。<br>
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
$place = get_field('place',$term_idmenu.$term_id);

if(empty($live_bd)) {//もしライブBDが発売されているのなら
$star = '';//一旦空にしないと前のループを引きずるので必要
} else {
$star = '<i class="fas fa-compact-disc"></i>';}//ディスクアイコンを出力する

//出力
echo '<tr><td>'.$star.'</td><td><a href="'.$link.'" title="'.$place.'">'.esc_html($term->name).'</a></td></tr>';
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
<?php related_posts(); ?>
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
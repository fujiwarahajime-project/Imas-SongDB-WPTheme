<?php
//環境変数類
if(is_singular( 'music_remix' )){ //リミックス曲の場合
	//リミックス曲の原曲データを取得
		foreach (get_the_terms($post->ID, 'music') as $term){
			$remix_id = $term->name;
		}
}

$kiji_id = get_the_ID();
if(empty($remix_id)){
	$remix_id = $kiji_id;
}
$idollist_type = get_post_type($remix_id);

//リミックスの場合データを上書き
if(is_singular( 'music_remix' )){
	$ryakusyou = 'リミックス';
}else{
	$ryakusyou = "アイドルマスター";
}
$site_twitter = 'fujiwarahaji_me';//＠をはぶくこと
$creator_twitter = 'fujiwarahaji_me';//＠をはぶくこと

$url_share=urlencode( get_the_permalink() );
$title_share=urlencode(get_the_title()).'｜'.get_bloginfo('name');

$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得

?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/no_git.css" type="text/css" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/cd_accordion.js"></script>

<!-- Metaデータ -->
<meta name="description" content="<?php echo "$ryakusyou"; ?>曲「<?php the_title(); ?>」の曲情報です。">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@<?php echo "$site_twitter"; ?>" />
<meta name="twitter:creator" content="@<?php echo "$creator_twitter"; ?>" />
<meta property="og:title" content="「<?php the_title(); ?>」｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo "$ryakusyou"; ?>曲「<?php the_title(); ?>」の曲情報を掲載しています。">
<meta property="og:image" content="<?php if ( has_post_thumbnail() ) {
	$image_id = get_post_thumbnail_id ();
	$image_url = wp_get_attachment_image_src ($image_id, true);
	//echo $image_url[0];
	echo get_stylesheet_directory_uri().'/resources/default.png';

} else {
	//echo get_bloginfo( 'template_directory' ) . '/images/thumbnail.png';
	echo get_stylesheet_directory_uri().'/resources/default.png';

} ?>
">
<meta property="thumbnail" content="<?php if ( has_post_thumbnail() ) {
	$image_id = get_post_thumbnail_id ();
	$image_url = wp_get_attachment_image_src ($image_id, true);
	//echo $image_url[0];
	echo get_stylesheet_directory_uri().'/resources/default.png';

} else {
	echo get_stylesheet_directory_uri().'/resources/default.png';
} ?>
">


	<header>

<!-- タイトル -->

<?php if (is_object_in_term($post->ID, 'musictype','rearrange') OR is_singular( 'music_remix' ) ){
	//リアレンジ曲の場合ふりがななしのタイトルにする
	echo '<h1><span class="entry-title">'.get_the_title().'</span></h1>';

}elseif(strlen(get_the_title()) > 40){
	//タイトルが長い楽曲（スポ食など）の場合、Rubyタグを使わない
	echo '<span class="ruby">'.get_post_meta($post->ID,'Kana',true).'</span>
	<h1><span class="entry-title">'.get_the_title().'</span></h1>';

}else{

	echo '<h1 class="entry-title"><ruby><rb>'.get_the_title().'</rb>
	<rp>（</rp><rt>'.get_post_meta($post->ID,'Kana',true).'</rt><rp>）</rp></ruby></h1>';
}
?>
	</header>

<?php get_template_part('parts/share'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-body">

<?php if(wp_is_mobile()): ?>

<?php 
	//get_template_part( 'parts/music_page/jacket' );
	get_template_part('parts/music_page/ad'); ?>
<?php endif; //モバイル表示閉じ ?>


<!-- 曲情報 -->
<div class="msgbox">
  <div class="msgboxtop">曲情報</div>
  <div class="msgboxbody" style="overflow:hidden;">
<table class="songinfo">
	<tbody>
		<tr>
			<td>作詞</td>
			<td><?php echo get_the_term_list( $remix_id, 'lyrics', '', '、', ''); ?></td>
		</tr>
		<tr>
			<td>作曲</td>
			<td><?php echo get_the_term_list( $remix_id, 'composer', '', '、', ''); ?></td>
		</tr>
		<tr>
			<td><?php if(is_singular( 'music_remix' )){
				echo 'アレンジ';
			}else{
				echo '編曲';
			}?></td>
			<td><?php echo get_the_term_list( $post->ID, 'arrange', '', '、', ''); ?></td>
		</tr>
		<tr>
			<td>ユニット</td>
			<td><?php echo get_the_term_list( $post->ID, 'unit', '', '<br>', '');?></td>
		</tr>
		<tr>
			<td>オリジナル</td>
			<td><?php echo get_post_meta($post->ID,'orig-artist',true); ?></td>
		</tr>
		<tr>
			<td><?php if(is_singular( 'music_remix' )){
				echo 'アレンジ元</td><td>
				<a href="'.get_permalink( $remix_id ).'">'.get_the_title( $remix_id ).'</a>';
			}else{
				echo 'リアレンジ楽曲</td><td>';
					foreach(get_posts(array(
						'posts_per_page' => 1000,
						'orderby' => 'date',
						'order' => 'DESC',
						'post_type'  => allsongtype(),
						'tax_query' => array(array(
							'taxonomy' => 'music',
							'field' => 'name',
							'terms' => $post->ID,
							'operator' => 'IN'
						))
						))as $post_remix){
							echo '<div><a href="'.get_permalink($post_remix).'">'.$post_remix->post_title.'</a></div>';
						}
			}?></td>
		</tr>

	</tbody>
</table>


<?php
if(!empty(get_post_meta($post->ID, 'kasi', true))){
	echo '<a href="'.get_post_meta($post->ID, 'kasi', true).'" rel="nofollow" class="button">歌詞サイトで歌詞を見る</a>';
}
?>

</div>
  <div class="msgboxfoot">
  </div>
</div>

<div class="msgbox" id="member">
  <div class="msgboxtop">メンバー情報</div>
<div class="msgboxbody">
<?php

//メンバー情報を格納
$solo_temp[] = "";
if ($terms = get_the_terms($post->ID, 'disc')) {
	foreach ( $terms as $term ) {
		$cd_data = cd_member($post->ID,$term->term_id);
		if(is_array($cd_data)){
			$solo_temp = array_merge($solo_temp , $cd_data);
		}
	}
}

$solo_temp = array_unique($solo_temp);
set_query_var('solo_temp',$solo_temp);
//var_dump($solo_temp);
//CD表示用の配列をつくる
//set_query_var("cdidol_".$term->term_id,$solo_temp);

//アイドル表示の順番を指定

if($idollist_type == 'music_cg' ){ //シンデレラガールズの場合
	get_template_part('parts/music_page/member/cin');
	get_template_part('parts/music_page/member/765');
	get_template_part('parts/music_page/member/shiny');
	get_template_part('parts/music_page/member/sidem');
} elseif($idollist_type == 'music_shiny' ){ //シャイニーカラーズの場合
	get_template_part('parts/music_page/member/shiny');
	get_template_part('parts/music_page/member/765');
	get_template_part('parts/music_page/member/cin');
	get_template_part('parts/music_page/member/sidem');
} elseif($idollist_type == 'music_sidem' ){ //SideMの場合
	get_template_part('parts/music_page/member/sidem');
	get_template_part('parts/music_page/member/765');
	get_template_part('parts/music_page/member/cin');
	get_template_part('parts/music_page/member/shiny');
} else{ //ミリオンライブ、合同、765ASの場合
	get_template_part('parts/music_page/member/765');
	get_template_part('parts/music_page/member/cin');
	get_template_part('parts/music_page/member/shiny');
}
	//CVはいつも最後に来る
	get_template_part('parts/music_page/member/cv');

?>

<?php
if(!empty($solo_temp)):?>
<p>この曲には、CDごとのメンバー情報があります。くわしくは<a href="#CD">CD情報</a>で確認ください。</p>
<?php endif;?>

</div>
  <div class="msgboxfoot">
  </div>
</div>


<!-- CD情報用CSS（OSにより分岐） -->
<?php if(wp_is_mobile()): ?>
<!-- スマホ用CSS -->
<style type="text/css">
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

<?php 
	get_template_part('parts/music_page/movie');
	get_template_part('parts/music_page/cdlist');
	get_template_part('parts/music_page/livelist');
?>


<!--ここまで-->
<div class="msgbox">
  <div class="msgboxtop">その他情報</div>
  <div class="msgboxbody">
	<?php the_content();//ここがWPの本文とその前後に付随するプラグインの出力先になる。
	get_template_part( 'template-parts/post/next-prev', get_post_type() );
?>
<?php
yarpp_related(array(
	// 関連記事を表示する最大件数
    'limit'    => 5, 
    // ソート順を指定。 ソート順の対象と昇降順（ASCかDESC）を指定
    'order'    => 'score DESC',
    // 使用するテンプレートの名前を指定
    //'template' => 'yarpp-template.php',
		));
?>
  </div>
  <div class="msgboxfoot">
  </div>
</div>


</div>



<!-- サブスク再生 -->
<?php
if(subscription_play_data($kiji_id,'')){
	$subscription = subscription_play_data($kiji_id,'');
	echo '<!-- モーダル -->
	<a type="button" class="subscription_button" data-bs-toggle="modal" data-bs-target="#subscription_modal">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
			<path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
  		</svg>
	</a>
	
	<!-- ウィンドウの中身 -->
	<div class="modal fade" id="subscription_modal" tabindex="-1" aria-labelledby="subscription_modal_label" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="subscription_modal_label">Youtube Musicで再生</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">';
		  if(!empty($subscription['ytid'])){
			echo do_shortcode( '[arve url="https://www.youtube.com/watch?v='.$subscription['ytid'].'"]' );
		  }
		  
		  echo '</div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	';
	
}
?>
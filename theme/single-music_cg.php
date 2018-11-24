<?php
if(is_singular( 'music_cg' )){ //シンデレラガールズの場合
get_template_part('sitehensu/cinderella');
} elseif(is_singular( 'music_ml' )){ //ミリオンライブの場合
get_template_part('sitehensu/millionlive');
} elseif(is_singular( 'music_shiny' )){ //シャイニーカラーズの場合
get_template_part('sitehensu/shiny');
} elseif(is_singular( 'music_as' )){ //シャイニーカラーズの場合
get_template_part('sitehensu/as');
} elseif(is_singular( 'music_godo' )){ //シャイニーカラーズの場合
get_template_part('sitehensu/godo');
}
$url_share=urlencode( get_the_permalink() );
$title_share=urlencode(get_the_title()).'｜'.get_bloginfo('name');
?>

<?php get_header(); ?>
<?php get_template_part('module_pageTit'); ?>
<?php get_template_part('module_panList'); ?>

<link rel="stylesheet" href="<?php echo $css_dir ?>/css/song.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $css_dir ?>/css/no_git.css" type="text/css" />
<script type="text/javascript" src="<?php echo $css_dir ?>/resources/cd_accordion.js"></script>
<?php if(!empty($css_pass)):?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/box/<?php echo $css_pass; ?>.css" type="text/css" />
<?php endif; ?>

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

<?php get_template_part('parts/music_page/core');
 ?>


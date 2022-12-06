<?php 
$taxonomy = get_query_var( 'taxonomy' );
$tax_info = get_taxonomy($taxonomy);
$pageTitle = $tax_info->label;
?>
<meta name="description" content="<?php echo get_the_archive_title();?>さんの<?php echo $pageTitle;?>されたアイドルマスター楽曲の情報です。">
<meta name="twitter:card" content="summary" />
<meta property="og:title" content="<?php echo $pageTitle;?>：<?php echo get_the_archive_title();?>｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo get_the_archive_title();?>さんの<?php echo $pageTitle;?>されたアイドルマスター楽曲の情報です。">
<meta property="og:image" content="<?php echo get_stylesheet_directory_uri();?>/resources/note_icon.png">

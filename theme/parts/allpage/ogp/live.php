<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得

$place = get_field('place',$term_idmenu.$term_id);//場所の出力
$address =  get_field('address',$term_idmenu.$term_id);

?>
<meta name="description" content="<?php echo $place; ?>で開催のライブ「<?php echo get_the_archive_title();?>」の曲情報です。">
<meta name="twitter:card" content="summary" />
<meta property="og:title" content="「<?php echo get_the_archive_title();?>」｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo $place; ?>で開催のライブ「<?php echo get_the_archive_title();?>」の曲情報です。">
<meta property="og:image" content="<?php echo get_stylesheet_directory_uri();?>/resources/mic_icon.png">


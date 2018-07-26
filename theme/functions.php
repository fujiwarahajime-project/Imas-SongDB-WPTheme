<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style')
);
}
remove_filter('the_content', 'wpautop');
remove_filter ('acf_the_content', 'wpautop');
the_field("partinfo", $post_id);
?>

<?php
$site_twitter = 'fujiwarahaji_me';//＠をはぶくこと
$creator_twitter = 'maccha_pie';//＠をはぶくこと
$ryakusyou = 'ミリマス';
$MV_Tag = 'ミリシタMV';
?>
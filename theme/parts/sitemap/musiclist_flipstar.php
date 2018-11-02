<!-- モバイルでない場合、ここからロード画面関係と全記事リスト -->
<?php if(!wp_is_mobile()): ?>
<!-- ロード画面 -->
<link href="<?php echo get_stylesheet_directory_uri(); ?>/resources/starlight-loading.min.css" rel="stylesheet" />
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/starlight-loading.min.js"></script>

<!-- JQuery関係 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<link href="<?php echo get_stylesheet_directory_uri(); ?>/resources/jquery.flipster.css" rel="stylesheet" />
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/jquery.flipster.min.js"></script>

<!-- 実際のリスト -->
<div class="musiclist">
<ul>
<!-- ここからループ -->
<?php
$paged = (int) get_query_var('paged');
$args = array(
	'posts_per_page' => 3000,
	'paged' => $paged,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'post_type' => 'music',
	'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
    <li><?php the_post_thumbnail('medium'); ?><br><a href="<?php the_permalink(); ?>"><div align="center"><?php the_title(); ?></div></a></li>

<?php endwhile; endif; ?>
  </ul>
<!-- FlipStarセッティング -->
<script>
$(function() {
	$('.musiclist').flipster({
		style: 'coverflow',
		start: '1',
    fadeIn: 400,
    loop: true,
    keyboard: true,
    touch: true,
	});
});</script></div>
<?php wp_reset_query(); ?>
<?php endif; ?>
<!-- ここまでロード画面関係と全記事リスト -->

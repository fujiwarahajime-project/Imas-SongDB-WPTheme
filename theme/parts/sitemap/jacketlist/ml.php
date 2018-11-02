<!-- 実際のリスト -->
<style type="text/css">
.musiclist {
  display: grid;
  grid-gap: 5px;
  grid-auto-flow: dense;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
}
.item {
  border-radius: 10px;
  background: #edf;
  padding: 13px;
  text-align: center;
}

</style>
<div class="musiclist">
<!-- ここからループ -->
<?php
$paged = (int) get_query_var('paged');
$args = array(
	'posts_per_page' => 3000,
	'paged' => $paged,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'post_type' => 'music_ml',
	'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
    <a href="<?php the_permalink(); ?>" class="item"><?php the_post_thumbnail('medium'); ?><br><?php the_title(); ?></a>

<?php endwhile; endif; ?>
</div>
<?php wp_reset_query(); ?>
<!-- ここまでロード画面関係と全記事リスト -->

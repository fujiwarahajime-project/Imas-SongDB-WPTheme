
<style type="text/css">
.musiclist {
  display: grid;
  grid-gap: 2px;
  grid-auto-flow: dense;
  grid-template-columns: repeat(auto-fit, minmax(153px, 1fr));
}
.item {
  border-radius: 2px;
  padding: 2px;
  text-align: center;
}
.music_cg{
  background: #D1C4E9;
}
.music_ml{
  background: #BBDEFB;
}
.music_sc{
  background: #F8BBD0;
}
.music_as{
  background: #F0F4C3;
}
.music_godo{
  background: #E0E0E0;
}
/* 遅延ロード関係 */
img {
  transition: filter 0s;
}
 
</style>
<h3>凡例</h3>
<div class="musiclist">
<div class="item music_cg">シンデレラガールズ曲</div>
<div class="item music_ml">ミリオンライブ曲</div>
<div class="item music_sc">シャイニーカラーズ曲</div>
<div class="item music_as">765AS曲</div>
<div class="item music_godo">合同曲</div>
</div>
<h3>リスト</h3>
<div class="musiclist">
<?php
$paged = (int) get_query_var('paged');
$args = array(
	'posts_per_page' => 3000,
	'paged' => $paged,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'post_type' => array('music_cg','music_ml','music_sc','music_as','music_godo'),
	'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
    <a href="<?php the_permalink(); ?>" class="item <?php echo get_post_type( $id ); ?>">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/load.gif"<?php
      if(has_post_thumbnail()){
      echo ' class="lazyestload" data-srcset="';
      echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
      echo " 1x,";
      echo get_the_post_thumbnail_url( get_the_ID(), 'medium' );
      echo " 2x,";
      echo get_the_post_thumbnail_url( get_the_ID(), 'large' );
      echo ' 3x"';
    }
       ?>>
    <br>
    <?php the_title(); ?></a>

<?php endwhile; endif; ?>
</div>
<?php wp_reset_query(); ?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/lazyestload.js"></script>

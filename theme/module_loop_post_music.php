<article class="media">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail()) :?>
	<div class="media-left postList_thumbnail">
		<a href="<?php the_permalink(); ?>">
		<?php
		$attr = array('class'	=> "media-object");
		the_post_thumbnail('thumbnail',$attr); ?>
		</a>
	</div>
	<?php endif; ?>
	<div class="media-body">

		<?php
if(is_tax( 'idol_765' ) or is_tax( 'idol_cg' ) or is_tax( 'idol_sc' )){
get_template_part('parts/tax/module_loop_idol_meta');
}else{
get_template_part('module_loop_post_meta');
}
?>
		<h1 class="media-heading entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<div class="media-body_excerpt">
<?php if(!wp_is_mobile()): ?>
<a href="<?php the_permalink(); ?>#movie" id="button">公式動画を見る</a>
<a href="<?php the_permalink(); ?>#CD" id="button">収録CDを見る</a>
<a href="<?php the_permalink(); ?>#live" id="button">ライブ情報を見る</a>
<?php endif; ?>
</div>
		<!--
		<div><a href="<?php the_permalink(); ?>" class="btn btn-default btn-sm"><?php _e('Read more', 'lightning'); ?></a></div>
		-->   
	</div>
</div>
</article>
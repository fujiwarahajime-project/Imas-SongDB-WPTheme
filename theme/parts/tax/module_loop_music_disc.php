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
		<?php get_template_part('module_loop_post_meta');?>
		<h1 class="media-heading entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<div class="media-body_excerpt">

<?php if(!wp_is_mobile()): ?>

<?php
$term_id = get_queried_object_id();//タームIDを取得
$cd_group = SCF::get( 'CD_group',$id );
foreach ( $cd_group as $field_name => $field_value ) {

	$tax_id_temp = $field_value['cd_term'];
	$idol_temp =  $field_value['cd_mem'];
	$solo_temp =  $field_value['cd_solo'];


	//${"cdidol_".$tax_id_temp."_".$id} = array_unique(array_merge( explode(',', $idol_temp) , explode(',', $field_value['cd_solo']) ));
	if($term_id == $tax_id_temp){

		foreach (explode(',', $idol_temp) as $idol_name_roop) {
			idollist($idol_name_roop,"cd");
		}
		

		foreach (explode(',', $solo_temp) as $idol_name_roop) {
			idollist($idol_name_roop,"cdsolo");
		}
		
		continue;
	}

}

?>


<?php endif; ?>
</div>
	</div>
</div>
</article>
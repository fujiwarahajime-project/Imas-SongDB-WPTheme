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
$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得
$term_id = get_queried_object_id();//タームIDを取得
$cd_group = SCF::get( 'CD_group',$id );
foreach ( $cd_group as $field_name => $field_value ) {

	$tax_id_temp = $field_value['cd_term'];
	$idol_temp =  $field_value['cd_mem'];

	global ${"cdidol_".$tax_id_temp."_".$id};

	${"cdidol_".$tax_id_temp."_".$id} = explode(',', $idol_temp);

}

foreach (${"cdidol_".$term_id."_".$id} as $idol_name_roop) {
	idollist($idol_name_roop,"live");
}


?>


<?php endif; ?>
</div>
	</div>
</div>
</article>
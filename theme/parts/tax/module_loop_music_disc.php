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

// シンデレラガールズ有無判定 
$term_cin = get_term_by('name',$idol_name_roop,'idol_cg');
if( $term_cin ){
$term = $term_cin;
$dir = 'cinderella';
}

//ミリオンライブ有無判定
$term_ml = get_term_by('name',$idol_name_roop,'idol_765');
if( $term_ml ){
$term = $term_ml;
$dir = 'millionlive';
}

//シャイニーカラーズ有無判定
$term_shiny = get_term_by('name',$idol_name_roop,'idol_shiny');
if( $term_shiny ){
$term = $term_shiny;
$dir = 'shinycolors';
}

        // タームのURLを取得
$term_link = get_term_link( $term );
        
//場所を取得
				$cv = get_field('cv', $term);
				$idol_term = get_field('idol-thum', $term);
				$idol_color = get_field('idol_color', $term);
        // 結果を出力
        echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$dir.'/'.$idol_term.'.png" class="idolicon_cd" style="background:'.$idol_color.';" title="'.$term->name.'(CV.'.$cv.')" alt="'.$term->name.'"></a>';
}


?>


<?php endif; ?>
</div>
	</div>
</div>
</article>
<?php global $lightning_theme_options; ?>
<div class="entry-meta">

<?php if ( get_post_type() != 'product' ) : ?>

<span class="published entry-meta_items"><?php echo esc_html( get_the_date() ); ?></span>
<?php
// Post update
$meta_hidden_update = ( isset( $lightning_theme_options['postUpdate_hidden'] ) && $lightning_theme_options['postUpdate_hidden'] ) ? ' entry-meta_hidden' : '';
?>

<span class="entry-meta_items entry-meta_updated<?php echo $meta_hidden_update; ?>">/ <?php _e( 'Last updated', 'lightning' ); ?> : <span class="updated"><?php the_modified_date( '' ); ?></span></span>

<?php
// Post author
$meta_hidden_author = ( isset( $lightning_theme_options['postAuthor_hidden'] ) && $lightning_theme_options['postAuthor_hidden'] ) ? ' entry-meta_hidden' : '';
?>

<span class="vcard author entry-meta_items entry-meta_items_author<?php echo $meta_hidden_author; ?>"><span class="fn"><?php the_author(); ?></span></span>

<?php endif; // if ( get_post_type() != 'product' ) ?>
<?php
echo '<span class="entry-meta_items entry-meta_items_term">';

$solotype = ['duet', 'unit', 'zentai']; //ソロ音源情報を表示する曲のタイプを指定

if(has_term($solotype,musictype)){
$term_id = get_queried_object_id();//タームIDを取得
$cd_group = SCF::get( 'CD_group',$id );
$term_name = single_term_title("", false); //タームの名前を取得

foreach ( $cd_group as $field_name => $field_value ) {
$idol_temp =  $field_value['cd_mem'];
if($idol_temp == $term_name){
echo '<span class="btn btn-xs btn-primary" style="cursor:default;">ソロ音源あり</span>';
}
}
}
?>

<?php
	$taxonomies = get_the_taxonomies();
if ( $taxonomies ) :
	// get $taxonomy name
	// $taxonomy   = key( $taxonomies );
	// To avoid WooCommerce default tax
	foreach ( $taxonomies as $key => $value ) {
		if ( $key != 'product_type' ) {
			$taxonomy = $key;
			break;
		}
	}

	$terms      = get_the_terms( get_the_ID(), $taxonomy );
	$term_url   = esc_url( get_term_link( $terms[0]->term_id, $taxonomy ) );
	$term_name  = esc_html( $terms[0]->name );
	$term_color = '';
	if ( class_exists( 'Vk_term_color' ) ) {
			$term_color = Vk_term_color::get_term_color( $terms[0]->term_id );
			$term_color = ( $term_color ) ? ' style="background-color:' . $term_color . ';border:none;"' : '';
	}
	echo '<a href="' . $term_url . '" class="btn btn-xs btn-primary"' . $term_color . '>' . $term_name . '</a>';
	endif;
echo "</span>";
?>

</div>

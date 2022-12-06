<?php
/**
 * For Archive page loop post item template
 *
 * @package lightning
 */

 //このオプションは使ってない
$options = array(
	// card, card-noborder, card-intext, card-horizontal , media, postListText.
	'layout'                     => 'card',
	'display_image'              => false,
	'display_image_overlay_term' => true,
	'display_excerpt'            => true,
	'display_date'               => true,
	'display_new'                => true,
	'display_taxonomies'         => false,
	'display_btn'                => false,
	'image_default_url'          => 'https://fujiwarahaji.me/media/site/logo-2.png',
	'overlay'                    => false,
	'btn_text'                   => __( 'Read more', 'lightning' ),
	'btn_align'                  => 'text-right',
	'new_text'                   => __( 'New!!', 'lightning' ),
	'new_date'                   => 7,
	'class_outer'                => 'vk_post-col-xs-12 vk_post-col-sm-12 vk_post-col-lg-12',
	'class_title'                => '',
	'body_prepend'               => '',
	'body_append'                => '',
);
//VK_Component_Posts::the_view( $post, $options );


//ループを手作り


//ソロ判定
$solotype = ['duet', 'unit', 'zentai']; //ソロ音源情報を表示する曲のタイプを指定
if(is_tax(allidolterm())){
if(has_term($solotype,'musictype')){
$cd_group = SCF::get( 'CD_group',$id );
$term_name = single_term_title("", false); //タームの名前を取得

foreach ( $cd_group as $field_name => $field_value ) {
	$solo_idol = explode(',', $field_value['cd_solo']);
if($field_value['cd_mem'] == $term_name or in_array($term_name, $solo_idol, true) ){
$solo = TRUE;
continue;
}}}}

?>

<div <?php post_class('card col-12'); ?>>
<div class="card-body">
<div class="card-subtitle text-muted small"><?php echo get_post_time('Y年n月j日')?>
<?php
//バッジ部分
if(isset($solo)){
	echo '<span class="badge badge-info float-right">ソロ音源あり</span>';
}
?></div>
<h5 class="card-title font-weight-bold">
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</h5>
<?php 
//CDメンバー表示
if(is_tax('disc') AND !wp_is_mobile()){
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

}}
?>
</div></div>
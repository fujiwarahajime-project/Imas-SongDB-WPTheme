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
$solo=FALSE;
if(is_tax(allidolterm())){
	$idolname = get_queried_object()->name;
if(has_term($solotype,'musictype')){
	foreach ( get_the_terms($id, 'disc') as $term ) {
		foreach(cd_member($id,$term->term_id) as $member){
			if($member = $idolname){
				$solo=TRUE;
				continue;
			}
		}
	}
}}

?>

<div <?php post_class('card col-12'); ?>>
<div class="card-body">
<div class="card-subtitle text-muted small">
<?php
  //サブスク処理
	$number = $id;
  if(subscription_play_data($id,$idolname)){
	$subscription = subscription_play_data($id,$idolname);
	echo '
	<a data-bs-toggle="modal" data-bs-target="#subscription_modal_'.$number.'">
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
	  <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
	  </svg>
	</a>
	<div class="modal fade" id="subscription_modal_'.$number.'" tabindex="-1" aria-labelledby="subscription_modal_label_'.$number.'" aria-hidden="true">
	  <div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="subscription_modal_label_'.$number.'">Youtube Musicで再生</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">';
		if(!empty($subscription['ytid'])){
		echo do_shortcode( '[arve url="https://www.youtube.com/watch?v='.$subscription['ytid'].'"]' );
		}
		echo '</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		</div>
	  </div>
	  </div>
	</div>
	';
  }

?>	
<?php echo get_post_time('Y年n月j日');?>
<?php
//バッジ部分
if($solo){
	echo '<span class="badge bg-info float-right">ソロ音源あり</span>';
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
<!-- CD情報 -->
<div class="msgbox" id="CD">
  <div class="msgboxtop">CD情報</div>
  <div class="msgboxbody">

<?php echo apply_filters('the_content',get_post_meta($post->ID, 'partinfo', true)); //パート分け情報の出力
?>
<div class="bg-dark text-white carousel-dark">
<div class="accordion accordion-flush" id="discaccordion">
<?php 
//ダークモードクラス
if(is_singular() AND !is_singular(array('music_ml','music_as','music_shiny'))){
  $dark_class = ' bg-dark text-white carousel-dark accordion_dark';
}

//旧来の配信情報
if (get_post_meta($post->ID, 'haishin', true)){
  echo '<div class="accordion-item">
  <h2 class="accordion-header" id="disc_head_haishin">
  <button type="button" class="accordion-button collapsed'.$dark_class.'" data-bs-toggle="collapse" data-bs-target="#disc_haishin" aria-expanded="false" aria-controls="disc_haishin">
      配信サイトで単曲配信あり
  </button>
  </h2>
  <div id="disc_haishin" class="accordion-collapse collapse" aria-labelledby="disc_head_haishin" data-bs-parent="#discaccordion">
  <div class="accordion-body'.$dark_class.'">'.
  do_shortcode(get_post_meta($post->ID, 'haishin', true))
  .'
</div></div></div>';
}

if ($terms = get_the_terms($post->ID, 'disc')) {
	foreach ( $terms as $term ) {
    unset($solo);
    unset($member_temp);
		//$member_data = cd_member($post->ID,$term->term_id);
    //メンバーデータの整理
    foreach (cd_member($post->ID,$term->term_id) as $member) {
      if(strpos($member,',')){
        $member_temp[] = $member;
      }elseif(get_term_by('name',$member,'unit')){
        $member_temp[] = $member;
      }else{
        $solo[] = $member;
      }
    }
    $solo = array_unique(array_filter($solo));
    $member_temp = array_unique(array_filter($member_temp));

    $link = get_term_link( $term, $taxonomy );
        echo '
<div class="accordion-item">
    <h2 class="accordion-header" id="disc_head'.$term->term_id.'">
    <button type="button" class="accordion-button collapsed'.$dark_class.'" data-bs-toggle="collapse" data-bs-target="#disc_'.$term->term_id.'" aria-expanded="false" aria-controls="disc_'.$term->term_id.'">
        '.str_ireplace("THE IDOLM@STER ","", esc_html($term->name)).'
    </button>
    </h2>
    <div id="disc_'.$term->term_id.'" class="accordion-collapse collapse" aria-labelledby="disc_head'.$term->term_id.'" data-bs-parent="#discaccordion">
    <div class="accordion-body'.$dark_class.'">
      <a href="'.$link.'" class="button" style="text-align:center;display:inline-block;width:100%;">このCDのすべての収録曲を見る</a>
      ';
        if(!empty($member_temp)){
          foreach ($member_temp as $member){
            foreach(explode(',',$member) as $member){
              idollist($member,'cd');
            }            
          }
        }
        if(!empty($solo)){
          //echo '<h5>ソロ収録メンバー</h5>';
          foreach ($solo as $member){
            idollist($member,'cdsolo');
          }
        }
echo get_field('shop','disc_'.$term->term_id).'    </div>
  </div>
</div>
';
        
	}
}

?>

</div></div>

</div>
  <div class="msgboxfoot">
  </div>
</div>
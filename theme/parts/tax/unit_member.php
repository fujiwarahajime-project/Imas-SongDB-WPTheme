<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得
$upload_dir = wp_upload_dir();

if(!empty(get_field('member',$term_idmenu.$term_id))):
?>

<div class="msgbox">
<div class="msgboxtop" id="member">メンバー</div>

<div class="msgboxbody">
<?php
$idol_temp = get_field('member',$term_idmenu.$term_id);
  $idol_list = explode(',', $idol_temp);
  foreach ($idol_list as $idol_name_roop) {
    if(is_tax( 'live' )){
    idollist($idol_name_roop,"live");
    }else{
    idollist($idol_name_roop,"cd");

    }
  }
?>

</div>
  <div class="msgboxfoot">
  </div>
</div>
      <?php endif;?>
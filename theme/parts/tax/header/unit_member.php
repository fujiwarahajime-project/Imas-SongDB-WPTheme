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

<?php
if(!empty($_GET['qr'])){
  $qr_code = true;
}else{
  $qr_code = false;
}
if(!empty(get_field('member',$term_idmenu.$term_id)) AND $qr_code){
  echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">
  </script><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/encoding-japanese/1.0.30/encoding.min.js"></script>
  <div class="container">
  <div class="row">';
  foreach ($idol_list as $idol_name_roop) {
    $idol_data = idolicon($idol_name_roop,"data_only");
    if(empty($idol_data[color])){
      $idol_data[color] = 'var(--color-key)';
    }
    echo '<div class="col-3" style="border:solid 5px '.$idol_data[color].'">
      <img src="'.$idol_data[url].'" class="qr_pic">
      <span id="qr_'.$idol_data[id].'" class="qr_can"></span><br>
      <ruby>'.$idol_name_roop.'<rt>'.$idol_data[kana].'</rt></ruby><br><ruby>'.$idol_data[cv].'<rt>'.$idol_data[cvkana].'</rt></ruby>
      </div>';
    $qr_data[] = array("id" => $idol_data[id] , "data" => $idol_name_roop ,);
  }
  echo '</div></div>

  <style>
    .qr_pic{
      width: 45%;
      vertical-align:baseline;
    }
    .qr_can{
      display:inline-block;
      width: 45%;
      margin:auto;
    }

    /* 印刷用レイアウトにする */
    header{
      display:none;
    }
    .page-header{
      display:none;
    }
    .breadSection{
      display:none;
    }
    .share{
      display:none;
    }
    .sideSection{
      display:none;
    }
    .siteFooter{
      display:none;
    }
    .msgbox{
      display:none;
    }
    .tablesorter{
      display:none;
    }
    h3{
      display:none;
    }
    div.well{
      display:none;
    }
    table.setlist{
      display:none;
    }
    .mainSection-col-two{
      width:100%;
    }
    .col-3{
      font-size:180%;
    }
    .siteContent{
      padding:0px;
    }


  </style>

  <script>';
  foreach ($qr_data as $qr_roop) {
    echo "
    $('#qr_".$qr_roop[id]."').qrcode({width: 90, height: 90, text: ".'unescape(Encoding.convert("'.$qr_roop[data].',","SJIS","UNICODE"))});';

  }
  echo '</script>';
}?>
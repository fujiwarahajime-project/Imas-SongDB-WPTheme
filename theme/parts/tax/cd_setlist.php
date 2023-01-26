<div class="post-list">
<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得
$term_id_orig = $term_id;
$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得

//他のセットリストを参照する設定の場合、タームIDを上書きする
/*
foreach (SCF::get_term_meta($term_id, $taxonomy, 'same_setlist') as $field) {
  if(!empty($field)){
    $term_id = $field;
    }
}*/

$setlist_kazu = count(SCF::get_term_meta( $term_id, $taxonomy, 'cd_setlist' )) >= 2;


$setlist_hide = FALSE;//array_search("term", SCF::get_term_meta( $term_id, $taxonomy, 'hide_setlist' ));

if($setlist_kazu){
if(!($setlist_hide !== false) or is_admin_bar_showing()){
  //通常ループを表示しない
  add_filter( 'lightning_is_extend_loop', function( $return ){
    return true;
  });



$setlist = SCF::get_term_meta( $term_id, $taxonomy, 'cd_setlist' );
foreach ($setlist as $fields ) {
  unset($song_id);

//メンバー情報があるか判定
//メンバー情報がない場合、セルを結合

  //曲名を表示
  foreach ($fields['setlist_song'] as $songname) {
    echo '<div ';
post_class('card col-12');
echo '>
<div class="card-body">
<div class="card-subtitle text-muted small">'./*get_post_time('Y年n月j日').*/'</div>
<h5 class="card-title font-weight-bold">
<a href="'.get_permalink($songname).'">'.
get_post($songname)->post_title.'</a>'.$fields['setlist_song2'];

//オフボーカルフラグを拾う
foreach ($fields['song_flag'] as $field) {
  if($field == 'offvocal'){
    echo '<button type="button" class="btn btn-info btn-sm" disabled>OffVocal</button>';
  }
}

echo '</h5>';
     //ターム判定
    if(is_admin_bar_showing()){//WPの管理用ツールバーが表示されているときのみ表示
     $term_search = wp_get_object_terms($songname,'disc', array('fields' => 'ids'));
     $term_search_result = in_array($term_id_orig,$term_search,true); //記事に紐付けられているターム一覧と表示中のタームが一致しているものがあるか比較
     if(empty($term_search_result)){ //一致しているものがなかった場合、米印を表示する
     echo '<span style="color:red;">★</span>';
     }
    }

    

  }

  //ここまで曲名処理
  echo PHP_EOL;
  
  $idol_temp = $fields['setlist_idol'];
  if($fields['setlist_idol']){
    if($fields['setlist_idol'] == "全員"){
      echo '<a href="#member">全員</a>';
    }else{
  $idol_list = explode(',', $idol_temp);
    foreach ($idol_list as $idol_name_roop) {
      idollist($idol_name_roop,"disc");
    }
  }
  }

 
echo $fields['setlist_idol_hosoku'];

//サブスクゾーン

if(!empty($fields['ytid']) OR !empty($fields['itunesid']) OR !empty($fields['spotifyid'])){
//ユニークID
unset($rand_id);
$rand_id = rand(1,9999);

//サブスクボタンの生成
  echo '<div class="d-flex bd-highlight text-center">';

if(!empty($fields['ytid'])){
  echo '<div class="p-2 flex-fill bd-highlight">
  <a class="btn btn-outline-info btn-block" data-toggle="collapse" href="#yt'.$rand_id.'" role="button" aria-expanded="false" aria-controls="#yt'.$rand_id.'">
  <i class="fa-brands fa-youtube"></i>
  </a></div>';
}
if(!empty($fields['itunesid'])){
  echo '<div class="p-2 flex-fill bd-highlight">
  <a class="btn btn-outline-info btn-block" data-toggle="collapse" href="#itunes'.$rand_id.'" role="button" aria-expanded="false" aria-controls="#itunes'.$rand_id.'">
  <i class="fa-brands fa-itunes"></i>
  </a></div>';
}
/*
if(!empty($fields['spotifyid'])){
  echo '<div class="p-2 flex-fill bd-highlight">
  <a class="btn btn-outline-info btn-block" data-toggle="collapse" href="#spotify'.$rand_id.'" role="button" aria-expanded="false" aria-controls="#spotify'.$rand_id.'">
  <i class="fa-brands fa-spotify"></i>
  </a></div>';
}
if(!empty(SCF::get_term_meta( $term_id, $taxonomy, 'amazon_albumid' ))){
  echo '<div class="p-2 flex-fill bd-highlight">
  <a class="btn btn-outline-info btn-block" role="button" href="https://www.amazon.co.jp/dp/'.SCF::get_term_meta( $term_id, $taxonomy, 'amazon_albumid' ).'/ref=as_sl_pc_tf_til?tag=fujiwarahajime-22&linkCode=w00&linkId=&creativeASIN='.SCF::get_term_meta( $term_id, $taxonomy, 'amazon_albumid' ).'">
  <i class="fa-brands fa-amazon"></i><i class="fa-solid fa-arrow-up-right-from-square"></i>
  </a></div>';
}*/
echo '</div>';

//サブスク出力
if(!empty($fields['ytid'])){
  echo '<div class="collapse subscription_yt" id="yt'.$rand_id.'">
  '.do_shortcode( '[arve url="https://www.youtube.com/watch?v='.$fields['ytid'].'"]' ).'

  </div>';
}
if(!empty($fields['itunesid'])){
  echo '<div class="collapse" id="itunes'.$rand_id.'">
  '.do_shortcode( '[itunes album_id="'.SCF::get_term_meta( $term_id, $taxonomy, 'itunes_albumid' ).'" song_id="'.$fields['itunesid'].'"]' ).'
  </div>';
}
if(!empty($fields['spotifyid'])){
  echo '<div class="collapse" id="spotify'.$rand_id.'">
  '.do_shortcode( '[spotify id="'.$fields['spotifyid'].'"]' ).'
  </div>';
}



}


echo '</div></div>
';

}
$setlist_showing = TRUE;
}}



?></div>
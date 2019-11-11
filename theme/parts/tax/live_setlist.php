
<?php
$term_id = get_queried_object_id(); // タームIDの取得
$setlist_kazu = count(SCF::get_term_meta( $term_id, $taxonomy, 'setlist' )) >= 2;
$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得
$setlist_hide = array_search("term", SCF::get_term_meta( $term_id, $taxonomy, 'hide_setlist' ));
if($setlist_kazu){
if(!($setlist_hide !== false) or is_admin_bar_showing()){
  if(is_admin_bar_showing() and ($setlist_hide !== false)){
    echo '<span style="color:red;font-weight: bold;">このセットリストは下書きです。<br>
    管理画面にログインしている場合のみ表示されます。<br>
    本番環境で表示する場合には編集画面から「term」のチェックボックスを操作してください。</span>';
  }
  echo '<table class="setlist"><tbody>';
  echo PHP_EOL;
  echo '<tr><th>曲名</th><th>アイドル</th></tr>';


$setlist = SCF::get_term_meta( $term_id, $taxonomy, 'setlist' );
foreach ($setlist as $fields ) {
  unset($song_id);
echo "<tr>";
  //曲名を表示
  echo '<td style="padding:0px">';
  foreach ($fields['setlist_song'] as $songname) {
     //ターム判定
    if(is_admin_bar_showing()){//WPの管理用ツールバーが表示されているときのみ表示
     $term_search = wp_get_object_terms($songname,'live', array('fields' => 'ids'));
     $term_search_result = in_array($term_id,$term_search,true); //記事に紐付けられているターム一覧と表示中のタームが一致しているものがあるか比較
     if(empty($term_search_result)){ //一致しているものがなかった場合、米印を表示する
     echo '<span style="color:red;">★</span>';
     }
    }

    
  echo '<a href="'.get_permalink($songname).'">'.get_post($songname)->post_title.'</a>';
  if(!empty($songname)){
  $song_id = "song_".$term_id."_".$songname;
  }
  }
  echo $fields['setlist_song2'];
  //ここまで曲名処理
  echo '</td>';
  echo PHP_EOL;
  echo '<td class="livemember '.$song_id.'">';
  
  $idol_temp = $fields['setlist_idol'];
  if($fields['setlist_idol']){
    if($fields['setlist_idol'] == "全員"){
      echo '<a href="#member">全員</a>';
    }else{
  $idol_list = explode(',', $idol_temp);
    foreach ($idol_list as $idol_name_roop) {
      idollist($idol_name_roop,"live");
    }
  }
  }

 
echo $fields['setlist_idol_hosoku'];
echo "</td></tr>";
echo PHP_EOL;
echo PHP_EOL;

}
echo '</tbody></table>';
$setlist_showing = TRUE;
}}

?>
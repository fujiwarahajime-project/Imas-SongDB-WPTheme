<?php
$term_id = get_queried_object_id(); // タームIDの取得
$setlist_hantei = count(SCF::get_term_meta( $term_id, $taxonomy, 'setlist' )) >= 2;
$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得
if($setlist_hantei): ?>

<table><tbody>
<tr><th>曲名</th><th>アイドル</th></tr>
<?php
$setlist = SCF::get_term_meta( $term_id, $taxonomy, 'setlist' );
foreach ($setlist as $fields ) {
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
  }
  echo $fields['setlist_song2'];
  //ここまで曲名処理
  echo '</td>';
  echo PHP_EOL;
  echo '<td class="livemember">';
  
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
?>
</tbody></table>
<?php endif; ?>

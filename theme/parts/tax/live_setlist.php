<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得
$term_id_orig = $term_id;
$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得
foreach (SCF::get_term_meta($term_id, $taxonomy, 'same_setlist') as $field) {
  if(!empty($field)){
    $term_id = $field;
    }
}
$setlist_kazu = count(SCF::get_term_meta( $term_id, $taxonomy, 'setlist' )) >= 2;


$setlist_hide = array_search("term", SCF::get_term_meta( $term_id, $taxonomy, 'hide_setlist' ));

if($setlist_kazu){
if(!($setlist_hide !== false) or is_admin_bar_showing()){
  if(is_admin_bar_showing() and ($setlist_hide !== false)){
    echo '<span style="color:red;font-weight: bold;">このセットリストは下書きです。<br>
    <a href="https://fujiwarahaji.me/wp-admin/term.php?taxonomy=live&tag_ID='.get_queried_object_id().'">
    管理画面</a>にログインしている場合のみ表示されます。<br>
    本番環境で表示する場合には編集画面から「term」のチェックボックスを操作してください。</span>';
  }
  echo '<table class="setlist"><tbody>';
  echo PHP_EOL;
  echo '<tr><th>曲名</th><th>アイドル</th></tr>';


$setlist = SCF::get_term_meta( $term_id, $taxonomy, 'setlist' );
foreach ($setlist as $fields ) {
  unset($song_id);
echo "<tr>";
//メンバー情報があるか判定 
unset($hide_2cell);
if(empty($fields['setlist_idol']) and empty($fields['setlist_idol_hosoku'])){
  $hide_2cell = 'colspan="2" ';
}

  //曲名を表示
  echo '<td '.$hide_2cell.'style="padding:0px">';
  foreach ($fields['setlist_song'] as $songname) {
     //ターム判定
    if(is_admin_bar_showing()){//WPの管理用ツールバーが表示されているときのみ表示
     $term_search = wp_get_object_terms($songname,'live', array('fields' => 'ids'));
     $term_search_result = in_array($term_id_orig,$term_search,true); //記事に紐付けられているターム一覧と表示中のタームが一致しているものがあるか比較
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


  if((!$setlist_kazu or ($setlist_hide !== false)) AND !empty(get_field('member',$term_idmenu.$term_id))){
    echo "<h3>セトリ予想</h3>";
    $idol_live = explode(',', get_field('member',$term_idmenu.$term_id));
    //デュエット曲・ユニット曲の一覧をつくる
    $post_kyoku = get_posts(array(
      'post_type' => array('music_cg','music_ml','music_shiny','music_as','music_cover'),
      'posts_per_page' => 10000,
      'tax_query' => array( 'relation' => 'OR',
      array(
        'taxonomy' => 'musictype',
        'field' => 'slug',
        'terms' => array('unit','duet'),
        'operator' => 'IN'
      ),
      )
      ));

      //はじめの出力
      echo '<table id="tablesort" class="tablesorter"><thead>'.PHP_EOL.'
      <tr><th class="header">曲名</th><th class="header">ライブ参加 / 収録音源有</th><th class="header">%</th></tr></thead><tbody>';

      global $post;
      foreach($post_kyoku as $post){
        setup_postdata( $post );
        if(!is_object_in_term($post->ID, 'musictype','zentai')){
        unset($idol_cd);

        foreach (wp_get_object_terms( $id, array("idol_cg","idol_765","idol_sc")) as $term){
          //シャニマスのユニット制対応（親タームの除外）
          if(!($term->parent == 0) OR !$term->taxnomy == "idol_sc"){
          //CDのメンバーを変数に突っ込む       
          $idol_cd[] = $term->name;
          }
        }
        //くらべる
        $idol_hikaku = array_intersect($idol_cd , $idol_live);

        if(count($idol_hikaku)>"1"){
          echo '<tr><td><a href="';
          echo get_permalink( $post );
          echo '">';
          echo get_the_title( $id );
          echo '</a></td><td>';
          echo count($idol_hikaku);
          echo " / ";
          echo count($idol_cd);
          echo "</td><td>";
          echo round(count($idol_hikaku)/count($idol_cd)*100);
          echo "</td></tr>";
          echo PHP_EOL;
        }
      }
        

      }
      echo "</tbody></table>";
  }



?>
<!-- JQuery読み込み -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- TableSorterのJSとCSS -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/resources/table_css/style.css" type="text/css" media="print, projection, screen" />
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/jquery.tablesorter.min.js" type="text/javascript"></script>
<!-- TableSorterを動かす -->
<script type="text/javascript">
$("table").tablesorter({ 
        // 確率が高い順にソートする
        sortList: [[2,1]] 
    });
</script>

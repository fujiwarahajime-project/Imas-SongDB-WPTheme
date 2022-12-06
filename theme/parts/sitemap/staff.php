<!-- JQuery読み込み -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- TableSorterのJSとCSS -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/resources/table_css/style.css" type="text/css" media="print, projection, screen" />
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/jquery.tablesorter.min.js" type="text/javascript"></script>
<style>
tbody tr:nth-child(even) td{
  background:#EEE;
} 
</style>

<script type="text/javascript">
// TableSorterを動かす
$(document).ready(function()
{
$("#tablesort").tablesorter();
}
);

// 絞り込み検索

$(function() {
    var $searchInput = $('#textarea'); // 入力エリア
    var $searchElem = $('.setlist_card'); // 絞り込む要素
    var excludedClass = 'setlist_hide'; // 絞り込み対象外の要素に付与するclass
 
    // 絞り込み処理
    function extraction() {
        var keywordArr = $searchInput.val().toLowerCase().replace('　', ' ').split(' '); // 入力文字列を配列に格納
        $searchElem.removeClass(excludedClass).show();// 現在非表示にしているリストを表示する
        for (var i = 0; i < keywordArr.length; i++) {
            for (var j = 0; j < $searchElem.length; j++) {
                var thisString = $searchElem.eq(j).text().toLowerCase();
                if(thisString.indexOf(keywordArr[i]) == -1) { // 入力文字列と一致する文字列がない場合
                    $searchElem.eq(j).addClass(excludedClass); // 絞り込み対象外のclass付与
                }
            }
        }
        $('.' + excludedClass).hide(); // 絞り込み対象外の要素の非表示
    }
 
    $searchInput.on('load keyup blur', function() {
        extraction();
    });
    <?php
    if(isset($_GET['word'])){
        echo 'document.getElementById( "textarea" ).value = "'.$_GET['word'].'" ;';
        echo 'extraction();';
    }
    ?>
});
</script>
<?php
$terms = get_terms(array('lyrics','composer','arrange'));
foreach ($terms as $term){
  //名前データを名前一覧に追加
    $name_data[] = $term->name;
  //個人データを作成
    ${$term->name}[$term->taxonomy] = array(
      'count'=> $term->count,
      'id'=> $term->term_id,
    );
}
//データの整理
$name_data = array_unique($name_data);
?>
<input type="text" id="textarea" placeholder="名前を入力すると絞り込みできます。" />
<table id="tablesort" class="tablesorter"><thead>
<tr><th>名前</th><th>作詞</th><th>作曲</th><th>編曲</th></thead><tbody>
<?php
foreach ($name_data as $name){
  echo '<tr class="setlist_card"><td>'.$name.'<td>';
  //作詞情報
  if(!empty(${$name}["lyrics"])){
    echo '<a href="'.get_term_link(${$name}["lyrics"]["id"]).'">'.${$name}["lyrics"]["count"].'</a>';
  }else{
    echo '-';
  }
  echo '</td><td>';
  //作曲情報
  if(!empty(${$name}["composer"])){
    echo '<a href="'.get_term_link(${$name}["composer"]["id"]).'">'.${$name}["composer"]["count"].'</a>';
  }else{
    echo '-';
  }
  echo '</td><td>';  
  //編曲情報
  if(!empty(${$name}["arrange"])){
    echo '<a href="'.get_term_link(${$name}["arrange"]["id"]).'">'.${$name}["arrange"]["count"].'</a>';
  }else{
    echo '-';
  }
  echo '</td></tr>'.PHP_EOL;

}
?>
</tbody></table>

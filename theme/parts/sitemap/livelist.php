<!-- JQuery読み込み -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- TableSorterのJSとCSS -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/resources/table_css/style.css" type="text/css" media="print, projection, screen" />
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/jquery.tablesorter.min.js" type="text/javascript"></script>

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


<!-- カレンダーをCDNから引っ張り出す -->
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css' rel='stylesheet' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css' rel='stylesheet' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/list/main.min.css' rel='stylesheet' />

<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/list/main.min.js'></script>

<h2>イベントカレンダー</h2>
<div id='calendar'></div>

<h2>イベント一覧</h2>
<p>行の先頭に「<i class="fas fa-compact-disc"></i>」がついているライブについては、ライブのDVD・BDが発売されています。<br>
「<i class="fas fa-list-ul"></i>」がついているライブは、詳細なセットリストを掲載しています。<br>
詳しい情報につきましてはイベント名をクリック・タップした先で確認できます。</p>

<input type="text" id="textarea" placeholder="「yyyy-mm-dd」形式の日付、ライブ名、会場名で絞り込みできます。" />

<table id="tablesort" class="tablesorter"><thead>
<tr><th></th><th>イベント名</th><th>会場</th><th>曲数</th></thead><tbody>
<?php
// カスタム分類名
$taxonomy = 'live';

// パラメータ 
$args = array(
    // 子タームの投稿数を親タームに含める
    'pad_counts' => true,
  
    // 投稿記事がないタームも取得
    'hide_empty' => false,

    //逆順
    'order'         => 'DESC',


);

// カスタム分類のタームのリストを取得
$terms = get_terms( $taxonomy , $args );

if ( count( $terms ) != 0 ) {
     
    // タームのリスト $terms を $term に格納してループ
    foreach ( $terms as $term ) {
        // タームのURLを取得
        $term = sanitize_term( $term, $taxonomy );
        $term_link = get_term_link( $term, $taxonomy );
        if ( is_wp_error( $term_link ) ) {
            continue;
        }
				$place = get_field('place', $term);
                $setlist_hantei = count(SCF::get_term_meta( $term, $taxonomy, 'setlist' )) >= 2; //セットリスト判定

            echo '<tr class="setlist_card">';

    echo '<td>';

if(!empty(get_field('shop', $term))) {//もしライブBDが発売されているのなら
echo '<i class="fas fa-compact-disc"></i>';}//CDマークを出力する

if($setlist_hantei) {//もしセットリストが登録されているなら
    echo '<i class="fas fa-list-ul"></i>';}//リストのマークを出力する

if(!empty(get_field('movie', $term))){ //もし放映情報があるなら
    echo '<i class="fas fa-tv"></i>'; //TVマークを出力
}
    echo '</td>';
    $event_name = str_ireplace("THE IDOLM@STER ","", $term->name);
        echo '<td><a href="' . esc_url( $term_link ) . '">' .$event_name. '</a></td>';
        echo '<td>'.$place.'</td>';
        echo '<td>'.$term->count.'</td>';
        echo '</tr>';
echo PHP_EOL;

//カレンダー用処理
preg_match('/\d{4}\-\d{1,2}\-\d{1,2}/' , $term->name, $day);
$cal_data[] = [
  'day'=>array_shift($day),
  'title'=>preg_replace('/\d{4}\-\d{1,2}\-\d{1,2}/', '' , $event_name ),
  'url'=>esc_url( $term_link ),
  'place'=>$place
];

    }
//最後の処理
}
?>
</tbody></table>

<!-- カレンダーの設定などなど -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'dayGrid','list' ],//付きカレンダー表示とリスト表示を使用
    defaultView: 'listMonth',//デフォルトで月別イベントリストにする
    locale:'ja', //日本語化
    header: { //ヘッダーの表示項目設定
      left: 'today listMonth,dayGridMonth',
      center: 'title',
      right: 'prev,next'
    },
    nowIndicator: true,
    buttonText: {
      today:    '今日',
      month:    '月',
      week:     '週',
      day:      '日',
      list:     'リスト'
    },
    events: [
      <?php //イベント一覧のタームを形式通りに出力
      foreach($cal_data as $event){
        echo "{".PHP_EOL;
        echo "title:'".$event["title"]."（".$event["place"]."）',".PHP_EOL;
        echo "url:'".$event["url"]."',".PHP_EOL;
        echo "start:'".$event["day"]."'".PHP_EOL;
        echo "},".PHP_EOL;
      }
      ?>
    ]
  });

  calendar.render();
});

</script>
<style>

.fc-sun { /* 日曜日を赤にする */
    color: red;
    background-color: #fff0f0;
}

.fc-sat { /* 土曜日を青にする */
    color: blue;
    background-color: #f0f0ff;
}

.fc h2{ /* タイトルの背景を透過する */
  border-style:none;
  background-color:rgba(0,0,0,0);
}

.fc-list-item-time{ /* ライブの時間を消す（今の所all-dayしか表示しないため） */
    display:none;
}
</style>

<!-- JQuery読み込み -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- TableSorterのJSとCSS -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/resources/table_css/style.css" type="text/css" media="print, projection, screen" />
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/jquery.tablesorter.min.js" type="text/javascript"></script>
<!-- TableSorterを動かす -->
<script type="text/javascript">
$(document).ready(function()
{
$("#tablesort").tablesorter();
}
);
</script>

<!-- カレンダーをCDNから引っ張り出す -->
<link href='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/list@4.3.0/main.min.css' rel='stylesheet' />

<script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/list@4.3.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js'></script>

<h2>イベントカレンダー</h2>
<div id='calendar'></div>

<h2>イベント一覧</h2>
<p>行の先頭に「<i class="fas fa-compact-disc"></i>」がついているライブについては、ライブのDVD・BDが発売されています。<br>
「<i class="fas fa-list-ul"></i>」がついているライブは、詳細なセットリストを掲載しています。<br>
詳しい情報につきましてはイベント名をクリック・タップした先で確認できます。</p>

<table id="tablesort" class="tablesorter"><thead>
<tr><th></th><th>イベント名</th><th>会場</th><th>曲数</th></th></thead><tbody>
<?php
// カスタム分類名
$taxonomy = 'live';

// パラメータ 
$args = array(
    // 子タームの投稿数を親タームに含める
    'pad_counts' => true,
  
    // 投稿記事がないタームも取得
    'hide_empty' => false
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

            echo '<tr>';

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
        echo "title:'".$event[title]."（".$event[place]."）',".PHP_EOL;
        echo "url:'".$event[url]."',".PHP_EOL;
        echo "start:'".$event[day]."'".PHP_EOL;
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
</style>

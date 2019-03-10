<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/resources/table_css/style.css" type="text/css" media="print, projection, screen" />
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/jquery.tablesorter.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()
{
$("#tablesort").tablesorter();
}
);
</script>

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
				$live_bd = get_field('shop', $term);
                $setlist_hantei = count(SCF::get_term_meta( $term, $taxonomy, 'setlist' )) >= 2; //セットリスト判定

            echo '<tr>';

    echo '<td>';

if(!empty($live_bd)) {//もしライブBDが発売されているのなら
echo '<i class="fas fa-compact-disc"></i>';}//CDマークを出力する

if($setlist_hantei) {//もしセットリストが登録されているなら
    echo '<i class="fas fa-list-ul"></i>';}//リストのマークを出力する
    
    echo '</td>';
        echo '<td><a href="' . esc_url( $term_link ) . '">' .str_ireplace("THE IDOLM@STER ","", $term->name). '</a></td>';
        echo '<td>'.$place.'</td>';
        echo '<td>'.$term->count.'</td>';
        echo '</tr>';
echo PHP_EOL;
    }
//最後の処理
}
?>
</tbody></table>
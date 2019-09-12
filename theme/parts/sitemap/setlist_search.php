<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/resources/table_css/style.css" type="text/css" media="print, projection, screen" />
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/jquery.tablesorter.min.js" type="text/javascript"></script>
<script type="text/javascript">
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
});
</script>

<p>
登録してあるセットリストを全表示しています。<br>
以下のテキストボックスよりキーワードによる絞り込み検索ができます。
</p>

<h3>検索欄入力のコツ</h3>
日付で絞り込む場合は「2010-01-10」のような書式で書いてください。<br>
英字は半角で入力してください。<br>
「！」などの記号は英字に続く場合は半角で（WORLD!!）、日本語に続く場合は全角で（ギルティ！）入力してください。<br>
処理としては表示されている文字値で絞り込みをしているだけなので、表示されているとおりに入力すれば絞り込みできます。


<input type="text" id="textarea" placeholder="日付、曲名、ライブ名、会場名、ユニット名、アイドル名（声優名は使えません）で絞り込みできます。" />

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
                if(count(SCF::get_term_meta( $term, $taxonomy, 'setlist' )) >= 2){
                $setlist = SCF::get_term_meta( $term, $taxonomy, 'setlist' ); //セットリスト判定
                $setlist_hide = array_search("term", SCF::get_term_meta( $term, $taxonomy, 'hide_setlist' ));
                if(!($setlist_hide !== false)){
        
                foreach ($setlist as $fields ) {
                    echo '<div class="msgbox setlist_card">';
                    echo PHP_EOL;
                    echo '  <div class="msgboxtop">';

                    if(!empty($live_bd)) {//もしライブBDが発売されているのなら
                        echo '<i class="fas fa-compact-disc"></i>'; //CDマークを出力する
                    }

                    echo PHP_EOL;

                    echo '      <a href="' . esc_url( $term_link ) . '">' .str_ireplace("THE IDOLM@STER ","", $term->name). '</a>';
                    echo '（'.$place.'）';
                    echo PHP_EOL;
                    echo '  </div><div class="msgboxbody">';

                    echo '<div>';
                    foreach ($fields['setlist_song'] as $songname) {
                        echo '<a href="'.get_permalink($songname).'">'.get_post($songname)->post_title.'</a>';
                    }
                    echo $fields['setlist_song2'];
                    echo '  </div><div>';

                    $idol_temp = $fields['setlist_idol'];
                    if($fields['setlist_idol']){
                    $idol_list = explode(',', $idol_temp);
                      foreach ($idol_list as $idol_name_roop) {
                        $unit_term = get_term_by('name',$idol_name_roop,'unit');
                          if($unit_term){
                            $unit_link = get_term_link( $unit_term );
                            $unit_member = get_field('member', $unit_term);
                            echo "［";
                            echo $unit_member;
                            echo '（<a href="' .$unit_link. '">'.$idol_name_roop.'</a>）';
                            echo "］,";

                           }elseif($idol_name_roop == "全員"){
                               echo get_field('member', $term);
                           }else{
                               echo $idol_name_roop;
                               echo ",";
                          }

                      }
                  
                }
                echo $fields['setlist_idol_hosoku'];

            echo '</div></div><div class="msgboxfoot"></div></div>';
            echo PHP_EOL;
            echo PHP_EOL;

                    }





    
echo PHP_EOL;
    }
}
}
}
?>

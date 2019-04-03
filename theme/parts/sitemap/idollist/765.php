<style type="text/css">
:root{
  --idolpic: 100px;
}

@media screen and (min-width:641px) {
  /*　横幅1201px以上（PCフル表示などの場合）は3列表示　*/
  .idol {width:50%;}
  .solocolle .idol {width:50%;}

}

@media screen and (max-width: 640px) { 
  /*　横幅520px以下（スマホなど）は1列表示　*/
  .idol {width:100%;}
}


.idollist{/* フレックスボックスにする */
  display: flex;
  flex-wrap: wrap;
}
.idol{/* アイテムの外枠、全体フォントに関する設定 */
  height:calc(var(--idolpic) + 2px);
  border:solid 1px darkgray;
  border-radius:2px;
}
.idolicon{/* アイコンに関する設定（バックグラウンドは、アイドルのテーマカラーを指定しなかったときのみ使用されます） */
  background:linear-gradient(lightgray,gray);
  float:left;
  padding:8px;
  height:var(--idolpic);
  margin-bottom:0px;
  display:block;
}
.idolname{/* アイドルの名前まわりのスタイル設定 */
  font-size:20px;
  margin:7px 5px;
  border-bottom:dotted 2px gray;
  font-weight: bold;}
.moreinfo{
  margin:7px 7px;
}
.info{
  margin-left:var(--idolpic);
}

.count{
    text-align: right;
}

.cv{
    float: left;
}
</style>

<div class="idollist">
<?php
// カスタム分類名
$taxonomy = 'idol_765';

if($taxonomy == 'idol_cg'){
$idolpic_dir = "cinderella";
$orderby = 'count';
} elseif($taxonomy == 'idol_765') {
$idolpic_dir = "millionlive";
$orderby = 'term_order';

} elseif($taxonomy == 'idol_sc') {
$idolpic_dir = "shinycolors";
$orderby = 'none';

}


// パラメータ 
$args = array(
    // 子タームの投稿数を親タームに含める
    'pad_counts' => true,
  
    // 投稿記事がないタームも取得
    'hide_empty' => true,
   //並び順
'orderby' => $orderby,
'order' => DESC,
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
//データの取得
        			$cv = get_field('cv', $term);
				$CVKana = get_field('CVKana', $term);
				$Kana = get_field('Kana', $term);
				$idol_term = get_field('idol-thum', $term);
				$idol_color = get_field('idol_color', $term);
				$count = $term->count;
				$upload_dir = wp_upload_dir();

if($taxonomy == 'idol_sc') {//シャイニーカラーズの分岐

        if( $term->parent != 0 ) { //親タームと子タームの分岐
        echo '<div class="idol">'; //子ターム
        echo PHP_EOL;
        echo '  <a href="' . esc_url( $term_link ) . '">';
        echo PHP_EOL;
        echo '  <img src="'.$upload_dir['baseurl'].'/idol/'.$idolpic_dir.'/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';">';
        echo PHP_EOL;
        echo '  <div class="info"><p class="idolname"><ruby>'.$term->name.'<rt>'.$Kana.'</rt></ruby></a></p>';
        echo PHP_EOL;
        echo '  <div class="moreinfo"><p class="cv">CV：<ruby>'.$cv.'<rt>'.$CVKana.'</rt></ruby></p>';
        echo PHP_EOL;
        echo '  <p class="count">'.$count.'</p></div></div>';
        echo PHP_EOL;
        echo '</div>';
        echo PHP_EOL;

        } else {
        echo '<h2>'; //親ターム
        echo PHP_EOL;
        echo '  <a href="' . esc_url( $term_link ) . '">';
        echo PHP_EOL;
        echo '  <img src="'.$upload_dir['baseurl'].'/idol/'.$idolpic_dir.'/unit/'.$idol_term.'.png" style="height:40px;margin-right:10px;background:'.$idol_color.';">'.$term->name.'</a>';
        echo PHP_EOL;
        echo ' </h2>';
        echo PHP_EOL;

}

} else { //シャイニーカラーズ以外の通常出力

        echo '<div class="idol">'; //子ターム
        echo PHP_EOL;
        echo '  <a href="' . esc_url( $term_link ) . '">';
        echo PHP_EOL;
        echo '  <img src="'.$upload_dir['baseurl'].'/idol/'.$idolpic_dir.'/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';">';
        echo PHP_EOL;
        echo '  <div class="info"><p class="idolname"><ruby>'.$term->name.'<rt>'.$Kana.'</rt></ruby></a></p>';
        echo PHP_EOL;
        echo '  <div class="moreinfo"><p class="cv">CV：<ruby>'.$cv.'<rt>'.$CVKana.'</rt></ruby></p>';
        echo PHP_EOL;
        echo '  <p class="count">'.$count.'</p></div></div>';
        echo PHP_EOL;
        echo '</div>';
        echo PHP_EOL;


}
//最後の処理
}}
?>
</div>
<style type="text/css">.idol{float:left;height:102px;width:375px;max-width: 100%;border:solid 1px darkgray;border-radius:2px;background:white;}
.idolicon{background:linear-gradient(lightgray,gray);float:left;padding:8px;width:100px;margin-bottom:0px;display:block;}
.idolname{font-size:20px;margin:7px 5px;border-bottom:dotted 2px gray;font-weight: bold;}.moreinfo{margin:7px 7px;}
.info{margin-left:100px;}
.cv{float: left;}
.count{text-align: right;}</style>
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
    'hide_empty' => false,
   //並び順
'orderby' => $orderby,
'order' => DESC,
);

// カスタム分類のタームのリストを取得
$terms = get_terms( $taxonomy , $args );

if ( count( $terms ) != 0 ) {
//最初のTable処理
echo '<style type="text/css">.idol{float:left;height:102px;width:375px;max-width: 100%;border:solid 1px darkgray;border-radius:2px;background:white;font-family: "Rounded Mplus 1c";}';
echo '.idolicon{background:linear-gradient(lightgray,gray);float:left;padding:8px;width:100px;margin-bottom:0px;display:block;}';
echo '.idolname{font-size:20px;margin:7px 5px;border-bottom:dotted 2px gray;font-weight: bold;}.moreinfo{margin:7px 7px;}.info{margin-left:100px;}.cv{float: left;}.count{text-align: right;}</style>';
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
	echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$idolpic_dir.'/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';">';
        echo '<div class="info"><p class="idolname"><ruby>'.$term->name.'<rt>'.$Kana.'</rt></ruby></a></p>';
	echo '<div class="moreinfo"><p class="cv">CV：<ruby>'.$cv.'<rt>'.$CVKana.'</rt></ruby></p><p class="count">'.$count.'</p></div></div>';
        echo '</div>';
        } else {
	echo '<h2>'; //親ターム
	echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$idolpic_dir.'/unit/'.$idol_term.'.png" style="height:40px;margin-right:10px;background:'.$idol_color.';">'.$term->name.'</a></h2>';
}

} else { //シャイニーカラーズ以外の通常出力

	echo '<div class="idol">';
	echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$idolpic_dir.'/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';">';
        echo '<div class="info"><p class="idolname"><ruby>'.$term->name.'<rt>'.$Kana.'</rt></ruby></a></p>';
	echo '<div class="moreinfo"><p class="cv">CV：<ruby>'.$cv.'<rt>'.$CVKana.'</rt></ruby></p><p class="count">'.$count.'</p></div></div>';
        echo '</div>';

}
//最後の処理
}}
?>

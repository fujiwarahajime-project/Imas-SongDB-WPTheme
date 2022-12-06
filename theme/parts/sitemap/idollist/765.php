
<div class="container">
<div class="row idollist">
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
'order' => "DESC",
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

        echo 
'
<div class="col-sm-6 col-md-4 idol_card" data-sort="'.$count.'">
<a href="' . esc_url( $term_link ) . '" class="card">
<div class="row no-gutters">
  <img class="col-auto bd-placeholder-img idol_icon" img src="'.$upload_dir['baseurl'].'/idol/'.$idolpic_dir.'/'.$idol_term.'.png" style="background:'.$idol_color.';">
<div class="col">
<div class="card-body">
<h5 class="card-title">';
if($term->name == $Kana){
  echo $term->name;
}else{
  echo '<ruby>'.$term->name.'<rt>'.$Kana.'</rt></ruby>';
}
echo '</h5>
<p class="card-text">';
if($cv == $CVKana){
  echo $cv;
}else{
  echo '<ruby>'.$cv.'<rt>'.$CVKana.'</rt></ruby>';
}
echo '</p>
</div></div>
</div></a></div>
';
}}
?>
</div></div>
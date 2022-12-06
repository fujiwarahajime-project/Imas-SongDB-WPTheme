<div class="container">
  <div class="row idollist">

<?php
// カスタム分類名
$taxonomy = 'cv';
$upload_dir = wp_upload_dir();
$orderby = 'count';

// パラメータ 
$args = array(
    // 子タームの投稿数を親タームに含める
    'pad_counts' => true,
  
    // 投稿記事がないタームも取得
    'hide_empty' => true,
   //並び順
'orderby' => $orderby,
'order' => 'DESC',
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
$term_id = $term->term_id;//タームID取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ 」の取得

$content = get_field('content',$term_idmenu.$term_id);
if($content == 'cg'){
  $idol_dir = 'cinderella';
}elseif($content == 'ml'){
  $idol_dir = 'millionlive';
}elseif($content == 'cg'){
  $idol_dir = 'shinycolors';
}

$idol_term = get_field('idol-thum', $term);
$idol_color = get_field('idol_color', $term);
$count = $term->count;
$chara = get_field('chara_name',$term);

echo '
<div class="col-sm-6 col-md-4 idol_card" data-sort="'.$count.'">
<a href="' . esc_url( $term_link ) . '" class="card">
<div class="row no-gutters">
  <img class="col-auto bd-placeholder-img idol_icon" src="'.$upload_dir['baseurl'].'/idol/'.$idol_dir.'/'.$idol_term.'"  style="background:'.$idol_color.';">
<div class="col">
<div class="card-body">
<h5 class="card-title">'.$term->name.'</h5>
<p class="card-text">'.$chara.'役</p>
</div></div>
</div></a></div>
';


//最後の処理
}}
?>
</div></div>
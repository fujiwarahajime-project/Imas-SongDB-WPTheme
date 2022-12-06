<style type="text/css">
.entry-body h2{
  margin-top:.5em;
  margin-bottom:0px;
  padding:.1em 0;
}

.unitpic{
  height:40px;
  margin-right:10px;
}
</style>

<div class="idollist">
<?php
// カスタム分類名
$taxonomy = 'idol_sc';

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

$upload_dir = wp_upload_dir();
// パラメータ 
$args = array(
    // 子タームの投稿数を親タームに含める
    'pad_counts' => true,
  
    // 投稿記事がないタームも取得
    'hide_empty' => true,
    //並び順
    'orderby' => $orderby,
    'order' => 'DESC',
    //親ターム（ユニット）のみ取得
    'parent' => 0
);

// カスタム分類のタームのリストを取得
$terms = get_terms( $taxonomy , $args );
//ループ1回目（ユニット）
  foreach($terms as $term){
    //ユニット見出し
    echo '
    <h2 style="border-top-color:'.get_field('idol_color', $term).';" data-sort="'.$term->count.'">
    <a href="' . esc_url( get_term_link( $term, $taxonomy ) ) . '">
    <img src="'.$upload_dir['baseurl'].'/idol/'.$idolpic_dir.'/unit/'.get_field('idol-thum', $term).'.png" class="unitpic">'.$term->name.'</a>
    </h2>

    <div class="container"><div class="row idollist">
    ';
    $unit_id = $term->term_id;

    //ループ2回目（ユニットメンバー）
    $terms = get_terms( $taxonomy , array('hide_empty' => true, 'parent' => $unit_id));
    foreach($terms as $term){
      //ユニットメンバー出力
      $cv = get_field('cv', $term);
				$CVKana = get_field('CVKana', $term);
				$Kana = get_field('Kana', $term);
				$idol_term = get_field('idol-thum', $term);
				$idol_color = get_field('idol_color', $term);
				$count = $term->count;
        $term_link = get_term_link( $term, $taxonomy );

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
    }
    //ユニットの閉じ処理
    echo '</div></div>';

  }




?>
</div>
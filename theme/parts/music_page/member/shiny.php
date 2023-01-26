<?php //シャイニーカラーズ出力用タグ
$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得
$taxonomy = 'idol_sc';
if ($terms = wp_get_object_terms($post->ID, $taxonomy) ) {
echo '<div class="tab_title">283プロダクション</div>';
echo '<div class="idollist">';
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームID取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ 」の取得
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得
$CV = get_field('cv',$term_idmenu.$term_id);//声優の名前を取得
$idol_term = get_field('idol-thum',$term_idmenu.$term_id);//アイドル固有ID（画像のファイル名）を取得
$idol_color = get_field('idol_color',$term_idmenu.$term_id);//アイドルのテーマカラーを取得
$solo_temp = get_query_var('solo_temp');
$idolpic_dir = 'shinycolors';


if(!($term->parent == 0)){ //子タクソノミーがない（アイドル）のみ出力
  echo '<div class="col-sm-6 col-md-4 idol_card">';
  if(in_array($term->name, $solo_temp)){
    echo '<div class="badge bg-info icon_badge">ソロ</div>';
  }
  echo '<a href="' . $link . '" class="card">
  <div class="row no-gutters">
    <img class="col-auto bd-placeholder-img idol_icon" img src="'.$upload_dir['baseurl'].'/idol/'.$idolpic_dir.'/'.$idol_term.'.png" style="background:'.$idol_color.';">
    <div class="col">
  <div class="card-body">
  <h5 class="card-title">'.$term->name.'</h5>
  <p class="card-text">'.$CV.'</p>
  </div></div>
  </div></a></div>
    ';
    
        }}
echo "</div>";
}
?>

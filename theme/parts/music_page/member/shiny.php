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

if(!($term->parent == 0)){ //子タクソノミーがない（アイドル）のみ出力
    echo '<div class="idol"><a href="'.$link.'"><div class="idolicon" style="background:'.$idol_color.';position: relative;"><img src="'.$upload_dir['baseurl'].'/idol/shinycolors/'.$idol_term.'.png"" title="'.$term->term_id.'">';
    if(in_array($term->name, $solo_temp)){
    echo '<p class="fuchidori solo" title="ソロあり">S</p>';
    }
    echo '</div>';
    echo "\n";
    echo '<div class="info"><div class="idolname"><a href="'.$link.'">'.esc_html($term->name).'</a></div>';
    echo "\n";
    echo '<div class="moreinfo">CV：'.$CV.'</div></div></div>';
    echo "\n";
        }}
echo "</div>";
}
?>

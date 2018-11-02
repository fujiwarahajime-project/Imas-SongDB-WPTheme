<?php //シンデレラガールズ出力用タグ
$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得
$taxonomy = 'idol_cg';
if ($terms = get_the_terms($post->ID, $taxonomy, $args)) {
echo '<div class="tab_title">シンデレラガールズ</div>';
echo '<div class="idollist">';
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームID取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ 」の取得
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得
$CV = get_field('cv',$term_idmenu.$term_id);//声優の名前を取得
$idol_term = get_field('idol-thum',$term_idmenu.$term_id);//アイドル固有ID（画像のファイル名）を取得
$idol_color = get_field('idol_color',$term_idmenu.$term_id);//アイドルのテーマカラーを取得

//出力
echo '<div class="idol"><a href="'.$link.'"><img src="'.$upload_dir['baseurl'].'/idol/cinderella/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';" title="'.$term->term_id.'"></a>';
echo "\n";
echo '<div class="info"><div class="idolname"><a href="'.$link.'">'.esc_html($term->name).'</a></div>';
echo "\n";
echo '<div class="moreinfo">CV：'.$CV.'</div></div></div>';
echo "\n";
    }
echo "</div>";
}
?>

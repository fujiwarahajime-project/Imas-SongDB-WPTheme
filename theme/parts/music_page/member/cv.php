<?php //シンデレラガールズ出力用タグ
$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得
$taxonomy = 'cv';
if ($terms = wp_get_object_terms($post->ID, $taxonomy) ) {
echo '<div class="tab_title">声優</div>';
echo '<div class="idollist">';
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームID取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ 」の取得
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得
$content = get_field('content',$term_idmenu.$term_id);//声優の名前を取得
$idol_term = get_field('idol-thum',$term_idmenu.$term_id);//アイドル固有ID（画像のファイル名）を取得
$idol_color = get_field('idol_color',$term_idmenu.$term_id);//アイドルのテーマカラーを取得
$chara = SCF::get_term_meta( $term_id, $taxonomy, 'chara_name' );
//$solo_temp = get_query_var('solo_temp');

if($content == 'cg'){
    $idol_dir = 'cinderella';
}elseif($content == 'ml'){
    $idol_dir = 'millionlive';
}elseif($content == 'cg'){
    $idol_dir = 'shinycolors';
}

//出力
echo '<div class="idol"><a href="'.$link.'"><div class="idolicon" style="background:'.$idol_color.';position: relative;"><img src="'.$upload_dir['baseurl'].'/idol/'.$idol_dir.'/'.$idol_term.'.png"" title="'.$term->term_id.'">';
echo '<p class="fuchidori solo" title="声優名義">声</p>';
echo '</div>';
echo "\n";
echo '<div class="info"><div class="idolname"><a href="'.$link.'">'.esc_html($term->name).'</a></div>';
echo "\n";
echo '<div class="moreinfo">'.$chara.'役</div></div></div>';
echo "\n";
    }
echo "</div>";
}
?>

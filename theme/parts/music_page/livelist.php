<?php $upload_dir = wp_upload_dir(); ?>

<div class="msgbox" id="live">
  <div class="msgboxtop">この曲が披露されたライブ・イベント</div>
  <div class="msgboxbody">
先頭に「<i class="fas fa-compact-disc"></i>」がついているライブは、DVD・BD等の円盤メディアが発売されています。<br>
披露された会場の確認と、円盤の価格確認や購入についてはライブ名のリンク先でできます。
	  <table>
	<tbody>

<?php 
$taxonomy = 'live';
if ($terms = get_the_terms($post->ID, $taxonomy)) {
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームIDを取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」にする
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得
$live_bd = get_field('shop',$term_idmenu.$term_id);
$place = get_field('place',$term_idmenu.$term_id);

//ライブのセットリストをを変数にしまうところ
$setlist = SCF::get_term_meta( $term_id, $taxonomy, 'setlist' );
foreach ($setlist as $fields ) {
	foreach ($fields['setlist_song'] as $songname) {
		if($songname == get_the_ID()){ //入力されている記事のIDと、この曲の記事IDが一緒の場合のみ変数格納を行う
		${"liveidol_".$term_id."_".get_the_ID()} = $fields['setlist_idol']; //アイドルの一覧
		${"livehosoku_".$term_id."_".get_the_ID()} = $fields['setlist_idol_hosoku']; //補足のテキスト
		${"liveunit_".$term_id."_".get_the_ID()} = $fields['unit'];
		}
	  }
}

$media_dir = wp_upload_dir()[baseurl];

//BDの有無を変数にしまうところ
if(empty($live_bd)) {//ライブBD情報が入力されていない場合
$star = '';//一旦空にしないと前のループを引きずるので必要
} else { //ライブBD情報が入力されている場合
$star = '<i class="fas fa-compact-disc"></i>';}//ディスクアイコンを出力する

if(wp_is_mobile()){ //モバイルの場合の出力
echo '<tr><td>'.$star.'</td><td><a href="'.$link.'" title="'.$place.'">'.str_ireplace("THE IDOLM@STER ","", esc_html($term->name)).'</a></td></tr>';
echo "\n";

}else{ //PCの場合の出力	
	echo "\n";
echo '<tr><td>'.$star.'</td>'; //恒常出力
echo '<td><div class="livelist"><a href="'.$link.'">'.str_ireplace("THE IDOLM@STER ","", esc_html($term->name)).'</a>';

	echo '<div class="setlist">';
	echo '<div>開催場所：';
	echo $place;
	echo "</div>\n";

if(!empty(${"liveidol_".$term_id."_".get_the_ID()})){
	$setlistidol_list = explode(',', ${"liveidol_".$term_id."_".get_the_ID()});
	echo "<div>";
	if($setlistidol_list){
		foreach ($setlistidol_list as $idol_name_roop) {
			$live_member[] = idollist($idol_name_roop,"live");
		}
	  
	}
}
echo ${"livehosoku_".$term_id."_".get_the_ID()};
echo '</div></td></tr>';

}
}}
?>

</tbody>
</table>

<?php
if(!empty($live_member)){
	echo '<div class="tab_title">ライブで今まで歌ったことのあるメンバー</div>';
	echo "<div>セットリストとメンバー情報が表示できるライブからのみ取得しています。<br>現在のところ順不同で表示します。</div>";
	foreach ($live_member as $live_member){
	foreach ($live_member as $idol) {
		$idol_out[] = $idol;
				}}

				foreach (array_unique($idol_out, SORT_REGULAR) as $idol){
			idolicon($idol,"live");
		}
	

	}

//	if(!empty($live_unit)){
//		$live_unit_out = array_unique($live_unit, SORT_REGULAR);
//		echo '<div class="tab_title">ライブで今まで歌ったメンバー</div>';
//		echo "<div>セットリストが登録されているライブのみ対応しています。現在のところ順不同で表示します。</div>";
//			foreach ($live_member_out as $idol) {
//			
//			$cv = get_field('cv', $idol);
//			$idol_term = get_field('idol-thum', $idol);
//			$idol_color = get_field('idol_color', $idol);
//			// 結果を出力
//			echo '<a href="' . esc_url( get_term_link( $idol ) ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$dir.'/'.$idol_term.'.png" class="idolicon_cd" style="background:'.$idol_color.';" title="'.$cv.'('.$idol->name.'役)" alt="'.$cv.'('.$idol->name.'役)"></a>';
//		}}
	
					?>

  </div>
  <div class="msgboxfoot">
  </div>
</div>

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
echo '<tr><td>'.$star.'</td><td><a href="'.$link.'" title="'.$place.'">'.esc_html($term->name).'</a></td></tr>';
echo "\n";

}else{ //PCの場合の出力	
	echo "\n";
echo '<tr><td>'.$star.'</td>'; //恒常出力
echo '<td><div class="livelist"><a href="'.$link.'">'.esc_html($term->name).'</a>';

	echo '<div class="setlist">';
	echo '<div>開催場所：';
	echo $place;
	echo "</div>\n";

if(!empty(${"liveidol_".$term_id."_".get_the_ID()})){
	$setlistidol_list = explode(',', ${"liveidol_".$term_id."_".get_the_ID()});
	echo "<div>";
	if($setlistidol_list){
		foreach ($setlistidol_list as $idol_name_roop) {

			$unit_term = get_term_by('name',$idol_name_roop,'unit');
			$term_cin = get_term_by('name',$idol_name_roop,'idol_cg');
			$term_ml = get_term_by('name',$idol_name_roop,'idol_765');
			$term_shiny = get_term_by('name',$idol_name_roop,'idol_shiny');
	  
	  
			//ユニットの場合の処理
			if($unit_term){
			  echo "<div>";
			  $unit_link = get_term_link( $unit_term );
			  $unit_member = get_field('member', $unit_term);
		  
			  //ここからユニットメンバーの出力
			  $idol_list = explode(',', $unit_member);
			  foreach ($idol_list as $unit_idol) {
				if(!empty($unit_idol)){
				$term_cin = get_term_by('name',$unit_idol,'idol_cg');
				$term_ml = get_term_by('name',$unit_idol,'idol_765');
				$term_shiny = get_term_by('name',$unit_idol,'idol_shiny');
		  
				if( $term_cin ){
				  // シンデレラガールズ有無判定 
				$term = $term_cin;
				$dir = 'cinderella';
				}elseif( $term_ml ){
				  //ミリオンライブ有無判定
				$term = $term_ml;
				$dir = 'millionlive';
				}elseif( $term_shiny ){
				  //シャイニーカラーズ有無判定
				$term = $term_shiny;
				$dir = 'shinycolors';
				}
			  
					  // タームのURLを取得
			  $term_link = get_term_link( $term );
					  
			  //カスタムフィールドの取得
					  $cv = get_field('cv', $term);
					  $idol_term = get_field('idol-thum', $term);
					  $idol_color = get_field('idol_color', $term);
					  // 結果を出力
					  echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$dir.'/'.$idol_term.'.png" class="idolicon_cd" style="background:'.$idol_color.';" title="'.$cv.'('.$term->name.'役)" alt="'.$cv.'('.$term->name.'役)"></a>';
			  }}
			  //ここまでユニットメンバーの出力
			  echo '（<a href="' .$unit_link. '">'.$idol_name_roop.'</a>）</div>';
		  
			}elseif($term_cin or $term_ml or $term_shiny){
	  
	  
	  
			//アイドルの場合の処理
	  
			if( $term_cin ){
			  // シンデレラガールズ有無判定 
			$term = $term_cin;
			$dir = 'cinderella';
			}elseif( $term_ml ){
			  //ミリオンライブ有無判定
			$term = $term_ml;
			$dir = 'millionlive';
			}elseif( $term_shiny ){
			  //シャイニーカラーズ有無判定
			$term = $term_shiny;
			$dir = 'shinycolors';
			}
		  
				  // タームのURLを取得
		  $term_link = get_term_link( $term );
				  
		  //場所を取得
				  $cv = get_field('cv', $term);
				  $idol_term = get_field('idol-thum', $term);
				  $idol_color = get_field('idol_color', $term);
				  // 結果を出力
				  echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$dir.'/'.$idol_term.'.png" class="idolicon_cd" style="background:'.$idol_color.';" title="'.$cv.'('.$term->name.'役)" alt="'.$cv.'('.$term->name.'役)"></a>';
		  }else{
			//ユニットでもアイドル名でもない場合はそのまま出力
			echo "<div>".$idol_name_roop."</div>";
		  }
		}
	  
	}

		echo '</div></td></tr>';
}
}
}}
?>

</tbody>
</table>

  </div>
  <div class="msgboxfoot">
  </div>
</div>

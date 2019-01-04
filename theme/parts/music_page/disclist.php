<!-- CD情報用CSS（OSにより分岐） -->
<?php if(wp_is_mobile()): ?>
<style type="text/css">
<!-- スマホ用CSS -->
.cdname{font-size:15px;}
</style>
<?php endif; ?>

<?php if(!wp_is_mobile()): ?>
<!-- PC用CSS -->
<style type="text/css">
.cdname{font-size:20px;}
</style>
<?php endif; ?>
<!-- ここまでCD情報用CSS -->

<!-- CD情報 -->
<div class="msgbox" id="CD">
  <div class="msgboxtop">CD情報</div>
  <div class="msgboxbody">

<?php echo apply_filters('the_content',get_post_meta($post->ID, 'partinfo', true)); //パート分け情報の出力
?>

<!-- すべて操作ボタン -->
<div class="vmenu_all_action" style="text-align: center;">
<span id="button" onclick="doReplaceClassName('vmenu_off', 'vmenu_on')" style="display:inline-block;width:45%;">詳細を全て表示</span>
<span id="button" onclick="doReplaceClassName('vmenu_on',  'vmenu_off')" style="display:inline-block;width:45%;">詳細を全て非表示</span>
</div>

<?php if(get_post_meta($post->ID, 'haishin', true)): ?>
<!-- 配信がある場合の情報 -->
<div class="vmenu_off">
<div class="vmenuitem" onclick="doToggleClassName(getParentObj(this),'vmenu_on','vmenu_off')">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/ipod_icon.png" class="cdicon"><div class="cdname">iTunes等の配信サイトで配信あり</div></div>
<div class="info_C">
<?php 
//アイドル画像出力ループ
foreach (${"cdidol_h_".$kiji_id} as $idol_name_roop) {

if(get_term_by('name',$idol_name_roop,'idol_cg')){ //シンデレラガールズにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_cg');
$thum_dir = 'cinderella';
} elseif (get_term_by('name',$idol_name_roop,'idol_765')){ //ミリオンライブにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_765');
$thum_dir = 'millionlive';
} elseif (get_term_by('name',$idol_name_roop,'idol_283')){ //シャイニーカラーズにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_283');
$thum_dir = 'shinycolors';
} else {
}
        // タームのURLを取得
$term_link = get_term_link( $term );
        
//必要なカスタムフィールドを取得
				$cv = get_field('cv', $term);
				$idol_term = get_field('idol-thum', $term);
				$idol_color = get_field('idol_color', $term);
        // 結果を出力
        echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$thum_dir.'/'.$idol_term.'.png" class="idolicon_cd" style="background:'.$idol_color.';" title="'.$term->name.'(CV.'.$cv.')" alt="'.$term->name.'"></a>';

}
?>
<?php echo apply_filters('the_content',get_post_meta($post->ID, 'haishin', true)); ?></div></div><br>
<?php endif; ?>

<?php 
$taxonomy = 'disc';
if ($terms = get_the_terms($post->ID, $taxonomy)) {
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームIDを取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」にする
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得
$shop = get_field('shop',$term_idmenu.$term_id);//販売情報を取得


//出力
echo '<div class="vmenu_off">';
echo '<div class="vmenuitem" onclick="doToggleClassName(getParentObj(this),\'vmenu_on\',\'vmenu_off\')"><img src="'.get_stylesheet_directory_uri().'/resources/cd_icon.png" class="cdicon"  title="'.$term->term_id.'"><div class="cdname">' . esc_html($term->name) . '</div></div>';
echo "\n";
echo '<div class="info_C"><a href="'.$link.'" id="button" style="text-align:center;display:inline-block;width:100%;">このCDのすべての収録曲を見る</a>';//リンク
echo "\n";

//アイドル画像出力ループ
foreach (${"cdidol_".$term_id."_".$kiji_id} as $idol_name_roop) {

if(get_term_by('name',$idol_name_roop,'idol_cg')){ //シンデレラガールズにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_cg');
$thum_dir = 'cinderella';
} elseif (get_term_by('name',$idol_name_roop,'idol_765')){ //ミリオンライブにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_765');
$thum_dir = 'millionlive';
} elseif (get_term_by('name',$idol_name_roop,'idol_283')){ //シャイニーカラーズにいるか検索
$term = get_term_by('name',$idol_name_roop,'idol_283');
$thum_dir = 'shinycolors';
} else {
}

        // タームのURLを取得
$term_link = get_term_link( $term );
        
//必要なカスタムフィールドを取得
				$cv = get_field('cv', $term);
				$idol_term = get_field('idol-thum', $term);
				$idol_color = get_field('idol_color', $term);
		// 結果を出力
		
        echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl']."/idol/".$thum_dir.'/'.$idol_term.'.png" class="idolicon_cd" style="background:'.$idol_color.';" title="'.$term->name.'(CV.'.$cv.')" alt="'.$term->name.'"></a>';

}

echo $shop;
echo '</div></div><br>';
echo "\n";

    }
}
?>

  </div>
  <div class="msgboxfoot">
  </div>
</div>

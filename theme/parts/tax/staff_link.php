
<div class="msgbox">
<div class="msgboxtop">
<?php
$term_name = single_term_title("", false); //今のタームのタイトルを変数に収納
$term_ly = get_term_by('name',$term_name,'lyrics'); //作詞を検索
$term_co = get_term_by('name',$term_name,'composer'); //作曲を検索
$term_ar = get_term_by('name',$term_name,'arrange'); //編曲を検索
$url_share=get_term_link( $term, $taxonomy );//現在のURLを変数に格納


echo $term_name;
?>さん担当の仕事
</div>

<div class="msgboxbody">
<table style="text-align: center;">
<tr>
<?php
if($term_ly){
$term_link = get_term_link( $term_ly );
echo '<td style="padding: 0px;"><a href="' . esc_url( $term_link ) . '" id="button">作詞</a></td>';
}
?>
<?php
if($term_co){
$term_link = get_term_link( $term_co );
echo '<td style="padding: 0px;"><a href="' . esc_url( $term_link ) . '" id="button">作曲</a></td>';
}
?>
<?php
if($term_ar){
$term_link = get_term_link( $term_ar );
echo '<td style="padding: 0px;"><a href="' . esc_url( $term_link ) . '" id="button">編曲</a></td>';
}
?>
</tr>
</table>

<!--
<h5>絞り込み</h5>
<table style="text-align: center;">
<tr>
<td style="padding: 0px;"><a href="<?php echo $url_share; ?>?post_type=music" id="button">デレ</a></td>
<td style="padding: 0px;"><a href="<?php echo $url_share; ?>?post_type=music_ml" id="button">ミリ</a></td>
<td style="padding: 0px;"><a href="<?php echo $url_share; ?>?post_type=music_shiny" id="button">シャニ</a></td>
</tr>
</table>
-->

</div>
  <div class="msgboxfoot">
  </div>
</div>
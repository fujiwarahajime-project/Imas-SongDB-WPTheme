
<div class="msgbox">
<div class="msgboxtop">
<?php 

$term_name = single_term_title("", false); //今のタームのタイトルを変数に収納
$term_ly = get_term_by('name',$term_name,'lyrics'); //作詞を検索
$term_co = get_term_by('name',$term_name,'composer'); //作曲を検索
$term_ar = get_term_by('name',$term_name,'arrange'); //編曲を検索
$url_share=get_term_link( $term, $taxonomy );//現在のURLを変数に格納

$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得
$meigi = get_field('meigi_name',$term_idmenu.$term_id); //別名義

echo $term_name;
?>さん担当の仕事
</div>

<div class="msgboxbody meigi">
<table style="text-align: center;  margin:0px;">
<tr>
<?php
if($term_ly){
$term_link = get_term_link( $term_ly );
  echo '<td style="padding: 0px;"><a href="' . esc_url( $term_link ) . '" class="button">作詞</a></td>';
  echo PHP_EOL;
}
if($term_co){
$term_link = get_term_link( $term_co );
  echo '<td style="padding: 0px;"><a href="' . esc_url( $term_link ) . '" class="button">作曲</a></td>';
  echo PHP_EOL;
}
if($term_ar){
$term_link = get_term_link( $term_ar );
  echo '<td style="padding: 0px;"><a href="' . esc_url( $term_link ) . '" class="button">編曲</a></td>';
  echo PHP_EOL;
}
echo PHP_EOL;
echo "</tr></table>";
echo PHP_EOL;

if(!empty($meigi)){
  $meigi_list = explode(',', $meigi);
  foreach ($meigi_list as $term_name) {
    $term_ly = get_term_by('name',$term_name,'lyrics'); //作詞を検索
    $term_co = get_term_by('name',$term_name,'composer'); //作曲を検索
    $term_ar = get_term_by('name',$term_name,'arrange'); //編曲を検索
    if($term_ly or $term_co or $term_ar){
      echo '<div class="tab_title">'.$term_name.'名義</div>
      <table style="text-align: center; margin:0px;"><tr>
      ';

  
      if($term_ly){
        $term_link = get_term_link( $term_ly );
        echo '<td style="padding: 0px;"><a href="' . esc_url( $term_link ) . '" class="button">作詞</a></td>
        ';
      }
      if($term_co){
        $term_link = get_term_link( $term_co );
        echo '<td style="padding: 0px;"><a href="' . esc_url( $term_link ) . '" class="button">作曲</a></td>
        ';
      }
      if($term_ar){
        $term_link = get_term_link( $term_ar );
        echo '<td style="padding: 0px;"><a href="' . esc_url( $term_link ) . '" class="button">編曲</a></td>
        ';
      }
      echo "
      </tr></table>
      ";

    }
  }
  echo PHP_EOL;

}
?>

<?php 
/*
<h5>絞り込み</h5>
<table style="text-align: center;">
<tr>
<td style="padding: 0px;"><a href="<?php echo $url_share; ?>?post_type=music" style="button">デレ</a></td>
<td style="padding: 0px;"><a href="<?php echo $url_share; ?>?post_type=music_ml" style="button">ミリ</a></td>
<td style="padding: 0px;"><a href="<?php echo $url_share; ?>?post_type=music_shiny" style="button">シャニ</a></td>
</tr>
</table>
*/
?>

</div>
  <div class="msgboxfoot">
  </div>
</div>
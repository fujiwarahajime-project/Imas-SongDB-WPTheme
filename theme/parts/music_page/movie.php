<div class="msgbox" id="movie">
  <div class="msgboxtop">公式動画</div>
  <div class="msgboxbody">
<?php
$movie = get_post_meta($post->ID, 'movie', true);//公式動画が入力されているか判定
if(!empty($movie)){
	//apply_filtersを実行しないとショートコードが実行されない
	echo apply_filters('the_content',$movie);
}else{
	echo '<p>この曲に動画はありません。</p>';
}?>

  </div>
  <div class="msgboxfoot">
  </div>
</div>
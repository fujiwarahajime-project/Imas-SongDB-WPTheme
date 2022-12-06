<?php 
$count_cin = wp_count_posts('music_cg');
$cin_count = $count_cin->publish;

$count_ml = wp_count_posts('music_ml');
$ml_count = $count_ml->publish;

$count_shiny = wp_count_posts('music_shiny');
$shiny_count = $count_shiny->publish;

$count_as = wp_count_posts('music_as');
$as_count = $count_as->publish;

$count_godo = wp_count_posts('music_godo');
$godo_count = $count_godo->publish;

$count_cover = wp_count_posts('music_cover');
$cover_count = $count_cover->publish;

$count_remix = wp_count_posts('music_remix');
$remix_count = $count_remix->publish;



?>現在の掲載曲数は以下の通りです。<br>
シンデレラガールズ曲：<?php echo $cin_count;?>曲<br>
ミリオンライブ！曲：<?php echo $ml_count;?>曲<br>
シャイニーカラーズ曲：<?php echo $shiny_count;?>曲<br>
765AS曲：<?php echo $as_count;?>曲<br>
合同曲：<?php echo $godo_count;?>曲<br>
カバー曲：<?php echo $cover_count;?>曲<br>
合計：<?php echo $cin_count + $ml_count + $shiny_count + $as_count + $godo_count + $cover_count;?>曲<br>
<br>
リミックス：<?php echo $remix_count;?>
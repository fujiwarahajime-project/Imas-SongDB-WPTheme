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

?>現在の掲載曲数は以下の通りです。<br>
シンデレラガールズ曲：<?php echo $cin_count;?>曲<br>
ミリオンライブ！曲：<?php echo $ml_count;?>曲<br>
シャイニーカラーズ曲：<?php echo $shiny_count;?>曲<br>
765AS曲：<?php echo $as_count;?>曲<br>
合同曲：<?php echo $godo_count;?>曲<br>

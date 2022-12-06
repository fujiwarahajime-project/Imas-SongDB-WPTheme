<?php 
if(is_singular( 'music_remix' )){ //リミックス曲の場合
	//リミックス曲の原曲データを取得
		foreach (get_the_terms($post->ID, 'music') as $term){
			$remix_orig = $term->name;
		}
}

if(has_post_thumbnail($post->ID)){
	$thum = TRUE;
}
if(has_post_thumbnail($remix_orig)){
	$thum_orig = TRUE;
}
if($thum AND $thum_orig){
	echo '<ul class="nav nav-tabs">
	<li class="nav-item">
	  <a href="#arrjac" class="nav-link active" data-toggle="tab">アレンジ</a>
	</li>
	<li class="nav-item">
	  <a href="#orgjac" class="nav-link" data-toggle="tab">原曲</a>
	</li>
  </ul>
  ';
}

	echo '<div style="text-align:center;"><div class="case"><div class="tab-content">';
if($thum AND $thum_orig){
echo '<div id="arrjac" class="img tab-pane active">'.get_the_post_thumbnail( $post->ID, 'large').'</div>';
echo '<div id="orgjac" class="img tab-pane">'.get_the_post_thumbnail( $remix_orig, 'large').'</div>';
}else{
	echo '<div class="img">'.get_the_post_thumbnail( $post->ID, 'large').get_the_post_thumbnail( $remix_orig, 'large').'</div>';
}
	echo '</div></div></div>';
?>

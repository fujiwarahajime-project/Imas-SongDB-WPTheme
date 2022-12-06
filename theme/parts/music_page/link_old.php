<div class="msgbox" id="link">
  <div class="msgboxtop">リンク集</div>

  <div class="msgboxbody" style="text-align: center;">

<!-- リンク集 -->

<div class="tab_wrap">
<input id="tabni" type="radio" name="tab_btn" checked>
<input id="tabtw" type="radio" name="tab_btn">

<div class="tab_area link_label">
<span class="btn_item_5" style="border-top: medium solid thistle;border-left: medium solid thistle;padding:2px 0px 2px 2px;">
	<label class="tabni_label btn_item_in button" for="tabni" style="border-radius:10px 0px 0px 15px;margin:0px;">
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/nico_logo.png" width="25px"></label>
</span>
<span class="btn_item_5" style="border-top: medium solid thistle;border-right: medium solid thistle;padding:2px 2px 2px 0px;">
	<label class="tabtw_label btn_item_in button" for="tabtw" style="border-radius:0px 15px 15px 0px;margin:0px;">
	<i class="fab fa-twitter"></i></label>
</span>
<span class="btn_item_5 under_line">
	<a href="https://www.google.co.jp/search?q=<?php the_title(); ?>" rel="nofollow"  id="" class="btn_item_in button"><i class="fab fa-google"></i></a>
</span>
<span class="btn_item_5 under_line">
	<a href="https://www.pixiv.net/search.php?s_mode=s_tc&amp;word=<?php the_title(); ?>" rel="nofollow"  class="btn_item_in button">
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/pixiv_logo.jpg" width="25px"></a>
</span>
<span class="btn_item_5 under_line">
	<a href="https://www.youtube.com/results?search_query=<?php the_title(); ?>" rel="nofollow" class="btn_item_in button"><i class="fab fa-youtube"></i></a>
</span>
</div>


<div class="panel_area">
<div id="panelni" class="tab_panel">
<!-- niconicoのタブの中身 -->
<p class="tab_title">niconicoでさがす</p>
<div class="tab_area_long">
<?php
$NicoTag = get_post_meta($post->ID,'NicoTag',true);
if(is_singular( 'music_shiny' ) or is_singular( 'music_godo' ) or  is_singular( 'music_cover' )): //シャイニーカラーズまたは合同曲（MVがない）の場合
?>
<a href="http://www.nicovideo.jp/search/<?php the_title(); ?>" rel="nofollow" class="btn_item_long2 button">ワード</a>
<a href="http://www.nicovideo.jp/tag/<?php echo $NicoTag; ?>" rel="nofollow" class="btn_item_long2 button">タグ</a>
<a href="http://dic.nicovideo.jp/a/<?php echo $NicoTag; ?>" rel="nofollow" class="btn_item_long2 button">大百科</a>
<a href="http://www.nicovideo.jp/tag/<?php echo $NicoTag; ?> アイマスRemix" rel="nofollow" class="btn_item_long2 button">Remix</a>
<?php else //シンデレラガールズやミリオンライブの場合
: ?>
<a href="http://www.nicovideo.jp/search/<?php the_title(); ?>" rel="nofollow" class="btn_item_long button">ワード</a>
<a href="http://www.nicovideo.jp/tag/<?php echo $NicoTag; ?>" rel="nofollow" class="btn_item_long button">タグ</a>
<a href="http://dic.nicovideo.jp/a/<?php echo $NicoTag; ?>" rel="nofollow" class="btn_item_long button">大百科</a>
<a href="http://www.nicovideo.jp/tag/<?php echo $NicoTag; ?> アイマスRemix" rel="nofollow" class="btn_item_long button">Remix</a>
<a href="http://www.nicovideo.jp/tag/<?php echo $NicoTag; ?> <?php echo "$MV_Tag"; ?>" rel="nofollow" class="btn_item_long button">MV</a>
<?php endif; ?>
</div>
</div>

<div id="paneltw" class="tab_panel">
<!-- Twitterのタブの中身 -->
<p class="tab_title">Twitterでさがす</p>
<div class="tab_area_long">
<a href="https://twitter.com/search?q=&quot;<?php the_title(); ?>&quot;" rel="nofollow" class="btn_item_long2 button">人気</a>
<a href="https://twitter.com/search?q=&quot;<?php the_title(); ?>&quot;&f=live" rel="nofollow" class="btn_item_long2 button">最新</a>
<a href="https://twitter.com/search?q=&quot;<?php the_title(); ?>&quot;&f=image" rel="nofollow" class="btn_item_long2 button">動画</a>
<a href="https://twitter.com/search?q=&quot;<?php the_title(); ?>&quot;&f=video" rel="nofollow" class="btn_item_long2 button">画像</a>
</div>
</div>

</div>

</div>



<?php $kasi_umu = get_post_meta($post->ID, 'kasi', true);?>
<?php if(!empty($kasi_umu)):?>
	<p class="tab_title">歌詞をみる</p>
	<p><a href="<?php echo get_post_meta($post->ID, 'kasi', true); ?>" rel="nofollow" class="button">歌詞サイトでFULL歌詞を見る</a></p>
<?php endif;?>

  </div>
  <div class="msgboxfoot">
  </div>
</div>

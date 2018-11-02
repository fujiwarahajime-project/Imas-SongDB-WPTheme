<!--
<div class="msgbox">
<div class="msgboxtop"></div>
<div class="msgboxbody">
コンテンツ
</div>
<div class="msgboxfoot"></div>
</div>
-->

<!--
Copyright (c) 2018 by Amanda Ashley (https://codepen.io/coinoperatedgoi/pen/MbeOEN)


Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->
<style>
#tv {
 width:100%;
  border: 10px solid #333;
  border-radius: 15px;
  background-clip: border-box;
  position: relative;
  background: #000;
  margin-bottom:60px;
}
#tv:after,
#tv:before {
  position: absolute;
  content: "";
  background: #333;
}
#tv:after {
  width: 10%;
  height: 50px;
  bottom: -50px;
  left: 50%;
  margin-left: -5%;
}
#tv:before {
  width: 50%;
  height: 10px;
  bottom: -50px;
  left: 50%;
  margin-left: -25%;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
}
.inner {
  overflow: hidden;
  position: relative;
  width: 100%;
  height: 100%;
}
.inner.off {
  -webkit-transform-origin: center;
          transform-origin: center;
}
.program {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 4px;
  overflow: hidden;
  -webkit-animation: glitch 15s infinite;
          animation: glitch 15s infinite;
}
.tv_box{
    position: relative;
    width: 100%;
    height: auto;
    content: "";
    display: block;
    padding-top: calc(9/16*100%);
}

</style>
<div id="tv">
  <div class="inner off tv_box">
    <div class="program">
<!-- テレビの中身のコンテンツ（サイズ可変の16:9固定） -->
<iframe width="100%" height="100%" src="https://www.youtube.com/embed?listType=search&list=title:(ミリオンライブ OR シャイニーカラーズ OR 楽曲試聴) (シンデレラ OR ミリオンライブ OR ゲーム内楽曲) 試聴 (Columbia OR 876TV OR Lantis) -ミリシタ塾 -スペシャル動画 -wilson &controls=2&loop=1&modestbranding=1&showinfo=0" frameborder="0"></iframe>
</div>
  </div>
</div>

<?php 
$count_cin = wp_count_posts('music_cg');
$cin_count = $count_cin->publish;

$count_ml = wp_count_posts('music_ml');
$ml_count = $count_ml->publish;

$count_shiny = wp_count_posts('music_shiny');
$shiny_count = $count_shiny->publish;

$count_as = wp_count_posts('music_as');
$as_count = $count_shiny->publish;

$count_godo = wp_count_posts('music_godo');
$godo_count = $count_shiny->publish;

$count_all = $cin_count + $ml_count + $shiny_count + $as_count + $godo_count;


?>

<div class="prBlocks prBlocks-default row">
<a href="https://fujiwarahaji.me/about/">
<article class="prBlock prBlock_lighnt col-sm-4">
<div class="prBlock_icon_outer">
<i class="fas fa-database font_icon prBlock_icon"></i>
</div>
<h1 class="prBlock_title">About</h1>
<p class="prBlock_summary">アイドルマスターの楽曲をまとめています。<br>現在は<?php echo $count_all;?>曲掲載しています。</p>
</article></a>


<article class="prBlock prBlock_lighnt col-sm-4">
<div class="prBlock_icon_outer">
<i class="fas fa-music font_icon prBlock_icon"></i>
</div>
<h1 class="prBlock_title">Music</h1>
<p class="prBlock_summary">楽曲の検索はナビゲーションの「曲をさがす」からさがせます。</p>
</article>

<a href="https://fujiwarahaji.me/data/">
<article class="prBlock prBlock_lighnt col-sm-4">
<div class="prBlock_icon_outer">
<i class="fas fa-table font_icon prBlock_icon"></i>
</div>
<h1 class="prBlock_title">Data</h1>
<p class="prBlock_summary">表形式でデータをまとめたページがあります。<br>なお、シャイニーカラーズには非対応です。</p>
</article></a>


</div>
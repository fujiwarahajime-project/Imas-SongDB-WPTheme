
<!-- JQuery読み込み -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- SortのJSとCSS -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/sort.js" type="text/javascript"></script>

<script type="text/javascript">

// 絞り込み検索

//Copyright (c) 2022 by tam_yi (https://codepen.io/tam_yi/pen/bLeOaR)
//Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
//The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
//THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

$(function() {
    var $searchInput = $('#textarea'); // 入力エリア
    var $searchElem = $('.list_item'); // 絞り込む要素
    var excludedClass = 'is-hide'; // 絞り込み対象外の要素に付与するclass
 
    // 絞り込み処理
    function extraction() {
        var keywordArr = $searchInput.val().toLowerCase().replace('　', ' ').split(' '); // 入力文字列を配列に格納
        $searchElem.removeClass(excludedClass).show();// 現在非表示にしているリストを表示する
        for (var i = 0; i < keywordArr.length; i++) {
            for (var j = 0; j < $searchElem.length; j++) {
                var thisString = $searchElem.eq(j).text().toLowerCase();
                if(thisString.indexOf(keywordArr[i]) == -1) { // 入力文字列と一致する文字列がない場合
                    $searchElem.eq(j).addClass(excludedClass); // 絞り込み対象外のclass付与
                }
            }
        }
        $('.' + excludedClass).hide(); // 絞り込み対象外の要素の非表示
    }
 
    $searchInput.on('load keyup blur', function() {
        extraction();
    });
    <?php
    if(isset($_GET['word'])){
        echo 'document.getElementById( "textarea" ).value = "'.$_GET['word'].'" ;';
        echo 'extraction();';
    }
    ?>
});
</script>
<style>
.is-hide {
	display: none;
}
.music_cg{
  border-color: var(--cg) !important;
}
.music_ml{
  border-color: var(--ml) !important;
}
.music_shiny{
  border-color: var(--sc) !important;
}
.music_as{
  border-color: var(--as) !important;
}
.music_sidem{
  border-color: var(--sidem) !important;
}
.music_godo{
  border-color: gray !important;
}
.music_cover{
  border-color: purple !important;
}
.music_remix{
  border-color: mistyrose !important;
}
.musiclist .list_item{
  border-style: solid;
  border-width: 0 0 3px 5px !important;
  list-style: none;
  padding:4px;
}
.list_item a{
  text-decoration: unset;
}

/* チェックボックスの色変更 */
.check_cg::before{
  border-color: var(--cg) !important;
  border-width: 3px;
}
.custom-control-input:checked ~ .check_cg::before{
  background-color: var(--cg);
}
.check_ml::before{
  border-color: var(--ml) !important;
  border-width: 3px;
}
.custom-control-input:checked ~ .check_ml::before{
  background-color: var(--ml);
}
.check_sc::before{
  border-color: var(--sc) !important;
  border-width: 3px;
}
.custom-control-input:checked ~ .check_sc::before{
  background-color: var(--sc);
}
.check_as::before{
  border-color: var(--as) !important;
  border-width: 3px;
}
.custom-control-input:checked ~ .check_as::before{
  background-color: var(--as);
}
.check_sidem::before{
  border-color: var(--sidem) !important;
  border-width: 3px;
}
.custom-control-input:checked ~ .check_sidem::before{
  background-color: var(--sidem);
}
.check_jo::before{
  border-color: gray !important;
  border-width: 3px;
}
.custom-control-input:checked ~ .check_jo::before{
  background-color: gray;
}
.check_co::before{
  border-color: purple !important;
  border-width: 3px;
}
.custom-control-input:checked ~ .check_co::before{
  background-color: purple;
}
.check_rm::before{
  border-color: mistyrose !important;
  border-width: 3px;
}
.custom-control-input:checked ~ .check_rm::before{
  background-color: mistyrose;
}
</style>

<form>
<div class="container">
<div class="search-box row">
  <div class="form-check custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="brand" value="music_cg" id="checkcg">
    <label class="custom-control-label check_cg" for="checkcg">シンデレラガールズ曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
    <input type="checkbox" class="custom-control-input" name="brand" value="music_ml" id="checkml">
    <label class="custom-control-label check_ml" for="checkml">ミリオンライブ！曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="brand" value="music_shiny" id="checksc">
    <label class="custom-control-label check_sc" for="checksc">シャイニーカラーズ曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="brand" value="music_as" id="checkas">
    <label class="custom-control-label check_as" for="checkas">765AS曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
    <input type="checkbox" class="custom-control-input" name="brand" value="music_sidem" id="checkm">
    <label class="custom-control-label check_sidem" for="checkm">SideM曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="brand" value="music_godo" id="checkjo">
    <label class="custom-control-label check_jo" for="checkjo">合同曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
    <input type="checkbox" class="custom-control-input" name="brand" value="music_cover" id="checkco">
    <label class="custom-control-label check_co" for="checkco">カバー曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="brand" value="music_remix" id="checkrm">
    <label class="custom-control-label check_rm" for="checkrm">リミックス曲</label>
  </div>
</div>
</div>
</form>

<input type="text" id="textarea" placeholder="曲名で絞り込みできます。" />


<form>
<div class="container">
<div class="search-box row">
  <div class="form-check custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="musictype" value="solo" id="checksolo">
    <label class="custom-control-label" for="checksolo">ソロ曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
    <input type="checkbox" class="custom-control-input" name="musictype" value="unit" id="checkunit">
    <label class="custom-control-label" for="checkunit">ユニット曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="musictype" value="zentai" id="checkzentai">
    <label class="custom-control-label" for="checkzentai">全体曲</label>
  </div>
</div>
</div>
</form>

<div class="musiclist list">
<ul class="listwrap list-group list-group-flush">
<?php
function musictype($id){
  if(!empty($id)){
    $type = get_the_terms($id,'musictype');
    foreach($type as $term){
      $return[] = $term->slug;
    }
  }
  if(!empty($return)){
    return json_encode($return);
  }
}

$paged = (int) get_query_var('paged');
$args = array(
	'posts_per_page' => -1,
	'paged' => $paged,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'post_type' => allsongtype(),
	'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<li class="list-group-item list_item <?php echo get_post_type( $id ); ?>" data-brand="<?php echo get_post_type( $id ); ?>" data-musictype='<?php echo musictype($id);?>'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; endif; ?>
</ul>
</div>

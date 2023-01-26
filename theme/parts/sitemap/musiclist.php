
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
  border-color: var(--cg);
}
.music_ml{
  border-color: var(--ml);
}
.music_shiny{
  border-color: var(--sc);
}
.music_as{
  border-color: var(--as);
}
.music_sidem{
  border-color: var(--sidem);
}
.music_godo{
  border-color: gray !important;
}
.music_cover{
  border-color: purple !important;
}
.music_remix{
  border-color: saddlebrown  !important;
}
.musiclist .list_item{
  border-style: solid;
  border-width: 0 0 3px 5px !important;
  list-style: none;
  padding:4px;
  margin:2px;
}
.list_item a{
  text-decoration: unset;
}

/* チェックボックスの色変更 */
#checkcg{
  border-color: var(--cg);
  border-width: 3px;
}
#checkcg:checked{
  background-color: var(--cg);
}
#checkml{
  border-color: var(--ml);
  border-width: 3px;
}
#checkml:checked{
  background-color: var(--ml);
}
#checksc{
  border-color: var(--sc);
  border-width: 3px;
}
#checksc:checked{
  background-color: var(--sc);
}
#checkas{
  border-color: var(--as);
  border-width: 3px;
}
#checkas:checked{
  background-color: var(--as);
}
#checkm{
  border-color: var(--sidem);
  border-width: 3px;
}
#checkm:checked{
  background-color: var(--sidem);
}
#checkjo{
  border-color: gray;
  border-width: 3px;
}
#checkjo:checked{
  background-color: gray;
}
#checkco{
  border-color: purple;
  border-width: 3px;
}
#checkco:checked{
  background-color: purple;
}
#checkrm{
  border-color: saddlebrown ;
  border-width: 3px;
}
#checkrm:checked{
  background-color: saddlebrown ;
}
</style>

<form>
<div class="container">
<div class="search-box row">
  <div class="p-0 col-6 col-md-3">
		<input type="checkbox" class="form-check-input" name="brand" value="music_cg" id="checkcg">
    <label class="custom-control-label check_cg" for="checkcg">シンデレラガールズ曲</label>
  </div>
  <div class="p-0 col-6 col-md-3">
    <input type="checkbox" class="form-check-input" name="brand" value="music_ml" id="checkml">
    <label class="custom-control-label check_ml" for="checkml">ミリオンライブ！曲</label>
  </div>
  <div class="p-0 col-6 col-md-3">
		<input type="checkbox" class="form-check-input" name="brand" value="music_shiny" id="checksc">
    <label class="custom-control-label check_sc" for="checksc">シャイニーカラーズ曲</label>
  </div>
  <div class="p-0 col-6 col-md-3">
		<input type="checkbox" class="form-check-input" name="brand" value="music_as" id="checkas">
    <label class="custom-control-label check_as" for="checkas">765AS曲</label>
  </div>
  <div class="p-0 col-6 col-md-3">
    <input type="checkbox" class="form-check-input" name="brand" value="music_sidem" id="checkm">
    <label class="custom-control-label check_sidem" for="checkm">SideM曲</label>
  </div>
  <div class="p-0 col-6 col-md-3">
		<input type="checkbox" class="form-check-input" name="brand" value="music_godo" id="checkjo">
    <label class="custom-control-label check_jo" for="checkjo">合同曲</label>
  </div>
  <div class="p-0 col-6 col-md-3">
    <input type="checkbox" class="form-check-input" name="brand" value="music_cover" id="checkco">
    <label class="custom-control-label check_co" for="checkco">カバー曲</label>
  </div>
  <div class="p-0 col-6 col-md-3">
		<input type="checkbox" class="form-check-input" name="brand" value="music_remix" id="checkrm">
    <label class="custom-control-label check_rm" for="checkrm">リミックス曲</label>
  </div>
</div>
</div>
</form>

<input type="text" id="textarea" placeholder="曲名で絞り込みできます。" />


<form>
<div class="container">
<div class="search-box row">
  <div class="p-0 col-6 col-md-3">
		<input type="checkbox" class="form-check-input" name="musictype" value="solo" id="checksolo">
    <label class="custom-control-label" for="checksolo">ソロ曲</label>
  </div>
  <div class="p-0 col-6 col-md-3">
    <input type="checkbox" class="form-check-input" name="musictype" value="unit" id="checkunit">
    <label class="custom-control-label" for="checkunit">ユニット曲</label>
  </div>
  <div class="p-0 col-6 col-md-3">
		<input type="checkbox" class="form-check-input" name="musictype" value="zentai" id="checkzentai">
    <label class="custom-control-label" for="checkzentai">全体曲</label>
  </div>
</div>
</div>
</form>

<?php
if(wp_is_mobile()){
  get_template_part('ad/musiclist');
}?>

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

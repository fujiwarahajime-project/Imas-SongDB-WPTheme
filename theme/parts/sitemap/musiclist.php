<div class="alert alert-info" role="alert">
<a href="./jacket">ジャケット付きの曲一覧</a>もあります。<br>
ただし、キャッシュがない状態で閲覧すると30MB以上のダウンロードが行われます。<br>
情報量が多くグリッド表示する関係もありPC推奨です。
</div>

<!-- JQuery読み込み -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- SortのJSとCSS -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/sort.js" type="text/javascript"></script>

<script type="text/javascript">

// 絞り込み検索

$(function() {
    var $searchInput = $('#textarea'); // 入力エリア
    var $searchElem = $('.item'); // 絞り込む要素
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
  border-color: gray;
}
.music_cover{
  border-color: purple;
}
.music_remix{
  border-color: mistyrose;
}
.item{
  border-width: 0 0 3px 5px !important;
  padding: 0.2em 0.5em 0em !important;
}

</style>
<form>
<div class="container">
<div class="search-box row">
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="musictype" value="music_cg" id="checkcg">
    <label class="custom-control-label" for="checkcg">シンデレラガールズ曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
    <input type="checkbox" class="custom-control-input" name="musictype" value="music_ml" id="checkml">
    <label class="custom-control-label" for="checkml">ミリオンライブ！曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="musictype" value="music_shiny" id="checksc">
    <label class="custom-control-label" for="checksc">シャイニーカラーズ曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="musictype" value="music_as" id="checkas">
    <label class="custom-control-label" for="checkas">765AS曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
    <input type="checkbox" class="custom-control-input" name="musictype" value="music_sidem" id="checkm">
    <label class="custom-control-label" for="checkm">SideM曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="musictype" value="music_godo" id="checkjo">
    <label class="custom-control-label" for="checkjo">合同曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
    <input type="checkbox" class="custom-control-input" name="musictype" value="music_cover" id="checkco">
    <label class="custom-control-label" for="checkco">カバー曲</label>
  </div>
  <div class="custom-control custom-checkbox col-xs-6 col-md-3">
		<input type="checkbox" class="custom-control-input" name="musictype" value="music_remix" id="checkrm">
    <label class="custom-control-label" for="checkrm">リミックス曲</label>
  </div>
</div>
</div>
</form>

<input type="text" id="textarea" placeholder="曲名で絞り込みできます。" />

<div class="musiclist list">
<ul class="listwrap list-group list-group-flush">
<?php
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
<li class="list-group-item list_item item <?php echo get_post_type( $id ); ?>" data-musictype="<?php echo get_post_type( $id ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; endif; ?>
</ul>
</div>

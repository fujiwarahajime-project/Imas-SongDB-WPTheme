<p>現在、データリストは「シャイニーカラーズ曲」以外の楽曲をリスト化するようにしています。<br>
ユニット関係の都合でシャイニーカラーズへの対応予定はまだ未定です。</p>
<p>スクロールバーが表示されませんが、スマートフォンを含め横スクロールに対応しています。</p>
<p>行頭クリックでソートに対応しています。</p>

<!-- 単発使用のCSS -->
<style>
body{
overflow-x:scroll;
}

.music_cg{
  background: #D1C4E9;
}
.music_ml{
  background: #BBDEFB;
}
.music_sc{
  background: #F8BBD0;
}
.music_as{
  background: #F0F4C3;
}
.music_godo{
  background: #E0E0E0;
}

.musiclist {
  display: grid;
  grid-gap: 5px;
  grid-auto-flow: dense;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
}
.item {
  border-radius: 10px;
  padding: 13px;
  text-align: center;
}

</style>

<!-- ソート用のJSを読み込み -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/resources/jquery.tablesorter.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()
{
$("#tablesort").tablesorter();
}
);
</script>

<h3>凡例</h3>
<div class="musiclist">
<div class="item music_cg">シンデレラガールズ曲</div>
<div class="item music_ml">ミリオンライブ曲</div>
<div class="item music_sc">シャイニーカラーズ曲</div>
<div class="item music_as">765AS曲</div>
<div class="item music_godo">合同曲</div>
</div>
<table id="tablesort" class="tablesorter">
<thead>
<tr>
<!--<th class="header">原作</th>-->
<th class="header">曲名</th>
<th class="header">作詞</th>
<th class="header">作曲</th>
<th class="header">編曲</th>
<th class="header">オリジナル</th>
<th class="header">歌詞</th>
<th class="header">ｱｲﾄﾞﾙ</th>
<th class="header">配信</th>
<th class="header">CD数</th>
<th class="header">ﾗｲﾌﾞ数</th>
</tr>
</thead>

<tbody>

<?php
$paged = (int) get_query_var('paged');
$args = array(
	'posts_per_page' => 3000,
	'paged' => $paged,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'post_type' => array('music_cg','music_ml','music_sc','music_as','music_godo'),
	'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<tr class="<?php echo get_post_type( $id ); ?>">
<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
<td><?php echo get_the_term_list( $post->ID, lyrics, '', '<br>', ''); ?></td>
<td><?php echo get_the_term_list( $post->ID, composer, '', '<br>', ''); ?></td>
<td><?php echo get_the_term_list( $post->ID, arrange, '', '<br>', ''); ?></td>
<td><?php echo get_post_meta($post->ID,'orig-artist',true); ?></td>
<td><?php if(get_post_meta($post->ID, 'kasi', true)){
echo "○";
} else {
echo "";
}?></td>
<td><?php
if(!empty(get_the_terms($post->ID,'idol_cg'))){
$cg_count = count(get_the_terms($post->ID,'idol_cg'));}
else {
$cg_count = "0";
}

if(!empty(get_the_terms($post->ID,'idol_765'))){
$ml_count = count(get_the_terms($post->ID,'idol_765'));}
else {
$ml_count = "0";
}

$terms = get_the_terms($post->ID,'idol_sc');
foreach ( $terms as $term ){
if( 0 == $term->parent ){
$sc_temp[item] = 'a';
}}

if(!empty($sc_temp)){
$sc_count = count($sc_temp);
}
else {
$sc_count = "0";
}
echo $cg_count + $ml_count + $sc_count ;
 ?></td>
<td><?php if(get_post_meta($post->ID, 'haishin', true)){
echo "○";
} else {
echo "";
}?></td>
<td><?php
if(!empty(get_the_terms($post->ID,'disc'))){
echo count(get_the_terms($post->ID,'disc'));}
else {
echo "0";
} ?></td>
<td><?php
if(!empty(get_the_terms($post->ID,'live'))){
echo count(get_the_terms($post->ID,'live'));}
else {
echo "0";
} ?></td>
</tr>
<?php endwhile; endif;
wp_reset_postdata();
?> ?>



</tbody></table>
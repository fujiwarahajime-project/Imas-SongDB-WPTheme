<?php
//環境変数類
if(is_singular( 'music_remix' )){ //リミックス曲の場合
	//リミックス曲の原曲データを取得
		foreach (get_the_terms($post->ID, 'music') as $term){
			$remix_id = $term->name;
		}
}

$kiji_id = get_the_ID();
if(empty($remix_id)){
	$remix_id = $kiji_id;
}
$idollist_type = get_post_type($remix_id);

//リミックスの場合データを上書き
if(is_singular( 'music_remix' )){
	$ryakusyou = 'リミックス';
}else{
	$ryakusyou = "アイドルマスター";
}
$site_twitter = 'fujiwarahaji_me';//＠をはぶくこと
$creator_twitter = 'fujiwarahaji_me';//＠をはぶくこと

$url_share=urlencode( get_the_permalink() );
$title_share=urlencode(get_the_title()).'｜'.get_bloginfo('name');

$upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得

?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/no_git.css" type="text/css" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/cd_accordion.js"></script>

<!-- Metaデータ -->
<meta name="description" content="<?php echo "$ryakusyou"; ?>曲「<?php the_title(); ?>」の曲情報です。">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@<?php echo "$site_twitter"; ?>" />
<meta name="twitter:creator" content="@<?php echo "$creator_twitter"; ?>" />
<meta property="og:title" content="「<?php the_title(); ?>」｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo "$ryakusyou"; ?>曲「<?php the_title(); ?>」の曲情報を掲載しています。">
<meta property="og:image" content="<?php if ( has_post_thumbnail() ) {
	$image_id = get_post_thumbnail_id ();
	$image_url = wp_get_attachment_image_src ($image_id, true);
	//echo $image_url[0];
	echo get_stylesheet_directory_uri().'/resources/default.png';

} else {
	//echo get_bloginfo( 'template_directory' ) . '/images/thumbnail.png';
	echo get_stylesheet_directory_uri().'/resources/default.png';

} ?>
">
<meta property="thumbnail" content="<?php if ( has_post_thumbnail() ) {
	$image_id = get_post_thumbnail_id ();
	$image_url = wp_get_attachment_image_src ($image_id, true);
	//echo $image_url[0];
	echo get_stylesheet_directory_uri().'/resources/default.png';

} else {
	echo get_stylesheet_directory_uri().'/resources/default.png';
} ?>
">


	<header>

<!-- タイトル -->
<?php 
if(is_singular( 'music_remix' )){
	//リミックスのときはカテゴリ情報を表示しないやつをヒョビア出す
	get_template_part( 'template-parts/post/meta-remix' );
}else{
	get_template_part( 'template-parts/post/meta' );
}
	 ?>
<?php if (is_object_in_term($post->ID, 'musictype','rearrange') OR is_singular( 'music_remix' ) ){
	//リアレンジ曲の場合ふりがななしのタイトルにする
	echo '<h1><span class="entry-title">'.get_the_title().'</span></h1>';

}elseif(strlen(get_the_title()) > 40){
	//タイトルが長い楽曲（スポ食など）の場合、Rubyタグを使わない
	echo '<span class="ruby">'.get_post_meta($post->ID,'Kana',true).'</span>
	<h1><span class="entry-title">'.get_the_title().'</span></h1>';

}else{

	echo '<h1 class="entry-title"><ruby><rb>'.get_the_title().'</rb>
	<rp>（</rp><rt>'.get_post_meta($post->ID,'Kana',true).'</rt><rp>）</rp></ruby></h1>';
}
?>
	</header>

<?php get_template_part('parts/share'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-body">

<?php if(wp_is_mobile()): ?>

<?php 
	//get_template_part( 'parts/music_page/jacket' );
	get_template_part('parts/music_page/ad'); ?>
<?php endif; //モバイル表示閉じ ?>


<!-- 曲情報 -->
<div class="msgbox">
  <div class="msgboxtop">曲情報</div>
  <div class="msgboxbody" style="overflow:hidden;">
<table class="songinfo">
	<tbody>
		<tr>
			<td>作詞</td>
			<td><?php echo get_the_term_list( $remix_id, 'lyrics', '', '、', ''); ?></td>
		</tr>
		<tr>
			<td>作曲</td>
			<td><?php echo get_the_term_list( $remix_id, 'composer', '', '、', ''); ?></td>
		</tr>
		<tr>
			<td><?php if(is_singular( 'music_remix' )){
				echo 'アレンジ';
			}else{
				echo '編曲';
			}?></td>
			<td><?php echo get_the_term_list( $post->ID, 'arrange', '', '、', ''); ?></td>
		</tr>
		<tr>
			<td>ユニット</td>
			<td><?php echo get_the_term_list( $post->ID, 'unit', '', '<br>', '');?></td>
		</tr>
		<tr>
			<td>オリジナル</td>
			<td><?php echo get_post_meta($post->ID,'orig-artist',true); ?></td>
		</tr>
		<tr>
			<td><?php if(is_singular( 'music_remix' )){
				echo 'アレンジ元</td><td>
				<a href="'.get_permalink( $remix_id ).'">'.get_the_title( $remix_id ).'</a>';
			}else{
				echo 'リアレンジ楽曲</td><td>';
					foreach(get_posts(array(
						'posts_per_page' => 1000,
						'orderby' => 'date',
						'order' => 'DESC',
						'post_type'  => allsongtype(),
						'tax_query' => array(array(
							'taxonomy' => 'music',
							'field' => 'name',
							'terms' => $post->ID,
							'operator' => 'IN'
						))
						))as $post_remix){
							echo '<div><a href="'.get_permalink($post_remix).'">'.$post_remix->post_title.'</a></div>';
						}
			}?></td>
		</tr>

	</tbody>
</table>


<?php
if(!empty(get_post_meta($post->ID, 'kasi', true))){
	echo '<a href="'.get_post_meta($post->ID, 'kasi', true).'" rel="nofollow" class="button">歌詞サイトで歌詞を見る</a>';
}
?>

</div>
  <div class="msgboxfoot">
  </div>
</div>

<div class="msgbox" id="member">
  <div class="msgboxtop">メンバー情報</div>
<div class="msgboxbody">
<?php
//繰り返しフィールド（CDごとのパート情報）を変数にセット
$cd_group = SCF::get( 'CD_group',$id );
foreach ( $cd_group as $field_name => $field_value ) {


$idol_temp =  $field_value['cd_mem'];
foreach ( explode(',', $field_value['cd_solo']) as $idol_solo ) {
	$solo_temp[] = $idol_solo;
}
//CDソロ判定用の配列をつくる
$solo_temp[] = $idol_temp;
set_query_var('solo_temp',$solo_temp);
//CD表示用の配列をつくる
${"cdidol_".$field_value['cd_term']} = array_unique(explode(',', $idol_temp));
${"cdidols_".$field_value['cd_term']} = array_unique(explode(',', $field_value['cd_solo']));
}

//アイドル表示の順番を指定

if($idollist_type == 'music_cg' ){ //シンデレラガールズの場合
	get_template_part('parts/music_page/member/cin');
	get_template_part('parts/music_page/member/765');
	get_template_part('parts/music_page/member/shiny');
	get_template_part('parts/music_page/member/sidem');
} elseif($idollist_type == 'music_shiny' ){ //シャイニーカラーズの場合
	get_template_part('parts/music_page/member/shiny');
	get_template_part('parts/music_page/member/765');
	get_template_part('parts/music_page/member/cin');
	get_template_part('parts/music_page/member/sidem');
} elseif($idollist_type == 'music_sidem' ){ //SideMの場合
	get_template_part('parts/music_page/member/sidem');
	get_template_part('parts/music_page/member/765');
	get_template_part('parts/music_page/member/cin');
	get_template_part('parts/music_page/member/shiny');
} else{ //ミリオンライブ、合同、765ASの場合
	get_template_part('parts/music_page/member/765');
	get_template_part('parts/music_page/member/cin');
	get_template_part('parts/music_page/member/shiny');
}
	//CVはいつも最後に来る
	get_template_part('parts/music_page/member/cv');

?>

<?php
if(!empty($idol_temp)):?>
<p>この曲には、CDごとのメンバー情報があります。くわしくは<a href="#CD">CD情報</a>で確認ください。</p>
<?php endif;?>

</div>
  <div class="msgboxfoot">
  </div>
</div>

<!-- CD情報用CSS（OSにより分岐） -->
<?php if(wp_is_mobile()): ?>
<!-- スマホ用CSS -->
<style type="text/css">
.cdname{font-size:15px;}
</style>
<?php endif; ?>

<?php if(!wp_is_mobile()): ?>
<!-- PC用CSS -->
<style type="text/css">
.cdname{font-size:20px;}
</style>
<?php endif; ?>
<!-- ここまでCD情報用CSS -->

<?php 
	get_template_part('parts/music_page/movie');
?>

<!-- CD情報 -->
<div class="msgbox" id="CD">
  <div class="msgboxtop">CD情報</div>
  <div class="msgboxbody">

<?php echo apply_filters('the_content',get_post_meta($post->ID, 'partinfo', true)); //パート分け情報の出力
?>

<!-- すべて操作ボタン -->
<div class="container">
<div class="vmenu_all_action row justify-content-around" style="text-align: center;">
	<div class="button col-5" onclick="doReplaceClassName('vmenu_off', 'vmenu_on')">詳細 全表示</div>
	<div class="button col-5" onclick="doReplaceClassName('vmenu_on',  'vmenu_off')">詳細 非表示</div>
</div></div>

<?php if(get_post_meta($post->ID, 'haishin', true)): ?>
<!-- 配信がある場合の情報 -->
<div class="vmenu_off">
<div class="vmenuitem" onclick="doToggleClassName(getParentObj(this),'vmenu_on','vmenu_off')">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/ipod_icon.png" class="cdicon"><div class="cdname">iTunes等の配信サイトで配信あり</div></div>
<div class="info_C">
<?php 
//アイドル画像出力ループ
if(!empty($cdidol_h)){
foreach ($cdidol_h as $idol_name_roop) {
	idollist($idol_name_roop,"CD");
}}
if(!empty($cdidols_h)){
foreach ($cdidols_h as $idol_name_roop) {
	idollist($idol_name_roop,"cdsolo");
}}

?>
<?php echo apply_filters('the_content',get_post_meta($post->ID, 'haishin', true)); ?></div></div><br>
<?php endif; ?>
<?php 
$taxonomy = 'disc';
if ($terms = get_the_terms($post->ID, $taxonomy)) {
foreach ( $terms as $term ) {
$term_id = $term->term_id;//タームIDを取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」にする
$link = get_term_link( $term, $taxonomy );//タームのリンクを取得
$shop = get_field('shop',$term_idmenu.$term_id);//販売情報を取得


//出力
echo '<div class="vmenu_off">';
echo '<div class="vmenuitem" onclick="doToggleClassName(getParentObj(this),\'vmenu_on\',\'vmenu_off\')">';
if(!empty(${"cdidol_".$term_id})){
if(count(${"cdidol_".$term_id}) == "1"){
	echo '<img title="'.$term->term_id.'" class="cdicon" src="';
	foreach (${"cdidol_".$term_id} as $idol_name_roop) {
		$icon_data = idolicon($idol_name_roop,"data_only");
		if($icon_data['url'] == $upload_dir['baseurl'].'/idol//.png'){
			echo get_stylesheet_directory_uri().'/resources/cd_icon.png';
		}elseif((isset($icon_data['info'])) == "image" AND ($icon_data['parent'] == 0) AND !($icon_data['production'] == "shinycolors") ){
			echo $icon_data['url'].'" style="background:'.$icon_data['color'];
		}else{
			echo get_stylesheet_directory_uri().'/resources/cd_icon.png';
		}
	}
	echo '">';
}else{

	echo '<img src="'.get_stylesheet_directory_uri().'/resources/cd_icon.png" class="cdicon"  title="'.$term->term_id.'">';

}}else{
	echo '<img src="'.get_stylesheet_directory_uri().'/resources/cd_icon.png" class="cdicon"  title="'.$term->term_id.'">';
}
echo '<div class="cdname">' .str_ireplace("THE IDOLM@STER ","", esc_html($term->name)).'</div></div>';

echo "\n";
echo '<div class="info_C"><a href="'.$link.'" class="button" style="text-align:center;display:inline-block;width:100%;">このCDのすべての収録曲を見る</a>';//リンク
echo "\n";

//アイドル画像出力ループ
if(!empty(${"cdidol_".$term_id})){
foreach (${"cdidol_".$term_id} as $idol_name_roop) {
	idollist($idol_name_roop,"CD");
}}
if(!empty(${"cdidols_".$term_id})){
foreach (${"cdidols_".$term_id} as $idol_name_roop) {
	idollist($idol_name_roop,"cdsolo");
}}


echo $shop;
echo '</div></div><br>';
echo "\n";

    }
}
?>


  </div>
  <div class="msgboxfoot">
  </div>
</div>

<?php get_template_part('parts/music_page/livelist');?>


<!--ここまで-->
<div class="msgbox">
  <div class="msgboxtop">その他情報</div>
  <div class="msgboxbody">
	<?php the_content();//ここがWPの本文とその前後に付随するプラグインの出力先になる。
	get_template_part( 'template-parts/post/next-prev', get_post_type() );
?>
<?php
yarpp_related(array(
	// 関連記事を表示する最大件数
    'limit'    => 5, 
    // ソート順を指定。 ソート順の対象と昇降順（ASCかDESC）を指定
    'order'    => 'score DESC',
    // 使用するテンプレートの名前を指定
    //'template' => 'yarpp-template.php',
		));
?>
  </div>
  <div class="msgboxfoot">
  </div>
</div>


</div>
<?php

/*-------------------------------------------*/
/*  <head>タグ内に自分の追加したいタグを追加する
/*-------------------------------------------*/
function add_wp_head_custom(){ ?>
<!--カスタムフォント-->
<link href="https://fonts.googleapis.com/css?family=Kosugi|Noto+Sans" rel="stylesheet">
<?php
if(!is_tax( 'idol_765' ) and !is_singular('music_cg') and !is_singular('music_ml') and !is_singular('music_shiny') and !is_singular('music_as') and !is_singular('music_godo')){ 
	//ミリオンライブ、singleページ以外の場合、サイトのメインカラーを出力する
    //テーマカラー変更の場合、765のアイドルリストのところにも書いてあるから注意が必要
echo '<meta name="theme-color" content="#7272b4">';
}
?>

<!--bootstrap-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<!--検索タグ-->
<link rel="search" type="application/opensearchdescription+xml" title="ふじわらはじめ" href="<?php echo site_url(); ?>/search/search_main.xml">
<!-- OGP -->
<?php get_template_part('parts/allpage/ogp/core'); ?>
<!-- マニフェスト -->
<?php if (preg_match('/iPhone|iPod|iPad/iu', $_SERVER['HTTP_USER_AGENT'])){
	echo '<link href="/splashscreens/iphone5_splash.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/splashscreens/iphone6_splash.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/splashscreens/iphoneplus_splash.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
	<link href="/splashscreens/iphonex_splash.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
	<link href="/splashscreens/iphonexr_splash.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/splashscreens/iphonexsmax_splash.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
	<link href="/splashscreens/ipad_splash.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/splashscreens/ipadpro1_splash.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/splashscreens/ipadpro3_splash.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/splashscreens/ipadpro2_splash.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	';
	$pwa_manifest = 'PWA_manifest_iOS.json';
}else{
	$pwa_manifest = 'PWA_manifest.json';
} ?>
<link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/resources/<?php echo $pwa_manifest; ?>">
<script>
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('./pwa.js').then(function(registration) {
        console.log('SW OK.');
    }).catch(function(err) {
        console.log('SW Error.');
    });
  }
</script>

<!-- Gアナリティクス -->
	<?php if(!is_user_logged_in()){
		//ログインしているときは出力しない
		echo "<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-101017535-1', 'fujiwarahaji.me');
ga('send', 'pageview');

window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'G-FN2BN6562G');
</script>
".'<script async src="https://www.googletagmanager.com/gtag/js?id=G-FN2BN6562G"></script>

';
	}?>


<script>
// <![CDATA[
var trackOutboundLink = function(url) {
 ga('send', 'event', 'outbound', 'click', url, {
 'transport': 'beacon',
 'hitCallback': function(){document.location = url;}
 });
}
// ]]></script>


<?php } //ここまでheader
add_action( 'wp_head', 'add_wp_head_custom',1);

//footer
function add_wp_footer_custom(){?>

<!--Gアナリティクス アウトバウンド-->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/Gana_outbound_foot.js"></script>

<?php }
add_action( 'wp_footer', 'add_wp_footer_custom', 1 );

// Handle the post_type parameter given in get_terms function
function hoge_terms_clauses($clauses, $taxonomy, $args) {
	if (!empty($args['post_type']))	{
		global $wpdb;

		$post_types = array();
        
        if( $args['post_type'] ){
            foreach($args['post_type'] as $cpt)	{
                $post_types[] = "'".$cpt."'";
            }
        }

	    if(!empty($post_types))	{
			$clauses['fields'] = 'DISTINCT '.str_replace('tt.*', 'tt.term_taxonomy_id, tt.term_id, tt.taxonomy, tt.description, tt.parent', $clauses['fields']).', COUNT(t.term_id) AS count';
			$clauses['join'] .= ' INNER JOIN '.$wpdb->term_relationships.' AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN '.$wpdb->posts.' AS p ON p.ID = r.object_id';
			$clauses['where'] .= ' AND p.post_type IN ('.implode(',', $post_types).')';
			$clauses['orderby'] = 'GROUP BY t.term_id '.$clauses['orderby'];
		}
    }
//     print_r($clauses);exit;
    return $clauses;
}
add_filter('terms_clauses', 'hoge_terms_clauses', 10, 3);

//アイドルアイコン用
function idolicon($name,$listtype){
	$upload_dir = wp_upload_dir();
		if(!empty($name)){
		if( get_term_by('name',$name,'idol_cg') ){
		  // シンデレラガールズ有無判定 
		$term = get_term_by('name',$name,'idol_cg');
		}elseif( get_term_by('name',$name,'idol_765') ){
		  //ミリオンライブ有無判定
		$term = get_term_by('name',$name,'idol_765');
		}elseif( get_term_by('name',$name,'idol_sc') ){
		  //シャイニーカラーズ有無判定
		$term = get_term_by('name',$name,'idol_sc');
		}elseif( get_term_by('name',$name,'idol_315') ){
		//SideM有無判定
		$term = get_term_by('name',$name,'idol_315');
		}

		//ディレクトリ設定
		switch ($term->taxonomy){
			case 'idol_cg':
				$dir = 'cinderella';
				break;
			case 'idol_765':
				$dir = 'millionlive';
				break;
			case 'idol_sc':
				$dir = 'shinycolors';
				break;
			case 'idol_315':
				$dir = 'sidem';
				break;
		}
	  
			  // タームのURLを取得
		if(!is_wp_error( get_term_link( $term ) )){
	  $term_link = get_term_link( $term );
		}
		
		$live_temp = $term->name;

	  //カスタムフィールドの取得
			  $cv = get_field('cv', $term);
			  $idol_term = get_field('idol-thum', $term);
			  $idol_color = get_field('idol_color', $term);
			  // 結果を出力
			  if(!($listtype == "data_only")){
			  echo '<a href="' . esc_url( $term_link ) . '" class="idolicon_link">';
			  }
			  //echo PHP_EOL;

			  if($listtype == "live"){
			  echo '<img src="'.$upload_dir['baseurl'].'/idol/'.$dir.'/'.$idol_term.'.png" class="idolicon '.$idol_term.'" style="background:'.$idol_color.';" title="'.$cv.'('.$term->name.'役)" alt="'.$cv.'('.$term->name.'役)"></a>';
			  }elseif($listtype == "cdsolo"){
				echo '<div class="badge badge-info icon_badge">ソロ</div>
				<img src="'.$upload_dir['baseurl'].'/idol/'.$dir.'/'.$idol_term.'.png" class="idolicon '.$idol_term.'" style="background:'.$idol_color.';" title="'.$term->name.'(CV.'.$cv.')" alt="'.$term->name.'(CV.'.$cv.')"></a>';
			  }elseif($listtype == "data_only"){
				$image_url = $upload_dir['baseurl'].'/idol/'.$dir.'/'.$idol_term.'.png';
				if(empty($idol_term)){
					$image = 'no_image';
				}else{
					$image = 'image';
				}
				return array(
					"url" => $image_url,
					"color" => $idol_color,
					"info" => $image,
					"link" => $term_link,
					"id" => $term->term_id,
					"tax" => $term->taxonomy,
					"cv" => $cv,
					"parent" => $term->patrent,
					"production" => $dir,

				);
  			  }elseif($listtype == "cdicon"){
				echo '<img src="'.$upload_dir['baseurl'].'/idol/'.$dir.'/'.$idol_term.'.png" class="idolicon '.$idol_term.'" style="background:'.$idol_color.';" title="'.$term->name.'(CV.'.$cv.')" alt="'.$term->name.'(CV.'.$cv.')"><p class="fuchidori solo" title="ソロ">S</p></a>';
			  }else{
				echo '<img src="'.$upload_dir['baseurl'].'/idol/'.$dir.'/'.$idol_term.'.png" class="idolicon '.$idol_term.'" style="background:'.$idol_color.';" title="'.$term->name.'(CV.'.$cv.')" alt="'.$term->name.'(CV.'.$cv.')"></a>';
			  }
			  if(!($listtype == "data_only")){
			  echo "<!--
			  -->";
			  }
			}
			if(!empty($live_temp)){
				return $live_temp;
			}
}



//通常利用用
function idollist($idol_name_roop,$listtype){

	if(get_term_by('name',$idol_name_roop,'unit')){
		$unit_term = get_term_by('name',$idol_name_roop,'unit');
	//ユニットの場合の処理
	echo "<div>";
	$unit_link = get_term_link( $unit_term );
	$unit_member = get_field('member', $unit_term);

	//ここからユニットメンバーの出力
	$idol_list = explode(',', $unit_member);
	foreach ($idol_list as $unit_idol) {

		$live_member[] =  idolicon($unit_idol,$listtype);
}
	  //ここまでユニットメンバーの出力
	  echo '（<a href="' .$unit_link. '">'.$idol_name_roop.'</a>）</div>';
	  echo PHP_EOL;


}elseif($listtype == 'getcv'){
	$name = $idol_name_roop;
	if( get_term_by('name',$name,'idol_cg') ){
		// シンデレラガールズ有無判定 
	  $term = get_term_by('name',$name,'idol_cg');
	  }elseif( get_term_by('name',$name,'idol_765') ){
		//ミリオンライブ有無判定
	  $term = get_term_by('name',$name,'idol_765');
	  }elseif( get_term_by('name',$name,'idol_sc') ){
		//シャイニーカラーズ有無判定
	  $term = get_term_by('name',$name,'idol_sc');
	  }elseif( get_term_by('name',$name,'idol_315') ){
		//シャイニーカラーズ有無判定
	  $term = get_term_by('name',$name,'idol_315');
	  }
	  $live_member = get_field('cv', $term);

}elseif(get_term_by('name',$idol_name_roop,'idol_cg') or get_term_by('name',$idol_name_roop,'idol_765') or get_term_by('name',$idol_name_roop,'idol_sc')){
	$live_member[] = idolicon($idol_name_roop,$listtype);

}else{
		//ユニットでもアイドル名でもない場合はそのまま出力
		echo "<div>".$idol_name_roop."</div>";
		echo PHP_EOL;

}
if(!empty($live_member)){
	return $live_member;
}

}

//IME用

// 自動形成しない
//remove_filter('the_content', 'wpautop');
// wptexturizeによる文字列変換をしない
//remove_filter('the_content', 'wptexturize');
remove_filter('the_title'  , 'wptexturize');
//remove_filter('the_excerpt', 'wptexturize');
//remove_filter('comment_text', 'wptexturize');
// convert_charsによる文字列変換をしない
//remove_filter('the_content', 'convert_chars');
remove_filter('the_title'  , 'convert_chars');
//remove_filter('the_excerpt', 'convert_chars');
//remove_filter('comment_text', 'convert_chars');

//iTunes用ショートコード
function itunes($atts) {
    extract(shortcode_atts(array(
		'album_id' => 0,
		'song_id' => 0,
	), $atts));
 
	return
		// 旧iTunesの試聴ウィジェット（もう死んでる） 
		//'<iframe src="https://tools.applemusic.com/embed/v1/song/'.$song_id.'?country=jp&at=1001lM5U" width="100%" height="110px" frameborder="0"></iframe>'
		//.PHP_EOL.
		//iTunesのロゴだけ表示するやつ（味気ない）
		//'<a href="https://music.apple.com/jp/album/'.$album_id.'?i='.$song_id.'&app=itunes&at=1001lM5U" style="display:inline-block;overflow:hidden;background:url(https://linkmaker.itunes.apple.com/ja-jp/badge-lrg.svg?releaseDate=2018-06-27T00:00:00Z&kind=song&bubble=itunes_music) no-repeat;width:140px;height:41px;"></a>'
		// AppleMusicの単曲のやつ（試聴できないけどここらが落とし所）
		//'<iframe src="https://embed.music.apple.com/jp/album/'.$album_id.'?i='.$song_id.'&amp;app=music&amp;itsct=music_box&amp;itscg=30200&amp;at=1001lM5U&amp;ls=1" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation-by-user-activation" allow="autoplay *; encrypted-media *;" style="width: 100%; max-width: 800px; overflow: hidden; border-radius: 10px; background: transparent none repeat scroll 0% 0%;" height="150px" frameborder="0"></iframe>'
		// サブスク配信
		'<iframe allow="autoplay *; encrypted-media *;" style="width:100%;max-width:660px;overflow:hidden;background:transparent;" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-storage-access-by-user-activation allow-top-navigation-by-user-activation" src="https://embed.music.apple.com/jp/album/'.$album_id.'?i='.$song_id.'&app=music" height="150" frameborder="0"></iframe>'
		.PHP_EOL;
}
add_shortcode('itunes', 'itunes');

//Twitter投稿にサムネイルをつけない
//add_filter( 'wpt_upload_media','wpt_nomedia');
function wpt_nomedia(){
	$media = false;
}

//オンガクタイプを返す
function allsongtype() {
	return array('music_cg','music_ml','music_shiny','music_as','music_godo','music_cover','music_sidem','music_remix');
}

//アイドルのタームをすべてまとめて返す
function allidolterm() {
	return array('idol_cg','idol_765','idol_sc','idol_315');
}

//略称
$ryakusyou = "アイドルマスター";

/* BodyにBox用のClassを追加 */

add_filter( 'body_class', 'my_class_names' );
function my_class_names( $classes ) {
	if(is_singular('music_ml') OR is_tax('idol_765') OR is_singular('music_as')){
		$box_class = 'box_765';
	}
	if(is_singular('music_shiny') OR is_tax('idol_sc')){
		$box_class = 'box_sc';
	}
	if(!empty($box_class)){
		$classes[] = $box_class;
	}
	return $classes;
}

//タイトルヘッダの変更
function archive_header($title){
	//ヘッダはここ
	return get_template_part('parts/tax/header/core');
}
add_filter('lightning_archive-header', 'archive_header');

//ターム説明の削除
remove_filter('lightning_archive_description', 'archive_header');

add_action( 'lightning_loop_before', function(){
	if ( is_tax('live') ){
		get_template_part('parts/tax/live_setlist');
	}
});

//G3
//update_option( 'lightning_theme_generation', 'g3' );
function lightning_ver($title){
	return true;
}
//add_filter('lightning_is_g3', 'lightning_ver');

//モジュール
function module($attr) {
	get_template_part($attr["type"]);
}
add_shortcode('module', 'module');

//フロントページの改造
add_filter( 'lightning_is_extend_single', function( $return ){
    if (is_home() || is_front_page()){
		return true;
    }else{
		return false;
	}
});
add_action('lightning_extend_single',function(){
	if(is_home() || is_front_page()){
		get_template_part('parts/toppage');
	}
});

//フッターのカテゴリー一覧削除
add_filter( 'lightning_is_entry_footer', function( $return ){
	return false;
});

//CDページではメインループの出力を逆にする
function disc_loop( $query ) {
	if ( is_tax('disc') ) {
		$query->set('order', 'ASC');
  	}
}
add_action( 'pre_get_posts', 'disc_loop' );


//AmazonJS代替
// functions.php


function amazonLink($atts) {
    $atts = shortcode_atts(array(
        'asin' => '',
		'title' => '',
        'title1' => '関連商品',
    ), $atts);
    return '

<div class="card amazonjs_item m-0">
<div class="amazonjs_info">
<a target="_blank" href="https://www.amazon.co.jp/dp/'.$atts['asin'].'/ref=as_sl_pc_tf_til?tag=fujiwarahajime-22&linkCode=w00&linkId=&creativeASIN='.$atts['asin'].'">
  <div class="row no-gutters">
    <div class="bd-placeholder-img col-auto d-flex align-items-center">
      <img src="//ws-fe.amazon-adsystem.com/widgets/q?_encoding=UTF8&ASIN='.$atts['asin'].'&Format=_SL110_&ID=AsinImage&MarketPlace=JP&ServiceVersion=20070822&WS=1&tag=fujiwarahajime-22&language=ja_JP">
    </div>
    <div class="col">
      <div class="card-body">
        <p class="card-text">「'.$atts['title'].'」をAmazon.co.jpで検索</p>
      </div>
    </div>
  </div>
</a>
</div></div>
';
}
add_shortcode('amazonjs', 'amazonLink');


//CDページ
add_action( 'lightning_loop_before', function(){
	if ( is_tax('disc') ){
		get_template_part('parts/tax/cd_setlist');
	}
});

//サブスク周り
function spotify($atts) {
    extract(shortcode_atts(array(
		'id' => 0,
	), $atts));
 
	return
		'<iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/'.$id.'?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>'
		.PHP_EOL;
}
add_shortcode('spotify', 'spotify');

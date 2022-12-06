<?php
/**
 * Template Name: IME */
?>
!Microsoft IME Dictionary Tool
!Version:
!Format:WORDLIST
!DateTime: <?php echo date('Y年m月d日 H:i');?>

!日時はロード時の時刻をUTCで自動出力します。
!IMEを登録する上で特に意味がないものなので、ずれてても気にしないでください。

!曲名
<?php
$paged = (int) get_query_var('paged');
$args = array(
	'posts_per_page' => 3000,
	'paged' => $paged,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'post_type' => array('music_cg','music_ml','music_shiny','music_as','music_godo','music_cover'),
	'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<?php //準備
if (!(get_post_meta($post->ID,'Kana',true) == "※この記事は仮の記事です。")):?>
<?php
switch ($post->post_type){
	case 'music_cg':
		$music_type = 'アイドルマスターシンデレラガールズの楽曲';
	break;
	case 'music_ml':
		$music_type = 'アイドルマスターミリオンライブ！の楽曲';
	break;
	case 'music_shiny':
		$music_type = 'アイドルマスターシャイニーカラーズの楽曲';
	break;
	case 'music_godo':
		$music_type = 'アイドルマスターのプロジェクトをまたいだ楽曲';
	break;
	case 'music_as':
		$music_type = 'アイドルマスター765ASの楽曲';
	break;
	case 'music_cover':
		$music_type = 'アイドルマスターシリーズでカバーされた楽曲';
	break;	
	case 'music_remix':
		$music_type = 'アイドルマスターシリーズのリミックス楽曲';
	break;	
	case 'music_sidem':
		$music_type = 'アイドルマスターSideMの楽曲';
	break;	
	default:
		$music_type = "アイドルマスターシリーズの楽曲";
	break;
	}

echo preg_replace("/[^ぁ-んーゔ]+/u",'' ,str_replace("ヴ","ゔ",mb_convert_kana( get_field('Kana',$post->ID) , "cH")));
echo "\t";
echo get_the_title();
echo "\t";?>固有名詞<?php echo "\t"; echo $music_type;echo PHP_EOL;?>
<?php endif; endwhile; endif; ?>
<?php wp_reset_query(); ?>

<?php 
// カスタム分類名
$taxonomy = array('idol_765','idol_cg','idol_sc','idol_315');
// パラメータ 
$args = array(
    // 投稿記事がないタームも取得
    'hide_empty' => true,
   //並び順
'orderby' => $orderby,
'order' => DESC,
);

// カスタム分類のタームのリストを取得
$terms = get_terms( $taxonomy , $args );

    // タームのリスト $terms を $term に格納してループ
    foreach ( $terms as $term ) {

//データの取得
if($term->taxonomy == 'idol_sc' AND $term->parent == 0){
	continue;
}
if($term->name == '萩原雪歩.'){
	continue;
}

        		$cv = get_field('cv', $term);
				$CVKana = get_field('CVKana', $term);
				$Kana = get_field('Kana', $term);

				//データを作る
				unset($brand);
				switch($term->taxonomy){
					case 'idol_cg':
						$brand = 'アイドルマスターシンデレラガールズ';
						$id = 10000+$term->term_id;
					break;
					case 'idol_765':
						$brand = 'アイドルマスターミリオンライブ！';
						$id = 20000+$term->term_id;
					break;
					case 'idol_sc':
						$brand = 'アイドルマスターシャイニーカラーズ';
						$id = 30000+$term->term_id;
					break;
					case 'idol_315':
						$brand = 'アイドルマスターSideM';
						$id = 40000+$term->term_id;
					break;
					default:
						$brand = "アイドルマスターシリーズ";
					break;
					}
				
				$idoldata[] =  array(
					'kana' => preg_replace("/[^ぁ-んー]+/u",'' ,mb_convert_kana( $Kana , "cH")),
					'brand' => $brand,
					'name' => $term->name
				);

				if($cv == '未定' OR $cv == '未発表' or empty($cv)){
					continue;
				}
				$cvdata[] = array(
					'kana' => preg_replace("/[^ぁ-んー]+/u",'' ,mb_convert_kana( $CVKana , "cH")),
					'brand' => $brand,
					'name' => $cv,
					'idol' => $term->name
				);

		
//最後の処理
}

echo '!アイドル'.PHP_EOL;
foreach($idoldata as $data){
	echo $data[kana]."\t".$data[name]."\t".'人名'."\t".$data[brand].'のアイドル'.PHP_EOL;
}
echo PHP_EOL.'!声優'.PHP_EOL;
foreach($cvdata as $data){
	echo $data[kana]."\t".$data[name]."\t".'人名'."\t".$data[brand].' '.$data[idol].' 役'.PHP_EOL;
}

?>

!ユニット
<?php 
$terms = get_terms('unit');
foreach ( $terms as $term ) {
	$Kana = get_field('Kana', $term);
	if(empty($Kana)){
		continue;
	}
	echo preg_replace("/[^ぁ-んー]+/u",'' ,mb_convert_kana( $Kana , "cH"))."\t".$term->name."\t".'固有名詞'."\tアイドルマスターシリーズのユニット".PHP_EOL;
}


?>

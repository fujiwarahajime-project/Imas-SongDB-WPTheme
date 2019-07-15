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
	'post_type' => array('music_cg','music_ml','music_sc','music_as','music_godo','music_cover'),
	'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<?php //準備
if (!(get_post_meta($post->ID,'Kana',true) == "※この記事は仮の記事です。")):?>
<?php
echo preg_replace("/[^ぁ-んーゔ]+/u",'' ,str_replace("ヴ","ゔ",mb_convert_kana( get_field('Kana',$post->ID) , "cH")));
echo "\t";
echo get_the_title();
echo "\t";?>固有名詞<?php echo "\t";?>アイドルマスターの楽曲
<?php endif; endwhile; endif; ?>
<?php wp_reset_query(); ?>

<?php /*
// カスタム分類名
$taxonomy = 'idol_765';
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
        		$cv = get_field('cv', $term);
				$CVKana = get_field('CVKana', $term);
				$Kana = get_field('Kana', $term);

				echo preg_replace("/[^ぁ-んー]+/u",'' ,mb_convert_kana( $Kana , "cH"));
				echo "\t";
				echo $term->name;
				echo "\t";
				echo "人名\tアイドルマスターミリオンライブ！のアイドル";
				echo PHP_EOL;
				echo preg_replace("/[^ぁ-んー]+/u",'' ,mb_convert_kana( $CVKana , "cH"));
				echo "\t";
				echo $cv;
				echo "\t";
				echo "人名\tアイドルマスターミリオンライブ！ ".$term->name."役";
				echo PHP_EOL;
		
//最後の処理
} */
?>

<?php

/*-------------------------------------------*/
/*  カスタム投稿タイプ「イベント情報」を追加
/*-------------------------------------------*/
// add_action( 'init', 'add_post_type_event', 0 );
// function add_post_type_event() {
//     register_post_type( 'event', /* カスタム投稿タイプのスラッグ */
//         array(
//             'labels' => array(
//                 'name' => 'イベント情報',
//                 'singular_name' => 'イベント情報'
//             ),
//         'public' => true,
//         'menu_position' =>5,
//         'has_archive' => true,
//         'supports' => array('title','editor','excerpt','thumbnail','author')
//         )
//     );
// }

/*-------------------------------------------*/
/*  カスタム分類「イベント情報カテゴリー」を追加
/*-------------------------------------------*/
// add_action( 'init', 'add_custom_taxonomy_event', 0 );
// function add_custom_taxonomy_event() {
//     register_taxonomy(
//         'event-cat', /* カテゴリーの識別子 */
//         'event', /* 対象の投稿タイプ */
//         array(
//             'hierarchical' => true,
//             'update_count_callback' => '_update_post_term_count',
//             'label' => 'イベントカテゴリー',
//             'singular_label' => 'イベント情報カテゴリー',
//             'public' => true,
//             'show_ui' => true,
//         )
//     );
// }

/********* 備考1 **********
Lightningはカスタム投稿タイプを追加すると、
作成したカスタム投稿タイプのサイドバー用のウィジェットエリアが自動的に追加されます。
プラグイン VK All in One Expansion Unit のウィジェット機能が有効化してあると、
VK_カテゴリー/カスタム分類ウィジェット が使えるので、このウィジェットで、
今回作成した投稿タイプ用のカスタム分類を設定したり、
VK_アーカイブウィジェット で、今回作成したカスタム投稿タイプを指定する事もできます。

/********* 備考2 **********
カスタム投稿タイプのループ部分やサイドバーをカスタマイズしたい場合は、
下記の命名ルールでファイルを作成してアップしてください。
module_loop_★ポストタイプ名★.php
*/

/*-------------------------------------------*/
/*  フッターのウィジェットエリアの数を増やす
/*-------------------------------------------*/
// add_filter('lightning_footer_widget_area_count','lightning_footer_widget_area_count_custom');
// function lightning_footer_widget_area_count_custom($footer_widget_area_count){
//     $footer_widget_area_count = 4; // ← 1~4の半角数字で設定してください。
//     return $footer_widget_area_count;
// }

/*-------------------------------------------*/
/*  <head>タグ内に自分の追加したいタグを追加する
/*-------------------------------------------*/
function add_wp_head_custom(){ ?>
<!-- head内に書きたいコード -->
<!--カスタムフォント-->
<link href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css" rel="stylesheet" />
<?php
if(!is_tax( 'idol_765' ) and !is_singular('music_cg') and !is_singular('music_ml') and !is_singular('music_shiny') and !is_singular('music_as') and !is_singular('music_godo')){ 
	//ミリオンライブ、singleページ以外の場合、サイトのメインカラーを出力する
    //テーマカラー変更の場合、765のアイドルリストのところにも書いてあるから注意が必要
echo '<meta name="theme-color" content="#7272b4">';
}
?>

<!--ボックスの基礎CSS-->
<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/box/main_box.css" rel="stylesheet" />

<!--Gアナリティクス アウトバウンド-->
<script>// <![CDATA[
var trackOutboundLink = function(url) {
 ga('send', 'event', 'outbound', 'click', url, {
 'transport': 'beacon',
 'hitCallback': function(){document.location = url;}
 });
}
// ]]></script>


<?php }
add_action( 'wp_head', 'add_wp_head_custom',1);

function add_wp_footer_custom(){?>

<!-- footerに書きたいコード -->
<!--Gアナリティクス アウトバウンド-->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/Gana_outbound_foot.js"></script>

<?php }
// add_action( 'wp_footer', 'add_wp_footer_custom', 1 );

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


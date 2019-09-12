<style type="text/css">


@media screen and (min-width:641px) {
  /*　横幅1201px以上（PCフル表示などの場合）は3列表示　*/
  .idol {width:50%;}
  .solocolle .idol {width:50%;}
  :root{
  --idolpic: 100px;
  }
  .idolname{
    margin:3px 3px;
  }
  .moreinfo{
    margin:3px 3px;
  }

}

@media screen and (max-width: 640px) { 
  /*　横幅520px以下（スマホなど）は1列表示　*/
  .idol {width:100%;}
  :root{
  --idolpic: 90px;
  }
  .idolname{
    margin:2px 2px;
  }
  .moreinfo{
    margin:7px 7px;
  }
}

@-moz-document url-prefix(){
  /*Firefox*/
  .idolname{
    margin:7px 5px;
  }
  .moreinfo{
    margin:2px 2px;
  }
}

.idollist{/* フレックスボックスにする */
  display: flex;
  flex-wrap: wrap;
}
.idol{/* アイテムの外枠、全体フォントに関する設定 */
  height:calc(var(--idolpic) + 2px);
  border:solid 1px darkgray;
  border-radius:2px;
}
.idolicon{/* アイコンに関する設定（バックグラウンドは、アイドルのテーマカラーを指定しなかったときのみ使用されます） */
  background:linear-gradient(lightgray,gray);
  float:left;
  padding:8px;
  height:var(--idolpic);
  margin-bottom:0px;
  display:block;
}
.idolname{/* アイドルの名前まわりのスタイル設定 */
  font-size:20px;
  border-bottom:dotted 2px gray;
  font-weight: bold;
}

.info{
  margin-left:var(--idolpic);
}

.count{
    text-align: right;
}

.cv{
    float: left;
}

.entry-body h2{
  margin-bottom:0px;
}

.unitpic{
  height:40px;
  margin-right:10px;
}
</style>

<div class="idollist">
<?php
// カスタム分類名
$taxonomy = 'cv';
$upload_dir = wp_upload_dir();
$orderby = 'count';

// パラメータ 
$args = array(
    // 子タームの投稿数を親タームに含める
    'pad_counts' => true,
  
    // 投稿記事がないタームも取得
    'hide_empty' => true,
   //並び順
'orderby' => $orderby,
'order' => DESC,
);

// カスタム分類のタームのリストを取得
$terms = get_terms( $taxonomy , $args );

if ( count( $terms ) != 0 ) {
    // タームのリスト $terms を $term に格納してループ
    foreach ( $terms as $term ) {
    
        // タームのURLを取得
        $term = sanitize_term( $term, $taxonomy );
        $term_link = get_term_link( $term, $taxonomy );
        if ( is_wp_error( $term_link ) ) {
            continue;
        }
//データの取得
$term_id = $term->term_id;//タームID取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ 」の取得

$content = get_field('content',$term_idmenu.$term_id);
if($content == 'cg'){
  $idol_dir = 'cinderella';
}elseif($content == 'ml'){
  $idol_dir = 'millionlive';
}elseif($content == 'cg'){
  $idol_dir = 'shinycolors';
}

$idol_term = get_field('idol-thum', $term);
$idol_color = get_field('idol_color', $term);
$count = $term->count;
$chara = SCF::get_term_meta( $term_id, $taxonomy, 'chara_name' );


        echo '<div class="idol">';
        echo PHP_EOL;
        echo '  <a href="' . esc_url( $term_link ) . '">';
        echo PHP_EOL;
        echo '  <img src="'.$upload_dir['baseurl'].'/idol/'.$idol_dir.'/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';">';
        echo PHP_EOL;
        echo '  <div class="info"><p class="idolname">'.$term->name.'</a></p>';
        echo PHP_EOL;
        echo '  <div class="moreinfo"><p class="cv">'.$chara.'役</p>';
        echo PHP_EOL;
        echo '  <p class="count">'.$count.'</p></div></div>';
        echo PHP_EOL;
        echo '</div>';
        echo PHP_EOL;


//最後の処理
}}
?>
</div>
<?php
get_template_part('sitehensu/godo');

$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得
$place = get_field('place',$term_idmenu.$term_id);//場所の出力
$address =  get_field('address',$term_idmenu.$term_id);

?>

<?php get_header(); ?>

<?php get_template_part('module_pageTit'); ?>
<?php get_template_part('module_panList'); ?>

<div class="section siteContent">
<div class="container">
<div class="row">

<div class="col-md-8 mainSection" id="main" role="main">

<!-- OGP -->
<meta name="description" content="<?php echo $place; ?>で開催のライブ「<?php echo get_the_archive_title();?>」の曲情報です。">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@<?php echo $site_twitter; ?>" />
<meta name="twitter:creator" content="@<?php echo $creator_twitter; ?>" />
<meta property="og:title" content="「<?php echo get_the_archive_title();?>」｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo $place; ?>で開催のライブ「<?php echo get_the_archive_title();?>」の曲情報です。">
<meta property="og:image" content="<?php echo get_stylesheet_directory_uri();?>/resources/mic_icon.png">

<!-- CD情報用CSS（OSにより分岐） -->
<?php if(wp_is_mobile()): ?>
<style type="text/css">
<!-- スマホ用CSS -->
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
<header class="archive-header">
<div class="cdinfo" style="height:auto;">
 <?php
/*-------------------------------------------*/
/*  Archive title
/*-------------------------------------------*/
$page_for_posts = lightning_get_page_for_posts();
// Use post top page（ Archive title wrap to div ）
if ( $page_for_posts['post_top_use'] || get_post_type() != 'post' ) {
  if ( is_year() || is_month() || is_day() || is_tag() || is_author() || is_tax() || is_category() ) {
      $archiveTitle = get_the_archive_title();

      $archiveTitle_html = '<img src="'.get_stylesheet_directory_uri().'/resources/mic_icon.png" class="cdicon"><div class="cdname"><p style="font-weight: bold;border-bottom: dotted 3px gray;margin: 0.3em 0px;">'. $archiveTitle .'</p>開催場所：'.$place.'<br><span Style="font-size: small;">住所：'.$address.'</span><br></div></div></header>';
      echo apply_filters( 'lightning_mainSection_archiveTitle' , $archiveTitle_html );
  }
}

/*-------------------------------------------*/
/*  Archive description
/*-------------------------------------------*/
  if ( is_category() || is_tax() || is_tag() ) {
    $category_description = term_description();
    $page = get_query_var( 'paged', 0 );
    if ( ! empty( $category_description ) && $page == 0 ) {
      $archiveDescription_html = '<div class="archive-meta">' . $category_description . '</div>';
      echo apply_filters( 'lightning_mainSection_archiveDescription' , $archiveDescription_html );
    }
  }

$postType = lightning_get_post_type();

do_action('lightning_loop_before'); ?>
<!-- CD購入情報の表示 -->
<div class="archive-meta">
<?php if ( !is_paged() ) : // 1ページ目のみに表示 ?>
<div class="msgbox">
  <div class="msgboxtop">このライブの映像ディスクを購入する</div>
  <div class="msgboxbody">
<?php
$shop = get_field('shop',$term_idmenu.$term_id);//attachmentIDが出力される
echo $shop; // タームID
  ?>
</div>
  <div class="msgboxfoot">
  </div>
</div>

<!-- セットリスト -->

<?php if(wp_is_mobile()): ?>
<style type="text/css">
<!-- スマホ用CSS -->
.cdname{font-size:15px;}
.idolicon_cd{padding:4px;width:60px;margin-bottom:0px;}
</style>
<?php endif; ?>

<?php if(!wp_is_mobile()): ?>
<!-- PC用CSS -->
<style type="text/css">
.cdname{font-size:20px;}
.idolicon_cd{padding:4px;width:70px;margin-bottom:0px;}
</style>
<?php endif; ?>
<?php $setlist_hantei = count(SCF::get_term_meta( $term_id, $taxonomy, 'setlist' )) >= 2;
  $upload_dir = wp_upload_dir();//WPのアップロードファイルのディレクトリを取得
if($setlist_hantei): ?>

<table><tbody>
<tr><th>曲名</th><th>アイドル</th></tr>
<?php
$setlist = SCF::get_term_meta( $term_id, $taxonomy, 'setlist' );
foreach ($setlist as $fields ) {
echo "<tr>";
  //曲名を表示
  echo '<td style="padding:0px">';
  foreach ($fields['setlist_song'] as $songname) {
     //ターム判定
    if(is_admin_bar_showing()){//WPの管理用ツールバーが表示されているときのみ表示
     $term_search = wp_get_object_terms($songname,'live', array('fields' => 'ids'));
     $term_search_result = in_array($term_id,$term_search,true); //記事に紐付けられているターム一覧と表示中のタームが一致しているものがあるか比較
     if(empty($term_search_result)){ //一致しているものがなかった場合、米印を表示する
     echo '<span style="color:red;">★</span>';
     }
    }
  echo '<a href="'.get_permalink($songname).'">'.get_post($songname)->post_title.'</a>';
  }
  echo $fields['setlist_song2'];
  //ここまで曲名処理
  echo '</td><td style="padding:0px">';
  
  $idol_temp = $fields['setlist_idol'];

  if($fields['setlist_idol']){
  $idol_list = explode(',', $idol_temp);
    foreach ($idol_list as $idol_name_roop) {
      $term_cin = get_term_by('name',$idol_name_roop,'idol_cg');
      $term_ml = get_term_by('name',$idol_name_roop,'idol_765');
      $term_shiny = get_term_by('name',$idol_name_roop,'idol_shiny');
      
      if( $term_cin ){
        // シンデレラガールズ有無判定 
      $term = $term_cin;
      $dir = 'cinderella';
      }elseif( $term_ml ){
        //ミリオンライブ有無判定
      $term = $term_ml;
      $dir = 'millionlive';
      }elseif( $term_shiny ){
        //シャイニーカラーズ有無判定
      $term = $term_shiny;
      $dir = 'shinycolors';
      }
    
            // タームのURLを取得
    $term_link = get_term_link( $term );
            
    //場所を取得
            $cv = get_field('cv', $term);
            $idol_term = get_field('idol-thum', $term);
            $idol_color = get_field('idol_color', $term);
            // 結果を出力
            echo '<a href="' . esc_url( $term_link ) . '"><img src="'.$upload_dir['baseurl'].'/idol/'.$dir.'/'.$idol_term.'.png" class="idolicon_cd" style="background:'.$idol_color.';" title="'.$cv.'('.$term->name.'役)" alt="'.$cv.'('.$term->name.'役)"></a>';
    }
  }
 
echo $fields['setlist_idol_hosoku'];
echo "</td></tr>";
echo PHP_EOL;
}
?>
</tbody></table>
<?php endif; ?>

<?php endif; ?>
<?php get_template_part('share'); ?>
</div>

<div class="postList">

<?php if (have_posts() and !$setlist_hantei) : ?>

  <?php if( apply_filters( 'is_lightning_extend_loop' , false ) ): ?>

    <?php do_action( 'lightning_extend_loop' ); ?>

  <?php elseif (file_exists(get_stylesheet_directory( ).'/module_loop_'.$postType['slug'].'.php') && $postType != 'post' ): ?>

    <?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part('module_loop_'.$postType['slug']); ?>
    <?php endwhile; ?>

  <?php else: ?>

    <?php while ( have_posts() ) : the_post();?>
    <?php get_template_part('module_loop_post_music'); ?>
    <?php endwhile;?>

  <?php endif; // loop() ?>

  <?php
  the_posts_pagination(array (
                          'mid_size'  => 1,
                          'prev_text' => '&laquo;',
                          'next_text' => '&raquo;',
                          'type'      => 'list',
                          'before_page_number' => '<span class="meta-nav screen-reader-text">' . __ ( 'Page', 'lightning' ) . ' </span>'
                      ) );
  ?>

  <?php else: // hove_posts() ?>

  <div class="well"><p><?php _e('No posts.','lightning');?></p></div>

<?php endif; // have_post() ?>

</div><!-- [ /.postList ] -->

<?php do_action('lightning_loop_after'); ?>

</div><!-- [ /.mainSection ] -->

<div class="col-md-3 col-md-offset-1 subSection sideSection">
<?php get_sidebar(get_post_type()); ?>
</div><!-- [ /.subSection ] -->

</div><!-- [ /.row ] -->
</div><!-- [ /.container ] -->
</div><!-- [ /.siteContent ] -->
 <?php get_footer(); ?>

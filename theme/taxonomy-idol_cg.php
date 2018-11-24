<?php
if(is_tax( 'idol_cg' )){ //シンデレラガールズの場合
get_template_part('sitehensu/cinderella');
} elseif(is_tax( 'idol_765' )){ //ミリオンライブの場合
get_template_part('sitehensu/millionlive');
} elseif(is_tax( 'idol_sc' )){ //シャイニーカラーズの場合
get_template_part('sitehensu/shiny');
}
?>


<?php get_header(); ?>

<?php get_template_part('module_pageTit'); ?>
<?php get_template_part('module_panList'); ?>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/box/<?php echo $css_pass; ?>.css" type="text/css" />

<div class="section siteContent">
<div class="container">
<div class="row">

<div class="col-md-8 mainSection" id="main" role="main">

<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」の取得
$idol_term = SCF::get_term_meta( $term_id, $taxonomy, 'idol-thum' );//アイドル固有IDの引き出し
$CV = SCF::get_term_meta( $term_id, $taxonomy, 'cv' );//CVの引き出し
$upload_dir = wp_upload_dir();//アップロードファイルのディレクトリパスを取得
$CVKana = SCF::get_term_meta( $term_id, $taxonomy, 'CVKana' );;//CVのふりがなの引き出し
$Kana = SCF::get_term_meta( $term_id, $taxonomy, 'Kana' );;//アイドル名のふりがなの引き出し
$idol_color = SCF::get_term_meta( $term_id, $taxonomy, 'idol_color' );;//アイドルのイメージカラーの引き出し（値が未入力の場合はCSSのidoliconから引き出します。）
$child_temp = $wp_query->get_queried_object(); //子タームがあるか調べる

?>
<?php if (is_tax( 'idol_sc' ) and $child_temp->parent == 0) : ?>
<!-- ユニットページOGP -->
<meta name="description" content="<?php echo $ryakusyou; ?>のユニット「<?php echo get_the_archive_title();?>」の歌う曲の一覧ページです。">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@<?php echo $site_twitter; ?>" />
<meta name="twitter:creator" content="@<?php echo $creator_twitter; ?>" />
<meta property="og:title" content="ユニット「<?php echo get_the_archive_title();?>」の歌う楽曲｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo $ryakusyou; ?>のユニット「<?php echo get_the_archive_title();?>」の歌う曲の一覧ページです。">
<meta property="og:image" content="<?php echo $upload_dir['baseurl'];?>/idol/<?php echo $idol_pic_pass;?>/unit/<?php echo $idol_term;?>.png">

<?php else : ?>
<!-- 個別アイドルページOGP -->
<meta name="description" content="<?php echo $ryakusyou; ?>で<?php echo $CV;?>さん演じる<?php echo get_the_archive_title();?>の歌う曲の一覧ページです。">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@<?php echo $site_twitter; ?>" />
<meta name="twitter:creator" content="@<?php echo $creator_twitter; ?>" />
<meta property="og:title" content="<?php echo get_the_archive_title();?>（CV.<?php echo $CV;?>）の歌う楽曲｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo $ryakusyou; ?>で<?php echo $CV;?>さん演じる<?php echo get_the_archive_title();?>の歌う曲の一覧ページです。">
<meta property="og:image" content="<?php echo $upload_dir['baseurl'];?>/idol/<?php echo $idol_pic_pass;?>/<?php echo $idol_term;?>.png">
<?php
if(is_tax( 'idol_765' )){ //ミリオンライブ以外の場合、サイトのメインカラーを出力する
echo '<meta name="theme-color" content="'.$idol_color.'">';
}
?>
<?php endif; ?>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/idol.css" type="text/css" />

<header class="archive-header">
 <?php



/*-------------------------------------------*/
/*  Archive title
/*-------------------------------------------*/
$page_for_posts = lightning_get_page_for_posts();


// Use post top page（ Archive title wrap to div ）
if ( $page_for_posts['post_top_use'] || get_post_type() != 'post' ) {
  if ( is_year() || is_month() || is_day() || is_tag() || is_author() || is_tax() || is_category() ) {
      $archiveTitle = get_the_archive_title();

if(!is_tax( 'idol_sc' )){//アイドルプロフィールURL生成
$idol_profile = '<a href="'.$idolinfo_URL.''.$idol_term.'" id="button">'.$idolsyosai_bun.'</a>';
}

//蒼天画廊さん用処理
if(is_tax("idol_765","emilystewart")){//エミリー
  $azure_tag  = "エミリースチュアート";
  }elseif(is_tax("idol_765","rocohanda")){//ロコ
    $azure_tag  = "伴田路子";
  }elseif(is_tax('idol_sc') or is_tax('idol_765')){//ミリオン、シャニマス
    $azure_tag  = $archiveTitle;
  }

  if(!empty($azure_tag)){
    $idol_illust = '<a href="https://azure-gallery.net/?query=imas%3A'.$azure_tag.'" id="button">イラスト検索</a>';
  }

if(is_tax( 'idol_sc' ) and $child_temp->parent == 0){ //子タクソノミーがある（ユニットページの）場合の出力
      $archiveTitle_html = '<div class="idol"><img src="'.$upload_dir['baseurl'].'/idol/'.$idol_pic_pass.'/unit/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';"><div class="info"><div class="idolname">'.$archiveTitle.'</div><div class="moreinfo"><!-- 将来的にユニットページができた場合はここに入力 --></div></div></div>';
}
else{ //子タクソノミーがない（個別アイドルページの）場合の出力
      $archiveTitle_html = '<div class="idol"><img src="'.$upload_dir['baseurl'].'/idol/'.$idol_pic_pass.'/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';"><div class="info"><div class="idolname"><ruby>'.$archiveTitle.'<rt>'.$Kana.'</rt></ruby>(CV.<ruby>'.$CV.'<rt>'.$CVKana.'</rt></ruby>)</div><div class="moreinfo">'.$idol_profile.''.$idol_illust.'</div></div></div>';
}

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
<div class="archive-meta">

<?php get_template_part('share'); ?>

</div>


<div class="postList">

<?php if (have_posts()) : ?>

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

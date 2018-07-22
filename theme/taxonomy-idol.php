<?php get_header(); ?>

<?php get_template_part('module_pageTit'); ?>
<?php get_template_part('module_panList'); ?>

<div class="section siteContent">
<div class="container">
<div class="row">

<div class="col-md-8 mainSection" id="main" role="main">

<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」の取得
$idol_term = get_field('idol-thum',$term_idmenu.$term_id);//アイドル固有IDの引き出し
$CV = get_field('cv',$term_idmenu.$term_id);//CVの引き出し
$upload_dir = wp_upload_dir();//アップロードファイルのディレクトリパスを取得
$CVKana = get_field('CVKana',$term_idmenu.$term_id);//CVのふりがなの引き出し
$Kana = get_field('Kana',$term_idmenu.$term_id);//アイドル名のふりがなの引き出し
$idol_color = get_field('idol_color',$term_idmenu.$term_id);//アイドルのイメージカラーの引き出し（値が未入力の場合はCSSのidoliconから引き出します。）

?>
<!-- OGP -->
<meta name="description" content="ミリマスで<?php echo $CV;?>さん演じる<?php echo get_the_archive_title();?>の歌う曲の一覧ページです。歌詞サイト、ニコ動へのリンク、作詞・作曲・編曲・ユニット名などを掲載しています。">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@fujiwarahaji_me" />
<meta name="twitter:creator" content="@maccha_pie" />
<meta property="og:title" content="<?php echo get_the_archive_title();?>（CV.<?php echo $CV;?>）の歌う楽曲｜ミリマス楽曲DB なんやいねっと">
<meta property="og:description" content="ミリマスで<?php echo $CV;?>さん演じる<?php echo get_the_archive_title();?>の歌う曲の一覧ページです。歌詞サイト、ニコ動へのリンク、作詞・作曲・編曲・ユニット名などを掲載しています。">
<meta property="og:image" content="<?php echo $upload_dir['baseurl'];?>/idol/<?php echo $idol_term;?>.png">

<style type="text/css">.idol{height:134px;width:100%;border:solid 1px darkgray;border-radius:2px;font-family:"Rounded Mplus 1c";}/* アイドル欄の外枠、フォントの設定 */
.idolicon{background:linear-gradient(lightgray,gray);float:left;padding:8px;width:132px;margin-bottom:0px;display:block;}/* アイドルアイコンに関すること */
.idolname{font-size:5vm;margin:7px 5px;border-bottom:dotted 2px gray;font-weight: bold;}/* アイドルの名前に関すること */
@media(min-width:520px){.idolname{font-size:150%;}}
@media(min-width:620px){.idolname{font-size:200%;}}
.moreinfo{margin:7px 7px;}/* MLPリンク */
.info{margin-left:132px;}/* 画像の右側の文章のマージン */</style>

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
      $archiveTitle_html = '<div class="idol"><a href="'.$link.'"><img src="'.$upload_dir['baseurl'].'/idol/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';"><div class="info"><div class="idolname"><ruby>'.$archiveTitle.'<rt>'.$Kana.'</rt></ruby></a>(CV.<ruby>'.$CV.'<rt>'.$CVKana.'</rt></ruby>)</div><div class="moreinfo"></div></div></div>';
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

<?php
get_template_part('sitehensu/godo');

?>

<?php get_header(); ?>

<?php get_template_part('template-parts/page-header'); ?>
<?php get_template_part('template-parts/breadcrumb'); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/disc.css" type="text/css" />

<div class="section siteContent">
<div class="container">
<div class="row">

<div class="col mainSection mainSection-col-two" id="main" role="main">
<!-- OGP -->
<meta name="description" content="アイドルマスター楽曲の収録されたCD「<?php echo get_the_archive_title();?>」の曲情報です。歌詞サイト、ニコ動へのリンク、作詞・作曲・編曲・ユニット名などを掲載しています。">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@<?php echo $site_twitter; ?>" />
<meta name="twitter:creator" content="@<?php echo $creator_twitter; ?>" />
<meta property="og:title" content="<?php echo get_the_archive_title();?>｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="アイドルマスター楽曲の収録されたCD「<?php echo get_the_archive_title();?>」の曲情報です。">
<meta property="og:image" content="<?php echo get_stylesheet_directory_uri();?>/resources/cd_icon.png">


<!-- CD情報用CSS（OSにより分岐） -->
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
<!-- ここまでCD情報用CSS -->
<header class="archive-header">
<div class="cdinfo" style="height:104px;">
 <?php
/*-------------------------------------------*/
/*  Archive title
/*-------------------------------------------*/
$page_for_posts = lightning_get_page_for_posts();
// Use post top page（ Archive title wrap to div ）
if ( $page_for_posts['post_top_use'] || get_post_type() != 'post' ) {
  if ( is_year() || is_month() || is_day() || is_tag() || is_author() || is_tax() || is_category() ) {
      $archiveTitle = get_the_archive_title();
      $archiveTitle_html = '<img src="'.get_stylesheet_directory_uri().'/resources/cd_icon.png" class="cdicon"><div class="cdname" style="font-weight: bold;">'. $archiveTitle .'</div></div></header>';
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
<div class="msgbox">
  <div class="msgboxtop">このCDを購入する</div>
  <div class="msgboxbody">
<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得
$shop = get_field('shop',$term_idmenu.$term_id);//購入情報を取得
echo $shop; // 取得した購入情報を出力
  ?>
</div>
  <div class="msgboxfoot" style="padding:0px;">
  <a id="button" href="https://store-tsutaya.tsite.jp/item/search_result.html?i=213&k=<?php echo  $archiveTitle;?>" target="_blank">TSUTAYA検索</a>
  </div>
</div>

<?php get_template_part('share'); ?>

</div>

<div class="postList">
<?php query_posts($query_string .'&order=asc');//記事を古いものから表示
?>
<?php if (have_posts()) : ?>

  <?php if( apply_filters( 'is_lightning_extend_loop' , false ) ): ?>

    <?php do_action( 'lightning_extend_loop' ); ?>

  <?php elseif (file_exists(get_stylesheet_directory( ).'/module_loop_'.$postType['slug'].'.php') && $postType != 'post' ): ?>

    <?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part('parts/tax/module_loop_music_disc'); ?>
    <?php endwhile; ?>

  <?php else: ?>

    <?php while ( have_posts() ) : the_post();?>
    <?php get_template_part('parts/tax/module_loop_music_disc'); ?>
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

<div class="col subSection sideSection sideSection-col-two">
<?php get_sidebar(get_post_type()); ?>
</div><!-- [ /.subSection ] -->

</div><!-- [ /.row ] -->
</div><!-- [ /.container ] -->
</div><!-- [ /.siteContent ] -->
 <?php get_footer(); ?>

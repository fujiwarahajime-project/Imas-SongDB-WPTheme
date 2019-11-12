<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」の取得

$content = SCF::get_term_meta( $term_id, $taxonomy, 'content' );
if($content == 'cg'){ //シンデレラガールズの場合
get_template_part('sitehensu/cinderella');
} elseif($content == 'ml'){ //ミリオンライブの場合
get_template_part('sitehensu/millionlive');
} elseif($content == 'sc'){ //シャイニーカラーズの場合
get_template_part('sitehensu/shiny');
}
?>


<?php get_header(); ?>

<?php get_template_part('template-parts/page-header'); ?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<?php if(!empty($css_pass)):?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/box/<?php echo $css_pass; ?>.css" type="text/css" />
<?php endif; ?>

<div class="section siteContent">
<div class="container">
<div class="row">

<div class="col mainSection mainSection-col-two" id="main" role="main">

<?php
$idol_term = SCF::get_term_meta( $term_id, $taxonomy, 'idol-thum' );//アイドル固有IDの引き出し
$chara = SCF::get_term_meta( $term_id, $taxonomy, 'chara_name' );
$upload_dir = wp_upload_dir();//アップロードファイルのディレクトリパスを取得

?>
<!-- 声優ページ用OFP -->
<meta name="description" content="<?php echo $ryakusyou; ?>で<?php echo $chara;?>を演じる<?php echo get_the_archive_title();?>さんが声優名義で発表したアイドルマスター曲の一覧です。">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@<?php echo $site_twitter; ?>" />
<meta name="twitter:creator" content="@<?php echo $creator_twitter; ?>" />
<meta property="og:title" content="<?php echo get_the_archive_title();?>さんが声優名義で歌う楽曲｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo $ryakusyou; ?>で<?php echo $chara;?>を演じる<?php echo get_the_archive_title();?>さんが声優名義で発表したアイドルマスター曲の一覧です。">
<meta property="og:image" content="<?php echo $upload_dir['baseurl'];?>/idol/<?php echo $idol_pic_pass;?>/<?php echo $idol_term;?>.png">
<meta property="thumbnail" content="<?php echo $upload_dir['baseurl'];?>/idol/<?php echo $idol_pic_pass;?>/unit/<?php echo $idol_term;?>.png">

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

//アイドルページへのリンク生成
	if( get_term_by('name',$chara,'idol_cg') ){
		// シンデレラガールズ有無判定 
	  $term_idol = get_term_by('name',$chara,'idol_cg');
	  }elseif( get_term_by('name',$chara,'idol_765') ){
		//ミリオンライブ有無判定
	  $term_idol = get_term_by('name',$chara,'idol_765');
	  }elseif( get_term_by('name',$chara,'idol_sc') ){
		//シャイニーカラーズ有無判定
	  $term_idol = get_term_by('name',$chara,'idol_sc');
    }
  if(!empty($term_idol)){
    $idol_link = get_term_link( $term_idol );
    $idol_profile = '<a href="'.$idol_link.'" class="button">アイドル名義の曲</a>';
  }


      $archiveTitle_html = '<div class="idol"><img src="'.$upload_dir['baseurl'].'/idol/'.$idol_pic_pass.'/'.$idol_term.'.png" class="idolicon" style="background:'.$idol_color.';"><div class="info"><div class="idolname">'.$archiveTitle.'('.$chara.'役)</div><div class="moreinfo">'.$idol_profile.''.$idol_illust.'</div></div></div>';

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
    if(is_tax( 'idol_sc' ) and $child_temp->parent == 0){
    echo "<h4>おしらせ</h4>\n";
    echo "こちらのページは、ユニット名義の歌唱ではなくユニットメンバーの誰かが参加している楽曲の一覧になります。<br>\n";
    echo 'ユニット名義で出ている曲については<a href="'.$unitterm_url.'">ユニットページ</a>から探してください。';
    echo "\n";}
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

<div class="col subSection sideSection sideSection-col-two">

<?php if(is_tax( 'idol_sc' ) and $child_temp->parent == 0){

}else{
  get_template_part('parts/tax/actor_disc');
}
?>

<?php get_sidebar(get_post_type()); ?>
</div><!-- [ /.subSection ] -->

</div><!-- [ /.row ] -->
</div><!-- [ /.container ] -->
</div><!-- [ /.siteContent ] -->
 <?php get_footer(); ?>

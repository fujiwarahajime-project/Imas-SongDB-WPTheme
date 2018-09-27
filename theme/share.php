<?php if ( is_tax() ) : ?>
<?php
$url_share=urlencode(get_term_link( $term, $taxonomy ));
$title_share=urlencode(get_the_archive_title()).'｜'.get_bloginfo('name');
?>
<?php endif; ?>

<?php if ( is_singular() ) : ?>
<?php
$url_share=urlencode(get_the_permalink());
$title_share=urlencode(get_the_title()).'｜'.get_bloginfo('name');
?>
<?php endif; ?>


<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/share.css" type="text/css" />
<div class="share">
<a class="twitter_share" href="https://twitter.com/share?url=<?php echo $url_share; ?>&related=<?php echo "$site_twitter"; ?>&text=<?php echo $title_share; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
<a class="facebook_share" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url_share; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
<a class="mastodon_share" href="https://mastoshare.net/post.php?text=<?php echo $title_share; ?>" target="_blank"><i class="fab fa-mastodon"></i></a>
<a class="pocket_share" href="http://getpocket.com/edit?url=<?php echo $url_share; ?>" target="_blank"><i class="fab fa-get-pocket"></i></a>
<a class="hatebu_share" href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $url_share; ?>&title=<?php echo $title_share; ?>" target="_blank"><span>B!</span></a>
<a class="line_share" href="http://line.me/R/msg/text/?<?php echo $title_share; ?>%0D%0A<?php echo $url_share; ?>" target="_blank"><i class="fab fa-line"></i></a>
</div>


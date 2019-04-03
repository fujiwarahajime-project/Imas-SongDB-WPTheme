<ul>
<?php 
$parentId = get_the_ID();
$args = 'posts_per_page=-1&post_type=page&orderby=menu_order&order=asc&post_parent='.$parentId;
query_posts($args);
if (have_posts()) : 
  $count = 1;
  while (have_posts()) : 
    the_post();
    if ( ( $count % 2 ) > 0 ) {
        $layout	= 'odd';
    } else {
        $layout	= 'even';
    } ?>
<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
    $count++;
   endwhile;
endif;
wp_reset_query();
?>
</ul>
<?php
/*
YARPP Template: Fujiwarahajime
Description: ふじわらはじめ記事用
Author: maccha
*/ ?>
<p class="tab_title">関連楽曲</p>
<?php if (have_posts()):?>
作詞・作曲・編曲者や歌唱アイドルから自動で類似した楽曲を表示しています。
<div class="musiclist">
	<?php while (have_posts()) : the_post(); ?>
		<?php if (has_post_thumbnail()):?>
			<a href="<?php the_permalink() ?>" class="item"><?php the_post_thumbnail('thumbnail'); ?><br><?php the_title(); ?></a>
		<?php else:?>
			<a href="<?php the_permalink() ?>" class="item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/resources/load.gif"><br><?php the_title(); ?></a>
		<?php endif; ?>

	<?php endwhile; ?>
</div>

<?php else: ?>
<p>関連情報が見つかりませんでした。<br>ページを更新すると表示される場合があります。</p>
<?php endif; ?>

<!-- JQuery関係 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<link href="<?php echo get_stylesheet_directory_uri(); ?>/resources/jquery.flipster.css" rel="stylesheet" />
<script src="<?php echo get_stylesheet_directory_uri(); ?>/resources/jquery.flipster.min.js"></script>

<!-- FlipStarセッティング -->
<script>
$(function() {
	$('.flipstar').flipster({
		style: 'coverflow',
		start: '1',
    fadeIn: 400,
    loop: true,
    keyboard: true,
    touch: true,
	});
});</script></div>

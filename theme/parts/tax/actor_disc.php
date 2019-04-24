<?php
$term_id = get_queried_object_id(); // タームIDの取得
$associateid = "fujiwarahajime-22";
$keyword = SCF::get_term_meta( $term_id, $taxonomy, 'cv' );
$assoc_width = "auto";
$assoc_height = "600";
?>
<script type="text/javascript">amzn_assoc_ad_type ="responsive_search_widget"; amzn_assoc_tracking_id ="<?php echo $associateid;?>"; amzn_assoc_marketplace ="amazon"; amzn_assoc_region ="JP"; amzn_assoc_placement =""; amzn_assoc_search_type = "search_widget";amzn_assoc_width ="<?php echo $assoc_width;?>"; amzn_assoc_height ="<?php echo $assoc_height;?>"; amzn_assoc_default_search_category ="Music"; amzn_assoc_default_search_key ="<?php echo $keyword;?>";amzn_assoc_theme ="light"; amzn_assoc_bg_color ="FFFFFF"; </script><script src="//z-fe.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1&Marketplace=JP"></script>
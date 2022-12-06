<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得
if ( !empty(get_field('shop',$term_idmenu.$term_id)) ) : // Amazon情報が登録されている場合にのみ表示 ?>
        <?php echo get_field('shop',$term_idmenu.$term_id);//出力 ?>
<?php endif;?>
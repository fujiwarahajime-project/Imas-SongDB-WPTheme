<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得
if ( !empty(get_field('shop',$term_idmenu.$term_id)) ) : // Amazon情報が登録されている場合にのみ表示 ?>
  <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#disc">
    このディスクを購入する
  </button>
  <div id="disc" class="collapse">
    <div class="panel panel-default">
      <div class="panel-body">
        <?php echo get_field('shop',$term_idmenu.$term_id);//出力 ?>
      </div>
    </div>
  </div>
<?php endif;?>
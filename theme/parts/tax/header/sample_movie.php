
<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得

if ( !empty(get_field('sample_movie',$term_idmenu.$term_id)) ) : // Amazon情報が登録されている場合にのみ表示 ?>
    <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#sample">
      公式動画
    </button>
    <div id="sample" class="collapse">
      <div class="panel panel-default">
        <div class="panel-body">
          <?php echo get_field('sample_movie',$term_idmenu.$term_id);//出力 ?>
          </div>
      </div>
    </div>
  <?php endif;?>

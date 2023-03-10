<?php
//セットリストから記事に反映するやつです。

if(is_admin_bar_showing()){
if(is_tax('disc')){
    $fieldname = 'cd_setlist';
}elseif(is_tax('live')){
    $fieldname = 'setlist';
}

echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#setlist_link_modal">セットリストを記事に反映</button>';
echo '<div class="modal fade" id="setlist_link_modal" tabindex="-1" aria-labelledby="setlist_link_modal_label" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="setlist_link_modal_label">実行確認</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      セットリストを記事のタームに反映します。<br>
      <strong>！利用前にかならず確認！</strong><br>
      入力されているセットリストは正しいですか？<br>
      すべての曲を一括追加していいですか？<br>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
      <a type="button" class="btn btn-danger" href="'.get_term_link(get_queried_object_id(), $taxonomy).'?setlist_link=1">実行</a>
    </div>
  </div>
</div>
</div>';
if($_GET['setlist_link']){
$setlist = SCF::get_term_meta( get_queried_object_id(), $taxonomy, $fieldname );
foreach ($setlist as $number => $fields ) {
    foreach ($fields['setlist_song'] as $songname) {
        $setlist_id[] = $songname;
    }
}
$setlist_id = array_unique($setlist_id);
echo '<div style="border:10px solid red;">';
echo '<p>'.get_term( get_queried_object_id(), $taxonomy )->name.'を以下の記事に反映しました。';
foreach($setlist_id as $setlist_id){
    wp_set_post_terms( $setlist_id, get_term( get_queried_object_id(), $taxonomy )->name , $taxonomy, TRUE );
    echo '<div><a href="'.get_permalink($setlist_id).'">'.get_post($setlist_id)->post_title.'</a>（'.$setlist_id.'）</div>';
}
echo '</div>';

//最後はジャンプ
header("Location: ".get_term_link(get_queried_object_id(), $taxonomy));
}
}

?>
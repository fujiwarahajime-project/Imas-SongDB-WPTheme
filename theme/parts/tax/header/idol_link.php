<?php
//セットリスト検索リンク
echo '<a href="'.get_permalink( 3105 ).'?word='.get_the_archive_title().'" class="button">セットリスト検索</a>';

//声優名義リンク
$term_id = get_queried_object_id(); // タームIDの取得
$CV = SCF::get_term_meta( $term_id, $taxonomy, 'cv' );
if(get_term_by('name',$CV,'cv')){
    $cv_link = get_term_link( get_term_by('name',$CV,'cv') );
    echo '<a href="'.$cv_link.'" class="button">声優名義の曲</a>';
  }

?>
<?php
$term_id = get_queried_object_id(); // タームIDの取得

if(!empty(SCF::get_term_meta( $term_id, $taxonomy, 'spotify_albumid' )) OR !empty(SCF::get_term_meta( $term_id, $taxonomy, 'amazon_albumid' ))){
    echo '<div class="d-flex bd-highlight text-center">サブ<br>スク';

if(!empty(SCF::get_term_meta( $term_id, $taxonomy, 'spotify_albumid' ))){
    echo '<div class="p-2 flex-fill bd-highlight">
    <a class="btn btn-outline-info btn-block" role="button" href="https://open.spotify.com/album/'.SCF::get_term_meta( $term_id, $taxonomy, 'spotify_albumid' ).'">
    <i class="fa-brands fa-spotify"></i><i class="fa-solid fa-arrow-up-right-from-square"></i>
    </a></div>';
  }
if(!empty(SCF::get_term_meta( $term_id, $taxonomy, 'amazon_albumid' ))){
    echo '<div class="p-2 flex-fill bd-highlight">
    <a class="btn btn-outline-info btn-block" role="button" href="https://www.amazon.co.jp/dp/'.SCF::get_term_meta( $term_id, $taxonomy, 'amazon_albumid' ).'/ref=as_sl_pc_tf_til?tag=fujiwarahajime-22&linkCode=w00&linkId=&creativeASIN='.SCF::get_term_meta( $term_id, $taxonomy, 'amazon_albumid' ).'">
    <i class="fa-brands fa-amazon"></i><i class="fa-solid fa-arrow-up-right-from-square"></i>
    </a></div>';
  }
echo '</div>';
}
?>

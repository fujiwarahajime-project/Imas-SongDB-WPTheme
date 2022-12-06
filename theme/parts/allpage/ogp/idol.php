<?php 
$term_id = get_queried_object_id(); // タームIDの取得
$queried_object = get_queried_object();
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」の取得
$idol_term = SCF::get_term_meta( $term_id, $taxonomy, 'idol-thum' );//アイドル固有IDの引き出し
$CV = SCF::get_term_meta( $term_id, $taxonomy, 'cv' );//CVの引き出し
$upload_dir = wp_upload_dir();//アップロードファイルのディレクトリパスを取得
$CVKana = SCF::get_term_meta( $term_id, $taxonomy, 'CVKana' );;//CVのふりがなの引き出し
$Kana = SCF::get_term_meta( $term_id, $taxonomy, 'Kana' );;//アイドル名のふりがなの引き出し
$idol_color = SCF::get_term_meta( $term_id, $taxonomy, 'idol_color' );;//アイドルのイメージカラーの引き出し（値が未入力の場合はCSSのidoliconから引き出します。）
$child_temp = $wp_query->get_queried_object(); //子タームがあるか調べる

switch($queried_object->taxonomy){
    case 'idol_cg':
        $ryakusyou = "シンデレラガールズ";
        $idol_pic_pass = "cinderella";
        break;
    case 'idol_765':
        $ryakusyou = "ミリオンライブ！";
        $idol_pic_pass = 'millionlive';
        break;
    case 'idol_sc':
        $ryakusyou = "シャイニーカラーズ";
        $idol_pic_pass = 'shinycolors';
        break;
    case 'idol_315':
        $ryakusyou = "SideM";
        $idol_pic_pass = 'sidem';
        break;

}
?>
<?php if (is_tax( 'idol_sc' ) and $child_temp->parent == 0) : ?>
<!-- ユニットページOGP -->
<meta name="description" content="<?php echo $ryakusyou; ?>のユニット「<?php echo get_the_archive_title();?>」の歌う曲の一覧ページです。">
<meta name="twitter:card" content="summary" />
<meta property="og:title" content="ユニット「<?php echo get_the_archive_title();?>」の歌う楽曲｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo $ryakusyou; ?>のユニット「<?php echo get_the_archive_title();?>」の歌う曲の一覧ページです。">
<meta property="og:image" content="<?php echo $upload_dir['baseurl'];?>/idol/<?php echo $idol_pic_pass;?>/unit/<?php echo $idol_term;?>.png">
<meta property="thumbnail" content="<?php echo $upload_dir['baseurl'];?>/idol/<?php echo $idol_pic_pass;?>/unit/<?php echo $idol_term;?>.png">

<?php else : ?>
<!-- 個別アイドルページOGP -->
<meta name="description" content="<?php echo $ryakusyou; ?>で<?php echo $CV;?>さん演じる<?php echo get_the_archive_title();?>の歌う曲の一覧ページです。">
<meta name="twitter:card" content="summary" />
<meta property="og:title" content="<?php echo get_the_archive_title();?>（CV.<?php echo $CV;?>）の歌う楽曲｜<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php echo $ryakusyou; ?>で<?php echo $CV;?>さん演じる<?php echo get_the_archive_title();?>の歌う曲の一覧ページです。">
<meta property="og:image" content="<?php echo $upload_dir['baseurl'];?>/idol/<?php echo $idol_pic_pass;?>/<?php echo $idol_term;?>.png">
<meta property="thumbnail" content="<?php echo $upload_dir['baseurl'];?>/idol/<?php echo $idol_pic_pass;?>/<?php echo $idol_term;?>.png">

<?php
if(is_tax( 'idol_765' )){ //ミリオンライブ以外の場合、サイトのメインカラーを出力する
echo '<meta name="theme-color" content="'.$idol_color.'">';
}
?>
<?php endif; ?>

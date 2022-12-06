<?php
//APIのエンドポイント指定
$endpoint = 'https://api.fujiwarahaji.me/v2/';

if(is_singular(array('music_cg','music_ml','music_shiny','music_as','music_godo','music_cover'))){
    //曲の場合
    $api_url = $endpoint.'music?id='.$id;
}
elseif(is_tax(array('idol_cg','idol_765','idol_sc','live','lyrics','composer','arrange','disc','unit'))){
    //タームの場合
    $api_url = $endpoint.'tax?id='.get_queried_object_id();
}elseif(is_page(355)){
    $api_url = $endpoint.'list?type=music';
}elseif(is_page(374)){
    $api_url = $endpoint.'list?type=disc';
}elseif(is_page(363)){
    $api_url = $endpoint.'list?type=unit';
}elseif(is_page(359)){
    $api_url = $endpoint.'list?type=idol';
}elseif(is_page(881)){
    $api_url = $endpoint.'list?type=live';
}elseif(is_page(355)){
    $api_url = $endpoint.'list?type=music';
}elseif(is_page(368)){
    $api_url = $endpoint.'list?type=lyrics';
}elseif(is_page(370)){
    $api_url = $endpoint.'list?type=composer';
}elseif(is_page(372)){
    $api_url = $endpoint.'list?type=arrange';
}elseif(is_page(2852)){
    $api_url = $endpoint.'list?type=idol&production=cg';
}elseif(is_page(2854)){
    $api_url = $endpoint.'list?type=idol&production=765';
}elseif(is_page(2856)){
    $api_url = $endpoint.'list?type=idol&production=sc';
}

if(!empty($api_url) AND !wp_is_mobile()){
    echo '<a href="';
    echo $api_url;
    echo '" class="button button_block"  onClick="ga'."('send','event','pc','click','api')".';">JSON形式でデータを表示</a>';
}
?>

<?php
/*if(is_post_type_archive(allsongtype())){
    get_template_part('parts/allpage/ogp/music');
    ミュージックページのほうにOGPを書いてある
}else*/if(is_tax(allidolterm())){
    get_template_part('parts/allpage/ogp/idol');
}elseif(is_tax("live")){
    get_template_part('parts/allpage/ogp/live');
}elseif(is_tax("disc")){
    get_template_part('parts/allpage/ogp/disc');
}elseif(is_tax(array("lyrics","composer","arrange"))){
    get_template_part('parts/allpage/ogp/staff');
}

?>
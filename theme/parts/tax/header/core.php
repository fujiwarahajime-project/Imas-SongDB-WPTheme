<?php
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得

switch ($taxonomy){
    case 'lyrics':
    case 'composer':
    case 'arrange':
        $title = get_taxonomy($taxonomy)->label.'：'.get_the_archive_title();
        $pic = get_stylesheet_directory_uri().'/resources/note_icon.png';
        $parts[] = 'parts/tax/header/staff_link';
        if(wp_is_mobile()){
            $parts[] = 'ad/musiclist';
        }
        break;
    case 'disc':
        $pic = get_stylesheet_directory_uri().'/resources/cd_icon.png';
        $parts = array('parts/tax/header/buy');
        break;
    case 'live':
        preg_match('/\d{4}\-\d{1,2}\-\d{1,2}/' , get_the_archive_title(), $date_match);
        $day = preg_replace('/(\d{4})\-(\d{1,2})\-(\d{1,2})/', '$1年$2月$3日' , array_shift($date_match)) ;

        $pic = get_stylesheet_directory_uri().'/resources/mic_icon.png';
        $title = preg_replace('/\d{4}\-\d{1,2}\-\d{1,2}/', '' , get_the_archive_title() );
        $text = '開催日：'.$day.'<br>開催場所：'.get_field('place',$term_idmenu.$term_id).'<br>';
        $parts = array('parts/tax/header/buy','parts/tax/header/sample_movie','parts/tax/header/unit_member','parts/tax/live_markup','ad/musiclist');
        break;
    case 'unit':
        if(!empty(SCF::get_term_meta( $term_id, $taxonomy, 'Kana' ))){
            $title = '<ruby>'.get_the_archive_title().'<rt>'.SCF::get_term_meta( $term_id, $taxonomy, 'Kana' ).'</rt></ruby>';
        }
        $pic = get_stylesheet_directory_uri().'/resources/mic_icon.png';
        $parts[] = 'parts/tax/header/unit_member';
        break;
    case 'idol_cg':
    case 'idol_765':
    case 'idol_sc':
    case 'idol_315':
        $title = '<ruby>'.get_the_archive_title().'<rt>'.SCF::get_term_meta( $term_id, $taxonomy, 'Kana' ).'</rt></ruby>';
        $text = 'CV:<ruby>'.SCF::get_term_meta( $term_id, $taxonomy, 'cv' ).'<rt>'.SCF::get_term_meta( $term_id, $taxonomy, 'CVKana' ).'</rt></ruby>';
        //ディレクトリ設定
		switch ($taxonomy){
			case 'idol_cg':
				$dir = 'cinderella';
				break;
			case 'idol_765':
				$dir = 'millionlive';
				break;
			case 'idol_sc':
				$dir = 'shinycolors';
				break;
			case 'idol_315':
				$dir = 'sidem';
				break;
		}
        $upload_dir = wp_upload_dir();
        $pic = $upload_dir['baseurl'].'/idol/'.$dir.'/'.SCF::get_term_meta( $term_id, $taxonomy, 'idol-thum' ).'.png';
        $color = SCF::get_term_meta( $term_id, $taxonomy, 'idol_color' );
        $parts[] = 'parts/tax/header/idol_link';
        if(wp_is_mobile()){
            $parts[] = 'ad/musiclist';
        }
        break;
        
}



//デフォルトテンプレート
if(empty($not_default)){

        //準備
        //画像用のバックカラー
        if(empty($color)){
            $color = "";
        }else{
            $color = 'style="background:'.$color.';".';
        }
        //画像
        if(!empty($pic)){
            $pic = '<div class="bd-placeholder-img col-auto tax_icon d-flex align-items-center" '.$color.'>
            <img src="'.$pic.'">
            </div>';
        }else{
            $pic ="";
        }
        //タイトル
        if(empty($title)){
            $title = get_the_archive_title();
        }
        //テキスト
        if(empty($text)){
            $text = "";
        }
        if(empty($add_text)){
            $add_text = "";
        }

        //出力
        echo '<div class="card tax_header">
        <div class="row no-gutters">'.$pic.
          '          
          <div class="col">
            <div class="card-body">
              <h5 class="card-title">'.$title.'</h5>
              <div class="card-text">'.$text.'</div>
            </div>
          </div>
        </div>
      </div>'.$add_text;
      get_template_part('parts/share');
      if(!empty($parts)){
          foreach($parts as $parts){
            get_template_part($parts);
          }
      }

}
?>
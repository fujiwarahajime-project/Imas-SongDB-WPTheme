<?php 
$term_id = get_queried_object_id(); // タームIDの取得
$term_idmenu = $taxonomy.'_'; //「taxonomyname_ + termID」を取得

$title = preg_replace('/\d{4}\-\d{1,2}\-\d{1,2}\s/', '' , get_the_archive_title() );

preg_match('/\d{4}\-\d{1,2}\-\d{1,2}/' , get_the_archive_title(), $date_match);
$day = array_shift($date_match);

$place = get_field('place',$term_idmenu.$term_id);
$address =  get_field('address',$term_idmenu.$term_id);

//分割用正規表現
//https://qiita.com/zakuroishikuro/items/066421bce820e3c73ce9より
$address_split = '/(...??[都道府県])((?:旭川|伊達|石狩|盛岡|奥州|田村|南相馬|那須塩原|東村山|武蔵村山|羽村|十日町|上越|富山|野々市|大町|蒲郡|四日市|姫路|大和郡山|廿日市|下松|岩国|田川|大村|宮古|富良野|別府|佐伯|黒部|小諸|塩尻|玉野|周南)市|(?:余市|高市|[^市]{2,3}?)郡(?:玉村|大町|.{1,5}?)[町村]|(?:.{1,4}市)?[^町]{1,4}?区|.{1,7}?[市町村])(.+)/u';

preg_match_all($address_split , $address , $address_temp);

//都道府県
$address1 = $address_temp[1][0];
$address2 = $address_temp[2][0];
$address3 = $address_temp[3][0];

//ライブのCVを取得する
$idol_temp = get_field('member',$term_idmenu.$term_id);
  $idol_list = explode(',', $idol_temp);
  foreach ($idol_list as $idol_name_roop) {
    unset($member_temp);
    $member_temp = idollist($idol_name_roop,"getcv");
    if(empty($member_temp)){
      $member_temp = $idol_name_roop;
    }
    $live_member[] = array(
      '@type' => 'Person',
      'name' => $member_temp,
      );
  }

//JSON用の配列をつくる
$json_data = array(
  '@context' => 'https://schema.org',
  '@type' => 'Event',
  'name' => $title,
  'startDate' => $day,
  'endDate' => $day,
  'location' => array(
    '@type' => 'place',
    'name' => $place,
    'address' => array(
      '@type' => 'PostalAddress',
      'streetAddress' => $address3,
      'addressLocality' => $address2,
      'addressRegion' => $address1,
      'addressCountry' => 'JP',
    ),
    ),
  'description' => 'アイドルマスターのイベント',
  'performer' => $live_member,
);

?>
<script type="application/ld+json">
<?php echo json_encode($json_data);?>

</script>



<?php
date_default_timezone_set('Asia/Tokyo');
$today_live = get_terms('live',array('hide_empty'=>FALSE,'search'=>date("Y-m-d"),));

$today_cont = strtotime(date('Y-m-d H:i'));
if ($today_cont >= strtotime(/* 開始時間→ */'2021-06-15 0:00') AND $today_cont < strtotime(/* 終了時間→ */'2021-06-16 0:00') )
{
get_template_part('parts/kikaku/birthday_2021');
}



if(!empty($today_live)){
  echo '<div class="alert alert-info" role="alert">
  本日開催のライブ・イベント';
  foreach($today_live as $term){
    echo '<div><a href="'.get_term_link($term).'">'.preg_replace('/\d{4}\-\d{1,2}\-\d{1,2}/', '' , $term->name ).'</a></div>';
  }
  echo '
  </div>
  ';
}

$tomorrow_live = get_terms('live',array('hide_empty'=>FALSE,'search'=>date("Y-m-d",strtotime("+1 day")),));
if(!empty($tomorrow_live)){
  echo '<div class="alert alert-info" role="alert">
  明日開催のライブ・イベント';
  foreach($tomorrow_live as $term){
    echo '<div><a href="'.get_term_link($term).'">'.preg_replace('/\d{4}\-\d{1,2}\-\d{1,2}/', '' , $term->name ).'</a></div>';
  }
  echo '
  </div>
  ';
}
?>


<div class="container top_menu">
    <div class="row">

        <div class="col-xs-4 col-sm-3 col-md-2">
          <a href="<?php echo get_permalink("355");?>">
            <div class="card text-center">
              <div class="card-block">
                <i class="fas fa-music bd-placeholder-img card-img-top fa-5x "></i>
                <span class="card-title">全曲</span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-xs-4 col-sm-3 col-md-2">
          <a href="<?php echo get_permalink("359");?>">
            <div class="card text-center">
              <div class="card-block">
                <i class="fas fa-user bd-placeholder-img card-img-top fa-5x "></i>
                <span class="card-title">アイドル</span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-xs-4 col-sm-3 col-md-2">
          <a href="<?php echo get_permalink("363");?>">
            <div class="card text-center">
              <div class="card-block">
                <i class="fas fa-users bd-placeholder-img card-img-top fa-5x "></i>
                <span class="card-title">ユニット</span>
              </div>
            </div>
          </a>
        </div>

        
        <div class="col-xs-4 col-sm-3 col-md-2">
          <a href="<?php echo get_permalink("374");?>">
            <div class="card text-center">
              <div class="card-block">
                <i class="fas fa-compact-disc bd-placeholder-img card-img-top fa-5x "></i>
                <span class="card-title">CD</span>
              </div>
            </div>
          </a>
        </div>

        
        <div class="col-xs-4 col-sm-3 col-md-2">
          <a href="<?php echo get_permalink("881");?>">
            <div class="card text-center">
              <div class="card-block">
                <i class="fas fa-calendar bd-placeholder-img card-img-top fa-5x "></i>
                <span class="card-title">ライブ・イベント</span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-xs-4 col-sm-3 col-md-2">
          <a href="<?php echo get_permalink("568");?>">
            <div class="card text-center">
              <div class="card-block">
                <i class="fas fa-pen bd-placeholder-img card-img-top fa-5x "></i>
                <span class="card-title">クリエイター</span>
              </div>
            </div>
          </a>
        </div>

    </div>
</div>

<div>
<div class="alert alert-primary" role="alert">
<a href="https://fujiwarahaji.me/?p=3525">
  15周年もアイマスですよ！アイマス<span style="color: #ff99cc;">！</span><span style="color: #00ccff;">！</span><span style="color: #ffcc00;">！</span><span style="color: #2fcca2;">！</span><span style="color: #99ccff;">！</span>
</a>
</div>
</div>



<div class="container top_menu_sub">
    <div class="row">

        <div class="col-xs-4 col-sm-3 col-md-2">
          <a href="<?php echo get_permalink("1007");?>">
            <div class="card text-center">
              <div class="card-block">
                <i class="fas fa-question bd-placeholder-img card-img-top fa-5x "></i>
                <span class="card-title">About</span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-xs-4 col-sm-3 col-md-2">
          <a href="<?php echo get_permalink("3147");?>">
            <div class="card text-center">
              <div class="card-block">
                <i class="fas fa-keyboard bd-placeholder-img card-img-top fa-5x "></i>
                <span class="card-title">IME</span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-xs-4 col-sm-3 col-md-2">
          <a href="<?php echo get_permalink("720");?>">
            <div class="card text-center">
              <div class="card-block">
                <i class="fa-brands fa-discord bd-placeholder-img card-img-top fa-5x "></i>
                <span class="card-title">Discord・ファンサイト</span>
              </div>
            </div>
          </a>
        </div>

        

    </div>
</div>
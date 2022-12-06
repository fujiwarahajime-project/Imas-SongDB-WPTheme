<p>お使いのIME（日本語入力システム）で使える辞書ファイルをダウンロードできます。<br>
サイトに入力しているふりがな情報を整形して自動生成します。<br>
データはどんどん増えていきますので、定期的に更新されることをおすすめします。<br>
現在はこのサイトに登録してある「曲名」「アイドル名」「声優名」「ユニット名」に対応しています。<br>
「ユニット名」に関しては難読ユニットを中心に一部ユニットのみの対応となっています。<br>
不必要なデータがありましたらインポート前にテキストファイルから削除してください。<br>
</p>

<h2>使用方法</h2>
<section>
  <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#mime">
  <i class="fab fa-windows"></i>Windows Microsoft IME
  </button>
  <div id="mime" class="collapse">
    <div class="panel panel-default">
      <div class="panel-body">
<p>UTF-8版を保存します。<br>
ダウンロードされたテキストファイルをメモ帳で開き「ファイル」→「名前をつけて保存」を開きます。<br>
画面下部のエンコードを「UTF-16 LE」に変更して保存します。（デフォルトではUTF-8となっていると思います）</p>
<p>タスクバーのIME項目（「A」や「あ」などと表示されています）を右クリック→「単語の追加」→「ユーザー辞書ツール」で辞書ツールを開きます。<br>
「ツール」→「テキストファイルからの登録」で先ほどのテキストファイルをインポートします。</p>
<p>ShiftJIS版ではメモ帳でのテキストファイルの変換をしなくてもインポートできます。<br>
ただし「♡」など一部の文字が「?」に文字化けします。これは文字エンコードの仕様です。</p>
      </div>
    </div>
  </div>
</section>

<section>
  <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#windows">
  <i class="fab fa-google"></i>Windows Google日本語入力
  </button>
  <div id="windows" class="collapse">
    <div class="panel panel-default">
      <div class="panel-body">
<p>UTF-8版を保存します。</p>
<p>タスクバーのIME項目（「A」や「あ」などと表示されています）を右クリック→「辞書ツール」で辞書ツールを開きます。<br>
「管理」→「新規辞書にインポート」または「選択した辞書にインポート」で先ほどのテキストファイルをインポートします。<br>
フォーマット、エンコードは自動判定のままで正常にインポートされます。</p>

      </div>
    </div>
  </div>
</section>

<section>
  <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#android">
  <i class="fab fa-android"></i></i>Android Gboard
  </button>
  <div id="android" class="collapse">
    <div class="panel panel-default">
      <div class="panel-body">
<p>Gboard用のファイルをダウンロードします。</p>
<p>Gboardアプリを起動し「単語リスト」→「単語リスト」→「日本語」→右上の「︙」→「インポート」を開きます。<br>
先ほどダウンロードしたZIPファイルを選択します。（通常はダウンロードフォルダにダウンロードされます）</p>
      </div>
    </div>
  </div>
</section>

<h2>ダウンロード</h2>
<p>ボタンをクリック後にファイルを生成しますのでダウンロード開始まで少し時間がかかります。<br>
ボタンを何回も押さずに数秒待ってみてください。</p>
<h3>PC用</h3>
<a href="https://fujiwarahaji.me/api/ime/ms.txt" download="Imas_<?php echo date('Ymd');?>.txt" class="button" style="cursor:pointer;">ダウンロード（UTF-8）</a>
<a href="https://fujiwarahaji.me/api/ime/ms" download="Imas_<?php echo date('Ymd');?>_sjis.txt" class="button" style="cursor:pointer;">ダウンロード（ShiftJIS）</a>
<a href="https://api.fujiwarahaji.me/ime/ms.txt" class="button" style="cursor:pointer;">辞書ファイルを見る</a>
<p>ShiftJIS版では一部記号が文字化けします。</p>

<h3>Android（Gboard）用</h3>
<a href="https://api.fujiwarahaji.me/ime/gboard" class="button" style="cursor:pointer;">ダウンロード</a>
<a href="https://api.fujiwarahaji.me/ime/gboard.txt" class="button" style="cursor:pointer;">辞書ファイルを見る</a>


<p>お使いのIME（日本語入力システム）で使える辞書ファイルをダウンロードできます。<br>
サイトに入力しているふりがな情報を整形して自動生成します。<br>
データはどんどん増えていきますので、定期的に更新されることをおすすめします。<br>
現在はこのサイトに登録してある「曲名」「アイドル名」「声優名」「ユニット名」に対応しています。<br>
「ユニット名」に関しては難読ユニットを中心に一部ユニットのみの対応となっています。<br>
不必要なデータがありましたらインポート前にテキストファイルから削除してください。<br>
書式はMicrosoft IMEに沿う形式になっています。</p>

<h2>使用方法</h2>
<p>デフォルトではUTF-8形式で保存します。<br>
Microsoft IMEをお使いの場合、Windows標準のメモ帳で開いたあと、「ファイル」→「名前をつけて保存」を開きウィンドウ右下の文字コードより「Unicode」を選択して保存しなおしてください。</p>

<h2>ダウンロード</h2>
<a class="button" style="cursor:pointer;" onclick="javascript: ga('send', 'event', 'button', 'click','ime_download');　downloadFile('./ime/download', 'Imas_musicime_<?php echo date('Y_m_d');?>.txt'); return false;">辞書をダウンロードする</a><br>
<a class="button" style="cursor:pointer;" href="./ime/preview" onClick="ga('send', 'event', 'button', 'click','ime_preview');">辞書ファイルをブラウザで見る</a>

<script>
function downloadFile(url, filename) {
  "use strict";
  // XMLHttpRequestオブジェクトを作成する
  var xhr = new XMLHttpRequest();
  xhr.open("GET", url, true);
  xhr.responseType = "blob"; // Blobオブジェクトとしてダウンロードする
  xhr.onload = function (oEvent) {
    // ダウンロード完了後の処理を定義する
    var blob = xhr.response;
    if (window.navigator.msSaveBlob) {
      // IEとEdge
      window.navigator.msSaveBlob(blob, filename);
    }
    else {
      // それ以外のブラウザ
      // Blobオブジェクトを指すURLオブジェクトを作る
      var objectURL = window.URL.createObjectURL(blob);
      // リンク（<a>要素）を生成し、JavaScriptからクリックする
      var link = document.createElement("a");
      document.body.appendChild(link);
      link.href = objectURL;
      link.download = filename;
      link.click();
      document.body.removeChild(link);
    }
  };
  // XMLHttpRequestオブジェクトの通信を開始する
  xhr.send();
}
</script>
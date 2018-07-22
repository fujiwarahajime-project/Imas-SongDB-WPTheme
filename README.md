# Imas-SongDB-WPTheme
アイドルマスターの楽曲DBで使っているWordPress用テーマです。  
最新版のミリオンライブ用DBのデータをアップしています。  
ライセンスや書き直しの関係もあり、一部のコアファイルのみの公開としています。  
IssueやPullRequestはどんどんしてもらって大丈夫です。
# Licence
License :  GNU General Public License version 2

Original Author : Hidekazu Ishikawa (kurudrive) at Vektor,Inc. (https://www.vektor-inc.co.jp/inquiry/)

Modify Author : Maccha (http://twitter.com/maccha_pie)

2018/07/22

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

# 使用方法
1. 最新版のWordpressをサーバー上にインストール
2. 最低限必要なプラグイン（Advanced Custom Fields、Custom Post Type UI）をインストール
3. 親テーマである「[Lightning](https://ja.wordpress.org/themes/lightning/)」のインストール
4. テーマフォルダに子テーマをアップロード
5. CPT UIの設定ファイルをインポート
6. カスタムフィールドの設定ファイルをインポート
7. 曲情報を入力

# 入力しておく項目
管理画面サイドバーの「曲」→「新規追加」より曲情報を登録します。  
アイキャッチ画像はジャケット画像です。

「曲」→「歌唱アイドル」より各キャラクターの編集ページを開き、サムネイルのファイル名、よみがな等を入力します。

「曲」→「収録CD」より各CDの編集ページを開き、Amazonリンクを入力します。  
収録曲欄は用意しているだけで、現状ではフロントエンドに表示されません。

「曲」→「披露ライブ」より各ライブの編集ページを開き、会場とAmazonリンクを入力します。  
生放送・テレビ放送は用意しているだけで、現状ではフロントエンドに表示されません。

「曲」→「関連楽曲」より各曲のページのスラッグとリンク先の曲のスラッグを合わせます。

各キャラクターのサムネイルを用意し、WPのアップロードファイルの中のidolディレクトリ（wp-content/uploads/idol）にアップロードします。  
ファイル名は、各キャラクターのタクソノミーに登録したファイル名とし、PNG形式（拡張子は.png）でアップロードしてください。
# 注意事項
カスタム投稿タイプを用いるため、トップページからのリンクは用意されません。  
自分で用意してください。

メッセージボックスとボタンのIDだけは用意していますが、CSSは入力していません。  
[宮野さんのCodepen](https://codepen.io/miyano/pens/public/)から「CGSS-Button」または「mltd-button」と「CGSS-MessageWindow」のCSSをライセンスを守った上で使ってください。

アイコン類は真っ白のPNGとしてアップロードしています。  
運用中のサイトでは[FLAT ICON DESIGNさん](http://flat-icon-design.com/)を利用しています。

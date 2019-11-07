=== Hash Hash Tags ===
Contributors: kyriejpn
Tags: hashtag, hashtags, taglink,seo,meta,tags,tag,instagram,notemu
Requires at least: 5.0.4
Tested up to: 5.1.1
Stable tag: 0.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires PHP: 7.0.0
Donate link: (BTC)11FZbr2rv7H7itbrzrPUyfLsC1dtHZ8k8

== Description ==

"Characters starting with #" will be tag links. 「#から始まる文字」がタグリンクになります。Like Instagram. Like note-mu. Mobile-Friendly. You can choose whether to save tags in post. 

`this #sampletag are displayed as a posted tag link.
↓
this <a href="tag/sampletag">#sampletag</a> are displayed as a posted tag link.
`

* You can choose whether to save tags in post. タグを投稿に保存する/しないを選べます。

* You can specify the maximum number of characters in which hash tags are recognized as tags.(the initial value is 15)(Unlimited at 0)
タグとして認識する最大文字数を指定できます。(デフォルトは15、0は無制限)
  
These are not recognized
   * Characters beginning with two or more #(##example)
   * HTML color codes(ex.#cccfff)
   * Only numeric(ex.#123456)
   *
複数シャープから始まるタグ、カラーコードに該当するタグ、数字のみのタグなどは認識しません。元々リンクして書かれている場合も書き換わりません。
   
   
You can escape beginning with minus -(-#example)
マイナスを付けると、タグにもリンクにもならず、マイナスが除去された #文字列 となります(エスケープ)


Other examples
<a href="https://kyrie.cloud/web/1306#i-3"> https://kyrie.cloud/web/1306#i-3</a>
   
 This is Mobile-Friendly plugin.
 シンプルな設定画面なのでスマホからも設定しやすいです。


== Installation ==

1. From the WP admin panel, click “Plugins” -> “Add new”.
2. In the browser input box, type “Hash Hash Tags”.
3. Select the “Hash Hash Tags” plugin and click “Install”.
4. Activate the plugin.

OR…

1. Download the plugin from this page.
2. Save the .zip file to a location on your computer.
3. Open the WP admin panel, and click “Plugins” -> “Add new”.
4. Click “upload”.. then browse to the .zip file downloaded from this page.
5. Click “Install”.. and then “Activate plugin”.


== bug report ==
<a href="https://kyrie.cloud/web/1306"> https://kyrie.cloud/web/1306</a>



== Screenshots ==



== Changelog ==
=1.0.0=
*New Release


== Upgrade notice ==
=1.0.0=
*New Release

<?php
/*
Plugin Name: Hash Hash Tags
Plugin URI:
Description: "Characters starting with #" will be tag links. #から始まる文字 をtag linkに. Like Instagram. Like note-mu. Mobile-Friendly.
Version: 1.0.0
Author: Kyrie CASIO
Author URI: https://kyrie.cloud
License: GPLv2
Text Domain: hash-hash-tags
Domain Path: /languages/

Copyright 11.4.2019 Kyrie CASIO
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if (!defined('ABSPATH')) exit;
load_plugin_textdomain('hash-hash-tags', false, basename(dirname(__FILE__)) . '/languages');
load_plugin_textdomain('hash2tag');
/*プラグインメニューへ設定リンク*/

function hash2tagSettingsLink($links, $file)
{
  if ($file != plugin_basename(__FILE__)) return $links;
  $settings_link = '<a href="options-general.php?page=hash2tag_setting">' . __('Settings', 'hash-hash-tags') . '</a>';
  array_unshift($links, $settings_link);
  return $links;
}

add_filter('plugin_action_links', 'hash2tagSettingsLink', 10, 2);

function sample_plugin_init_option()
{

  // インストール時既定データ保存

  if (!get_option('hash2tag_setting')) {
    add_option('hash2tag_setting', ['taglimit' => 15, 'tagsave' => 0]);
  }
}

register_activation_hook(__FILE__, 'sample_plugin_init_option');

// 実行処理

function the_content_replace($text)
{
  if (strpos($text, '#') === false) {

    // '#'が含まれていない場合

  }
  else {
    remove_action('save_post', 'the_content_replace');
    $append = true;

    // 値を取得

    $wphome = home_url();
    $tag_base = get_option('tag_base');
    if ($tag_base == '') {
      $tag_base = "tag";
    }
    else {
    }

    $post_ID = get_the_ID();
    $getdata = get_option('hash2tag_setting');
    $taglimited = $getdata['taglimit'];
    $tagsaved = $getdata['tagsave'];
    $tags = Array();
    $tagslim = Array();
    $value = Array();
    preg_match_all("/(?:\s|p\>|br\>|em\>|i\>|strong\>|b\>|td\>)#(\w*[^\<\>\s\-\._~%\:\/\?#\[\]@\!\$&'\(\)\*\+,;\=])/u", $text, $tags, PREG_OFFSET_CAPTURE);
    foreach($tags[1] as $value) {
      if ((mb_strlen($value[0], 'UTF-8') <= $taglimited) || $taglimited == 0) {

        // 最大数設定より小さいか無制限

        if ($value[0] == "#") {

          // valueは#のみか数字のみ

          $value[0] = '';
        }
        else {

          // valueは#じゃないよ

          if (preg_match("/^([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/", $value[0]) || is_numeric($value[0])) {

            // colorcodeかnumericで何もしない

          }
          else {
            $srch = "/(?<=[\s\>])#" . $value[0] . "(?=[\s\n\<\>\#\-\._~%\:\/\?\[\]@\!\$&'\(\)\*\+,;\=])/u";
            $text = preg_replace($srch, "<a href=" . $wphome . "/" . $tag_base . "/" . $value[0] . ">#" . $value[0] . "</a>", $text);
            $tagslim[] = $value[0];
          } //if value=="#"
        } //[a-fA-F0-9]{6}|[a-fA-F0-9]
      }
      else {
      } //if mb_strlen($value, 'UTF-8')<= $taglimited
    } //foreach($truetags as $value)

    // 投稿タグへの登録

    if ($tagslim)
    if (empty($tagslim)) {
    }
    else {
      if ($tagsaved == 1 || $tagsaved == '1') {
        wp_set_post_tags($post_ID, $tagslim, true);
      }
    }
    else {
    }

    if (strpos($text, '-#') === false) {

      // '-#'が含まれていない場合

    }
    else {
      $text = str_replace('-#', '#', $text);
    }
  } //if(strpos($text,'#')
  return $text;
} //function the_content_replace 終
add_filter('the_content', 'the_content_replace');
class H2tSettingsPage

{
  /** 設定値 */
  private $options;
  /**
   * 初期化処理です。
   */
  public

  function __construct()
  {

    // メニューを追加します。

    add_action('admin_menu', array(
      $this,
      'add_plugin_page'
    ));

    // ページの初期化を行います。

    add_action('admin_init', array(
      $this,
      'page_init'
    ));
  }

  /**
   * メニューを追加します。
   */
  public

  function add_plugin_page()
  {
    add_options_page('Hash Hash Tags', 'Hash Hash Tags', 'manage_options', 'hash2tag_setting', array(
      $this,
      'create_admin_page'
    ));
  }

  /**
   * 設定ページの初期化を行います。
   */
  public

  function page_init()
  {
    register_setting('hash2tag_setting', 'hash2tag_setting', array(
      $this,
      'sanitize'
    ));
    add_settings_section('hash2tag_setting_section_id', '', '', 'hash2tag_setting');

    // 項目追加

    $word_taglimit = __('The maximum number of characters in which hash tags are recognized as tags.(the initial value is 15)(Unlimited at 0)', 'hash-hash-tags');
    $word_taglimit = '<h3> Hash Hash Tags: ' . $word_taglimit . '</h3>';
    add_settings_field('taglimit', $word_taglimit, array(
      $this,
      'taglimit_callback'
    ) , 'hash2tag_setting', 'hash2tag_setting_section_id');

    // 項目追加

    $word_tagsave = __('Automatically save tags on posts', 'hash-hash-tags');
    $word_tagsave = '<h3> Hash Hash Tags: ' . $word_tagsave . '</h3>';
    add_settings_field('tagsave', $word_tagsave, array(
      $this,
      'tagsave_callback'
    ) , 'hash2tag_setting', 'hash2tag_setting_section_id');
  }

  private
  function tag_base_url()
  {
    global $wp_rewrite;
    return get_home_url(null, str_replace('%post_tag%', '[hashtag]', $wp_rewrite->get_extra_permastruct('post_tag')));
  }

  /**
   * 設定ページのHTMLを出力します。
   */
  public

  function create_admin_page()
  {

    // 設定値を取得します。

    $this->options = get_option('hash2tag_setting');
?>
        <div class="wrap">
            <h2>Hash Hash Tags</h2>
            <h3> Regarding </h3>
            <p>Hash Hash Tags working.</p>
            <p> <?php
    echo __('(space)#thiswords(space) is display as tag link.', 'hash-hash-tags'); ?> </p>
            
            <blockquote style="background-color:#ffffff;">
   <?php
    echo __('this #sampletag are displayed as a posted tag link.', 'hash-hash-tags'); ?>
            </blockquote>
            <p>↓</p>
                        <blockquote style="background-color:#ffffff;"> 
   <?php
    echo __('this &lt;a href=&quot;siteurl/tag/sampletag&quot;&gt;#sampletag&lt;/a&gt; are displayed as a posted tag link.', 'hash-hash-tags'); ?>
                       
                        
            </blockquote>
           
            <p> <?php
    echo __('You can choose whether to save tags in post.', 'hash-hash-tags'); ?> </p>
            <p> <?php
    echo __('You can specify the maximum number of characters recognized as tags.', 'hash-hash-tags'); ?> </p>
           <h3> <?php
    echo __('These are not recognized', 'hash-hash-tags'); ?> </h3>
           <p>* <?php
    echo __('Characters beginning with two or more #(##example)', 'hash-hash-tags'); ?> </p>
                 <p>* <?php
    echo __('HTML color codes(ex.#cccfff)', 'hash-hash-tags'); ?> </p>
            <?php

    // add_options_page()で設定のサブメニューとして追加している場合は
    // 問題ありませんが、add_menu_page()で追加している場合
    // options-head.phpが読み込まれずメッセージが出ない(※)ため
    // メッセージが出るようにします。
    // ※ add_menu_page()の場合親ファイルがoptions-general.phpではない

    global $parent_file;
    if ($parent_file != 'options-general.php') {
      require (ABSPATH . 'wp-admin/options-head.php');

    }

?>
            <form method="post" action="options.php" id="settingform">
           
            <?php

    // 隠しフィールドなどを出力します(register_setting()の$option_groupと同じものを指定)。

    settings_fields('hash2tag_setting');

    // 入力項目を出力します(設定ページのslugを指定)。

    do_settings_sections('hash2tag_setting');

    // 送信ボタンを出力します。

    submit_button();
?>
            </form>
        </div>
        <?php
  }

  /* 入力項目出力します。
  */
  public

  function taglimit_callback()
  {

    // 値を取得

    $taglimit = isset($this->options['taglimit']) ? $this->options['taglimit'] : '';
?><input type="text" id="taglimit" name="hash2tag_setting[taglimit]" size="3" value="<?php
    esc_attr_e($taglimit) ?>" />
        <?php
  }

  /**
   * 入力項目(「tagsave」)のHTMLを出力します。
   */
  public

  function tagsave_callback()
  {

    // 値を取得

    $tagsave = isset($this->options['tagsave']) ? $this->options['tagsave'] : '';
    if ($tagsave == "0" || $tagsave == 0) {
      $checked = "";
    }
    else {
      $checked = 'checked="On"';
    }

?>
        <input type="checkbox" id="tagsave" name="hash2tag_setting[tagsave]" <?php
    echo $checked; ?> value="1" />
            <p>  <?php
    echo __('Note: Even if turned off, tags that have already been saved automatically will not be deleted.', 'hash-hash-tags'); ?> </p>
    <?php
  }

  /**
   * 送信された入力値の調整を行います。
   *
   * @param array $input 設定値
   */
  public

  function sanitize($input)
  {

    // DBの設定値を取得します。

    $this->options = get_option('hash2tag_setting');
    $new_input = array();

    // 値を調整

    if (isset($input['taglimit']) && trim($input['taglimit']) !== '' && ctype_digit($input['taglimit']) && 0 <= $input['taglimit'] && $input['taglimit'] <= 100) {
      $new_input['taglimit'] = sanitize_text_field($input['taglimit']);
    }

    // メッセージがない場合エラーを出力

    else {
      $errorword = __('(Error: Please specify the maximum number of characters with a number from 0 to 100)', 'hash-hash-tags');
      add_settings_error('hash2tag_setting', 'taglimit', $errorword);

      // 値をDBの設定値に戻します。

      $new_input['taglimit'] = isset($this->options['taglimit']) ? $this->options['taglimit'] : '';
    }

    $new_input['taglimit2'] = $input['taglimit2'];
    $new_input['tagsave'] = $input['tagsave'];
    return $new_input;
  }
}

// 管理画面を表示している場合のみ実行します。

if (is_admin()) {
  $hash2tag_settings_page = new H2tSettingsPage();
}

?>
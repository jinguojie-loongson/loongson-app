<?php
/*
 * loongson-app - The Loongson Application Community
 * 
 * Copyright (C) 2017 Loongson Technology Corporation Limited
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 *
 * In addition, as a special exception, the copyright holders give
 * permission to link the code of portions of this program with the
 * OpenSSL library under certain conditions as described in each
 * individual source file, and distribute linked combinations
 * including the two.
 * You must obey the GNU General Public License in all respects
 * for all of the code used other than OpenSSL.
 * If you modify file(s) with this exception, you may extend this exception
 * to your version of the file(s), but you are not obligated to do so.
 * If you do not wish to do so, delete this exception statement from your
 * version.
 * If you delete this exception statement from all source
 * files in the program, then also delete it here.
 *
 */
  include_once('header.php');
  include_once('top.php');
  include_once('_rank.inc');
  include_once('_app.inc');
  include_once('_comment.inc');
  include_once('_util.inc');
?>

<!-- 
  应用程序：主界面
-->
<?php
  $app_id = $_GET['id'];
  if (is_empty($app_id))
    fatal_error("传入应用程序的ID不能为空！");
?>

<div class="app-form">
  <div id="app-back"> <i class='fa fa-chevron-left'></i> </div>

  <table class="app-header" border="0">
    <tr>
      <td class="td-img" rowspan="6">
        <?= get_app_icon_html($app_id); ?> 
        <div class="button installed" id="installApp">获取应用状态...</div>
        <input type='hidden' id='download_count_token' value="<?= create_new_token('token') ?>" />
        <input type="hidden" id="app_id" value="<?= $app_id ?>">
        <input type="hidden" id="app_name" value="<?= get_app_name($app_id) ?>">
        <input type="hidden" id="app_version" value="<?= get_app_version($app_id) ?>">
        <input type="hidden" id="app_filename" value="<?= get_app_file_by_id($app_id) ?>">
        <input type="hidden" id="app_md5" value="<?= get_app_md5_by_id($app_id) ?>">
        <input type="hidden" id="app_install_script" value="<?= get_app_install_script_by_id($app_id) ?>">
      </td>
      <td colspan="2" class="title"> <?= get_app_name($app_id) ?> </td>
    </tr>
    <tr>
      <td class="td-label"> 软件作者：</td>
      <td class="gray"> <?= get_app_vendor($app_id) ?> </td>
    </tr>
    <tr>
      <td class="td-label"> 版本：</td>
      <td class="gray"> <?= get_app_version($app_id) ?> </td>
    </tr>
    <tr>
      <td> 下载大小：</td>
      <td class="gray"> <?= get_app_download_size($app_id, get_app_version($app_id)) ?>  </td>
    </tr>
    <tr>
      <td> 下载次数：</td>
      <td class="gray"> <?= get_app_download_count($app_id) ?>  </td>
    </tr>
    <tr>
      <td> 软件简介：</td>
      <td class="gray"> <?= get_app_description($app_id) ?>  </td>
    </tr>
  </table>
<!--
    <p> 软件作者：<span class="black"> 腾讯 </span> </p>
    <p> 下载大小：<span class="black"> 13.6MB </span> </p>
    <p> 下载次数：<span class="black"> 235935 </span> </p>
    <p> 软件简介：<span class="black"> 2015年1月11日 - 这是一款效果非常炫酷的CSS3表单input输入框美化效果插件。该input输入框美化插件共14种效果。<br>大多数是使用CSS transitions来切换伪元素制作的。其中还有... 2015年1月11日 - 这是一款效果非常炫酷的CSS3表单input输入框美化效果插件。该input输入框美化插件共14种效果。大多数是使用CSS transitions来切换伪元素制作的。其中还有... 2015年1月11日 - 这是一款效果非常炫酷的CSS3表单input输入框美化效果插件。该input输入框美化插件共14种效果。大多数是使用CSS transitions来切换伪元素制作的。其中还有... </span> </p>
-->

  <div class="vspace">
  </div>

  <div class="gray-box">
  <!-- 
  图片展示区
  -->
  <?= get_app_screen_file_html($app_id) ?>
  </div>

  <div class="gray-box" id="longdesc">
  <!-- 《详细信息》
       发行说明、版本信息，长文，HTML格式 -->
  <?= get_app_longdesc($app_id) ?>
  </div>

  <div class="gray-box">
    <h3 class="gray">用户评论</h3>
    <div class="app-comment-div">
      <div class="input-thin app-comment-input" contenteditable="true" placeholder="请填写评论，限制500字以内"></div>
      <a class="button installed app-comment-submit">提交评论</a>
    </div>

<!--
    <div class="comment">
      <img src='../images/user.png'/>
      <span id="comment_text">${comment}</span>
      <span id="comment_date">${date_time}</span>
    </div>
-->
    <div class="app-comment-list"><?= get_app_all_comment_html($app_id) ?></div>
  </div>

  <div class="gray-box">
    <div> 推荐同类应用</div>
    <div id="app-card-grid">
        <?= get_most_rank_app_html_by_category(get_app_category_id($app_id), 20, $app_id); ?>
    </div>
  </div>

</div>

<?php
  include_once('footer.php');
?>

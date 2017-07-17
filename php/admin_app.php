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
//include_once('header.php');
include_once('vendor_header.php');
include_once('_admin.inc');
include_once('admin_top.php');
include_once('_app.inc');
include_once('_rank.inc');
include_once('_comment.inc');
?>


<br>
<br>
<br>


<div class="nav nav-tabs">
      <li><a href="admin_comment.php">评论管理</a></li>
      <li><a href="admin_hot.php">热门编辑</a></li>
      <li class="active"><a href="admin_app.php">应用审核</a></li>
      <li><a href="admin_vendor.php">开发者管理</a></li>
</div>

<table class="table table-striped table-bordered table-hover table-condensed">
  <tr>
    <td>应用Id</td>
    <td>应用名称</td>
    <td>开发者</td>
    <td>分类</td>
    <td>版本</td>
    <td>状态</td>
    <td>&nbsp;</td>
  </tr>

<?php
  $apps = get_most_rank_app("", 99999999, "");

  foreach ($apps as $id) {
    $name = get_app_name($id);
    $vendor = get_app_vendor($id);
    $version = get_app_version($id);
    $category= get_category_name(get_app_category_id($id));
    $status = get_app_status_text(get_app_status($id));
?>
  <tr>
    <td> <?= @$id ?> </td>
    <td> <?= @$name ?> </td>
    <td> <?= @$vendor ?> </td>
    <td> <?= @$category ?> </td>
    <td> <?= @$version ?> </td>
    <td id="app_status"> <?= @$status ?> </td>
    <td>
      <input id="app_id" type="hidden" value="<?= @${id} ?>">
      <button type="button" class="btn btn-default Audit_app">
        <div class="glyphicon glyphicon-eye-open"></div> 通过审核
      </button>
    </td>
  </tr>

<?php
  }
?>

</table>

<?php
  include_once('vendor_footer.php');
?>

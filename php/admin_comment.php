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
include_once('_comment.inc');
include_once('_app.inc');
include_once('_admin.inc');
include_once('admin_top.php');
?>


<br>
<br>
<br>


<div class="nav nav-tabs">
      <li><a href="admin_hot.php">热门编辑</a></li>
      <li class="active"><a href="admin_comment.php">评论管理</a></li>
      <li><a href="admin_app.php">应用审核</a></li>
</div>


<table class="table table-striped table-bordered table-hover table-condensed">
  <tr>
    <td>应用Id</td>
    <td>应用名称</td>
    <td>评论Id</td>
    <td width="50%">评论</td>
    <td>时间</td>
    <td>&nbsp;</td>
  </tr>

<?php
  $comments = get_all_comment_id();

  foreach ($comments as $c_id) {
    $app_id = get_app_id_by_comment_id($c_id);

    $audit = get_app_comment_audit($c_id);
?>
  <tr>
    <td> <?= @$app_id ?> </td>
    <td> <?= get_app_name($app_id) ?> </td>
    <td> <?= @$c_id ?> </td>
    <td> <?= get_app_comment($c_id) ?> </td>
    <td> <?= get_app_comment_date_time($c_id) ?> </td>
    <td>
      <input id="comment_id" type="hidden" value="<?= @${c_id} ?>">
      <input id="comment_audit" type="hidden" value="<?= @${audit} ?>">
      <button type="button" class="btn btn-default Audit_yes">
        <div class="glyphicon glyphicon-eye-open"></div> <?= $audit ? "隐 藏" : "显 示" ?>
      </button>
      <button class="btn btn-default Audit_del <?= ${no_status} ?>" >
        <div class="glyphicon glyphicon-trash"></div> 删 除
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

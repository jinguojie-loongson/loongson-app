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
include_once('vendor_header.php');
include_once('_admin.inc');
include_once('_hot.inc');
include_once('admin_top.php');
?>


<br>
<br>
<br>


<div class="nav nav-tabs">
      <li><a href="admin_comment.php">评论管理</a></li>
      <li class="active"><a href="admin_hot.php">热门编辑</a></li>
      <li><a href="admin_app.php">应用审核</a></li>
</div>


<div class="alert alert-success alert-dismissable">
  <h1>编辑提示</h1>
  <p> 图片大小：960x400 </p>
  <p> 不修改图片的，可以留空。</p>
</div>


<form id="admin_hot_form" name="admin_hot_form" method="post" enctype="multipart/form-data" action="adminDoHot.php"  >

<?php
$apps = get_all_hot_id();

$i = 0;
$id = "";

foreach ($apps as $id)
{
?>

  <div class="panel panel-default" id="admin_hot_div">
    <div class="panel-body">
      <div class="input-group">
        <span class="input-group-addon">应用ID：</span>
        <input name="hot_id[]" type="text" class="form-control" value="<?= @${id} ?>">
      </div>
      <div class="input-group">
        <input name="hot_img[]" type="file" class="form-control">
      </div>

    </div>
  </div> 

<?php

  $i++;
}
?>

<button class="btn btn-primary" id="saveHot" type="submit">保 存</button>

</form>


<?php
  include_once('vendor_footer.php');
?>

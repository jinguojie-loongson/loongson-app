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
  include_once('_vendor_login.inc');

  $vendor_id = get_current_vendor();
?>

<div class="login-form">
  <div class="panel panel-primary">
    <div class="panel-heading"> 
      <h3>修改开发者信息</h3>
    </div>

    <div class="panel-body">
      <form id="update_vendor_form" name="update_vendor_form" method="post" action="updateVendor.php"  >
        <input type="password" style="position: fixed; top: -999px "/>

	<input id="vendor_id_update" name ="vendor_id_update" type="hidden" value="<?= $vendor_id ?>">
	<input id="password_revise_old" name="password_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_password_by_id($vendor_id) ?>" />
	<input id="vendor_name_revise_old" name="vendor_name_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_vendorname_by_id($vendor_id) ?>" />
	<input id="email_revise_old" name="email_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_email_by_id($vendor_id) ?>"/> 
   	<input id="description_revise_old" name="description_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_description_by_id($vendor_id) ?>" />

        <p class="text-warning"><?= get_login_message() ?></p>
        <div class="form-group">
          <label>密  码</label> 
          <input id="password_update" name="password_update" type="password" class="form-control" autocomplete="off" />
        </div>

        <div class="form-group">
          <label>个人/机构名称</label> 
          <input id="vendor_name" name="vendor_name" type="text" class="form-control" autocomplete="off" value="<?= get_vendor_vendorname_by_id($vendor_id) ?>" />
        </div>

        <div class="form-group">
          <label>电子邮件</label> 
          <input id="email" name="email" type="text" class="form-control" autocomplete="off" value="<?= get_vendor_email_by_id($vendor_id) ?>"  />
        </div>

        <div class="form-group">
          <label>简  介</label> 
          <input id="description_update" name="description_update" type="text" class="form-control" autocomplete="off" value="<?= get_vendor_description_by_id($vendor_id) ?>"  />
        </div>
        <p>
        <button class="btn btn-primary" id="loginsubmit"  name="loginsubmit"  type="submit">确 定</button>
      </form>
    </div>

    <div class="panel-footer">
      <a href="vendorWorkbench.php">返回</a>
    </div>
  </div>

</div>
<?php
  clear_login_message();
?>
<?php
  include_once('vendor_footer.php');
?>

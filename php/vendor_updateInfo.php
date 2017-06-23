<?php
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
      <form id="update_form" name="update_form" method="post" action="vendorUpdate.php"  >
        <input type="password" style="position: fixed; top: -999px "/>

	<input type="hidden" id="vendor_id_revise" name ="vendor_id_revise" value="<?= $vendor_id ?>">
	<input id="password_revise_old" name="password_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_password_by_id($vendor_id) ?>" />
	<input id="vendor_name_revise_old" name="vendor_name_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_vendorname_by_id($vendor_id) ?>" />
	<input id="email_revise_old" name="email_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_email_by_id($vendor_id) ?>"/> 
   	<input id="description_revise_old" name="description_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_description_by_id($vendor_id) ?>" />

        <div class="form-group">
          <label>密  码</label> 
          <input id="password_update" name="password_update" type="password" class="form-control" autocomplete="off" />
        </div>

        <div class="form-group">
          <label>个人/机构名称</label> 
          <input id="vendor_name_update" name="vendor_name_update" type="text" class="form-control" autocomplete="off" value="<?= get_vendor_vendorname_by_id($vendor_id) ?>" />
        </div>

        <div class="form-group">
          <label>电子邮件</label> 
          <input id="email_update" name="email_update" type="text" class="form-control" autocomplete="off" value="<?= get_vendor_email_by_id($vendor_id) ?>"  />
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


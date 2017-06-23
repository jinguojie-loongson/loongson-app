<?php
  include_once('header.php');
  include_once('_vendor_login.inc');
 $vendor_id =get_current_vendor();
?>

<div class="login-form">
  <h3 class="gray">开发者修改</h3>

  <div class="rounded-rect">
    <div class="error_msg"> <?= get_login_message() ?> </div>

    <form id="reg_form_revise" name="reg_form_revise" method="post" action="vendorRegister.php" >
	 <input type="hidden" id="vendor_id_revise" name ="vendor_id_revise" value="<?= $vendor_id ?>">
	 <input id="password_revise_old" name="password_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_password_by_id($vendor_id) ?>" />
	 <input id="vendor_name_revise_old" name="vendor_name_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_vendorname_by_id($vendor_id) ?>" />
	 <input id="email_revise_old" name="email_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_email_by_id($vendor_id) ?>"/> 
   	 <input id="description_revise_old" name="description_revise_old" class="input-thin" type="hidden" value="<?= get_vendor_description_by_id($vendor_id) ?>" />
	
      <div> 密  码: <br> <input id="password_revise" name="password_revise" class="input-thin" type="password" value="<?= get_vendor_password_by_id($vendor_id) ?>" /> </div>
      <div> 名  称: <br> <input id="vendor_name_revise" name="vendor_name_revise" class="input-thin" type="text" value="<?= get_vendor_vendorname_by_id($vendor_id) ?>" /> </div>
      <div> 邮  箱: <br> <input id="email_revise" name="email_revise" class="input-thin" type="text" value="<?= get_vendor_email_by_id($vendor_id) ?>"/> </div>
      <div> 简  介: <br> <input id="description_revise" name="description_revise" class="input-thin" type="text" value="<?= get_vendor_description_by_id($vendor_id) ?>" /> </div>

      <input class="button installed" id="regrevisebtn"  name="regrevisebtn"  type="submit" value=" 确 定" />
    </form>
<a href="vendorWorkbench.php">返回</a>
   
  </div>

</div>


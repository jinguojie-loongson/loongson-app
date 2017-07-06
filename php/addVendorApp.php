<?php
/*
 * 开发者提交应用
 */
include_once('vendor_header.php');
include_once('_util.inc');
include_once('_uploadModifyVendorApp.inc');
include_once('_vendor_login.inc');

$appIconName = $_POST['appIconName'];
$app_name = $_POST['app_name'];
$category_id = $_POST['category_id'];
$description = $_POST['description'];
$longdesc = $_POST['longdesc'];
$appScreenName1 = $_POST['appScreenName1'];
$appScreenName2 = $_POST['appScreenName2'];
$appScreenName3 = $_POST['appScreenName3'];
$appScreenName4 = $_POST['appScreenName4'];
$appScreenName5 = $_POST['appScreenName5'];
$file_name = $_POST['file_name'];
$file_size = $_POST['file_size'];
$version = $_POST['version'];
$install_script = $_POST['install_script'];
$uninstall_script = $_POST['uninstall_script'];

insert_vendor_app(get_current_vendor(), $appIconName, $app_name, $category_id, $description, $longdesc,
        $appScreenName1, $appScreenName2, $appScreenName3, $appScreenName4, $appScreenName5,
        $file_name, $file_size, $version, $install_script, $uninstall_script);
?>


<div class="login-form">
  <div class="panel panel-primary">
    <div class="panel-heading"> 
      <h3>已成功添加应用</h3>
    </div>

    <div class="panel-footer">
      <a href="vendorWorkbench.php">返回工作台</a>
    </div>
  </div>
</div>


<?php
  include_once('vendor_footer.php');
?>

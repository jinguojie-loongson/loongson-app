<?php
/*
 * 开发者提交新版本、修改信息
 */
include_once('vendor_header.php');
include_once('_util.inc');
include_once('_uploadModifyVendorApp.inc');
include_once('_vendor_login.inc');

$app_id = isset($_POST['app_id']) ? $_POST['app_id'] : "";
$state = isset($_POST['state']) ? $_POST['state'] : "";

$h_name = "";

if ($state == 0) {
  $os_content = isset($_POST['os_content']) ? $_POST['os_content'] : "";
  if ($os_content == "")
  {
    $h_name = "提交应用新版本失败，参数错误";
  } else {
    $h_name = "已成功提交应用新版本";
    upload_modify_vendor_app($state, $app_id, get_current_vendor(), "", "", "", "", "",
        "", "", "", "", "",
        $os_content);
  }
} else if ($state == 1) {
  $appIconName = isset($_POST['appIconName']) ? $_POST['appIconName'] : "";
  $app_name = isset($_POST['app_name']) ? $_POST['app_name'] : "";
  $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : "";
  $description = isset($_POST['description']) ? $_POST['description'] : "";
  $longdesc = isset($_POST['longdesc']) ? $_POST['longdesc'] : "";
  $appScreenName1 = isset($_POST['appScreenName1']) ? $_POST['appScreenName1'] : "";
  $appScreenName2 = isset($_POST['appScreenName2']) ? $_POST['appScreenName2'] : "";
  $appScreenName3 = isset($_POST['appScreenName3']) ? $_POST['appScreenName3'] : "";
  $appScreenName4 = isset($_POST['appScreenName4']) ? $_POST['appScreenName4'] : "";
  $appScreenName5 = isset($_POST['appScreenName5']) ? $_POST['appScreenName5'] : "";
  
  if ($appIconName == "" && $app_name == "" && $category_id == "" && $description == "" && $longdesc == "")
  {
    $h_name = "修改应用信息失败，参数错误";
  } else {
    $h_name = "已成功修改应用信息";
    upload_modify_vendor_app($state, $app_id, get_current_vendor(), $appIconName, $app_name, $category_id, $description, $longdesc,
        $appScreenName1, $appScreenName2, $appScreenName3, $appScreenName4, $appScreenName5,
        "", "", "", "", "");
  }
} else {
  $h_name = "参数错误";
}

?>

<div class="login-form">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3><?= $h_name ?></h3>
    </div>

    <div class="panel-footer">
      <a href="vendorWorkbench.php">返回工作台</a>
    </div>
  </div>
</div>


<?php
  include_once('vendor_footer.php');
?>


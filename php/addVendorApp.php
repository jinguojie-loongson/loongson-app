<?php
/*
 * 开发者提交应用
 */
include_once('vendor_header.php');
include_once('_util.inc');
include_once('_uploadModifyVendorApp.inc');
include_once('_vendor_login.inc');

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
$version = isset($_POST['version']) ? $_POST['version'] : "";
$os_content = isset($_POST['os_content']) ? $_POST['os_content'] : "";
$return_content = "";

if ($appIconName == "" && $app_name == "" && $category_id == "" && $description == "" && $longdesc == "" &&  
	$version == "")
{
  $return_content = "添加应用失败，参数错误";
} else {
  $return_content = "已成功添加应用";
  insert_vendor_os_app(get_current_vendor(), $appIconName, $app_name, $category_id, $description, $longdesc,
        $appScreenName1, $appScreenName2, $appScreenName3, $appScreenName4, $appScreenName5,
        $os_content);
}

?>


<div class="login-form">
  <div class="panel panel-primary">
    <div class="panel-heading"> 
      <h3><?= $return_content ?></h3>
    </div>

    <div class="panel-footer">
      <a href="vendorWorkbench.php">返回工作台</a>
    </div>
  </div>
</div>


<?php
  include_once('vendor_footer.php');
?>

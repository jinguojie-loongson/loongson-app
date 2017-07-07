<?php
include_once('vendor_header.php');
include_once('_vendor.inc');
include_once('vendor_top.php');
include_once('_uploadModifyVendorApp.inc');
include_once('_app.inc');
?>
<?php
$app_id = $_GET['id'];
$state = $_GET['state'];
$app_name = get_app_name($app_id);
$version = get_app_version($app_id);
$h_name = "";
$button_name = "";
if ($state == 0) {
  $h_name = "上传 " . $app_name . " 的新版本";
  $button_name = "提交新版本";
} else if ($state == 1) {
  $h_name = "修改 " . $app_name . " 应用信息";
  $button_name = "修改应用信息";
} else {
  $h_name = "参数错误！";
  $button_name = "参数错误！";
}

?>

<form id="imageform" method="post" enctype="multipart/form-data" action="uploadVendorAppFile.php">
    <input type="hidden" id="file_type" name="file_type">
    <input type="hidden" id="screen_number" name="screen_number">
    <div id="up_btn" class="btn">
      <input id="photoimg" type="file" name="photoimg" style="opacity:0; ">
    </div>
</form>
<div id="vendor-upload-app-card-grid">
  <h4 id="title" style="float:left; height:0px;"><?= $h_name ?></h4><br>
  <?php if ($state == 0) { ?> 
  <h4 id="version_title" style="float:left; height:0px;">版本号必须大于：<?= $version ?></h4>
  <?php } ?>
  <form id="uploadModifyForm" method="post" action="uploadModifyVendorApp.php">
    <input type="hidden" id="app_id" name="app_id" value="<?= $app_id ?>">
    <input type="hidden" id="state" name="state" value="<?= $state ?>">
    <?= get_vendor_app_upload_or_modify_html($app_id, $state) ?>

    <div class="perform">
      <button class="btn btn-primary" type="button" id="uploadOrModify"><?= $button_name ?></button>
      <button class="btn btn-warning cancel" type="button"> 取 消 </button>
    </div>
  </form>
</div>

<?php
include_once('vendor_header.php');
include_once('_vendor.inc');
include_once('vendor_top.php');
include_once('_uploadModifyVendorApp.inc');
include_once('_app.inc');
include_once('_os.inc');
?>
<?php
$app_id = $_GET['id'];
$state = $_GET['state'];
$app_name = get_app_name($app_id);
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

  <form id="uploadModifyForm" method="post" action="uploadModifyVendorApp.php">
    <input type="hidden" id="app_id" name="app_id" value="<?= $app_id ?>">
    <input type="hidden" id="state" name="state" value="<?= $state ?>">
    <div class="vendor-card-div vendor-app-file-div">
      <?php
        if ($state == 0) {
      ?>
          <div class="vendor-app-file-upload">
            <button class="btn btn-primary app-file-button pointer" type="button">上传安装文件</button>
            <!-- <span class="app-file-button pointer">上传安装文件</span> -->
          </div>
          <div class="app-file-attribute"></div>
          <div class="vendor-app-file-attribute">
            <span style="font-size:9pt; color:red; float:left;">
              通过审核、下架: 版本号必须大于之前最新版本的版本号；<br>
              审核未通过: 可以再次提交相同版本号；<br>
              未审核: 不能上传新版本。
            </span>
          </div>
          <div class="vendor-app-file-attribute">
            <span class="version">版本号：</span>
            <input class="vendor-card-input" type="text" id="local_version" name="local_version" placeholder="最多4段数字，以“.”分隔，范围0～65535">
            <span id="stateDomain"></span>
          </div>
      <?php } ?>
      <?php
        if ($state == 0) {
          $os = get_all_os_with_id();
          /*计数器*/
          $count=0;
          foreach($os as $c)
          {
            $c_id = $c[0];
            $c_name = $c[1];
            $app_version_status = get_app_file_version_status($app_id, $c_id);
            $app_version = "";
	    $app_status = "";
	    if ($app_version_status != null && $app_version_status != "") {
              $app_version = $app_version_status[0][0];
              $app_status = $app_version_status[0][1];
            }

            $count++;
            echo "<script type='text/javascript'>os_fun.auto_addOs(${c_id},'${c_name}',${count}, 'new_version', '${app_version}', '${app_status}');</script>";
          }
          echo "<script type='text/javascript'>os_fun.auto_allOs();</script>";
          echo "<script type='text/javascript'>os_fun.auto_btn();</script>";
          echo "<script type='text/javascript'>os_fun.selector_event();</script>";
        } else {
      ?>
        <?= get_vendor_app_upload_or_modify_html($app_id, $state) ?>
      <?php } ?>
    </div>
    <?php
      if ($state == 0) {
    ?>
        <div class="vendor-card-div vendor-app-file-div" id="supportOs">
          <div class="vendor-app-file-attribute">
            <span class="version">选择系统：</span>
          </div>
          <table class="table table-striped table-bordered table-hover table-condensed" id='oslist'>
            <tr>
              <td>系统名称</td>
              <td>版本号</td>
              <td>安装文件</td>
              <td>大小</td>
              <td width="25%">安装命令</td>
              <td width="25%">卸载命令</td>
              <td >操作</td>
            </tr>
          </table>
        </div>
    <?php } ?>

    <div class="perform">
      <button class="btn btn-primary" type="button" id="uploadOrModify"><?= $button_name ?></button>
      <button class="btn btn-warning cancel" type="button"> 取 消 </button>
    </div>
  </form>
</div>

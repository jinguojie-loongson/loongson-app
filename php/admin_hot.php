<?php
include_once('vendor_header.php');
include_once('_admin.inc');
include_once('_hot.inc');
include_once('admin_top.php');
?>


<br>
<br>
<br>


<div class="nav nav-tabs">
      <li class="active"><a href="admin_hot.php">热门编辑</a></li>
      <li><a href="admin_comment.php">评论管理</a></li>
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

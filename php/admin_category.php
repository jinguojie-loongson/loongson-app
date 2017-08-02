<?php
include_once('vendor_header.php');
include_once('_admin.inc');
include_once('_app.inc');
include_once('admin_top.php');
include_once('_category.inc');
?>

<br>
<br>
<br>

<div class="nav nav-tabs">
  <li><a href="admin_comment.php">评论管理</a></li>
  <li><a href="admin_hot.php">热门编辑</a></li>
  <li><a href="admin_app.php">应用审核</a></li>
  <li><a href="admin_vendor.php">开发者管理</a></li>
  <li class="active"><a href="admin_category.php">类别管理</a></li>
  <li><a href="admin_os.php">操作系统</a></li>
</div>

<table id="category_list" class="table table-striped table-bordered table-hover table-condensed">
  <tr>
    <td>类别Id</td>
    <td>名称</td>
    <td>&nbsp;</td>
  </tr>

  <?= get_category_list() ?>
</table>

<div class="panel panel-default" id="admin_category_div">
  <div class="panel-body">
    <div class="input-group">
      <span class="input-group-addon">应用类别：</span>
      <input id="addCategory"  name="addCategory" type="text" class="form-control">
    </div>
    <span id='category_message' class='alert-danger'></span>
    <br>
    <button class="btn " id="saveCategory"  type="button">新增</button>
  </div>
</div>

<?php
  include_once('vendor_footer.php');
?>


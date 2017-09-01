<?php
include_once('vendor_header.php');
include_once('_admin.inc');
include_once('_app.inc');
include_once('admin_top.php');

?>

<br>
<br>
<br>

<div class="nav nav-tabs">
  <li><a href="admin_comment.php">评论管理</a></li>
  <li><a href="admin_hot.php">热门编辑</a></li>
  <li><a href="admin_app.php">应用审核</a></li>
  <li class="active"><a href="admin_vendor.php">开发者管理</a></li>
  <li><a href="admin_category.php">类别管理</a></li>
  <li><a href="admin_os.php">操作系统</a></li>
  <li><a href="admin_config.php">常规设置</a></li>
</div>

<table class="table table-striped table-bordered table-hover table-condensed">
  <tr>
    <td>开发者Id</td>
    <td>名称</td>
    <td>机构名称</td>
    <td>邮箱</td>
    <td>时间</td>
    <td>&nbsp;</td>
  </tr>
  
  <?= get_vendor_list() ?>
</table>

<?php
  include_once('vendor_footer.php');
?>

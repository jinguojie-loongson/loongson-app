<?php
include_once('vendor_header.php');
include_once('_os.inc');
include_once('admin_top.php');

?>

<br>
<br>
<br>

<div class="nav nav-tabs">
  <li><a href="admin_comment.php">评论管理</a></li>
  <li><a href="admin_hot.php">热门编辑</a></li>
  <li><a href="admin_app.php">应用审核</a></li>
  <li><a href="admin_vendor.php">开发者管理</a></li>
  <li><a href="admin_category.php">类别管理</a></li>
  <li class="active"><a href="admin_os.php">操作系统</a></li>
  <li><a href="admin_config.php">常规设置</a></li>
</div>

<table id="os_table" class="table table-striped table-bordered table-hover table-condensed">
  <tr>
    <td>Id</td>
    <td>系统名称</td>
    <td>系统描述</td>
    <td>探测脚本</td>
    <td>&nbsp;</td>
  </tr>

  <?= get_os_list() ?>
</table>
<div class="panel panel-default" id="admin_category_div">
  <div class="panel-body">
    <div class="input-group">
      <span class="input-group-addon">系统名称：</span>
      <input id="os_name"  name="os_name" type="text" class="form-control" style="width:60%">
      <span id="os_name_text" class="btn-sm" style="color:red;"></span>
    </div>
    <div class="input-group">
      <span class="input-group-addon">系统描述：</span>
      <input id="os_description"  name="os_description" type="text" class="form-control" style="width:60%">
      <span id="os_description_text" class="btn-sm" style="color:red;"></span>
    </div>
    <div class="input-group">
      <span class="input-group-addon">探测脚本：</span>
      <textarea id="os_probe_cmd"  name="os_probe_cmd" style="float: left; width:60%" rows="4"></textarea>
      <span id="os_probe_cmd_text" class="btn-sm" style="color:red;"></span>
    </div>
    <button class="btn" id="saveOs"  type="button">新增</button>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="modify_os_form" name="modify_os_form" method="post" action="getOrModifyOs.php?state=1">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">修改</h4>
	</div>
        <div class="modal-body">
	  <input type="hidden" id="edit_os_id" name="edit_os_id">
	  <div class="input-group">
            <span class="input-group-addon">系统名称：</span>
            <input id="edit_os_name"  name="edit_os_name" type="text" class="form-control" style="width:60%">
            <span id="edit_os_name_text" class="btn-sm" style="color:red;"></span>
          </div>
          <div class="input-group">
            <span class="input-group-addon">系统描述：</span>
            <input id="edit_os_description"  name="edit_os_description" type="text" class="form-control" style="width:60%">
            <span id="edit_os_description_text" class="btn-sm" style="color:red;"></span>
          </div>
          <div class="input-group">
            <span class="input-group-addon">探测脚本：</span>
            <textarea id="edit_os_probe_cmd"  name="edit_os_probe_cmd" style="float: left;" rows="4" cols="35"></textarea>
            <span id="edit_os_probe_cmd_text" class="btn-sm" style="color:red;"></span>
          </div>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
	  <button type="button" id="modify_os_submit"  class="btn btn-primary">提交</button>
	</div>
      </div>
    </form>
  </div>
</div>

<?php
  include_once('vendor_footer.php');
?>

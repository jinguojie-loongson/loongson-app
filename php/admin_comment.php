<?php
//include_once('header.php');
include_once('vendor_header.php');
include_once('_comment.inc');
include_once('_app.inc');
include_once('_admin.inc');
include_once('admin_top.php');
?>


<br>
<br>
<br>


<div class="nav nav-tabs">
      <li><a href="admin_hot.php">热门编辑</a></li>
      <li class="active"><a href="admin_comment.php">评论管理</a></li>
      <li><a href="admin_app.php">应用审核</a></li>
</div>


<table class="table table-striped table-bordered table-hover table-condensed">
  <tr>
    <td>应用Id</td>
    <td>应用名称</td>
    <td>评论Id</td>
    <td width="50%">评论</td>
    <td>时间</td>
    <td>&nbsp;</td>
  </tr>

<?php
  $comments = get_all_comment_id();

  foreach ($comments as $c_id) {
    $app_id = get_app_id_by_comment_id($c_id);

    $audit = get_app_comment_audit($c_id);
?>
  <tr>
    <td> <?= @$app_id ?> </td>
    <td> <?= get_app_name($app_id) ?> </td>
    <td> <?= @$c_id ?> </td>
    <td> <?= get_app_comment($c_id) ?> </td>
    <td> <?= get_app_comment_date_time($c_id) ?> </td>
    <td>
      <input id="comment_id" type="hidden" value="<?= @${c_id} ?>">
      <input id="comment_audit" type="hidden" value="<?= @${audit} ?>">
      <button type="button" class="btn btn-default Audit_yes">
        <div class="glyphicon glyphicon-eye-open"></div> <?= $audit ? "隐 藏" : "显 示" ?>
      </button>
      <button class="btn btn-default Audit_del <?= ${no_status} ?>" >
        <div class="glyphicon glyphicon-trash"></div> 删 除
      </button>
    </td>
  </tr>

<?php
  }
?>

</table>

<?php
  include_once('vendor_footer.php');
?>

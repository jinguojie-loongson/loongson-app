<?php
include_once('_admin.inc');

if (is_empty(get_current_admin()))
  request_forward('admin_login.php');
?>

<div id="workbench_navbar" class="navbar navbar-default navbar-fixed-top">
  <div class="navbar-header">
      <span class="navbar-brand">管理员工作台</span>
  </div>

  <form class="navbar-form navbar-right">
    <div id="vendor-menu">
      <span id="vendor-name"> <?= get_admin_name(get_current_admin()) ?>
        <span class="caret"></span>
      </span>

      <div class="dropdown open">
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" >
          <li><a href="admin_logout.php">退出</a></li>
        </ul>
      </div>
    </div>

  </form>

</div>

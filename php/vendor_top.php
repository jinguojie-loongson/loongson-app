<?php
include_once('_vendor_login.inc');

if (is_empty(get_current_vendor()))
  request_forward('vendor_login.php');
?>

<div id="workbench_navbar" class="navbar navbar-default navbar-fixed-top">
  <div class="navbar-header">
      <span class="navbar-brand">开发者工作台</span>
  </div>

  <form class="navbar-form navbar-right">
    <div id="vendor-menu">
      <span id="vendor-name"> <?= get_vendor_name(get_current_vendor()) ?>
        <span class="caret"></span>
      </span>

      <div class="dropdown open">
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" >
          <li><a href="vendor_updateInfo.php">设置</a></li>
          <li class="divider"></li>
          <li><a href="vendor_logout.php">退出</a></li>
        </ul>
      </div>
    </div>

  </form>

</div>

<!--
<div class="topbar">
  <div id="vendor-logo">
    <img src="../images/favicon.png" width="34" height="34" align="absmiddle" />
    开发者工作台
  </div>

  <div id="vendor-menu">
    <span id="vendor-name"> <?= get_vendor_name(get_current_vendor()) ?>
      <i class='fa fa-caret-down'></i>
    </span>
    <ul class="dropdown">
      <li><a href="vendor_updateInfo.php">设置</a></li>
      <li><a href="vendor_logout.php">退出</a></li>
    </ul>
  </div>
</div>
-->

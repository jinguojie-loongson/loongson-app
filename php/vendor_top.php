<?php
include_once('_vendor_login.inc');

if (is_empty(get_current_vendor()))
  request_forward('vendor_login.php');
?>

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
      <li>设置</li>
      <li><a href="vendor_logout.php">退出</a></li>
    </ul>
  </div>
</div>

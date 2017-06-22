<?php
$_SESSION['vendor_id'] = 1;
?>

<div class="topbar">
  <div id="vendor-logo">
    <img src="../images/favicon.png" width="34" height="34" align="absmiddle" />
    开发者工作台
  </div>

  <div id="vendor-menu">
    <span id="vendor-name"> <?= get_vendor_name($_SESSION['vendor_id']) ?>
      <i class='fa fa-caret-down'></i>
    </span>
    <ul class="dropdown">
      <li>设置</li>
      <li>退出</li>
    </ul>
  </div>
</div>

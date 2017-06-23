<?php
//include_once('header.php');
include_once('vendor_header.php');
include_once('_vendor.inc');
include_once('vendor_top.php');
?>


<br>
<br>
<br>

<div id="workbench-tool">
  <button class="btn btn-primary" id="newApp">提交新应用</button>
</div>

<div id="app-card-grid"> 
  <?= get_vendor_all_app_html(get_current_vendor()) ?>
</div>

<?php
  include_once('vendor_footer.php');
?>

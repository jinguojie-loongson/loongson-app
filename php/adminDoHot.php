<?php 
include_once('vendor_header.php');
include_once('_hot.inc');
include_once('_util.inc');

/*
 * print_r($_POST);
 * 
 *   Array ( [hot_id] => Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 ) 
 *   [hot_img] => Array ( [0] => nopic.png [1] => user.png [2] => user.png [3] => slides-pagination.png [4] => user.png ) )
 * 
 * print_r($_FILES);
 * 
 *   Array ( [hot_img] => Array ( 
 *     [name] => Array ( [0] => slides-pagination.png [1] => user.png [2] => [3] => [4] => )
 *     [type] => Array ( [0] => image/png [1] => image/png [2] => [3] => [4] => ) 
 *     [tmp_name] => Array ( [0] => /tmp/phpZNsKiY [1] => /tmp/php9en7gb [2] => [3] => [4] => )
 *     [error] => Array ( [0] => 0 [1] => 0 [2] => 4 [3] => 4 [4] => 4 )
 *     [size] => Array ( [0] => 1394 [1] => 2627 [2] => 0 [3] => 0 [4] => 0 )
 *     )
 *   ) 
 */

foreach ($_POST["hot_id"] as $index => $hot_id)
{
  set_hot_app_id($index, $hot_id);

  $img = $_FILES["hot_img"]["name"][$index];
  if (!is_empty($img))
    upload_hot_app_banner($index, $hot_id);
}
?>

<div class="modal show">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
           <p> 热门应用保存成功！</p>
      </div>

      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal" aria-hidden="true" href="admin_hot.php">返 回</a>
      </div>
</div>

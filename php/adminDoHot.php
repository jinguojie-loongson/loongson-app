<?php 
/*
 * loongson-app - The Loongson Application Community
 * 
 * Copyright (C) 2017 Loongson Technology Corporation Limited
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 *
 * In addition, as a special exception, the copyright holders give
 * permission to link the code of portions of this program with the
 * OpenSSL library under certain conditions as described in each
 * individual source file, and distribute linked combinations
 * including the two.
 * You must obey the GNU General Public License in all respects
 * for all of the code used other than OpenSSL.
 * If you modify file(s) with this exception, you may extend this exception
 * to your version of the file(s), but you are not obligated to do so.
 * If you do not wish to do so, delete this exception statement from your
 * version.
 * If you delete this exception statement from all source
 * files in the program, then also delete it here.
 *
 */
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

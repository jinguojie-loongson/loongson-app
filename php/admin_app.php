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
//include_once('header.php');
include_once('vendor_header.php');
include_once('_admin.inc');
include_once('admin_top.php');
include_once('_app.inc');
include_once('_rank.inc');
include_once('_comment.inc');
include_once('_vendor.inc');
include_once('_review.inc');
?>
<br>
<br>
<br>
<div class="nav nav-tabs">
  <li><a href="admin_comment.php">评论管理</a></li>
  <li><a href="admin_hot.php">热门编辑</a></li>
  <li class="active"><a href="admin_app.php">应用审核</a></li>
  <li><a href="admin_vendor.php">开发者管理</a></li>
  <li><a href="admin_category.php">类别管理</a></li>
  <li><a href="admin_os.php">操作系统</a></li>
</div>
<div class="panel-body">
  <table class="table table-bordered">
    <tr>
      <td> 应用Id </td>
      <td class="tdwidthname" > 应用名称 </td>
      <td class="tdwidthname" > 开发者 </td>
      <td class="tdwidthcategory"> 分类 </td>
      <td> 版本 </td>
      <td class="tdwidthstatus"> 状态 </td>
      <td class="tdwidth"> 安装命令 </td>
      <td class="tdwidth"> 卸载命令 </td>
      <td> 文件名 </td>
      <td class="tdwidthdefult"></td>
    </tr>
<?php
$apps = get_all_app_appfile();// get_most_rank_app("", 99999999, "");
foreach ($apps  as $key => $value) { 
  $id = $value['id'];
  $name = $value['name']; 
  $vendor = get_app_vendor($value['id']);
  $version = $value['version'];
  $versionreplace = str_replace('.','1',$version);
  $category= get_category_name($value['categoryid']);
  $status = get_app_status_text($value['status']);
  $install_script =$value['install_script'];
  $uninstall_script = $value['uninstall_script'];
  $subinstall_script = substr_replace($install_script, '...', 6, strlen($install_script));
  $subuninstall_script =substr_replace($uninstall_script, '...', 6, strlen($uninstall_script)) ;
  $filename = $value['filename'];
  $isonline = $value['is_online'];
?>
    <tr>
      <td> <?= @$id ?> </td>
      <td> <?= @$name ?> </td>
      <td> <?= @$vendor ?> </td>
      <td> <?= @$category ?> </td>
      <td> <?= @$version ?> </td>
      <td>
        <div class="col-md-12" id="<?= @${id} ?><?= @$versionreplace ?>updatestatus">  <?= @$status ?>  </div>
      </td>
      <td>
        <div id ="<?= @$id ?><?= @$versionreplace ?>installisshow" 
	  class="popover-show" data-container="body" data-toggle="popover" data-content="<?= @$install_script ?>">
	</div>   
	<div id="<?= @$id ?><?= @$versionreplace ?>" class="installscript"   >
	  <?= @$subinstall_script ?>
        </div>
      </td>
      <td>
        <div id="<?= @$id ?><?= @$versionreplace ?>unistallisshow" 
	  class="popover-show" data-container="body" data-toggle="popover"  data-content="<?= @$uninstall_script ?>">
        </div>
	<div id="<?= @$id ?><?= @$versionreplace ?>" class="unistallshow"   >
          <?= @$subuninstall_script ?>
	</div>
      </td>
      <td>
        <a href="downloadFile.php?id=<?= @$id ?>&version=<?= @$version ?>"> <?= @$filename ?> </a>
      </td>
      <td>
        <div class="row">
	  <div class="col-md-12" id="<?= @${id} ?><?= @$versionreplace ?>btnisdispay">
	    <input id="app_id" type="hidden" value="<?= @${id} ?>">
	    <input id="version" type="hidden" value="<?= @${version} ?>">
	    <input id="isappOfftheshelf" type="hidden" value="1">
            <?php if ($value['status'] == "under_review") {  ?>
              <button type="button" class="btn btn-primary Audit_app" data-toggle="modal"  data-target="#myModal" >
                通过审核
              </button>
              <button type="button" class="btn btn-warning NotAudit_app" data-toggle="modal"  data-target="#myModal">
                拒绝审核
              </button>
	    <?php } ?>
	    <?php if ($isonline == 0 ) {  ?>
              <button type="button" class="btn btn-danger appofftheshelf" data-toggle="modal"  data-target="#myModal" >
                下架
              </button>
            <?php } ?>
	     <a  href="#" title="审核信息">
	       <span id="<?= @$id ?>" class="glyphicon glyphicon-list-alt reviewmessage" title="审核信息" 
	 	data-toggle="modal"  data-target="#myModal1" ></span>
	     </a> 
	   </div>
	 </div>	
       </td>
     </tr>
<?php } ?>
  </table> 
</div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="admincommintform" name="admincommintform" method="post" action="auditApp.php"  >
      <div class="modal-content">
        <div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
	    &times;
	  </button>
	  <h4 class="modal-title" id="myModalLabel">
	    管理员附言
	  </h4>
	</div>
	<div class="modal-body">
	  <input id="appidforcommit"  name="appidforcommit" value="" type="hidden">
	  <input id="isExistAudit"  name ="isExistAudit" value="" type="hidden">
	  <input id="versionreview"  name ="versionreview" value="" type="hidden">
    	  <div class="app-comment-div">
	    <div  id="appcomment_review" name="appcomment_review"  class="input-thin app-comment-input" 
	      contenteditable="true" placeholder="请填写附言，限制500字以内">
            </div>
	  </div>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">
            关闭
	  </button>
	  <button type="button" id="reviewbtn"  class="btn btn-primary">
	    提交
	  </button>
	</div>
      </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal -->
</div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
	</button>
        <h4 class="modal-title" id="myModalLabel">
          审核信息列表 
        </h4>
      </div>
      <div class="modal-dialog">
        <div class="modal-body" >           
          <div class="panel-body" id="reviewdiv"></div>
        </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<?php
  include_once('vendor_footer.php');
?>

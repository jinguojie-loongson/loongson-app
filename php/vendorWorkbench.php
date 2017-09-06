<!DOCTYPE html>

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
include_once('_vendor.inc');
include_once('_category.inc');
include_once('_app.inc');
include_once('_review.inc');
include_once('vendor_top.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../lib/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../lib/bootstrapValidator.min.css" />
</head>
<br>
<br>
<br>
<?php
  $arrayapp = get_all_app_by_vendorId(get_current_vendor());
  if ($arrayapp != null && $arrayapp != "") {
?>
<div id="workbench-tool">
  <a class="btn btn-primary" id="newApp" href="vendorUploadApp.php">提交新应用</a>
</div>
<?php
}
?>

<div class="container" >
<?php
  $arrayapp = get_all_app_by_vendorId(get_current_vendor());
  if ($arrayapp == null || $arrayapp == "") {
?>
<body class="vendorWork-body-backgroud">
  <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">

          <div class="inner cover">
            <h1 class="cover-heading">欢迎您，开发者</h1>
            <p class="lead">您目前尚未提交任何应用，您可以点击下面的按钮立刻创建新的应用</p>
            <p class="lead">
              <a href="vendorUploadApp.php" class="btn btn-lg btn-default">提交新应用</a>
            </p>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p><a href="index.php">应用公社首页</a></p>
              <p>龙芯中科技术有限公司版权所有 2017</p>
            </div>
          </div>

        </div>
      </div>
  </div>
</body>
<?php
} else {
  foreach($arrayapp  as $key => $value) { 
?>			
    <div class="row" >
      <div class="col-md-4 "  >
        <div class="panel panel-default">
	  <div class="panel-body">
	    <div class="row">
	      <?php if ($value['is_online'] == 0 ) {  ?>
	        <div class="col-md-12 " id="<?= $value['id'] ?>img">
		  <img src='getAppIcon.php?id=<?= $value['id'] ?>' class="imgsize"  />
		</div>
	      <?php } else {	?>
	        <div class="col-md-12" id="<?= $value['id'] ?>img">
		   <p><span class='badge pull-right'>已下架</span></p>
		     <img src='getAppIcon.php?id=<?= $value['id']?>' class="imgsize" />
		</div>
	      <?php } ?>
	    </div>
	    <div class="row">
	      <div class="col-md-12  app-filename-fontsize" > <?= $value['name'] ?> </div>
	    </div>
	    <div class="row">
	      <div class="col-md-12 app-category-fontsize" > <?= get_category_name($value['category_id']) ?> </div>
	    </div>
	    <div class="row">
	      <div class="col-md-12 "> <?= $value['description'] ?> </div>
	    </div>
	  </div>
	  <div class="panel-footer">
	    <div class="row" >
	      <div class="col-md-12 ">
			 <input id="app_id" type="hidden" value="<?= $value['id'] ?>">
	        <a class="btn btn-primary" href="vendorUploadModifyApp.php?id=<?= $value['id'] ?>&state=1">修改应用信息</a>
	        <?php 
		   $sum = get_app_file_status_count($value['id'], "under_review");
		   if ($sum != 0 ) {
	        ?>		
		   <a class="btn btn-primary"   disabled="disabled">提交新版本</a>
		<?php }else{  ?>
		   <a class="btn btn-primary" href="vendorUploadModifyApp.php?id=<?= $value['id'] ?>&state=0">提交新版本</a>
		<?php } ?>
		<?php if($value['is_online'] == 0 ) {  ?>
	           <button id="<?= $value['id'] ?>offtheshelfbtn"  type="button" class="btn btn-danger  appofftheshelf"
			    data-toggle="modal"  data-target="#myModal"   >
		     <div class="glyphicon "></div>下架
		   </button>
		<?php } else { ?>
		   <button  type="button" class="btn btn-danger appofftheshelf" 
			    disabled="disabled"  data-toggle="modal"  data-target="#myModal"  >
		     <div class="glyphicon "></div>下架
		   </button>
		<?php } ?>	           
		<a  title="审核信息">
		   <span id="<?= $value['id'] ?>" class="glyphicon glyphicon-list-alt reviewmessage" title="审核信息" 
			 data-toggle="modal"  data-target="#myModal2" ></span>
	        </a>
	      </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 " >
        <?php
          $arrayappfile = get_appfile_by_appid($value['id']); 
          foreach($arrayappfile  as $appfilekey => $appfilevalue) { 
	?>
	    <div class="row" >
		   <div class="col-md-12 "  >
		     <div class="panel panel-default">
		       <div class="panel-heading">
		         <div class="row">
                           <div class="col-md-9 textleft" >
                             <span class="spancolor">操作系统：</span><span> <?= $appfilevalue['os_name'] ?> </span>
                           </div>
			   <div class="col-md-4 textleft" >
			     <span class="spancolor">版本：</span><span> <?= $appfilevalue['version'] ?> </span>
			   </div>
			   <div class="col-md-9 textleft" >
			     <span class="spancolor">文件名：</span>
			     <span>
			       <a type="button" id="<?= $value['id'] ?>filename"
			          href="downloadFile.php?id=<?= $value['id'] ?>&version=<?= $appfilevalue['version'] ?>&os_id=<?= $appfilevalue['os_id'] ?>">
                                  <?= $appfilevalue['filename'] ?>
                               </a>
			       </a>
			     </span>
			   </div>
			 </div>
		       </div>
		       <div class="panel-body">
			 <div class="row">
			   <div class="col-md-4 textleft" >
			     <?php 
			       if ($appfilevalue['status'] == 'published' ) {
			     ?>
			      <span class="label label-success pull-left"> <?= get_app_status_text($appfilevalue['status']) ?> </span>
			     <?php  } else if ($appfilevalue['status'] == 'under_review' ) {  ?>
			      <span class="label label-warning pull-left"> <?= get_app_status_text($appfilevalue['status']) ?> </span>
			     <?php } else { ?>
			      <span class="label label-default pull-left"> <?= get_app_status_text($appfilevalue['status']) ?> </span>
			     <?php } ?>
			   </div>
			   <div class="col-md-4 textleft" >
			     <span class="spancolor">大小：</span><span> <?= $appfilevalue['download_size'] ?> </span>
			   </div>
			   <div class="col-md-4 textleft" >
			     <span class="spancolor">下载：</span><span> <?= $value['download_count'] ?> </span>
			   </div>
		         </div>	
		         <div class="row">
			   <div class="col-md-12  textleft">
			     <span class="spancolor">安装命令：</span>
			     <span class="spanborder installboder"> <?= $appfilevalue['install_script'] ?> </span>
		           </div>
		         </div>
		         <div class="row">
		           <div class="col-md-12  textleft ">
			     <span class="spancolor"> 卸载命令：</span>
			     <span class="spanborder installboder" > <?= $appfilevalue['uninstall_script'] ?> </span>
			   </div>
		         </div>		  
		       </div>	
		     </div>
		</div>
	   </div>
	 <?php } ?>
      </div>
</div>              
<hr class="hrstyle">
	<?php } } ?>
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
        <input id="operation_type"  name ="operation_type" value="" type="hidden">
        <input id="versionreview"  name ="versionreview" value="" type="hidden">
        <input id="is_admin"  name ="is_admin" value="0" type="hidden">
        <div class="app-comment-div">
          <div  id="appcomment_review" name="appcomment_review"  class="input-thin app-comment-input" 
		contenteditable="true" placeholder="请填写附言，限制500字以内"></div>
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
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
        <button type="button" class="btn btn-default" data-dismiss="modal">
	    关闭
	</button>
      </div>
    </div>
  </div>
</div>
<?php
   $arrayapp = get_all_app_by_vendorId(get_current_vendor());
   if ($arrayapp != null && $arrayapp != "") {
     include_once('vendor_footer.php');
   }
?>

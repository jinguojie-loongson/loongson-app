<?php
include_once('vendor_header.php');
include_once('_vendor.inc');
include_once('vendor_top.php');
?>
<form id="imageform" method="post" enctype="multipart/form-data" action="uploadVendorAppFile.php">
    <input type="hidden" id="file_type" name="file_type">
    <input type="hidden" id="screen_number" name="screen_number">
    <div id="up_btn" class="btn">
      <input id="photoimg" type="file" name="photoimg" style="opacity:0; ">
    </div>
</form>
<div id="vendor-upload-app-card-grid">
  <form id="uploadForm" method="post" action="addVendorApp.php">
    <div class="app-icon" style="width:150px; height:150px; border:1px dashed #000; margin-bottom: 50px;">
      <div id="app-icon-status" style="display:none"><img src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-icon-button pointer">上传应用图标</span>
      <div class="app-icon-edit" style="display:none;" >
	<i class="fa fa-pencil" id="app-icon-up" aria-hidden="true"></i>
        <i class="fa fa-ban" id="app-icon-del" aria-hidden="true"></i>
      </div>
    </div>
    <div class="vendor-card-div">
      <span>名称：</span><input class="vendor-card-input" type="text" id="app_name" name="app_name"/>
    </div>
    <div class="vendor-card-div"> 
      <span>类别：</span>
      <div class="category-list">
      <span class='unchecked'  name='category' checked='false' onclick='change(this);' value="1">办公</span> 
      <span class='unchecked' name='category' checked='false' onclick='change(this);' value="2">网络</span>
      <span class='unchecked'  name='category' checked='false' onclick='change(this);' value="3">阅读</span> 
      <span class='unchecked' name='category' checked='false' onclick='change(this);' value="4">音乐</span>
      <span class='unchecked'  name='category' checked='false' onclick='change(this);' value="5">图形</span> 
      <span class='unchecked' name='category' checked='false' onclick='change(this);' value="6">视频</span>
      <span class='unchecked'  name='category' checked='false' onclick='change(this);' value="7">游戏</span> 
      <span class='unchecked' name='category' checked='false' onclick='change(this);' value="8">编程</span>
      <span class='unchecked'  name='category' checked='false' onclick='change(this);' value="9">系统</span> 
      <span class='unchecked' name='category' checked='false' onclick='change(this);' value="10">其它</span>
      <input type="hidden" id="category_id" name="category_id">
      </div>
    </div>
    <div class="vendor-card-div">
      <span>精简描述：</span><input class="vendor-card-input" type="text" class="input-thin" id="description" name="description">
    </div>
    <div class="vendor-card-div" style="width:100%; text-align: left;">
      完整描述:
      <br>
      <div class="input-thin app-comment-input" contenteditable="true" placeholder="请填写应用详细描述评论，限制500字以内"></div>
      <input type="hidden" id="longdesc" name="longdesc">
    </div>

    <div class="app-screen-1" style="width:150px; height:150px; border:1px dashed #000; float:left;">
      <input type="hidden" id="appScreenName1" name="appScreenName1">
      <div id="app-screen-status-1" style="display:none"><img src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-screen-button-1 pointer">上传截图</span>
      <div class="app-screen-edit-1" style="display:none;" >
        <i class="fa fa-ban" id="app-screen-del-1" aria-hidden="true"></i>
      </div>
    </div>
    
    <div class="app-screen-2" style="width:150px; height:150px; border:1px dashed #000; float:left;">
      <input type="hidden" id="appScreenName2" name="appScreenName2">
      <div id="app-screen-status-2" style="display:none"><img src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-screen-button-2 pointer">上传截图</span>
      <div class="app-screen-edit-2" style="display:none;" >
        <i class="fa fa-ban" id="app-screen-del-2" aria-hidden="true"></i>
      </div>
    </div>

    <div class="app-screen-3" style="width:150px; height:150px; border:1px dashed #000; float:left;">
      <input type="hidden" id="appScreenName3" name="appScreenName3">
      <div id="app-screen-status-3" style="display:none"><img src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-screen-button-3 pointer">上传截图</span>
      <div class="app-screen-edit-3" style="display:none;" >
        <i class="fa fa-ban" id="app-screen-del-3" aria-hidden="true"></i>
      </div>
    </div>

    <div class="app-screen-4" style="width:150px; height:150px; border:1px dashed #000; float:left;">
      <input type="hidden" id="appScreenName4" name="appScreenName4">
      <div id="app-screen-status-4" style="display:none"><img src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-screen-button-4 pointer">上传截图</span>
      <div class="app-screen-edit-4" style="display:none;" >
        <i class="fa fa-ban" id="app-screen-del-4" aria-hidden="true"></i>
      </div>
    </div>

    <div class="app-screen-5" style="width:150px; height:150px; border:1px dashed #000; float:left;">
      <input type="hidden" id="appScreenName5" name="appScreenName5">
      <div id="app-screen-status-5" style="display:none"><img src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-screen-button-5 pointer">上传截图</span>
      <div class="app-screen-edit-5" style="display:none;" >
        <i class="fa fa-ban" id="app-screen-del-5" aria-hidden="true"></i>
      </div>
    </div>
    
    <div class="vendor-card-div" style="width:100%; margin-top: 50px;">
      <div style="border:1px solid #000; clear:both; padding: 10px;">
	<div class="app-file-attribute"></div>
	<div style="width:185px; height:25px; float:left; border-radius:4px; margin: 30px; ">
          <button class="btn btn-primary app-file-button pointer" type="button" style="clear: both; display: block;" id="appSubmit">上传安装文件</button>
	  <!-- <span class="app-file-button pointer">上传安装文件</span> -->
        </div>
	<div style="clear:both; text-align:left; margin: 10px 0;">
          <span>版本号：</span><input class="vendor-card-input" type="text" id="version" name="version">
        </div>
	<div style="clear:both; text-align:left; margin: 10px 0;">
          <span>安装脚本(shell命令)：</span><input class="vendor-card-input" type="text" id="install_script" name="install_script">
        </div>
        <div style="clear:both; text-align:left; margin: 10px 0;">
          <span>卸载脚本(shell命令)：</span><input class="vendor-card-input" type="text" id="uninstall_script" name="uninstall_script">
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="button" style="clear: both; display: block;" id="appSubmit">提交应用</button>
  </form>
</div>

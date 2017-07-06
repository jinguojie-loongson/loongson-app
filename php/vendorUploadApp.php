<?php
include_once('vendor_header.php');
include_once('_vendor.inc');
include_once('vendor_top.php');
include_once('_category.inc');
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
    <div class="app-icon">
      <div id="app-icon-status" style="display:none"><img class="loader-img" src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-icon-button pointer">上传应用图标</span>
      <div class="app-icon-edit" style="display:none;" >
	<i class="fa fa-pencil" id="app-icon-up" aria-hidden="true"></i>
        <i class="fa fa-ban" id="app-icon-del" aria-hidden="true"></i>
      </div>
    </div>
    <div class="vendor-card-div">
      <span class="vendor-app-attribute">名称：</span><input class="vendor-card-input" type="text" id="app_name" name="app_name"/>
    </div>
    <div class="vendor-card-div"> 
      <span class="vendor-app-attribute">类别：</span>
      <!--根据数据库中类别的数量，category-list div 的大小固定了，如果数据库的类别数量变化了，需要调整大小，后面在优化。 -->
      <div class="category-list">

      <?php
        $category = get_all_category_with_id();
        
        foreach($category as $c)
  	{
    	  $c_id = $c[0];
    	  $c_name = $c[1];
	  
	  echo "<span class='unchecked'  name='category' checked='false' onclick='change(this);' value='${c_id}'>${c_name}</span>";
  	}
        echo "<input type='hidden' id='category_id' name='category_id'>";
      ?>
      </div>
    </div>
    <div class="vendor-card-div">
      <span>精简描述：</span><input class="vendor-card-input" type="text" class="input-thin" id="description" name="description">
    </div>
    <div class="vendor-card-div longdesc-div">
      完整描述:
      <br>
      <div class="input-thin app-comment-input" contenteditable="true" placeholder="请填写应用详细描述评论，限制500字以内"></div>
      <input type="hidden" id="longdesc" name="longdesc">
    </div>

    <div class="app-screen-1 app-screen">
      <input type="hidden" id="appScreenName1" name="appScreenName1">
      <div id="app-screen-status-1" style="display:none"><img class="loader-img" src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-screen-button-1 pointer">上传截图</span>
      <div class="app-screen-edit-1" style="display:none;" >
        <i class="fa fa-ban" id="app-screen-del-1" aria-hidden="true"></i>
      </div>
    </div>
    
    <div class="app-screen-2 app-screen">
      <input type="hidden" id="appScreenName2" name="appScreenName2">
      <div id="app-screen-status-2" style="display:none"><img class="loader-img" src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-screen-button-2 pointer">上传截图</span>
      <div class="app-screen-edit-2" style="display:none;" >
        <i class="fa fa-ban" id="app-screen-del-2" aria-hidden="true"></i>
      </div>
    </div>

    <div class="app-screen-3 app-screen">
      <input type="hidden" id="appScreenName3" name="appScreenName3">
      <div id="app-screen-status-3" style="display:none"><img class="loader-img" src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-screen-button-3 pointer">上传截图</span>
      <div class="app-screen-edit-3" style="display:none;" >
        <i class="fa fa-ban" id="app-screen-del-3" aria-hidden="true"></i>
      </div>
    </div>

    <div class="app-screen-4 app-screen">
      <input type="hidden" id="appScreenName4" name="appScreenName4">
      <div id="app-screen-status-4" style="display:none"><img class="loader-img" src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-screen-button-4 pointer">上传截图</span>
      <div class="app-screen-edit-4" style="display:none;" >
        <i class="fa fa-ban" id="app-screen-del-4" aria-hidden="true"></i>
      </div>
    </div>

    <div class="app-screen-5  app-screen">
      <input type="hidden" id="appScreenName5" name="appScreenName5">
      <div id="app-screen-status-5" style="display:none"><img class="loader-img" src="../images/loader.gif" alt="uploading"/></div>
      <span class="app-screen-button-5 pointer">上传截图</span>
      <div class="app-screen-edit-5" style="display:none;" >
        <i class="fa fa-ban" id="app-screen-del-5" aria-hidden="true"></i>
      </div>
    </div>
    
      <div class="vendor-card-div vendor-app-file-div">
	<div class="vendor-app-file-upload">
          <button class="btn btn-primary app-file-button pointer" type="button">上传安装文件</button>
          <!-- <span class="app-file-button pointer">上传安装文件</span> -->
        </div>
        <div class="app-file-attribute"></div>
	<div class="vendor-app-file-attribute">
          <span class="version">版本号：</span>
	  <input class="vendor-card-input" type="text" id="version" name="version" placeholder="最多4段数字，以“.”分隔，范围0～65535"><span id="stateDomain"></span>
        </div>
	<div class="vendor-app-file-attribute">
          <span>安装脚本(shell命令)：</span><input class="vendor-card-input" type="text" id="install_script" name="install_script">
        </div>
        <div class="vendor-app-file-attribute">
          <span>卸载脚本(shell命令)：</span><input class="vendor-card-input" type="text" id="uninstall_script" name="uninstall_script">
        </div>
      </div>

    <div class="perform">
      <button class="btn btn-primary" type="button" id="appSubmit">提交应用</button>
      <button class="btn btn-warning cancel" type="button"> 取 消 </button>
    </div>
  </form>
</div>

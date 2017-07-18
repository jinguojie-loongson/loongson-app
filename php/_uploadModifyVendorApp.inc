<?php
include_once('_db.inc');
include_once('_util.inc');
include_once('_app.inc');
include_once('_category.inc');
include_once('_review.inc');

function insert_vendor_app($vendor_id, $icon_file, $name, $category_id, $description, $longdesc, 
	$screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5, 
	$file_name, $file_size, $version, $install_script, $uninstall_script)
{
  insert_app_basic_information($vendor_id, $name, $category_id, $description, $longdesc, $version, $file_size);
  
  $app_id = get_app_id($name, $category_id, $version);
  
  $icon_file = icon_cp_rename($app_id, $icon_file);
  $screen_file_count = icon_screen_cp_rename($app_id, $screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5);
  file_cp($file_name);
  
  update_app_icon_screen($app_id, $icon_file, $screen_file_count);

  insert_app_file($app_id, $version, $file_name, $file_size, "under_review", $install_script, $uninstall_script);
  insert_review($app_id, $version, 0, $vendor_id, "under_review", "");

}

/*
 * 将基本信息（名称、类别、精简、完整、当前版本、下载量）存入app表
 */
function insert_app_basic_information($vendor_id, $name, $category_id, $description, $longdesc, $version, $file_size)
{
global $conn;
  $longdesc = addslashes($longdesc);
  $sql = "insert into app (name, vendor_id, category_id, description, longdesc, version, download_count) "
	. " values ('${name}', ${vendor_id}, ${category_id}, '${description}', '${longdesc}', '${version}', 0)";
  db_exec($sql);
}

/*
 * 根据 名称 类别id 当前版本 查询出最新插入的app_id
 */
function get_app_id($name, $category_id, $version)
{
global $conn;
  $sql = "select id from app "
	. " where name = '${name}' and category_id = ${category_id} and version = '${version}'";
  
  return db_get_one_value($sql);
}

/*
 * 根据查询出的app_id 将icon图片 移动位置 重命名 并返回新文件名
 */
function icon_cp_rename($app_id, $icon_file)
{
  $icon_target_url = "../data/icon/";
  
  copy($icon_file, $icon_target_url . $app_id . ".png");

  return $app_id . ".png";
}

/*
 * 根据查询出的app_id 将screen图片 移动位置 重命名 并返回screen总数
 */
function icon_screen_cp_rename($app_id, $screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5)
{
  $screen_target_url = "../data/screen/";
  $screen_sum = 0;  

  if (!is_empty($screen_file_1)) {
    copy($screen_file_1, $screen_target_url . $app_id . "_" . $screen_sum . ".png");
    $screen_sum ++;
  }
  if (!is_empty($screen_file_2)) {
    copy($screen_file_2, $screen_target_url . $app_id . "_" . $screen_sum . ".png");
    $screen_sum ++;
  }
  if (!is_empty($screen_file_3)) {
    copy($screen_file_3, $screen_target_url . $app_id . "_" . $screen_sum . ".png");
    $screen_sum ++;
  }
  if (!is_empty($screen_file_4)) {
    copy($screen_file_4, $screen_target_url . $app_id . "_" . $screen_sum . ".png");
    $screen_sum ++;
  }
  if (!is_empty($screen_file_5)) {
    copy($screen_file_5, $screen_target_url . $app_id . "_" . $screen_sum . ".png");
    $screen_sum ++;
  }
  return $screen_sum;
}

/*
 * 将安装文件 移动位置
 */
function file_cp($file_name)
{
  $current_url = "../data/tmp/";
  $file_target_url = "../data/app/";
  
  copy($current_url . $file_name, $file_target_url . $file_name);
  //unlink($current_url . $file_name);
}

/*
 * 更新app表中 icon_file、 screen_file_count 字段
 */
function update_app_icon_screen($app_id, $icon_file, $screen_file_count)
{
global $conn;
  $sql = "update app "
	. " set icon_file = '${icon_file}', screen_file_count = '${screen_file_count}' "
	. " where id = ${app_id}";

  db_exec($sql);
}

/*
 * 更新app表中 version 字段
 */
function update_app_version($app_id, $version)
{
global $conn;
  $sql = "update app "
	. " set version = '${version}' "
	. " where id = ${app_id}";
 
  db_exec($sql);
}

/*
 * 插入app_file表
 */
function insert_app_file($app_id, $version, $file_name, $file_size, $status, $install_script, $uninstall_script)
{
global $conn;
  $file_target_url = "../data/app/";
  $file_name_md5 = system("md5sum '${file_target_url}/${file_name}' | cut -b-32");
  $download_size = round($file_size/1024, 1) . "M";
  $sql = "insert into app_file (id, version, filename, download_size, md5, status, install_script, uninstall_script) "
	. " values (${app_id}, '${version}', '${file_name}', '${download_size}', '${file_name_md5}', '${status}', '${install_script}', '${uninstall_script}')";

  db_exec($sql);
}

/*
 * 上传新版本、修改资料 提交i
 * state == 0 上传新版本
 *                app_file: insert一条新数据
 *                app:      update 版本号
 *                review:   insert 一条新数据
 * state == 1 修改资料
 */
function upload_modify_vendor_app($state, $app_id, $vendor_id, $icon_file, $name, $category_id, $description, $longdesc,
        $screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5,
        $file_name, $file_size, $version, $install_script, $uninstall_script)
{
  if ($state == 0) {
    file_cp($file_name);
    insert_app_file($app_id, $version, $file_name, $file_size, "under_review", $install_script, $uninstall_script);
    //update_app_version($app_id, $version);
    insert_review($app_id, $version, 0, $vendor_id, "under_review", "");
  } else if ($state == 1) {
    del_vendor_app_icon($app_id);
    del_vendor_app_screen($app_id);

    $icon_file = icon_cp_rename($app_id, $icon_file);
    $screen_file_count = icon_screen_cp_rename($app_id, $screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5);
   
    update_app_list($app_id, $icon_file, $category_id, $description, $longdesc, $screen_file_count);
    
  } else {

  }
}

/*
 * 上传新版本、修改资料 入口
 *  state == 0  上传新版本
 *  state == 1  修改资料
 */
function get_vendor_app_upload_or_modify_html($app_id, $state)
{
  $html = "";
  
  $count = get_app_count($app_id);
  if($count == 0){
    $html = get_error_html("不存在该应用！");
    return $html;
  } else {
    if ($state == 0) {
      $html = get_vendor_app_file($app_id);
      return $html;
    } else if ($state == 1) {
      icon_cp_tmp($app_id);
      screen_cp_tmp($app_id);
      $html = get_vendor_app_icon($app_id);
      $html = $html . get_vendor_app_name($app_id);
      $html = $html . get_vendor_app_category($app_id);
      $html = $html . get_vendor_app_description($app_id);
      $html = $html . get_vendor_app_longdesc($app_id);
      $html = $html . get_vendor_app_screen($app_id);

      return $html;
    } else {
      $html = get_error_html("参数错误！");
      return $html;
    }
  }
}

/*
 * 组装错误提示 html
 */
function get_error_html($name)
{
  $html = "<div class='vendor-card-div vendor-app-file-div'> \n"
	. "<input type='hidden' id='error' name='error' value='error'> \n"
	. "<h4>ERROR：${name} </h4> \n"
	. "</div>";
  return $html;
}

/*
 * 组装icon图片html
 */
function get_vendor_app_icon($app_id)
{
  $icon = get_app_icon_file_by_id($app_id);

  $icon_url = "../data/tmp/" . $icon;
  $html = "<div class='app-icon' style='margin-top: 50px;'> \n"
	. "<img src='${icon_url}' class='app-icon-preview' style='width:150px; height:150px;'> \n"
	. "<input type='hidden' id='appIconName' name='appIconName' value='${icon_url}'> \n"
	. "<div id='app-icon-status' style='display:none'> \n"
	. "<img class='loader-img' src='../images/loader.gif' alt='uploading'/> \n"
	. "</div> \n"
	. "<span class='app-icon-button pointer' style='display:none'>上传应用图标</span> \n"
	. "<div class='app-icon-edit'> \n"
	. "<i class='fa fa-pencil' id='app-icon-up' aria-hidden='true'></i> \n"
	. "<i class='fa fa-ban' id='app-icon-del' aria-hidden='true'></i> \n"
	. "</div> \n"
	. "</div> \n";
  return $html;
}

/*
 * 组装 名称 html
 */
function get_vendor_app_name($app_id)
{
  $name = get_app_name($app_id);

  $html = "<div class='vendor-card-div'> \n"
	. "<span class='vendor-app-attribute'>名称：</span> \n"
	. "<input class='vendor-card-input' type='text' id='app_name' name='app_name' value='${name}' readOnly='true'/> \n"
	. "</div> \n";
  return $html;
}

/*
 * 组装类别 html
 */
function get_vendor_app_category($app_id)
{
  $category_id = get_app_category_id($app_id);
  $category = get_all_category_with_id();
  
  $span = "";
  foreach($category as $c)
  {
    $c_id = $c[0];
    $c_name = $c[1];
    if ($c_id == $category_id) {
      $span = $span . "<span class='checked'  name='category' checked='false' onclick='change(this);' value='${c_id}'>${c_name}</span> \n";
    } else {
      $span = $span . "<span class='unchecked'  name='category' checked='false' onclick='change(this);' value='${c_id}'>${c_name}</span> \n";
    }
  }

  $html = "<div class='vendor-card-div'> \n"
	. "<span class='vendor-app-attribute'>类别：</span> \n"
	. "<div class='category-list' style='width: 585px;'> \n"
	. $span
	. "<input type='hidden' id='category_id' name='category_id' value='${category_id}'> \n"
	. "</div> \n"
	. "</div> \n";

  return $html;
}	

/*
 * 组装 精简描述 html
 */
function get_vendor_app_description($app_id)
{
  $description = get_app_description($app_id);

  $html = "<div class='vendor-card-div'> \n"
	. "<span>精简描述：</span> \n"
	. "<input class='vendor-card-input' type='text' class='input-thin' id='description' name='description' value='${description}'> \n"
	. "</div> \n";

  return $html;
}

/*
 * 组装 完整描述 html
 */
function get_vendor_app_longdesc($app_id)
{
  $longdesc = get_app_longdesc($app_id);

  $html = "<div class='vendor-card-div longdesc-div'> \n"
	. "完整描述: <br> \n"
	. "<div class='input-thin app-comment-input' contenteditable='true' placeholder='请填写应用详细描述评论，限制500字以内'>${longdesc}</div> \n"
	. "<input type='hidden' id='longdesc' name='longdesc' value='${longdesc}'> \n"
	. "</div> \n";
  
  return $html;
}

/*
 * 组装 screen图片 html
 */
function get_vendor_app_screen($app_id)
{
  $screen_file_count = get_app_screen_file_count($app_id);
  $html = "";
  
  for ($i = 0; $i < $screen_file_count; $i++)
  {
    $num = $i + 1;
    $divClass = "app-screen-" . $num;
    $imgClass = "app-screen-preview-" . $num;
    $idOrName = "appScreenName" . $num;
    $divId = "app-screen-status-" . $num;
    $spanClass = "app-screen-button-" . $num;
    $class = "app-screen-edit-" . $num;
    $i_id = "app-screen-del-" . $num; 

    $url = "../data/tmp/" . $app_id . "_" . $i . ".png";
    
    $html = $html . "<div class='${divClass} app-screen'> \n"
	. "<img src='${url}' class='${imgClass}' style='width:150px; height:150px;'> \n"
	. "<input type='hidden' id='${idOrName}' name='${idOrName}' value='${url}'> \n"
	. "<div id='${divId}' style='display:none'> \n"
	. "<img class='loader-img' src='../images/loader.gif' alt='uploading'/> \n"
	. "</div> \n"
	. "<span class='${spanClass} pointer' style='display: none;'>上传截图</span> \n"
	. "<div class='${class}'> \n"
	. "<i class='fa fa-ban' id='${i_id}' aria-hidden='true'></i> \n"
	. "</div> \n"
	. "</div> \n";
  }
  
  for ($y = $screen_file_count; $y < 5; $y++)
  {
    $num = $y + 1;
    $divClass = "app-screen-" . $num;
    $imgClass = "app-screen-preview-" . $num;
    $idOrName = "appScreenName" . $num;
    $divId = "app-screen-status-" . $num;
    $spanClass = "app-screen-button-" . $num;
    $class = "app-screen-edit-" . $num;
    $i_id = "app-screen-del-" . $num;

    $html = $html . "<div class='${divClass} app-screen'> \n"
	. "<input type='hidden' id='${idOrName}' name='${idOrName}'> \n"
	. "<div id='${divId}' style='display:none'> \n"
	. "<img class='loader-img' src='../images/loader.gif' alt='uploading'/> \n"
	. "</div> \n"
	. "<span class='${spanClass} pointer'>上传截图</span> \n"
	. "<div class='${class}' style='display:none'> \n"
	. "<i class='fa fa-ban' id='${i_id}' aria-hidden='true'></i> \n"
	. "</div> \n"
        . "</div> \n";
  }
  
  return $html;
}

/*
 * 组装 上传安装文件 html
 */
function get_vendor_app_file($app_id)
{
  $his_version_status = get_app_file_version_status($app_id);
  $his_version = $his_version_status[0][0];
  $his_status = $his_version_status[0][1];
  
  $html = "<div class='vendor-card-div vendor-app-file-div'> \n"
	. "<input type='hidden' id='his_status' name='his_status' value='${his_status}'> \n"
	. "<input type='hidden' id='his_version' name='his_version' value='${his_version}'> \n"
	. "<div class='vendor-app-file-upload'> \n"
	. "<button class='btn btn-primary pointer' type='button' id='app_file_button'>上传安装文件</button> \n"
	. "</div> \n"
	. "<div class='app-file-attribute'></div> \n"
	. "<div class='vendor-app-file-attribute'> \n"
	. "<span style='font-size:9pt; color:red; float:left;'> \n"
        . "通过审核、下架: 版本号必须大于之前最新版本的版本号；<br>\n"
        . "审核未通过: 可以再次提交相同版本号；<br>\n"
        . "未审核: 不能上传新版本。\n"
        . "</span> \n"
	. "</div> \n"
	. "<div class='vendor-app-file-attribute'> \n"
	. "<span class='version'>版本号：</span> \n"
	. "<input class='vendor-card-input' type='text' id='local_version' name='local_version' placeholder='最多4段数字，以“.”分隔，范围0～65535'> \n"
	. "<span id='stateDomain'></span> \n"
	. "</div> \n"
	. "<div class='vendor-app-file-attribute'> \n"
	. "<span>安装脚本(shell命令)：</span> \n"
	. "<input class='vendor-card-input' type='text' id='install_script' name='install_script'> \n"
	. "</div> \n"
	. "<div class='vendor-app-file-attribute'> \n"
	. "<span>卸载脚本(shell命令)：</span> \n"
	. "<input class='vendor-card-input' type='text' id='uninstall_script' name='uninstall_script'> \n"
	.  "</div> \n"
	. "</div> \n";
  return $html;
}

/*
 * 根据app_id 删除icon目录下的文件
 */
function del_vendor_app_icon($app_id)
{
  $icon_url = "../data/icon/" . $app_id . ".png";
  if (file_exists ($icon_url)) {
    unlink($icon_url);
  }
}

/*
 * 根据app_id 删除screen目录下的文件
 */
function del_vendor_app_screen($app_id)
{
  for ($i = 0; $i < 5; $i++) {
    $screen_url = "../data/screen/" . $app_id . "_" . $i . ".png";
    if (file_exists ($screen_url)) {
      unlink($screen_url);
    } 
  }
}

/*
 * 根据app_id 将icon下的图片复制到tmp目录下
 */
function icon_cp_tmp($app_id)
{
  $tmp_url = "../data/tmp/";
  $icon_url = "../data/icon/" . $app_id . ".png";

  if (file_exists ($icon_url)) {
    copy($icon_url, $tmp_url . $app_id . ".png");
  }
}

/*
 * 根据app_id 将screen下的图片复制到tmp目录下
 */
function screen_cp_tmp($app_id)
{
  $tmp_url = "../data/tmp/";
  for ($i = 0; $i < 5; $i++) {
    $screen_url = "../data/screen/" . $app_id . "_" . $i . ".png";
    if (file_exists ($screen_url)) {
      copy($screen_url, $tmp_url . $app_id . "_" . $i . ".png");
    }
  }
}

/*
 * 根据app_id 更新app表
 */
function update_app_list($app_id, $icon_file, $category_id, $description, $longdesc, $screen_file_count)
{
global $conn;
  $longdesc = addslashes($longdesc);
  $sql = "update app "
	. " set icon_file = '${icon_file}', category_id = ${category_id}, description = '${description}', longdesc = '${longdesc}', screen_file_count = '${screen_file_count}' "
	. " where id = ${app_id}";
  db_exec($sql);
}

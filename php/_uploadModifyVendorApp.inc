<?php
include_once('_db.inc');
include_once('_util.inc');
include_once('_app.inc');
include_once('_category.inc');
include_once('_review.inc');
include_once('global.inc');

function insert_vendor_os_app($vendor_id, $icon_file, $name, $category_id, $description, $longdesc, 
	$screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5, $os_content)
{
  /*插入应用基础信息*/
  $app_id =  insert_app_basic_information($vendor_id, $name, $category_id, $description, $longdesc, 0);
  /*拷贝应用图标*/
  $icon_file = icon_cp_rename($app_id, $icon_file);
  /*拷贝应用抓图*/
  $screen_file_count = icon_screen_cp_rename($app_id, $screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5);
  /*更新应用图标到应用基础信息表*/
  update_app_icon_screen($app_id, $icon_file, $screen_file_count);

  /*系统数据分解*/
  $arraylist=split("#",$os_content);
  for ($i=0;$i<count($arraylist);$i++) //把它们全部输出来
  {
    // 0 系统id  1 系统名称 2版本号 3 文件名 4 文件大小 5 安装脚本 6 卸载脚本
    $os_arr = split("::",$arraylist[$i]);
    $file_name = $os_arr[3];
    /*拷贝应用文件*/
    file_cp( $file_name );

    $version_unified = set_app_file_version_unified($os_arr[2]);
    /*应用文件基础信息*/
    insert_app_file($app_id,  $os_arr[2], $os_arr[3], $os_arr[4], "under_review", $os_arr[0], $os_arr[5], $os_arr[6], $version_unified);
    /*加入审核*/
    insert_review($app_id, $os_arr[2], 0, $vendor_id, "under_review", "");
  }
}

/*
 * 将基本信息（名称、类别、精简、完整、当前版本、下载量）存入app表
 */
function insert_app_basic_information($vendor_id, $name, $category_id, $description, $longdesc, $is_online)
{
global $conn;
  $longdesc = addslashes($longdesc);
  $sql = "insert into app (name, vendor_id, category_id, description, longdesc,  download_count, is_online) "
	. " values ('${name}', ${vendor_id}, ${category_id}, '${description}', '${longdesc}', 0, 0)";
  db_exec($sql);
  return mysql_insert_id();
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
global $app_data_url;
  $icon_target_url = $app_data_url . "icon/";
  $icon_file = $app_data_url . "tmp/" . $icon_file;
  copy($icon_file, $icon_target_url . $app_id . ".png");

  return $app_id . ".png";
}

/*
 * 根据查询出的app_id 将screen图片 移动位置 重命名 并返回screen总数
 */
function icon_screen_cp_rename($app_id, $screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5)
{
global $app_data_url;
  $screen_target_url = $app_data_url . "screen/";
  $screen_sum = 0;  

  if (!is_empty($screen_file_1)) {
    copy($app_data_url . "tmp/" . $screen_file_1, $screen_target_url . $app_id . "_" . $screen_sum . ".png");
    $screen_sum ++;
  }
  if (!is_empty($screen_file_2)) {
    copy($app_data_url . "tmp/" . $screen_file_2, $screen_target_url . $app_id . "_" . $screen_sum . ".png");
    $screen_sum ++;
  }
  if (!is_empty($screen_file_3)) {
    copy($app_data_url . "tmp/" . $screen_file_3, $screen_target_url . $app_id . "_" . $screen_sum . ".png");
    $screen_sum ++;
  }
  if (!is_empty($screen_file_4)) {
    copy($app_data_url . "tmp/" . $screen_file_4, $screen_target_url . $app_id . "_" . $screen_sum . ".png");
    $screen_sum ++;
  }
  if (!is_empty($screen_file_5)) {
    copy($app_data_url . "tmp/" . $screen_file_5, $screen_target_url . $app_id . "_" . $screen_sum . ".png");
    $screen_sum ++;
  }
  return $screen_sum;
}

/*
 * 将安装文件 移动位置
 */
function file_cp($file_name)
{
global $app_data_url;
  $current_url = $app_data_url . "tmp/";
  $file_target_url = $app_data_url . "app/";
  
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
 * 插入app_file表
 */
function insert_app_file($app_id, $version, $file_name, $file_size, $status, $os_id, $install_script, $uninstall_script, $version_unified)
{
global $conn;
global $app_data_url;
  $file_target_url = $app_data_url . "app/";
  $file_name_md5 = system("md5sum '${file_target_url}/${file_name}' | cut -b-32");
  $download_size = round($file_size/1024, 1) . "M";
  $sql = "insert into app_file (id, version, filename, download_size, md5, status, os_id, install_script, uninstall_script, version_unified) "
	. " values (${app_id}, '${version}', '${file_name}', '${download_size}', '${file_name_md5}', '${status}', ${os_id}, '${install_script}', '${uninstall_script}', '${version_unified}')";

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
        $os_content)
{
  if ($state == 0) {
    /*系统数据分解*/
    $arraylist=split("#",$os_content);
    for ($i=0;$i<count($arraylist);$i++) //把它们全部输出来
    {
      // 0 系统id  1 系统名称 2版本号 3 文件名 4 文件大小 5 安装脚本 6 卸载脚本
      $os_arr = split("::",$arraylist[$i]);
      $file_name = $os_arr[3];
      /*拷贝应用文件*/
      file_cp( $file_name );

      $version_unified = set_app_file_version_unified($os_arr[2]);
      /*应用文件基础信息*/
      insert_app_file($app_id,  $os_arr[2], $os_arr[3], $os_arr[4], "under_review", $os_arr[0], $os_arr[5], $os_arr[6], $version_unified);
      /*加入审核*/
      insert_review($app_id, $os_arr[2], 0, $vendor_id, "under_review", "");
    }
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
global $app_data_url;
  $icon = get_app_icon_file_by_id($app_id);

  $html = "<div class='app-icon' > \n"
	. "<img src='getAppTmpIcon.php?id=${app_id}' class='app-icon-preview' style='width:150px; height:150px;'> \n"
	. "<input type='hidden' id='appIconName' name='appIconName' value='${icon}'> \n"
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
	. "<div class='category-list' > \n"
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
global $app_data_url;
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

    $url = $app_id . "_" . $i . ".png";
    $html = $html . "<div class='${divClass} app-screen'> \n"
	. "<img src='getAppTmpScreenFile.php?id=${app_id}&index=${i}' class='${imgClass}' style='width:150px; height:150px;'> \n"
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
 * 根据app_id 删除icon目录下的文件
 */
function del_vendor_app_icon($app_id)
{
global $app_data_url;
  $icon_url = $app_data_url . "icon/" . $app_id . ".png";
  if (file_exists ($icon_url)) {
    unlink($icon_url);
  }
}

/*
 * 根据app_id 删除screen目录下的文件
 */
function del_vendor_app_screen($app_id)
{
global $app_data_url;
  for ($i = 0; $i < 5; $i++) {
    $screen_url = $app_data_url . "screen/" . $app_id . "_" . $i . ".png";
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
global $app_data_url;
  $tmp_url = $app_data_url . "tmp/";
  $icon_url = $app_data_url . "icon/" . $app_id . ".png";

  if (file_exists ($icon_url)) {
    copy($icon_url, $tmp_url . $app_id . ".png");
  }
}

/*
 * 根据app_id 将screen下的图片复制到tmp目录下
 */
function screen_cp_tmp($app_id)
{
global $app_data_url;
  $tmp_url = $app_data_url . "tmp/";
  for ($i = 0; $i < 5; $i++) {
    $screen_url = $app_data_url . "screen/" . $app_id . "_" . $i . ".png";
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

<?php
include_once('_config.inc');
/*
 * 开发者上传应用，文件存储
 */

/*
 * 上传文件的临时路径
 */
$TEMPORAY_FILE_URL = $file_url . "tmp/";

$imgArr = array("jpg", "png", "gif");

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") 
{
  /*
   * file_type == "icon"  上传icon图片
   * file_type == "screen" 上传界面展示图片
   * file_type == "file" 上传安装文件
   */
  $file_type = $_POST['file_type'];
  $screen_number = $_POST['screen_number'];
  $file_name = $_FILES['photoimg']['name'];
  $file_size = round($_FILES['photoimg']['size'] / 1000,1);
  
  $suffix = interception_suffix($file_name);
  conditions_judge($file_name, $file_size, $imgArr, $file_type, $suffix);
  
  $new_file_url = new_file_name($file_name, $suffix, $TEMPORAY_FILE_URL, $file_type);
  $tmp = $_FILES['photoimg']['tmp_name'];
  
  $n = strripos($new_file_url, "/");
  $file = substr($new_file_url, $n+1);
  if ($file_type == "icon") {
    if (move_uploaded_file($tmp, $new_file_url)) {
      echo "<img src='getAppTmpFile.php?file_name=${file}' class='app-icon-preview' style='width:150px; height:150px;'>"
		. "<input type='hidden' id='appIconName' name='appIconName' value='${new_file_url}'>";
    } else {
      echo "上传出错了！";
    }
    exit;
  } else if ($file_type == "screen") {
    if (move_uploaded_file($tmp, $new_file_url)) {
       echo "<img src='getAppTmpFile.php?file_name=${file}' class='app-screen-preview-${screen_number}' style='width:150px; height:150px;'>"
                . "<input type='hidden'id='appScreenName${screen_number}' name='appScreenName${screen_number}' value='${new_file_url}'>";
    } else {
      echo "上传出错了！";
    }
    exit;
  } else {
    if (move_uploaded_file($tmp, $new_file_url)) {
      echo "<img src='getAppTmpFile.php?file_name=${file}' style='display:none;'>"
		. "<input type='hidden'id='file_name' name='file_name' value='${file_name}'>"
		. "<input type='hidden'id='file_size' name='file_size' value='${file_size}'>"
		. "<div id='file_show_name' style='float:left;clear:both;'><span>文件名称：</span><span>${file_name}</span></div>"
		. "<div id='file_show_size' style='float:left;clear:both;'><span>文件大小：</span><span>${file_size} KB</span></div>";
    } else {
      echo "上传出错了！";
    }
    exit;
  }
  
}

function interception_suffix($file_name)
{
  return pathinfo($file_name, PATHINFO_EXTENSION);
}

function conditions_judge($file_name, $file_size, $imgArr, $file_type, $suffix)
{
 if ($file_type == "icon" || $file_type == "screen") {
   if (empty($file_name)) {
     echo '请选择要上传的图片';
     exit;
   }
   if (!in_array($suffix, $imgArr)) {
     echo '图片格式错误！';
     exit;
   }
   if ($file_size>(1024*2)) {
     echo '图片大小不能超过2M';
     exit;
   }
 } else if ($file_type == "file") {
   if (empty($file_name)) {
     echo '请选择要上传的文件';
     exit;
   }
 } else {
   echo '非法上传！';
   exit;
 }

}

function new_file_name($file_name, $suffix, $TEMPORAY_FILE_URL, $file_type)
{
  $new_file_url = "";
  if ($file_type == "icon" || $file_type == "screen") {
    $image_name = time().rand(100,999).".".$suffix;
    $new_file_url = $TEMPORAY_FILE_URL . $image_name;
  } else {
    $new_file_url = $TEMPORAY_FILE_URL . $file_name;
  }
  return $new_file_url;
}

?>

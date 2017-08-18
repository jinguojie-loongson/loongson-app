/* 处理应用卡片的鼠标事件 */
/* 2017/5/26 首次改写成jquery版本 */

var SYS_DATA_DIR = "/opt/app/db/";
var SYS_DOWNLOAD_DIR = "/opt/app/cache/";
var INSTALL_SCRIPT = "/opt/app/localserver/install.sh";
var UNINSTALL_SCRIPT = "/opt/app/localserver/uninstall.sh";

/* ---------------------------------------------------- */

/* 系统目录下，每一个已安装应用的文件名：“ID”
 * 例如：
 *
 *  1:1.0.015:installed:日期
 *  2:2.3.245.2500:installed:日期
 */

function get_local_app_list(func, error_func)
{
  console.log("get_local_app_list: ");
  cmd = " cd " + SYS_DATA_DIR + "; cat * ";
  get_local_service(cmd, func, error_func);
}

/* 版本号格式：
 *    最多4段数字，以“.”分隔，
 *    都是10进制，范围0～65535
 *    可以是0。不是0时不能以0开头
 */
function app_version_compare(local_version, server_version)
{
  console.log(local_version, server_version);
  var lv = local_version.split(".");
  var sv = server_version.split(".");

  i = 0;
  while (i < lv.length && i < sv.length)
  {
    if (parseInt(lv[i]) < parseInt(sv[i]))
      return -1;
    if (parseInt(lv[i]) > parseInt(sv[i]))
      return 1;
    i++;
  }

  if (i < lv.length)
    return 1;
  if (i < sv.length)
    return -1;

  return 0;
}

function app_get_name(id)
{
  return $("#app_name").attr("value");
}

function app_get_server_version(id)
{
  return $("#app_version").attr("value");
}

function app_get_md5(id)
{
  return $("#app_md5").attr("value");
}

function app_get_install_script(id)
{
  return $("#app_install_script").attr("value");
}

/*   get_app_status(id)
 * 返回8种状态：
 *   "not-installed" - 未安装，
 *   "installed" 已安装，且最新
 *   "need-updated": 已安装，有升级版本
 *   "downloading": 下载中
 *   "checking-download-file": 检查下载文件
 *   "checking-download-file-error": 检查下载文件错误
 *   "installing": 安装中
 *   "install-error": 安装错误
 *   "uninstalling": 卸载中
 *   "uninstalling-error": 卸载错误
 */
function app_get_status(id, func) {
  console.log("check app: " + id);
  cmd = " mkdir -p " + SYS_DATA_DIR + "; cat " + SYS_DATA_DIR + id;

  var callback = function(data, errno) {
    var found_version = "";
    if(errno != 0)
    {
      status = "not-installed";
    }
    else
    {
      found_version = data.split(":")[1];
      status = data.split(":")[2];

      if (status == "installed")
      {
        if (app_version_compare(found_version, app_get_server_version(id)) < 0)
          status = "need-updated";
      }
    }
    func(status);
  }

  var error_func = function(txt) {
    console.log("获取本地服务失败>>> " + txt);
    status = "not-defined";
    func(status);
  }
  get_local_service(cmd, callback, error_func);
}

var app_status = [
    "not-installed",
    "installed",
    "need-updated",
    "downloading",
    "checking-download-file",
    "checking-download-file-error",
    "installing",
    "install-error"
];

function app_get_status_text(status)
{
  switch(status)
  {
    case "not-installed": return "未安装";
    case "installed": return "已安装";
    case "need-updated": return "已安装，有升级版本";
    case "downloading": return "正在下载";
    case "checking-download-file": return "检查下载文件";
    case "checking-download-file-error": return "下载文件错误";
    case "installing": return "正在安装";
    case "install-error": return "安装错误";
    case "uninstalling": return "卸载中";
    case "uninstalling-error": return "卸载错误";
  }
  return "错误状态";
}

function app_get_status_short_text(status)
{
  switch(status)
  {
    case "not-installed": return "未安装";
    case "installed": return "已安装";
    case "need-updated": return "有升级";
    case "downloading": return "下载中";
    case "checking-download-file": return "检查中";
    case "checking-download-file-error": return "文件错误";
    case "installing": return "安装中";
    case "install-error": return "安装错误";
    case "uninstalling": return "卸载中";
    case "uninstalling-error": return "卸载错误";
  }
  return "错误状态";
}

function app_get_button_text(status)
{
  switch(status)
  {
    case "not-installed": return "安 装";
    case "installed": return "已安装";
    case "need-updated": return "升级新版本";
    case "downloading": return "正在下载...";
    case "checking-download-file": return "检查下载文件...";
    case "checking-download-file-error": return "下载文件错误";
    case "installing": return "正在安装...";
    case "install-error": return "安装错误";
    case "uninstalling": return "正在卸载...";
    case "uninstalling-error": return "卸载错误";
  }
  return "错误状态";
}

function app_get_button_class(status)
{
  return status;
}

function app_button_change_status($btn, id, status)
{
  $btn.removeClass($btn.attr("class"))
  $btn.addClass("button " + app_get_button_class(status));

  $btn.text(app_get_button_text(status));

  $btn.css("disabled", 
     (status == "not-installed" || status == "need-updated") ? "true" : "false");

  $btn.off('click').click(function () {
     if (status == "not-installed")
       app_install($btn, id,"new_install");
     else if (status == "installed")
      /* 不可操作 */;
     else if (status == "need-updated")
       app_update($btn, id,"update");
     else if (status == "downloading")
       /* 不可操作 */;
     else if (status == "checking-download-file")
       /* 不可操作 */;
     else if (status == "checking-download-file-error")
       /* 不可操作 */;
     else if (status == "installing")
       /* 不可操作 */;
     else if (status == "install-error")
       /* 不可操作 */;
     else if (status == "uninstalling")
       /* 不可操作 */;
     else if (status == "uninstall-error")
       /* 不可操作 */;
   });

   if (status.indexOf("error") != -1)
   {
     warning_message(app_get_name(id) + app_get_button_text(status));
     app_clear_status($btn,id);
   }
}

/*
 * 下载一个应用
 */
function app_get_download_url(id)
{
  // http://localhost/app/php/app.php?id=1
  url = window.location.href;
  // 截取到最后一个“/” 

  n = url.lastIndexOf("/");
  return url.substr(0, n) + "/getAppFile.php?id=" + id;
}

function app_get_download_local_file(id)
{
  return SYS_DOWNLOAD_DIR + $("#app_filename").attr("value");
}

function app_inc_download_count(id)
{
  url = window.location.href;
  n = url.lastIndexOf("/");
  url = url.substr(0, n) + "/incAppDownloadCount.php?";
  var download_count_token=$("#download_count_token").val();
  var download_count_json={
          "download_count_json":{
                         "app_id" : id,
                         "download_count_token" : download_count_token
                         }
        };
  var obj=JSON.stringify(download_count_json);
  console.log(url);
  get_server_service_json(url, obj, function() {});
}

/*
 * 安装一个应用
 */


function app_install($btn, id,install_type)
{
  $btn.css("disabled", "true");
  console.log("app_install: " + id);

  app_button_change_status($btn, id, "installing");

  var version= app_get_server_version(id);
  var download_url = app_get_download_url(id);
  var download_file = app_get_download_local_file(id);
  var md5 = app_get_md5(id);

  /* 获取老的版本 */
  var old_verson_cmd = "cut -d: -f2 /opt/app/db/" + id;

  var get_old_version_callback = function(data, errno) {
    if (errno == 0) { // 命令正常执行，说明该应该已经安装过，也就是升级操作
      install_type = install_type + "-" + data;
    }

    /* 处理“[FILE]”通配符 */
    var install_script = app_get_install_script(id)
             .replace("[FILE]", download_file);

    cmd = INSTALL_SCRIPT + " "
              + id + " "
              + version + " "
              + download_url + " "
              + download_file + " "
              + md5
              + " \"" + install_script + "\" "
              + install_type;
    console.log(cmd);

    var callback = function(data, errno) {
      if (errno != 0)
      {
        console.log("安装应用程序不正常（返回值为" + data[0] + "）！");
      }
      else
      {
        success_message(app_get_name(id) + "安装成功");
        app_inc_download_count(id);
      }
    }

  console.log("开始安装");
  get_local_service(cmd, callback);

  /* 轮询更新按钮状态 */
  poll_status($btn, id);
}

  get_local_service(old_verson_cmd, get_old_version_callback);
}

/*
 * 升级一个应用
 */
function app_update($btn, id, install_type)
{
  app_install($btn, id,install_type);
}

/*
 * 删除一个应用
 */
function app_uninstall(app_id, app_name, uninstall_script)
{
  if (app_id == "999999")
  {
    info_message(app_name + "是预装应用，无法删除");  
    return;
  }

  console.log("uninstall: " + app_id, ", " + uninstall_script);

  cmd = UNINSTALL_SCRIPT + " "
             + app_id + " "
             + " \"" + uninstall_script + "\" ";
  var callback = function(data, errno) {
    if (errno != 0)
    {
      // 弹出错误提示，自动消失
      console.log("卸载应用程序不正常（返回值为" + data[0] + "）！");
    }
    else
    {
      success_message(app_name + "卸载成功");
    }
  }

  console.log("开始卸载");
  get_local_service(cmd, callback);
}


function poll_status($btn, id)
{
  /* 定时监测应用状态 */
  setTimeout(function() {
    refresh_app_status($btn, id);
  }, 1000);
}

function initButton($btn, id) {
  console.log("check app: " + id);

  refresh_app_status($btn, id);
}

function app_clear_status($btn,id)
{
  /*检测app目前状态：属于安装还是更新？*/
  console.log("获取app本机存储文件内容："+id);
  var check_cmd = "cat /opt/app/db/"+id;
  var check_callback = function(data,errno){
    var data_array = data.split(":");
    var old_version_array = data_array[3].split("-");
    var cmd = "";

    /*根据检测结果判断，是否删除本机记录*/
    if(data_array[3] == "new_install"){
      console.log("clear app: " + id);
      cmd = " rm -f " + SYS_DATA_DIR + id;
    }
    if(old_version_array[0] == "update"){
      cmd = "echo " + id +":" + old_version_array[1] + ":installed:new_install  >"+ SYS_DATA_DIR + id;
    }
    var callback = function(data, errno) {
      refresh_app_status($btn,id);
    };

    get_local_service(cmd, callback);

  };

  get_local_service(check_cmd, check_callback);

}

function refresh_app_status($btn, id) {
  console.log("refresh_app_status " + id);

  app_get_status(id, function(status) {
    app_button_change_status($btn, id, status);

    /* 2017/6/7 重点：有以前遗留的任务，需要继续监控状态变化 */
    if (status == "downloading"
          || status == "checking-download-file"
          || status == "installing")
    {
      setTimeout(function() {
        refresh_app_status($btn, id);
      }, 1000);
    }
  });
}

function get_app_status_in_local_list(id, server_version, app_list_data)
{
  var apps = app_list_data.split("\n");

  i = 0;
  while(i < apps.length)
  {
    app = apps[i];
    var data = app.split(":");
    app_id = data[0];
    local_version = data[1];
    status = data[2];

    if (id == app_id)
    {
      if (status == "installed" && app_version_compare(local_version, server_version) < 0)
        return "need-updated";
      else
        return status;
    }
    i++;
  }
  return "not-installed";
}

function refresh_app_card_status()
{
  get_local_app_list(function(app_list_data, errno) {
    if (errno == 0)
    {
      $("#app-card-grid div").each(function() {
        id = $(this).attr("id");
        version = $(this).find("#app_version").attr("value");
        $status = get_app_status_in_local_list(id, version, app_list_data);

        $status_icon = $(this).find("#app-icon")
        if ($status == "not-installed")
          $status_icon.fadeOut(1000);
        else
        {
          $status_icon.removeClass($status_icon.attr("class")).addClass($status);
          $status_icon.text(app_get_status_short_text($status));
          $status_icon.fadeIn(1000);
        }
      });
    }
    else
      $("#app-card-grid").html("本机还没有安装任何应用程序，赶快去逛逛吧。");
  });

  setTimeout(refresh_app_card_status, 1000);  
}

$(document).ready(function(){
  /* 2017/6/6 使用chrome.exe -app方式运行时，禁用右键菜单 */
  document.oncontextmenu=function(e){return false;}  

  /* 遍历#app-card-grid里面的每一个应用程序卡片 */
  $("#app-card-grid").on('mouseover', 'div', function () {
    $(this).css("background-color", "#cccccc");
  });

  $("#app-card-grid").on('mouseout', 'div', function () {
    $(this).css("background-color", "#eeeeee");
  });

  $("#app-card-grid").on('click', 'div', function () {
    window.location.href = "app.php?id=" + $(this).attr("id");
  });

  if (window.location.href.indexOf("my.php") == -1
      && window.location.href.indexOf("app.php") == -1
      && window.location.href.indexOf("client.php") == -1
      && window.location.href.indexOf("vendor_login.php") == -1
      && window.location.href.indexOf("vendor_logout.php") == -1
      && window.location.href.indexOf("vendor_register.php") == -1)
  {
    refresh_app_card_status();
  }

  /* 返回按钮 */
  $("#app-back").click(function () {
    window.history.back();
  });

  if (window.location.href.indexOf("app.php") != -1)
  {
    var $btn = $("#installApp");
    var id = $("#app_id").attr("value");

    /* 安装按钮 */
    initButton($btn, id);
  }
});

/* 处理应用卡片的鼠标事件 */
/* 2017/5/26 首次改写成jquery版本 */

var SYS_DATA_DIR = "/etc/app/";
var SYS_DOWNLOAD_DIR = "/var/lib/app/";

/* ---------------------------------------------------- */

/* 系统目录下，每一个已安装应用的文件名：“ID：版本号”
 * 例如：
 *
 *  1:1.0.015
 *  2:2.3.245.2500
 */

function get_local_app_list(func)
{
  console.log("get_local_app_list: ");
  cmd = " cd " + SYS_DATA_DIR + "; ls *:* ";

  get_local_service(cmd, func);
}

function app_is_downloading(id)
{
  // TODO:
  return false;
}

function app_is_installing(id, version)
{
  // TODO:
  return false;
}

/* 版本号格式：
 *    最多4位数字，以“.”分隔，
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

function app_get_server_version(id)
{
  return $("#app_version").attr("value");
}

function app_register_installed(id, version)
{
  console.log("app_register_installed: " + id + ", " + version);
  reg_file = SYS_DATA_DIR + id + ":" + version;
  cmd = " rm -rf " + SYS_DATA_DIR + id + ":*; date >  " + reg_file;

  var callback = function(data, errno) {
    if (errno != 0)
      console.log("安装记录创建不成功");
  }

  get_local_service(cmd, callback);
}

/*   get_app_status(id)
 * 返回4种状态：
 *   "not-installed" - 未安装，
 *   "installed" 已安装，且最新
 *   "need-updated": 已安装，有升级版本
 *   "downloading": 下载中
 *   "checking-download-file": 检查下载文件
 *   "checking-download-file-error": 检查下载文件错误
 *   "installing": 安装中
 *   "install-error": 安装错误
 */
function app_get_status(id, func) {
  console.log("check app: " + id);
  cmd = " mkdir -p " + SYS_DATA_DIR + "; ls " + SYS_DATA_DIR + id + ":*";

  var callback = function(data) {
    var found_version = "";
    if (data.indexOf(SYS_DATA_DIR + id + ":") == 0)
      found_version = data.split(":")[1];

    if (app_is_downloading(id))
      data = "downloading";
    else if (app_is_installing(id))
      data = "installing";
    else if (found_version == "")
    {
      data = "not-installed";
    }
    else if (found_version != "")
    {
      if (app_version_compare(found_version, app_get_server_version(id)) < 0)
        data = "need-updated";
      else
        data = "installed";
    }
    func(data);
  }

  get_local_service(cmd, callback);
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

  $btn.click(function () {
     if (status == "not-installed")
       app_install($btn, id);
     else if (status == "installed")
      /* 不可操作 */;
     else if (status == "need-updated")
       app_update($btn, id);
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
   });
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

function app_download($btn, id, func) {
  console.log("download app: " + id);

  app_button_change_status($btn, id, "downloading");

  $btn.click(function () {});

  /* 开始下载，以后台方式调用wget */
  /* 先删除文件 */
  download_file = app_get_download_local_file(id);
  cmd = "mkdir -p " + SYS_DOWNLOAD_DIR + "; rm -rf " + download_file + "; "
      + "wget -r -p " + app_get_download_url(id) + " -O " + download_file;

  console.log(cmd);

  var callback = function(data) {
    func(data);
  }

  console.log("下载开始");
  get_local_service(cmd, callback);
}


function app_check_download_file($btn, id, func) {
  console.log("check download app: " + id);

  app_button_change_status($btn, id, "checking-download-file");

  $btn.click(function () {});

  /* md5sum */
  download_file = app_get_download_local_file(id);
  cmd = "md5sum " + download_file;

  console.log(cmd);

  var callback = function(data) {
    console.log("下载文件MD5: " + data);
    console.log (data.indexOf($("#app_md5").attr("value")) );
    if (data.indexOf($("#app_md5").attr("value")) != 0)
    {
      // 弹出错误提示，自动消失
      console.log("下载文件MD5不正常！");
      app_button_change_status($btn, id, "checking-download-file-error");

      setTimeout(function() {
        initButton($btn, id);
      }, 3000);
    }
    else
      func(data);
  }

  console.log("开始检查md5");
  get_local_service(cmd, callback);
}

function app_exec_install_script($btn, id, func)
{
  console.log("app_exec_install_script: " + id);

  app_button_change_status($btn, id, "installing");
  $btn.click(function () {});

  /* 处理“[FILE]”通配符 */
  cmd = $("#app_install_script").attr("value").
              replace("[FILE]", app_get_download_local_file(id));
  console.log(cmd);

  var callback = function(data, errno) {
    if (errno != 0)
    {
      // 弹出错误提示，自动消失
      console.log("安装脚本执行不正常（返回值为" + data[0] + "）！");
      app_button_change_status($btn, id, "install-error");

      setTimeout(function() {
        initButton($btn, id);
      }, 3000);
    }
    else
      func(data);
  }

  console.log("开始安装");
  get_local_service(cmd, callback);
}

/*
 * 安装一个应用
 */
function app_install($btn, id)
{
  console.log("app_install: " + id);

  /* 安装状态图 */
  app_download($btn, id, function(data) {
    // 启动定时器，监控下载过程
    console.log("下载结束");

    app_check_download_file($btn, id, function(data) {
      console.log("下载文件正常");
      app_exec_install_script($btn, id, function(data) {
        console.log("安装成功");
        app_button_change_status($btn, id, "installed");

        app_register_installed(id, app_get_server_version());
      });
    });
  });
}

/*
 * 升级一个应用
 */
function app_update($btn, id)
{
  app_install($btn, id);
}

function initButton($btn, id) {
  console.log("check app: " + id);

  app_get_status(id, function(status) {
    app_button_change_status($btn, id, status);
  });
}

$(document).ready(function(){

  /* 2017/6/6 使用chrome.exe -app方式运行时，禁用右键菜单 */
  document.oncontextmenu=function(e){return false;}  

  /* 遍历#app-card-grid里面的每一个应用程序卡片 */
  $("#app-card-grid").on('mouseover', 'div', function () {
    $(this).css("background-color", "#aaaaaa");
  });

  $("#app-card-grid").on('mouseout', 'div', function () {
    $(this).css("background-color", "#eeeeee");
  });

  $("#app-card-grid").on('click', 'div', function () {
    window.location.href = "app.php?id=" + $(this).attr("id");
  });

  /* 返回按钮 */
  $("#app-back").click(function () {
    window.history.back();
  });

  if (window.location.href.indexOf("app.php") != -1)
  {
    /* 安装按钮 */
    initButton($("#installApp"), $("#app_id").attr("value"));
  }
});

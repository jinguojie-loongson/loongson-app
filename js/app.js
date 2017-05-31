/* 处理应用卡片的鼠标事件 */
/* 2017/5/26 首次改写成jquery版本 */

var SYS_DATA_DIR = "/etc/app";
/* 系统目录下，每一个已安装应用的文件名：“ID：版本号” */

/* ---------------------------------------------------- */
function app_is_downloading(id)
{
  // TODO:
  return false;
}

function app_is_installing(id)
{
  // TODO:
  return false;
}

function app_version_compare(id)
{
  // TODO:
  return 0;
}

function app_get_server_version(id)
{
  // TODO:
  return "4.12.3445";
}

/*   get_app_status(id)
 * 返回4种状态：
 *   "not-installed" - 未安装，
 *   "installed" 已安装，且最新
 *   "need-updated": 已安装，有升级版本
 *   "downloading": 下载中
 *   "installing": 安装中
 */
function app_get_status(id, func) {
  console.log("check app: " + id);
  cmd = " mkdir -p " + SYS_DATA_DIR + "; ls " + SYS_DATA_DIR;

  var callback = function(data) {
    var found_version = "";
    var files = data.split(" ");
    for (var file in files)
    {
      if (id == file.split(":")[0])
      {
        found_version = file.split(":")[1];
      }
    }

    if (app_is_downloading(id))
      data = "installing";
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

function app_get_status_text(status)
{
  switch(status)
  {
    case "not-installed": return "未安装";
    case "installed": return "已安装";
    case "need-updated": return "已安装，有升级版本";
    case "downloading": return "正在下载";
    case "installing": return "正在安装";
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
    case "installing": return "正在安装...";
  }
  return "错误状态";
}

function app_get_button_class(status)
{
  return status;
}

/*
 * 安装一个应用
 */
function app_install($btn, id)
{
  console.log("app_install: " + id);
  /* 安装状态图 */
}

function initButton($btn, id) {
  console.log("check app: " + id);

  app_get_status(id, function(status) {
    //$btn.text(app_get_status_text(status));
    $btn.text(app_get_button_text(status));
    $btn.addClass(app_get_button_class(status));
    $btn.click(function () {
      if (status == "not-installed")
        app_install($btn, id);
      else if (status == "installed")
        /* 不可操作 */;
      else if (status == "need-updated")
        app_update($btn, id);
      else if (status == "installing")
        /* 不可操作 */;
    });
  });
}

$(document).ready(function(){
  /* 遍历#app-card-grid里面的每一个应用程序卡片 */
  $("#app-card-grid div").mouseover(function () {
    alert("hehe");
    $(this).css("background-color", "#aaaaaa");
  });

  $("#app-card-grid div").mouseout(function () {
    $(this).css("background-color", "#eeeeee");
  });

  $("#app-card-grid div").click(function () {
    window.location.href = "app.php?id=" + $(this).attr("id");
  });


  /* 返回按钮 */
  $("#app-back").click(function () {
    window.history.back();
  });

  /* 安装按钮 */
  initButton($("#installApp"), $("#app_id").attr("value"));
});

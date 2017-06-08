/* 我的应用 */
function on_receive_app_html(html)
{
  console.log("on_receive_app_html: " + html);
  $("#app-card-grid").html(html);
}

function get_my_app_html(app_list_data, func)
{
  url = window.location.href;
  n = url.lastIndexOf("/");
  url = url.substr(0, n) + "/getMyAppHtml.php";
  
  get_server_service(url, app_list_data, func);
}

/* Chrome APP不支持async:false */
function init_local_app_list()
{
  get_local_app_list(function(app_list_data, errno) {
    if (errno == 0)
      get_my_app_html(app_list_data, on_receive_app_html);
    else
      $("#app-card-grid").html("本机还没有安装任何应用程序，赶快去逛逛吧。");
  });

  setTimeout(init_local_app_list, 1000);  
}

if (window.location.href.indexOf("my.php") != -1)
{
  $(document).ready(function(){
    init_local_app_list();
  });
}

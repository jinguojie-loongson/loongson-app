/* 按钮导航 */
pages = {
  "top-home" : "index.php",
  "top-rank" : "rank.php",
  "top-category" : "category.php",
  "top-my" : "my.php"
};

function do_search(text)
{
console.log(text);
  if (text.length == 0)
    return;

  url = window.location.href;
  // 截取到最后一个“/” 

  n = url.lastIndexOf("/");
  window.location.href = url.substr(0, n) + "/search.php?search=" + encodeURI(text);
}

/* "我的": 显示升级应用的数量 */
function on_receive_update_number(number)
{
  console.log("on_receive_update_number: " + number);

  if (number > 99)
    number = 99;

  if (number > 0)
  {
    $(".update-circle").text(number);
    $(".update-circle").fadeIn(1000);
  }
  else
    $(".update-circle").fadeOut(1000);
}

function get_update_number(app_list_data, func)
{
  url = window.location.href;
  n = url.lastIndexOf("/");
  url = url.substr(0, n) + "/getUpdateNumber.php";
  
  get_server_service(url, app_list_data, func);
}

function init_my_update_number()
{
  get_local_app_list(function(app_list_data, errno) {
    if (errno == 0)
    {
      get_update_number(app_list_data, on_receive_update_number);
    }
  });

  setTimeout(init_my_update_number, 1000);  
}

function init_client_prompt()
{
  get_local_app_list(function(data) {},
    /* error */
    function(txt) {
      $("#client-prompt").fadeIn(200);
    }
  );
}

$(document).ready(function(){
  for (p in pages) {
    var $btn = $("#" + p);
    if (window.location.href.indexOf(pages[p]) != -1)
    {
      $btn.addClass("topbar-button-focus");
    }

    $btn.click(function() {
      window.location.href = pages[this.id];
    });
  } 


  /* 搜索框 */
  $search = $("#searchText")

  if (UrlGetQueryString("search") != null)
    $search.val(UrlGetQueryString("search"));

  $search.focus(function() {
    if ($search.val().indexOf("搜索应用") == 0)
    {
      $search.val("");
      $search.css("color", "#111111");
    }
  });

  $search.blur(function() {
    if ($search.val().length == 0)
    {
      $search.val("搜索应用...");
      $search.css("color", "gray");
    }
  });

  $search.keyup(function(event) {
    console.log(event.keyCode);
    if (event.keyCode == 13)
    {
      do_search($search.val());
    }
  });

  /* “我的”显示升级数量 */
  init_my_update_number();

  /* 安装客户端工具的提示框 */
  if (window.location.href.indexOf("client.php") == -1)
    init_client_prompt();
});

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
});

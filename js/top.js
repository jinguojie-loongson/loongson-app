/* 按钮导航 */
pages = {
  "top-home" : "index.php",
  "top-rank" : "rank.php",
  "top-category" : "category.php",
  "top-my" : "my.php"
};

$(document).ready(function(){
  for (p in pages) {
    var $btn = $(p);
    if (window.location.href.indexOf(pages[p]) != -1)
    {
      $btn.className= "topbar-button-focus";
    }

    $btn.click(function() {
      window.location.href = pages[this.id];
    });
  } 


  /* 搜索框 */
  $search = $("#searchText")
  $search.focus(function() {
    if ($search.attr("value").indexOf("搜索应用") == 0)
    {
      $search.attr("value", "");
      $search.css("color", "#222222");
      // TODO: 复用index.php
    }
  });

  $search.blur(function() {
    if (searchText.value.length == 0)
    {
      searchText.value = '搜索应用...';
      searchText.style.color = 'gray';
      // TODO: 复用index.php
    }
  });
}

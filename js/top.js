/* 按钮导航 */
pages = {
  "top-home" : "index.php",
  "top-rank" : "rank.php",
  "top-category" : "category.php",
  "top-my" : "my.php"
};

for (p in pages) {
  var btn = document.getElementById(p);
  if (window.location.href.indexOf(pages[p]) != -1)
  {
    btn.className= "topbar-button-focus";
  }

  btn.onclick = function() {
    window.location.href = pages[this.id];
  }
} 


/* 搜索框 */
searchText = document.getElementById('searchText');

searchText.onfocus = function() {
  if (searchText.value.indexOf("搜索应用") == 0)
  {
    searchText.value = '';
    searchText.style.color = '#222222';
    // 复用index.php
  }
}

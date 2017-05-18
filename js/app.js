/* 处理应用卡片的鼠标事件 */
window.onload = function() {
  var grid = document.getElementById('app-icon-grid');

  if (grid)
  {
    var cs = grid.getElementsByTagName("div");
    for(i = 0; i < cs.length; i++)
    {
      cs[i].onmouseover = function() {
        this.style.background = "#aaaaaa";
      }
      cs[i].onmouseout = function() {
        this.style.background = "#eeeeee";
      }
      cs[i].onclick = function() {
        window.location.href = "app.php?id=" + this.id;
      }
    }
  }
}

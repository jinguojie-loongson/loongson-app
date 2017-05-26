/* 处理应用卡片的鼠标事件 */
/* 2017/5/26 首次改写成jquery版本 */

$(document).ready(function(){
  /* 遍历#app-card-grid里面的每一个应用程序卡片 */
  $("#app-card-grid div").mouseover(function () {
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
});

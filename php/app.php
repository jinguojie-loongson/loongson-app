<?php
  include_once('header.php');
  include_once('top.php');
  include_once('_app.inc');
?>

<!-- 
  应用程序：主界面
-->

<div id="app-back">
&lt;
</div>

<div id="app-card-grid">
<?=
  get_app_icon_html($_GET['id']);
?>
</div>

<div style="background-color: #eeeeee; height: 20px; margin: 10px; padding: 50px;">
安装、升级
</div>

<div style="background-color: #eeeeee; height: 20px; margin: 10px; padding: 50px;">
图片展示区
</div>

<div style="background-color: #eeeeee; height: 20px; margin: 10px; padding: 50px;">
发行说明、版本信息
</div>

<div style="background-color: #eeeeee; height: 20px; margin: 10px; padding: 50px;">
推荐同类应用
<p>
（安装过该应用的用户还喜欢）
</div>

<div style="background-color: #eeeeee; height: 20px; margin: 10px; padding: 50px;">
同开发者其它应用
</div>

<div style="background-color: #eeeeee; height: 20px; margin: 10px; padding: 50px;">
评论
</div>

<?php
  include_once('footer.php');
?>

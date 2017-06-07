<?php
  include_once('header.php');
  include_once('top.php');
  include_once('_rank.inc');
  include_once('_app.inc');
?>

<!-- 
  应用程序：主界面
-->
<?php
  $app_id = $_GET['id'];
  if (is_empty($app_id))
    fatal_error("传入应用程序的ID不能为空！");
?>

<div class="app-form">
  <div id="app-back"> &lt; </div>

  <table class="app-header" border="0">
    <tr>
      <td class="td-img" rowspan="6">
        <?= get_app_icon_html($app_id); ?> 
        <div class="button installed" id="installApp">获取应用状态...</div>
        <div id="error">error</div>
        <input type="hidden" id="app_id" value="<?= $app_id ?>">
        <input type="hidden" id="app_version" value="<?= get_app_version($app_id) ?>">
        <input type="hidden" id="app_filename" value="<?= get_app_file_by_id($app_id) ?>">
        <input type="hidden" id="app_md5" value="<?= get_app_md5_by_id($app_id) ?>">
        <input type="hidden" id="app_install_script" value="<?= get_app_install_script_by_id($app_id) ?>">
      </td>
      <td colspan="2" class="title"> <?= get_app_name($app_id) ?> </td>
    </tr>
    <tr>
      <td class="td-label"> 软件作者：</td>
      <td class="gray"> <?= get_app_vendor($app_id) ?> </td>
    </tr>
    <tr>
      <td class="td-label"> 版本：</td>
      <td class="gray"> <?= get_app_version($app_id) ?> </td>
    </tr>
    <tr>
      <td> 下载大小：</td>
      <td class="gray"> <?= get_app_download_size($app_id) ?>  </td>
    </tr>
    <tr>
      <td> 下载次数：</td>
      <td class="gray"> <?= get_app_download_count($app_id) ?>  </td>
    </tr>
    <tr>
      <td> 软件简介：</td>
      <td class="gray"> <?= get_app_description($app_id) ?>  </td>
    </tr>
  </table>
<!--
    <p> 软件作者：<span class="black"> 腾讯 </span> </p>
    <p> 下载大小：<span class="black"> 13.6MB </span> </p>
    <p> 下载次数：<span class="black"> 235935 </span> </p>
    <p> 软件简介：<span class="black"> 2015年1月11日 - 这是一款效果非常炫酷的CSS3表单input输入框美化效果插件。该input输入框美化插件共14种效果。<br>大多数是使用CSS transitions来切换伪元素制作的。其中还有... 2015年1月11日 - 这是一款效果非常炫酷的CSS3表单input输入框美化效果插件。该input输入框美化插件共14种效果。大多数是使用CSS transitions来切换伪元素制作的。其中还有... 2015年1月11日 - 这是一款效果非常炫酷的CSS3表单input输入框美化效果插件。该input输入框美化插件共14种效果。大多数是使用CSS transitions来切换伪元素制作的。其中还有... </span> </p>
-->

  <div class="vspace">
  </div>

  <div class="gray-box">
  <!-- 
  图片展示区
  -->
  <?= get_app_screen_file_html($app_id) ?>
  </div>

  <div class="gray-box" id="longdesc">
  <!-- 《详细信息》
       发行说明、版本信息，长文，HTML格式 -->
  <?= get_app_longdesc($app_id) ?>

<b>版本信息：</b>
<p>
这个就是我们最好的目标。如果敢兴趣的话好吧，那你继续看吧。
<br>
首先这个按钮有用到css3.0的新样式属性。如果你的浏览器没有看到边角圆弧的样式，那就说明你的浏览器版本不支持css3.0的新样式。解决办法，升级浏览器到最新的。据我所知XP、Windows Server2003最高支持的是IE8（可以看到效果了），如果你不想升级IE，那们你可要下载不是IE为内核的浏览器，比如火狐、谷歌、Opera等等。
<p>
<br>
<b>发行说明：</b>
<p>
好了前面这么多废话，我们该看一下如何做出我们漂亮的按钮吧。
<br>
其实我们这里用到了css的伪元素，hover。
<br>
首先我们必须在页面上，放一个input类型的button按钮。对这个button按钮进行css的样式的添加。
  </div>

  <div class="gray-box">
    <div> 推荐同类应用</div>
    <div id="app-card-grid">
        <?= get_most_rank_app_html_by_category(get_app_category_id($app_id), 20, $app_id); ?>
    </div>
  </div>

<!--
  <div class="gray-box">
  TODO: 评论
  </div>
-->
</div>

<?php
  include_once('footer.php');
?>

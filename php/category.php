<?php
  include_once('header.php');
  include('top.php');
  include('_rank.inc');
?>

<!--
分类推荐：
-->
<p>
<?php
  include_once('_category.inc');
?>

<div class="category-menu">
<?php
  $category = get_all_category_with_id();
  if (count($category) == 0)
    fatal_error("请设置应用分类。");

  /* 如果是不带参数的进入本页面，则重定向到第一个分类 */
  if (is_empty($_GET) || is_empty($_GET["category"]))
  {
    header("location:category.php?category=" . $category[0][0]);
  }

  /* URL中带有指定的分类 */
  foreach($category as $c)
  {
    $c_id = $c[0];
    $c_name = $c[1];
    echo "<div id='${c_id}' onclick=\" goto_category('${c_id}'); \">${c_name}</div>";
    echo "\n";
  }
?>
</div>

<div id="app-card-grid">
        <?= get_most_rank_app_html_by_category($_GET["category"]); ?>
</div>

<script type="text/javascript" src="../js/category.js"></script>
<?php
  include_once('footer.php');
?>

<?php
  include_once('header.php');
  include('top.php');
?>

分类推荐：
<p>
<?php
  include_once('_category.inc');

  $category = get_all_category();
  foreach($category as $c)
  {
    echo "<div class='category' onclick=\" goto_catetory('$c'); \">$c</div>";
    echo "\n";
  }
?>

<?php
  include_once('footer.php');
?>

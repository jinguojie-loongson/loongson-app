<?php
  include_once('header.php');
  include('top.php');
  include('_rank.inc');
  include('_search.inc');
?>

<?php
  $search = ($_GET['search']);
?>

<div id="app-back"> <i class='fa fa-chevron-left'></i> </div>

<h3>搜索“ <?= $search ?> ”的结果：</h3>

<div id="app-card-grid">
        <?= get_search_app_html($search); ?>
</div>

<?php
  include_once('footer.php');
?>

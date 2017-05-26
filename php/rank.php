<?php
  include_once('header.php');
  include('top.php');
  include('_rank.inc');
?>

<h3>应用排名</h3>（下载量最多的100个应用）

<div id="app-card-grid">
        <?= get_most_rank_app_html(); ?>
</div>


<?php
  include_once('footer.php');
?>

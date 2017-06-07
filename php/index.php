<?php
  include_once('header.php');
  include('top.php');
  include('_hot.inc');
  include('_rank.inc');
?>

<h3>&nbsp;</h3>

<!-- 主界面：广告轮播 -->
<link rel="stylesheet" href="../css/slides.css">
<script src="../js/slides.min.js"></script>

  <div class="container">
    <div id="slides">
<!--
      <img src="img/example-slide-1.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
      <img src="img/example-slide-2.jpg" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/">
      <img src="img/example-slide-3.jpg" alt="Photo by: Mike Ranweiler Link: http://www.flickr.com/photos/27874907@N04/4833059991/">
      <img src="img/example-slide-4.jpg" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
-->
                <?= get_hot_banner_html(); ?>
    </div>
  </div>

<div id="app-card-grid">
<h3 class="gray">精品推荐</h3>
        <?= get_most_rank_app_html(); ?>
</div>

<?php
  include_once('footer.php');
?>

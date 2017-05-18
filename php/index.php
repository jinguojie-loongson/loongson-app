<?php
  include_once('header.php');
  include('top.php');
  include('_hot.inc');
  include('_rank.inc');
?>

<link type="text/css" rel="Stylesheet" href="../css/imageflow.css" />
<link type="text/css" rel="Stylesheet" href="../css/app.css" />

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/imageflow.js"></script>

<!-- 主界面：广告轮播 -->

<div id="LoopDiv">
	<input id="S_Num" type="hidden" value="8" />
	<div id="starsIF" class="imageflow"> 
<!-- 
		<img id="1" src="../images/1.png" longdesc="#" width="280" height="300" alt="Picture" /> 
-->
                <?= get_hot_banner_html(); ?>
	</div>
</div>

<h3>精品应用 <?= get_hot_count() ?>个</h3>

<div id="MostRank" class="app-icon-grid"> 
                <?= get_most_rank_app_html(); ?>
</div>

<?php
  include_once('footer.php');
?>

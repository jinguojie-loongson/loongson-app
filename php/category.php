<?php
/*
 * loongson-app - The Loongson Application Community
 * 
 * Copyright (C) 2017 Loongson Technology Corporation Limited
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 *
 * In addition, as a special exception, the copyright holders give
 * permission to link the code of portions of this program with the
 * OpenSSL library under certain conditions as described in each
 * individual source file, and distribute linked combinations
 * including the two.
 * You must obey the GNU General Public License in all respects
 * for all of the code used other than OpenSSL.
 * If you modify file(s) with this exception, you may extend this exception
 * to your version of the file(s), but you are not obligated to do so.
 * If you do not wish to do so, delete this exception statement from your
 * version.
 * If you delete this exception statement from all source
 * files in the program, then also delete it here.
 *
 */
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

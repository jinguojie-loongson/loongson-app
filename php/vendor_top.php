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

include_once('_vendor_login.inc');

if (is_empty(get_current_vendor()))
  request_forward('vendor_login.php');
?>

<div id="workbench_navbar" class="navbar navbar-default navbar-fixed-top">
  <div class="navbar-header">
      <span class="navbar-brand">开发者工作台</span>
  </div>

  <form class="navbar-form navbar-right">
    <div id="vendor-menu">
      <span id="vendor-name"> <?= get_vendor_name(get_current_vendor()) ?>
        <span class="caret"></span>
      </span>

      <div class="dropdown open">
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" >
          <li><a href="vendor_updateInfo.php">设置</a></li>
          <li class="divider"></li>
          <li><a href="vendor_logout.php">退出</a></li>
        </ul>
      </div>
    </div>

  </form>

</div>

<!--
<div class="topbar">
  <div id="vendor-logo">
    <img src="../images/favicon.png" width="34" height="34" align="absmiddle" />
    开发者工作台
  </div>

  <div id="vendor-menu">
    <span id="vendor-name"> <?= get_vendor_name(get_current_vendor()) ?>
      <i class='fa fa-caret-down'></i>
    </span>
    <ul class="dropdown">
      <li><a href="vendor_updateInfo.php">设置</a></li>
      <li><a href="vendor_logout.php">退出</a></li>
    </ul>
  </div>
</div>
-->

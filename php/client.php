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
  include('_client.inc');
?>


<div class="app-form">
  <div id="app-back"> <i class='fa fa-chevron-left'></i> </div>

  <table class="app-header" border="0">
    <tr>
      <td class="td-img" rowspan="6">
        <img src="../images/favicon.png" width="105" height="104" border="0">
        <div class="not-installed" id="downloadClient">下载客户端工具</div>
      </td>
      <td colspan="2" class="title"> 龙芯应用公社客户端工具 </td>
    </tr>
    <tr>
      <td class="td-label"> 软件作者：</td>
      <td class="gray"> Loongson.cn </td>
    </tr>
    <tr>
      <td class="td-label"> 版本：</td>
      <td class="gray"> <?= get_client_version() ?> </td>
    </tr>
    <tr>
      <td> 软件简介：</td>
      <td class="gray"> 龙芯应用公社的客户端工具 </td>
    </tr>
  </table>

  <div class="vspace">
  </div>


  <div class="gray-box" id="longdesc">
  <!-- 《详细信息》 -->
      <h3 class="gray"> 安装环境 </h3>
        <a href="http://www.loongnix.org">龙芯Loongnix（Fedora21，64位）</a>
        <p>
        2017.4.30以后版本都可以
        <p>
       （后续版本将支持更多龙芯操作系统平台）

      <h3 class="gray"> 安装方法 </h3>
        打开系统的终端程序，在命令行上执行：
        <pre>
        $ su
        （输入root密码）
        # cd <进入安装文件的下载目录>
        # sh <?= get_client_download_filename() ?>
        </pre>

      <h3 class="gray"> 使用方法 </h3>
        在桌面上，有一个“应用公社”图标，点击运行。
  </div>

  <div class="gray-box" id="longdesc">
      <h3 class="gray"> 项目主页 </h3>
        <a href="https://github.com/jinguojie-loongson/loongson-app">https://github.com/jinguojie-loongson/loongson-app</a>
  </div>

  <div class="gray-box" id="longdesc">
      <h3 class="gray"> 版本历史 </h3>
        <pre>
<?= get_client_changelog() ?>
        </pre>
  </div>
</div>

<?php
  include_once('footer.php');
?>

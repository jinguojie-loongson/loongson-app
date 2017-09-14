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
/*
 * 返回一个应用的Icon图片
 */
include_once('_app.inc');
include_once('_rank.inc');
include_once('_my.inc');

/* 前端提交的$app_list_data：
 *   系统目录下，每一个已安装应用的文件名：“ID：版本号:状态：日期”，回车符分割
 *
 * 例如：
 *
 *  1:1.0.015:状态:日期
 *  2:2.3.245.2500:状态:日期
 */
$app_list_data = $_POST['data'];
$os_id = $_GET['os_id'];

$n = 0;

$ss = explode("\n", $app_list_data);

foreach ($ss as $a)
{
  $p = explode(":", $a);
  $app_id = $p[0];
  $version = $p[1];
  $status = $p[2];
  $server_version = array_values(get_app_file_version_status($app_id, $os_id));
  /* 如果有升级，则需要显示一个额外的红点 */
  if ($status == "installed" && app_version_compare($version, $server_version[0][0]) < 0)
    $n ++;
}

echo $n;
exit;
?>

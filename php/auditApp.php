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
 * 审核应用
 */
include_once('_util.inc');
include_once('_app.inc');
include_once('_review.inc');
include_once('_vendor_login.inc');
session_start();
$appid = is_empty($_GET['appid']) ? $_POST['data'] : $_GET['appid'];  
$isExistAudit =  is_empty($_GET['isExistAudit']) ? $_POST['data'] : $_GET['isExistAudit'];
$versionreview =  is_empty($_GET['versionreview']) ? $_POST['data'] : $_GET['versionreview'];
$isappOfftheshelf =  is_empty($_GET['isappOfftheshelf']) ? $_POST['data'] : $_GET['isappOfftheshelf'];
$comment = is_empty($_GET['comment']) ? $_POST['data'] : $_GET['comment'];

$date_time = time();
$is_admin = 1;

if($isappOfftheshelf == 0) {
  $is_admin = 0;
}
$operator = get_current_vendor();
$status = "";

if($isExistAudit == 1) { 
  $status = "published";
  $result=update_app_appfile_review($appid,$versionreview,$is_admin,$operator,$status,$comment,$date_time,$isExistAudit);
}
if($isExistAudit == 2) {
  $status = "rejected";
  $result=update_app_appfile_review($appid,$versionreview,$is_admin,$operator,$status,$comment,$date_time,$isExistAudit);
  echo $result;
}
if($isExistAudit == 3) {
  $status = "off_the_shelf";
  $result=update_app_appfile_review($appid,$versionreview,$is_admin,$operator,$status,$comment,$date_time,$isExistAudit);
  echo $result;
}
 
?>

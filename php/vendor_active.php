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

	include_once('_db.inc');
	$verify = stripslashes(trim($_GET['verify']));
	$nowtime = time();
	$query = mysql_query("select id,token_exptime from  vendor  where status='0' and token='${verify}'");
	$row =db_get_two_columns($query);
	if($row){
	if($nowtime>$row['token_exptime']){ //30min
	$msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.';
	}else{
	mysql_query("update vendor  set status=1 where id=".$row['id']);
	//if(mysql_affected_rows($link)!=1) die(0);

	$msg = '激活成功！';

	//}

	//}else{

	//$msg = 'error.';

	//}

echo $msg;
?>

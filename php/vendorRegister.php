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

include_once('vendor_header.php');
include_once('_vendor_login.inc');
include_once('_util.inc');

	$login_name = $_POST['login_name'];
	$password =md5(trim($_POST['password']));
	$vendor_name=$_POST['vendor_name'];
	$email = $_POST['email'];
	$description = $_POST['description'];

	$regtime = time();

	$stoken = md5($login_name . $password . $regtime);
	$token_exptime = time() + 60 * 60 * 24; //过期时间为24小时后

	$isActive = "0";

	//向数据库插入注册用户
	$result = register_vendor($login_name, $password, $vendor_name, $email, $stoken, $token_exptime, $isActive, $regtime, $description);   	

	//发送邮件
	$url = make_uri($_SERVER, "vendor_active.php?verify=" . $stoken);

        $mailtitle = "[龙芯应用公社] 新用户帐号激活";
        $mailcontent = "尊敬的${vendor_name}，<br/>"
                     . " <p>感谢您在我站注册了新帐号 ${login_name}。</p>"
                     . " <p>请点击链接激活您的帐号。</p>"
                     . " <a href='${url}' target='_blank'>${url}</a><br/>"
                     . " 如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>"
                     . " 如果此次激活请求非你本人所发，请忽略本邮件。<br/>"
                     . " <p>-------- 龙芯应用公社 敬上 </p>"; 

        $ret = send_email($email, $mailtitle, $mailcontent);

        echo "<div class='panel-body' style='width:600px; margin:36px auto;'>";
        if($ret == "error"){
                echo "对不起，邮件发送失败！请检查邮箱填写是否有误。";
                echo "<a href='vendor_register.php'>vendor_register.php</a>";
                exit();
        }
        echo "用户注册成功！<p>系统已经发送一封邮件到到您提供的邮箱${email}，请在24小时之内检查邮件激活用户";
        echo "</div>";

	die();
?>

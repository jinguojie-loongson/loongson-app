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
	$verify = stripslashes(trim($_GET['verify']));
	$nowtime = time();
	//$row_vendor = get_vendor_by_token($verify);
	$tokenexptime = getvendor_tokenexptime_by_token($verify);
	$vendorId  = getvendorId_by_token($verify);
        echo "<div class='login-form' id='register-form'>  <div class='panel panel-primary'>";
        echo "<div class='panel-heading'> <h3>账户激活</h3>   </div>";
        echo "<div class='panel-body'>";
	if($nowtime > $tokenexptime){ //$row_vendor[0][1]  
	 echo "<div class='form-group'><label>您的激活有效期已过，请登录您的帐号重新发送激活邮件。</label></div> ";
	 echo "</div>";
	 echo "<div class='panel-footer'><a href='vendor_login.php'>返回登录</a></div>";
         exit();	
	}else{
	 update_isActive_by_id($vendorId);//$row_vendor[0][0]
	 echo "<div class='form-group'><label>用户激活成功！</label></div>";
         echo "</div>";
	 echo "<div class='panel-footer'><a href='vendor_login.php'>返回登录</a></div>";
	 echo "</div>";
	 echo "</div>";
	}

?>
<?php include_once('vendor_footer.php');?>

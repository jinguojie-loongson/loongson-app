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
include_once('_util.inc');
@session_start();
	 $password_revise_old = trim($_POST['password_revise_old']);
      	$vendor_id_revise = trim($_POST['vendor_id_update']);
	$password_update = trim($_POST['password_update']);
	$vendor_name_revise_old = trim($_POST['vendor_name_revise_old']);
	$email_revise_old = trim($_POST['email_revise_old']);
	$description_revise_old = trim($_POST['description_revise_old']);

	$vendor_name_update = trim($_POST['vendor_name']);
	$email_update  = trim($_POST['email']);
	$description_update = trim($_POST['description_update']);
	if($password_update != null || $password_update != ""){
		$md5pwd = md5($password_update);
        	update_passoord_vendor_byId($md5pwd,$vendor_id_revise);
	}
	if($vendor_name_revise_old != $vendor_name_update){
	        update_vendorname_vendor_byId($vendor_name_update,$vendor_id_revise);
        }
	 if($email_revise_old != $email_update){
		update_email_vendor_byId($email_update,$vendor_id_revise);
        }
	if($description_revise_old != $description_update){
              update_description_vendor_byId($description_update,$vendor_id_revise);
        }
         set_login_message("修改成功!");
         request_forward("vendor_updateInfo.php");  
?>

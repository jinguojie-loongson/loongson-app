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
include_once('class.smt.php');
	 $password_revise_old = md5(trim($_POST['password_revise_old']));
        $vendor_name_revise_old = $_POST['vendor_name_revise_old'];
        $email_revise_old  = $_POST['email_revise_old'];
        $description_revise_old = $_POST['description_revise_old'];
	

	$vendor_id_revise =  $_POST['vendor_id_revise'];
	$password_revise = md5(trim($_POST['password_revise']));
	$vendor_name_revise = $_POST['vendor_name_revise'];
	$email_revise  = $_POST['email_revise'];
	$description_revise = $_POST['description_revise'];

	$fieldArray =array();	
	 array_push($fieldArray, 'password');
	if($password_revise_old ==  $vendor_id_revise){	
		array_push($fieldArray, 'password');
	}
	if(){
	}

        $result = register_vendor($login_name, $password, $vendor_name, $email, $stoken, $token_exptime, $isActive, $regtime, $description);   	
	echo $result;


?>

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
  $loginname = $_GET['loginname'];
  $password = $_GET['password'];
  $vendorid = "";
  $isActive = "";

  $vendorarray = get_vendor_id_by_loginname($loginname, $password);

  foreach($vendorarray  as $vendorkey => $vendorvalue) 
  { 
    $vendorid = $vendorvalue['id'] ;
    $isActive = $vendorvalue['isActive'];
  }
  if($vendorid != "") 
  {
    if($isActive == 0 ){
      $json_arr = array("result"=>"false","message"=>"此用户名还没有激活！");
      $json_obj = json_encode($json_arr);
      echo $json_obj;
    } else {
      set_current_vendor($vendorid);
      
      $json_arr = array("result"=>"true","message"=>$vendorid);
      $json_obj = json_encode($json_arr);
      echo $json_obj;
    }
  } else {
    $json_arr = array("result"=>"false","message"=>"用户名或密码不正确！");
    $json_obj = json_encode($json_arr);
    echo $json_obj;	  
  }
?>

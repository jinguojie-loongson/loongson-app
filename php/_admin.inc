<?php
include_once('_db.inc');
include_once('_util.inc');

/*
*登录时验证
*/
function get_admin_id_by_loginname($loginname, $password)
{
global $conn;
	$pwd_md5 = md5($password);

	$sql ="select id from admin "
		." where login_name='${loginname}'  and password='$pwd_md5' ";
	echo $sql;
	return db_get_one_value($sql);		
}


function get_admin_name($id){
global $conn;
  $sql = "select login_name  from admin "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

/*
 *
 */
function get_current_admin()
{
global $_SESSION;

  return @$_SESSION[“admin_id”];
}

function set_current_admin($admin_id)
{
global $_SESSION;

  @$_SESSION[“admin_id”] = $admin_id;
}

function clear_current_admin()
{
global $_SESSION;

  @$_SESSION[“admin_id”] = "";
}

function get_admin_login_message()
{
global $_SESSION;

  return @$_SESSION[“admin_login_message”];
}

function set_admin_login_message($msg)
{
global $_SESSION;

  @$_SESSION[“admin_login_message”] = $msg;
}

function clear_admin_login_message()
{
global $_SESSION;

  @$_SESSION[“admin_login_message”] = "";
}

 ?>

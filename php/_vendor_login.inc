<?php
include_once('_db.inc');
include_once('_util.inc');

/*
*登录时验证
*/
function get_vendor_id_by_loginname($loginname, $password)
{
global $conn;
	$pwd_md5 = md5($password);

	$sql ="select id from vendor "
		." where login_name='${loginname}'  and password='$pwd_md5' and isActive=1 ";
	echo $sql;
	return db_get_one_value($sql);		
}

/*
 * 注册时验证用户名或名称在数据库中是否存在
 */
function doesVendorExistByfieldname($field_name, $fieldcontent){
global $conn;
	$nowtime = time();
	
	$sql ="select id from vendor  "
		."  where ${field_name}='${fieldcontent}'  "
		."    and (isActive=1 or (isActive=0 and  {$nowtime} < token_exptime) )";
	return db_get_one_value($sql);
}

/*
*
*/

function doesVendorExistNotEqualVendorid($field_name, $fieldcontent,$vendor_id){
global $conn;
        $nowtime = time();

        $sql ="select id from vendor  "
                ."  where ${field_name}='${fieldcontent}'  "
                ."    and isActive=1 and id!=${vendor_id}  ";
        return db_get_one_value($sql);
	
}

/*
 *注册
 */
function register_vendor($login_name, $password, $vendor_name, $email, $token, $token_exptime, $isActive, $regtime, $description){
	global $conn;
	
	$sql ="insert into  vendor(login_name, password, vendor_name, email, token, token_exptime, isActive, regtime, description)"
		."  VALUES ('${login_name}', '${password}', '${vendor_name}', '${email}', '$token', '$token_exptime', $isActive, '$regtime', '${description}')";

	return db_exec($sql);
}

function get_vendor_loginname_by_id($id){
global $conn;
  $sql = "select login_name  from vendor "
         . "  where id=${id}";
  return db_get_one_value($sql);	
}

function get_vendor_vendorname_by_id($id){
global $conn;
  $sql = "select vendor_name  from vendor "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_vendor_password_by_id($id){
global $conn;
  $sql = "select password  from vendor "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_vendor_email_by_id($id){
global $conn;
  $sql = "select email  from vendor "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_vendor_description_by_id($id){
global $conn;
  $sql = "select login_name  from vendor "
         . "  where id=${id}";
  return db_get_one_value($sql);
}


function  get_check_html($field_name,$ishave)
{

  $html = "<span class='app-text'> \n"
        . "<p class='app-title'> $ishave </p> \n";
  
  return "<div id='${field_name}'> ${html} </div> \n";
}


/*
 *
 */
function get_current_vendor()
{
global $_SESSION;

  return @$_SESSION[“vendor_id”];
}

function set_current_vendor($vendor_id)
{
global $_SESSION;

  @$_SESSION[“vendor_id”] = $vendor_id;
}

function clear_current_vendor()
{
global $_SESSION;

  @$_SESSION[“vendor_id”] = "";
}

function get_login_message()
{
global $_SESSION;

  return @$_SESSION[“login_message”];
}

function set_login_message($msg)
{
global $_SESSION;

  @$_SESSION[“login_message”] = $msg;
}

function clear_login_message()
{
global $_SESSION;

  @$_SESSION[“login_message”] = "";
}

 ?>

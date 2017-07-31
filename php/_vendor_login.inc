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

	$sql ="select id,isActive from vendor "
		." where login_name='${loginname}'  and password='$pwd_md5'";
        $result = mysql_query($sql);
	$array = array();
        while ($row = mysql_fetch_row($result))
        {
          array_push($array, array("id"=>$row[0],"isActive"=>$row[1]));
        }
        return $array;
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
        $sql ="select id from vendor  "
                ."  where ${field_name} = '${fieldcontent}'  "
                ."    and isActive = 1 and id != ${vendor_id}  ";
	
	return db_get_one_value($sql);
	
}

function doesEmailExist($email){
global $conn;
        $sql ="select id from vendor  "
                ."  where email='${email}'  "
                ."    and isActive=1 ";

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

/*
*修改
*/

function update_passoord_vendor_byId($password,$vendor_id){
global $conn;
        $sql = " update vendor set password='${password}' where id = ${vendor_id} ";
        return db_exec($sql);
}

function update_vendorname_vendor_byId($vendor_name_update,$vendor_id){
global $conn;
        $sql = " update vendor set vendor_name ='${vendor_name_update}' where id = ${vendor_id} ";
	//return  $sql;
        return db_exec($sql);
}

function update_email_vendor_byId($email_update,$vendor_id){
global $conn;
        $sql = " update vendor set email='${email_update}' where id = ${vendor_id} ";
        return db_exec($sql);
}

function update_description_vendor_byId($description_update,$vendor_id){
global $conn;
        $sql = " update vendor set description='${description_update}' where id = ${vendor_id} ";
        return db_exec($sql);
}

function update_token_vendor_by_email($email,$token){
global $conn;
        $sql = " update vendor set token='${token}' where email = '${email}' ";
        return db_exec($sql);

}

function update_password_vendor_by_token($password,$token){
global $conn;
        $sql = " update vendor set password='${password}' where token = '${token}'  ";
        return db_exec($sql);

}

function update_isActive_by_id($vendor_id){
global $conn;
        $sql = " update vendor set isActive=1 where id = ${vendor_id} ";
        return db_exec($sql);
}

function get_vendor_by_token($token){
global $conn;
  $sql = "select id,token_exptime from  vendor  "
         . "  where isActive = 0 "
	 ."  and  token ='${token}' ";
  return db_get_two_columns($sql);

}

function getvendorId_by_token($token){
global $conn;
  $sql = "select id from  vendor  "
         . "  where isActive = 0 "
         ."  and  token ='${token}' ";
  return db_get_one_value($sql);

}

function getvendor_tokenexptime_by_token($token){
global $conn;
  $sql = "select token_exptime from  vendor  "
         . "  where  "
         ."    token ='${token}' ";
  return db_get_one_value($sql);
}

function getvendor_password_by_token($token){
global $conn;
  $sql = "select password from  vendor  "
         . "  where isActive = 1 "
         ."  and  token ='${token}' ";
  return db_get_one_value($sql);

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
  $sql = "select description  from vendor "
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

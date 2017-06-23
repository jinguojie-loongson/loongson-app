<?php 
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

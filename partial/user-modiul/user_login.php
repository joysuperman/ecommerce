<?php

/**
 * @Author: SUPERMAN
 * @Date:   2022-09-26 17:02:47
 * @Last Modified by:   SUPERMAN
 * @Last Modified time: 2022-10-15 20:57:44
 */
require_once "../../inc/connection.php";
require_once "../../inc/functions.php";

$email = get_safe_value($con, $_POST['email']);
$password = get_safe_value($con, $_POST['password']);


$result = mysqli_query($con,"SELECT id, f_name, password FROM admin_user WHERE email='{$email}'");
$check_user = mysqli_num_rows($result);

if ($check_user>0) {
	$data = mysqli_fetch_assoc($result);
	$_password = $data['password'];

	if (password_verify($password, $_password)) {
		$_SESSION['user_login'] ='yes';
		$_SESSION['user_id'] =  $data['id'];
		$_SESSION['user_name'] =  $data['f_name'];

		echo "sucess";
		die();
	}else{
		echo "wrong";
	}
	
}else{
	echo "wrong";
}
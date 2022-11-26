<?php
require_once "../../inc/connection.php";
require_once "../../inc/functions.php";
$id = get_safe_value($con, $_POST['id']);

$s_firstName = get_safe_value($con, $_POST['s_firstName']);
$s_lastName = get_safe_value($con, $_POST['s_lastName']);
$s_address = get_safe_value($con, $_POST['s_address']);
$s_country = get_safe_value($con, $_POST['s_country']);
$s_state = get_safe_value($con, $_POST['s_state']);
$s_zip = get_safe_value($con, $_POST['s_zip']);

$b_firstName = get_safe_value($con, $_POST['b_firstName']);
$b_lastName = get_safe_value($con, $_POST['b_lastName']);
$b_address = get_safe_value($con, $_POST['b_address']);
$b_country = get_safe_value($con, $_POST['b_country']);
$b_state = get_safe_value($con, $_POST['b_state']);
$b_zip = get_safe_value($con, $_POST['b_zip']);


if ($id == "") {
	echo "present";
}else{
	if ($s_firstName && $s_lastName && $s_address && $s_country && $s_state && $s_zip && $b_firstName && $b_lastName && $b_address && $b_country && $b_state && $b_zip ) {

		$query = "";
		$check_user=mysqli_num_rows( mysqli_query($con,"SELECT * FROM order_info WHERE user_id=$id") );
		if ($check_user>0) {
			$query = "UPDATE order_info SET s_f_name='$s_firstName',s_l_name='$s_lastName',s_address='$s_address',s_country='$s_country',s_state='$s_state',s_p_code='$s_zip',b_f_name='$b_firstName',b_l_name='$b_lastName',b_address='$b_address',b_country='$b_country',b_state='$b_state',b_p_code='$b_zip' WHERE user_id = '{$id}'";
		}else{
			$query = "INSERT INTO order_info (user_id, s_f_name, s_l_name, s_address, s_country, s_state, s_p_code, b_f_name, b_l_name, b_address, b_country, b_state, b_p_code) VALUES ('{$id}','{$s_firstName}','{$s_lastName}','{$s_address}','{$s_country}','{$s_state}','{$s_zip}','{$b_firstName}','{$b_lastName}','{$b_address}','{$b_country}','{$b_state}','{$b_zip}')";
		}

        mysqli_query($con, $query);
        if (mysqli_error($con)) {
            echo "Connection Lost";
        }
    }
    echo "insert";
}
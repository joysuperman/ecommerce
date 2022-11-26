<?php
require_once "../../inc/connection.php";
require_once "../../inc/functions.php";

$id = get_safe_value($con, $_POST['id']);
$type = get_safe_value($con, $_POST['type']);

$f_name = get_safe_value($con, $_POST['f_name']);
$l_name = get_safe_value($con, $_POST['l_name']);
$email = get_safe_value($con, $_POST['email']);
$password = get_safe_value($con, $_POST['password']);
$new_pass = get_safe_value($con, $_POST['new_pass']);


$check_user=mysqli_num_rows( mysqli_query($con,"SELECT * FROM admin_user WHERE email='$email'") );

if ($type == "edit" && $id) {
    $query = "UPDATE admin_user SET f_name='$f_name',l_name='$l_name',email='$email' WHERE id = '{$id}' && status=1";
    mysqli_query($con, $query);
    if (mysqli_error($con)) {
        echo "Connection Lost";
    }
    echo "edit";
}else if($type == "edit_pass" && $id && $new_pass != ""){

    $result = mysqli_query($con,"SELECT password FROM admin_user WHERE id='{$id}'");
    $check_user = mysqli_num_rows($result);

    if ($check_user>0) {
        $data = mysqli_fetch_assoc($result);
        $_password = $data['password'];

        if (password_verify($password, $_password)) {

            $hash = password_hash($new_pass, PASSWORD_BCRYPT);
            $query = "UPDATE admin_user SET password='$hash' WHERE id = '{$id}'";
            mysqli_query($con, $query);
            if (mysqli_error($con)) {
                echo "Connection Lost";
            }
            echo "edit";
        }else{
            echo "old_in";
        }
    }else{
        echo "No User";
    }
}else{
    $result = mysqli_query($con,"SELECT * FROM admin_user WHERE id='{$id}'");
    $check_user = mysqli_num_rows($result);

    if ($check_user>0) {
       echo "present";
    }else{
    	if ($f_name && $l_name && $email && $password) {
            $status = 1;
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $date = date("Y-m-d");
            $authKey = generateRandomString();
            $query = "INSERT INTO admin_user (f_name, l_name, email, password, status, user_register, user_activation_key) VALUES ('{$f_name}','{$l_name}','{$email}','{$hash}','{$status}','{$date}','{$authKey}')";


            mysqli_query($con, $query);
            if (mysqli_error($con)) {
                echo "Connection Lost";
            }
        }

        echo "insert";
    }
}
<?php

/**
 * @Author: SUPERMAN
 * @Date:   2022-09-09 20:06:31
 * @Last Modified by:   SUPERMAN
 * @Last Modified time: 2022-10-26 15:23:43
 */

function pr($arr){
	echo "<pre>";
	print_r($arr);
}

function prr($arr){
	echo "<pre>";
	print_r($arr);
	die();
}

/*Input Validaton*/
function get_safe_value($con, $str){
	if($str != ""){
		$str = trim($str);
		return mysqli_real_escape_string($con, $str);
	}
}


// Get Product
function get_product($con,$type,$id){
	if ($type && $id) {
        $required="";
        $result = mysqli_query($con, "SELECT * FROM product WHERE id = '{$id}'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

        }else{
            header("location: manage-product.php");
            die();
        }
    }
    else{
        header("location: manage-product.php");
        die();
    }
    return $row;
}

// Get USER
function get_user($con,$type,$id){
    if ($type && $id) {
        $required="";
        $result = mysqli_query($con, "SELECT * FROM admin_user WHERE id = '{$id}'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

        }else{
            header("location: manage-user.php");
            die();
        }
    }
    else{
        header("location: manage-user.php");
        die();
    }
    return $row;
}


// Show States
function order_status($con, $code=""){
    $arrstate=array
    (
        "1"=>"Pending",
        "2"=>"Processing",
        "3"=>"Shipped",
        "4"=>"Canceled",
        "5"=>"Canceled"
    );

    if ($code && $code !="") {
        foreach($arrstate as $key => $value) {
            if ($code == $key) {
                echo $value;
            }
        }
    }else{
        foreach($arrstate as $key => $value) {
            echo "<option value=".$key.">$value</option>\n";
        }
    }
    
}


// Get User
function get_user_role($con, $selected = ''){
    $user=array
    (
        "Super Admin",
        "Admin",
        "Editor",
        "User",
    );

    foreach($user as $key => $value) {
        $select = "";
        if ($selected == $value) {
            $select = "selected";
        }else{
            $select = "";
        }
        
        echo "<option value=".$value." $select>$value</option>\n";
    }
}


// Image Upload

function img_upload(){
	$image = "";
    $allowTypes = array(
        'image/png',
        'image/jpg',
        'image/jpeg'
    );
    if ($_FILES['img']) {
        if (in_array($_FILES['img']['type'], $allowTypes) != false && $_FILES['img']['size'] < 2*1024*1024 ) {
            move_uploaded_file($_FILES['img']['tmp_name'], PRODUCT_IMG_SERVER_PATH.$_FILES['img']['name']);
            $image = $_FILES['img']['name'];
        }else{
            $msg = "file not support";
        }
    }

    return $image;
}


// Get Shipping
function get_shipping($con,$type,$id){
    if ($type && $id) {
        $required="";
        $result = mysqli_query($con, "SELECT * FROM shipping_method WHERE id = '{$id}'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

        }else{
            header("location: manage-shipping.php");
            die();
        }
    }
    else{
        header("location: manage-shipping.php");
        die();
    }
    return $row;
}



// Random Number Generator
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~`!@#$%^&*":;?,.';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
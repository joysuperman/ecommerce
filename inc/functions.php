<?php

/**
 * @Author: SUPERMAN
 * @Date:   2022-09-09 20:06:31
 * @Last Modified by:   SUPERMAN
 * @Last Modified time: 2022-10-26 16:07:37
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
function get_safe_value($con, $url){
	if($url != ""){
		$url = trim($url);
		return mysqli_real_escape_string($con, $url);
	}
}


/*Get Product*/
function get_product($con, $limit='', $cat_id='', $id='',$search ='',$short_order=''){
	$product_list ="";
	$query="SELECT product.*, categories.category FROM product,categories WHERE product.status=1";
	if ($cat_id != '') {
		$query.=" AND product.category_id=$cat_id";
	}
	if ($id != '') {
		$query.=" AND product.id=$id";
	}
	$query.=" AND category_id=categories.id";
	if ($search != '') {
		$query.=" AND (product.name like '%$search%' OR product.description like '%$search%')";
	}
	if ($short_order != '') {
		$query.=$short_order;
	}else{
		$query.=" ORDER BY product.id DESC";
	}
	
	if ($limit != '') {
		$query.=" product.LIMIT $limit";
	}
	

	$result= mysqli_query($con, $query);
	$product_list = array();

	while ($data = mysqli_fetch_assoc($result)) {
    	$product_list[] = $data;
    }
	return $product_list;
}


/*Get Category*/
function get_category($con, $par_cat='', $limit=''){
	$query="SELECT * FROM categories WHERE status=1";	
	
	if ($par_cat == 'parent') {
		$query.=" AND main_category=0";
	}else{
		$query.=" AND not(main_category=0) ORDER BY id DESC";
	}

	if ($limit != '') {
		$query.=" LIMIT $limit";
	}

	$result= mysqli_query($con, $query);
	$category_list = array();

	while ($data = mysqli_fetch_assoc($result)) {
    	$category_list[] = $data;
    }
	return $category_list;
}


// Show States
function cont_state($con, $id = '',$selected = '', $c_or_s=''){

	if ($c_or_s == 'state') {
		$arrstate=array
	    (
			"Alaska",
			"Alabama",
			"Arkansas",
			"Arizona",
			"California"
	  	);
	}else{
		$arrstate=array
	    (
			"USA",
			"UK",
			"India",
			"Bangladesh",
			"Russia",
			"Dubai"
	  	);
	}

    foreach($arrstate as $key => $value) {
    	$select = "";
    	if ($selected == $value) {
			$select = "selected";
		}else{
			$select = "";
		}
		
		echo "<option value=".$value." $select>$value</option>\n";
	}
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


// Shipping Method
function shipping_method($con){
	$product_list ="";
	$query="SELECT * FROM shipping_method";

	$result= mysqli_query($con, $query);
	$product_list = array();

	while ($data = mysqli_fetch_assoc($result)) {
    	$product_list[] = $data;
    }
	return $product_list;
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
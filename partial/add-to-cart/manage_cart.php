<?php

/**
 * @Author: SUPERMAN
 * @Date:   2022-09-26 20:26:50
 * @Last Modified by:   SUPERMAN
 * @Last Modified time: 2022-10-16 15:02:17
 */
require_once "../../inc/connection.php";
require_once "../../inc/functions.php";
require_once "add_cart.php";

$id = get_safe_value($con, $_POST['id']);
$qnt = get_safe_value($con, $_POST['qnt']);
$size = get_safe_value($con, $_POST['size']);
$type = get_safe_value($con, $_POST['type']);


$obj = new add_to_cart();

if ($type=='add') {
	$obj -> addProduct($id, $size, $qnt);
}

if ($type=='remove') {
	$obj -> removeProduct($id, $qnt);
}
echo $obj -> totalProduct();

?>
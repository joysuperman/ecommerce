<?php
require_once "../../inc/connection.php";
require_once "../../inc/functions.php";

$id = get_safe_value($con, $_POST['id']);
$type = get_safe_value($con, $_POST['type']);
$order_id = $_SESSION['new_order'];
$total_amount = get_safe_value($con, $_POST['total_amount']);
$shipping_method = get_safe_value($con, $_POST['shipping_method']);
$payment_status ="pending";
$invoice_no = "#INV-".rand();
$order_status =  "1";
$added_on = date('Y-m-d h:i:s');


if ($id == "") {
	echo "present";
}else{
	if ($id && $total_amount && $payment_status && $shipping_method && $invoice_no && $order_status && $added_on){

		if ($type == "edit") {
			mysqli_query($con, "UPDATE `order` SET `invoice_no`='{$invoice_no}',`total_amount`='{$total_amount}',`payment_status`='{$payment_status}',`order_status`='{$order_status}',`shipping_method`='{$shipping_method}',`added_on`='{$added_on}' WHERE `id`= $order_id");
		}else{	
			mysqli_query($con, "INSERT INTO `order` (user_id, invoice_no, total_amount, payment_status, order_status, shipping_method, added_on) VALUES ('{$id}','{$invoice_no}','{$total_amount}','{$payment_status}','{$order_status}','{$shipping_method}','{$added_on}')");
		}

		$order_id = mysqli_insert_id($con);
		$_SESSION['new_order'] = $order_id;

		foreach ($_SESSION['cart'] as $key => $value) {

	        $productArray =get_product($con,'','', $key);

	        $name = $productArray[0]['name'];
	        $price = $productArray[0]['price'];
	        $qntity = $value['qnt'];
	        $size = $value['size'];

	        mysqli_query($con, "INSERT INTO `order_item` (order_id, product_id, product_name, size, quntituy, price, added_on) VALUES ('{$order_id}','{$key}','{$name}','{$size}','{$qntity}','{$price}','{$added_on}')");
	        //unset($_SESSION['cart']);
	    }

	    if (mysqli_error($con)) {
            echo "Connection Lost";
        }
        echo "insert";
    }else{
    	echo "faka";
    }

    
}
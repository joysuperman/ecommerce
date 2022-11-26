<?php
class add_to_cart{

	// Add Product
	function addProduct($id, $size, $qnt){
		$_SESSION['cart'][$id]['qnt'] = $qnt;
		$_SESSION['cart'][$id]['size'] = $size;
	}

	// Update Product
	function updateProduct($id, $size, $qnt){
		if (isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id]['qnt'] = $qnt;
			$_SESSION['cart'][$id]['size'] = $size;
		}
	}

	//Remove Product
	function removeProduct($id, $qnt){
		if (isset($_SESSION['cart'][$id])) {
			if ($qnt == 0) {
				unset($_SESSION['cart'][$id]);
			}else{
				$_SESSION['cart'][$id]['qnt'] = $qnt;
			}
		}
	}

	// Empty Product
	function emptyProduct(){
		unset($_SESSION['cart']);
	}

	// Total Product
	function totalProduct(){
		if (isset($_SESSION['cart'])) {
			return count($_SESSION['cart']);
		}else{
			return 0;
		}
	}
	
}
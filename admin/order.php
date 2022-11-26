<?php 
    require_once "partials/_header.php";
?>

        <!-- Sidebar -->
        <?php require_once "partials/_aside.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once "partials/_top-nav.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                	<?php  
            		if (isset($_GET['id']) && $_GET['id'] != "") {
        				$id = get_safe_value($con, $_GET['id']);

                        $count = 1;

                        $result = mysqli_query($con, "SELECT `order`.*, order_info.* FROM `order`,order_info WHERE `order`.id = $id AND order_info.user_id = `order`.user_id ");
                        if ( $row=mysqli_fetch_assoc($result)) {

                        ?>
                        <div class="row">
                        	<div class="col-md-4">
                        		<!-- Page Heading -->
		            			<h1 class="h3 mb-2 text-gray-800">Invoice N0: <?php echo $row['invoice_no'] ?></h1>
		            			<p> Date :
		            			<?php 
									$dt = new DateTime($row['added_on']);
									echo $dt->format('m/d/Y');
		            			?>
		            			&nbsp;
		            			Time :<?php echo $dt->format('H:i:s'); ?>
		            			</p>
		            			<p>Status: <?php 
		            				order_status($con, $row['order_status']);
		            			?>
		            			</p>
		            			<p>Total: $<?php echo $row['total_amount'] ?></p>
		            			<p>Payment: <?php echo $row['payment_status'] ?></p>
                        	</div>

                        	<div class="col-md-4">
                        		<h5 class="h5 mb-2 text-gray-800">Shipping</h5>
                        		<p><?php echo $row['s_f_name']; ?>&nbsp;<?php echo $row['s_l_name']; ?></p>
	                    		<address>
	                            	<?php echo $row['s_address']; ?><br>
	                            	<?php echo $row['s_state']; ?><br>
	                            	<?php echo $row['s_p_code']; ?>
	                            </address>
	                            <p><?php echo $row['s_country']; ?></p> 
                        	</div>

                        	<div class="col-md-4">
                        		<h5 class="h5 mb-2 text-gray-800">Billing</h5>
                        		<p><?php echo $row['b_f_name']; ?>&nbsp;<?php echo $row['b_l_name']; ?></p>
	                    		<address>
	                            	<?php echo $row['b_address']; ?><br>
	                            	<?php echo $row['b_state']; ?><br>
	                            	<?php echo $row['b_p_code']; ?>
	                            </address>
	                            <p><?php echo $row['b_country']; ?></p> 
                        	</div>
                        </div>
            			

            			<div class="card shadow mb-4 mt-4">
            				<div class="card-header py-3">
	                            <h6 class="m-0 font-weight-bold text-primary">Order Item</h6>
	                        </div>
	                        <div class="card-body">
	                        	<div class="table-responsive">
	                                <table class="table table-bordered" width="100%" cellspacing="0">
	                                    <thead>
	                                        <tr>
	                                            <th>Item</th>
	                                            <th>Image</th>
	                                            <th>Name</th>
	                                            <th>Size</th>
	                                            <th>Quntity</th>
	                                            <th>Price</th> 	
	                                        </tr>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                    	<?php 
	                                    		$result = mysqli_query($con, "SELECT order_item.*, product.image FROM order_item,product WHERE order_id = $id AND order_item.product_id = product.id");
                        						while ( $row=mysqli_fetch_assoc($result)) {
	                                    	?>
											<tr>
	                                            <td><?php echo $count++; ?></td>
	                                            <td><img style="height: 50px; width: 50px; object-fit: cover;" src="<?php echo PRODUCT_IMG_SITE_PATH.$row['image']; ?>" alt="category Image"></td>
	                                            <td><?php echo $row['product_name']; ?></td>
	                                            <td><?php echo $row['size']; ?></td>
	                                            <td><?php echo $row['quntituy']; ?></td>
	                                            <td><?php echo $row['price']; ?></td>
	                                        </tr>
	                                    <?php } ?>
	                                    </tbody>
	                                </table>
	                            </div>
	                        </div>
	                    </div>


	                    <div class="row justify-content-end">
	                    	<div class="col-2">
	                    		<?php  
                    			    if (isset($_POST['update_status']) && $_POST['update_status'] !="") {
										$order_status= get_safe_value($con, $_POST['update_status']);
										$update_status = "UPDATE `order` SET order_status='$order_status' WHERE id = '{$id}'";
										mysqli_query($con, $update_status);
							            if (mysqli_error($con)) {
							                $msg = "Somthing Went Wrong!";
							            }
									}
	                    		?>
	                    		<form method="POST">
	                    			<div class="form-group">
		                    			<select class="form-control" name="update_status">
		                    				<option value="" selected disabled>Option....</option>
		                    				<?php order_status($con) ?>
		                    			</select>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary btn-user">
                                        <span class="text">Save</span>
                                    </button>
	                    		</form>
	                    	</div>
	                    </div>
                		<?php } else{
                			echo "No Order!";
                		}
                	}else{
                	?>
                    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">ORDER</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Invoice List</h6>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Invoice</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Shipping</th>
                                            <th>Actions</th>	 	 	 	
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $count = 1;
                                        $result = mysqli_query($con, "SELECT * FROM `order` ORDER BY added_on DESC");
                                        while ( $row=mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['added_on']?> </td>
                                            <td><?php echo $row['invoice_no'] ?></td>
                                            <td><span class="success">$<?php echo $row['total_amount'] ?></span></td>
                                            <td><span class="success"><?php echo $row['payment_status'] ?></span></td>
                                            <td><span class="success"><?php order_status($con, $row['order_status']); ?></span></td>
                                            <td><?php echo $row['shipping_method']?> </td>
                                            <td><a href="?id=<?php echo $row['id'] ?>" class="view">View</a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once "partials/_footer.php"?>
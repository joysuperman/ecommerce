<?php 
require_once 'partial/header.php'; 
if (!isset($_SESSION['user_login'])) {?>
    <script>
      window.location.href = 'login.php';
    </script>
<?php }
?>

<!-- Main Section-->
<section class="mt-0  vh-lg-100">
	<div class="container">
        <div class="account-dashboard">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <ul role="tablist" class="nav flex-column dashboard-list">
                        <li role="presentation">
                            <button type="button" class="nav-link active" id="dashboard-tab" data-bs-target="#dashboard" data-bs-toggle="tab" role="tab" aria-controls="dashboard" aria-selected="true">
                                Dashboard
                            </button>
                        </li>
                        <li role="presentation"> 
                            <button type="button" class="nav-link" id="orders-tab" data-bs-target="#orders" data-bs-toggle="tab" role="tab" aria-controls="orders" aria-selected="false" tabindex="-1">
                                Orders
                            </button>
                        </li>
                        <li role="presentation">
                            <button type="button" class="nav-link" id="downloads-tab" data-bs-target="#downloads" data-bs-toggle="tab" role="tab" aria-controls="downloads" aria-selected="false" tabindex="-1">
                                Downloads
                            </button>
                        </li>
                        <li role="presentation">
                            <button type="button" class="nav-link" id="address-tab" data-bs-target="#address" data-bs-toggle="tab" role="tab" aria-controls="address" aria-selected="false" tabindex="-1">
                                Addresses
                            </button>
                        </li>
                        <li role="presentation">
                            <button type="button" class="nav-link" id="account-tab" data-bs-target="#account-details" data-bs-toggle="tab" role="tab" aria-controls="account-details" aria-selected="false" tabindex="-1">
                                Account details
                            </button>
                        </li>
                        <li><a href="logout.php" class="nav-link" aria-selected="false" tabindex="-1" role="tab">logout</a></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content">

                        <div class="tab-pane fade show active" id="dashboard" aria-labelledby="dashboard-tab" role="tabpanel">
                            <h3>Dashboard </h3>
                            <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">Edit your password and account details.</a></p>
                        </div>

                        <div class="tab-pane fade" id="orders" aria-labelledby="orders-tab" role="tabpanel">
                            <h3>Orders</h3>
                            <div class="organic-table-area table-responsive">
                                <table class="table">
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
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $id = $_SESSION['user_id'];
                                        $result = mysqli_query($con, "SELECT * FROM `order` WHERE user_id=$id ORDER BY added_on DESC");
                                        while ( $row=mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['added_on']?> </td>
                                            <td><?php echo $row['invoice_no'] ?></td>
                                            <td><span class="success">$<?php echo $row['total_amount'] ?></span></td>
                                            <td><span class="success"><?php echo $row['payment_status'] ?></span></td>
                                            <td><span class="success"><?php order_status($con, $row['order_status']); ?></span></td>
                                            <td><?php echo $row['shipping_method']?> </td>
                                            <td><a href="cart.html" class="view">view</a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="downloads" aria-labelledby="downloads-tab" role="tabpanel">
                            <h3>Downloads</h3>
                            <div class="organic-table-area table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Downloads</th>
                                            <th>Expires</th>
                                            <th>Download</th>	 	 	 	
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Shopnovilla - Free Real Estate PSD Template</td>
                                            <td>May 10, 2018</td>
                                            <td><span class="danger">Expired</span></td>
                                            <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="address" aria-labelledby="address-tab" role="tabpanel">
                           <p>The following addresses will be used on the checkout page by default.</p>
                            <h4 class="billing-address">Billing address</h4>
                            <a href="#" class="view">Edit</a>
                            <?php 
                                $id = $_SESSION['user_id'];
                                $result = mysqli_query($con, "SELECT b_f_name, b_l_name, b_address, b_country, b_state, b_p_code FROM order_info WHERE user_id=$id");
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $b_f_name = $row['b_f_name'];
                                    $b_l_name = $row['b_l_name'];
                                    $b_address = $row['b_address'];
                                    $b_country = $row['b_country'];
                                    $b_state = $row['b_state'];
                                    $b_p_code = $row['b_p_code'];
                                }
                            ?>
                            <p><strong><?php echo $b_f_name; ?>&#160<?php echo $b_l_name; ?></strong></p>
                            <address>
                            	<?php echo $b_address; ?><br>
                            	<?php echo $b_state; ?> <br>
                            	<?php echo $b_p_code; ?>
                            </address>
                            <p><?php echo $b_country; ?></p>   
                        </div>

                        <div class="tab-pane fade" id="account-details" aria-labelledby="account-tab" role="tabpanel">
                            <h3>Account details </h3>
                            <a href="#" onclick="acc_change_pass()">Want to change password?</a>

                            <div class="login" id="change_user_info">
                                <div class="login-form-container">

                                    <?php 
                                        $id = $_SESSION['user_id'];
                                        $result = mysqli_query($con, "SELECT f_name, l_name, email FROM admin_user WHERE admin_user.id=$id AND status =1");
                                        if (mysqli_num_rows($result) > 0) {
                                            $row = mysqli_fetch_assoc($result);
                                            $fName = $row['f_name'];
                                            $lName = $row['l_name'];
                                            $email = $row['email'];
                                        }
                                    ?>
                                    <div class="account-login-form">
                                        <form method="POST">
                                            <div class="form-group">
                                                <label class="form-label" for="register-fname">First name</label>
                                                <input type="text" class="form-control" id="register-fname" name="f_name" placeholder="Enter your first name" value="<?php echo $fName; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="register-lname">Last name</label>
                                                <input type="text" class="form-control" id="register-lname" name="l_name" placeholder="Enter your last name" value="<?php echo $lName; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="register-email">Email address</label>
                                                <input type="email" class="form-control" id="register-email" name="email" placeholder="name@email.com" value="<?php echo $email; ?>">
                                            </div>
                                            <p class="error text-danger"></p>
                                            <button type="button" onclick="user_register('<?php echo $_SESSION['id']; ?>','edit')" class="btn btn-dark d-block w-100 my-4">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="login d-none" id="change_user_pass">
                                <div class="login-form-container">
                                    <div class="account-login-form">
                                        <form method="POST">
                                            <div class="form-group">
                                                <label class="form-label" for="register-password">Old Password</label>
                                                <input type="password" class="form-control" id="register-password" name="old_password" placeholder="Enter your Old Password">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="n_password">New Password</label>
                                                <input type="password" class="form-control" id="n_password" name="n_password" placeholder="Enter your New Password">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="c_password">Confirm Password</label>
                                                <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Enter your Confirm">
                                            </div>

                                            <p class="error text-danger"></p>
                                            <button type="button" onclick="user_register('<?php echo $_SESSION['id']; ?>','edit_pass')" class="btn btn-dark d-block w-100 my-4">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>       	
</section>

<?php require_once 'partial/footer.php' ?>
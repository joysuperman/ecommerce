<?php 
  require_once 'partial/header.php';

  if (!isset($_SESSION['cart']) || count($_SESSION['cart'])==0) {?>
    <script>
      window.location.href = 'index.php';
    </script>
  <?php  }

    $disabled ="";
    $id ="";
    $fName = "";
    $lName = "";
    $email = "";
    $s_f_name ="";
    $s_l_name ="";
    $s_address ="";
    $s_country ="";
    $s_state ="";
    $s_p_code ="";
    $b_f_name ="";
    $b_l_name ="";
    $b_address ="";
    $b_country ="";
    $b_state ="";
    $b_p_code ="";

  if (isset($_SESSION['user_login'])) {
    $id = $_SESSION['user_id'];
    $disabled = "disabled";
    $result = mysqli_query($con, "SELECT * FROM admin_user WHERE id=$id AND status='1'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fName = $row['f_name'];
        $lName = $row['l_name'];
        $email = $row['email'];

        $result = mysqli_query($con, "SELECT * FROM order_info WHERE user_id=$id");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $s_f_name = $row['s_f_name'];
            $s_l_name = $row['s_l_name'];
            $s_address = $row['s_address'];
            $s_country = $row['s_country'];
            $s_state = $row['s_state'];
            $s_p_code = $row['s_p_code'];
            $b_f_name = $row['b_f_name'];
            $b_l_name = $row['b_l_name'];
            $b_address = $row['b_address'];
            $b_country = $row['b_country'];
            $b_state = $row['b_state'];
            $b_p_code = $row['b_p_code'];
        }
    }
  }else{ ?>
    <script>
      window.location.href = 'login.php';
    </script>
  <?php }
?>
 <!-- Main Section-->
    <section class="mt-0  vh-lg-100">
        <!-- Page Content Goes Here -->
        <div class="container">
            <div class="row g-0 vh-lg-100">
                <div class="col-lg-7 pt-5 pt-lg-10">
                    <div class="pe-lg-5">
                        
                        <?php require_once 'partial/account_nav.php'; ?>                      

                        <div class="mt-5">
                            <!-- Checkout Panel Information-->
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-4">
                              <h3 class="fs-5 fw-bolder m-0 lh-1">Contact Information</h3>
                              <?php if (!isset($_SESSION['user_login'])) { ?>
                                <small class="text-muted fw-bolder">Already registered? <a href="login.php">Login</a></small>
                              <?php } ?>
                            </div>

                            <div class="row">
                              <!-- First Name-->
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="firstNameBilling" class="form-label">First name</label>
                                  <input type="text" class="form-control" id="firstNameBilling" value="<?php echo $fName; ?>" <?php echo $disabled; ?> required="">
                                </div>
                              </div>
                            
                              <!-- Last Name-->
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="lastNameBilling" class="form-label">Last name</label>
                                  <input type="text" class="form-control" id="lastNameBilling" value="<?php echo $lName; ?>" <?php echo $disabled; ?> required="">
                                </div>
                              </div>
                            
                              <!-- Email-->
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" <?php echo $disabled; ?>>
                                </div>
                            
                                <!-- Mailing List Signup-->
                                <div class="form-group form-check m-0">
                                  <input type="checkbox" class="form-check-input" id="add-mailinglist" checked>
                                  <label class="form-check-label small text-muted" for="add-mailinglist">Keep me updated with your latest news and offers</label>
                                </div>
                              </div>
                            </div>
                            
                            <h3 class="fs-5 mt-5 fw-bolder mb-4 border-bottom pb-4">Shipping Address</h3>
                            <div class="row">
                              <!-- First Name-->
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="firstName" class="form-label">First name</label>
                                  <input type="text" class="form-control" id="firstName" value="<?php echo $s_f_name; ?>">
                                </div>
                              </div>
                            
                              <!-- Last Name-->
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="lastName" class="form-label">Last name</label>
                                  <input type="text" class="form-control" id="lastName" value="<?php echo $s_l_name; ?>">
                                </div>
                              </div>
                            
                              <!-- Address-->
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="address" class="form-label">Address</label>
                                  <input type="text" class="form-control" id="address" value="<?php echo $s_address; ?>">
                                </div>
                              </div>
                            
                              <!-- Country-->
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="country" class="form-label">Country</label>
                                  <select class="form-select" id="country">
                                    <option value="" disabled selected>Please Select...</option>
                                    <?php cont_state($con, $id, $s_country,'country');?>
                                  </select>
                                </div>
                              </div>
                            
                              <!-- State-->
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="state" class="form-label">State</label>
                                  <select class="form-select" id="state">
                                    <option value="" disabled selected>Please Select...</option>
                                    <?php cont_state($con, $id, $s_state,'state'); ?>
                                  </select>
                                </div>
                              </div>
                            
                              <!-- Post Code-->
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="zip" class="form-label">Zip/Post Code</label>
                                  <input type="text" class="form-control" id="zip" value="<?php echo $s_p_code; ?>">
                                </div>
                              </div>
                            </div>
                            
                            <div class="pt-4 mt-4 pb-5 border-top d-flex justify-content-between align-items-center">
                              <!-- Shipping Same Checkbox-->
                              <div class="form-group form-check m-0">
                                <input type="checkbox" class="form-check-input" id="same-address" checked>
                                <label class="form-check-label" for="same-address">Use for billing address</label>
                              </div>
                            </div>
                            
                            <!-- Billing Address-->
                            <div class="billing-address d-none">
                              <h3 class="fs-5 fw-bolder mb-4 border-bottom pb-4">Billing Address</h3>
                              <div class="row">
                                <!-- First Name-->
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="firstNameAddress" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="firstNameAddress" value="<?php echo $b_f_name; ?>">
                                  </div>
                                </div>
                            
                                <!-- Last Name-->
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="lastNameAddress" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastNameAddress" placeholder="" value="<?php echo $b_l_name; ?>" required="">
                                  </div>
                                </div>
                            
                                <!-- Address-->
                                <div class="col-12">
                                  <div class="form-group">
                                    <label for="addressAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="addressAddress" placeholder="123 Some Street Somewhere" value="<?php echo $b_address; ?>">
                                  </div>
                                </div>
                            
                                <!-- Country-->
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="countryAddress" class="form-label">Country</label>
                                    <select class="form-select" id="countryAddress" required="">
                                      <option value="" disabled selected>Please Select...</option>
                                      <?php cont_state($con, $id, $b_country,'country');?>
                                    </select>
                                  </div>
                                </div>
                            
                                <!-- State-->
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="stateAddress" class="form-label">State</label>
                                    <select class="form-select" id="stateAddress" required="">
                                      <option value="" disabled selected>Please Select...</option>
                                      <?php cont_state($con, $id, $b_state,'state');?>
                                    </select>
                                  </div>
                                </div>
                            
                                <!-- Post Code-->
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="zipAddress" class="form-label">Zip/Post Code</label>
                                    <input type="text" class="form-control" id="zipAddress" value="<?php echo $b_p_code; ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- / Billing Address-->
                            
                            <div class="pt-5 mt-5 pb-5 border-top d-flex justify-content-md-between align-items-center">
                              <div class="text-left">
                                <p class="error text-danger"></p>
                              </div>
                              <button type="button" onclick="order_info_reg('<?php echo $id; ?>')" class="btn btn-dark w-100 w-md-auto" role="button">Proceed to shipping</button>
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 bg-light pt-lg-10 aside-checkout pb-5 pb-lg-0 my-5 my-lg-0">
                    <div class="p-4 py-lg-0 pe-lg-0 ps-lg-5">
                        <div class="pb-3">
                            <?php 
                                $cart_totlal = 0;
                                foreach ($_SESSION['cart'] as $key => $value) {

                                $productArray =get_product($con,'','', $key);
                                $name = $productArray[0]['name'];
                                $price = $productArray[0]['price'];
                                $image = $productArray[0]['image'];
                                $qntity = $value['qnt'];
                                $size = $value['size'];

                                $cart_totlal = $cart_totlal+($qntity * $price);
                            ?>
                            <!-- Cart Item-->
                            <div class="row mx-0 py-4 g-0 border-bottom">
                                <div class="col-2 position-relative">
                                        <span class="checkout-item-qty"><?php echo $qntity; ?></span>
                                    <picture class="d-block border">
                                        <img class="img-fluid" src="<?php echo PRODUCT_IMG_SITE_PATH.$image; ?>" alt="HTML Bootstrap Template by Pixel Rocket">
                                    </picture>
                                </div>
                                <div class="col-9 offset-1">
                                    <div>
                                        <h6 class="justify-content-between d-flex align-items-start mb-2">
                                            <?php echo $name; ?>
                                            <a class="text-decoration-none" href="javascript:void(0)" onclick="manage_cart('<?php echo $key; ?>','remove','<?php echo $qntity; ?>')"><i class="ri-close-line ms-3"></i></a>
                                        </h6>
                                        <span class="d-block text-muted fw-bolder text-uppercase fs-9">Size: <?php echo $size; ?> / Qty: <?php echo $qntity; ?></span>
                                    </div>
                                    <p class="fw-bolder text-end text-muted m-0"><?php echo $qntity*$price; ?></p>
                                </div>
                            </div>    
                            <!-- / Cart Item-->
                            <?php } ?>
                        </div>
                        <div class="py-4 border-bottom">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <p class="m-0 fw-bolder fs-6">Subtotal</p>
                                <p class="m-0 fs-6 fw-bolder">$<?php echo $cart_totlal; ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center ">
                                <p class="m-0 fw-bolder fs-6">Shipping</p>
                                <p class="m-0 fs-6 fw-bolder">$<?php echo $shipping=0; ?></p>
                            </div>
                        </div>
                        <div class="py-4 border-bottom">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="m-0 fw-bold fs-5">Grand Total</p>
                                    <span class="text-muted small">Inc $45.89 sales tax</span>
                                </div>
                                <p class="m-0 fs-5 fw-bold">$<?php echo $cart_totlal+$shipping; ?></p>
                            </div>
                        </div>
                        <div class="py-4">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Enter your coupon code">
                                <button class="btn btn-dark btn-sm px-4">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </section>
    <!-- / Main Section-->

    <?php require_once 'partial/footer.php' ?>
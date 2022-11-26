<?php 
  require_once 'partial/header.php';

    if (isset($_SESSION['user_login'])) {
        if (!isset($_SESSION['cart']) || count($_SESSION['cart'])==0) {?>
            <script>
              window.location.href = 'index.php';
            </script>
        <?php  }
        $email = "";
        $s_address = "";
        $shipping_price = "";
        $shipping_method = "";
        $grand_total = "";
        $new_order_id = $_SESSION['new_order'];

        $id = $_SESSION['user_id'];
        $result = mysqli_query($con, "SELECT admin_user.email, order_info.s_address, `order`.shipping_method,`order`.total_amount FROM admin_user,order_info,`order` WHERE admin_user.id=$id AND order_info.user_id=$id AND `order`.id=$new_order_id");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];
            $s_address = $row['s_address'];
            $shipping_price = $row['shipping_method'];

            $result = mysqli_query($con, "SELECT name FROM shipping_method WHERE price=$shipping_price");
            if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              $shipping_method = $row['name'];
            }

            $grand_total = $row['total_amount'];
        }
        prr($new_order_id);
    }else{ ?>
        <script>
          //window.location.href = 'login.php';
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
                            <!-- Checkout Information Summary -->
                            <ul class="list-group mb-5 d-none d-lg-block rounded-0">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <span class="text-muted small me-2 f-w-36 fw-bolder">Contact</span>
                                        <span class="small"><?php echo $email; ?></span>
                                    </div>
                                    <a href="checkout.php" class="text-muted small" role="button">Change</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <span class="text-muted small me-2 f-w-36 fw-bolder">Deliver To</span>
                                        <span class="small"><?php echo $s_address; ?></span>
                                    </div>
                                    <a href="checkout.php" class="text-muted small" role="button">Change</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <span class="text-muted small me-2 f-w-36 fw-bolder">Method</span>
                                        <span class="small"><?php echo $shipping_method; ?></span>
                                    </div>
                                    <a href="checkout-shipping.php" class="text-muted small" role="button">Change</a>
                                </li>
                            </ul><!-- / Checkout Information Summary-->
                            
                            <!-- Checkout Panel Information-->
                            <h3 class="fs-5 fw-bolder mb-4 border-bottom pb-4">Payment Information</h3>
                            
                            <div class="row">
                            
                              <!-- Payment Option-->
                              <div class="col-12">
                                <div class="form-check form-group form-check-custom form-radio-custom mb-3">
                                  <input class="form-check-input" type="radio" name="checkoutPaymentMethod" id="checoutPaymentStripe" checked>
                                  <label class="form-check-label" for="checoutPaymentStripe">
                                    <span class="d-flex justify-content-between align-items-start">
                                      <span>
                                        <span class="mb-0 fw-bolder d-block">Credit Card (Stripe)</span>
                                      </span>
                                      <i class="ri-bank-card-line"></i>
                                    </span>
                                  </label>
                                </div>
                              </div>
                            
                              <!-- Payment Option-->
                              <div class="col-12">
                                <div class="form-check form-group form-check-custom form-radio-custom mb-3">
                                  <input class="form-check-input" type="radio" name="checkoutPaymentMethod" id="checkoutPaymentPaypal">
                                  <label class="form-check-label" for="checkoutPaymentPaypal">
                                    <span class="d-flex justify-content-between align-items-start">
                                      <span>
                                        <span class="mb-0 fw-bolder d-block">PayPal</span>
                                      </span>
                                      <i class="ri-paypal-line"></i>
                                    </span>
                                  </label>
                                </div>
                              </div>
                            
                            </div>
                            
                            <!-- Payment Details-->
                            <div class="card-details">
                              <div class="row pt-3">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="cc-name" class="form-label">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                    <small class="text-muted">Full name as displayed on card</small>
                                  </div>
                                </div>
                            
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="cc-number" class="form-label">Credit card number</label>
                                    <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                  </div>
                                </div>
                            
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="cc-expiration" class="form-label">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                  </div>
                                </div>
                            
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <div class="d-flex">
                                      <label for="cc-cvv" class="form-label d-flex w-100 justify-content-between align-items-center">Security Code</label>
                                      <button type="button" class="btn btn-link p-0 fw-bolder fs-xs text-nowrap" data-bs-toggle="tooltip"
                                              data-bs-placement="top"
                                              title="A CVV is a number on your credit card or debit card that's in addition to your credit card number and expiration date">
                                        What's this?
                                      </button>
                                    </div>
                                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- / Payment Details-->
                            
                            <!-- Paypal Info-->
                            <div class="paypal-details bg-light p-4 d-none my-3 fw-bolder">
                              Please click on complete order. You will then be transferred to Paypal to enter your payment details.
                            </div>
                            <!-- /Paypal Info-->
                            
                            <!-- Accept Terms Checkbox-->
                            <div class="form-group form-check m-0">
                              <input type="checkbox" class="form-check-input" id="accept-terms" checked>
                              <label class="form-check-label fw-bolder" for="accept-terms">I agree to OldSkool's <a href="#">terms &
                                  conditions</a></label>
                            </div>
                            
                            <div class="pt-5 mt-5 pb-5 border-top d-flex flex-column flex-md-row justify-content-between align-items-center">
                              <a href="checkout-shipping.php" class="btn ps-md-0 btn-link fw-bolder w-100 w-md-auto mb-2 mb-md-0" role="button">Back to
                                shipping</a>
                              <a href="#" class="btn btn-dark w-100 w-md-auto" role="button">Complete Order</a>
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
                                <p class="m-0 fs-6 fw-bolder">$<?php echo $shipping_price; ?></p>
                            </div>
                        </div>
                        <div class="py-4 border-bottom">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="m-0 fw-bold fs-5">Grand Total</p>
                                    <span class="text-muted small">Inc $45.89 sales tax</span>
                                </div>
                                <p class="m-0 fs-5 fw-bold" id="grand-total"><span>$</span><?php echo $grand_total; ?></p>
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
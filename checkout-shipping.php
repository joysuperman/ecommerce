<?php 
  require_once 'partial/header.php';

  if (isset($_SESSION['user_login'])) {
    if (!isset($_SESSION['cart']) || count($_SESSION['cart'])==0) {?>
    <script>
      window.location.href = 'index.php';
    </script>
  <?php  }

    $id = $_SESSION['user_id'];
    $result = mysqli_query($con, "SELECT email FROM admin_user WHERE id=$id AND status='1'");
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $email = $row['email'];
    }
    
    $get_shipping = shipping_method($con);

    $process_type = "";
    if (isset($_SESSION['new_order'])) {
        $process_type = "edit";
    }else{
        $process_type = "add";
    }

  }else{ ?>
    <script>
      window.location.href = 'login.php';
    </script>
  <?php }

  // prr($_SESSION);
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
                            </ul>
                            <!-- / Checkout Information Summary-->
                            
                            <!-- Checkout Panel Information-->
                            <h3 class="fs-5 fw-bolder mb-4 border-bottom pb-4">Shipping Method</h3>
                            
                            <?php 
                            $count = $match = $i = $select = 1;
                            foreach ($get_shipping as $list) { ?>
                            <!-- Shipping Option-->
                            <div class="form-check form-group form-check-custom form-radio-custom form-radio-highlight mb-3">
                              <input class="form-check-input" type="radio" name="checkoutShippingMethod" value="<?php echo $list['price']; ?>" id="checkoutShippingMethod<?php echo$count++; ?>" <?php if($i==1) {echo "checked"; $i++;} ?> onclick="add_shipping_cost()">

                              <label class="form-check-label" for="checkoutShippingMethod<?php echo $match++; ?>">
                                <span class="d-flex justify-content-between align-items-start">
                                  <span>
                                    <span class="mb-0 fw-bolder d-block"><?php echo $list['name']; ?></span>
                                    <small class="fw-bolder"><?php echo $list['description']; ?></small>
                                  </span>
                                  <span class="small fw-bolder text-uppercase">
                                    <?php 
                                        if ($list['price'] == 0) {
                                            echo "FREE";
                                        }else{
                                            echo "$".$list['price'];
                                        }
                                    ?>
                                  </span>
                                </span>
                              </label>

                            </div>

                            <?php } ?>
                            <div class="pt-5 mt-5 pb-5 border-top d-flex flex-column flex-md-row justify-content-between align-items-center">
                              <a href="checkout.php" class="btn ps-md-0 btn-link fw-bolder w-100 w-md-auto mb-2 mb-md-0" role="button">Back to information</a>
                              <button type="button" onclick="order_process('<?php echo $process_type; ?>','<?php echo $id; ?>')" class="btn btn-dark w-100 w-md-auto" role="button">Proceed to payment</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 bg-light pt-lg-10 aside-checkout pb-5 pb-lg-0 my-5 my-lg-0">
                    <div class="p-4 py-lg-0 pe-lg-0 ps-lg-5">
                        <div class="pb-3">
                            <?php 
                                $shipping = 0;
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
                                <p class="m-0 fs-6 fw-bolder">$<span id="sub_total"><?php echo $cart_totlal; ?></span></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center ">
                                <p class="m-0 fw-bolder fs-6">Shipping</p>
                                <p class="m-0 fs-6 fw-bolder" >$<span id="shipping_price"><?php echo $shipping; ?></span></p>
                            </div>
                        </div>
                        <div class="py-4 border-bottom">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="m-0 fw-bold fs-5">Grand Total</p>
                                    <span class="text-muted small">Inc $45.89 sales tax</span>
                                </div>
                                <p class="m-0 fs-5 fw-bold" >$<span id="grand-total"><?php echo $cart_totlal+$shipping; ?></span></p>
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
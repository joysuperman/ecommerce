 <?php 
    require_once 'partial/header.php';
 ?>
 <!-- Main Section-->
    <section class="mt-0 overflow-lg-hidden  vh-lg-100">
        <!-- Page Content Goes Here -->
        <div class="container">
            <div class="row g-0 vh-lg-100">
                <div class="col-12 col-lg-7 pt-5 pt-lg-10">
                    <div class="pe-lg-5">
                        
                        <?php require_once 'partial/account_nav.php'; ?>

                        <div class="mt-5">
                            <h3 class="fs-5 fw-bolder mb-0 border-bottom pb-4">Your Cart</h3>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <tbody class="border-0">
                                        <?php 
                                            $cart_totlal = 0;

                                            if (isset($_SESSION['cart'])) {
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

                                        <?php } 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 bg-light pt-lg-10 aside-checkout pb-5 pb-lg-0 my-5 my-lg-0">
                    <div class="p-4 py-lg-0 pe-lg-0 ps-lg-5">
                        <div class="pb-4 border-bottom">
                            <div class="d-flex flex-column flex-md-row justify-content-md-between mb-4 mb-md-2">
                                <div>
                                    <p class="m-0 fw-bold fs-5">Grand Total</p>
                                    <span class="text-muted small">Inc $45.89 sales tax</span>
                                </div>
                                <p class="m-0 fs-5 fw-bold">$<?php echo $cart_totlal; ?></p>
                            </div>
                        </div>
                        <div class="py-4">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Enter coupon code">
                                <button class="btn btn-secondary btn-sm px-4">Apply</button>
                            </div>
                        </div>
                        <a href="checkout.php" class="btn btn-dark w-100 text-center" role="button">Proceed to checkout</a>                    
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </section>
    <!-- / Main Section-->

    <?php require_once 'partial/footer.php' ?>
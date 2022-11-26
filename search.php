<?php 
require_once 'partial/header.php';

$get = "";
$get_product = "";

if (isset($_GET['get']) && $_GET['get'] !="") {
    $get = get_safe_value($con, $_GET['get']);
    $get_product = get_product($con,'', '', '',$get);
}else{ ?>
   <script>
      window.location.href = 'product.php';
    </script>
<?php } ?>

    <!-- Main Section-->
    <section class="mt-0 ">
    <?php if ($get != "") { ?>
        <!-- Category Top Banner -->
        <div class="py-10 bg-img-cover bg-overlay-dark position-relative overflow-hidden bg-pos-center-center rounded-0"
            style="background-image: url(./assets/images/banners/banner-category-top.jpg);">
            <div class="container-fluid position-relative z-index-20" data-aos="fade-right" data-aos-delay="300">
                <h1 class="fw-bold display-6 mb-4 text-white"><?php echo $get;?></h1>
                <div class="col-12 col-md-6">
                    <p class="text-white mb-0 fs-5">
                        When it's time to head out and get your Kicks on, have a look at our latest arrivals. Whether you're into Nike, Adidas, Dunks or New Balance, we really have something for everyone!
                    </p>
                </div>
            </div>
        </div>
        <!-- Category Top Banner -->

        <div class="container-fluid" data-aos="fade-in">

            <!-- Category Toolbar-->
            <div class="d-flex justify-content-between items-center pt-5 pb-4 flex-column flex-lg-row">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item"><a href="#">Sneakers</a></li>
                          <li class="breadcrumb-item active" aria-current="page">New Releases</li>
                        </ol>
                    </nav>        <h1 class="fw-bold fs-3 mb-2">New Releases (121)</h1>
                    <p class="m-0 text-muted small">Showing 1 - 9 of 121</p>
                </div>
                <div class="d-flex justify-content-end align-items-center mt-4 mt-lg-0 flex-column flex-md-row">
            
                    <!-- Filter Trigger-->
                    <button class="btn bg-light p-3 me-md-3 d-flex align-items-center fs-7 lh-1 w-100 mb-2 mb-md-0 w-md-auto " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilters" aria-controls="offcanvasFilters">
                        <i class="ri-equalizer-line me-2"></i> Filters
                    </button>
                    <!-- / Filter Trigger-->
            
                    <!-- Sort Options-->
                    <select class="form-select form-select-sm border-0 bg-light p-3 pe-5 lh-1 fs-7" onchange="short_product_drop()" id="short_product_id">
                        <option selected value="">Sort By</option>
                        <option value="price_high">Hi Low</option>
                        <option value="price_low">Low Hi</option>
                        <option value="new">New</option>
                        <option value="old">Old</option>
                    </select>
                <!-- / Sort Options-->
                </div>
            </div>            
            <!-- /Category Toolbar-->

            <!-- Products-->
            <?php 
            if ($get_product !="") { 
                if (count($get_product)>0) { ?>

                <div class="row g-4">
                    <?php foreach ($get_product as $list) { ?>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <!-- Card Product-->
                        <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                            <div class="card-img position-relative">
                                <div class="card-badges">
                                        <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-danger rounded-circle d-block me-1"></span> Sale</span>
                                </div>
                                <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                <picture class="position-relative overflow-hidden d-block bg-light">
                                    <img class="w-100 img-fluid position-relative z-index-10" title="" src="<?php echo PRODUCT_IMG_SITE_PATH.$list['image']; ?>" alt="">
                                </picture>
                                    <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                        <a class="btn btn-quick-add" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']; ?>','add')"><i class="ri-add-line me-2"></i> Quick Add</a>
                                    </div>
                            </div>
                            <div class="card-body px-0">
                                <a class="text-decoration-none link-cover" href="product.php?id=<?php echo $list['id']; ?>"><?php echo $list['name']; ?></a>
                                <small class="text-muted d-block"><?php echo $list['quentity']; ?></small>
                                <p class="mt-2 mb-0 small"><s class="text-muted"><?php echo $list['mrp']; ?></s> <span class="text-danger"><?php echo $list['price']; ?></span></p>
                            </div>
                        </div>
                        <!--/ Card Product-->
                    </div>

                    <?php } ?>
                    <!-- / Products-->
                </div>

                <!-- Pagination-->
                <div class="d-flex flex-column f-w-44 mx-auto my-5 text-center">
                    <small class="text-muted">Showing 9 of 121 products</small>
                    <div class="progress f-h-1 mt-3">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a href="#" class="btn btn-outline-dark btn-sm mt-5 align-self-center py-3 px-4 border-2">Load More</a>
                </div>            
                <!-- / Pagination-->
            <?php }else{
                    echo "No Product Found";
                } 
            }else{ ?>

                <div class="row g-4">
                    <?php foreach ($get_category as $list) { ?>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <!-- Card Product-->
                        <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                            <div class="card-img position-relative">
                                <div class="card-badges">
                                        <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-danger rounded-circle d-block me-1"></span> Sale</span>
                                </div>
                                <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                <picture class="position-relative overflow-hidden d-block bg-light">
                                    <img class="w-100 img-fluid position-relative z-index-10" title="" src="<?php echo PRODUCT_IMG_SITE_PATH.$list['category_image']; ?>" alt="">
                                </picture>
                            </div>
                            <div class="card-body px-0">
                                <a class="text-decoration-none link-cover" href="category.php?id=<?php echo $list['id']; ?>"><?php echo $list['category']; ?></a>
                                <small class="text-muted d-block"><?php echo $list['total_product']; ?></small>
                            </div>
                        </div>
                        <!--/ Card Product-->
                    </div>

                    <?php } ?>
                    <!-- / Products-->
                </div>

                <!-- Pagination-->
                <div class="d-flex flex-column f-w-44 mx-auto my-5 text-center">
                    <small class="text-muted">Showing 9 of 121 products</small>
                    <div class="progress f-h-1 mt-3">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a href="#" class="btn btn-outline-dark btn-sm mt-5 align-self-center py-3 px-4 border-2">Load More</a>
                </div>            
                <!-- / Pagination-->
            <?php } 
            ?>
            
        </div>
        <!-- /Page Content -->
    <?php } else{
        echo "No Product Found!";
    }
    ?>
    </section>
    <!-- / Main Section-->

  <?php require_once 'partial/footer.php' ?>
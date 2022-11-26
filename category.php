<?php 
require_once 'partial/header.php';

$cat_id = "";
$get_product = "";
$get_category = "";

if (isset($_GET['id']) && $_GET['id'] !="") {
    $cat_id = get_safe_value($con, $_GET['id']);
    
    $short_order = "";
    $price_high_selected = "";
    $price_low_selected = "";
    $new_selected =  "";
    $old_selected = "";

    if (isset($_GET['shorcct_by']) && $_GET['short_by'] !="") {
        $short = get_safe_value($con, $_GET['shorcct_by']);
        
        if ($short == "price_high") {
            $short_order = " ORDER BY product.price DESC";
            $price_high_selected = "selected";
        }
        if ($short == "price_low") {
            $short_order = " ORDER BY product.price ASC";
            $price_low_selected = "selected";
        }
        if ($short == "new") {
            $short_order = " ORDER BY product.id DESC";
            $new_selected = "selected";
        }
        if ($short == "old") {
            $short_order = " ORDER BY product.id ASC";
            $old_selected = "selected";
        }
    }

    $get_product = get_product($con,'',$cat_id,'','',$short_order);
}else{
    $get_category = get_category($con);
}

    
?>

    <!-- Main Section-->
    <section class="mt-0 ">
        <!-- Page Content Goes Here -->
        
        <!-- Category Top Banner -->
        <div class="py-10 bg-img-cover bg-overlay-dark position-relative overflow-hidden bg-pos-center-center rounded-0"
            style="background-image: url(./assets/images/banners/banner-category-top.jpg);">
            <div class="container-fluid position-relative z-index-20" data-aos="fade-right" data-aos-delay="300">
                <h1 class="fw-bold display-6 mb-4 text-white">Latest Arrivals</h1>
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
                    <select class="form-select form-select-sm border-0 bg-light p-3 pe-5 lh-1 fs-7" onchange="short_product_drop('category','<?php echo $cat_id;?>', '<?php echo SITE_PATH;?>')" id="short_product_id">
                        <option selected value="">Sort By</option>
                        <option value="price_high" <?php echo $price_high_selected; ?>>Hi Low</option>
                        <option value="price_low" <?php echo $price_low_selected; ?>>Low Hi</option>
                        <option value="new" <?php echo $new_selected; ?>>New</option>
                        <option value="old" <?php echo $old_selected; ?>>Old</option>
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
    </section>
    <!-- / Main Section-->
    
    <!-- Offcanvas Imports-->
    <!-- Filters Offcanvas-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFilters" aria-labelledby="offcanvasFiltersLabel">
      <div class="offcanvas-header pb-0 d-flex align-items-center">
        <h5 class="offcanvas-title" id="offcanvasFiltersLabel">Category Filters</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="d-flex flex-column justify-content-between w-100 h-100">
    
          <!-- Filters-->
          <div>
    
            <!-- Price Filter -->
            <div class="py-4 widget-filter widget-filter-price border-top">
              <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                data-bs-toggle="collapse" href="#filter-modal-price" role="button" aria-expanded="true"
                aria-controls="filter-modal-price">
                Price
              </a>
              <div id="filter-modal-price" class="collapse show">
                <div class="filter-price mt-6"></div>
                <div class="d-flex justify-content-between align-items-center mt-7">
                    <div class="input-group mb-0 me-2 border">
                        <span class="input-group-text bg-transparent fs-7 p-2 text-muted border-0">$</span>
                        <input type="number" min="00" max="1000" step="1" class="filter-min form-control-sm border flex-grow-1 text-muted border-0">
                    </div>   
                    <div class="input-group mb-0 ms-2 border">
                        <span class="input-group-text bg-transparent fs-7 p-2 text-muted border-0">$</span>
                        <input type="number" min="00" max="1000" step="1" class="filter-max form-control-sm flex-grow-1 text-muted border-0">
                    </div>                
                </div>          </div>
            </div>
            <!-- / Price Filter -->
    
            <!-- Brands Filter -->
            <div class="py-4 widget-filter border-top">
              <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                data-bs-toggle="collapse" href="#filter-modal-brands" role="button" aria-expanded="true"
                aria-controls="filter-modal-brands">
                Brands
              </a>
              <div id="filter-modal-brands" class="collapse show">
                <div class="input-group my-3 py-1">
                  <input type="text" class="form-control py-2 filter-search rounded" placeholder="Search"
                    aria-label="Search">
                  <span class="input-group-text bg-transparent p-2 position-absolute top-10 end-0 border-0 z-index-20"><i
                      class="ri-search-2-line text-muted"></i></span>
                </div>
                <div class="simplebar-wrapper">
                  <div class="filter-options" data-pixr-simplebar>
                    <div class="form-group form-check-custom mb-1">
                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-0">
                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex align-items-center"
                            for="filter-brands-modal-0">Adidas  <span
                                class="text-muted ms-1 fs-9">(21)</span></label>
                    </div>                <div class="form-group form-check-custom mb-1">
                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-1">
                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex align-items-center"
                            for="filter-brands-modal-1">Asics  <span
                                class="text-muted ms-1 fs-9">(13)</span></label>
                    </div>                <div class="form-group form-check-custom mb-1">
                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-2">
                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex align-items-center"
                            for="filter-brands-modal-2">Canterbury  <span
                                class="text-muted ms-1 fs-9">(18)</span></label>
                    </div>                <div class="form-group form-check-custom mb-1">
                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-3">
                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex align-items-center"
                            for="filter-brands-modal-3">Converse  <span
                                class="text-muted ms-1 fs-9">(25)</span></label>
                    </div>                <div class="form-group form-check-custom mb-1">
                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-4">
                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex align-items-center"
                            for="filter-brands-modal-4">Donnay  <span
                                class="text-muted ms-1 fs-9">(11)</span></label>
                    </div>                <div class="form-group form-check-custom mb-1">
                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-5">
                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex align-items-center"
                            for="filter-brands-modal-5">Nike  <span
                                class="text-muted ms-1 fs-9">(19)</span></label>
                    </div>                <div class="form-group form-check-custom mb-1">
                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-6">
                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex align-items-center"
                            for="filter-brands-modal-6">Millet  <span
                                class="text-muted ms-1 fs-9">(24)</span></label>
                    </div>                <div class="form-group form-check-custom mb-1">
                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-7">
                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex align-items-center"
                            for="filter-brands-modal-7">Puma  <span
                                class="text-muted ms-1 fs-9">(11)</span></label>
                    </div>                <div class="form-group form-check-custom mb-1">
                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-8">
                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex align-items-center"
                            for="filter-brands-modal-8">Reebok  <span
                                class="text-muted ms-1 fs-9">(19)</span></label>
                    </div>                <div class="form-group form-check-custom mb-1">
                        <input type="checkbox" class="form-check-input" id="filter-brands-modal-9">
                        <label class="form-check-label fw-normal text-body flex-grow-1 d-flex align-items-center"
                            for="filter-brands-modal-9">Under Armour  <span
                                class="text-muted ms-1 fs-9">(24)</span></label>
                    </div>              </div>
                </div>
              </div>
            </div>
            <!-- / Brands Filter -->
    
            <!-- Sizes Filter -->
            <div class="py-4 widget-filter border-top">
              <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                data-bs-toggle="collapse" href="#filter-modal-sizes" role="button" aria-expanded="true"
                aria-controls="filter-modal-sizes">
                Sizes
              </a>
              <div id="filter-modal-sizes" class="collapse show">
                <div class="filter-options mt-3">
                  <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-0">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-0">6.5</label>
                  </div>              <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-1">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-1">7</label>
                  </div>              <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-2">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-2">7.5</label>
                  </div>              <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-3">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-3">8</label>
                  </div>              <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-4">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-4">8.5</label>
                  </div>              <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-5">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-5">9</label>
                  </div>              <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-6">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-6">9.5</label>
                  </div>              <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-7">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-7">10</label>
                  </div>              <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-8">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-8">10.5</label>
                  </div>              <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-9">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-9">11</label>
                  </div>              <div class="form-group d-inline-block mr-2 mb-2 form-check-bg form-check-custom">
                      <input type="checkbox" class="form-check-bg-input" id="filter-sizes-modal-10">
                      <label class="form-check-label fw-normal" for="filter-sizes-modal-10">11.5</label>
                  </div>            </div>
              </div>
            </div>
            <!-- / Sizes Filter -->
    
            <!-- Colour Filter -->
            <div class="py-4 widget-filter border-top">
              <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                data-bs-toggle="collapse" href="#filter-modal-colour" role="button" aria-expanded="true"
                aria-controls="filter-modal-colour">
                Colour
              </a>
              <div id="filter-modal-colour" class="collapse show">
                <div class="filter-options mt-3">
                  <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-primary">
                      <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-0">
                      <label class="form-check-label" for="filter-colours-modal-0"></label>
                  </div>              <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-success">
                      <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-1">
                      <label class="form-check-label" for="filter-colours-modal-1"></label>
                  </div>              <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-danger">
                      <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-2">
                      <label class="form-check-label" for="filter-colours-modal-2"></label>
                  </div>              <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-info">
                      <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-3">
                      <label class="form-check-label" for="filter-colours-modal-3"></label>
                  </div>              <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-warning">
                      <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-4">
                      <label class="form-check-label" for="filter-colours-modal-4"></label>
                  </div>              <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-dark">
                      <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-5">
                      <label class="form-check-label" for="filter-colours-modal-5"></label>
                  </div>              <div class="form-group d-inline-block mr-1 mb-1 form-check-solid-bg-checkmark form-check-custom form-check-secondary">
                      <input type="checkbox" class="form-check-color-input" id="filter-colours-modal-6">
                      <label class="form-check-label" for="filter-colours-modal-6"></label>
                  </div>            </div>
              </div>
            </div>
            <!-- / Colour Filter -->
          </div>
          <!-- / Filters-->
    
          <!-- Filter Button-->
          <div class="border-top pt-3">
            <a href="#" class="btn btn-dark mt-2 d-block hover-lift-sm hover-boxshadow" data-bs-dismiss="offcanvas" aria-label="Close">Done</a>
          </div>
          <!-- /Filter Button-->
        </div>
      </div>
    </div>
    <!-- Theme JS -->

  <?php require_once 'partial/footer.php' ?>
<?php 
require_once 'partial/header.php';

$id = "";
$get_product = "";

if (isset($_GET['id']) && $_GET['id'] !="") {
    $id = get_safe_value($con, $_GET['id']);
    $get_product = get_product($con,'', '', $id);
}else{
    $get_product = get_product($con);
}
?>

    <!-- Main Section-->
    <section class="mt-0 ">
        <!-- Page Content Goes Here -->            
        <?php if ($id != "") {?>
        <!-- Breadcrumbs-->
        <div class="bg-dark py-6">
            <div class="container-fluid">
                <nav class="m-0" aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item breadcrumb-light"><a href="index.php">Home</a></li>
                      <li class="breadcrumb-item breadcrumb-light"><a href="category.php?id=<?php echo $get_product['0']['category_id']; ?>"><?php echo $get_product['0']['category']; ?></a></li>
                      <li class="breadcrumb-item  breadcrumb-light active" aria-current="page"><?php echo $get_product['0']['name']; ?></li>
                    </ol>
                </nav>            
            </div>
        </div>
        <!-- / Breadcrumbs-->
        
        <div class="container-fluid mt-5">

            <!-- Product Top Section-->
            <div class="row g-9" data-sticky-container>

                <?php if (count($get_product)>0) { ?>
                <!-- Product Images-->
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="row g-3" data-aos="fade-right">
                        <div class="col-12">
                            <picture>
                                <img class="img-fluid" data-zoomable src="<?php echo PRODUCT_IMG_SITE_PATH.$get_product['0']['image']; ?>" alt="HTML Bootstrap Template by Pixel Rocket">
                            </picture>
                        </div>
                        <!-- <div class="col-12">
                            <picture>
                                <img class="img-fluid" data-zoomable src="./assets/images/products/product-page-2.jpeg" alt="HTML Bootstrap Template by Pixel Rocket">
                            </picture>
                        </div>
                        <div class="col-12">
                            <picture>
                                <img class="img-fluid" data-zoomable src="./assets/images/products/product-page-3.jpeg" alt="HTML Bootstrap Template by Pixel Rocket">
                            </picture>
                        </div>
                        <div class="col-12">
                            <picture>
                                <img class="img-fluid" data-zoomable src="./assets/images/products/product-page-4.jpeg" alt="HTML Bootstrap Template by Pixel Rocket">
                            </picture>
                        </div> -->
                    </div>
                </div>
                <!-- /Product Images-->
    
                <!-- Product Information-->
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="sticky-top top-5">
                        <div class="pb-3" data-aos="fade-in">
                            <div class="d-flex align-items-center mb-3">
                                <p class="small fw-bolder text-uppercase tracking-wider text-muted m-0 me-4"><?php echo $get_product['0']['category']; ?></p>
                                <div class="d-flex justify-content-start align-items-center disable-child-pointer cursor-pointer"
                                data-pixr-scrollto
                                data-target=".reviews">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 80%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>        
                                <small class="text-muted d-inline-block ms-2 fs-bolder">(105 reviews)</small>
                            </div>
                            </div>
                            
                            <h1 class="mb-1 fs-2 fw-bold"><?php echo $get_product['0']['name']; ?></h1>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fs-4 m-0">$<?php echo $get_product['0']['price']; ?></p>
                            </div>
                            <div class="border-top mt-4 mb-3 product-option">
                                <small class="text-uppercase pt-4 d-block fw-bolder">
                                    <span class="text-muted">Available Sizes (Mens)</span> : <span class="selected-option fw-bold"
                                        data-pixr-product-option="size" id="size">M</span>
                                </small>

                                <div class="mt-4 d-flex justify-content-start flex-wrap align-items-start">
                                    <div class="form-check-option form-check-rounded">
                                        <input 
                                            type="radio" 
                                            name="product-option-sizes" 
                                            value="S" 
                                            id="option-sizes-0">
                                        <label for="option-sizes-0">
                                            
                                            <small>S</small>
                                        </label>
                                    </div>                    
                                    <div class="form-check-option form-check-rounded">
                                        <input 
                                            type="radio" 
                                            name="product-option-sizes" 
                                            value="SM" 
                                            id="option-sizes-1">
                                        <label for="option-sizes-1">
                                            
                                            <small>SM</small>
                                        </label>
                                    </div>                    
                                    <div class="form-check-option form-check-rounded">
                                        <input 
                                            type="radio" 
                                            name="product-option-sizes" 
                                            value="M" 
                                                checked
                                            id="option-sizes-2">
                                        <label for="option-sizes-2">
                                            
                                            <small>M</small>
                                        </label>
                                    </div>                    
                                    <div class="form-check-option form-check-rounded">
                                        <input 
                                            type="radio" 
                                            name="product-option-sizes" 
                                            value="L" 
                                            id="option-sizes-3">
                                        <label for="option-sizes-3">
                                            
                                            <small>L</small>
                                        </label>
                                    </div>                    
                                    <div class="form-check-option form-check-rounded">
                                        <input 
                                            type="radio" 
                                            name="product-option-sizes" 
                                            value="Xl" 
                                            id="option-sizes-4">
                                        <label for="option-sizes-4">
                                            
                                            <small>XL</small>
                                        </label>
                                    </div>                    
                                    <div class="form-check-option form-check-rounded">
                                        <input 
                                            type="radio" 
                                            name="product-option-sizes" 
                                            value="XXL" 
                                            id="option-sizes-5">
                                        <label for="option-sizes-5">
                                            
                                            <small>XXL</small>
                                        </label>
                                    </div>        
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="text-uppercase pt-4 d-block fw-bolder text-muted">
                                    Available Designs :
                                </small>
                                <div class="mt-4 d-flex justify-content-start flex-wrap align-items-start">
                                    <picture class="me-2">
                                        <img class="f-w-24 p-2 bg-light border-bottom border-dark border-2 cursor-pointer" src="./assets/images/products/product-page-thumb-1.jpeg" alt="HTML Bootstrap Template by Pixel Rocket">
                                    </picture>
                                    <picture>
                                        <img class="f-w-24 p-2 bg-light cursor-pointer" src="./assets/images/products/product-page-thumb-2.jpeg" alt="HTML Bootstrap Template by Pixel Rocket">
                                    </picture>
                                </div>
                            </div>
                            <a class="btn btn-dark w-100 mt-4 mb-0 hover-lift-sm hover-boxshadow" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']; ?>','add')">Add To Shopping Bag</a>
                        
                            <!-- Product Highlights-->
                                <div class="my-5">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="text-center px-2">
                                                <i class="ri-24-hours-line ri-2x"></i>
                                                <small class="d-block mt-1">Next-day Delivery</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="text-center px-2">
                                                <i class="ri-secure-payment-line ri-2x"></i>
                                                <small class="d-block mt-1">Secure Checkout</small>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="text-center px-2">
                                                <i class="ri-service-line ri-2x"></i>
                                                <small class="d-block mt-1">Free Returns</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- / Product Highlights-->
                        
                            <!-- Product Accordion -->
                            <div class="accordion" id="accordionProduct">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                      Product Details
                                    </button>
                                  </h2>
                                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionProduct">
                                    <div class="accordion-body">
                                        <p class="m-0"><?php echo $get_product['0']['description']; ?></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Details & Care
                                      </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionProduct">
                                      <div class="accordion-body">
                                          <ul class="list-group list-group-flush">
                                              <li class="list-group-item d-flex border-0 row g-0 px-0">
                                                  <span class="col-4 fw-bolder">Composition</span>
                                                  <span class="col-7 offset-1">98% Cotton, 2% elastane</span>
                                              </li>
                                              <li class="list-group-item d-flex border-0 row g-0 px-0">
                                                  <span class="col-4 fw-bolder">Care</span>
                                                  <span class="col-7 offset-1">Professional dry clean only. Do not bleach. Do not iron.</span>
                                              </li>
                                          </ul>
                                      </div>
                                    </div>
                                  </div>        
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                      Delivery & Returns
                                    </button>
                                  </h2>
                                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionProduct">
                                    <div class="accordion-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex border-0 row g-0 px-0">
                                                <span class="col-4 fw-bolder">Delivery</span>
                                                <span class="col-7 offset-1">Standard delivery free for orders over $99. Next day delivery $9.99</span>
                                            </li>
                                            <li class="list-group-item d-flex border-0 row g-0 px-0">
                                                <span class="col-4 fw-bolder">Returns</span>
                                                <span class="col-7 offset-1">30 day return period. See our <a class="text-link-border" href="#">terms & conditions.</a></span>
                                            </li>
                                        </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <!-- / Product Accordion-->
                        </div>                    
                    </div>
                </div>
                <!-- / Product Information-->
                <?php
                 }else{
                    echo "It's not a product Id";
                 }
                ?>
            </div>
            <!-- / Product Top Section-->

            <div class="row g-0">

                <!-- Related Products-->
                <div class="col-12" data-aos="fade-up">
                    <h3 class="fs-4 fw-bolder mt-7 mb-4">You May Also Like</h3>
                    <!-- Swiper Latest -->
                    <div class="swiper-container" data-swiper data-options='{
                        "spaceBetween": 10,
                        "loop": true,
                        "autoplay": {
                          "delay": 5000,
                          "disableOnInteraction": false
                        },
                        "navigation": {
                          "nextEl": ".swiper-next",
                          "prevEl": ".swiper-prev"
                        },   
                        "breakpoints": {
                          "600": {
                            "slidesPerView": 2
                          },
                          "1024": {
                            "slidesPerView": 3
                          },       
                          "1400": {
                            "slidesPerView": 4
                          }
                        }
                      }'>
                      <div class="swiper-wrapper">
                            <div class="swiper-slide">
                              <!-- Card Product-->
                              <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                  <div class="card-img position-relative">
                                      <div class="card-badges">
                                              <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-danger rounded-circle d-block me-1"></span> Sale</span>
                                      </div>
                                      <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                      <picture class="position-relative overflow-hidden d-block bg-light">
                                          <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-1.jpg" alt="">
                                      </picture>
                                          <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                              <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                          </div>
                                  </div>
                                  <div class="card-body px-0">
                                      <a class="text-decoration-none link-cover" href="./product.html">Nike Air VaporMax 2021</a>
                                      <small class="text-muted d-block">4 colours, 10 sizes</small>
                                              <p class="mt-2 mb-0 small"><s class="text-muted">$329.99</s> <span class="text-danger">$198.66</span></p>
                                  </div>
                              </div>
                              <!--/ Card Product-->
                            </div>
                            <div class="swiper-slide">
                              <!-- Card Product-->
                              <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                  <div class="card-img position-relative">
                                      <div class="card-badges">
                                              <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-success rounded-circle d-block me-1"></span> New In</span>
                                      </div>
                                      <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                      <picture class="position-relative overflow-hidden d-block bg-light">
                                          <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-2.jpg" alt="">
                                      </picture>
                                          <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                              <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                          </div>
                                  </div>
                                  <div class="card-body px-0">
                                      <a class="text-decoration-none link-cover" href="./product.html">Nike ZoomX Vaporfly</a>
                                      <small class="text-muted d-block">2 colours, 4 sizes</small>
                                              <p class="mt-2 mb-0 small">$275.45</p>
                                  </div>
                              </div>
                              <!--/ Card Product-->
                            </div>
                            <div class="swiper-slide">
                              <!-- Card Product-->
                              <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                  <div class="card-img position-relative">
                                      <div class="card-badges">
                                              <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-secondary rounded-circle d-block me-1"></span> Sold Out</span>
                                      </div>
                                      <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                      <picture class="position-relative overflow-hidden d-block bg-light">
                                          <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-3.jpg" alt="">
                                      </picture>
                                  </div>
                                  <div class="card-body px-0">
                                      <a class="text-decoration-none link-cover" href="./product.html">Nike Blazer Mid &#x27;77</a>
                                      <small class="text-muted d-block">5 colours, 6 sizes</small>
                                          <p class="mt-2 mb-0 small text-muted">Sold Out</p>
                                  </div>
                              </div>
                              <!--/ Card Product-->
                            </div>
                            <div class="swiper-slide">
                              <!-- Card Product-->
                              <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                  <div class="card-img position-relative">
                                      <div class="card-badges">
                                      </div>
                                      <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                      <picture class="position-relative overflow-hidden d-block bg-light">
                                          <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-4.jpg" alt="">
                                      </picture>
                                          <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                              <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                          </div>
                                  </div>
                                  <div class="card-body px-0">
                                      <a class="text-decoration-none link-cover" href="./product.html">Nike Air Force 1</a>
                                      <small class="text-muted d-block">6 colours, 9 sizes</small>
                                              <p class="mt-2 mb-0 small">$425.85</p>
                                  </div>
                              </div>
                              <!--/ Card Product-->
                            </div>
                            <div class="swiper-slide">
                              <!-- Card Product-->
                              <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                  <div class="card-img position-relative">
                                      <div class="card-badges">
                                              <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-danger rounded-circle d-block me-1"></span> Sale</span>
                                      </div>
                                      <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                      <picture class="position-relative overflow-hidden d-block bg-light">
                                          <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-5.jpg" alt="">
                                      </picture>
                                          <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                              <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                          </div>
                                  </div>
                                  <div class="card-body px-0">
                                      <a class="text-decoration-none link-cover" href="./product.html">Nike Air Max 90</a>
                                      <small class="text-muted d-block">4 colours, 10 sizes</small>
                                              <p class="mt-2 mb-0 small"><s class="text-muted">$196.99</s> <span class="text-danger">$98.66</span></p>
                                  </div>
                              </div>
                              <!--/ Card Product-->
                            </div>
                            <div class="swiper-slide">
                              <!-- Card Product-->
                              <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                  <div class="card-img position-relative">
                                      <div class="card-badges">
                                              <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-danger rounded-circle d-block me-1"></span> Sale</span>
                                              <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-success rounded-circle d-block me-1"></span> New In</span>
                                      </div>
                                      <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                      <picture class="position-relative overflow-hidden d-block bg-light">
                                          <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-6.jpg" alt="">
                                      </picture>
                                          <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                              <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                          </div>
                                  </div>
                                  <div class="card-body px-0">
                                      <a class="text-decoration-none link-cover" href="./product.html">Nike Glide FlyEase</a>
                                      <small class="text-muted d-block">1 colour</small>
                                              <p class="mt-2 mb-0 small"><s class="text-muted">$329.99</s> <span class="text-danger">$198.66</span></p>
                                  </div>
                              </div>
                              <!--/ Card Product-->
                            </div>
                            <div class="swiper-slide">
                              <!-- Card Product-->
                              <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                  <div class="card-img position-relative">
                                      <div class="card-badges">
                                      </div>
                                      <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                      <picture class="position-relative overflow-hidden d-block bg-light">
                                          <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-7.jpg" alt="">
                                      </picture>
                                          <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                              <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                          </div>
                                  </div>
                                  <div class="card-body px-0">
                                      <a class="text-decoration-none link-cover" href="./product.html">Nike Zoom Freak</a>
                                      <small class="text-muted d-block">2 colours, 2 sizes</small>
                                              <p class="mt-2 mb-0 small">$444.99</p>
                                  </div>
                              </div>
                              <!--/ Card Product-->
                            </div>
                            <div class="swiper-slide">
                              <!-- Card Product-->
                              <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                  <div class="card-img position-relative">
                                      <div class="card-badges">
                                              <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-success rounded-circle d-block me-1"></span> New In</span>
                                      </div>
                                      <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                      <picture class="position-relative overflow-hidden d-block bg-light">
                                          <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-8.jpg" alt="">
                                      </picture>
                                          <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                              <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                          </div>
                                  </div>
                                  <div class="card-body px-0">
                                      <a class="text-decoration-none link-cover" href="./product.html">Nike Air Pegasus</a>
                                      <small class="text-muted d-block">3 colours, 10 sizes</small>
                                              <p class="mt-2 mb-0 small">$178.99</p>
                                  </div>
                              </div>
                              <!--/ Card Product-->
                            </div>
                            <div class="swiper-slide">
                              <!-- Card Product-->
                              <div class="card border border-transparent position-relative overflow-hidden h-100 transparent">
                                  <div class="card-img position-relative">
                                      <div class="card-badges">
                                              <span class="badge badge-card"><span class="f-w-2 f-h-2 bg-success rounded-circle d-block me-1"></span> New In</span>
                                      </div>
                                      <span class="position-absolute top-0 end-0 p-2 z-index-20 text-muted"><i class="ri-heart-line"></i></span>
                                      <picture class="position-relative overflow-hidden d-block bg-light">
                                          <img class="w-100 img-fluid position-relative z-index-10" title="" src="./assets/images/products/product-1.jpg" alt="">
                                      </picture>
                                          <div class="position-absolute start-0 bottom-0 end-0 z-index-20 p-2">
                                              <button class="btn btn-quick-add"><i class="ri-add-line me-2"></i> Quick Add</button>
                                          </div>
                                  </div>
                                  <div class="card-body px-0">
                                      <a class="text-decoration-none link-cover" href="./product.html">Nike Air Jordans</a>
                                      <small class="text-muted d-block">3 colours, 10 sizes</small>
                                              <p class="mt-2 mb-0 small">$154.99</p>
                                  </div>
                              </div>
                              <!--/ Card Product-->
                            </div>
                      </div>
                    
                      <!-- Add Arrows -->
                      <div
                        class="swiper-prev top-50  start-0 z-index-30 cursor-pointer transition-all bg-white px-3 py-4 position-absolute z-index-30 top-50 start-0 mt-n8 d-flex justify-content-center align-items-center opacity-50-hover">
                        <i class="ri-arrow-left-s-line ri-lg"></i></div>
                      <div
                        class="swiper-next top-50 end-0 z-index-30 cursor-pointer transition-all bg-white px-3 py-4 position-absolute z-index-30 top-50 end-0 mt-n8 d-flex justify-content-center align-items-center opacity-50-hover">
                        <i class="ri-arrow-right-s-line ri-lg"></i></div>
                    
                    
                    </div>
                    <!-- / Swiper Latest-->                </div>
                <!-- / Related Products-->

                <!-- Reviews-->
                <div class="col-12" data-aos="fade-up">
                    <h3 class="fs-4 fw-bolder mt-7 mb-4 reviews">Reviews</h3>
                    
                    <!-- Review Summary-->
                    <div class="bg-light p-5 justify-content-between d-flex flex-column flex-lg-row">
                        <div class="d-flex flex-column align-items-center mb-4 mb-lg-0">
                            <div class="bg-dark text-white f-w-24 f-h-24 d-flex rounded-circle align-items-center justify-content-center fs-2 fw-bold mb-3">4.3</div>
                            <!-- Review Stars Medium-->
                            <div class="rating position-relative d-table">
                                <div class="position-absolute stars" style="width: 88%">
                                    <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                    <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                    <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                    <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                    <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                </div>
                                <div class="stars">
                                    <i class="ri-star-fill ri-2x mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill ri-2x mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill ri-2x mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill ri-2x mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill ri-2x mr-1 text-muted opacity-25"></i>
                                </div>
                            </div>    </div>
                        <div class="d-flex flex-grow-1 flex-column ms-lg-8">
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <div class="f-w-20">
                                    <!-- Review Stars Small-->
                                    <div class="rating position-relative d-table">
                                        <div class="position-absolute stars" style="width: 100%">
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                        </div>
                                        <div class="stars">
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        </div>
                                    </div>            </div>
                                <div class="progress d-flex flex-grow-1 mx-4 f-h-1">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-bold small d-block f-w-4 text-end">55</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <div class="f-w-20">
                                    <!-- Review Stars Small-->
                                    <div class="rating position-relative d-table">
                                        <div class="position-absolute stars" style="width: 80%">
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                        </div>
                                        <div class="stars">
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        </div>
                                    </div>            </div>
                                <div class="progress d-flex flex-grow-1 mx-4 f-h-1">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-bold small d-block f-w-4 text-end">32</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <div class="f-w-20">
                                    <!-- Review Stars Small-->
                                    <div class="rating position-relative d-table">
                                        <div class="position-absolute stars" style="width: 60%">
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                        </div>
                                        <div class="stars">
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        </div>
                                    </div>            </div>
                                <div class="progress d-flex flex-grow-1 mx-4 f-h-1">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 30%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-bold small d-block f-w-4 text-end">15</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <div class="f-w-20">
                                    <!-- Review Stars Small-->
                                    <div class="rating position-relative d-table">
                                        <div class="position-absolute stars" style="width: 40%">
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                        </div>
                                        <div class="stars">
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        </div>
                                    </div>            </div>
                                <div class="progress d-flex flex-grow-1 mx-4 f-h-1">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 8%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-bold small d-block f-w-4 text-end">5</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-start mb-2">
                                <div class="f-w-20">
                                    <!-- Review Stars Small-->
                                    <div class="rating position-relative d-table">
                                        <div class="position-absolute stars" style="width: 20%">
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                            <i class="ri-star-fill text-dark mr-1"></i>
                                        </div>
                                        <div class="stars">
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                            <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        </div>
                                    </div>            </div>
                                <div class="progress d-flex flex-grow-1 mx-4 f-h-1">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-bold small d-block f-w-4 text-end">1</span>
                            </div>
                            <p class="mt-3 mb-0 d-flex align-items-start"><i class="ri-chat-voice-line me-2"></i> 105 customers have reviewed this product</p>
                        </div>
                    </div><!-- / Rewview Summary-->
                    
                    <!-- Reviews-->
                    <div class="row g-6 g-md-8 g-lg-10 my-3">
                        <div class="col-12 col-lg-6 col-xxl-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 80%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>            <div class="text-muted small">20th September 2020 by DaveD</div>
                            </div>
                            <p class="fw-bold mb-2">Great fit, great price</p>
                            <p class="fs-7">Worth buying this for value for money. But be warned: get one size larger as the medium is closer to small medium!</p>
                        </div>
                        <div class="col-12 col-lg-6 col-xxl-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 40%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>            
                                <div class="text-muted small">18th September 2020 by Sandra K</div>
                            </div>
                            <p class="fw-bold mb-2">Not worth the money</p>
                            <p class="fs-7">Loose and poor stiching on the sides. Won&#x27;t buy this again.</p>
                        </div>
                        <div class="col-12 col-lg-6 col-xxl-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 90%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>            
                                <div class="text-muted small">16th September 2020 by MikeS</div>
                            </div>
                            <p class="fw-bold mb-2">Decent for the price</p>
                            <p class="fs-7">I buy these often as they are good quality and value for money.</p>
                        </div>
                        <div class="col-12 col-lg-6 col-xxl-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 85%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>            <div class="text-muted small">14th September 2020 by Frankie</div>
                            </div>
                            <p class="fw-bold mb-2">Great little T</p>
                            <p class="fs-7">Wore this to my local music festival - went down well.</p>
                        </div>
                        <div class="col-12 col-lg-6 col-xxl-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 70%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>            <div class="text-muted small">20th September 2020 by Kevin</div>
                            </div>
                            <p class="fw-bold mb-2">Great for the BBQ</p>
                            <p class="fs-7">Bought this on the off chance it would work well with my skinny jeans, was a great decision. Would recommend.</p>
                        </div>
                        <div class="col-12 col-lg-6 col-xxl-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 20%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div>            <div class="text-muted small">20th September 2020 by Holly</div>
                            </div>
                            <p class="fw-bold mb-2">Nothing special but it&#x27;s okay</p>
                            <p class="fs-7">It&#x27;s a t-shirt. What can I say, it does the job.</p>
                        </div>
                    </div>
                    <!-- / Reviews-->
                    
                    <!-- Review Pagination-->
                    <div class="d-flex flex-column f-w-44 mx-auto my-5 text-center">
                        <small class="text-muted">Showing 6 of 105 reviews</small>
                        <div class="progress f-h-1 mt-3">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="#" class="btn btn-outline-dark btn-sm mt-5 align-self-center py-3 px-4 border-2">Load More</a>
                    </div><!-- / Review Pagination-->                </div>
                <!-- / Reviews-->
            </div>

        </div>
        <?php }else{ ?>
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
                            <select class="form-select form-select-sm border-0 bg-light p-3 pe-5 lh-1 fs-7">
                                <option selected>Sort By</option>
                                <option value="1">Hi Low</option>
                                <option value="2">Low Hi</option>
                                <option value="3">Name</option>
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
        <?php }
        ?>
        <!-- /Page Content -->
    </section>
    <!-- / Main Section-->

  <?php require_once 'partial/footer.php' ?>
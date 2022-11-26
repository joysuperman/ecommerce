<?php 
    require_once "partials/_header.php"; 

    $category_id = "";
    $required ="required";

    // Insert Category Or Update Category
    if (isset($_POST['submit'])) {
        $required="";
        $category_id = get_safe_value($con, $_POST['category_id']);
        $name = get_safe_value($con, $_POST['name']);
        $mrp = get_safe_value($con, $_POST['mrp']);
        $price = get_safe_value($con, $_POST['price']);
        $quentity = get_safe_value($con, $_POST['quentity']);
        $s_description = get_safe_value($con, $_POST['s_description']);
        $description = get_safe_value($con, $_POST['description']);
        $meta_title = get_safe_value($con, $_POST['meta_title']);
        $meta_description = get_safe_value($con, $_POST['meta_description']);
        $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);

        $result = mysqli_query($con, "SELECT name FROM product WHERE name = '{$name}'");
        if (mysqli_num_rows($result) > 0) {
            if (isset($_GET['id'])&& $_GET['id'] != "" || isset($_GET['type']) && $_GET['type'] != "" ) {

            }else{
                $msg = "Product Already Exist";
            }
        }else{
            $msg = "Product Already Exist";
        }


        if ($name) {
            if (isset($_GET['id'])&& $_GET['id'] != "" || isset($_GET['type']) && $_GET['type'] != "" ) {
                $type = get_safe_value($con, $_GET['type']);
                $id = get_safe_value($con, $_GET['id']);
                if ($_FILES['img']['name'] != "") {
                    $image = img_upload();
                    $query = "UPDATE product SET category_id='$category_id',name='$name',mrp='$mrp',price='$price',quentity='$quentity',image='$image',s_description='$s_description',description='$description',meta_title='$meta_title',meta_description='$meta_description',meta_keyword='$meta_keyword' WHERE id = '{$id}'";
                }
                else{
                    $query = "UPDATE product SET category_id='$category_id',name='$name',mrp='$mrp',price='$price',quentity='$quentity',s_description='$s_description',description='$description',meta_title='$meta_title',meta_description='$meta_description',meta_keyword='$meta_keyword' WHERE id = '{$id}'";
                }
            }else{ 
                $image = img_upload();
                $query = "INSERT INTO product (category_id, name, mrp, price, quentity, image, s_description, description, meta_title, meta_description, meta_keyword, status ) VALUES ('{$category_id}','{$name}','{$mrp}','{$price}','{$quentity}','{$image}','{$s_description}','{$description}','{$meta_title}','{$meta_description}','{$meta_keyword}','1')";
            }

            mysqli_query($con, $query);
            if (mysqli_error($con)) {
                $msg = "Somthing Went Wrong!";
            }else{
                header("location: product.php");       
            }
        }else{
            $msg = "Insert Right information";
        }
    }

    // Get Value From Product
    if (isset($_GET['id'])&& $_GET['id'] != "" || isset($_GET['type']) && $_GET['type'] != "" ) {
        $type = get_safe_value($con, $_GET['type']);
        $id = get_safe_value($con, $_GET['id']);

        $data= get_product($con,$type,$id);
    }
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
                    
                    <div class="row">

                        <div class="col-md-8 offset-md-2">
                            <h1 class="h3 mb-2 text-gray-800">Manage product</h1>

                        <?php 
                            if (isset($_GET['type']) && $_GET['type'] != "" && $_GET['type']== "edit" ) { ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Categoryes</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" class="form_validation" novalidate>
                                        <div class="form-group">
                                                <label for="exampleInputcategory">Category Id</label><br> 
                                                <select class="form-control" name="category_id">
                                                    <option value="" selected disabled>Category</option>
                                                    <?php 
                                                        $result = mysqli_query($con, "SELECT id,category FROM categories WHERE status=1 AND not(main_category=0) ORDER BY category DESC");
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $selected="";
                                                            if ($data['category_id'] == $row['id']) {
                                                                $selected ="selected";
                                                            }
                                                            echo "<option value=".$row['id']." $selected >".$row['category']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        <div class="form-group">
                                            <label for="exampleInputcategory">Name</label><br>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Category Name" value="<?php echo $data['name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputcategory">MRP</label><br>
                                            <input type="text" name="mrp" class="form-control" id="mrp"
                                                placeholder="MRP" value="<?php echo $data['mrp']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputcategory">Price</label><br>
                                            <input type="text" name="price" class="form-control" id="price"
                                                placeholder="Price" value="<?php echo $data['price']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputcategory">Quentity</label><br>
                                            <input type="text" name="quentity" class="form-control" id="quentity"
                                                placeholder="Quantity" value="<?php echo $data['quentity']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="img">Product Image</label><br>
                                            <?php
                                                if ($data['image'] == "") {
                                                    echo "No image found";
                                                }
                                                else{ ?>
                                                <img style="height: 50px; width: 50px; object-fit: cover;" src="<?php echo PRODUCT_IMG_SITE_PATH.$data['image']; ?>" alt="category Image">
                                               <?php }
                                            ?>
                                            <input type="file" placeholder="Image" id="img" name="img" <?php echo $required; ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputcategory">S.Description</label><br>
                                            <input type="text" name="s_description" class="form-control" id="s_description"
                                                placeholder="S Description" value="<?php echo $data['s_description']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputcategory">Description</label><br>
                                            <input type="text" name="description" class="form-control" id="description"
                                                placeholder="Description" value="<?php echo $data['description']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputcategory">Meta Title</label><br>
                                            <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                placeholder="Meta Title" value="<?php echo $data['meta_title']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputcategory">Meta Description</label><br>
                                            <input type="text" name="meta_description" class="form-control" id="exampleInputcategory"
                                                placeholder="Meta Description" value="<?php echo $data['meta_description']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputcategory">Meta Keyword</label><br>
                                            <input type="text" name="meta_keyword" class="form-control" id="meta_keyword"
                                                placeholder="Meta Keyword" value="<?php echo $data['meta_keyword']; ?>" required>
                                        </div>
                                        
                                        <p class="text-danger"><?php echo $msg; ?></p>

                                        <button type="submit" name="submit" class="btn btn-primary btn-user">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-list"></i>
                                            </span>
                                            <span class="text">Save</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <?php }
                            else{ ?>

                            	<div class="card shadow mb-4">
	                                <div class="card-header py-3">
	                                    <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
	                                </div>
	                                <div class="card-body">
	                                    <form method="POST" enctype="multipart/form-data" class="form_validation" novalidate>
                                            <div class="form-group">
                                                <label for="exampleInputcategory">Category Id</label><br> 
                                                <select class="form-control" name="category_id">
                                                    <option value="" selected disabled>Category</option>
                                                    <?php 
                                                        $result = mysqli_query($con, "SELECT id,category FROM categories WHERE status=1 AND not(main_category=0) ORDER BY category DESC");
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<option value=".$row['id'].">".$row['category']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputcategory">Name</label><br>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Category Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputcategory">MRP</label><br>
                                                <input type="text" name="mrp" class="form-control" id="mrp"
                                                    placeholder="Category Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputcategory">Price</label><br>
                                                <input type="text" name="price" class="form-control" id="price"
                                                    placeholder="Category Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputcategory">Quentity</label><br>
                                                <input type="text" name="quentity" class="form-control" id="quentity"
                                                    placeholder="Category Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="img">Category Image</label><br>
                                                <input type="file" placeholder="Image" id="img" name="img">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputcategory">S.Description</label><br>
                                                <input type="text" name="s_description" class="form-control" id="s_description"
                                                    placeholder="Category Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputcategory">Description</label><br>
                                                <input type="text" name="description" class="form-control" id="description"
                                                    placeholder="description" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputcategory">Meta Title</label><br>
                                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                    placeholder="Meta Title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputcategory">Meta Description</label><br>
                                                <input type="text" name="meta_description" class="form-control" id="exampleInputcategory"
                                                    placeholder="Meta Description" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputcategory">Meta Keyword</label><br>
                                                <input type="text" name="meta_keyword" class="form-control" id="meta_keyword"
                                                    placeholder="meta_keyword" required>
                                            </div>
	                                        
	                                        <p class="text-danger"><?php echo $msg; ?></p>

	                                        <button type="submit" name="submit" class="btn btn-primary btn-user">
	                                            <span class="icon text-white-50">
	                                                <i class="fas fa-list"></i>
	                                            </span>
	                                            <span class="text">ADD CATEGORY</span>
	                                        </button>
	                                    </form>
	                                </div>
	                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once "partials/_footer.php"?>
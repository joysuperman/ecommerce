<?php 
    require_once "partials/_header.php"; 

    $category ="";
    $image ="";

    // Insert Category Or Update Category
    if (isset($_POST['submit'])) {
        $name = get_safe_value($con, $_POST['category']);
        $parent_cat = get_safe_value($con, $_POST['parent_cat']);
        $type = get_safe_value($con, $_GET['type']);
        $id = get_safe_value($con, $_GET['id']);
        $result = mysqli_query($con, "SELECT category FROM categories WHERE category = '{$name}'");
        if (mysqli_num_rows($result) > 0) {
            if (isset($_GET['id'])&& $_GET['id'] != "" || isset($_GET['type']) && $_GET['type'] != "" ) {

            }else{
                $msg = "Category Already Exist";
            }
        }else{
            $msg = "Category Already Exist";
        }

        if ($name) {
            if (isset($_GET['id'])&& $_GET['id'] != "" || isset($_GET['type']) && $_GET['type'] != "" ) {
                if ($_FILES['img']['name'] != "") {
                    $image = img_upload();
                    $query = "UPDATE categories SET category='$name',category_image='$image' WHERE id = '{$id}'";
                }elseif ($parent_cat != "") {
                    $query = "UPDATE categories SET category='$name',main_category='$parent_cat' WHERE id = '{$id}'";
                }elseif ($parent_cat != "" && $_FILES['img']['name'] != "") {
                    $image = img_upload();
                    $query = "UPDATE categories SET category='$name',category_image='$image',main_category='$parent_cat' WHERE id = '{$id}'";
                }
                else{
                    $query = "UPDATE categories SET category='$name' WHERE id = '{$id}'";
                }
            }else{
                
                $image = img_upload();
                if ($parent_cat != '') {
                    $parent_cat = $parent_cat;
                }else{
                    $parent_cat = 0;
                }

                $query = "INSERT INTO categories (category, category_image, main_category, status) VALUES ('{$name}','{$image}', '{$parent_cat}','1')";
            }

            mysqli_query($con, $query);
            if (mysqli_error($con)) {
                $msg = "Connection Lost";
            }else{
                header("location: categories.php");
            }
        }
        else{
            $msg = "Insert Right information";
        }
    }

    // Get Value From Category
    if (isset($_GET['id'])&& $_GET['id'] != "" || isset($_GET['type']) && $_GET['type'] != "" ) {
        $type = get_safe_value($con, $_GET['type']);
        $id = get_safe_value($con, $_GET['id']);

        if ($type && $id) {
            $result = mysqli_query($con, "SELECT category, category_image FROM categories WHERE id = '{$id}'");
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $category = $row['category'];
                $image = $row['category_image'];
            }else{
                header("location: manage-category.php");
                die();
            }
        }
        else{
            header("location: manage-category.php");
            die();
        }
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
                            <h1 class="h3 mb-2 text-gray-800">Manage Categories</h1>

                        <?php 
                            if (isset($_GET['type']) && $_GET['type'] != "" && $_GET['type']== "edit" ) { ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Categoryes</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" class="form_validation" novalidate>
                                        <div class="form-group">
                                            <label for="exampleInputcategory">Image</label><br>
                                            <input type="text" name="category" class="form-control form-control-user" id="exampleInputcategory"
                                                placeholder="Category Name" value='<?php echo $category; ?>' required>
                                        </div>

                                        <div class="form-group">
                                            <label for="img">Category Image</label><br>
                                            <img style="height: 100px; width: 100px; object-fit: cover; margin-bottom: 20px;"  src="<?php echo PRODUCT_IMG_SITE_PATH.$image; ?>" alt="Category Image">
                                            <input type="file" placeholder="Image" id="img" name="img">
                                        </div>

                                        <div class="form-group">
                                                <label for="parent_category">Parent Category</label><br>
                                                <select class="form-control" name="parent_cat" id="parent_category">
                                                    <option value="" selected disabled>Category</option>
                                                    <?php 
                                                        $result = mysqli_query($con, "SELECT id,category FROM categories WHERE main_category=0 ORDER BY category DESC");
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $selected="";
                                                            if ($category_id == $row['id']) {
                                                                $selected ="selected";
                                                            }
                                                            echo "<option value=".$row['id']." $selected >".$row['category']."</option>";
                                                        }
                                                    ?>
                                                </select>
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
	                                    <h6 class="m-0 font-weight-bold text-primary">Add Categoryes</h6>
	                                </div>
	                                <div class="card-body">
	                                    <form method="POST" enctype="multipart/form-data" class="form_validation" novalidate>
	                                        <div class="form-group">
	                                            <label for="exampleInputcategory">Name</label><br>
	                                            <input type="text" name="category" class="form-control form-control-user" id="exampleInputcategory"
	                                                placeholder="Category Name" required>
	                                        </div>

	                                        <div class="form-group">
	                                            <label for="img">Image</label><br>
	                                            <input type="file" placeholder="Image" id="img" name="img">
	                                        </div>
                                            <div class="form-group">
                                                <label for="parent_category">Parent Category</label><br>
                                                <select class="form-control" name="parent_cat" id="parent_category">
                                                    <option value="" selected disabled>Category</option>
                                                    <?php 
                                                        $result = mysqli_query($con, "SELECT id,category FROM categories WHERE main_category=0 ORDER BY category DESC");
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $selected="";
                                                            if ($category_id == $row['id']) {
                                                                $selected ="selected";
                                                            }
                                                            echo "<option value=".$row['id']." $selected >".$row['category']."</option>";
                                                        }
                                                    ?>
                                                </select>
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
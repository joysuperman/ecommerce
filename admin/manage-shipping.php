<?php 
    require_once "partials/_header.php"; 

    $user_id = "";
    $required ="required";

    // Insert User Or Update User
    if (isset($_POST['submit'])) {
        $required="";
        $name = get_safe_value($con, $_POST['name']);
        $description = get_safe_value($con, $_POST['description']);
        $price = str_ireplace( array( '\'', '$' ), ' ',get_safe_value($con, $_POST['price']));

        if ($name && $description && $price) {
            if (isset($_GET['id'])&& $_GET['id'] != "" && isset($_GET['type']) && $_GET['type'] != "" ) {
                $type = get_safe_value($con, $_GET['type']);
                $id = get_safe_value($con, $_GET['id']);
                
                $query = "UPDATE shipping_method SET name='$name',description='$description',price='$price' WHERE id = '{$id}'";
            }else{
                $query = "INSERT INTO shipping_method (name, description, price) VALUES ('{$name}','{$description}','{$price}')";
            }
            mysqli_query($con, $query);
            if (mysqli_error($con)) {
                $msg = "Somthing Went Wrong!";
            }else{
                header("location: shipping.php");       
            }
        }else{
            $msg = "Insert Right information";
        }
    }

    // Get Value From User
    if (isset($_GET['id'])&& $_GET['id'] != "" && isset($_GET['type']) && $_GET['type'] != "" ) {
        $type = get_safe_value($con, $_GET['type']);
        $id = get_safe_value($con, $_GET['id']);

        $data= get_shipping($con,$type,$id);
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
                            <h1 class="h3 mb-2 text-gray-800">Manage Shipping</h1>

                        <?php 
                            if (isset($type) && $type != "" && $type== "edit" ) { ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Shipping</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" class="form_validation" novalidate>
                                        <div class="form-group">
                                            <label for="name">Name</label><br>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="First Name" value="<?php echo $data['name']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">description</label><br>
                                            <input type="text" name="description" class="form-control" id="description"
                                                placeholder="Last Name" value="<?php echo $data['description']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Price</label><br>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">$</span>
                                            </div>
                                            <input type="text" name="price" class="form-control" id="price"
                                                placeholder="price" value="<?php echo $data['price']; ?>" required>
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
	                                    <h6 class="m-0 font-weight-bold text-primary">Add Shipping</h6>
	                                </div>
	                                <div class="card-body">
	                                    <form method="POST" enctype="multipart/form-data" class="form_validation" novalidate>
                                            <div class="form-group">
                                                <label for="name">Name</label><br>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="First Name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label><br>
                                                <input type="text" name="description" class="form-control" id="description"
                                                    placeholder="Last Name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="price">Price</label><br>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                    </div>
                                                    <input type="text" name="price" class="form-control" id="price"
                                                        placeholder="price" required>
                                                </div>
                                            </div>

	                                        <p class="text-danger"><?php echo $msg; ?></p>

	                                        <button type="submit" name="submit" class="btn btn-primary btn-user">
	                                            <span class="icon text-white-50">
	                                                <i class="fas fa-list"></i>
	                                            </span>
	                                            <span class="text">ADD MMETHOD</span>
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
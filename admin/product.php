<?php 
    require_once "partials/_header.php"; 

    $query = "SELECT product.*, categories.category FROM product,categories WHERE product.category_id=categories.id ORDER BY product.id DESC";
    $result = mysqli_query($con, $query);

    if (isset($_GET['type']) && $_GET['type'] != '') {
        $type = get_safe_value($con, $_GET['type']);
        
        // Status Update
        if ($type == 'status') {
            $operation = get_safe_value($con, $_GET['operation']);
            $id = get_safe_value($con, $_GET['id']);

            if ($operation == 'active') {
                $status = '1';
                header("location: product.php");
            }else{
                $status = '0';
                header("location: product.php");
            }

            $update_status = "UPDATE product SET status = '$status' WHERE id = '$id'";
            mysqli_query($con, $update_status);
        }

        // Delete category
        if ($type == 'delete') {
            $id = get_safe_value($con, $_GET['id']);
            
            $delete_category = "DELETE FROM product WHERE id = '$id'";
            mysqli_query($con, $delete_category);
            header("location: product.php");
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
                    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">PRODUCT</h1>

                    <a href="manage-product.php" class="btn btn-primary btn-icon-split btn-lg">
                        <span class="icon text-white-50">
                            <i class="fas fa-flag"></i>
                        </span>
                        <span class="text">Add Product</span>
                    </a>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Id</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>MRP</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i = 1; 
                                        while ($data = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $data['id']; ?></td>
                                                <td>
                                                    <?php
                                                        echo $data['category'];
                                                    ?>    
                                                </td>
                                                <td><?php echo $data['name']; ?></td>
                                                <td><?php echo $data['mrp']; ?></td>
                                                <td><?php echo $data['price']; ?></td>
                                                <td><?php echo $data['quentity']; ?></td>
                                                <td>
                                                    <?php
                                                        if ($data['image'] == "") {
                                                            echo "No image found";
                                                        }
                                                        else{ ?>
                                                            <img style="height: 50px; width: 50px; object-fit: cover;" src="<?php echo PRODUCT_IMG_SITE_PATH.$data['image']; ?>" alt="category Image">
                                                       <?php }
                                                    ?>
                                                </td>
                                                <td><?php echo $data['description']; ?></td>
                                                <td>
                                                    <?php
                                                        if ($data['status'] == 1) {
                                                            echo "<a class='btn btn-warning' href='?type=status&operation=deactive&id=".$data['id']."'>Deactive</a>";
                                                        }else{
                                                            echo "<a class='btn btn-success' href='?type=status&operation=active&id=".$data['id']."'>Active</a>";
                                                        }
                                                    ?>
                                                    <a href='manage-product.php?type=edit&id=<?php echo $data['id']; ?>' class="btn btn-primary btn-user">
                                                        <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                                                    </a>
                                                    <button class="btn btn-danger btn-user" data-toggle="modal" data-target="#product_delete">
                                                        <span class="icon text-white-50"><i class="fas fa-trash"></i></span>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Delete Modal-->
                                            <div class="modal fade" id="product_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">If you sure want to delete the category item then click "Delete". Otherwise click "Cancle".</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                            <a class="btn btn-danger" href="?type=delete&id=<?php echo $data['id']; ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once "partials/_footer.php"?>
<?php 
    require_once "partials/_header.php";

    $query = "SELECT * FROM shipping_method";
    $result = mysqli_query($con, $query);

    if (isset($_GET['type']) && $_GET['type'] != '' || isset($_GET['id']) && $_GET['id'] != '') {
        $type = get_safe_value($con, $_GET['type']);
        $id = get_safe_value($con, $_GET['id']);

        // Delete category
        if ($type == 'delete') {
            $delete_user = "DELETE FROM shipping_method WHERE id = '$id'";
            mysqli_query($con, $delete_user);
            header("location: shipping.php");
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
                    <h1 class="h3 mb-2 text-gray-800">Shipping Method</h1>

                    <a href="manage-shipping.php" class="btn btn-primary btn-icon-split btn-lg">
                        <span class="icon text-white-50">
                            <i class="fas fa-flag"></i>
                        </span>
                        <span class="text">Add Shipping</span>
                    </a>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Shipping List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo $count++ ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['description'] ?></td>
                                            <td>
                                        	<?php
                                    		 	if ($row['price']=="0") {
                                        		 	echo "FREE";
                                        		}else{
                                        			echo '$'.$row['price'];
                                        		}
                                         	?>
                                             </td>
                                            <td>
                                                <a href='manage-shipping.php?type=edit&id=<?php echo $row['id']; ?>' class="btn btn-primary btn-user">
                                                    <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                                                </a>
                                                <button class="btn btn-danger btn-user" data-toggle="modal" data-target="#user_delete<?php echo $row['id']; ?>">
                                                    <span class="icon text-white-50"><i class="fas fa-trash"></i></span>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal-->
                                        <div class="modal fade" id="user_delete<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">If you sure want to delete the Method <b class="text-danger">"<?php echo $row['name']; ?>"</b> then click "Delete". Otherwise click "Cancle".</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <a class="btn btn-danger" href="?type=delete&id=<?php echo $row['id']; ?>">Delete</a>
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
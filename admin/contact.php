<?php 
    require_once "partials/_header.php";

    $query = "SELECT * FROM contact ORDER BY email DESC";
    $result = mysqli_query($con, $query);

    // Delete Comment
    if (isset($_GET['type']) && $_GET['type'] != '' || isset($_GET['id']) && $_GET['id'] != '') {
        $type = get_safe_value($con, $_GET['type']);

        if ($type == 'delete') {
            $id = get_safe_value($con, $_GET['id']);
            
            $delete_comment = "DELETE FROM contact WHERE id = '$id'";
            mysqli_query($con, $delete_comment);
            header("location: contact.php");
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
                    <h1 class="h3 mb-2 text-gray-800">Contact</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Client Contact Info</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Comment</th>
                                            <th>Ip</th>
                                            <th>Date-Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i = 1; 
                                        while ($data = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $data['id']; ?></td>
                                                <td><?php echo $data['name']; ?></td>
                                                <td><?php echo $data['email']; ?></td>
                                                <td><?php echo $data['message']; ?></td>
                                                <td><?php echo $data['user_ip']; ?></td>
                                                <td><?php echo $data['added_on']; ?></td>
                                                <td>
                                                    <button class="btn btn-danger btn-user" data-toggle="modal" data-target="#contact_delete">
                                                        <span class="icon text-white-50"><i class="fas fa-trash"></i></span>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Delete Modal-->
                                            <div class="modal fade" id="contact_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
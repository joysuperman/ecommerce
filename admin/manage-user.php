<?php 
    require_once "partials/_header.php"; 

    $user_id = "";
    $required ="required";

    // Insert User Or Update User
    if (isset($_POST['submit'])) {
        $required="";
        $f_name = get_safe_value($con, $_POST['f_name']);
        $l_name = get_safe_value($con, $_POST['l_name']);
        $email = get_safe_value($con, $_POST['email']);
        $phone = get_safe_value($con, $_POST['phone']);
        $password = get_safe_value($con, $_POST['password']);
        $role = get_safe_value($con, $_POST['role']);


        $result = mysqli_query($con, "SELECT email FROM admin_user");
        if (mysqli_num_rows($result) > 0) {
            if (isset($_GET['id'])&& $_GET['id'] != "" || isset($_GET['type']) && $_GET['type'] != "" ) {

            }else{
                $msg = "Email Already Exist";
            }
        }else{
            $msg = "Email Already Exist";
        }


        if ($f_name && $l_name && $email && $role) {
            if (isset($_GET['id'])&& $_GET['id'] != "" && isset($_GET['type']) && $_GET['type'] != "" ) {
                $type = get_safe_value($con, $_GET['type']);
                $id = get_safe_value($con, $_GET['id']);
                
                $query = "UPDATE admin_user SET f_name='$f_name',l_name='$l_name',email='$email',phone='$phone',role='$role' WHERE id = '{$id}'";
            }else{
                $status = 1;
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $date = date("Y-m-d");
                $authKey = generateRandomString();
                
                $query = "INSERT INTO admin_user (f_name, l_name, email, phone, password, role, status, user_register, user_activation_key) VALUES ('{$f_name}','{$l_name}','{$email}','{$phone}','{$hash}','{$role}','{$status}','{$date}','{$authKey}')";
            }

            mysqli_query($con, $query);
            if (mysqli_error($con)) {
                $msg = "Somthing Went Wrong!";
            }else{
                header("location: user.php");       
            }
        }else{
            $msg = "Insert Right information";
        }
    }

    // Get Value From User
    if (isset($_GET['id'])&& $_GET['id'] != "" && isset($_GET['type']) && $_GET['type'] != "" ) {
        $type = get_safe_value($con, $_GET['type']);
        $id = get_safe_value($con, $_GET['id']);

        $data= get_user($con,$type,$id);
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
                            <h1 class="h3 mb-2 text-gray-800">Manage User</h1>

                        <?php 
                            if (isset($type) && $type != "" && $type== "edit" ) { ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" class="form_validation" novalidate>
                                        <div class="form-group">
                                            <label for="f_name">First Name</label><br>
                                            <input type="text" name="f_name" class="form-control" id="f_name"
                                                placeholder="First Name" value="<?php echo $data['f_name']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="l_name">Last Name</label><br>
                                            <input type="text" name="l_name" class="form-control" id="l_name"
                                                placeholder="Last Name" value="<?php echo $data['l_name']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label><br>
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Email" value="<?php echo $data['email']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Phone</label><br>
                                            <input type="tel" name="phone" class="form-control" id="phone"
                                                placeholder="Phone" value="<?php echo $data['phone']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="role">Role</label><br>
                                            <select class="form-control" name="role">
                                                <option value="" selected disabled>Role...</option>
                                                <?php
                                                    $selected = $data['role'];
                                                    get_user_role($con, $selected);
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
	                                    <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
	                                </div>
	                                <div class="card-body">
	                                    <form method="POST" enctype="multipart/form-data" class="form_validation" novalidate>
                                            <div class="form-group">
                                                <label for="f_name">First Name</label><br>
                                                <input type="text" name="f_name" class="form-control" id="f_name"
                                                    placeholder="First Name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="l_name">Last Name</label><br>
                                                <input type="text" name="l_name" class="form-control" id="l_name"
                                                    placeholder="Last Name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label><br>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Email" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="phone">Phone</label><br>
                                                <input type="tel" name="phone" class="form-control" id="phone"
                                                    placeholder="Phone" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label><br>
                                                <input type="password" name="password" class="form-control" id="password"
                                                    placeholder="password" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="role">Role</label><br>
                                                <select class="form-control" name="role">
                                                    <option value="" selected disabled>Role...</option>
                                                    <?php
                                                        $selected = $data['role'];
                                                        get_user_role($con);
                                                    ?>   
                                                </select>
                                            </div>

	                                        <p class="text-danger"><?php echo $msg; ?></p>

	                                        <button type="submit" name="submit" class="btn btn-primary btn-user">
	                                            <span class="icon text-white-50">
	                                                <i class="fas fa-list"></i>
	                                            </span>
	                                            <span class="text">ADD User</span>
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
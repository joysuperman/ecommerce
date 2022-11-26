<?php 
require_once 'partial/header.php';
$msg="";

if (isset($_POST['submit'])) {
	$name = get_safe_value($con, $_POST['contact_name']);
    $email = get_safe_value($con, $_POST['contact_email']);
    $message = get_safe_value($con, $_POST['contact_message']);
    $date = date("Y-m-d h:i:s");
    $ip = "192.168.0.1";//$_SERVER['REMOTE_ADDR'];

    if ($name && $email && $message) {

     	$query = "INSERT INTO contact (name, email, message, user_ip, added_on) VALUES ('{$name}','{$email}', '{$message}','{$ip}','{$date}')";
     	mysqli_query($con, $query);

        if (mysqli_error($con)) {
            $msg = "Connection Lost";
        }else{
    		$msg = "Send Successfully!";
        }
    }else{
        $msg = "Insert Right Input Value";
    }
}

?>
	<!-- Main Section-->
	<section class="mt-0 ">
		<!-- Banner -->
		<div class="py-10 bg-img-cover bg-overlay-dark position-relative overflow-hidden bg-pos-center-center rounded-0" style="background-image: url(./assets/images/banners/banner-category-top.jpg);">
            <div class="container-fluid position-relative z-index-20 aos-init aos-animate" data-aos="fade-right" data-aos-delay="300">
                <h1 class="fw-bold display-6 mb-4 text-white">Latest Arrivals</h1>
                <div class="col-12 col-md-6">
                    <p class="text-white mb-0 fs-5">
                        When it's time to head out and get your Kicks on, have a look at our latest arrivals. Whether you're into Nike, Adidas, Dunks or New Balance, we really have something for everyone!
                    </p>
                </div>
            </div>
        </div>
        <!-- Banner -->

	    <!-- Page Content Goes Here -->
	    <div class="container aos-init aos-animate">
		    <div class="row py-5">
		    	<div class="col-12 col-md-6 bg-gray">
		    		<h1 class="mb-4">Contact Us</h1>
		        	<form method="POST" class="form_validation" novalidate>
		                <div class="form-group">
		                  <label class="form-label" for="contact-name">Full Name</label>
		                  <input type="text" class="form-control" id="contact-name" name="contact_name"  placeholder="Full Name" required>
		                </div>

		                <div class="form-group">
		                  <label class="form-label" for="contact-email">Email address</label>
		                  <input type="email" class="form-control" id="contact-email" name="contact_email" placeholder="name@email.com" required>
		                </div>

		                <div class="form-group">
		                  <label for="contact-content" class="form-label">Message</label>
		                  <textarea class="form-control" id="contact-content" rows="7" name="contact_message" placeholder="Your Message" required></textarea>
		                </div>
		                <p class="text-danger"><?php echo $msg; ?></p>
		                <button type="submit" name="submit" class="btn btn-dark d-block w-100 my-4">Send</button>
		            </form>
		    	</div>

		    	<div class="col-12 col-md-6">
		    		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13004066.00814038!2d-104.65581234446189!3d37.275676226127175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sbd!4v1664130965425!5m2!1sen!2sbd" style="border:0; height: 100%; width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		    	</div>
		    </div>	
	    	
	    </div>          

	    <!-- /Page Content -->
	</section>
	<!-- / Main Section-->

 <?php require_once 'partial/footer.php' ?>
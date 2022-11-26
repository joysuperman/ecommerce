	<!-- Logo-->
    <a class="navbar-brand fw-bold fs-3 flex-shrink-0 mx-0 px-0" href="index.php">
            <div class="d-flex align-items-center">
                <svg class="f-w-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.53 72.26"><path d="M10.43,54.2h0L0,36.13,10.43,18.06,20.86,0H41.72L10.43,54.2Zm67.1-7.83L73,54.2,68.49,62,45,48.47,31.29,72.26H20.86l-5.22-9L52.15,0H62.58l5.21,9L54.06,32.82,77.53,46.37Z" fill="currentColor" fill-rule="evenodd"/></svg>
            </div>
        </a>
    <!-- / Logo-->

 	<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
    <nav class="d-none d-md-block">
        <ul class="list-unstyled d-flex justify-content-start mt-4 align-items-center fw-bolder small">
            <li class="me-4"><a class="nav-link-checkout <?= ($activePage == 'cart') ? 'active':''; ?>"
                    href="cart.php">Your Cart</a></li>
            <li class="me-4"><a class="nav-link-checkout <?= ($activePage == 'checkout') ? 'active':''; ?>"
                    href="checkout.php">Information</a></li>
            <li class="me-4"><a class="nav-link-checkout <?= ($activePage == 'checkout-shipping') ? 'active':''; ?>"
                    href="checkout-shipping.php">Shipping</a></li>
            <li><a class="nav-link-checkout nav-link-last <?= ($activePage == 'checkout-payment') ? 'active':''; ?>"
                    href="checkout-payment.php">Payment</a></li>
        </ul>
    </nav> 
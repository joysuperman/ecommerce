 <?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>

 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($activePage == 'index') ? 'active':''; ?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?= ($activePage == 'categories') ? 'active':''; ?>">
                <a class="nav-link" href="categories.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Categories</span></a>
            </li>

            <!-- Nav Item -->
            <li class="nav-item <?= ($activePage == 'product') ? 'active':''; ?>">
                <a class="nav-link" href="product.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Products</span></a>
            </li>

            <!-- Nav Item -->
            <li class="nav-item <?= ($activePage == 'order') ? 'active':''; ?>">
                <a class="nav-link" href="order.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Orders</span></a>
            </li>

            <!-- Nav Item -->
            <li class="nav-item <?= ($activePage == 'user') ? 'active':''; ?>">
                <a class="nav-link" href="user.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Users</span></a>
            </li>

            <!-- Nav Item -->
            <li class="nav-item <?= ($activePage == 'contact') ? 'active':''; ?>">
                <a class="nav-link" href="contact.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Contact</span></a>
            </li>



            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting"
                    aria-expanded="true" aria-controls="collapseSetting">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span>
                </a>
                <div id="collapseSetting" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Site Setting:</h6>
                        <a class="collapse-item" href="shipping.php">Shipping Method</a>
                        <a class="collapse-item" href="Mail.php">Mail</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Theme Customization</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
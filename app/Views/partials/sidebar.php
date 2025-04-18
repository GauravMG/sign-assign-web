<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="<?= base_url('images/cropped-sign-assign_icon-32x32.jpg'); ?>" alt="Sign Assign" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: #ffffff;">
        <span class="brand-text font-weight-light">Sign Assign</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item sidebar-nav-item sidebar-nav-item-superadmin sidebar-nav-item-brokeradmin">
                    <a href="/users" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item sidebar-nav-item sidebar-nav-item-superadmin">
                    <a href="/product-categories" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Product Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item sidebar-nav-item sidebar-nav-item-superadmin">
                    <a href="/products" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>
                <li class="nav-item sidebar-nav-item sidebar-nav-item-superadmin sidebar-nav-item-brokeradmin sidebar-nav-item-brokerstaff">
                    <a href="/orders" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>
                <li class="nav-item sidebar-nav-item sidebar-nav-item-superadmin sidebar-nav-item-brokeradmin sidebar-nav-item-brokerstaff">
                    <a href="/invoices" class="nav-link">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>
                            Invoices
                        </p>
                    </a>
                </li>
                <li class="nav-item sidebar-nav-item sidebar-nav-item-superadmin sidebar-nav-item-brokeradmin sidebar-nav-item-brokerstaff">
                    <a href="/payments" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Payments
                        </p>
                    </a>
                </li>
                <li class="nav-item sidebar-nav-item sidebar-nav-item-superadmin">
                    <a href="/reports" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Project EAD</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administrator
            </div>

            <!-- Nav Item - Home -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin'); ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>
            <div class="sidebar-heading">
                Manage
            </div>
            <!-- Nav Item - project -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Project</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('admin/reqproject'); ?>">Requested Project</a>
                        <a class="collapse-item" href="<?= base_url('admin/manageproject'); ?>">Manage Project</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/manageaccount'); ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Account</span></a>
            </li>


            <hr class="sidebar-divider">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/myaccount'); ?>">
                    <i class="fas fa-fw fa-user-edit"></i>
                    <span>Edit Profile</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar --> 
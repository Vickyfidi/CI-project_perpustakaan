        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark" style="background-color: #25bc1d;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="">SI-Pengelolaan E-book</a>

                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-circle fa-2x" style="color: #ffffff;"></i>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?= base_url('admin/profile') ?>" class="dropdown-item">
                            <i class="fa fa-user"></i> My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url() ?>login/keluar" class="dropdown-item">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
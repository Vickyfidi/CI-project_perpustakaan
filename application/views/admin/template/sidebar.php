   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
       <p class="brand-link">
           <img src="<?= base_url() ?>assets/dist/img/logoman.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
           <span class="brand-text font-weight-light">Darul Ilmi</span>
       </p>

       <!-- Sidebar -->
       <div class="sidebar">
           <!-- Sidebar user panel (optional) -->
           <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                   <img src="<?= base_url() ?>assets/dist/img/usercs2.jpg" class="img-circle elevation-2">
               </div>
               <div class="info">
                   <small class="d-block disabled text-white"><?= $this->session->userdata('nama'); ?>
                   </small>
                   <small class="text-danger">[<?= $this->session->userdata('level_pengguna'); ?>]</small>
               </div>
           </div>

           <!-- Sidebar Menu -->
           <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                   <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                   <li class="nav-item has-treeview mb-2">
                       <a href="<?= base_url(); ?>admin/dashboard" class="nav-link">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                               Dashboard

                           </p>
                       </a>
                   </li>
                   <li class="nav-item mb-2">
                       <a href="<?= base_url(); ?>admin/profile" class="nav-link">
                           <i class="fas fa-user nav-icon"></i>
                           <p>
                               My Profile
                           </p>
                       </a>
                   </li>
                   <li class="nav-item mb-2">
                       <a href=" <?= base_url('admin/data_user'); ?>" class="nav-link">
                           <i class="fas fa-users-cog nav-icon"></i>
                           <p>
                               Data User(Pengguna)
                           </p>
                       </a>
                   </li>

                   <li class="nav-item mb-2">
                       <a href=" <?= base_url('admin/siswa'); ?>" class="nav-link">
                           <i class="far fa-id-card nav-icon"></i>
                           <p>
                               Data Anggota
                           </p>
                       </a>
                   </li>

                   <li class="nav-item has-treeview mb-2">
                       <a href=" #" class="nav-link">
                           <i class="fas fa-user-tie nav-icon"></i>
                           <p>
                               Data Staf/Pegawai
                               <i class="fas fa-angle-left right"></i>
                           </p>
                       </a>
                       <ul class="nav nav-treeview">

                           <li class="nav-item">
                               <a href="<?= base_url('admin/jabatan'); ?>" class="nav-link">
                                   <i class="fa fa-sitemap nav-icon"></i>
                                   <p>Jabatan</p>
                               </a>
                           </li>
                           <li class="nav-item">
                               <a href="<?= base_url('admin/pegawai'); ?>" class="nav-link">
                                   <i class="fas fa-user-tie nav-icon"></i>
                                   <p>Pegawai/Staf</p>
                               </a>
                           </li>
                       </ul>
                   </li>


                   <li class="nav-item has-treeview mb-2">
                       <a href=" #" class="nav-link">
                           <i class="fas fa-folder-open nav-icon"></i>
                           <p>
                               Data Buku/E-book
                               <i class="fas fa-angle-left right"></i>
                           </p>
                       </a>
                       <p>
                       <h1>
                           <a href=""></a>
                       </h1>
                       </p>
                       <ul class="nav nav-treeview">

                           <li class="nav-item mb-2">
                               <a href=" <?= base_url('admin/kategori_buku'); ?>" class="nav-link">
                                   <i class="fas fa-tags nav-icon"></i>
                                   <p>Kategori Buku</p>
                               </a>
                           </li>
                           <li class="nav-item mb-2">
                               <a href=" <?= base_url('admin/buku'); ?>" class="nav-link">
                                   <i class="fas fa-book nav-icon"></i>
                                   <p>E-Book</p>
                               </a>
                           </li>
                       </ul>
                   </li>
               </ul>
           </nav>
           <!-- /.sidebar-menu -->
       </div>
       <!-- /.sidebar -->
   </aside>
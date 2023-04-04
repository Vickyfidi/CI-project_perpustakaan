   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
       <!-- Brand Logo -->
       <p class="brand-link">
           <img src="<?= base_url() ?>assets/dist/img/logoman.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
           <span class="brand-text font-weight-light">Darul Ilmi</span>
       </p>

       <!-- Sidebar -->
       <div class="sidebar">
           <!-- Sidebar user panel (optional) -->
           <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                   <img src="<?= base_url() ?>assets/dist/img/usercs2.jpg" class="img-circle" alt="User Image">
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
                   <li class="nav-item has-treeview mb-1">
                       <a href="<?= base_url(); ?>petugas/dashboard" class="nav-link">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                               Dashboard

                           </p>
                       </a>
                   </li>

                   <li class="nav-item mb-1">
                       <a href="<?= base_url(); ?>petugas/profile" class="nav-link">
                           <i class="fas fa-user nav-icon"></i>
                           <p>
                               My Profile
                           </p>
                       </a>
                   </li>

                   <li class="nav-item mb-1">
                       <a href="<?= base_url('petugas/siswa'); ?>" class="nav-link">
                           <i class="far fa-id-card nav-icon"></i>
                           <p>
                               Data Anggota
                           </p>
                       </a>
                   </li>

                   <li class="nav-item has-treeview mb-1">
                       <a href="#" class="nav-link">
                           <i class="fas fa-folder-open nav-icon"></i>
                           <p>
                               Data Buku/E-book
                               <i class="fas fa-angle-left right"></i>
                           </p>
                       </a>
                       <ul class="nav nav-treeview">

                           <li class="nav-item">
                               <a href="<?= base_url('petugas/kategori_buku'); ?>" class="nav-link">
                                   <i class="fas fa-tags nav-icon"></i>
                                   <p>Kategori Buku/E-book</p>
                               </a>
                           </li>
                           <li class="nav-item">
                               <a href="<?= base_url('petugas/buku'); ?>" class="nav-link">
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
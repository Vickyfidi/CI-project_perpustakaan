<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="<?= base_url('assets/dist/img/logoman.png') ?>">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>assets/plugins/bootstrap-4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/bootstrap-4.6.2/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/dist/css/carousel-blog.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <title><?php echo $judul; ?></title>

    <style>
        .card-header {
            height: 200px;
            overflow: hidden;
            position: relative;
            background-color: #ffffff;
        }
    </style>

</head>

<body>
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark pb-3 pt-3" id="back-to-top" style="background-color: #a2f2ad;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('perpustakaan') ?>">
                <img src="<?= base_url('assets/dist/img/logoman.png') ?>" width="55" height="55" class="d-inline-block align-top">
                <h3 class="text-center d-inline-block align-top pt-3" style="color: #003c00;">Perpustakaan Darul Ilmi</h3>
            </a>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark" id="back-to-top" style="background-color: #404040;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= base_url('perpustakaan') ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= base_url('perpustakaan'); ?>#About">Profil Perpustakaan</a>
                            <a class="dropdown-item" href="<?= base_url('perpustakaan'); ?>#visimisi">Visi Misi</a>
                            <a class="dropdown-item" href="<?= base_url('perpustakaan'); ?>#kontak">Kontak</a>
                            <a class="dropdown-item" href="<?= base_url('perpustakaan/staf_perpustakaan'); ?>">Staf/pegawai perpustakaan</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Koleksi
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= base_url('perpustakaan/ebook'); ?>">E-book</a>
                            <a class="dropdown-item" href="#">#</a>
                            <a class="dropdown-item" href="#">#</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- navbar ends -->
    <!-- carousel start -->

    <div class="container mt-3 mb-3">
        <div class="card mb-5 shadow">
            <div class="card-body">
                <h1 class="text-center">Staf/Pegawai Perpustakaan</h1>
                <hr>
                <div class="row">
                    <?php foreach ($staff as $staf) : ?>
                        <div class="col-md-3 text-center mb-3">
                            <div class="mb-3">
                                <img src="<?php echo base_url() . './upload/foto/pegawai/' . $staf->foto ?>" class="card-img-top img-fluid rounded-circle border" style="width: 160px; height: 170px;">
                            </div>
                            <h5 class="mb-1"><?= $staf->nama; ?></h5>
                            <small class="text-info mt-1"><?= $staf->nama_jabatan; ?></small>

                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>



    </div><!-- /.container -->

    <!-- /.container -->

    <!-- footer -->
    <div class=" footer" style="background-color: #414141;">
        <div class="container">
            <div class="row">
                <div class="col-sm mb-3" id="kontak">
                    <p class="text-white mb-2">Kontak Kami</p>
                    <p class="text-white" style="font-size: smaller;"><i class="nav-icon fas fa-phone-alt"></i>&NonBreakingSpace;&NonBreakingSpace;12310000</p>
                    <p class="text-white" style="font-size: smaller;"><i class="nav-icon far fa-envelope"></i>&NonBreakingSpace;&NonBreakingSpace;email@gmail.com</p>
                </div>
                <div class="col-sm mb-3">
                    <p class="text-white mb-2">Follow us</p>
                    <p class="text-white" style="font-size: smaller;"><i class="nav-icon fab fa-facebook-f"></i>&NonBreakingSpace;&NonBreakingSpace;&NonBreakingSpace;&NonBreakingSpace;NamaFacebook.com</p>
                    <p class="text-white" style="font-size: smaller;"><i class="nav-icon fab fa-instagram"></i>&NonBreakingSpace;&NonBreakingSpace;&NonBreakingSpace;NamaInstagram.com</p>
                    <p class="text-white" style="font-size: smaller;"><i class="nav-icon fab fa-youtube"></i>&NonBreakingSpace;&NonBreakingSpace;NamaYoutube.com</p>
                </div>
                <div class="col-sm mb-3">
                    <p class="text-white mb-2">Perpustakaan Darul Ilmi</p>
                    <p class="text-white text-justify" style="font-size: smaller;"><i class="fas fa-map-marker-alt"></i>&NonBreakingSpace;Jl. Prof. Dr. Supomo. Sh, Mandingan, Ringinharjo, Kec. Bantul, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55712</p>
                </div>
            </div>
        </div>
        <hr style="background-color: white;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-white" style="font-size: smaller;">&copy; <?php echo date('Y'); ?> Copyright MAN 1 BANTUL </p>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="#back-to-top" class="text-white">Back to top</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js
"></script>




</body>

</html>
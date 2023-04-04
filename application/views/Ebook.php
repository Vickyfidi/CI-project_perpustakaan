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

    <!--<style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .button {
            background-color: #4CAF50;
            /* Hijau */
            border: none;
            color: white;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button1 {
            border-radius: 2px;
        }

        .button2 {
            border-radius: 4px;
        }

        .button3 {
            border-radius: 8px;
        }

        .button4 {
            border-radius: 30px;
        }

        .button5 {
            border-radius: 50%;
        }
    </style>-->
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

    <div class="container-fluid mt-3 mb-3">

        <div class="card mb-5 shadow">
            <div class="card-body">
                <h1 class="text-center">Koleksi E-Book</h1>
                <hr>
                <div class="row">
                    <div class="col">
                        <form id="form-filter" class="mb-2">
                            <div class="form-group">
                                <?php echo $form_kategori;
                                ?>
                            </div>
                            <button type="button" id="btn-filter" class="btn btn-primary btn-sm">Filter</button>
                            <button type="button" id="btn-reset" class="btn btn-secondary  btn-sm">Reset</button>
                        </form>

                        <div class="table-responsive">
                            <table id="table" class="display table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5px">No</th>
                                        <th>Judul</th>
                                        <th>Pengarang</th>
                                        <th>Kategori</th>
                                        <th>Sampul</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.container -->

    <!-- /.container -->

    <!-- footer -->
    <div class="footer" style="background-color: #414141;">
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

    <script type="text/javascript">
        var save_method;
        var table;
        var base_url = '<?php echo base_url(); ?>';
        $(document).ready(function() {

            table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo site_url('perpustakaan/ajax_list') ?>",
                    "type": "POST",
                    "data": function(data) {
                        data.nama_kategori = $('#nama_kategori').val();
                        data.judul = $('#judul').val();
                        data.pengarang = $('#pengarang').val();
                    }
                },
                "columnDefs": [{
                        "targets": [-1],
                        "orderable": false,
                    },
                    {
                        "targets": [-2], //2 last column (photo)
                        "orderable": false, //set not orderable
                    },

                ],
            })

            $('#btn-filter').click(function() { //button filter event click
                table.ajax.reload(); //just reload table
            });
            $('#btn-reset').click(function() { //button reset event click
                $('#form-filter')[0].reset();
                table.ajax.reload(); //just reload table
            });

            //set input/textarea/select event when change value, remove class error and remove text help block 
            $("input").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });

        });

        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
    </script>


</body>

</html>
<!DOCTYPE html>
<html>

<head>
  <link rel="shortcut icon" href="<?= base_url('assets/dist/img/logoman.png') ?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $judul ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- sweetalert2 -->
  <script src="<?= base_url(); ?>assets/plugins/sweetalert2-11.4.26/package/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2-11.4.26/package/dist/sweetalert2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>


<body class="hold-transition login-page" style="background:url(
	'<?php echo base_url('assets/dist/img/library.jpg'); ?>')no-repeat;background-size:cover;">
  <?php echo $this->session->flashdata('pesan'); ?>
  <div class="login-box mb-5">
    <div class="login-logo">

    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <div class="text-center">
          <img src="<?= base_url('assets/dist/img/logoman.png') ?>" width="100">
        </div>
        <p class="login-box-msg" style="font-weight: bold; font-size: 25px; color: #2d7100;"><b>Perpustakaan</b> Darul Ilmi</p>

        <form method="POST" action="<?= base_url(); ?>login/cek_login">
          <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username..." autocomplete="off">
          </div>
          <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password...">
          </div>

          <div class="row mb-3">
            <!-- /.col -->
            <div class="col">
              <button type="submit" class="btn btn-login btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
</body>

</html>
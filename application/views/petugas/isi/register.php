<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $judul; ?></title>
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
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- sweetalert2 -->
  <script src="<?= base_url(); ?>assets/plugins/sweetalert2-11.4.26/package/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2-11.4.26/package/dist/sweetalert2.min.css">
</head>

<body class="hold-transition register-page" style="background:url(
	'<?php echo base_url('assets/dist/img/library.jpg'); ?>')no-repeat;background-size:cover;">
  <div class="register-box">
    <div class="register-logo">
      <p style="font-weight: bold; font-size: 45px; color: #effbfc;"><b>SI-</b>Perpustakaan</p>
    </div>

    <div class="card mx-auto">
      <div class=" card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="" method="POST" id="form_register">
          <?php echo $this->session->flashdata('pesan'); ?>
          <div class="form-group has-validation mb-2">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama">
            <span class="help-block"></span>
          </div>

          <div class="form-group mb-3">
            <label for="username">username</label>
            <input type="text" class="form-control" id="username" name="username">
            <span class="help-block"></span>
          </div>
          <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <span class="help-block"></span>
          </div>
          <div class="form-group mb-3">
            <label for="password_ulang">Ketik ulang Password</label>
            <input type="password" class="form-control" id="password_ulang" name="password_ulang">
            <span class="help-block"></span>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col">
              <button type="button" class="btn btn-danger" id="#btnSave" onclick="daftar()">Daftar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <a href="<?= site_url('login'); ?>" class="text-center ml-4 pl-5">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("input").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
      });
    });

    function daftar() {
      $.ajax({
        url: "<?php echo site_url('admin/register/simpan_pendaftaran') ?>",
        type: "POST",
        data: $('#form_register').serialize(),
        dataType: "JSON",
        success: function(data) {

          if (data.status) {
            window.location = "<?= base_url('admin/data_user'); ?>";
          } else {
            for (var i = 0; i < data.inputerror.length; i++) {
              $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
              $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
            }
          }
          $('#btnSave').text('Daftar');
          $('#btnSave').attr('disabled', FALSE);


        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('data error, Error Login');
          $('#btnSave').text('Daftar');
          $('#btnSave').attr('disabled', FALSE);

        }
      });
    }
  </script>
</body>

</html>
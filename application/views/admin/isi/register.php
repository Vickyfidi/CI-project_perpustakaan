 <!-- SweetAlert2 -->
 <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2-11.4.26/package/dist/sweetalert2.min.css">
 <script src="<?= base_url(); ?>assets/plugins/sweetalert2-11.4.26/package/dist/sweetalert2.min.js"></script>
 <div class="card">
   <div class="card-header">
     <a class="btn btn-primary btn-sm" href="<?= base_url('admin/data_user') ?>" role="button"><i class="fas fa-arrow-left"></i></a>
     Tambah Data User(Pengguna)
   </div>
   <div class="card-body">
     <form action="" method="POST" id="form_register">
       <?php echo $this->session->flashdata('pesan'); ?>
       <div class="col form-group row">
         <label for="level_pengguna" class="col-sm-2 col-form-label">Level Pengguna</label>
         <div class="col-sm-10">
           <select class="form-control" name="level_pengguna" id="level_pengguna">
             <option selected disabled>--Pilih Level Pengguna--</option>
             <option value="Admin">Admin</option>
             <option value="Petugas">Petugas</option>
           </select>
           <small class="help-block text-danger "></small>
         </div>
       </div>
       <div class="col form-group row">
         <label for="nama" class="col-sm-2 col-form-label">Nama</label>
         <div class="col-sm-10">
           <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
           <small class="help-block text-danger "></small>
         </div>
       </div>
       <div class="col form-group row">
         <label for="username" class="col-sm-2 col-form-label">username</label>
         <div class="col-sm-10">
           <input type="text" class="form-control" id="username" name="username" autocomplete="off">
           <small class="help-block text-danger "></small>
         </div>
       </div>
       <div class="col form-group row">
         <label for="password" class="col-sm-2 col-form-label">Password</label>
         <div class="col-sm-10">
           <input type="password" class="form-control" id="password" name="password" autocomplete="off">
           <small class="help-block text-danger "></small>
         </div>
       </div>
       <div class="col form-group row">
         <label for="password_ulang" class="col-sm-2 col-form-label">Ulangi Password</label>
         <div class="col-sm-10">
           <input type="password" class="form-control" id="password_ulang" name="password_ulang" autocomplete="off">
           <small class="help-block text-danger "></small>
         </div>
       </div>
       <div class="col form-group row">

         <div class="col text-right">
           <a class="btn btn-secondary" href="<?= base_url('admin/register') ?>" role="button">Back</a>
           <button type="button" class="btn btn-primary" id="btnSave" onclick="daftar()">Daftar</button>
         </div>
       </div>
     </form>
   </div>
 </div>

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
       url: "<?php echo site_url('admin/register/simpan_pendaftaran/') ?>",
       type: "POST",
       data: $('#form_register').serialize(),
       dataType: "JSON",
       success: function(data) {

         if (data.status) {
           window.location = "<?= base_url('admin/register/'); ?>";
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
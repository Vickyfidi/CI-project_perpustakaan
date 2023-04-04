<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>assets/dist/img/usercs2.jpg" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $this->session->userdata('nama'); ?> </h3>

                <p class="text-muted text-center"><?= $this->session->userdata('level_pengguna'); ?> </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title"><?= $judul; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <h4 class="text-center font-weight-bold">Profil</h4>
                <form class="form-horizontal" action="#" id="form_profile">
                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm">
                            <input type="text" class="form-control" name="nama" value="<?= $profile->nama; ?>">
                            <small class="help-block text-danger "></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Username</label>
                        <div class="col-sm">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $profile->username; ?>">
                            <small class="help-block text-danger "></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm">
                            <div class="text-right">
                                <a href="<?= base_url('admin/profile'); ?>" type="button" class="btn btn-danger btn-sm">Kembali</a>
                                <button type="button" class="btn btn-primary btn-sm" id="btnSave" onclick="update_profil()">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <h4 class="text-center font-weight-bold">Update Password</h4><br>
                <form class="form-horizontals" action="#" id="form_update_password">
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm control-label">Password Lama</label>
                        <div class="col-sm">
                            <input type="password" class="form-control" placeholder="Password Lama" name="password">
                            <small class="help-block text-danger "></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm control-label">Password Baru</label>
                        <div class="col-sm">
                            <input type="password" class="form-control" placeholder="Ketikkan Password Baru" name="password_baru">
                            <small class="help-block text-danger "></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm control-label">Ulangi Password Baru</label>
                        <div class="col-sm">
                            <input type="password" class="form-control" placeholder="Ketik Ulang Password Baru" name="ketik_ulang_password_baru">
                            <small class="help-block text-danger "></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm">
                            <div class="text-right">
                                <a href="<?= base_url(); ?>mahasiswa" type="button" class="btn btn-danger btn-sm">Kembali</a>
                                <button type="button" class="btn btn-primary btn-sm" id="btnSave" onclick="reset_password()">Update Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datepicker/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript">
    function update_profil() {
        var data = new FormData($('#form_profile')[0]);
        $.ajax({
            url: "<?php echo site_url('petugas/profile/update_profil/') ?>",
            type: "POST",
            data: data,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    Swal.fire({
                        position: 'top-middle',
                        icon: 'success',
                        title: 'Profil berhasil di update',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('Update');
                $('#btnSave').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Update');
                $('#btnSave').attr('disabled', false);
            }
        });
    }


    function reset_password() {
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);

        $.ajax({
            url: "<?php echo site_url('petugas/profile/update_password') ?>",
            type: "POST",
            data: $('#form_update_password').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    Swal.fire({
                        position: 'top-middle',
                        icon: 'success',
                        title: 'Password berhasil di update',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('Ganti Password');
                $('#btnSave').attr('disabled', false);


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Ganti Password');
                $('#btnSave').attr('disabled', false);
            }
        });
    }
</script>
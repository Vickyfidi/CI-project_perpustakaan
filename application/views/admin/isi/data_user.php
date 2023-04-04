<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title"><?= $judul; ?></h3>
                <div class="text-right">
                    <a class="btn btn-info" href="<?= base_url('admin/register') ?>" role="button"><i class="fas fa-plus-circle"></i> Tambah User</a>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="table-responsive">
                    <table id="table" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>

        <!-- Modal Tambah Kategori -->
        <div class="modal fade" id="modal_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_form">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('register/registrasi'); ?>" id="form" method="POST">
                            <div class="form-group mb-3">
                                <label for="level_pengguna">Level Pengguna</label>
                                <select class="form-control" name="level_pengguna" id="level_pengguna">
                                    <option selected disabled>--Pilih Level Pengguna--</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Mahasiswa">Petugas</option>
                                </select>
                            </div>
                            <div class="form-group has-validation mb-2">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>">
                                <?php echo form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="form-group mb-3">
                                <label for="username">username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>">
                                <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password_ulang">Ketik ulang Password</label>
                                <input type="password" class="form-control" id="password_ulang" name="password_ulang">
                                <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                                <small class="form-text text-danger font-italic"></small>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<style>
    .swal2-popup {
        font-size: 10px;
    }
</style> -->
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2-11.4.26/package/dist/sweetalert2.min.css">
<script src="<?= base_url(); ?>assets/plugins/sweetalert2-11.4.26/package/dist/sweetalert2.min.js"></script>
<!-- /.card -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    var save_method;
    var table;
    $(document).ready(function() {

        table = $('#table').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('admin/data_user/ajax_list') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            }, ],
        });

    });

    function reload_table() {
        location.reload(true)
    }

    function delete_user(id) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus data tersebut?',
            text: "Data tidak bisa kembali setelah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Sekarang!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('admin/data_user/ajax_delete') ?>/" + id,
                    dataType: "JSON",
                    success: function(data) {
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
                Swal.fire(
                    'Hapus!',
                    'Data berhasil dihapus.',
                    'success'
                )
            }
        })
    }
</script>
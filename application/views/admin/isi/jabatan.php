<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Data <?= $judul; ?></h3>
                <div class="text-right">
                    <button class="btn btn-info swalDefaultSuccess" onclick="add_jabatan()"><i class="fas fa-plus-circle"></i> Tambah Jabatan</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
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

        <!-- Modal Tambah Jabatan -->
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
                        <form action="#" id="form">
                            <input type="hidden" value="" name="id_jabatan">
                            <div class="form-group">
                                <label for="nama_jabatan">Nama Jabatan</label>
                                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan">
                                <small class="help-block text-danger"></small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
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
                "url": "<?php echo site_url('admin/jabatan/ajax_list') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            }, ],
        });

    });

    function add_jabatan() {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Jabatan');
    }

    function reload_table() {
        location.reload(true)
    }

    function edit_jabatan(id_jabatan) {
        save_method = 'update';
        $('#form')[0].reset(); //reset form on modals
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('admin/jabatan/ajax_edit/') ?>/" + id_jabatan,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_jabatan"]').val(data.id_jabatan);
                $('[name="nama_jabatan"]').val(data.nama_jabatan);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_jabatan(id_jabatan) {
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
                    url: "<?= site_url('admin/jabatan/ajax_delete') ?>/" + id_jabatan,
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

    function save() {
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);
        var url;
        if (save_method == 'add') {
            url = "<?php echo site_url('admin/jabatan/ajax_add') ?>";
        } else {
            url = "<?php echo site_url('admin/jabatan/ajax_update') ?>";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('#modal_form').modal('hide');
                    reload_table();
                    Swal.fire({
                        position: 'top-middle',
                        icon: 'success',
                        title: 'Data telah tersimpan',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);
            }
        });
    }
</script>
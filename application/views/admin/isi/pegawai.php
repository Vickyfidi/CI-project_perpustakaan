<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title"><?= $judul; ?></h3>
                <div class="text-right">
                    <button class="btn btn-info" onclick="add_pegawai()"><i class="fas fa-plus-circle"></i> Tambah Data Pegawai</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th width="15%">Foto</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Tempat Lahir</th>
                                <th>Tgl Lahir</th>
                                <th>No Telp</th>
                                <th>Jabatan</th>
                                <th>Alamat</th>
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

        <!--<style>
    .swal2-popup {
        font-size: 10px;
    }
</style> -->
        <!-- /.card -->
        <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
        <!-- Datepicker -->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datepicker/jquery-ui/jquery-ui.css">
        <script src="<?= base_url(); ?>assets/plugins/datepicker/jquery-ui/jquery-ui.js"></script>
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
                        "url": "<?php echo site_url('admin/pegawai/ajax_list') ?>",
                        "type": "POST"
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

                $(".datepicker").datepicker({
                    dateFormat: "yy-mm-dd"
                });


            });

            function reload_table() {
                location.reload(true)
            }

            function add_pegawai() {
                save_method = 'add';
                $('#form')[0].reset();
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();
                $('#modal_form').modal('show');
                $('.modal-title').text('Tambah Data pegawai');
                $('#foto-preview').hide(); // hide photo preview modal

                $('#label-foto').text('Upload foto'); // label photo upload

            }

            function edit_pegawai(id) {
                save_method = 'update';
                $('#form')[0].reset(); //reset form on modals
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();

                $.ajax({
                    url: "<?php echo site_url('admin/pegawai/ajax_edit') ?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('[name="id"]').val(data.id);
                        $('[name="id_jabatan"]').val(data.id_jabatan);
                        $('[name="nama"]').val(data.nama);
                        $('[name="nip"]').val(data.nip);
                        $('[name="tmpt_lahir"]').val(data.tmpt_lahir);
                        $('[name="tgl_lahir"]').val(data.tgl_lahir);
                        $('[name="no_telp"]').val(data.no_telp);
                        $('[name="alamat"]').val(data.alamat);
                        $('#modal_form').modal('show');
                        $('.modal-title').text('Edit Data');

                        $('#foto-preview').show(); // show photo preview modal

                        if (data.foto) {
                            $('#label-foto').text('Change foto'); // label photo upload
                            $('#foto-preview div').html('<img src="' + base_url + './upload/foto/pegawai/' + data.foto + '" class="img-fluid" width="100">'); // show photo
                            $('#foto-preview div').append('<br><input type="checkbox" name="remove_foto" value="' + data.foto + '"/> Remove foto when saving'); // remove photo
                        } else {
                            $('#label-foto').text('Upload foto'); // label photo upload
                            $('#foto-preview div').text('(No foto)');
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error get data from ajax');
                    }
                });
            }

            function detail_pegawai(id) {
                save_method = 'update';
                $('#form')[0].reset(); //reset form on modals
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();

                $.ajax({
                    url: "<?php echo site_url('admin/pegawai/ajax_detail') ?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('[name="id"]').val(data.id);
                        $('[name="nip"]').val(data.nip);
                        $('[name="nama"]').val(data.nama);
                        $('[name="tmpt_lahir"]').val(data.tmpt_lahir);
                        $('[name="tgl_lahir"]').val(data.tgl_lahir);
                        $('[name="id_jabatan"]').val(data.id_jabatan);
                        $('[name="no_telp"]').val(data.no_telp);
                        $('[name="alamat"]').val(data.alamat);
                        $('#modal_detail').modal('show');
                        $('.modal-title').text('Detail Pegawai');
                        $('#foto-preview').show(); // show photo preview modal

                        $('#foto-preview div').html('<img src="' + base_url + './upload/foto/pegawai/' + data.foto + '" class="border border-primary" width="100">').val(data.foto); // show photo



                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error get data from ajax');
                    }
                });
            }


            function save() {
                $('#btnSave').text('saving...');
                $('#btnSave').attr('disabled', true);
                var url;
                if (save_method == 'add') {
                    url = "<?php echo site_url('admin/pegawai/ajax_add') ?>";
                } else {
                    url = "<?php echo site_url('admin/pegawai/ajax_update') ?>";
                }
                var formData = new FormData($('#form')[0]);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
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
                                timer: 1500

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

            function delete_pegawai(id) {
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
                            url: "<?= site_url('admin/pegawai/ajax_delete') ?>/" + id,
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

        <!-- Modal Tambah/Edit data pegawai -->
        <div class="modal fade" id="modal_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_form"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form" enctype="multipart/form-data">
                            <input type="hidden" value="" name="id">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                        <small class="help-block text-danger "></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nip">Nip</label>
                                        <input type="text" class="form-control" id="nip" name="nip">
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tmpt_lahir">Tempat lahir</label>
                                        <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir">
                                        <small class=" help-block text-danger"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" class="form-control datepicker" name="tgl_lahir" placeholder="yyyy-mm-dd">
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_telp">No Telp</label>
                                        <input type="text" class="form-control" id="no_telp" name="no_telp">
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="control-label">Jabatan</label>
                                        <select name="id_jabatan" class="custom-select">
                                            <option value="">--Pilih Jabatan--</option>
                                            <?php
                                            foreach ($getjabatan as $row) {
                                                echo '<option value="' . $row->id_jabatan . '">' . $row->nama_jabatan . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" rows="3" id="alamat" name="alamat"></textarea>
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group" id="foto-preview">
                                        <label class="control-label col-md-3">foto</label>
                                        <div class="col-md-9">
                                            (No foto)<span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" id="label-foto">Upload foto </label>
                                        <div class="col-md-9">
                                            <input name="foto" type="file"><span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Detail data pegawai -->
        <div class="modal fade" id="modal_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_form"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm">
                            <form action="#" id="form" enctype="multipart/form-data">
                                <input type="hidden" value="" name="id">
                                <tr>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <td><label for="nip" class="col-form-label">NIP</label></td>
                                            <td>
                                                <div class="col">
                                                    <input type="text" readonly class="form-control-plaintext" id="nip" name="nip" disabled>
                                                </div>
                                            </td>
                                        </div>
                                        <div class="col-md-3">
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <td><label for="nama" class="col-form-label">Nama</label></td>
                                        <td>
                                            <div class="col">
                                                <input type="text" readonly class="form-control-plaintext" id="nama" name="nama" disabled>
                                            </div>
                                        </td>
                                    </div>
                                </tr>

                                <tr>
                                    <div class="form-group">
                                        <td><label for="tmpt_lahir" class="col-form-label">Tempat Lahir</label></td>
                                        <td>
                                            <div class="col">
                                                <input type="text" readonly class="form-control-plaintext" id="tmpt_lahir" name="tmpt_lahir" disabled>
                                            </div>
                                        </td>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <td><label for="tgl_lahir" class="col-form-label">Tanggal Lahir</label></td>
                                        <td>
                                            <div class="col">
                                                <input type="text" readonly class="form-control-plaintext" id="tgl_lahir" name="tgl_lahir" disabled>
                                            </div>
                                        </td>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <td><label for="id_jabatan" class="col-form-label">Jabatan</label></td>
                                        <td>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select name="id_jabatan" readonly class="form-control-plaintext" disabled>
                                                        <?php
                                                        foreach ($getjabatan as $row) {
                                                            echo '<option value="' . $row->id_jabatan . '">' . $row->nama_jabatan . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <small class="help-block text-danger"></small>
                                                </div>
                                            </div>
                                        </td>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <td><label for="no_telp" class="col-form-label">No Telp</label></td>
                                        <td>
                                            <div class="col">
                                                <input type="text" readonly class="form-control-plaintext" id="no_telp" name="no_telp" disabled>
                                            </div>
                                        </td>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <td><label for="alamat" class="col-form-label">Alamat</label></td>
                                        <td>
                                            <div class="col">
                                                <textarea readonly class="form-control-plaintext" rows="3" id="alamat" name="alamat" disabled></textarea>
                                            </div>
                                        </td>
                                    </div>
                                </tr>
                                <div class="form-group" id="foto-preview">
                                    <div class="text-center">
                                    </div>
                                </div>

                            </form>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title"><?= $judul; ?></h3>
                <div class="text-right">
                    <button class="btn btn-info" onclick="add_siswa()"><i class="fas fa-plus-circle"></i> Tambah Data</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


                <div class="table-responsive">
                    <table id="table" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th width="10%">Foto</th>
                                <th>No Anggota</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Jk</th>
                                <th>Tempat Lahir</th>
                                <th>Tgl Lahir</th>
                                <th>No telp</th>
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
                        "url": "<?php echo site_url('petugas/siswa/ajax_list') ?>",
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
                    dateFormat: "d MM, yy"
                });


            });

            function reload_table() {
                location.reload(true)
            }

            function add_siswa() {
                save_method = 'add';
                $('#form')[0].reset();
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();
                $('#modal_form').modal('show');
                $('.modal-title').text('Tambah Data siswa');
                $('#foto-preview').hide(); // hide photo preview modal

                $('#label-foto').text('Upload foto'); // label photo upload

            }

            function edit_siswa(id) {
                save_method = 'update';
                $('#form')[0].reset(); //reset form on modals
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();

                $.ajax({
                    url: "<?php echo site_url('petugas/siswa/ajax_edit') ?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('[name="id"]').val(data.id);
                        $('[name="no_anggota"]').val(data.no_anggota);
                        $('[name="nama"]').val(data.nama);
                        $('[name="nis"]').val(data.nis);
                        $('[name="jk"]').val(data.jk);
                        $('[name="tmpt_lahir"]').val(data.tmpt_lahir);
                        $('[name="tgl_lahir"]').val(data.tgl_lahir);
                        $('[name="no_telp"]').val(data.no_telp);
                        $('[name="alamat"]').val(data.alamat);
                        $('#modal_form').modal('show');
                        $('.modal-title').text('Edit Data');

                        $('#foto-preview').show(); // show photo preview modal

                        if (data.foto) {
                            $('#label-foto').text('Change foto'); // label photo upload
                            $('#foto-preview div').html('<img src="' + base_url + './upload/foto/siswa/' + data.foto + '" class="img-fluid" width="100">'); // show photo
                            $('#foto-preview div').append('<input type="checkbox" name="remove_foto" value="' + data.foto + '"/> Remove foto when saving'); // remove photo
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


            function save() {
                $('#btnSave').text('saving...');
                $('#btnSave').attr('disabled', true);
                var url;
                if (save_method == 'add') {
                    url = "<?php echo site_url('petugas/siswa/ajax_add') ?>";
                } else {
                    url = "<?php echo site_url('petugas/siswa/ajax_update') ?>";
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

            function delete_siswa(id) {
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
                            url: "<?= site_url('petugas/siswa/ajax_delete') ?>/" + id,
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

        <!-- Modal Tambah/Edit data mhs -->
        <div class="modal fade" id="modal_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
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
                            <div class="form-group">
                                <label for="no_anggota">No Anggota</label>
                                <input type="text" class="form-control" id="no_anggota" name="no_anggota" value="<?= $no_anggota; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                                <small class="help-block text-danger font-italic"></small>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nim">Nis</label>
                                    <input type="text" class="form-control" id="nis" name="nis">
                                    <small class="help-block text-danger font-italic"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jk">Jenis Kelamin</label>
                                    <select name="jk" class="custom-select">
                                        <option value="">Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <small class="help-block text-danger font-italic"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tmpt_lahir">Tempat lahir</label>
                                    <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir">
                                    <small class=" help-block text-danger font-italic"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" class="form-control datepicker" name="tgl_lahir">
                                    <small class="help-block text-danger font-italic"></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No Telp</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp">
                                <small class="help-block text-danger font-italic"></small>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" rows="3" id="alamat" name="alamat"></textarea>
                                <small class="help-block text-danger font-italic"></small>
                            </div>
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
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
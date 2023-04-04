<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title"><?= $judul; ?></h3>
                <div class="text-right">
                    <button class="btn btn-info" onclick="add_buku()"><i class="fas fa-plus-circle"></i> Tambah Data</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


                <form id="form-filter">
                    <div class="row">
                        <div class="form-group">
                            <div class="col">
                                <?php echo $form_kategori;
                                ?>
                            </div>
                        </div>
                        <div class="col">
                            <button type="button" id="btn-filter" class="btn btn-primary btn-sm">Filter</button>
                            <button type="button" id="btn-reset" class="btn btn-secondary btn-sm">Reset</button>
                        </div>
                    </div>
                </form>


                <div class="table-responsive">

                    <table id="table" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Sampul</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>ISBN</th>
                                <th>Tahun</th>
                                <th>Kategori</th>
                                <th>File</th>
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
                        "url": "<?php echo site_url('admin/buku/ajax_list') ?>",
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

            function reload_table() {
                location.reload(true)
            }

            function add_buku() {
                save_method = 'add';
                $('#form')[0].reset();
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();
                $('#modal_form').modal('show');
                $('.modal-title').text('Tambah Data E-book');
                $('#foto-preview').hide(); // hide photo preview modal
                $('#berkas-preview').hide(); // hide photo preview modal

                $('#label-foto').text('Upload foto'); // label photo upload
                $('#label-berkas-file').text('Upload berkas file'); // label photo upload

            }

            function edit_buku(id) {
                save_method = 'update';
                $('#form')[0].reset(); //reset form on modals
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();

                $.ajax({
                    url: "<?php echo site_url('admin/buku/ajax_edit') ?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('[name="id"]').val(data.id);
                        $('[name="id_kategori"]').val(data.id_kategori);
                        $('[name="judul"]').val(data.judul);
                        $('[name="penerbit"]').val(data.penerbit);
                        $('[name="pengarang"]').val(data.pengarang);
                        $('[name="isbn"]').val(data.isbn);
                        $('[name="thn_buku"]').val(data.thn_buku);
                        $('#modal_form').modal('show');
                        $('.modal-title').text('Edit Data');

                        $('#foto-preview').show(); // show photo preview modal
                        $('#berkas-preview').show(); // show photo preview modal

                        if (data.foto) {
                            $('#label-foto').text('Change foto'); // label photo upload
                            $('#foto-preview div').html('<img src="' + base_url + './upload/foto/buku/' + data.foto + '" class="img-fluid" width="75">'); // show photo
                            $('#foto-preview div').append('<input type="checkbox" name="remove_foto" value="' + data.foto + '"/> Remove foto when saving'); // remove photo
                        } else {
                            $('#label-foto').text('Upload foto'); // label photo upload
                            $('#foto-preview div').text('(No foto)');
                        }
                        if (data.berkas_file) {
                            $('#label-berkas-file').text('Change berkas'); // label photo upload
                            $('#berkas-preview div').html(data.berkas_file); // show photo
                            $('#berkas-preview div').append('<input type="checkbox" name="remove_berkas" value="' + data.berkas_file + '"/> Remove foto when saving'); // remove photo
                        } else {
                            $('#label-berkas-file').text('Upload berkas'); // label photo upload
                            $('#berkas-preview div').text('(No berkas)');
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
                    url = "<?php echo site_url('admin/buku/ajax_add') ?>";
                } else {
                    url = "<?php echo site_url('admin/buku/ajax_update') ?>";
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

            function delete_buku(id) {
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
                            url: "<?= site_url('admin/buku/ajax_delete') ?>/" + id,
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

        <!-- Modal Tambah/Edit data buku -->
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
                                        <label for="judul">Judul</label>
                                        <textarea class="form-control" rows="3" id="judul" name="judul"></textarea>
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="penerbit">Penerbit</label>
                                        <textarea class="form-control" rows="3" id="penerbit" name="penerbit"></textarea>
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pengarang">Pengarang</label>
                                        <input type="text" class="form-control" id="pengarang" name="pengarang">
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="isbn">ISBN</label>
                                        <input type="text" class="form-control" id="isbn" name="isbn">
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="thn_buku">Tahun_buku</label>
                                        <input type="text" class="form-control" id="thn_buku" name="thn_buku">
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="control-label">Kategori Buku</label>
                                        <select name="id_kategori" class="custom-select">
                                            <option value="">--Pilih Kategori--</option>
                                            <?php
                                            foreach ($getkategori as $row) {
                                                echo '<option value="' . $row->id_kategori . '">' . $row->nama_kategori . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <small class="help-block text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group" id="foto-preview">
                                        <label class="control-label">foto</label>
                                        <div class="col-md-9">
                                            (No foto)<span class="help-block text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" id="label-foto">Upload foto </label>
                                        <div class="col-md-9">
                                            <input name="foto" class="form-control-file" type="file"><span class="help-block text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- upload berkas -->
                                    <div class="form-group" id="berkas-preview">
                                        <label class="control-label">Berkas File</label>
                                        <div class="col-md-9">
                                            (No Berkas)<small class="help-block text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" id="label-berkas-file">Upload File</label>
                                        <div class="col-md-9">
                                            <input name="berkas_file" class="form-control-file" type="file"><small class="help-block text-danger"></small>
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


        <!-- Modal Detal data siswa -->
        <div class="modal fade" id="modal_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
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
                                    <div class="form-group">
                                        <td><label for="no_anggota" class="col-form-label">No Anggota</label></td>
                                        <td>
                                            <div class="col">
                                                <input type="text" readonly class="form-control-plaintext" id="no_anggota" name="no_anggota" disabled>
                                            </div>
                                        </td>
                                    </div>
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
                                        <td><label for="nis" class="col-form-label">NIS</label></td>
                                        <td>
                                            <div class="col">
                                                <input type="text" readonly class="form-control-plaintext" id="nis" name="nis" disabled>
                                            </div>
                                        </td>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <td><label for="jk" class="col-form-label">Jenis Kelamin</label></td>
                                        <td>
                                            <div class="col">
                                                <input type="text" readonly class="form-control-plaintext" id="jk" name="jk" disabled>
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
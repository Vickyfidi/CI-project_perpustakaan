  <!-- jQuery -->
  <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

  <!-- Small boxes (Stat box) -->
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      Selamat Datang <strong><?= $this->session->userdata('nama'); ?></strong> anda Login sebagai <strong><?= $this->session->userdata('level_pengguna'); ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="row">

      <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
              <div class="inner">
                  <h3><?= $total_kategori; ?></h3>

                  <p>Kategori Buku</p>
              </div>
              <div class="icon">
                  <i class="fas fa-tags"></i>
              </div>
              <a href="<?= base_url('petugas/kategori_buku'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <!-- ./col -->

      <!-- ./col -->
      <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
              <div class="inner">
                  <h3><?= $total_siswa; ?></h3>

                  <p>Anggota Perpustakaan</p>
              </div>
              <div class="icon">
                  <i class="fas fa-users"></i>
              </div>
              <a href="<?= base_url('petugas/siswa'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
              <div class="inner">
                  <h3><?= $total_buku; ?></h3>

                  <p>Koleksi E-book</p>
              </div>
              <div class="icon">
                  <i class="fas fa-book"></i>
              </div>
              <a href="<?= base_url('petugas/buku'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <!-- ./col -->
  </div>

  <!-- /.row -->
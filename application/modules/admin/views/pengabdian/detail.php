<!-- Content Header (Page header) -->

<link rel="stylesheet" href="<?= base_url('public/plugins/ekko-lightbox/ekko-lightbox.css'); ?>">
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Pengabdian Masyarakat</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">pengabdian</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->

<?php
foreach ($detail_pengabdian->result_array() as $a) {
?>

  <section class="content">

    <?php if ($this->session->flashdata('msg') != '') { ?>
      <div class="alert alert-success flash-msg alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>Success!</h4>
        <?= $this->session->flashdata('msg'); ?>
      </div>
    <?php } ?>



    <div class="container-fluid">
      <div class="row">

        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-olive card-outline">
            <div class="card-body box-profile">
              <div class="text-center">

                <?php
                if ($a['photo'] == "") {
                ?>
                  <img class="img-circle" src="<?= base_url() ?>public/dist/img/nophoto.png" height="150" width="150">

                <?php
                } else {
                ?>
                  <img class="img-circle" src="<?php echo base_url(); ?><?= $a['photo']; ?>" height="150" width="150" />
                <?php
                }
                ?>
              </div>

              <p class="pt-2 text-center text-bold"><?= $a['nama_dosen']; ?></p>
              <p class="text-muted text-center"><?= $a['prodi']; ?></p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Pengunggah</b> <a class="float-right"><?= $a['nama_pengupload']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Tanggal</b> <a class="float-right"><?= indonesian_date($a['date']); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <a class="float-right btn btn-xs btn-default">
                    <?php
                    if ($a['file_akhir'] == "") {
                      if ($a['status'] == 0) {
                        echo "Baru";
                      } else {
                        echo "Proses";
                      }
                    } else {
                      echo "Selesai";
                    }
                    ?>
                  </a>
                </li>

              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-3">
              <h4><?= $a['judul_pengabdian']; ?></h4>
            </div><!-- /.card-header -->
          </div>
          <div class="card">
            <div class="card-header pl-3 pt-2 pb-2">
              Deskripsi
            </div><!-- /.card-header -->

            <div class="card-body">

              <?= $a['deskripsi']; ?>
            </div>
          </div>



          <div class="card">
            <div class="card-header pl-3 pt-2 pb-2">
              Dokumen
            </div><!-- /.card-header -->
            <div class="card-body">

              <table class="table table-bordered table-striped">
                <tr>
                  <th style="width:80%">Keterangan</th>
                  <th>Dokumen</th>
                </tr>
                <tr>
                  <td>Proposal</td>
                  <td>
										<?php
										if ($a['file'] == "") { 
											if ($this->session->userdata['is_admin'] == 2) { ?>
											<a href="<?php echo base_url('admin/pengabdian/tambah_dokumen/file/'. $a['id_pengabdian']); ?>" class="btn btn-info btn-sm"><i class="fa fa-upload"></i>
												Unggah</a>
										<?php } else { echo "Belum ada file"; }
										 } else {
										?>
											<a href="<?php echo base_url(); ?><?= $a['file']; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-download"></i> Unduh</a> 
										<?php if ($this->session->userdata['is_admin'] == 2) { ?>	
											<a title="Edit File Proposal" href="<?php echo base_url('admin/pengabdian/tambah_dokumen/file/'. $a['id_pengabdian']); ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>
										<?php }
										}
										?>
									</td>
                </tr>
                <tr>
                  <td>SK Pengabdian</td>
                  <td>
										<?php
										if ($a['file_sk'] == "") { 
											if ($this->session->userdata['is_admin'] == 2) { ?>
											<a href="<?php echo base_url('admin/pengabdian/tambah_dokumen/file_sk/'. $a['id_pengabdian']); ?>" class="btn btn-info btn-sm"><i class="fa fa-upload"></i>
												Unggah</a>
										<?php } else { echo "Belum ada file"; }
										 } else {
										?>
											<a href="<?php echo base_url(); ?><?= $a['file_sk']; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-download"></i> Unduh</a> 
										<?php if ($this->session->userdata['is_admin'] == 2) { ?>	
											<a title="Edit File Proposal" href="<?php echo base_url('admin/pengabdian/tambah_dokumen/file_sk/'. $a['id_pengabdian']); ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>
										<?php }
										}
										?>
									</td>
                </tr>
                <tr>
                  <td>Laporan pengabdian</td>
                  <td>
										<?php
										if ($a['file_akhir'] == "") { 
											if ($this->session->userdata['is_admin'] == 2) { ?>
											<a href="<?php echo base_url('admin/pengabdian/tambah_dokumen/file_akhir/'. $a['id_pengabdian']); ?>" class="btn btn-info btn-sm"><i class="fa fa-upload"></i>
												Unggah</a>
										<?php } else { echo "Belum ada file"; }
										 } else {
										?>
											<a href="<?php echo base_url(); ?><?= $a['file_akhir']; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-download"></i> Unduh</a> 
										<?php if ($this->session->userdata['is_admin'] == 2) { ?>	
											<a title="Edit File Proposal" href="<?php echo base_url('admin/pengabdian/tambah_dokumen/file_akhir/'. $a['id_pengabdian']); ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>
										<?php }
										}
										?>
									</td>
                </tr>
              </table>
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->

          <div class="card">
            <div class="card-header pl-3 pt-2 pb-2">
              Gambar
              <?php 
              if($this->session->userdata['is_admin'] == 2) {
              
              ?>
                <a class="btn btn-warning btn-sm float-right" href="<?php echo base_url(); ?>admin/pengabdian/tambah_kegiatan/<?= $a['id_pengabdian']; ?>"> <i class="fas fa-image"></i> Tambah/Edit Gambar</a>
              <?php
           
            } // endif is admin
              ?>
            </div><!-- /.card-header -->
            <div class="card-body">
              <?php
              foreach ($dokumentasi_kegiatan->result_array() as $d) {
              ?>

                <a href="<?php echo base_url(); ?><?= $d['photo']; ?>" data-toggle="lightbox" data-title="<?= $d['nama']; ?>" data-gallery="gallery">
                  <img width="200" src="<?php echo base_url(); ?><?= $d['photo']; ?>" class="img-thumbnail mb-2" />
                </a>

              <?php } ?>

              <!-- /.tab-pane -->
            <?php } ?>

            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <script src="<?= base_url('public/plugins/ekko-lightbox/ekko-lightbox.min.js'); ?>"></script>
  <script>
    $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
    })
    $("#pengabdian").addClass('menu-open');
  </script>
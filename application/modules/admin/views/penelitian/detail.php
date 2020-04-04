<!-- Content Header (Page header) -->

<link rel="stylesheet" href="<?= base_url('public/plugins/ekko-lightbox/ekko-lightbox.css'); ?>">
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Penelitian</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Penelitian</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->

<?php
foreach ($detail_penelitian->result_array() as $a) {
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

              <h3 class="profile-username text-center"><?= $a['nama_dosen']; ?></h3>
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

          <div class="card card-olive card-outline">
            <div class="card-header pl-3 pt-2 pb-2">
              Penilaian Reviewer
            </div>
            <div class="card-body" style="padding-top:0;">
              <?php echo form_open_multipart(base_url('admin/penelitian/update_penelitian'), '') ?>
              <input name="id_penelitian" type="hidden" value="<?= $a['id_penelitian']; ?>" />
              <input name="file_revisi_hidden" type="hidden" value="<?= $a['file_revisi']; ?>" />
              <input name="file_akhir_hidden" type="hidden" value="<?= $a['file_akhir']; ?>" />
              <input name="id_checklist_penilaian_hidden" type="hidden" value="<?= $a['id_checklist_penilaian']; ?>" />
              <input name="hasil_penilaian_hidden" type="hidden" value="<?= $a['hasil_penilaian']; ?>" />
              <input name="komentar_reviewer_hidden" type="hidden" value="<?= $a['komentar_reviewer']; ?>" />
              <br />

              <?php
              if ($this->session->userdata('is_admin') == 3 || $this->session->userdata('is_admin') == 1) {
                $checklist_penilaian = $this->db->query("select * from checklist_penilaian  ");
              ?>
                <strong>Kelengkapan Dokumen</strong><br />
                <?php
                $kks2 = explode(",", $a['id_checklist_penilaian']);
                foreach ($checklist_penilaian->result_array() as $b) {
                  if (in_array($b['id_checklist_penilaian'], $kks2)) {
                    $select = "checked";
                  } else {
                    $select = "";
                  }
                ?>
                  <input type="checkbox" name="id_checklist_penilaian[]" id="checkbox" value="<?= $b['id_checklist_penilaian']; ?>" <?= $select; ?> /> <?= $b['checklist_penilaian']; ?> <br />
                <?php
                }
                ?>
                <hr />

                <textarea name="komentar_reviewer" placeholder="Isi komentar..."><?= $a['komentar_reviewer']; ?></textarea>

                <strong>Penilaian</strong>
                <?php if ($a['hasil_penilaian'] == 0) {
                  echo "(Belum Dinilai)";
                } ?> <br />
                <input type="radio" name="hasil_penilaian" id="radio" value="1" <?php if ($a['hasil_penilaian'] == 1) {
                                                                                  echo "checked";
                                                                                } ?> required="required" />
                Layak<br />

                <input type="radio" name="hasil_penilaian" id="radio" value="2" <?php if ($a['hasil_penilaian'] == 2) {
                                                                                  echo "checked";
                                                                                } ?> required="required" /> Tidak
                Layak

                <div class="text-right"><button type="submit" class="btn btn-success">Update</button></div>

              <?php
              } else if ($this->session->userdata('is_admin') == 2) //staff
              {
                $checklist_penilaian_view = $this->db->query("select * from checklist_penilaian where id_checklist_penilaian in (" . $a['id_checklist_penilaian'] . ")  ");
              ?>
                <strong>Kelengkapan Dokumen</strong><br />
                <?php
                if ($checklist_penilaian_view->num_rows() == 0) {
                  echo "<font color=red><em>Belum Ada</em></font>";
                } else {
                  foreach ($checklist_penilaian_view->result_array() as $c) {
                    echo $c['checklist_penilaian'] . "<br />";
                  }
                } //end 	if($checklist_penilaian_view->num_rows()==0)

                ?>
                <hr />
                <strong>Komentar</strong> <br />
                <?php
                if ($a['komentar_reviewer'] == "") {
                  echo "<font color=red><em>Tidak Ada Komentar</em></font>";
                } else {
                  echo $a['komentar_reviewer'];
                }
                ?>
                <hr />
                <strong>Penilaian</strong> <?php
                                            if ($a['hasil_penilaian'] == 1) {
                                              echo "Layak";
                                            } elseif ($a['hasil_penilaian'] == 2) {
                                              echo "Tidak Layak";
                                            } else {
                                              echo "<font color=red><em>Tunggu Review</em></font>";
                                            }
                                            ?>


                <hr />
                <?php
                if ($a['hasil_penilaian'] == 1) {
                ?>
                  <strong>Upload Kegiatan</strong><br />
                  <a href="<?php echo base_url(); ?>admin/penelitian/tambah_kegiatan/<?= $a['id_penelitian']; ?>"> Tambah
                    Upload Kegiatan</a>
                  <hr />
                  <strong>Upload Laporan Akhir </strong><br />
                  <?php
                  if ($dokumentasi_kegiatan->num_rows() == 0) {
                    echo "<font color=red><em>Upload Kegiatan Dahulu</em></font>";
                  } else {
                  ?>
                    <input name="file_akhir" type="file">
                  <?php
                  }
                  ?>
                  <hr />
                <?php
                } elseif ($a['hasil_penilaian'] == 2) {
                ?>
                  <strong>Upload Revisi Penelitian </strong><br />
                  <input name="file_revisi" type="file">
                <?php
                }
                ?>

                <hr />
                <?php
                if (!$a['hasil_penilaian'] == 0) {
                ?>
                  <div class="text-right"><button type="submit" class="btn btn-success">Update</button></div>
                <?php
                }
                ?>
              <?php
              } else if ($this->session->userdata('is_admin') == 4) //Dosen
              {
              ?>
                <font color="red">Disini View Dosen Nilai....bla bla..</font>
              <?php
              }
              ?>
              </form>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-3">
              <h4><?= $a['judul_penelitian']; ?></h4>
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
                  <th style="width:85%">Keterangan</th>
                  <th>Dokumen</th>
                </tr>
                <tr>
                  <td>Proposal</td>
                  <td>
                    <?php
                    if ($a['file'] == "") {
                      echo "<font color=red>Belum Ada</font>";
                    } else {
                    ?>
                      <a href="<?php echo base_url(); ?><?= $a['file']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-download"></i> Unduh</a>
                    <?php
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Proposal Revisi</td>
                  <td>
                    <?php
                    if ($a['file_revisi'] == "") {
                      echo "<font color=red>Belum Ada</font>";
                    } else {
                    ?>
                      <a href="<?php echo base_url(); ?><?= $a['file_revisi']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-download"></i> Unduh</a>
                    <?php
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Laporan Penelitian</td>
                  <td>
                    <?php
                    if ($a['file_akhir'] == "") {
                      echo "<font color=red>Belum Ada</font>";
                    } else {
                    ?>
                      <a href="<?php echo base_url(); ?><?= $a['file_akhir']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-download"></i> Unduh</a>
                    <?php
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
              Dokumentasi Kegiatan
              <?php 
              if($this->session->userdata['is_admin'] == 2) {
              if ($a['hasil_penilaian'] == 1) {
              ?>
                <a class="btn btn-warning btn-sm float-right" href="<?php echo base_url(); ?>admin/penelitian/tambah_kegiatan/<?= $a['id_penelitian']; ?>"> <i class="fas fa-image"></i> Tambah/Edit Dokumentasi</a>
              <?php
              } //if($a['hasil_penilaian']==1)
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
  </script>
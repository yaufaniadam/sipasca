<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Publikasi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
          <li class="breadcrumb-item active">Tambah Penelitian</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <?php if (isset($msg) || validation_errors() !== '') : ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fas fa-exclamation-triangle"></i> Alert!</h4>
      <?= validation_errors(); ?>
      <?= isset($msg) ? $msg : ''; ?>
    </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('msg') != '') : ?>
    <div class="alert alert-success flash-msg alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>Success!</h4>
      <?= $this->session->flashdata('msg'); ?>
    </div>
  <?php endif; ?>
  
  <div class="row">
    <div class="col-md-6">
      <?php echo form_open_multipart(base_url('admin/publikasi/tambah'), '') ?>
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Informasi Umum</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="judul">Judul Publikasi</label>
            <input name="judul_publikasi" value="<?= (validation_errors()) ? set_value('judul_publikasi') : '' ?>" type="text" id="judul" class="form-control" required="required">
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi Singkat</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"><?=(validation_errors()) ? set_value('deskripsi'):''; ?></textarea>
          </div>
          <?php
          if ($this->session->userdata('is_admin') == 4) {
          ?>
            <input name="id_dosen" type="hidden" value="<?= $this->session->userdata('user_id'); ?>" />
          <?php
          } else {
          ?>
            <div class="form-group">
              <label for="deskripsi">Jenis Publikasi</label>
              <select name="id_jenis_publikasi" onchange='jenis_publikasi(this);' required class="form-control">
                <option value="">Pilih..</option>
                <?php
                $jenis_publikasi = $this->db->query("select * from jenis_publikasi  ");
                foreach ($jenis_publikasi->result_array() as $b) {
                ?>
                  <option value="<?= $b['id_jenis_publikasi']; ?>"><?= $b['jenis_publikasi']; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="deskripsi">Sub Jenis Publikasi</label>
              <div id="jeispub"> <select required class="form-control"></select> </div>
            </div>

            <div class="form-group">
              <label for="dosen">Dosen yang mengajukan</label>

              <select name="id_dosen" class="form-control" required>
                <option value="">Pilih...</option>
                <?php
                foreach ($dosen->result_array() as $a) {
                ?>
                  <option value="<?= $a['id']; ?>"><?= $a['firstname']; ?></option>

                <?php
                }
                ?>
              </select>
            </div>
          <?php
          }
          ?>
          <div class="form-group">
            <label>Tanggal Pelaksanaan</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input name="tgl_pelaksanaan" type="text" class="form-control float-right" id="tanggal" required="required">
            </div>
            <!-- /.input group -->
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

    <div class="col-md-6">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Dokumen</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="inputEstimatedBudget">Unggah Publikasi</label>
            <input name="file_publikasi" type="file" id="inputEstimatedBudget" class="form-control" required>
          </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-12">
      <a href="#" class="btn btn-secondary">Batal</a>
      <input type="submit" name="submit" value="Tambahkan Publikasi" class="btn btn-success float-right">
    </div>
    <?php echo form_close(); ?>
  </div>
</section>
<!-- /.content -->
<!-- page script -->
<script src="<?= base_url(); ?>public/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>public/plugins/daterangepicker/daterangepicker.js"></script>

<script>
  $(function() {
    $('#tanggal').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 2019,
      maxYear: parseInt(moment().format('YYYY'), 10)
    });
  });

  $("#publikasi").addClass('menu-open');
  $("#publikasi .tambahpublikasi a.nav-link").addClass('active');
</script>
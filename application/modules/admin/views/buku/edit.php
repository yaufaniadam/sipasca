<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Buku</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
          <li class="breadcrumb-item active">Edit Buku</li>
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
  <?php
  foreach ($edit_buku->result_array() as $b) {
  ?>

    <div class="row">
      <div class="col-md-6">
        <?php echo form_open_multipart(base_url('admin/buku/update'), '') ?>
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
              <label for="judul">Judul Buku</label>
              <input name="judul_buku" value="<?= $b['judul_buku']; ?>" type="text" id="judul" class="form-control" required="required">
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi Singkat</label>
              <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"><?= $b['deskripsi']; ?></textarea>
            </div>
            <?php
            if ($this->session->userdata('is_admin') == 4) {
            ?>
              <input name="id_dosen" type="hidden" value="<?= $this->session->userdata('user_id'); ?>" />
            <?php
            } else {
            ?>
              <div class="form-group">
                <label for="dosen">Dosen yang mengajukan</label>
                <select name="id_dosen" class="form-control" required>
                  <option value="">Pilih...</option>

                  <?php
                  foreach ($dosen->result_array() as $a) {
                    if ($a['id'] == $b['id_dosen']) {
                      $select = "selected";
                    } else {
                      $select = "";
                    }
                  ?>
                    <option value="<?= $a['id']; ?>" <?= $select; ?>><?= $a['firstname']; ?></option>

                  <?php
                  }
                  ?>
                </select>

              </div>

            <?php
            }
            ?>

            <div class="form-group">
              <label for="dosen">Kategori Buku</label>
              <br />
              <?php
              $kategori_buku = $this->db->query("select * from kategori_buku ");
              ?>

              <?php
              foreach ($kategori_buku->result_array() as $a) {
              ?>
                <input name="id_kategori_buku" type="radio" value="<?= $a['id_kategori_buku']; ?>" required="required" <?= ($a['id_kategori_buku'] == $b['kategori_buku'] ) ? 'checked="checked"' : ''; ?> />
                <?= $a['kategori_buku']; ?><br />

              <?php
              }
              ?>

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
              <label for="inputEstimatedBudget">Unggah Proposal</label>
              <input name="file_buku" type="file" id="inputEstimatedBudget" class="form-control">
              <input name="file_hidden" type="hidden" value="<?= $b['file']; ?>" />
              <input name="id_buku" type="hidden" value="<?= $b['id_buku']; ?>" />
            </div>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-12">
        <a href="<?= base_url('admin/buku/detail/'. $b['id_buku']); ?>" class="btn btn-secondary">Batal</a>
        <input type="submit" name="submit" value="Ubah Buku" class="btn btn-success float-right">
      </div>
      <?php echo form_close(); ?>
    </div>
  <?php
  }
  ?>

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

  $("#buku").addClass('menu-open');
  $("#buku .tambahbaru a.nav-link").addClass('active');
</script>
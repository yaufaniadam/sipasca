<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah/Edit Dokumen HAKI<a class="btn btn-warning btn-sm" href="<?= base_url('admin/haki/detail/' . $id_haki); ?>"><i class="fa fa-arrow-circle-left"></i> Kembali</a></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
          <li class="breadcrumb-item active">Tambah HAKI</li>
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

    <div class="col-md-12">
      <?php echo form_open_multipart(base_url('admin/haki/tambah_dokumen_proses'), '') ?>

      <input name="id_haki" type="hidden" value="<?= $id_haki; ?>" />
      <input name="kat" type="hidden" value="<?= $kat; ?>" />


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
            <label for="inputEstimatedBudget">File (jpg, jpeg, png, pdf)</label>
            <input name="file" type="file" id="inputEstimatedBudget" class="form-control" required="required">

          </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-12">
      <a href="<?= base_url('admin/haki/detail/' . $id_haki); ?>" class="btn btn-secondary">Batal</a>
      <input type="submit" name="submit" value="Simpan" class="btn btn-success float-right">
    </div>
    <?php echo form_close(); ?>
  </div>
  <br />
 
</section>
<!-- /.content -->

<!-- page script -->

<script src="<?= base_url(); ?>public/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>public/plugins/daterangepicker/daterangepicker.js"></script>


<div class="modal fade" id="confirm-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Perhatian</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutuo">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin ingin menghapus data ini?&hellip;</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <a class="btn btn-danger btn-ok">Hapus</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script type="text/javascript">
  $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });
</script>


<script>
  $(function() {
    $('#tanggal').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 2019,
      maxYear: parseInt(moment().format('YYYY'), 10)
    });
  });

  $("#haki").addClass('menu-open');
  $("#haki .tambahbaru a.nav-link").addClass('active');
</script>
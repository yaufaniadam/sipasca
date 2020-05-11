<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Tambah Buku</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
					<li class="breadcrumb-item active">Tambah Buku</li>
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
			<?php echo form_open_multipart(base_url('admin/buku/tambah'), '') ?>
			<div class="card card-secondary">
				<div class="card-header">
					<h3 class="card-title">Informasi Umum</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
							title="Collapse">
							<i class="fas fa-minus"></i></button>
					</div>
				</div>

				<div class="card-body">
					<div class="form-group">
						<label for="judul_buku">Judul Buku <span class="required">(Wajib diisi)</span></label>
						<input name="judul_buku" value="<?=(validation_errors()) ? set_value('judul_buku') :''; ?>" type="text" id="judul_buku" class="form-control" required="required">
					</div>

					<div class="form-group">
						<label for="deskripsi">Deskripsi Singkat <span class="required">(Wajib diisi)</span></label>
						<textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"><?=(validation_errors()) ? set_value('deskripsi') :''; ?></textarea>
					</div>

					<?php
          if ($this->session->userdata('is_admin') == 4) {
          ?>

					<input name="id_dosen" type="hidden" value="<?= $this->session->userdata('user_id'); ?>" />

					<?php
          } else {
          ?>
					<div class="form-group">
						<label for="dosen">Dosen yang mengajukan <span class="required">(Wajib diisi)</span></label>

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
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
							title="Collapse">
							<i class="fas fa-minus"></i></button>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="file_buku">Unggah Buku (PDF) <span class="required">(Wajib diisi)</span></label>
						<input name="file_buku" type="file" class="form-control" required
							value="<?=(validation_errors()) ? set_value('file_buku') :''; ?>">
					</div>

					<div class="form-group">
						<label for="id_kategori_buku">Kategori Buku <span class="required">(Wajib diisi)</span></label>
						<br />
						<?php
            $kategori_buku = $this->db->query("select * from kategori_buku ");
            ?>

						<?php
            foreach ($kategori_buku->result_array() as $a) {
            ?>
						<input name="id_kategori_buku" type="radio" value="<?= $a['id_kategori_buku']; ?>" required="required" />
						<?= $a['kategori_buku']; ?> &nbsp;&nbsp;

						<?php
            }
            ?>

					</div>
					<div class="form-group">
						<label for="isbn">Nomor ISBN <span class="required">(Opsional)</span></label>
						<input name="isbn" value="<?=(validation_errors()) ? set_value('isbn') :''; ?>" type="text" id="isbn"
							class="form-control" required="">
					</div>

					<div class="form-group">
						<label for="penerbit">Penerbit <span class="required">(Wajib diisi)</span></label>
						<input name="penerbit" value="<?=(validation_errors()) ? set_value('penerbit') :''; ?>" type="text"
							id="penerbit" class="form-control" required="required">
					</div>


				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<div class="col-md-12">
			<a href="#" class="btn btn-secondary">Batal</a>
			<input type="submit" name="submit" value="Tambahkan Buku" class="btn btn-success float-right">
		</div>
		<?php echo form_close(); ?>
	</div>


</section>
<!-- /.content -->

<!-- page script -->

<script src="<?= base_url(); ?>public/plugins/moment/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>


<script>
	$("#buku").addClass('menu-open');
	$("#buku .tambahbuku a.nav-link").addClass('active');

</script>

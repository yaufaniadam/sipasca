<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Prodi</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
					<li class="breadcrumb-item active">Edit prodi</li>
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

  ?>

	<div class="row">
		<div class="col-md-6">
			<?php echo form_open_multipart(base_url('admin/prodi/edit/'.$prodi['id_prodi']), '') ?>
			<div class="card card-secondary">

				<div class="card-body">
					<div class="form-group">
						<label for="prodi">Nama Prodi <span class="required">(Wajib diisi)</span></label>
						<input name="prodi" value="<?=(validation_errors()) ? set_value('prodi') :$prodi['prodi']; ?>"
							type="text" id="judul" class="form-control" required="required">
					</div>

					<div class="form-group">
						<label for="singkatan">Kode Prodi <span class="required">(Wajib diisi)</span></label>
						<input name="singkatan"
							value="<?=(validation_errors()) ? set_value('singkatan') :$prodi['singkatan']; ?>"
							type="text" id="singkatan" class="form-control" required="required">
					</div>

					<div class="form-group p-0 pt-0">
						<a href="<?= base_url('admin/prodi/index/'); ?>" class="btn btn-secondary">Batal</a>
						<input type="submit" name="submit" value="Ubah Buku" class="btn btn-success float-right">
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>

</section>
<!-- /.content -->

<script>
	$("#prodi").addClass('menu-open');

</script>

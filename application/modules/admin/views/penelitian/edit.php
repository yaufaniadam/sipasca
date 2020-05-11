<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Penelitian</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
					<li class="breadcrumb-item active">Edit Penelitian</li>
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
	foreach ($edit_penelitian->result_array() as $b) {
	?>

	<div class="row">

		<div class="col-md-6">
			<?php echo form_open_multipart(base_url('admin/penelitian/edit/'.$b['id_penelitian']), '') ?>
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
						<label for="judul">Judul Penelitian</label>
						<input name="judul_penelitian" value="<?= $b['judul_penelitian']; ?>" type="text" id="judul"
							class="form-control" required="required">
					</div>

					<div class="form-group">
						<label for="deskripsi">Deskripsi Singkat</label>
						<textarea name="deskripsi" id="deskripsi" class="form-control"
							rows="4"><?= $b['deskripsi']; ?></textarea>
					</div>

					<div class="form-group">
						<label for="lokasi">Lokasi Penelitian</label>
						<input name="lokasi" type="text" id="lokasi" class="form-control" value="<?= $b['lokasi']; ?>">
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
							<option value="<?= $a['id']; ?>" <?= $select; ?>> <?= $a['firstname']; ?></option>

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

							<?php
								$tgl_pelaksanaan = explode("-", $b['tgl_pelaksanaan']);
								$tgl_pelaksanaan = $tgl_pelaksanaan[1] . "/" . $tgl_pelaksanaan[0] . "/" . $tgl_pelaksanaan[2];

								?>

							<input name="tgl_pelaksanaan" value="<?= $tgl_pelaksanaan; ?>" type="text"
								class="form-control float-right" id="tanggal" required="required">
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
					<h3 class="card-title">Sumber Dana</h3>

					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
							title="Collapse">
							<i class="fas fa-minus"></i></button>
					</div>
				</div>

				<?php

					if (isset($b['sumber_dana'])) {

						$sumber_dana = explode(",", $b['sumber_dana']);
					}

					?>

				<div class="card-body">

					<div class="form-group">
						<label for="sumber_dana">Sumber dana</label><br>
						<input value="1" name="sumber_dana[]" type="checkbox" id="internal" data-toggle='collapse'
							data-target='.box_internal' <?php if (isset($sumber_dana[0]) && $sumber_dana[0] == 1) {
																																						echo "checked";
																																					} ?>> Internal &nbsp;
						&nbsp;
						<input value="2" name="sumber_dana[]" type="checkbox" id="eksternal" data-toggle='collapse'
							data-target='.box_external' <?php if (isset($sumber_dana[1]) && $sumber_dana[1] == 2) {
																																						echo "checked";
																																					} ?>> Eksternal
					</div>


					<label for="dana_internal">Nominal yang didanai oleh internal</label>
					<input name="dana_internal" type="text" id="dana_internal" class="form-control" placeholder="Rp."
						value="<?= $b['dana_internal']; ?>">

					<label for="dana_eksternal">Nominal yang didanai oleh eksternal</label>
					<input name="dana_eksternal" type="text" id="dana_eksternal" class="form-control" placeholder="Rp."
						value="<?= $b['dana_eksternal']; ?>">

					<label for="lembaga_eksternal">Nama lembaga eksternal yang mendanai</label>
					<input name="lembaga_eksternal" type="text" id="lembaga_eksternal" class="form-control"
						value="<?= $b['lembaga_eksternal']; ?>">


				</div>
			</div>

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
						<label for="">Unggah Proposal</label>
						<input name="file_penelitian" type="file" id="" class="form-control">
						<input name="file_hidden" type="hidden" value="<?= $b['file']; ?>"" class="form-control">
					</div>

				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->







		</div>
		<div class="col-md-12 p-30">
			<div class="form-group p-30">
				<a href="#" class="btn btn-secondary">Batal</a>
				<input type="submit" name="submit" value="Ubah Penelitian" class="btn btn-success float-right">
			</div>
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
	$(function () {
		$('#tanggal').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 2019,
			maxYear: parseInt(moment().format('YYYY'), 10)
		});
	});

	$("#penelitian").addClass('menu-open');
	$("#penelitian .tambahbaru a.nav-link").addClass('active');

</script>

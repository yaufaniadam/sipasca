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
							<img class="img-circle" src="<?= base_url() ?>public/dist/img/nophoto.png" height="150"
								width="150">

							<?php
								} else {
								?>
							<img class="img-circle" src="<?php echo base_url(); ?><?= $a['photo']; ?>" height="150"
								width="150" />
							<?php
								}
								?>
						</div>

						<p class="pt-3 text-center text-bold"><?= $a['nama_dosen']; ?></p>
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
											echo "Lengkapi Dokumen";
										} else {
											echo "Lengkapi Dokumen";
										}
									} else {
									echo "Dokumen Lengkap";
									}
									?>
								</a>
							</li>
							<li class="list-group-item">
								<b>Sumber Dana</b>
								<ul style="padding-left:20px;">
									<?php if($a['dana_internal'] !=='') { ?><li>Internal
										(Rp<?=number_format($a['dana_internal']); ?>) </li><?php } ?>
									<?php if($a['dana_eksternal'] !=='') { ?><li>Eksternal
										(Rp<?=number_format($a['dana_eksternal']); ?>) dari
										<?=$a['lembaga_eksternal']; ?></li><?php } ?>

								</ul>
							</li>

						</ul>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->

			</div>
			<!-- /.col -->
			<div class="col-md-9">
				<h4 class="h2 mb-3"><?= $a['judul_penelitian']; ?></h4>
				<div class="card">
					<div class="card-body">
						<?= $a['deskripsi']; ?>

						<table class="table table-bordered table-striped mt-4">
							<tr>
								<td style="width:80%;">Proposal Penelitian</td>
								<td>
									<?php
										if ($a['file'] == "") { 
											if ($this->session->userdata['is_admin'] == 2) { ?>
									<a href="<?php echo base_url('admin/penelitian/tambah_dokumen/file/'. $a['id_penelitian']); ?>"
										class="btn btn-info btn-sm"><i class="fa fa-upload"></i>
										Unggah</a>
									<?php } else { echo "Belum ada file"; }
										 } else {
										?>
									<a href="<?php echo base_url(); ?><?= $a['file']; ?>" class="btn btn-warning btn-sm"
										target="_blank"><i class="fa fa-download"></i> Unduh</a>
									<?php if ($this->session->userdata['is_admin'] == 2) { ?>
									<a title="Edit File Proposal"
										href="<?php echo base_url('admin/penelitian/tambah_dokumen/file/'. $a['id_penelitian']); ?>"
										class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>
										<?php }
										}
										?>
								</td>
							</tr>
							<tr>
								<td>SK Penelitian</td>
								<td>
									<?php
										if ($a['file_sk'] == "") { 
											if ($this->session->userdata['is_admin'] == 2) { ?>
									<a href="<?php echo base_url('admin/penelitian/tambah_dokumen/file_sk/'. $a['id_penelitian']); ?>"
										class="btn btn-info btn-sm"><i class="fa fa-upload"></i>
										Unggah</a>
									<?php } else { echo "Belum ada file"; } 
										} else {
										?>
									<a href="<?php echo base_url(); ?><?= $a['file_sk']; ?>"
										class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-download"></i>
										Unduh</a>
									<?php if ($this->session->userdata['is_admin'] == 2) { ?>
									<a title="Edit File SK Penelitian"
										href="<?php echo base_url('admin/penelitian/tambah_dokumen/file_sk/'. $a['id_penelitian']); ?>"
										class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>
										<?php }
										}
										?>
								</td>
							</tr>
							<tr>
								<td>Laporan Penelitian</td>
								<td>
									<?php
										if ($a['file_akhir'] == "") {
											if ($this->session->userdata['is_admin'] == 2) { ?>
									<a href="<?php echo base_url('admin/penelitian/tambah_dokumen/file_akhir/'. $a['id_penelitian']); ?>"
										class="btn btn-info btn-sm"><i class="fa fa-upload"></i>
										Unggah</a>
									<?php } else { echo "Belum ada file"; }
										
										} else {
										?>
									<a href="<?php echo base_url(); ?><?= $a['file_akhir']; ?>"
										class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-download"></i>
										Unduh</a>
									<?php if ($this->session->userdata['is_admin'] == 2) { ?>
									<a title="Edit File Laporan Akhir"
										href="<?php echo base_url('admin/penelitian/tambah_dokumen/file_akhir/'. $a['id_penelitian']); ?>"
										class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>
										<?php }
										}
										?>
								</td>
							</tr>
						</table>

					</div>
				</div>

				<div class="card">
					<div class="card-header pl-3 pt-2 pb-2">
						Gambar
						<?php
							if ($this->session->userdata['is_admin'] == 2) {

							?>
						<a class="btn btn-warning btn-sm float-right"
							href="<?php echo base_url(); ?>admin/penelitian/tambah_kegiatan/<?= $a['id_penelitian']; ?>">
							<i class="fas fa-image"></i> Tambah/Edit Gambar</a>
						<?php

							} // endif is admin
							?>
					</div><!-- /.card-header -->
					<div class="card-body">
						<?php
							foreach ($dokumentasi_kegiatan->result_array() as $d) {
							?>

						<a href="<?php echo base_url(); ?><?= $d['photo']; ?>" data-toggle="lightbox"
							data-title="<?= $d['nama']; ?>" data-gallery="gallery">
							<img width="200" src="<?php echo base_url(); ?><?= $d['photo']; ?>"
								class="img-thumbnail mb-2" />
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
	$(function () {
		$(document).on('click', '[data-toggle="lightbox"]', function (event) {
			event.preventDefault();
			$(this).ekkoLightbox({
				alwaysShowClose: true
			});
		});
	})
	$("#penelitian").addClass('menu-open');

</script>

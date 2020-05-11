<!-- Content Header (Page header) -->

<link rel="stylesheet" href="<?= base_url('public/plugins/ekko-lightbox/ekko-lightbox.css'); ?>">
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Buku</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Buku</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->

<?php
foreach ($detail_buku->result_array() as $a) {
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
									if ($a['file'] == "") {
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
								<b>ISBN </b> <a class="float-right">
									<?= ($isbn) ? $isbn : '-';?>
								</a>
								</li>	
								<li class="list-group-item">
									<b>Penerbit</b> <a class="float-right"><?= $a['penerbit']; ?></a>
								</li>
								
							</ul>

							

						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
					
				</div>
				<!-- /.col -->
				<div class="col-md-9">
					
					<h4 class="h2 mb-3"><?= $a['judul_buku']; ?></h4>
						
					<div class="card">
						
						<div class="card-body">

							<?= $a['deskripsi']; ?>
					

							<table class="table table-bordered table-striped mt-3">
								
								<tr>
									<td style="width:80%">Format Digital</td>
									<td>
										<?php
										if ($a['file'] == "") { 
											if ($this->session->userdata['is_admin'] == 2) { ?>
											<a href="<?php echo base_url('admin/buku/tambah_dokumen/file/'. $a['id_buku']); ?>" class="btn btn-info btn-sm"><i class="fa fa-upload"></i>
												Unggah</a>
										<?php } else { echo "Belum ada file"; }
										 } else {
										?>
											<a href="<?php echo base_url(); ?><?= $a['file']; ?>" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-download"></i> Unduh</a> 
										<?php if ($this->session->userdata['is_admin'] == 2) { ?>	
											<a title="Edit File Proposal" href="<?php echo base_url('admin/buku/tambah_dokumen/file/'. $a['id_buku']); ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>
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
							if ($this->session->userdata['is_admin'] == 2) {

							?>
								<a class="btn btn-warning btn-sm float-right" href="<?php echo base_url(); ?>admin/buku/tambah_kegiatan/<?= $a['id_buku']; ?>">
									<i class="fas fa-image"></i> Tambah/Edit Gambar</a>
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
		$("#buku").addClass('menu-open');
	</script>
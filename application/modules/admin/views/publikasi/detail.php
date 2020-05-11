<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Publikasi</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Publikasi</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->

<?php
foreach ($detail_publikasi->result_array() as $a) {
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
							<img class="img-circle" height="150" width="150"
								src="<?= base_url() ?>public/dist/img/nophoto.png">
							<?php
								} else {
								?>
							<img class="img-circle" src="<?php echo base_url(); ?><?= $a['photo']; ?>" height="150"
								width="150" />
							<?php
								}
								?>
						</div>
						<p class="text-center text-bold pt-3"><?= $a['nama_dosen']; ?></p>
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
										if ($a['link_publikasi'] == "") {
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
								<b>Jurnal</b>
								<a class="float-right btn btn-xs btn-default">
									<?php
									if ($a['jenis_publikasi'] == "") {
										echo "<font color=red><em>Belum Ada</em></font>";
									} else {
										echo $a['jenis_publikasi'];
									}
									?>
								</a>
							</li>
							<li class="list-group-item">
								<b>Kategori</b>
								<a class="float-right btn btn-xs btn-default">

									<?php

									if ($a['jenis_publikasi'] == "") {
										echo "<font color=red><em>Belum Ada</em></font>";
									} else {

										if ($a['sub_jenis_publikasi'] == "") {
											echo $a['sub_jenis_publikasi_text'];
										} else {
											echo $a['sub_jenis_publikasi'];
										}
									}
									?>
								</a>
							</li>
							<li class="list-group-item">
								<?php
									if ($a['link_publikasi'] == "") { ?>
								<a class="btn btn-success btn-lg btn-block disabled" target="_blank">Link Publikasi</a>
								<?php } else {
									?>
								<a href="<?= $a['link_publikasi']; ?>" class="btn btn-success  btn-block btn-lg"
									target="_blank">Link Publikasi</a>
								<?php
									}
									?>
							</li>
							<?php
									if ($this->session->userdata['is_admin'] == 2) {
								?>
							<li class="list-group-item">
								<span>Jika jurnal diterima, masukkan URL jurnal tersebut di bawah ini.</span>

								<?php echo form_open_multipart(base_url('admin/publikasi/update_publikasi'), '') ?>
								<input name="id_publikasi" type="hidden" value="<?= $a['id_publikasi']; ?>" />

								<input name="hasil_penilaian_hidden" type="hidden"
									value="<?= $a['hasil_penilaian']; ?>" />
								<input name="komentar_reviewer_hidden" type="hidden"
									value="<?= $a['komentar_reviewer']; ?>" />
								<input name="tgl_hasil_penilaian_hidden" type="hidden"
									value="<?= $a['tgl_hasil_penilaian']; ?>" />

								<input name="link_publikasi" type="url" class="form-control"
									value="<?= $a['link_publikasi']; ?>" placeholder="http://" />
								<button type="submit" class="btn btn-success mt-2">Update</button>

							</li>
							<?php } ?>

							</form>

					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->

			</div>
			<!-- /.col -->
			<div class="col-md-9">
				<h4 class="h2 mb-3"><?= $a['judul_publikasi']; ?></h4>
				<div class="card">

					<div class="card-body">
						<div class="tab-content">
							<div class="active tab-pane" id="activity">
								<?= $a['deskripsi']; ?>

								<table class="table table-bordered table-striped mt-3">

									<tr>
										<td style="width:80%">File Publikasi (PDF)</td>
										<td>

											<?php										
										if ($a['file'] == "") { 
											if ($this->session->userdata['is_admin'] == 2) {
											?>
											<a href="<?php echo base_url('admin/publikasi/tambah_dokumen/file/'. $a['id_publikasi']); ?>"
												class="btn btn-info btn-sm"><i class="fa fa-upload"></i>
												Unggah</a>
											<?php } else { echo "Belum ada File"; }
											} else {
										?>
											<a href="<?php echo base_url(); ?><?= $a['file']; ?>"
												class="btn btn-warning btn-sm" target="_blank"><i
													class="fa fa-download"></i> Unduh</a>

											<?php if ($this->session->userdata['is_admin'] == 2) { ?>

											<a title="Edit File Proposal"
												href="<?php echo base_url('admin/publikasi/tambah_dokumen/file/'. $a['id_publikasi']); ?>"
												class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>
											</a>

											<?php }										
										}
										
										?>
										</td>
									</tr>

									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header pl-3 pt-2 pb-2">
						Gambar
						<?php
							if ($this->session->userdata['is_admin'] == 2) {
								
							?>
						<a class="btn btn-warning btn-sm float-right"
							href="<?php echo base_url(); ?>admin/publikasi/tambah_kegiatan/<?= $a['id_publikasi']; ?>">
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
					</div>
					<br />

				</div>
				<?php
			}
				?>
			</div>
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

				$("#publikasi").addClass('menu-open');
				$("#publikasi .detailpublikasi a.nav-link").addClass('active');

			</script>
		</div>
		<!-- /.tab-content -->
	</div><!-- /.card-body -->
	</div>
	<!-- /.nav-tabs-custom -->
	</div>
	<!-- /.col -->
	</div>
	<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

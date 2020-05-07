<section class="content-header">
	<h1>Beranda</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-4 col-6">
			<!-- small box -->
			<div class="small-box bg-default">
				<div class="inner">
					<h3><?=$jumlah_penelitian->num_rows();?></h3>

					<p>Penelitian</p>
				</div>
				<div class="icon">
					<i class="fas fa-search"></i>
				</div>
				<a href="<?=base_url('admin/penelitian');?>" class="small-box-footer text-dark">Selengkapnya <i
						class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-4 col-6">
			<!-- small box -->
			<div class="small-box bg-default">
				<div class="inner">
					<h3><?=$jumlah_publikasi->num_rows();?></h3>

					<p>Publikasi</p>
				</div>
				<div class="icon">
					<i class="fab fa-readme"></i>
				</div>
				<a href="<?=base_url('admin/publikasi');?>" class="small-box-footer text-dark">Selengkapnya <i
						class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-4 col-6">
			<!-- small box -->
			<div class="small-box bg-default">
				<div class="inner">
					<h3><?=$jumlah_pengabdian->num_rows();?></h3>

					<p>Pengabdian Masyarakat</p>
				</div>
				<div class="icon">
					<i class="fas fa-hand-holding-heart"></i>
				</div>
				<a href="<?=base_url('admin/pengabdian');?>" class="small-box-footer text-dark">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-4 col-6">
			<!-- small box -->
			<div class="small-box bg-default">
				<div class="inner">
					<h3><?=$jumlah_haki->num_rows();?></h3>

					<p>Hak Kekayaan Intelektual</p>
				</div>
				<div class="icon">
					<i class="fas fa-shield-alt"></i>
				</div>
				<a href="<?=base_url('admin/haki');?>" class="small-box-footer text-dark">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
      </div>
		</div>
		<div class="col-lg-4 col-6">
			<!-- small box -->
			<div class="small-box bg-default">
				<div class="inner">
					<h3><?=$jumlah_buku->num_rows();?></h3>

					<p>Buku</p>
				</div>
				<div class="icon">
					<i class="fas fa-book"></i>
				</div>
				<a href="<?=base_url('admin/buku');?>" class="small-box-footer text-dark">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
			</div>

		</div>
		<!-- ./col -->

</section>
<!-- /.content -->

<script>
	$("#beranda a.nav-link").addClass('active');

</script>

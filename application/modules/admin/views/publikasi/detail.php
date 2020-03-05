<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Publikasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item active">Publikasi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <!-- Main content -->    
     
    <?php
      foreach($detail_publikasi->result_array() as $a) {
    ?>
     
    <section class="content">
    
      <?php if($this->session->flashdata('msg') != '') { ?>
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
                 if($a['photo']=="")
          				 {
          				?>
                               
                        <img src="<?= base_url() ?>public/dist/img/nophoto.png">   
                               
                          <?php
          				 }
          				 else
          				 {
          				?>
                               
                          <img src="<?php echo base_url();?><?=$a['photo'];?>"  height="200" width="200" />
                          <?php
          				}
          				?>
                 
                 
                  
                       
                       
                       
                       
                       
                       
                </div>

                <h3 class="profile-username text-center"><?=$a['nama_dosen'];?></h3>

                <p class="text-muted text-center"><?=$a['prodi'];?></p>

				

                <ul class="list-group list-group-unbordered mb-3">
                
                 <li class="list-group-item">
                    <b>Pengunggah</b> <a class="float-right"><?=$a['nama_pengupload'];?></a>
                  </li>
                  
                  <li class="list-group-item">
                    <b>Tanggal</b> <a class="float-right"><?=indonesian_date($a['date']);?></a>
                  </li>
                  
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right btn btn-xs btn-default">
                    
                     <?php
        					  if($a['link_publikasi']=="")
        					  {
        						  
        					  	if($a['status']==0)
        					  	{
        						  echo "Baru";
        					  	}
        					  	else
        					  	{
        						  echo "Proses";
        					  	}
        					  
        					  }
        					  else
        					  {
        						  echo "Selesai";
        					  }
        					  ?>
                    
                    
                    </a>
                  </li>
               
               
               
               
                
              
                
          <?php echo form_open_multipart(base_url('admin/publikasi/update_publikasi'), '' )?>
          <input name="id_publikasi" type="hidden" value="<?=$a['id_publikasi'];?>" />
          
          <input name="link_publikasi_hidden" type="hidden" value="<?=$a['link_publikasi'];?>" />
       
          <input name="hasil_penilaian_hidden" type="hidden" value="<?=$a['hasil_penilaian'];?>" />
          
          <input name="komentar_reviewer_hidden" type="hidden" value="<?=$a['komentar_reviewer'];?>" />
          
          <input name="tgl_hasil_penilaian_hidden" type="hidden" value="<?=$a['tgl_hasil_penilaian'];?>" />

 		<!--<input name="id_jenis_publikasi_hidden" type="hidden" value="<?=$a['id_jenis_publikasi'];?>" />
 		<input name="id_sub_jenis_publikasi_hidden" type="hidden" value="<?=$a['id_sub_jenis_publikasi'];?>" />
 		<input name="sub_jenis_publikasi_text_hidden" type="hidden" value="<?=$a['sub_jenis_publikasi_text'];?>" />-->
        

          
          <br />      
             
          <?php   
   
   if($this->session->userdata('is_admin')==3||$this->session->userdata('is_admin')==1)
   {     
    ?>         
  
  <strong>Jenis Publikasi</strong><br />
   <?php
   if($a['jenis_publikasi']=="")
    {
	echo "<font color=red><em>Belum Ada</em></font>";
	}
	else
	{
	echo $a['jenis_publikasi'];
	}
   ?>
   <br />
   <br />
   
  <strong>Sub Jenis Publikasi</strong><br />
	 <?php
	 
	 if($a['jenis_publikasi']=="")
	 {
	echo "<font color=red><em>Belum Ada</em></font>";
	 }
	 else
	 {
		 
		 
	 if($a['sub_jenis_publikasi']=="")
    {
	echo $a['sub_jenis_publikasi_text'];
	}
	else
	{
	echo $a['sub_jenis_publikasi'];
	}
	
	 }
   ?>    
    
    <hr />
    <strong>Komentar</strong><br>

    <textarea name="komentar_reviewer" placeholder="Isi komentar..."><?=$a['komentar_reviewer'];?></textarea>
   <hr /> 
    <strong>Penilaian</strong>  
     <br />
    <?php
	if($a['hasil_penilaian']==1)
	{
	  echo "Diterima";
	}
	elseif($a['hasil_penilaian']==2)
	{
	echo "Tidak diterima";
	}
	else
	{
	echo "<font color=red><em>Tunggu Penilaian</em></font>";
	}
	?>
    
    
    
    <br />
    <br />
    
    <strong>Tanggal diterima/ditolak</strong><br>
     <?php
	 
	if($a['tgl_hasil_penilaian']=="")
	{
	echo "<font color=red><em>Belum Ada</em></font>";
	}
	else
	{ 
   	echo $a['tgl_hasil_penilaian'];
	}
	?>
    <hr />
 <div class="text-right"><button type="submit" class="btn btn-success">Update</button></div> 
 
 
 
 <?php
  }
 else if($this->session->userdata('is_admin')==2) //staff
   {
	
	   
  ?>
  
  
  <strong>Jenis Publikasi</strong><br />
   <?php
   if($a['jenis_publikasi']=="")
    {
	echo "<font color=red><em>Belum Ada</em></font>";
	}
	else
	{
	echo $a['jenis_publikasi'];
	}
   ?>
   <br />
   <br />
   
  <strong>Sub Jenis Publikasi</strong><br />
	 <?php
	 
	 if($a['jenis_publikasi']=="")
	 {
	echo "<font color=red><em>Belum Ada</em></font>";
	 }
	 else
	 {
	 if($a['sub_jenis_publikasi']=="")
    {
	echo $a['sub_jenis_publikasi_text'];
	}
	else
	{
	echo $a['sub_jenis_publikasi'];
	}
	 }
   ?>     	
    
    
    
    
    <hr />
  
  
  
    <strong>Komentar</strong> <br />
    <?php
    if($a['komentar_reviewer']=="")
	{
	echo "<font color=red><em>Tidak Ada Komen</em></font>";
	}
	else
	{
	echo $a['komentar_reviewer'];
	}
	?>
    
    
  <hr />
  
  
  
    <strong>Penilaian</strong>  
    
    
   
   
     <?php if($a['hasil_penilaian']==0)  { echo "(Belum Dinilai)"; }?>       <br />
     
      <input type="radio" name="hasil_penilaian" id="radio" value="1" <?php if($a['hasil_penilaian']==1)  { echo "checked"; }?> required="required"/> Diterima<br />
    
    <input type="radio" name="hasil_penilaian" id="radio" value="2" <?php if($a['hasil_penilaian']==2)  { echo "checked"; }?> required="required"/> Tidak Diterima  
   
   
   <br /> <br /> 
   
   <?php
   /*	$tgl_hasil_penilaian=explode("-", $a['tgl_hasil_penilaian']);
	$tgl_hasil_penilaian=$tgl_hasil_penilaian[1]."/".$tgl_hasil_penilaian[2]."/".$tgl_hasil_penilaian[0];
	
	echo $tgl_hasil_penilaian;*/
	?>
   
  <strong>Tanggal diterima/ditolak</strong>
  
   <input name="tgl_hasil_penilaian" type="text"  id="tanggal" value="<?=$a['tgl_hasil_penilaian'];?>"> 
   
   
  <br />    
 
        <hr />
        
        
   <?php
	if($a['hasil_penilaian']==1)
	{
	?>
    <strong>Upload Kegiatan</strong><br />
 <a href="<?php echo base_url();?>admin/publikasi/tambah_kegiatan/<?=$a['id_publikasi'];?>"> Tambah Upload Kegiatan</a>
    <hr />
    
    
    
    
    
    
     <strong>Link Publikasi </strong><br />
    <?php
	if($dokumentasi_kegiatan->num_rows()==0)
	{
	echo "<font color=red><em>Upload Kegiatan Dahulu</em></font>";
	}
	else
	{
	?>
    
    <input name="link_publikasi" type="text" value="<?=$a['link_publikasi'];?>" />
   
    <?php
	}
	?>
    
    
    
   
     <hr />
    <?php
	}
	elseif($a['hasil_penilaian']==2)
	{
	?>   
    
    
    
<!--   
     <strong>Upload Revisi Penelitian </strong><br />
       <input name="file_revisi" type="file">
       
       
       
    <hr />
      
-->	

<?php
	}
	?>
   
   
   
   
   
   
    
    
         <div class="text-right"><button type="submit" class="btn btn-success">Update</button></div> 
	

  <?php
   }
   else if($this->session->userdata('is_admin')==4) //Dosen
   {
  ?>
	 <font color="red">Disini View Dosen  Nilai....bla bla..</font>
  <?php	   
   }
   ?>
                
               
			</form>
        
        
  </ul>       
            
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

			

          
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-3">
                <h4><?=$a['judul_publikasi'];?></h4>
              </div><!-- /.card-header -->
            </div>
            <div class="card">
              <div class="card-header p-3">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Keterangan</a></li>
                  <!--<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Linimasa</a></li>-->
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                   <?=$a['deskripsi'];?>
                    <hr>
                    
                    <h2>Dokumen</h2>
                    
                    
                    Proposal Awal
                    <br />
                    <?php
					if($a['file']=="")
					{
						echo "<font color=red>Belum Ada</font>";
					}
					else
					{
					?>
                    <a href="<?php echo base_url();?><?=$a['file'];?>" class="btn btn-warning">Unduh</a>
                    <?php
					}
					?>
                    <hr />
                    
                  
                    
                    Link Publikasi
                    <br />
                    <?php
					if($a['link_publikasi']=="")
					{
						echo "<font color=red>Belum Ada</font>";
					}
					else
					{
					?>
						
                    <a href="<?=$a['link_publikasi'];?>" class="btn btn-warning" target="_blank">Link</a>
                        
                    <?php
					}
                    ?>
                    
                   <hr>
                    
                    <h2>Photo Kegiatan
                    
                   
                    </h2>  
                    
                    
                    
					 <?php
					foreach($dokumentasi_kegiatan->result_array() as $d)    
					{
					?>
                    <img src="<?php echo base_url();?><?=$d['photo'];?>"  height="100" width="100" />
                  
					<?php
					}
                    ?>
                    
                      <?php
					if($a['hasil_penilaian']==1)
					{
					?>
 					<a href="<?php echo base_url();?>admin/publikasi/tambah_kegiatan/<?=$a['id_publikasi'];?>"> Edit Kegiatan</a>
                    <?php
					}//if($a['hasil_penilaian']==1)
                    ?>
                    
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Januari 2019
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      
              
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">                         
                          <h3 class="timeline-header">Direview Tahap 1</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">Lihat hasil review</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Januari 2019
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-plus bg-olive"></i>

                        <div class="timeline-item">                          
                          <h3 class="timeline-header">Publikasi ditambahkan</h3>                         
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

	<?php
	}
	
	 ?>
     
     
<script src="<?=base_url();?>public/plugins/moment/moment.min.js"></script>
<script src="<?=base_url();?>public/plugins/daterangepicker/daterangepicker.js"></script>

<script>

  $(function() {
  $('#tanggal').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 2019,
    maxYear: parseInt(moment().format('YYYY'),10)
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
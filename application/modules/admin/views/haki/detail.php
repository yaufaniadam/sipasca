<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Haki</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Haki</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <!-- Main content -->    
     
    <?php
      foreach($detail_haki->result_array() as $a) {
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
                 
               
               
               
               
                
              
                
          <?php echo form_open_multipart(base_url('admin/haki/update_haki'), '' )?>
          <input name="id_haki" type="hidden" value="<?=$a['id_haki'];?>" />
        	
          
          
          
          <br />      
             
          <?php   
   if($this->session->userdata('is_admin')==2) //staff
   {
	
	
	   
  ?>
  
  
  
  
   <strong>Kategori Haki</strong><br />
	<?=$a['kategori_haki'];?>
   
  
  
  <!--
   <strong>Upload Kegiatan</strong><br />
 <a href="<?php echo base_url();?>admin/haki/tambah_kegiatan/<?=$a['id_haki'];?>"> Tambah Upload Kegiatan</a>
    <hr /> -->    
        
 
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
                <h4><?=$a['judul_haki'];?></h4>
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
                    
                    
 					<a href="<?php echo base_url();?>admin/haki/tambah_kegiatan/<?=$a['id_haki'];?>"> Edit Kegiatan/Tambah Kegiatan</a>
                    
                    
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
                          <h3 class="timeline-header">Haki ditambahkan</h3>                         
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
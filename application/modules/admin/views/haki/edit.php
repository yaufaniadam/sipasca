
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Haki</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin');?>">Home</a></li>
              <li class="breadcrumb-item active">Edit Haki</li>
            </ol>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
    <section class="content">
    
    

      <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fas fa-exclamation-triangle"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>

      <?php if($this->session->flashdata('msg') != ''): ?>
            <div class="alert alert-success flash-msg alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4>Success!</h4>
              <?= $this->session->flashdata('msg'); ?> 
            </div>
          <?php endif; ?>

	<?php
		foreach($edit_haki->result_array() as $b){
	?>

      <div class="row">
        
        <div class="col-md-6">
          <?php echo form_open_multipart(base_url('admin/haki/update'), '' )?>
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Informasi Umum</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

            <div class="card-body">
              <div class="form-group">
                <label for="judul">Judul Haki</label>
                <input name="judul_haki" value="<?=$b['judul_haki']; ?>" type="text" id="judul" class="form-control" required="required">
              </div>

              <div class="form-group">
                <label for="deskripsi">Deskripsi Singkat</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"><?=$b['deskripsi']; ?></textarea>
              </div>

              



  			<?php
			if($this->session->userdata('is_admin')==4)
			{	
			?>
            
            <input name="id_dosen" type="hidden" value="<?=$this->session->userdata('user_id');?>" />
            
            <?php
			}
			else
			{
			?>



              <div class="form-group">
                <label for="dosen">Dosen yang mengajukan</label>
                
                
          
            
              
                <select name="id_dosen" class="form-control" required>
                <option value="">Pilih...</option>
                
            	<?php
					foreach($dosen->result_array() as $a)    
					{
						if($a['id']==$b['id_dosen']){$select="selected";}else{$select="";}
					?>
             <option value="<?=$a['id'];?>"  <?=$select;?>><?=$a['firstname'];?></option>
                  
					<?php
					}
                    ?>     

                
                </select>
                
              </div>
              
           	<?php
            }
			?>    
                
   
           
  			<div class="form-group">
                <label for="dosen">Kategori Haki</label>
                <br />
                
          
            
               <?php
						$kategori_haki= $this->db->query("select * from kategori_haki ");
        			?>
                  
					<?php
					foreach($kategori_haki->result_array() as $a)    
					{
						if($a['id_kategori_haki']==$b['id_kategori_haki']){$same="checked";}else{$same="";}
					?>                            
						<input name="id_kategori_haki" type="radio" value="<?=$a['id_kategori_haki'];?>" required="required" <?=$same;?> /> <?=$a['kategori_haki'];?><br />
                        
					<?php
                    }
                    ?>        
                
              </div>           
           
           
           
           
              
              
              

             <!-- <div class="form-group">
                  <label>Tanggal Pelaksanaan</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>-->
                    
			<!--		<?php
					$tgl_pelaksanaan=explode("-",$b['tgl_pelaksanaan']);
					$tgl_pelaksanaan=$tgl_pelaksanaan[1]."/".$tgl_pelaksanaan[0]."/".$tgl_pelaksanaan[2];
					
					?>                    
                    <input name="tgl_pelaksanaan" value="<?=$tgl_pelaksanaan;?>" type="text" class="form-control float-right" id="tanggal">
                  </div>-->
                  <!-- /.input group -->
               <!-- </div>-->
            
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
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputEstimatedBudget">Unggah Proposal</label>
                <input name="file_haki" type="file" id="inputEstimatedBudget" class="form-control">
                <input name="file_hidden" type="hidden" value="<?=$b['file'];?>" />
                <input name="id_haki" type="hidden" value="<?=$b['id_haki'];?>" />
              </div>             
             
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-12">
          <a href="#" class="btn btn-secondary">Batal</a>
          <input type="submit" name="submit" value="Ubah Haki" class="btn btn-success float-right">
        </div>
        <?php echo form_close(); ?>
      </div>
     <?php
    }
	?>    
      
    </section>
    <!-- /.content -->

<!-- page script -->

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
  
  $("#haki").addClass('menu-open');
  $("#haki .tambahbaru a.nav-link").addClass('active');
</script>




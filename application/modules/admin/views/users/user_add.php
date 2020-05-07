
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Pengguna</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
           
                <?php if(isset($msg) || validation_errors() !== ''): ?>
                  <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="fa fa-exclamation"></i> Terjadi Kesalahan</h4>
                      <?= validation_errors();?>
                      <?= isset($msg)? $msg: ''; ?>
                  </div>
                <?php endif; ?>
             
          </div>

          <div class="col-md-6">
              <div class="card card-success card-outline">
                <div class="card-body box-profile">
                  
                  <?php echo form_open_multipart(base_url('admin/users/add'), '' )?>
                  <div class="form-group">
                    <label for="username" class="control-label">Username</label>
                    <div class="">
                      <input type="text" name="username" class="form-control" id="username" value="<?= set_value('username'); ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="firstname" class="control-label">Nama Lengkap</label>
                    <div>
                      <input type="text" name="firstname" class="form-control" id="firstname" value="<?= set_value('firstname'); ?>">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <div>
                      <input type="email" name="email" class="form-control" id="email" value="<?= set_value('email'); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mobile_no" class="control-label">Telepon</label>
                    <div>
                      <input type="number" name="mobile_no" class="form-control" id="mobile_no" value="<?= set_value('mobile_no'); ?>">
                    </div>
                  </div>
                 
              </div>
            </div>
          </div>

           <div class="col-md-6">
              <div class="card card-success card-outline">
                <div class="card-body box-profile">  
                  <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <div>
                      <input type="password" name="password" class="form-control" value="<?= set_value('password'); ?>">
                    </div>
                  </div>               
                             

                  <div class="form-group">
                    <label for="is_admin" class="control-label">Pilih Jabatan</label>
                    <div>
                      <select name="is_admin" class="form-control">
                        <option value="" <?php echo  set_select('is_admin', '', TRUE); ?>>Pilih Jabatan</option>
                        <option value="1" <?php echo  set_select('is_admin', '1', TRUE); ?>>Administrator</option>
                        <option value="2" <?php echo  set_select('is_admin', '2', TRUE); ?>>TU Prodi</option>
                        <option value="3" <?php echo  set_select('is_admin', '3', TRUE); ?>>Reviewer</option>
                        <option value="4" <?php echo  set_select('is_admin', '4', TRUE); ?>>Dosen</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="id_prodi" class="control-label">Pilih Program Studi</label>
                    <div>
                      <select name="id_prodi" class="form-control">
                        <option value="">Pilih program Studi</option>
                        <?php foreach($prodi as $prodi): ?>
                          <option value="<?= $prodi['id_prodi']; ?>" <?php echo  set_select('id_prodi', $prodi['id_prodi'] , TRUE); ?>><?= $prodi['prodi'];  ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label for="foto_profil" class="control-label">Foto Profil (jpg/png)</label>
                    <div>
                      <input type="file" name="foto_profil" class="form-control" id="foto_profil" placeholder="">
                    </div>
                  </div>

                  <div class="form-group">
                    <div>
                      <input type="submit" name="submit" value="Tambah Pengguna" class="btn btn-info">
                    </div>
                  </div>
                <?php echo form_close( ); ?>

              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

 <script>
  $("#pengguna").addClass('menu-open');
  $("#pengguna .tambah_pengguna a.nav-link").addClass('active');
</script>
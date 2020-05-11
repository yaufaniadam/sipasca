
<!-- Brand Logo -->
    <a href="<?= base_url() ?>admin/dashboard" class="brand-link navbar-success">
      <img src="<?= base_url() ?>public/dist/img/logo.png" alt="Pascasarjana UMY" class="brand-image">
      <span class="brand-text font-weight-light">SIM Pasca UMY</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item" id="beranda">
            <a href="<?= base_url() ?>admin/dashboard" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda              
              </p>
            </a>
          </li>

          <li class="nav-header">KINERJA</li>

          <li class="nav-item has-treeview" id="penelitian">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Penelitian
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item semuapenelitian">
                <a href="<?=base_url('admin/penelitian');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Penelitian</p>
                </a>
              </li>
       
              <?php if($this->session->userdata('is_admin')==2) { ?>      
              
              <li class="nav-item tambahbaru">
                <a href="<?=base_url('admin/penelitian/tambah');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Penelitian</p>
                </a>
              </li>  

              <?php } ?>              
                         
            </ul>
          </li>
          <li class="nav-item has-treeview" id="publikasi">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-readme"></i>
              <p>
                Publikasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item semuapublikasi">
                <a href="<?=base_url('admin/publikasi');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Publikasi</p>
                </a>
              </li> 
              
              <?php if($this->session->userdata('is_admin')==2) { ?>         
              
              <li class="nav-item tambahpublikasi">
                <a href="<?= base_url('admin/publikasi/tambah') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Publikasi</p>
                </a>
              </li>  

              <?php } ?> 

            </ul>
          </li>
          <li class="nav-item has-treeview" id="pengabdian">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-heart"></i>
              <p>
                Pengabdian Masyarakat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item semuapengabdian">
                <a href="<?=base_url('admin/pengabdian');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Pengabdian</p>
                </a>
              </li> 
              
              <?php if($this->session->userdata('is_admin')==2) { ?>           
                
                <li class="nav-item tambahpengabdian">
                  <a href="<?= base_url('admin/pengabdian/tambah') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah Pengabdian</p>
                  </a>
                </li>   

              <?php } ?>   

            </ul>
          </li>
          <li class="nav-item has-treeview" id="haki">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shield-alt"></i>
              <p>
                Hak Kekayaan Intelektual
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item semuahaki">
                <a href="<?=base_url('admin/haki');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua HAKI</p>
                </a>
              </li>             
              
              <?php if($this->session->userdata('is_admin')==2) { ?>
              
              <li class="nav-item tambahhaki">
                <a href="<?= base_url('admin/haki/tambah') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah HAKI</p>
                </a>
              </li>   

              <?php } ?>          
                          
            </ul>
          </li>

    
          <li class="nav-item has-treeview" id="buku">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Buku
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item semuabuku">
                <a href="<?=base_url('admin/buku');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Buku</p>
                </a>
              </li> 
              
              <?php if($this->session->userdata('is_admin')==2) { ?>
              
              <li class="nav-item tambahbuku">
                <a href="<?= base_url('admin/buku/tambah') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Buku</p>
                </a>
              </li>   

              <?php } ?> 
            </ul>
          </li>

          <?php if($this->session->userdata('is_admin')==1) { ?>

          <li class="nav-header">ADMINISTRATOR</li>
          <li class="nav-item has-treeview" id="pengguna">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item semua_pengguna">
                <a href="<?=base_url('admin/users'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Pengguna</p>
                </a>
              </li> 
              <li class="nav-item tambah_pengguna">
                <a href="<?=base_url('admin/users/add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Pengguna</p>
                </a>
              </li> 
              <li class="nav-item upload_pengguna">
                <a href="<?=base_url('admin/users/upload'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload Pengguna</p>
                </a>
              </li> 
               
            </ul>
          </li>
          <li class="nav-item" id="prodi">
            <a href="<?=base_url('admin/prodi'); ?>" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Program Studi               
              </p>
            </a>
            
          </li>

          <?php } // endif is admin ?>

          <li class="nav-header">PROFIL</li>
          <li class="nav-item" id="profil">
            <a href="<?= base_url() ?>admin/profile" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil Saya             
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->



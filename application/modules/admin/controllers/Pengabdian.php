<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Pengabdian extends Admin_Controller {
		
		public function __construct(){
			parent::__construct();
			$this->load->model('pengabdian_model', 'pengabdian_model');

		}

		public function index( $status=0 ){		
			
			// periksa kategori
			$status = ($status !='') ? $status : '';
			
			$data['pengabdian'] = $this->pengabdian_model->get_pengabdian($status);

			$data['view'] = 'pengabdian/index'; //lokasinya di /modules/Penelitian/views
			$this->load->view('admin/layout', $data);

		}

		public function detail( $id_pengabdian ){		
			
			$data['view'] = 'pengabdian/detail'; //lokasinya di /modules/Penelitian/views
			
			$data['dokumentasi_kegiatan'] = $this->pengabdian_model->dokumentasi_kegiatan($id_pengabdian);
			$data['detail_pengabdian'] = $this->pengabdian_model->detail_pengabdian($id_pengabdian);

			$this->load->view('admin/layout', $data);

		}
		
		
		
		public function edit($id_pengabdian){
			

					
					$data['edit_pengabdian'] = $this->pengabdian_model->edit_pengabdian($id_pengabdian);
					$data['dosen'] = $this->pengabdian_model->dosen();
					$data['view'] = 'pengabdian/edit';
					$this->load->view('admin/layout', $data);
			
		}		
		
		
		
		public function update(){
			

			if($this->input->post('submit')){

				$this->form_validation->set_rules('judul_pengabdian', 'Judul Pengabdian', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				
	
				if ($this->form_validation->run() == FALSE) {		
				
					$data['edit_pengabdian'] = $this->pengabdian_model->edit_pengabdian($this->input->post('id_penelitian'));
					$data['dosen'] = $this->pengabdian_model->dosen();
					$data['view'] = 'pengabdian/edit';
					$this->load->view('admin/layout', $data);
				}
				else{ 


					if($_FILES['file_pengabdian']['name']=="")
					{
						$file_pengabdian=$_POST['file_hidden'];
					}
					else
					{
						
					$upload_path = './uploads/pengabdian';

						if (!is_dir($upload_path)) {
						     mkdir($upload_path, 0777, TRUE);					
						}
						//$newName = "hrd-".date('Ymd-His');
						$config = array(
								'upload_path' => $upload_path,
								'allowed_types' => "doc|docx|xls|xlsx|ppt|pptx|odt|rtf|jpg|png|pdf",
								'overwrite' => FALSE,				
						);					

						$this->load->library('upload', $config);
						$this->upload->do_upload('file_pengabdian');
					    $pengabdian = $this->upload->data();
						
						$file_pengabdian=$upload_path.'/'.$pengabdian['file_name']; 
						
						unlink($this->input->post('file_hidden'));

					}	
						$tgl_pelaksanaan=explode("/", $this->input->post('tgl_pelaksanaan'));
						$tgl_pelaksanaan=$tgl_pelaksanaan[2]."-".$tgl_pelaksanaan[0]."-".$tgl_pelaksanaan[1];
						
										
						
						

						$data = array(
									
							'judul_pengabdian' => $this->input->post('judul_pengabdian'),
							'file' => $file_pengabdian,
							

							'lokasi' => $this->input->post('lokasi'),
							'tgl_pelaksanaan' => $tgl_pelaksanaan,
							'deskripsi' => $this->input->post('deskripsi'),
							'id_dosen' => $this->input->post('id_dosen'),
							
							
						);
						
						$where = array('id_pengabdian' => $this->input->post('id_pengabdian'));
						
						
						$data = $this->security->xss_clean($data);
						$result = $this->pengabdian_model->update($data, $where);

						if($result){
							$this->session->set_flashdata('msg', 'Data telah diUbah!');
							redirect(base_url('admin/pengabdian/edit/'.$this->input->post('id_pengabdian')));
						} 

					} 

				}			
		}		
		
		

		public function tambah(){
			if($this->input->post('submit')){

				$this->form_validation->set_rules('judul_pengabdian', 'Judul Pengabdian', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				
	
				if ($this->form_validation->run() == FALSE) {		
				
				
					$data['dosen'] = $this->pengabdian_model->dosen();
					$data['view'] = 'pengabdian/tambah';
					$this->load->view('admin/layout', $data);
				}
				else{ 

					$upload_path = './uploads/pengabdian';

						if (!is_dir($upload_path)) {
						     mkdir($upload_path, 0777, TRUE);					
						}
						//$newName = "hrd-".date('Ymd-His');
						$config = array(
								'upload_path' => $upload_path,
								'allowed_types' => "doc|docx|xls|xlsx|ppt|pptx|odt|rtf|jpg|png|pdf",
								'overwrite' => FALSE,				
						);					

						$this->load->library('upload', $config);
						$this->upload->do_upload('file_pengabdian');
					    $pengabdian = $this->upload->data();
						
						
						
						$tgl_pelaksanaan=explode("/", $this->input->post('tgl_pelaksanaan'));
						$tgl_pelaksanaan=$tgl_pelaksanaan[2]."-".$tgl_pelaksanaan[0]."-".$tgl_pelaksanaan[1];
						
										
						
						

						$data = array(
									
							'judul_pengabdian' => $this->input->post('judul_pengabdian'),
							'date' => date('Y-m-d'),		
							'file' => $upload_path.'/'.$pengabdian['file_name'],
							

							'lokasi' => $this->input->post('lokasi'),
							'tgl_pelaksanaan' => $tgl_pelaksanaan,
							'deskripsi' => $this->input->post('deskripsi'),
							'id_dosen' => $this->input->post('id_dosen'),
							'id_pengupload' => $this->session->userdata('user_id'),
							'id_prodi' => $this->session->userdata('id_prodi'),
							'id_checklist_penilaian' => 0,
							
						);
									
						$data = $this->security->xss_clean($data);
						$result = $this->pengabdian_model->tambah($data);

						if($result){
							$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
							redirect(base_url('admin/pengabdian/tambah'));
						} 

					} 

				}

				else{
					
					$data['dosen'] = $this->pengabdian_model->dosen();
					$data['view'] = 'pengabdian/tambah';
					$this->load->view('admin/layout', $data);
				}
		}
		
		
		
		
		public function update_pengabdian()
		{
		
			
		
	  	$extensions= array("doc","docx","xls","xlsx","ppt","pptx","odt","rtf","pdf");
		//$path = 'uploads/pengabdian/';
		
		$path = './uploads/pengabdian/';

	
		
	  	if (!file_exists($path)) {
      	mkdir($path, 0777, true);
	  	}	
		
		
	//Upload File Revisi		
		$file_name_revisi = $_FILES['file_revisi']['name'];
		$file_name_revisi=str_replace(" ","_",$file_name_revisi);
		
	    $file_size =$_FILES['file_revisi']['size'];
      	$file_tmp =$_FILES['file_revisi']['tmp_name'];
      	$file_type=$_FILES['file_revisi']['type'];

      	$file_ext_revisi=explode('.',$file_name_revisi);
	  	$file_ext_revisi=end($file_ext_revisi);
      	$file_ext_revisi=strtolower($file_ext_revisi);
		
      	if(in_array($file_ext_revisi,$extensions)=== false){
         echo"Maaf File Dokumen Saja Bisa Diupload.";
      	}
     	else
	 	{
         move_uploaded_file($file_tmp,$path.$file_name_revisi);
         echo "Success";
		 
		  unlink($this->input->post('file_revisi_hidden'));
      	}
		
		if($file_name_revisi=="")
		{	
		$file_revisi=$_POST['file_revisi_hidden'];
		}
		else
		{			
		$file_revisi=$path.$file_name_revisi;
		}
	//Upload File Revisi		
		
		
		
		
	//Upload File Akhir		
		$file_name_akhir = $_FILES['file_akhir']['name'];
		$file_name_akhir=str_replace(" ","_",$file_name_akhir);
		
	    $file_size =$_FILES['file_akhir']['size'];
      	$file_tmp =$_FILES['file_akhir']['tmp_name'];
      	$file_type=$_FILES['file_akhir']['type'];

      	$file_ext_akhir=explode('.',$file_name_akhir);
	  	$file_ext_akhir=end($file_ext_akhir);
      	$file_ext_akhir=strtolower($file_ext_akhir);
		
      	if(in_array($file_ext_akhir,$extensions)=== false){
         echo"Maaf File Dokumen Saja Bisa Diupload.";
      	}
     	else
	 	{
         move_uploaded_file($file_tmp,$path.$file_name_akhir);
         echo "Success";
		 
		  unlink($this->input->post('file_akhir_hidden'));
      	}
		
		if($file_name_akhir=="")
		{	
		$file_akhir=$_POST['file_akhir_hidden'];
		}
		else
		{			
		$file_akhir=$path.$file_name_akhir;
		}
	//Upload File Akhir		
		
		
		
		echo $file_akhir;
		
		
//exit();
			
	
			
			
			
			if($this->input->post('id_checklist_penilaian')=="")
			{
				$id_checklist_penilaian=$this->input->post('id_checklist_penilaian_hidden');
			}
			else
			{
				$id_checklist_penilaian=implode(",", $this->input->post('id_checklist_penilaian'));
			}
			
			
			if($this->input->post('hasil_penilaian')=="")
			{
				$hasil_penilaian=$this->input->post('hasil_penilaian_hidden');
			}
			else
			{
				$hasil_penilaian=$this->input->post('hasil_penilaian');
			}
			
			if($this->input->post('komentar_reviewer')=="")
			{
				$komentar_reviewer=$this->input->post('komentar_reviewer_hidden');
			}
			else
			{
				$komentar_reviewer=$this->input->post('komentar_reviewer');
			}
			
			
			
			
	
			$input=array(
				'status'=>2,
				'file_revisi'=>$file_revisi,
				'file_akhir'=>$file_akhir,
				'id_checklist_penilaian'=>$id_checklist_penilaian,
				'hasil_penilaian'=>$hasil_penilaian,
				
				'komentar_reviewer'=>$komentar_reviewer,
				
				
			);
	
	
			$where=array('id_pengabdian'=>$_POST['id_pengabdian']);
			
			$input = $this->security->xss_clean($input);
	
			$proses=$this->pengabdian_model->update_pengabdian($input, $where);	
	
	
			if($proses)
			{
				$this->session->set_flashdata('msg','Data Berhasil Diubah');

				redirect('admin/pengabdian/detail/'.$_POST['id_pengabdian']);
	
			}



		}	
		
		
		
		
	public function tambah_kegiatan($id_pengabdian){
			
		$data['id_pengabdian'] = $id_pengabdian;
		$data['dokumentasi_kegiatan'] = $this->pengabdian_model->dokumentasi_kegiatan($id_pengabdian);

		$data['view'] = 'pengabdian/tambah_kegiatan';
		$this->load->view('admin/layout', $data);
			
	}		
	
	
	
	public function tambah_kegiatan_proses(){
			if($this->input->post('submit')){

			
				/*$this->form_validation->set_rules('photo', '', 'callback_file_check');
				
	
				if ($this->form_validation->run() == FALSE) {	
				
				
					$data['id_pengabdian'] = $this->input->post('id_pengabdian');
					$data['view'] = 'pengabdian/tambah_kegiatan';
					$this->load->view('admin/layout', $data);
				}
				else{ */

					$upload_path = './uploads/kegiatan/pengabdian';

						if (!is_dir($upload_path)) {
						     mkdir($upload_path, 0777, TRUE);					
						}
						//$newName = "hrd-".date('Ymd-His');
						$config = array(
								'upload_path' => $upload_path,
								'allowed_types' => "jpg|png|gif",
								'overwrite' => FALSE,				
						);					

						$this->load->library('upload', $config);
						$this->upload->do_upload('photo');
					    $pengabdian = $this->upload->data();
						

					$data = array(
									
							'nama' => $this->input->post('nama'),
							'photo' => $upload_path.'/'.$pengabdian['file_name'],
							'id_pengabdian' => $this->input->post('id_pengabdian'),	
						);
									
						$data = $this->security->xss_clean($data);
						$result = $this->pengabdian_model->tambah_kegiatan_proses($data);

						if($result){
							$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
							redirect(base_url('admin/pengabdian/tambah_kegiatan/'.$this->input->post('id_pengabdian')));
						} 

					//} 

				}

				
		}
	
	
	
	
		public function hapus_kegiatan($id){	
			$this->db->delete('dokumentasi_kegiatan', array('id_dokumentasi' => $id));
			$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
			redirect(base_url('admin/pengabdian/tambah_kegiatan/'.$id));
		}
		

		

		public function hapus($id = 0, $uri = NULL){	
			$this->db->delete('pengabdian', array('id_pengabdian' => $id));
			$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
			redirect(base_url('admin/pengabdian/index'));
		}


	} //class


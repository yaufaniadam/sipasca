<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Haki extends Admin_Controller {
		
		public function __construct(){
			parent::__construct();
			$this->load->model('haki_model', 'haki_model');

		}

		public function index( $status=0 ){		
			
			// periksa kategori
			$status = ($status !='') ? $status : '';
			
			$data['haki'] = $this->haki_model->get_haki($status);

			$data['view'] = 'haki/index'; //lokasinya di /modules/Penelitian/views
			$this->load->view('admin/layout', $data);

		}




		public function detail($id_haki){		
			
			$data['view'] = 'haki/detail'; //lokasinya di /modules/Penelitian/views
			
			$data['dokumentasi_kegiatan'] = $this->haki_model->dokumentasi_kegiatan($id_haki);
			$data['detail_haki'] = $this->haki_model->detail_haki($id_haki);

			$this->load->view('admin/layout', $data);

		}

		public function edit($id_haki){
			

					
					$data['edit_haki'] = $this->haki_model->edit_haki($id_haki);
					$data['dosen'] = $this->haki_model->dosen();
					$data['view'] = 'haki/edit';
					$this->load->view('admin/layout', $data);
			
		}



		public function update(){
			

				if($this->input->post('submit')){


				//echo $_POST['id_kategori_haki'];

				//exit();


				$this->form_validation->set_rules('judul_haki', 'Judul Haki', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				
	
				if ($this->form_validation->run() == FALSE) {		
				
					$data['edit_haki'] = $this->haki_model->edit_haki($this->input->post('id_haki'));
					$data['dosen'] = $this->haki_model->dosen();
					$data['view'] = 'haki/edit';
					$this->load->view('admin/layout', $data);
				}
				else{ 
				
					if($_FILES['file_haki']['name']=="")
					{
						$file_haki=$_POST['file_hidden'];
					}
					else
					{				

					$upload_path = './uploads/haki';

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
						$this->upload->do_upload('file_haki');
					    $haki = $this->upload->data();
						

						$file_haki=$upload_path.'/'.$haki['file_name']; 
						
						unlink($this->input->post('file_hidden'));

						
					}
											
					//	$tgl_pelaksanaan=explode("/", $this->input->post('tgl_pelaksanaan'));
					//	$tgl_pelaksanaan=$tgl_pelaksanaan[2]."-".$tgl_pelaksanaan[0]."-".$tgl_pelaksanaan[1];
						
										
						
						

						$data = array(
									
							'judul_haki' => $this->input->post('judul_haki'),
							'file' => $file_haki,
							

							
						//	'tgl_pelaksanaan' => $tgl_pelaksanaan,
							'deskripsi' => $this->input->post('deskripsi'),
							'id_dosen' => $this->input->post('id_dosen'),
							
							'id_kategori_haki' => $this->input->post('id_kategori_haki'),
							
						);
						
						$where = array('id_haki' => $this->input->post('id_haki'));
									
						$data = $this->security->xss_clean($data);
						$result = $this->haki_model->update($data, $where);

						if($result){
							$this->session->set_flashdata('msg', 'Data telah diUbah!');
							redirect(base_url('admin/haki/edit/'.$this->input->post('id_haki')));
						} 

					} 

				}
			
		}





		public function tambah(){
			if($this->input->post('submit')){

				$this->form_validation->set_rules('judul_haki', 'Judul Haki', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				
	
				if ($this->form_validation->run() == FALSE) {		
				
				
					$data['dosen'] = $this->haki_model->dosen();
					$data['view'] = 'haki/tambah';
					$this->load->view('admin/layout', $data);
				}
				else{ 

					$upload_path = './uploads/haki';

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
						$this->upload->do_upload('file_haki');
					    $haki = $this->upload->data();
						
						
						
						$tgl_pelaksanaan=explode("/", $this->input->post('tgl_pelaksanaan'));
						$tgl_pelaksanaan=$tgl_pelaksanaan[2]."-".$tgl_pelaksanaan[0]."-".$tgl_pelaksanaan[1];
						
										
						
						

						$data = array(
									
							'judul_haki' => $this->input->post('judul_haki'),
							'date' => date('Y-m-d'),		
							'file' => $upload_path.'/'.$haki['file_name'],
							

							
							
							'deskripsi' => $this->input->post('deskripsi'),
							'id_dosen' => $this->input->post('id_dosen'),
							'id_pengupload' => $this->session->userdata('user_id'),
							'id_prodi' => $this->session->userdata('id_prodi'),
							
							'id_kategori_haki' => $this->input->post('id_kategori_haki'),

						);
						
						
						
									
						$data = $this->security->xss_clean($data);
						$result = $this->haki_model->tambah($data);
						
						
						$id_haki = $this->db->insert_id();		
						
						

						if($result){
							$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
							redirect(base_url('admin/haki/detail/'.$id_haki));
						} 

					} 

				}

				else{
					
					$data['dosen'] = $this->haki_model->dosen();
					$data['view'] = 'haki/tambah';
					$this->load->view('admin/layout', $data);
				}
		}
		
		
		
		
		public function update_haki()
		{
		
			
		
	  	$extensions= array("doc","docx","xls","xlsx","ppt","pptx","odt","rtf","pdf");
		//$path = 'uploads/haki/';
		
		$path = './uploads/haki/';

	
		
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
	
	
			$where=array('id_haki'=>$_POST['id_haki']);
			
			$input = $this->security->xss_clean($input);
	
			$proses=$this->haki_model->update_haki($input, $where);	
	
	
			if($proses)
			{
				$this->session->set_flashdata('msg','Data Berhasil Diubah');

				redirect('admin/haki/detail/'.$_POST['id_haki']);
	
			}



		}	
		
		
		
		
	public function tambah_kegiatan($id_haki){
			
		$data['id_haki'] = $id_haki;
		$data['dokumentasi_kegiatan'] = $this->haki_model->dokumentasi_kegiatan($id_haki);

		$data['view'] = 'haki/tambah_kegiatan';
		$this->load->view('admin/layout', $data);
			
	}		
	
	
	
	public function tambah_kegiatan_proses(){
			if($this->input->post('submit')){

			
				/*$this->form_validation->set_rules('photo', '', 'callback_file_check');
				
	
				if ($this->form_validation->run() == FALSE) {	
				
				
					$data['id_haki'] = $this->input->post('id_haki');
					$data['view'] = 'haki/tambah_kegiatan';
					$this->load->view('admin/layout', $data);
				}
				else{ */

					$upload_path = './uploads/kegiatan/haki';

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
					    $haki = $this->upload->data();
						

					$data = array(
									
							'nama' => $this->input->post('nama'),
							'photo' => $upload_path.'/'.$haki['file_name'],
							'id_haki' => $this->input->post('id_haki'),	
						);
									
						$data = $this->security->xss_clean($data);
						$result = $this->haki_model->tambah_kegiatan_proses($data);

						if($result){
							$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
							redirect(base_url('admin/haki/tambah_kegiatan/'.$this->input->post('id_haki')));
						} 

					//} 

				}

				
		}
	
	
	
	
		public function hapus_kegiatan($id){	
			$this->db->delete('dokumentasi_kegiatan', array('id_dokumentasi' => $id));
			$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
			redirect(base_url('admin/haki/tambah_kegiatan/'.$id));
		}
		

		

		public function hapus($id = 0, $uri = NULL){	
			$this->db->delete('haki', array('id_haki' => $id));
			$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
			redirect(base_url('admin/haki/index'));
		}


	} //class


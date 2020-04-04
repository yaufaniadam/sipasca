<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Publikasi extends Admin_Controller {
		
		public function __construct(){
			parent::__construct();
			$this->load->model('publikasi_model', 'publikasi_model');

		}

		public function index( $status=0 ){		
			
			// periksa kategori
			$status = ($status !='') ? $status : '';
			
			$data['publikasi'] = $this->publikasi_model->publikasi($status);

			$data['view'] = 'publikasi/index'; //lokasinya di /modules/Penelitian/views
			$this->load->view('admin/layout', $data);

		}

		public function detail( $id_publikasi ){		
			
			$data['view'] = 'publikasi/detail'; //lokasinya di /modules/Penelitian/views
			
			$data['dokumentasi_kegiatan'] = $this->publikasi_model->dokumentasi_kegiatan($id_publikasi);
			$data['detail_publikasi'] = $this->publikasi_model->detail_publikasi($id_publikasi);

			$this->load->view('admin/layout', $data);

		}
		
		
		public function edit( $id_publikasi ){		
			
			
					$data['edit_publikasi'] = $this->publikasi_model->edit_publikasi($id_publikasi);
					$data['dosen'] = $this->publikasi_model->dosen();
					$data['view'] = 'publikasi/edit';
					$this->load->view('admin/layout', $data);
		}
		
		
		
		
		public function update(){		
			
				if($this->input->post('submit')){

				$this->form_validation->set_rules('judul_publikasi', 'Judul Publikasi', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				
	
				if ($this->form_validation->run() == FALSE) {

					$data['edit_publikasi'] = $this->penelitian_model->edit_publikasi($this->input->post('id_publikasi'));
					$data['dosen'] = $this->penelitian_model->dosen();
					$data['view'] = 'publikasi/edit';
					$this->load->view('admin/layout', $data);
				}
				else{ 
				
				
					if($_FILES['file_publikasi']['name']=="")
					{
						$file_publikasi=$_POST['file_hidden'];
					}
					else
					{
					$upload_path = './uploads/publikasi';

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
						$this->upload->do_upload('file_publikasi');
					    $publikasi = $this->upload->data();
						
						$file_publikasi=$upload_path.'/'.$publikasi['file_name']; 
						
						unlink($this->input->post('file_hidden'));
					
						}	
						
											
						$tgl_pelaksanaan=explode("/", $this->input->post('tgl_pelaksanaan'));
						$tgl_pelaksanaan=$tgl_pelaksanaan[2]."-".$tgl_pelaksanaan[0]."-".$tgl_pelaksanaan[1];
						
						

						$data = array(
									
							'judul_publikasi' => $this->input->post('judul_publikasi'),
							'date' => date('Y-m-d'),		
							'file' => $file_publikasi,
							

							'tgl_pelaksanaan' => $tgl_pelaksanaan,
							'deskripsi' => $this->input->post('deskripsi'),
							'id_dosen' => $this->input->post('id_dosen'),
							'id_jenis_publikasi'=>$this->input->post('id_jenis_publikasi'),
							'id_sub_jenis_publikasi'=>$this->input->post('id_sub_jenis_publikasi'),
							'sub_jenis_publikasi_text'=>$this->input->post('sub_jenis_publikasi_text')
							
						);
						
						
						$where = array('id_publikasi' => $this->input->post('id_publikasi'));	
														
						$data = $this->security->xss_clean($data);
						$result = $this->publikasi_model->update($data, $where);

						if($result){
							$this->session->set_flashdata('msg', 'Data telah diUbah!');
							redirect(base_url('admin/publikasi/edit/'.$this->input->post('id_publikasi')));
						} 

					} 

				}					
					
		}		
		
		

		public function tambah(){
			if($this->input->post('submit')){

				$this->form_validation->set_rules('judul_publikasi', 'Judul Publikasi', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				
	
				if ($this->form_validation->run() == FALSE) {
					
					$data['dosen'] = $this->penelitian_model->dosen();
					$data['view'] = 'publikasi/tambah';
					$this->load->view('admin/layout', $data);
				}
				else{ 
				
				
				
				/*echo $_POST['id_sub_jenis_publikasi'];
				
				exit();*/

					$upload_path = './uploads/publikasi';

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
						$this->upload->do_upload('file_publikasi');
					    $publikasi = $this->upload->data();
						
						
						
						$tgl_pelaksanaan=explode("/", $this->input->post('tgl_pelaksanaan'));
						$tgl_pelaksanaan=$tgl_pelaksanaan[2]."-".$tgl_pelaksanaan[0]."-".$tgl_pelaksanaan[1];
						
						

						$data = array(
									
							'judul_publikasi' => $this->input->post('judul_publikasi'),
							'date' => date('Y-m-d'),		
							'file' => $upload_path.'/'.$publikasi['file_name'],
							

							'tgl_pelaksanaan' => $tgl_pelaksanaan,
							'deskripsi' => $this->input->post('deskripsi'),
							'id_dosen' => $this->input->post('id_dosen'),
							'id_pengupload' => $this->session->userdata('user_id'),
							'id_prodi' => $this->session->userdata('id_prodi'),
						
							'id_jenis_publikasi'=>$this->input->post('id_jenis_publikasi'),
							'id_sub_jenis_publikasi'=>$this->input->post('id_sub_jenis_publikasi'),
							'sub_jenis_publikasi_text'=>$this->input->post('sub_jenis_publikasi_text')
							
						);
									
						$data = $this->security->xss_clean($data);
						$result = $this->publikasi_model->tambah($data);

						if($result){
							$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
							redirect(base_url('admin/publikasi/tambah'));
						} 

					} 

				}

				else{
					
					$data['dosen'] = $this->publikasi_model->dosen();
					$data['view'] = 'publikasi/tambah';
					$this->load->view('admin/layout', $data);
				}
		}
		
		
		
		public function sub_jenis_publikasi()
		{
		$this->load->view('admin/publikasi/sub_jenis_publikasi');
		}
		
		
		
		
		
		public function update_publikasi()
		{
		
			
			
			if($this->input->post('link_publikasi')=="")
			{
				$link_publikasi =$this->input->post('link_publikasi_hidden');
			}
			else
			{
				$link_publikasi =$this->input->post('link_publikasi');
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
			
			
			if($this->input->post('tgl_hasil_penilaian')=="")
			{
				$tgl_hasil_penilaian=$this->input->post('tgl_hasil_penilaian_hidden');
			}
			else
			{
				$tgl_hasil_penilaian=$this->input->post('tgl_hasil_penilaian');

			}
			
			
			
			
		
			
			
			
	
			$input=array(
				'status'=>2,
				'file_revisi'=>$file_revisi,
				'link_publikasi'=>$link_publikasi,
				'hasil_penilaian'=>$hasil_penilaian,
				'tgl_hasil_penilaian'=>$tgl_hasil_penilaian,
				'komentar_reviewer'=>$komentar_reviewer
				
				
				
			);
	
	
			$where=array('id_publikasi'=>$_POST['id_publikasi']);
			
			$input = $this->security->xss_clean($input);
	
			$proses=$this->publikasi_model->update_publikasi($input, $where);	
	
	
			if($proses)
			{
				$this->session->set_flashdata('msg','Data Berhasil Diubah');

				redirect('admin/publikasi/detail/'.$_POST['id_publikasi']);
	
			}



		}	
		
		
		
		
	public function tambah_kegiatan($id_publikasi){
			
		$data['id_publikasi'] = $id_publikasi;
		$data['dokumentasi_kegiatan'] = $this->publikasi_model->dokumentasi_kegiatan($id_publikasi);

		$data['view'] = 'publikasi/tambah_kegiatan';
		$this->load->view('admin/layout', $data);
			
	}		
	
	
	
	public function tambah_kegiatan_proses(){
			if($this->input->post('submit')){

			
				/*$this->form_validation->set_rules('photo', '', 'callback_file_check');
				
	
				if ($this->form_validation->run() == FALSE) {	
				
				
					$data['id_penelitian'] = $this->input->post('id_penelitian');
					$data['view'] = 'penelitian/tambah_kegiatan';
					$this->load->view('admin/layout', $data);
				}
				else{ */

					$upload_path = './uploads/kegiatan/publikasi';

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
					    $penelitian = $this->upload->data();
						

					$data = array(
									
							'nama' => $this->input->post('nama'),
							'photo' => $upload_path.'/'.$penelitian['file_name'],
							'id_publikasi' => $this->input->post('id_publikasi'),	
						);
									
						$data = $this->security->xss_clean($data);
						$result = $this->publikasi_model->tambah_kegiatan_proses($data);

						if($result){
							$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
							redirect(base_url('admin/publikasi/tambah_kegiatan/'.$this->input->post('id_publikasi')));
						} 

					//} 

				}

				
		}
	
	
	
	
		public function hapus_kegiatan($id){	
			$this->db->delete('dokumentasi_kegiatan', array('id_dokumentasi' => $id));
			$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
			redirect(base_url('admin/publikasi/tambah_kegiatan/'.$id));
		}
		

		

		public function hapus($id = 0, $uri = NULL){	
			$this->db->delete('publikasi', array('id_publikasi' => $id));
			$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
			redirect(base_url('admin/publikasi/index'));
		}


	} //class


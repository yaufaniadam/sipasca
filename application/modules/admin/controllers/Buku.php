<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Buku extends Admin_Controller {
		
		public function __construct(){
			parent::__construct();
			$this->load->model('buku_model', 'buku_model');

		}

		public function index( $status=0 ){		
			
			// periksa kategori
			$status = ($status !='') ? $status : '';
			
			$data['buku'] = $this->buku_model->get_buku($status);

			$data['view'] = 'buku/index'; //lokasinya di /modules/Penelitian/views
			$this->load->view('admin/layout', $data);

		}

		public function detail($id_buku){		
			
			$data['view'] = 'buku/detail'; //lokasinya di /modules/Penelitian/views
			
			$data['dokumentasi_kegiatan'] = $this->buku_model->dokumentasi_kegiatan($id_buku);
			$data['detail_buku'] = $this->buku_model->detail_buku($id_buku);

			$this->load->view('admin/layout', $data);

		}

		public function tambah(){
			if($this->input->post('submit')){

				$this->form_validation->set_rules('judul_buku', 'Judul buku', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				
	
				if ($this->form_validation->run() == FALSE) {		
				
				
					$data['dosen'] = $this->buku_model->dosen();
					$data['view'] = 'buku/tambah';
					$this->load->view('admin/layout', $data);
				}
				else{ 

					$upload_path = './uploads/buku';

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
						$this->upload->do_upload('file_buku');
					    $buku = $this->upload->data();
						$data = array(
									
							'judul_buku' => $this->input->post('judul_buku'),
							'date' => date('Y-m-d'),		
							'file' => $upload_path.'/'.$buku['file_name'],
							'deskripsi' => $this->input->post('deskripsi'),
							'id_dosen' => $this->input->post('id_dosen'),
							'id_pengupload' => $this->session->userdata('user_id'),
							'id_prodi' => $this->session->userdata('id_prodi'),		
							'kategori_buku' => $this->input->post('id_kategori_buku'),					
							
						);
									
						$data = $this->security->xss_clean($data);
						$result = $this->buku_model->tambah($data);

						if($result){
							$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
							redirect(base_url('admin/buku/'));
						} 

					} 

				}

				else{
					
					$data['dosen'] = $this->buku_model->dosen();
					$data['view'] = 'buku/tambah';
					$this->load->view('admin/layout', $data);
				}
		}
		
		
		
		
		public function update_buku()
		{
		
			
		
	  	$extensions= array("doc","docx","xls","xlsx","ppt","pptx","odt","rtf","pdf");
		//$path = 'uploads/buku/';
		
		$path = './uploads/buku/';

	
		
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
	
	
			$where=array('id_buku'=>$_POST['id_buku']);
			
			$input = $this->security->xss_clean($input);
	
			$proses=$this->buku_model->update_buku($input, $where);	
	
	
			if($proses)
			{
				$this->session->set_flashdata('msg','Data Berhasil Diubah');

				redirect('admin/buku/detail/'.$_POST['id_buku']);
	
			}



		}	
		
		
		
		
	public function tambah_kegiatan($id_buku){
			
		$data['id_buku'] = $id_buku;
		$data['dokumentasi_kegiatan'] = $this->buku_model->dokumentasi_kegiatan($id_buku);

		$data['view'] = 'buku/tambah_kegiatan';
		$this->load->view('admin/layout', $data);
			
	}		
	
	
	
	public function tambah_kegiatan_proses(){
			if($this->input->post('submit')){

			
				/*$this->form_validation->set_rules('photo', '', 'callback_file_check');
				
	
				if ($this->form_validation->run() == FALSE) {	
				
				
					$data['id_buku'] = $this->input->post('id_buku');
					$data['view'] = 'buku/tambah_kegiatan';
					$this->load->view('admin/layout', $data);
				}
				else{ */

					$upload_path = './uploads/kegiatan/buku';

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
					    $buku = $this->upload->data();
						

					$data = array(
									
							'nama' => $this->input->post('nama'),
							'photo' => $upload_path.'/'.$buku['file_name'],
							'id_buku' => $this->input->post('id_buku'),	
						);
									
						$data = $this->security->xss_clean($data);
						$result = $this->buku_model->tambah_kegiatan_proses($data);

						if($result){
							$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
							redirect(base_url('admin/buku/tambah_kegiatan/'.$this->input->post('id_buku')));
						} 

					//} 

				}

				
		}
	
	
	
	
		public function hapus_kegiatan($id){	
			$this->db->delete('dokumentasi_kegiatan', array('id_dokumentasi' => $id));
			$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
			redirect(base_url('admin/buku/tambah_kegiatan/'.$id));
		}
		

		

		public function hapus($id = 0, $uri = NULL){	
			$this->db->delete('buku', array('id_buku' => $id));
			$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
			redirect(base_url('admin/buku/index'));
		}

		public function tambah_dokumen($kat = 0, $id_buku = 0)
	{

		$data['id_buku'] = $id_buku;
		$data['kat'] = $kat;
		$data['dokumentasi_kegiatan'] = $this->buku_model->dokumentasi_kegiatan($id_buku);

		$data['view'] = 'buku/tambah_dokumen';
		$this->load->view('admin/layout', $data);
	}

	public function edit($id_buku)
	{
		$data['edit_buku'] = $this->buku_model->edit_buku($id_buku);
		$data['dosen'] = $this->buku_model->dosen();
		$data['view'] = 'buku/edit';
		$this->load->view('admin/layout', $data);
	}

	public function update()
	{


		if ($this->input->post('submit')) {




			$this->form_validation->set_rules('judul_buku', 'Judul Haki', 'trim|required');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');


			if ($this->form_validation->run() == FALSE) {

				$data['edit_buku'] = $this->buku_model->edit_buku($this->input->post('id_buku'));
				$data['dosen'] = $this->buku_model->dosen();
				$data['view'] = 'buku/edit';
				$this->load->view('admin/layout', $data);
			} else {

				if ($_FILES['file_buku']['name'] == "") {
					$file_buku = $_POST['file_hidden'];
				} else {

					$upload_path = './uploads/buku';

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
					$this->upload->do_upload('file_buku');
					$buku = $this->upload->data();


					$file_buku = $upload_path . '/' . $buku['file_name'];

					unlink($this->input->post('file_hidden'));
				}

				//	$tgl_pelaksanaan=explode("/", $this->input->post('tgl_pelaksanaan'));
				//	$tgl_pelaksanaan=$tgl_pelaksanaan[2]."-".$tgl_pelaksanaan[0]."-".$tgl_pelaksanaan[1];

				$data = array(

					'judul_buku' => $this->input->post('judul_buku'),
					'file' => $file_buku,



					//	'tgl_pelaksanaan' => $tgl_pelaksanaan,
					'deskripsi' => $this->input->post('deskripsi'),
					'id_dosen' => $this->input->post('id_dosen'),

					'kategori_buku' => $this->input->post('id_kategori_buku'),

				);

				$where = array('id_buku' => $this->input->post('id_buku'));

				$data = $this->security->xss_clean($data);
				$result = $this->buku_model->update_buku($data, $where);

				if ($result) {
					$this->session->set_flashdata('msg', 'Data telah diUbah!');
					redirect(base_url('admin/buku/edit/' . $this->input->post('id_buku')));
				}
			}
		}
	}

	public function tambah_dokumen_proses()
	{
		if ($this->input->post('submit')) {


			$upload_path = './uploads/dokumen/buku';

			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0777, TRUE);
			}
			//$newName = "hrd-".date('Ymd-His');
			$config = array(
				'upload_path' => $upload_path,
				'allowed_types' => "jpg|jpeg|png|pdf",
				'overwrite' => FALSE,
			);

			$this->load->library('upload', $config);
			$this->upload->do_upload('file');
			$buku = $this->upload->data();
			$file = $upload_path . '/' . $buku['file_name'];
			$kat =  $this->input->post('kat');

			$this->db->where('id_buku', $this->input->post('id_buku'));
			$result = $this->db->update('buku', array($kat => $file));

			if ($result) {
				$this->session->set_flashdata('msg', 'Data telah disimpan!');
				redirect(base_url('admin/buku/detail/' . $this->input->post('id_buku')));
			}
		}
	}

	public function hapus_dokumen($id)
	{
		$this->db->delete('dokumentasi_kegiatan', array('id_dokumentasi' => $id));
		$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
		redirect(base_url('admin/buku/tambah_kegiatan/' . $id));
	}


	} //class


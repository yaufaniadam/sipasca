<?php defined('BASEPATH') or exit('No direct script access allowed');

class Penelitian extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('penelitian_model', 'penelitian_model');
	}

	public function index($status = 0)
	{

		// periksa kategori
		$status = ($status != '') ? $status : '';

		$data['penelitian'] = $this->penelitian_model->get_penelitian($status);

		$data['view'] = 'penelitian/index'; //lokasinya di /modules/Penelitian/views
		$this->load->view('admin/layout', $data);
	}

	public function detail($id_penelitian)
	{

		$data['view'] = 'penelitian/detail'; //lokasinya di /modules/Penelitian/views

		$data['dokumentasi_kegiatan'] = $this->penelitian_model->dokumentasi_kegiatan($id_penelitian);
		$data['detail_penelitian'] = $this->penelitian_model->detail_penelitian($id_penelitian);

		$this->load->view('admin/layout', $data);
	}



	public function edit($id_penelitian)
	{



		$data['edit_penelitian'] = $this->penelitian_model->edit_penelitian($id_penelitian);
		$data['dosen'] = $this->penelitian_model->dosen();
		$data['view'] = 'penelitian/edit';
		$this->load->view('admin/layout', $data);
	}

	public function update()
	{
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('judul_penelitian', 'Judul Penelitian', 'trim|required');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');


			if ($this->form_validation->run() == FALSE) {

				$data['edit_penelitian'] = $this->penelitian_model->edit_penelitian($this->input->post('id_penelitian'));
				$data['dosen'] = $this->penelitian_model->dosen();
				$data['view'] = 'penelitian/edit';
				$this->load->view('admin/layout', $data);
			} else {




				if ($_FILES['file_penelitian']['name'] == "") {
					$file_penelitian = $_POST['file_hidden'];
				} else {

					$upload_path = './uploads/penelitian';

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
					$this->upload->do_upload('file_penelitian');
					$penelitian = $this->upload->data();


					$file_penelitian = $upload_path . '/' . $penelitian['file_name'];

					unlink($this->input->post('file_hidden'));
				}

				$tgl_pelaksanaan = explode("/", $this->input->post('tgl_pelaksanaan'));
				$tgl_pelaksanaan = $tgl_pelaksanaan[2] . "-" . $tgl_pelaksanaan[0] . "-" . $tgl_pelaksanaan[1];


				$data = array(

					'judul_penelitian' => $this->input->post('judul_penelitian'),
					'file' => $file_penelitian,
					'lokasi' => $this->input->post('lokasi'),
					'tgl_pelaksanaan' => $tgl_pelaksanaan,
					'deskripsi' => $this->input->post('deskripsi'),
					'id_dosen' => $this->input->post('id_dosen'),
					
					'sumber_dana' => implode(",",$this->input->post('sumber_dana')),
					'dana_internal' => $this->input->post('dana_internal'),
					'dana_eksternal' => $this->input->post('dana_eksternal'),
					'lembaga_eksternal' => $this->input->post('lembaga_eksternal'),

				);

				$where = array('id_penelitian' => $this->input->post('id_penelitian'));

				$data = $this->security->xss_clean($data);
				$result = $this->penelitian_model->update($data, $where);



				if ($result) {
					$this->session->set_flashdata('msg', 'Data telah diUbah!');
					redirect(base_url('admin/penelitian/edit/' . $this->input->post('id_penelitian')));
				}
			}
		}
	}


	public function tambah()
	{
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('judul_penelitian', 'Judul Penelitian', 'trim|required');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');


			if ($this->form_validation->run() == FALSE) {


				$data['dosen'] = $this->penelitian_model->dosen();
				$data['view'] = 'penelitian/tambah';
				$this->load->view('admin/layout', $data);
			} else {

				$upload_path = './uploads/penelitian';

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
				$this->upload->do_upload('file_penelitian');
				$penelitian = $this->upload->data();

				$tgl_pelaksanaan = explode("/", $this->input->post('tgl_pelaksanaan'));
				$tgl_pelaksanaan = $tgl_pelaksanaan[2] . "-" . $tgl_pelaksanaan[0] . "-" . $tgl_pelaksanaan[1];

				$data = array(

					'judul_penelitian' => $this->input->post('judul_penelitian'),
					'date' => date('Y-m-d'),
					'file' => $upload_path . '/' . $penelitian['file_name'],
					'lokasi' => $this->input->post('lokasi'),
					'tgl_pelaksanaan' => $tgl_pelaksanaan,
					'sumber_dana' => implode(",",$this->input->post('sumber_dana')),
					'dana_internal' => $this->input->post('dana_internal'),
					'dana_eksternal' => $this->input->post('dana_eksternal'),
					'lembaga_eksternal' => $this->input->post('lembaga_eksternal'),
					'deskripsi' => $this->input->post('deskripsi'),
					'id_dosen' => $this->input->post('id_dosen'),
					'id_pengupload' => $this->session->userdata('user_id'),
					'id_prodi' => $this->session->userdata('id_prodi'),
					'id_checklist_penilaian' => 0,

				);

				$data = $this->security->xss_clean($data);
				$result = $this->penelitian_model->tambah($data);
				
				$id_penelitian = $this->db->insert_id();		
				
				

				if ($result) {
					$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
					redirect(base_url('admin/penelitian/detail/'.$id_penelitian));
				}
			}
		} else {

			$data['dosen'] = $this->penelitian_model->dosen();
			$data['view'] = 'penelitian/tambah';
			$this->load->view('admin/layout', $data);
		}
	}




	public function update_penelitian()
	{



		$extensions = array("doc", "docx", "xls", "xlsx", "ppt", "pptx", "odt", "rtf", "pdf");
		//$path = 'uploads/penelitian/';

		$path = './uploads/penelitian/';



		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}


		//Upload File Revisi		
		$file_name_sk = $_FILES['file_sk']['name'];
		$file_name_sk = str_replace(" ", "_", $file_name_sk);

		$file_size = $_FILES['file_sk']['size'];
		$file_tmp = $_FILES['file_sk']['tmp_name'];
		$file_type = $_FILES['file_sk']['type'];

		$file_ext_sk = explode('.', $file_name_sk);
		$file_ext_sk = end($file_ext_sk);
		$file_ext_sk = strtolower($file_ext_sk);

		if (in_array($file_ext_sk, $extensions) === false) {
			echo "Maaf File Dokumen Saja Bisa Diupload.";
		} else {
			move_uploaded_file($file_tmp, $path . $file_name_sk);
			echo "Success";

			unlink($this->input->post('file_sk_hidden'));
		}

		if ($file_name_sk == "") {
			$file_sk = $_POST['file_sk_hidden'];
		} else {
			$file_sk = $path . $file_name_sk;
		}
		//Upload File Revisi		




		//Upload File Akhir		
		$file_name_akhir = $_FILES['file_akhir']['name'];
		$file_name_akhir = str_replace(" ", "_", $file_name_akhir);

		$file_size = $_FILES['file_akhir']['size'];
		$file_tmp = $_FILES['file_akhir']['tmp_name'];
		$file_type = $_FILES['file_akhir']['type'];

		$file_ext_akhir = explode('.', $file_name_akhir);
		$file_ext_akhir = end($file_ext_akhir);
		$file_ext_akhir = strtolower($file_ext_akhir);

		if (in_array($file_ext_akhir, $extensions) === false) {
			echo "Maaf File Dokumen Saja Bisa Diupload.";
		} else {
			move_uploaded_file($file_tmp, $path . $file_name_akhir);
			echo "Success";

			unlink($this->input->post('file_akhir_hidden'));
		}

		if ($file_name_akhir == "") {
			$file_akhir = $_POST['file_akhir_hidden'];
		} else {
			$file_akhir = $path . $file_name_akhir;
		}
		//Upload File Akhir		



		echo $file_akhir;


		//exit();









		$input = array(
			'status' => 2,
			'file_sk' => $file_sk,
			'file_akhir' => $file_akhir,
			


		);


		$where = array('id_penelitian' => $_POST['id_penelitian']);

		$input = $this->security->xss_clean($input);

		$proses = $this->penelitian_model->update_penelitian($input, $where);


		if ($proses) {
			$this->session->set_flashdata('msg', 'Data Berhasil Diubah');

			redirect('admin/penelitian/detail/' . $_POST['id_penelitian']);
		}
	}




	public function tambah_kegiatan($id_penelitian)
	{

		$data['id_penelitian'] = $id_penelitian;
		$data['dokumentasi_kegiatan'] = $this->penelitian_model->dokumentasi_kegiatan($id_penelitian);

		$data['view'] = 'penelitian/tambah_kegiatan';
		$this->load->view('admin/layout', $data);
	}



	public function tambah_kegiatan_proses()
	{
		if ($this->input->post('submit')) {


			/*$this->form_validation->set_rules('photo', '', 'callback_file_check');
				
	
				if ($this->form_validation->run() == FALSE) {	
				
				
					$data['id_penelitian'] = $this->input->post('id_penelitian');
					$data['view'] = 'penelitian/tambah_kegiatan';
					$this->load->view('admin/layout', $data);
				}
				else{ */

			$upload_path = './uploads/kegiatan/penelitian';

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
				'photo' => $upload_path . '/' . $penelitian['file_name'],
				'id_penelitian' => $this->input->post('id_penelitian'),
			);

			$data = $this->security->xss_clean($data);
			$result = $this->penelitian_model->tambah_kegiatan_proses($data);

			if ($result) {
				$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
				redirect(base_url('admin/penelitian/tambah_kegiatan/' . $this->input->post('id_penelitian')));
			}

			//} 

		}
	}




	public function hapus_kegiatan($id)
	{
		$this->db->delete('dokumentasi_kegiatan', array('id_dokumentasi' => $id));
		$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
		redirect(base_url('admin/penelitian/tambah_kegiatan/' . $id));
	}




	public function hapus($id = 0, $uri = NULL)
	{
		$this->db->delete('penelitian', array('id_penelitian' => $id));
		$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
		redirect(base_url('admin/penelitian/index'));
	}
} //class

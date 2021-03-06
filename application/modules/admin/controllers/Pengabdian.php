<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengabdian extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pengabdian_model', 'pengabdian_model');
	}

	public function index($status = 0)
	{

		// periksa kategori
		$status = ($status != '') ? $status : '';

		$data['pengabdian'] = $this->pengabdian_model->get_pengabdian($status);

		$data['view'] = 'pengabdian/index'; //lokasinya di /modules/pengabdian/views
		$this->load->view('admin/layout', $data);
	}

	public function detail($id_pengabdian)
	{

		$data['view'] = 'pengabdian/detail'; //lokasinya di /modules/pengabdian/views

		$data['dokumentasi_kegiatan'] = $this->pengabdian_model->dokumentasi_kegiatan($id_pengabdian);
		$data['detail_pengabdian'] = $this->pengabdian_model->detail_pengabdian($id_pengabdian);

		$this->load->view('admin/layout', $data);
	}



	public function edit($id_pengabdian)
	{



		$data['edit_pengabdian'] = $this->pengabdian_model->edit_pengabdian($id_pengabdian);
		$data['dosen'] = $this->pengabdian_model->dosen();
		$data['view'] = 'pengabdian/edit';
		$this->load->view('admin/layout', $data);
	}



	public function update()
	{

		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('judul_pengabdian', 'Judul Pengabdian', 'trim|required');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');


			if ($this->form_validation->run() == FALSE) {

				$data['edit_pengabdian'] = $this->pengabdian_model->edit_pengabdian($this->input->post('id_pengabdian'));
				$data['dosen'] = $this->pengabdian_model->dosen();
				$data['view'] = 'pengabdian/edit';
				$this->load->view('admin/layout', $data);
			} else {




				if ($_FILES['file_pengabdian']['name'] == "") {
					$file_pengabdian = $_POST['file_hidden'];
				} else {

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


					$file_pengabdian = $upload_path . '/' . $pengabdian['file_name'];

					unlink($this->input->post('file_hidden'));
				}

				$tgl_pelaksanaan = explode("/", $this->input->post('tgl_pelaksanaan'));
				$tgl_pelaksanaan = $tgl_pelaksanaan[2] . "-" . $tgl_pelaksanaan[0] . "-" . $tgl_pelaksanaan[1];


				$data = array(

					'judul_pengabdian' => $this->input->post('judul_pengabdian'),
					'file' => $file_pengabdian,
					'lokasi' => $this->input->post('lokasi'),
					'tgl_pelaksanaan' => $tgl_pelaksanaan,
					'deskripsi' => $this->input->post('deskripsi'),
					'id_dosen' => $this->input->post('id_dosen'),

					'sumber_dana' => implode(",", $this->input->post('sumber_dana')),
					'dana_internal' => $this->input->post('dana_internal'),
					'dana_eksternal' => $this->input->post('dana_eksternal'),
					'lembaga_eksternal' => $this->input->post('lembaga_eksternal'),

				);

				$where = array('id_pengabdian' => $this->input->post('id_pengabdian'));

				$data = $this->security->xss_clean($data);
				$result = $this->pengabdian_model->update($data, $where);



				if ($result) {
					$this->session->set_flashdata('msg', 'Data telah diUbah!');
					redirect(base_url('admin/pengabdian/edit/' . $this->input->post('id_pengabdian')));
				}
			}
		}
	}




	public function tambah()
	{
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('judul_pengabdian', 'Judul Pengabdian', 'trim|required');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');


			if ($this->form_validation->run() == FALSE) {


				$data['dosen'] = $this->pengabdian_model->dosen();
				$data['view'] = 'pengabdian/tambah';
				$this->load->view('admin/layout', $data);
			} else {

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



				$tgl_pelaksanaan = explode("/", $this->input->post('tgl_pelaksanaan'));
				$tgl_pelaksanaan = $tgl_pelaksanaan[2] . "-" . $tgl_pelaksanaan[0] . "-" . $tgl_pelaksanaan[1];





				$data = array(

					'judul_pengabdian' => $this->input->post('judul_pengabdian'),
					'date' => date('Y-m-d'),
					'file' => $upload_path . '/' . $pengabdian['file_name'],
					'lokasi' => $this->input->post('lokasi'),
					'tgl_pelaksanaan' => $tgl_pelaksanaan,
					'sumber_dana' => implode(",", $this->input->post('sumber_dana')),
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
				$result = $this->pengabdian_model->tambah($data);


				$id_pengabdian = $this->db->insert_id();

				if ($result) {
					$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
					redirect(base_url('admin/pengabdian/detail/' . $id_pengabdian));
				}
			}
		} else {

			$data['dosen'] = $this->pengabdian_model->dosen();
			$data['view'] = 'pengabdian/tambah';
			$this->load->view('admin/layout', $data);
		}
	}




	public function update_pengabdian()
	{



		$extensions = array("doc", "docx", "xls", "xlsx", "ppt", "pptx", "odt", "rtf", "pdf");
		//$path = 'uploads/pengabdian/';

		$path = './uploads/pengabdian/';



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


		$where = array('id_pengabdian' => $_POST['id_pengabdian']);

		$input = $this->security->xss_clean($input);

		$proses = $this->pengabdian_model->update_pengabdian($input, $where);


		if ($proses) {
			$this->session->set_flashdata('msg', 'Data Berhasil Diubah');

			redirect('admin/pengabdian/detail/' . $_POST['id_pengabdian']);
		}
	}



	public function tambah_kegiatan($id_pengabdian)
	{

		$data['id_pengabdian'] = $id_pengabdian;
		$data['dokumentasi_kegiatan'] = $this->pengabdian_model->dokumentasi_kegiatan($id_pengabdian);

		$data['view'] = 'pengabdian/tambah_kegiatan';
		$this->load->view('admin/layout', $data);
	}



	public function tambah_kegiatan_proses()
	{
		if ($this->input->post('submit')) {


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
				'photo' => $upload_path . '/' . $pengabdian['file_name'],
				'id_pengabdian' => $this->input->post('id_pengabdian'),
			);

			$data = $this->security->xss_clean($data);
			$result = $this->pengabdian_model->tambah_kegiatan_proses($data);

			if ($result) {
				$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
				redirect(base_url('admin/pengabdian/tambah_kegiatan/' . $this->input->post('id_pengabdian')));
			}

			//} 

		}
	}




	public function hapus_kegiatan($id)
	{
		$this->db->delete('dokumentasi_kegiatan', array('id_dokumentasi' => $id));
		$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
		redirect(base_url('admin/pengabdian/tambah_kegiatan/' . $id));
	}

	public function hapus($id = 0, $uri = NULL)
	{
		$this->db->update('pengabdian', array('status' => '1'), array('id_pengabdian' => $id));
		$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
		redirect(base_url('admin/pengabdian/index'));
	}

	public function restore($id = 0, $uri = NULL)
	{
		$this->db->update('pengabdian', array('status' => '0'), array('id_pengabdian' => $id));
		$this->session->set_flashdata('msg', 'Data berhasil direstore!');
		redirect(base_url('admin/pengabdian/index'));
	}
	public function tambah_dokumen($kat = 0, $id_pengabdian = 0)
	{

		$data['id_pengabdian'] = $id_pengabdian;
		$data['kat'] = $kat;
		$data['dokumentasi_kegiatan'] = $this->pengabdian_model->dokumentasi_kegiatan($id_pengabdian);

		$data['view'] = 'pengabdian/tambah_dokumen';
		$this->load->view('admin/layout', $data);
	}


	public function tambah_dokumen_proses()
	{
		if ($this->input->post('submit')) {


			$upload_path = './uploads/dokumen/pengabdian';

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
			$pengabdian = $this->upload->data();
			$file = $upload_path . '/' . $pengabdian['file_name'];
			$kat =  $this->input->post('kat');

			$this->db->where('id_pengabdian', $this->input->post('id_pengabdian'));
			$result = $this->db->update('pengabdian', array($kat => $file));

			if ($result) {
				$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
				redirect(base_url('admin/pengabdian/detail/' . $this->input->post('id_pengabdian')));
			}
		}
	}

	public function hapus_dokumen($id)
	{
		$this->db->delete('dokumentasi_kegiatan', array('id_dokumentasi' => $id));
		$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
		redirect(base_url('admin/pengabdian/tambah_kegiatan/' . $id));
	}

} //class

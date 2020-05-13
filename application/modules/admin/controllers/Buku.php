<?php defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('buku_model', 'buku_model');
		$this->load->library('barcode');
	}

	public function index($status = 0)
	{

		// periksa kategori
		$status = ($status != '') ? $status : '';

		$data['buku'] = $this->buku_model->get_buku($status);

		$data['view'] = 'buku/index'; //lokasinya di /modules/Penelitian/views
		$this->load->view('admin/layout', $data);
	}

	public function detail($id_buku)
	{
	
		$data['view'] = 'buku/detail'; //lokasinya di /modules/Penelitian/views
		$data['dokumentasi_kegiatan'] = $this->buku_model->dokumentasi_kegiatan($id_buku);
		$data['detail_buku'] = $this->buku_model->detail_buku($id_buku);

		$generator = new Barcode();

		$symbology='ean-13-nopad';
		$options = array('sy'=> '0.6', 'p'=> '0', 'pv'=> '6');
		$isbn = $generator->render_svg($symbology, $this->buku_model->detail_buku($id_buku)->row()->isbn, $options);

		$data['isbn'] = $isbn;
		$this->load->view('admin/layout', $data);
	}

	public function tambah()
	{
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('judul_buku', 'Judul buku', 'trim|required');
			$this->form_validation->set_rules('id_kategori_buku', 'Kategori Buku', 'trim|required');
			$this->form_validation->set_rules('id_dosen', 'Dosen', 'trim|required');
			$this->form_validation->set_rules('isbn', 'ISBN', 'trim|required');
			$this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['dosen'] = $this->buku_model->dosen();
				$data['view'] = 'buku/tambah';
				$this->load->view('admin/layout', $data);
			} else {

				$upload_path = './uploads/buku';

				if (!is_dir($upload_path)) {
					mkdir($upload_path, 0777, TRUE);
				}
				//$newName = "hrd-".date('Ymd-His');
				$config = array(
					'upload_path' => $upload_path,
					'allowed_types' => "pdf",
					'overwrite' => FALSE,
				);

				$this->load->library('upload', $config);
				$this->upload->do_upload('file_buku');
				$buku = $this->upload->data();
				$data = array(

					'judul_buku' 		=> $this->input->post('judul_buku'),
					'date' 				=> date('Y-m-d'),
					'file' 				=> $upload_path . '/' . $buku['file_name'],
					'deskripsi' 		=> $this->input->post('deskripsi'),
					'id_dosen' 			=> $this->input->post('id_dosen'),
					'id_pengupload'		=> $this->session->userdata('user_id'),
					'id_prodi' 			=> $this->session->userdata('id_prodi'),
					'kategori_buku' 	=> $this->input->post('id_kategori_buku'),
					'isbn' 				=> $this->input->post('isbn'),
					'penerbit' 			=> $this->input->post('penerbit'),

				);

				$data = $this->security->xss_clean($data);
				$result = $this->buku_model->tambah($data);

				if ($result) {
					$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
					redirect(base_url('admin/buku/'));
				}
			}
		} else {

			$data['dosen'] = $this->buku_model->dosen();
			$data['view'] = 'buku/tambah';
			$this->load->view('admin/layout', $data);
		}
	}

	


	

	public function tambah_kegiatan($id_buku)
	{
		$data['id_buku'] = $id_buku;
		$data['dokumentasi_kegiatan'] = $this->buku_model->dokumentasi_kegiatan($id_buku);
		$data['view'] = 'buku/tambah_kegiatan';
		$this->load->view('admin/layout', $data);
	}

	public function tambah_kegiatan_proses()
	{
		if ($this->input->post('submit')) {

			$upload_path = './uploads/kegiatan/buku';

			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0777, TRUE);
			}

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
				'photo' => $upload_path . '/' . $buku['file_name'],
				'id_buku' => $this->input->post('id_buku'),
			);

			$data = $this->security->xss_clean($data);
			$result = $this->buku_model->tambah_kegiatan_proses($data);

			if ($result) {
				$this->session->set_flashdata('msg', 'Data telah ditambahkan!');
				redirect(base_url('admin/buku/tambah_kegiatan/' . $this->input->post('id_buku')));
			}		

		}
	}

	public function hapus_kegiatan($id)
	{
		$this->db->delete('dokumentasi_kegiatan', array('id_dokumentasi' => $id));
		$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
		redirect(base_url('admin/buku/tambah_kegiatan/' . $id));
	}

	public function hapus($id = 0, $uri = NULL)
	{
		$this->db->update('buku', array('status' => '1'), array('id_buku' => $id));
		$this->session->set_flashdata('msg', 'Data berhasil dihapus!');
		redirect(base_url('admin/buku/index'));
	}

	public function restore($id = 0, $uri = NULL)
	{
		$this->db->update('buku', array('status' => '0'), array('id_buku' => $id));
		$this->session->set_flashdata('msg', 'Data berhasil direstore!');
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

					'judul_buku' => 	$this->input->post('judul_buku'),
					'file' => 			$file_buku,
					'deskripsi' => 		$this->input->post('deskripsi'),
					'id_dosen' => 		$this->input->post('id_dosen'),
					'kategori_buku' => 	$this->input->post('id_kategori_buku'),
					'kategori_buku' => 	$this->input->post('id_kategori_buku'),
					'isbn' => 			$this->input->post('isbn'),
					'penerbit' => 		$this->input->post('penerbit'),

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

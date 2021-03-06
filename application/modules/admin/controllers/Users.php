<?php defined('BASEPATH') or exit('No direct script access allowed');
class Users extends Mimin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('admin/profile_model', 'profile_model');
		$this->load->model('admin/prodi_model', 'prodi_model');
		$this->load->model('admin/user_model', 'user_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->library('excel');
	}

	public function index($role = 0)
	{
		// periksa kategori
		$role = ($role != '') ? $role : '';

		$data['role'] = $role;
		$data['users'] = $this->user_model->get_users($role);
		$data['count_all'] = $this->user_model->count_all_users_by_role('');
		$data['count_admin'] = $this->user_model->count_all_users_by_role(1);
		$data['count_tu'] = $this->user_model->count_all_users_by_role(2);
		$data['count_reviewer'] = $this->user_model->count_all_users_by_role(3);
		$data['count_dosen'] = $this->user_model->count_all_users_by_role(4);
		$data['view'] = 'users/user_list'; //lokasinya di /modules/Penelitian/views

		$this->load->view('admin/layout', $data);
	}


	public function add()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			//$this->form_validation->set_rules('role', 'Role', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['prodi'] = $this->prodi_model->get_all_prodi();
				$data['view'] = 'admin/users/user_add';
				$this->load->view('layout', $data);
			} else {

				$upload_path = './uploads/fotoProfil';

				if (!is_dir($upload_path)) {
					mkdir($upload_path, 0777, TRUE);
				}
				//$newName = "hrd-".date('Ymd-His');
				$config = array(
					'upload_path' => $upload_path,
					'allowed_types' => "jpg|png|jpeg",
					'overwrite' => FALSE,
				);

				$this->load->library('upload', $config);
				$this->upload->do_upload('foto_profil');
				$foto_profil = $this->upload->data();

				$data = array(
					'username' => $this->input->post('username'),
					'firstname' => $this->input->post('firstname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'id_prodi' => $this->input->post('id_prodi'),
					'is_admin' => $this->input->post('is_admin'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
					'is_verify' => 1,
					'is_active' => 1,
					'photo' => $upload_path . '/' . $foto_profil['file_name'],
				);

				$data = $this->security->xss_clean($data);
				$result = $this->user_model->add_user($data);
				if ($result) {
					$this->session->set_flashdata('msg', 'Pengguna berhasil ditambahkan!');
					redirect(base_url('admin/users'));
				}
			}
		} else {
			$data['prodi'] = $this->prodi_model->get_all_prodi();
			$data['view'] = 'admin/users/user_add';
			$this->load->view('layout', $data);
		}
	}

	public function edit($id = 0)
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('firstname', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->user_model->get_user_by_id($id);
				$data['view'] = 'admin/users/user_edit';
				$this->load->view('layout', $data);
			} else {

				$upload_path = './uploads/fotoProfil';

				if (!is_dir($upload_path)) {
					mkdir($upload_path, 0777, TRUE);
				}

				$config = array(
					'upload_path' => $upload_path,
					'allowed_types' => "jpg|png|jpeg",
					'overwrite' => FALSE,
				);

				$this->load->library('upload', $config);
				$this->upload->do_upload('foto_profil');
				$foto_profil = $this->upload->data();

				$data = array(
					'username' => $this->input->post('username'),
					'firstname' => $this->input->post('firstname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'is_admin' => $this->input->post('is_admin'),
					'id_prodi' => $this->input->post('id_prodi'),
					'password' => ($this->input->post('password') !== "" ? password_hash($this->input->post('password'), PASSWORD_BCRYPT) : $this->input->post('password_hidden')),
					'updated_at' => date('Y-m-d : h:m:s'),
					'photo' => ($foto_profil['file_name']) !== "" ? $upload_path . '/' . $foto_profil['file_name'] : $this->input->post('foto_profil_hidden'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->user_model->edit_user($data, $id);

				if ($result) {
					$this->session->set_flashdata('msg', 'Pengguna berhasil diubah!');
					redirect(base_url('admin/users/edit/'.$id));
				}
				
			}
		} else {
			$data['prodi'] = $this->prodi_model->get_all_prodi();
			$data['user'] = $this->user_model->get_user_by_id($id);
			$data['view'] = 'admin/users/user_edit';
			$this->load->view('layout', $data);
		}
	}

	public function detail($id = 0)
	{
		$data['user'] = $this->user_model->get_user_by_id($id);

		$data['view'] = 'admin/users/detail';
		$this->load->view('layout', $data);
	}

	public function del($id = 0)
	{
		$this->db->delete('ci_users', array('id' => $id));
		$this->session->set_flashdata('msg', 'Pengguna berhasil dihapus!');
		redirect(base_url('admin/users'));
	}

	public function upload()
	{

		if (isset($_POST['submit'])) {

			$upload_path = './uploads/users';

			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0777, TRUE);
			}
		
			$config = array(
				'upload_path' => $upload_path,
				'allowed_types' => "xlsx",
				'overwrite' => FALSE,
			);

			$this->load->library('upload', $config);
			$this->upload->do_upload('file');
			$upload = $this->upload->data();


			if ($upload) { // Jika proses upload sukses			    	

				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('./uploads/users/' . $upload['file_name']); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

				$data['sheet'] = $sheet;
				$data['file_excel'] = $upload['file_name'];

				$data['title'] = 'Upload Pengguna';
				$data['view'] = 'admin/users/upload';
			
				$this->load->view('layout', $data);
			} else {
	
				$data['title'] = 'Upload Pengguna';
				$data['view'] = 'admin/users/upload';
				$this->load->view('layout', $data);
			}
		} else {
			
			$data['title'] = 'Upload Pengguna';
			$data['view'] = 'admin/users/upload';
			$this->load->view('layout', $data);
		}
	}

	public function import($file_excel)
	{

		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('./uploads/users/' . $file_excel); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

		$data2 = array();

			$numrow = 1;
			foreach ($sheet as $row) {

				if ($numrow > 1) {

					$id_prodi = $this->db->get_where('prodi',array('singkatan'=> $row['D']))->row()->id_prodi;
				
					// Kita push (add) array data ke variabel data
					array_push($data2, array(
						'password' => password_hash($row['A'], PASSWORD_BCRYPT), 
						'username' => $row['A'], 						
						'firstname' => $row['B'], 						
						'email' => $row['C'],
						'id_prodi' => $id_prodi,
						'is_admin' => $row['E'],
						'created_at' => date('Y-m-d : h:m:s'),						
					));
				}

				$numrow++; // Tambah 1 setiap kali looping
			}

		// Panggil fungsi insert_pengguna
		$this->user_model->import_users($data2);

		redirect("admin/users"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
}

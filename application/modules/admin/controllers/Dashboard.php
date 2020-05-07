<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends Admin_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('admin/dashboard_model', 'dashboard_model');
			$this->load->model('dashboard_model');
		}

		public function index(){
			
			
			$data['jumlah_penelitian'] = $this->dashboard_model->jumlah_penelitian();
			$data['jumlah_publikasi'] = $this->dashboard_model->jumlah_publikasi();
			$data['jumlah_pengabdian'] = $this->dashboard_model->jumlah_pengabdian();
			$data['jumlah_buku'] = $this->dashboard_model->jumlah_buku();
			$data['jumlah_haki'] = $this->dashboard_model->jumlah_haki();
			
			$data['title'] = 'Dashboard Admin';
			$data['view'] = 'admin/dashboard/index';
			$this->load->view('layout', $data);
		}
		
	}

?>	
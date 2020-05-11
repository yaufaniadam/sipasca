<?php defined('BASEPATH') or exit('No direct script access allowed');
class Prodi extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
      //  $this->load->model('prodi_model', 'prodi_model');
    }

    public function index()
    {
        $this->db->order_by('singkatan','ASC');  
        $prodi = $this->db->get('prodi')->result_array();  
        $data['prodi'] = $prodi;
        $data['view'] = 'prodi/index'; 
        $this->load->view('admin/layout', $data);
    }

    public function edit($id_prodi)
    {
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('prodi', 'Nama Program Studi', 'trim|required');
            $this->form_validation->set_rules('singkatan', 'Kode Prodi', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
             
                $prodi = $this->db->get_where('prodi',array('id_prodi'=>$id_prodi))->row_array();  
                $data['prodi'] = $prodi;
                $data['view'] = 'prodi/edit';
                $this->load->view('admin/layout', $data);
            } else {

                $data = array(
                    'prodi'         => $this->input->post('prodi'),
                    'singkatan'     => $this->input->post('singkatan'),
                );

                $data = $this->security->xss_clean($data);
                $this->db->where('id_prodi', $id_prodi );
                $result =  $this->db->update('prodi', $data );

                if ($result) {
                    $this->session->set_flashdata('msg', 'Data telah diedit!');
                    redirect(base_url('admin/prodi/edit/'.$id_prodi));
                }
            }
        } else {
            $prodi = $this->db->get_where('prodi',array('id_prodi'=>$id_prodi))->row_array(); 
            $data['prodi'] = $prodi;
            $data['view'] = 'prodi/edit';
            $this->load->view('admin/layout', $data);
        }
    }
} //class

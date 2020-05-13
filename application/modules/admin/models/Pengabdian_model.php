<?php
	class Pengabdian_model extends CI_Model{	
		
		public function get_pengabdian($status){
			
			
			 if($this->session->userdata('id_prodi')==0)
			{
			
			$this->db->select('pengabdian.*,ci_users.firstname ,prodi.prodi');
			$this->db->from('pengabdian');	
			$this->db->join('ci_users', 'ci_users.id = pengabdian.id_dosen ', 'left');
			$this->db->join('prodi', 'prodi.id_prodi = pengabdian.id_prodi ', 'left');
			

			//cek pada url jika kategorinya kosong, maka menampilkan semua penelitian, jika ada isinya maka menampilkan sesuai isinya
			//http://localhost/sipasca/penelitian/[kategorinya] 

			if($status != '') {		
				$this->db->where('status', $status);
			} else {
				$this->db->where('status', 0);
			}
			$this->db->order_by('id_pengabdian', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();	
					
			}
			
			
			elseif($this->session->userdata('is_admin')==4)
			{
		
			$this->db->select('pengabdian.*,ci_users.firstname');
			$this->db->from('pengabdian');	
			$this->db->join('ci_users', 'ci_users.id = pengabdian.id_dosen ', 'left');
			
			$this->db->where('pengabdian.id_dosen', $this->session->userdata('user_id'));
			if($status != '') {		
				$this->db->where('status', $status);
			} else {
				$this->db->where('status', 0);
			}	
			$this->db->order_by('id_pengabdian', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();	
			
			}
			
			else
			{
		
			$this->db->select('pengabdian.*,ci_users.firstname');
			$this->db->from('pengabdian');	
			$this->db->join('ci_users', 'ci_users.id = pengabdian.id_dosen ', 'left');
			
			$this->db->where('pengabdian.id_prodi', $this->session->userdata('id_prodi'));
			if($status != '') {		
				$this->db->where('status', $status);
			} else {
				$this->db->where('status', 0);
			}	
			$this->db->order_by('id_pengabdian', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();	
			
			}
			
			}
		
		
		
		
			public function detail_pengabdian($id_pengabdian)
			{
			return $this->db->query("select a.*,b.prodi, c.firstname as nama_dosen , c.photo, d.firstname as nama_pengupload from pengabdian a
		
			left join prodi b on a.id_prodi=b.id_prodi
		
			left join ci_users c on a.id_dosen=c.id
		
			left join ci_users d on a.id_pengupload=d.id

		  	where a.id_pengabdian='$id_pengabdian' ");

	
			}
			
		
			public function edit_pengabdian($id_pengabdian)
			{
			return $this->db->query("select * from pengabdian 	where id_pengabdian='$id_pengabdian' ");

			}
			
			
			//edit pencil
			public function update($data, $where)
			{
			return $this->db->update('pengabdian', $data, $where);
			}	
					
		
			public function dokumentasi_kegiatan($id_pengabdian)
			{
			return $this->db->query("select * from dokumentasi_kegiatan  where id_pengabdian='$id_pengabdian' ");

			}
		
		
			public function update_pengabdian($data, $where)
			{
			return $this->db->update('pengabdian', $data, $where);
			}		
		
		
			public function dosen()
			{
		 	if($this->session->userdata('id_prodi')==0)
			{	
			return $this->db->query("select * from ci_users  where is_admin=4 ");
			}
			else
			{
			return $this->db->query("select * from ci_users  where is_admin=4 and id_prodi='".$this->session->userdata('id_prodi')."'");
			}

			}
	
			public function tambah($data){
				return $this->db->insert('pengabdian', $data);
			}
			
			public function tambah_kegiatan_proses($data){
				return $this->db->insert('dokumentasi_kegiatan', $data);
			}
		
		
		
		
	}

?>
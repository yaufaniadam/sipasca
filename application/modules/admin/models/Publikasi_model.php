<?php
	class Publikasi_model extends CI_Model{	
		
		public function publikasi($status){
			
			
			 if($this->session->userdata('id_prodi')==0)
			{
			
			$this->db->select('publikasi.*,ci_users.firstname ,prodi.prodi');
			$this->db->from('publikasi');	
			$this->db->join('ci_users', 'ci_users.id = publikasi.id_dosen ', 'left');
			$this->db->join('prodi', 'prodi.id_prodi = publikasi.id_prodi ', 'left');
			

			//cek pada url jika kategorinya kosong, maka menampilkan semua penelitian, jika ada isinya maka menampilkan sesuai isinya
			//http://localhost/sipasca/penelitian/[kategorinya] 

			/*if($status != '') {		
				$this->db->where('status', $status);
			}*/
			$this->db->order_by('id_publikasi', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();	
					
			}
			
			
			elseif($this->session->userdata('is_admin')==4)
			{
		
			$this->db->select('publikasi.*,ci_users.firstname');
			$this->db->from('publikasi');	
			$this->db->join('ci_users', 'ci_users.id = publikasi.id_dosen ', 'left');
			
			$this->db->where('publikasi.id_dosen', $this->session->userdata('user_id'));

			$this->db->order_by('id_publikasi', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();	
			
			}
			
			
			
			
			else
			{
		
			$this->db->select('publikasi.*,ci_users.firstname');
			$this->db->from('publikasi');	
			$this->db->join('ci_users', 'ci_users.id = publikasi.id_dosen ', 'left');
			
			$this->db->where('publikasi.id_prodi', $this->session->userdata('id_prodi'));

			$this->db->order_by('id_publikasi', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();	
			
			}
			
			}
		
		
		
		
			public function detail_publikasi($id_publikasi)
			{
			return $this->db->query("select a.*,b.prodi, c.firstname as nama_dosen , c.photo, d.firstname as nama_pengupload, 
			
			e.jenis_publikasi, f.sub_jenis_publikasi
			
			
			from publikasi a
		
			left join prodi b on a.id_prodi=b.id_prodi
		
			left join ci_users c on a.id_dosen=c.id
		
			left join ci_users d on a.id_pengupload=d.id

			left join jenis_publikasi e on a.id_jenis_publikasi=e.id_jenis_publikasi
			
			left join sub_jenis_publikasi f on a.id_sub_jenis_publikasi=f.id_sub_jenis_publikasi
			
			

		  	where a.id_publikasi ='$id_publikasi' ");

	
			}
		
		
			public function dokumentasi_kegiatan($id_publikasi)
			{
			return $this->db->query("select * from dokumentasi_kegiatan  where id_publikasi='$id_publikasi' ");

			}
		
		
			public function update_publikasi($data, $where)
			{
			return $this->db->update('publikasi', $data, $where);
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
				return $this->db->insert('publikasi', $data);
			}
			
			public function tambah_kegiatan_proses($data){
				return $this->db->insert('dokumentasi_kegiatan', $data);
			}
		
		
		
		
	}

?>
<?php
class Haki_model extends CI_Model
{

	public function get_haki($status)
	{
		if ($this->session->userdata('id_prodi') == 0) {

			$this->db->select('haki.*,ci_users.firstname ,prodi.prodi');
			$this->db->from('haki');
			$this->db->join('ci_users', 'ci_users.id = haki.id_dosen ', 'left');
			$this->db->join('prodi', 'prodi.id_prodi = haki.id_prodi ', 'left');

			if($status != '') {		
				$this->db->where('status', $status);
			} else {
				$this->db->where('status', 0);
			}

			$this->db->order_by('id_haki', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();
		} elseif ($this->session->userdata('is_admin') == 4) {

			$this->db->select('haki.*,ci_users.firstname');
			$this->db->from('haki');
			$this->db->join('ci_users', 'ci_users.id = haki.id_dosen ', 'left');

			$this->db->where('haki.id_dosen', $this->session->userdata('user_id'));

			if($status != '') {		
				$this->db->where('status', $status);
			} else {
				$this->db->where('status', 0);
			}

			$this->db->order_by('id_haki', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();
		} else {

			$this->db->select('haki.*,ci_users.firstname');
			$this->db->from('haki');
			$this->db->join('ci_users', 'ci_users.id = haki.id_dosen ', 'left');

			$this->db->where('haki.id_prodi', $this->session->userdata('id_prodi'));

			if($status != '') {		
				$this->db->where('status', $status);
			} else {
				$this->db->where('status', 0);
			}
			
			$this->db->order_by('id_haki', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();
		}
	}




	public function detail_haki($id_haki)
	{
		return $this->db->query("select a.*,b.prodi, c.firstname as nama_dosen , c.photo, d.firstname as nama_pengupload, e.kategori_haki 
			
			
			from haki a
		
			left join prodi b on a.id_prodi=b.id_prodi
		
			left join ci_users c on a.id_dosen=c.id
		
			left join ci_users d on a.id_pengupload=d.id
			
			left join kategori_haki e on a.id_kategori_haki=e.id_kategori_haki
			
			

		  	where a.id_haki='$id_haki' ");
	}




	public function edit_haki($id_haki)
	{
		return $this->db->query("select * from haki 	where id_haki='$id_haki' ");
	}




	public function dokumentasi_kegiatan($id_haki)
	{
		return $this->db->query("select * from dokumentasi_kegiatan  where id_haki='$id_haki' ");
	}


	public function update_haki($data, $where)
	{
		return $this->db->update('haki', $data, $where);
	}

	//edit pencil
	public function update($data, $where)
	{
		return $this->db->update('haki', $data, $where);
	}

	public function dosen()
	{
		if ($this->session->userdata('id_prodi') == 0) {
			return $this->db->query("select * from ci_users  where is_admin=4 ");
		} else {
			return $this->db->query("select * from ci_users  where is_admin=4 and id_prodi='" . $this->session->userdata('id_prodi') . "'");
		}
	}

	public function tambah($data)
	{
		return $this->db->insert('haki', $data);
	}

	public function tambah_kegiatan_proses($data)
	{
		return $this->db->insert('dokumentasi_kegiatan', $data);
	}
}

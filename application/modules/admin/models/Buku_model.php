<?php
class Buku_model extends CI_Model
{

	public function get_buku($status)
	{


		if ($this->session->userdata('id_prodi') == 0) {

			$this->db->select('buku.*,ci_users.firstname ,prodi.prodi');
			$this->db->from('buku');
			$this->db->join('ci_users', 'ci_users.id = buku.id_dosen ', 'left');
			$this->db->join('prodi', 'prodi.id_prodi = buku.id_prodi ', 'left');

			if ($status != '') {
				$this->db->where('status', $status);
			} else {
				$this->db->where('status', 0);
			}
			$this->db->order_by('id_buku', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();
		} elseif ($this->session->userdata('is_admin') == 4) {

			$this->db->select('buku.*,ci_users.firstname');
			$this->db->from('buku');
			$this->db->join('ci_users', 'ci_users.id = buku.id_dosen ', 'left');
			if ($status != '') {
				$this->db->where('status', $status);
			} else {
				$this->db->where('status', 0);
			}
			$this->db->where('buku.id_dosen', $this->session->userdata('user_id'));

			$this->db->order_by('id_buku', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();
		} else {

			$this->db->select('buku.*,ci_users.firstname');
			$this->db->from('buku');
			$this->db->join('ci_users', 'ci_users.id = buku.id_dosen ', 'left');
			if ($status != '') {
				$this->db->where('status', $status);
			} else {
				$this->db->where('status', 0);
			}
			$this->db->where('buku.id_prodi', $this->session->userdata('id_prodi'));

			$this->db->order_by('id_buku', 'ASC');
			$query = $this->db->get();

			return $result = $query->result_array();
		}
	}

	public function detail_buku($id_buku)
	{
		return $this->db->query("select a.*,b.prodi, c.firstname as nama_dosen , c.photo, d.firstname as nama_pengupload from buku a
		
			left join prodi b on a.id_prodi=b.id_prodi
		
			left join ci_users c on a.id_dosen=c.id
		
			left join ci_users d on a.id_pengupload=d.id

		  	where a.id_buku='$id_buku' ");
	}


	public function dokumentasi_kegiatan($id_buku)
	{
		return $this->db->query("select * from dokumentasi_kegiatan  where id_buku='$id_buku' ");
	}


	public function update_buku($data, $where)
	{
		return $this->db->update('buku', $data, $where);
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
		return $this->db->insert('buku', $data);
	}

	public function tambah_kegiatan_proses($data)
	{
		return $this->db->insert('dokumentasi_kegiatan', $data);
	}


	public function edit_buku($id_buku)
	{
		return $this->db->query("select * from buku 	where id_buku='$id_buku' ");
	}

	
}

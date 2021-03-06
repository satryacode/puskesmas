<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategorittu extends CI_Model {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	function getAll()
	{
		$data = $this->db->select('kategori.*, petugas.NamaPetugas')
						 ->from('tbkes_ttu_kategori kategori')
						 ->join('tbpetugas petugas', 'kategori.IdPetugas = petugas.IdPetugas')
						 ->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		}
		else
		{
			return false;
		}
	}

	function getById($id)
	{
		$data = $this->db->select('*')
						 ->from('tbkes_ttu_kategori')
						 ->where('IdKategoriTtu', $id)
						 ->get();
		if ($data->num_rows() > 0) {
			return $data->row();
		}
		else
		{
			return false;
		}
	}

	function simpan($data)
	{
		$cek = $this->db->select('KategoriTtu')
						->from('tbkes_ttu_kategori')
						->where('KategoriTtu', $data['KategoriTtu'])
						->get();
		if ($cek->num_rows() > 0){
			return 'sama';
		}else{
			$result = $this->db->insert('tbkes_ttu_kategori', $data);
			return $result;
		}
	}

	function rubah($data, $id)
	{
		$cek = $this->db->select('KategoriTtu')
						->from('tbkes_ttu_kategori')
						->where('KategoriTtu', $data['KategoriTtu'])
						->where('IdKategoriTtu !=', $id)
						->get();
		if ($cek->num_rows() > 0){
			return 'sama';
		}else{
			$result = $this->db->where('IdKategoriTtu', $id)->update('tbkes_ttu_kategori', $data);
			return $result;
		}
	}



	function hapus($id)
	{
		$qry = $this->db->where('IdKategoriTtu', $id)->delete('tbkes_ttu_kategori');
		return $qry;
	}
	

}

/* End of file m_kategorittu.php */
/* Location: ./application/models/m_kategorittu.php */
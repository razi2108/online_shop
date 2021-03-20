<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keranjang_model extends CI_Model {

	public function get_produk_all()
	{
		$query = $this->db->get('produk');
		return $query->result_array();
	}
	
	public function get_produk_kategori($kategori)
	{
		$this->db->where('kategori',$kategori);
		$query = $this->db->get('produk');
		return $query->result_array();
	}

	public function get_pelanggan($user)
	{
		$this->db->where('username',$user);
		$query = $this->db->get('user');
		return $query->result();
	}
	
	public function get_kategori_all()
	{
		$query = $this->db->get('jenis_pakaian');
		return $query->result_array();
	}
	
	public  function get_produk_id($id)
	{
		$this->db->select('produk.*');
		$this->db->from('produk');
		$this->db->join('jenis_pakaian', 'kategori=jenis_pakaian.jenis','left');
   		$this->db->where('produk.id',$id);
        return $this->db->get();
    }	
	
	public function tambah_pelanggan($data)
	{
		$this->db->insert('tbl_pelanggan', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function tambah_order($data)
	{
		$this->db->insert('tbl_order', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function tambah_detail_order($data)
	{
		$this->db->insert('detail_order', $data);
	}
}
?>
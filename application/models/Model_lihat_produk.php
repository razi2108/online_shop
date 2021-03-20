<?php
	class Model_lihat_produk extends CI_Model{
		function lihat(){
			$query = $this->db->query("SELECT * from produk ORDER BY nama_produk ASC");
			return $query->result();
		}
		
		function lihatsatu($id){
			$query = $this->db->query("SELECT * from produk where id_produk='$id' ORDER BY nama_produk ASC");
			return $query->result();
		}
		
		function jumlahdataproduk(){
			$query = $this->db->query("SELECT COUNT('id_produk') as id_produk from produk");
			return $query->result();
		}
	}
?>
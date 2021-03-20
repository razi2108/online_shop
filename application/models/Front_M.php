<?php 
class Front_M extends CI_Model{	
	function tampil($table){		
		return $this->db->get($table);
	}	
	function tampil_desc($table){	
		$this->db->order_by("id", "desc");	
		return $this->db->get($table);
	}
	function get_where($table, $where){	
		$this->db->where($where);	
		return $this->db->get($table);
	}
}
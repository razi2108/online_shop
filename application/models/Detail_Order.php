<?php
	class Detail_Order extends CI_Model{

		function lihat(){
			$query = $this->db->query("SELECT * from detail_order ORDER BY nama_pelanggan ASC");
			return $query->result();
		}

		function update_detail_order($where,$data){
			$this->db->where($where);
			$this->db->update('detail_order',$data);
		}
		
		function hapus_detail_order($where){
			$this->db->where($where);
			$this->db->delete('detail_order');
		}	

		function lihatsatu($id){
			$query = $this->db->query("SELECT * from detail_order where id_order='$id'");
			return $query->result();
		}	
		
		function jumlahdetail_order(){
			$query = $this->db->get('detail_order');
			return $query;
		}

		function hapus($id){
			$this->db->where('id', $id);
			return $this->db->delete('detail_order');
		}

		function tambah($new_name){
			$id_order = $this->input->post('id');
			$nama_pelanggan = $this->input->post('nama');
			$produk_order = $this->input->post('produk_order');
			$qty = $this->input->post('qty');
			$harga = $this->input->post('harga');
			$status = $this->input->post('status');
			$tanggal_order = $this->input->post('tanggal_order');
			
			$data = array(
				'id_order' => $id_order,
				'nama_pelanggan' => $nama_pelanggan,
				'produk_order' => $produk_order,
				'qty' => $qty,
				'harga' => $harga,
				'status' => $status,
				'tanggal_order' => $tanggal_order,
			);
			
			$cek = $this->db->insert('detail_order', $data);
			return $cek;
		}

		function ubah($new_name){
			$id_order = $this->input->post('id');
			$nama_pelanggan = $this->input->post('nama');
			$produk_order = $this->input->post('produk_order');
			$qty = $this->input->post('qty');
			$harga = $this->input->post('harga');
			$status = $this->input->post('status');
			$tanggal_order = $this->input->post('tanggal_order');
			
			$data = array(
				'id_order' => $id_order,
				'nama_pelanggan' => $nama_pelanggan,
				'produk_order' => $produk_order,
				'qty' => $qty,
				'harga' => $harga,
				'status' => $status,
				'tanggal_order' => $tanggal_order,
			);
			
			$this->db->where('id_order', $id_order);
			$cek = $this->db->update('detail_order', $data);
			return $cek = true;
		}

	}
?>
<?php
	class Produk extends CI_Model{

		function lihat(){
			$query = $this->db->query("SELECT * from produk ORDER BY nama_produk ASC");
			return $query->result();
		}

		function viewall($table){
			$query = $this->db->get($table);
			return $query->result();
		}

		function update_data_produk($where,$data){
			$this->db->where($where);
			$this->db->update('produk',$data);
		}
		
		function hapus_data_produk($where){
			$this->db->where($where);
			$this->db->delete('produk',$data);
		}	

		function lihatsatu($id){
			$query = $this->db->query("SELECT * from produk where id='$id'");
			return $query->result();
		}	
		
		function jumlahdataproduk(){
			$query = $this->db->get('produk');
			return $query;
		}

		function hapus($id){
			$this->db->where('id', $id);
			return $this->db->delete('produk');
		}

		function tambah($new_name, $status_notif){
			$foto = str_replace(" ","_",$new_name);
			$kode_produk = $this->input->post('id');
			$nama_produk = $this->input->post('nama');
			$kategori = $this->input->post('kategori');
			$ukuran_produk = $this->input->post('ukuran_produk');
			$stock_produk = $this->input->post('stock_produk');
			$berat_produk = $this->input->post('berat_produk');
			$ket_produk = $this->input->post('ket_produk');
			$harga_produk = $this->input->post('harga_produk');
			
			$data = array(
				'foto_produk' => $foto,
				'kode_produk' => $kode_produk,
				'nama_produk' => $nama_produk,
				'kategori' => $kategori,
				'ukuran_produk' => $ukuran_produk,
				'stock_produk' => $stock_produk,
				'berat_produk' => $berat_produk,
				'ket_produk' => $ket_produk,
				'harga_produk' => $harga_produk,
			);
			
			$cek = $this->db->insert('produk', $data);
			return $cek;
		}

		function ubah($namaFoto){
			$foto = str_replace(" ","_", $namaFoto);
			$kode_produk = $this->input->post('id');
			$nama_produk = $this->input->post('nama');
			$kategori = $this->input->post('kategori');
			$ukuran_produk = $this->input->post('ukuran_produk');
			$stock_produk = $this->input->post('stock_produk');
			$berat_produk = $this->input->post('berat_produk');
			$ket_produk = $this->input->post('ket_produk');
			
			$data = array(
				'foto_produk' => $foto,
				'nama_produk' => $nama_produk,
				'kategori' => $kategori,
				'ukuran_produk' => $ukuran_produk,
				'stock_produk' => $stock_produk,
				'berat_produk' => $berat_produk,
				'ket_produk' => $ket_produk,
				'harga_produk' => $harga_produk,
			);
			
			$this->db->where('kode_produk', $kode_produk);
			$cek = $this->db->update('produk', $data);
			return $cek = true;
		}
		
		function ubahtanpafotobaru(){
			// $foto = $this->input->post('foto_lama');
			$kode_produk = $this->input->post('id');
			$kategori = $this->input->post('kategori');
			$nama_produk = $this->input->post('nama');
			$ukuran_produk = $this->input->post('ukuran_produk');
			$stock_produk = $this->input->post('stock_produk');
			$berat_produk = $this->input->post('berat_produk');
			$ket_produk = $this->input->post('ket_produk');
			$harga_produk = $this->input->post('harga_produk');
			
			$data = array(
				'nama_produk' => $nama_produk,
				'kategori' => $kategori,
				'ukuran_produk' => $ukuran_produk,
				'stock_produk' => $stock_produk,
				'berat_produk' => $berat_produk,
				'ket_produk' => $ket_produk,
				'harga_produk' => $harga_produk,
			);
			
			$this->db->where('kode_produk', $kode_produk);
			$cek = $this->db->update('produk', $data);
			return $cek = true;
		}

	}
?>
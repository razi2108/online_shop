<?php
	class Model_tambah_produk extends CI_Model{
		function tambah($new_name){
			$foto = str_replace(" ","_",$new_name);
			$id_produk = $this->input->post('id');
			$nama_produk = $this->input->post('nama');
			$ukuran_produk = $this->input->post('ukuran_produk');
			$stock_produk = $this->input->post('stock_produk');
			$berat_produk = $this->input->post('berat_produk');
			$ket_produk = $this->input->post('ket_produk');
			$harga_produk = $this->input->post('harga_produk')
			
			$data = array(
				'foto_produk' => $foto,
				'id_produk' => $id_produk,
				'nama_produk' => $nama_produk,
				'ukuran_produk' => $ukuran_produk,
				'stock_produk' => $stock_produk,
				'berat_produk' => $berat_produk,
				'ket_produk' => $ket_produk,
				'harga_produk' => $harga_produk,
			);
			
			$cek = $this->db->insert('produk', $data);
			return $cek = true;
		}
	}
?>
<?php
	class Model_ubah_produk extends CI_Model{
		function ubah($namaFoto){
			$foto = str_replace(" ","_", $namaFoto);
			$kode_produk = $this->input->post('id');
			$nama_produk = $this->input->post('nama');
			$ukuran_produk = $this->input->post('ukuran produk');
			$stock_produk = $this->input->post('stock produk');
			$berat_produk = $this->input->post('berat produk');
			$ket_produk = $this->input->post('ket produk');
			$harga_produk = $this->input->post('harga produk')
			
			$data = array(
				'foto_produk' => $foto,
				'kode_produk' => $kode_produk,
				'nama_produk' => $nama_produk,
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
			$foto = $this->input->post('foto_lama');
			$kode_produk = $this->input->post('id');
			$nama_produk = $this->input->post('nama');
			$ukuran_produk = $this->input->post('ukuran produk');
			$stock_produk = $this->input->post('stock produk');
			$berat_produk = $this->input->post('berat produk');
			$ket_produk = $this->input->post('ket produk');
			$harga_produk = $this->input->post('harga produk')
			
			$data = array(
				'foto_produk' => $foto,
				'kode_produk' => $kode_produk,
				'nama_produk' => $nama_produk,
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
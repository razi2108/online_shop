<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Produk');
		$this->load->model('Detail_Order');	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}



	public function index()
	{
		$this->load->model('Produk');
		
			$data['produk'] = $this->Produk->jumlahdataproduk()->result();
			$data['detail_order'] = $this->Detail_Order->jumlahdetail_order()->result();
	
		$this->load->view('backend/view_home', $data);
	}
	
	public function tambahdataproduk()
	{
		$data['kategori'] = $this->Produk->viewall('jenis_pakaian');
		$this->load->view('backend/viewtambahdataproduk', $data);
	}
	public function konfirmasi_pembayaran()
	{
		$data['verify'] = $this->Produk->viewall('upload_bukti');
		$this->load->view('backend/konfirmasi_pembayaran', $data);
	}
	public function konfirmasi($id){
		$data['edit_status'] = $this->db->get_where('upload_bukti', array('id' => $id))->result();
		$this->load->view('backend/konfirmasi', $data);

 	}
 	public function konfirmasi_aksi(){
 		$where = array('id' => $this->input->post('id'));
 		$data = array('status' => $this->input->post('status'));
 		$this->db->update('upload_bukti', $data, $where);
 		$cek = $this->db->get_where('user', array('username' => $this->input->post('username')))->result_array();
 		if ($cek[0]['id_tele'] == NULL || empty($cek[0]['id_tele'])) {
 			# code...
 			redirect('admin/konfirmasi_pembayaran');
 		}else{
 			//============= URL AKSES API TELE =======================
			$URL = "http://api.telegram.org/bot"; 
			$TOKEN = "1004450171:AAEzJzKSCmiW87e6n0mle5VeSm5H_biSdbk";

			//========================================================
 			$msg = "Bukti Pembayaran dengan Username ".$this->input->post('username')." telah di konfirmasi oleh admin dan pesanan akan segera di packing kemudian di kirim \n\n    TERIMA KASIH \n   TELAH BELANJA ";
 			$send_msg = $URL.$TOKEN."/sendmessage?text=".urlencode($msg)."&chat_id=".$cek[0]['id_tele'];	
			file_get_contents($send_msg);
 			redirect('admin/konfirmasi_pembayaran');
 		}
 	}

	public function prosestambahdataproduk()
	{
		$kode_produk = $this->input->post('id');
		$cek = $this->Produk->lihatsatu($kode_produk);
		$cek_kode = count($cek);

		//============= URL AKSES API TELE =======================
		$URL = "http://api.telegram.org/bot"; 
		$TOKEN = "1004450171:AAEzJzKSCmiW87e6n0mle5VeSm5H_biSdbk";

		//========================================================

		// echo $cek_kode;
		if($cek_kode > 0)
		{
			echo "kode barang sudah ada silahkan ke edit barang untuk update barang.";
		}else{
			$config['upload_path']	= './foto/';
			$config['allowed_types']= 'gif|jpg|png';
			
			$new_name =time().$_FILES["foto"] ['name'];
			$config['file_name']=$new_name;
			$this->load->library('upload', $config);

			$kode_produk = $this->input->post('id');
			$nama_produk = $this->input->post('nama');
			$kategori = $this->input->post('kategori');
			$ukuran_produk = $this->input->post('ukuran_produk');
			$stock_produk = $this->input->post('stock_produk');
			$berat_produk = $this->input->post('berat_produk');
			$ket_produk = $this->input->post('ket_produk');
			$harga_produk = $this->input->post('harga_produk');


			//=================== Pesan untuk Notif ===========================================
			$msg = "Produk Baru\nKode Produk : ".$kode_produk."\nNama Produk : ".$nama_produk."\nSize Ready : ".$ukuran_produk."\nStok : ".$stock_produk."\nHarga/pcs : ".$harga_produk."\n";
			//==============================================================================
		
			if ($this->upload->do_upload('foto')) {
				// echo "upload sukses";
				if($notif == 0){
					$status_notif = 1;
					$cek = $this->Produk->tambah($new_name, $status_notif);
					if($cek == true){
				 	//=============== ambil id tele user ====================
				 	 $where = array('level' => 1);
				 	 $cek_user = $this->db->get_where('user',$where)->result();
				 	 //=======================================================
				 	 foreach ($cek_user as $cu) {
				 	 	# code...
				 	 	//================ kirim NOTIF berdasarkan id Tele User ===============
				 	 	$id_tele = $cu->id_tele;
				 	 	$send_msg = $URL.$TOKEN."/sendmessage?text=".urlencode($msg)."&chat_id=".$id_tele;	
				 	 	file_get_contents($send_msg);
				 	 	//=====================================================================
				 	 }

					 	  redirect('Admin/lihatdataproduk');
					 }else{
						 redirect('Admin/tambahdataproduk');
					 }
				}else{
					$status_notif = 0;
					$cek = $this->Produk->tambah($new_name, $status_notif);
					if($cek == true){
				 		redirect('Admin/lihatdataproduk');
					 }else{
						 redirect('Admin/tambahdataproduk');
					 }
				}	
			}
			else{
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
				redirect('Admin/tambahdataproduk');
			}
	  	}
	}

	public function prosestambahdatadetail_order()
	{
		$this->load->model('Detail_Order');

		$id_order = $this->input->post('id');
		$nama_pelanggan = $this->input->post('nama');
		$produk_order = $this->input->post('produk_order');
		$qty = $this->input->post('qty');
		$harga = $this->input->post('harga');
		$status = $this->input->post('status');
		$tanggal_order = $this->input->post('tanggal_order');

		$where = array('id_order' => $id);

		$data = array(
						'id_order' => $id_order,
						'nama_pelanggan' => $nama_pelanggan,
						'produk_order' => $produk_order,
						'qty' => $qty,
						'harga' => $harga,
						'status' => $status,
						'tanggal_order' => $tanggal_order,					 
					);
		$this->Detail_Order->tambah($new_name);
      	redirect('admin/lihatdetail_order');
	
	}
	
	public function lihatdataproduk()
	{
		$this->load->helper('url');
		$this->load->model('Produk');
		
			$data['produk'] = $this->Produk->lihat();
		
		$this->load->view('backend/viewlihatdataproduk', $data);
	}
	
	public function lihatdetail_order()
	{
		$this->load->helper('url');
		$this->load->model('Detail_Order');
		
			$data['detail_order'] = $this->Detail_Order->lihat();
		
		$this->load->view('backend/viewlihatdetail_order', $data);
	}

	public function cetak()
	{
		$this->load->helper('url');
		$this->load->model('Produk');
		
			$data['produk'] = $this->Produk->lihat();
		
		$this->load->view('backend/viewcetakdataproduk', $data);
	}

	public function cetakdetail_order()
	{
		$this->load->helper('url');
		$this->load->model('Detail_Order');
		
			$data['detail_order'] = $this->Detail_Order->lihat();
		
		$this->load->view('backend/viewcetakdetail_order', $data);
	}
	
	public function proseshapusproduk()
	{
		$id = $_GET['id'];
		$this->load->model('Produk');
		
		$cek = $this->Produk->hapus($id);
			 if($cek == true){
				 redirect('Admin/lihatdataproduk');
			 }else{
				 redirect('Admin/lihatdataproduk');
			 }
	}

	public function ubahdataproduk()
	{
		$id = $_GET['id'];
		$this->load->model('Produk');
		
		$data['produk'] = $this->Produk->lihatsatu($id);
		$data['kategori'] = $this->Produk->viewall('jenis_pakaian');
		
		$this->load->view('backend/viewubahdataproduk', $data);
	}

	
	public function ubahdetail_order($id)
	{
		$this->load->model('Detail_Order');
		
		$data['detail_order'] = $this->Detail_Order->lihatsatu($id);
		
		$this->load->view('backend/viewubahdetail_order', $data);
	}

	public function prosesubahdataproduk()
	{
		if($_FILES["foto_baru"] ["name"] != ""){
			$config['upload_path']	= './Foto';
			$config['allowed_types']= 'gif|jpg|png';
			
			$namaFoto = time() . $_FILES["foto_baru"] ['name'];
			$config['file_name'] = $namaFoto;
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload('foto_baru')){
				$this->load->model('Produk');
			
				$cek = $this->Produk->ubah($namaFoto);
				if($cek == true){
					redirect('Admin/lihatdataproduk');
				}
				else{
					redirect('Admin/ubahdataproduk');
				}
			}
			else{
				redirect('Admin/ubahdataproduk');
			}
		}
		else{
			
			$cek = $this->Produk->ubahtanpafotobaru();
			if($cek == true){
				redirect('Admin/lihatdataproduk');
			}
			else{
				redirect('Admin/ubahdataproduk');
			}
		}
	}

	public function prosesubahdetail_order()
	{
		$id_order = $this->input->post('id');
		$nama_pelanggan = $this->input->post('nama');
		$produk_order = $this->input->post('produk_order');
		$qty = $this->input->post('qty');
		$harga = $this->input->post('harga');
		$status = $this->input->post('status');
		$tanggal_order = $this->input->post('tanggal_order');

		$where = array('id_order' => $id_order);

		$data = array(
						'nama_pelanggan' => $nama_pelanggan,
						'produk_order' => $produk_order,
						'qty' => $qty,
						'harga' => $harga,
						'status' => $status,
						'tanggal_order' => $tanggal_order,					 
					);
		$this->Detail_Order->update_detail_order($where,$data);
      	$this->session->set_flashdata('update', 'Update Detail_Order sukses.');
      	redirect('admin/lihatdetail_order');
	}

	public function proseshapusdetail_order($id){
		$this->db->where('id_order', $id);
		$this->db->delete('detail_order');
		redirect('admin/lihatdetail_order');
	}
}
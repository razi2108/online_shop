<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shopping extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('keranjang_model');
	}

	public function index()
	{
		$kategori=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['produk'] = $this->keranjang_model->get_produk_kategori($kategori);
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('themes/header',$data);
		$this->load->view('shopping/list_produk',$data);
		$this->load->view('themes/footer');
	}
	public function tampil_cart()
	{
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('themes/header',$data);
		$this->load->view('shopping/tampil_cart',$data);
		$this->load->view('themes/footer');
	}
	
	public function check_out()
	{
		if($this->session->userdata('status') != 'login'){
			redirect('user_login');
		}else{
			$data['kategori'] = $this->keranjang_model->get_kategori_all();
			$data['pelanggan'] = $this->keranjang_model->get_pelanggan($this->session->userdata('nama'));
			$this->load->view('themes/header',$data);
			$this->load->view('shopping/check_out',$data);
			$this->load->view('themes/footer');
		}
	}
	
	public function detail_produk()
	{
		$id=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$data['detail'] = $this->keranjang_model->get_produk_id($id)->row_array();
		$this->load->view('themes/header',$data);
		$this->load->view('shopping/detail_produk',$data);
		$this->load->view('themes/footer');
	}
	
	
	function tambah()
	{
		$data_produk= array('id' => $this->input->post('id'),
							 'name' => $this->input->post('nama'),
							 'price' => $this->input->post('harga'),
							 'gambar' => $this->input->post('gambar'),
							 'qty' =>$this->input->post('qty')
							);
		$this->cart->insert($data_produk);
		redirect('shopping');
	}

	function hapus($rowid) 
	{
		if ($rowid=="all")
			{
				$this->cart->destroy();
			}
		else
			{
				$data = array('rowid' => $rowid,
			  				  'qty' =>0);
				$this->cart->update($data);
			}
		redirect('shopping/tampil_cart');
	}

	function ubah_cart()
	{
		$cart_info = $_POST['cart'] ;
		foreach( $cart_info as $id => $cart)
		{
			$rowid = $cart['rowid'];
			$price = $cart['price'];
			$gambar = $cart['gambar'];
			$amount = $price * $cart['qty'];
			$qty = $cart['qty'];
			$data = array('rowid' => $rowid,
							'price' => $price,
							'gambar' => $gambar,
							'amount' => $amount,
							'qty' => $qty);
			$this->cart->update($data);
		}
		redirect('shopping/tampil_cart');
	}

	public function proses_order()
	{	
		//============= URL AKSES API TELE =======================
		$URL = "http://api.telegram.org/bot"; 
		$TOKEN = "1004450171:AAEzJzKSCmiW87e6n0mle5VeSm5H_biSdbk";
		if($this->session->userdata('id_tele') != NULL){
			//========================================================
			if ($cart = $this->cart->contents())
				{
					$msg = "DETAIL TRANSAKSI\n";
					foreach ($cart as $item)
						{
							$data_detail = array(
											'nama_pelanggan' => $this->input->post('nama'),
											'produk_order' => $item['name'],
											'qty' => $item['qty'],
											'harga' => $item['price']);			
							$proses = $this->keranjang_model->tambah_detail_order($data_detail);
							$msg .= "Nama Pelanggan   : ".$this->input->post('nama')."\nProduk yang dibeli : ".$item['name']."\nJumlah Barang   : ".$item['qty']."\nHarga      : ".$item['price']."\n=====================";
						}
				}
			
			$send_msg = $URL.$TOKEN."/sendmessage?text=".urlencode($msg)."&chat_id=".$this->session->userdata('id_tele');	
			file_get_contents($send_msg);
			//-------------------------Hapus shopping cart--------------------------		
			$this->cart->destroy();
			$data['kategori'] = $this->keranjang_model->get_kategori_all();
			$this->load->view('themes/header',$data);
			$this->load->view('shopping/sukses',$data);
			$this->load->view('themes/footer');
		}else{
			if ($cart = $this->cart->contents())
				{
					foreach ($cart as $item)
						{
							$data_detail = array(
											'nama_pelanggan' => $this->input->post('nama'),
											'produk_order' => $item['name'],
											'qty' => $item['qty'],
											'harga' => $item['price']);			
							$proses = $this->keranjang_model->tambah_detail_order($data_detail);
						}
				}
			//-------------------------Hapus shopping cart--------------------------		
			$this->cart->destroy();
			$data['kategori'] = $this->keranjang_model->get_kategori_all();
			$this->load->view('themes/header',$data);
			$this->load->view('shopping/sukses',$data);
			$this->load->view('themes/footer');
		}
	}
	public function uploadpembayaran()
	{
			$data['kategori'] = $this->keranjang_model->get_kategori_all();
			$this->load->view('themes/header',$data);
			$this->load->view('shopping/bukti_upload',$data);
			$this->load->view('themes/footer');
	}
	public function upload_bukti_aksi(){
			$config['upload_path']	= './foto/';
			$config['allowed_types']= 'gif|jpg|png';
			$new_name =time().$_FILES["file"] ['name'];
			$config['file_name']=$new_name;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('file')) {
				$data = array(
								'username' => $this->session->userdata('nama'),
								'bukti' => $new_name,
								'ket' => $this->input->post('ket'),
								'status' => '0', //0 = belum di verify 1 = sudah verify
								'datetime' => date('Y-m-d H:i:s')
							  );
				$this->db->insert('upload_bukti', $data);
				$this->session->set_userdata('hasil_upload', '<font color="green"><p>Bukti pembayaran berhasil di upload silahkan tunggu konfirmasi dari admin</p></font>');
				redirect('shopping/uploadpembayaran');
			}else{
				$this->session->set_userdata('hasil_upload', '<font color="red"><p>Bukti pembayaran gagal di upload silahkan coba lagi.</p></font>');
				redirect('shopping/uploadpembayaran');
			}
	}
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('cart');
		$this->load->model('Front_M');
	}

	public function index(){
		$data['cp'] = $this->Front_M->tampil('tbl_cp')->result();
		$data['kategori'] = $this->Front_M->tampil('jenis_pakaian')->result();
		$data['produk_new'] = $this->Front_M->tampil_desc('produk')->result();
		$data['checkout'] = $this->Front_M->tampil('detail_order')->result();
		$this->load->view('frontend/load/header',$data);
		$this->load->view('frontend/index', $data);
		$this->load->view('frontend/load/footer');
	}
	public function cat($kategori){
		$kategori = str_replace("%20"," ",$kategori);
		// echo $kategori;
		$where = array('kategori' => $kategori);
		$data['kategori_pilih'] = $this->Front_M->get_where('produk', $where)->result();
		$data['cp'] = $this->Front_M->tampil('tbl_cp')->result();
		$data['kategori'] = $this->Front_M->tampil('jenis_pakaian')->result();
		$data['produk_new'] = $this->Front_M->tampil_desc('produk')->result();
		$this->load->view('frontend/load/header',$data);
		$this->load->view('frontend/cat', $data);
		$this->load->view('frontend/load/footer');
	}

	// public function checkout($checkout){
	// 	$where = array('checkout' => $checkout);
	// 	$data['checkout'] = $this->Front_M->get_where('detail_order', $where)->result();
	// 	$this->load->view('frontend/load/header',$data);
	// 	$this->load->view('frontend/cat', $data);
	// 	$this->load->view('frontend/checkout', $data);
	// 	$this->load->view('frontend/load/footer');
	// }

}
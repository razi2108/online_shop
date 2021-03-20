<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	public function index()
	{
		$this->load->model('Produk');
		$this->load->model('Pelanggan');
		$this->load->model('Detail_Order');
		
			$data['detail_order'] = $this->Detail_Order->jumlahdetail_order()->result();;
	
		$this->load->view('backend/view_home', $data);
	}
	
	public function tambahdetail_order()
	{
		$this->load->view('backend/viewtambahdetail_order');
	}
	
	public function prosestambahdetail_order()
	{

			 $cek = $this->Detail_Order->tambah($new_name);
			 if($cek == true){
				 redirect('Admin/lihatdetail_order');
			 }else{
				 redirect('Admin/tambahdetail_order');
			 }
		}
		else{
			redirect('Admin/tambahdetail_order');
		}
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
		$this->load->model('Detail_Order');
		
			$data['detail_order'] = $this->Detail_Order->lihat();
		
		$this->load->view('backend/viewcetakdetail_order', $data);
	}
	
	public function proseshapus()
	{
		$id = $_GET['id'];
		$this->load->model('Detail_Order');
		
		$cek = $this->Detail_Order->hapus($id);
			 if($cek == true){
				 redirect('Admin/lihatdetail_order');
			 }else{
				 redirect('Admin/lihatdetail_order');
			 }
	}

	public function ubahdetail_order()
	{
		$id = $_GET['id'];
		$this->load->model('Detail_Order');
		
		$data['detail_order'] = $this->Detail_Order->lihatsatu($id);
		
		$this->load->view('backend/viewubahdetail_order', $data);
	}
	
	public function prosesubahdetail_order()
	{
			$this->load->model('Detail_Order');
			
			$cek = $this->Detail_Order->ubahdetail_order();
			if($cek == true){
				redirect('Admin/lihatdetail_order');
			}
			else{
				redirect('Admin/ubahdetail_order');
			}
		}
	}
}

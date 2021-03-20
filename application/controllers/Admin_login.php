<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->database('online_shop');
		$this->load->model('login');
		$this->load->helper('url');
	}

	public function index(){
		$this->load->view('backend/login');
	}
	public function login_aksi(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$level = 0;

		$where = array(
						'username' => $username,
						'password' => $password,
						'level' => $level
					  );
		$cek = $this->login->cek_login('user', $where)->num_rows();
		
		// echo $cek;
		if ($cek == 1) {
			# code...
			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
 
				$this->session->set_userdata($data_session);

				redirect('admin');
		}

	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->database('online_shop');
		$this->load->model('login');
		$this->load->helper('url');
	}

	public function index(){
		$this->load->view('frontend/login');
	}
	public function reg(){
		$this->load->view('frontend/register');
	}
	public function reg_aksi(){
		$nama_lengkap = $this->input->post('nama_lengkap');
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');

		$data = array(
						'nama_user' => $nama_lengkap,
						'username' => $username,
						'password' => $password,
						'no_hp' => $no_hp,
						'email' => $email,
						'alamat' => $alamat,
						'level' => 1 //0 == admin , 1 == user biasa
					 );
		$this->db->insert('user', $data);
		$data_session = array(
					'login' => "Register Sukses, Silahkan Login untuk melanjutkan."
				);
 
				$this->session->set_userdata($data_session);
		// redirect('backend/penawaran');
		$this->load->view('backend/penawaran');
	}
	public function login_aksi(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$level = 1;

		$where = array(
						'username' => $username,
						'password' => $password,
						'level' => $level
					  );
		$cek_login = $this->login->cek_login('user', $where);
		$cek = $cek_login->num_rows();
		$cek_id = $cek_login->result_array();
		
		// echo $cek;
		if ($cek == 1) {
			# code...
			$data_session = array(
				'nama' => $username,
				'status' => "login",
				'id_tele' => $cek_id[0]['id_tele']
				);
 
				$this->session->set_userdata($data_session);

				redirect(base_url());
		}else{
			$data_session = array(
					'login' => "email atau password Salah."
				);
 
				$this->session->set_userdata($data_session);
				redirect('user_login');
		}

	}
	function logout(){
	    $this->session->sess_destroy();
	    redirect(base_url());
  	}
}
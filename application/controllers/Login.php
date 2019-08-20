<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

    }
	// Index login
	public function index() {
		// Fungsi Login
		$valid = $this->form_validation;
		$username_admin = $this->input->post('username_admin');
		$password_admin = $this->input->post('password_admin');
		$valid->set_rules('username_admin','username_admin','required');
		$valid->set_rules('password_admin','password_admin','required');
		if($valid->run()) {
			$this->simple_login->login($username_admin,$password_admin, base_url('dasbor'), base_url('login'));
		}
		// End fungsi login
		$data = array('username_admin' => $username_admin, 'password_admin' => $password_admin, 
		);

		$this->template->set('title', 'Halaman Login Administrator');
        $this->template->load('login', 'content', 'admin/admin_login', $data);
		//$this->load->view('login_view',$data);
	}
	
	// Logout di sini
	public function logout() {
		$this->simple_login->logout();	
	}	
}
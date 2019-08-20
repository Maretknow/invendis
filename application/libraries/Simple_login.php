<?php if(! defined('BASEPATH')) exit('Akses langsung tidak diperbolehkan'); 

class Simple_login {
	// SET SUPER GLOBAL
	var $CI = NULL;
	public function __construct() {
		$this->CI =& get_instance();
	}
	// Fungsi login
	public function login($username_admin, $password_admin) {
		$query = $this->CI->db->get_where('admin',array('username_admin'=>$username_admin,'password_admin' => md5($password_admin)));
		if($query->num_rows() == 1) {
			$row 	= $this->CI->db->query('SELECT * FROM admin where username_admin = "'.$username_admin.'"');
			$admin 	= $row->row();
			$id 	= $admin->id_user;
			$this->CI->session->set_userdata('username_admin', $username_admin);
			$this->CI->session->set_userdata('nama_admin', $admin->nama_admin);
			$this->CI->session->set_userdata('foto_admin', $admin->foto_admin);
			$this->CI->session->set_userdata('role', $admin->role);
			$this->CI->session->set_userdata('id_login', uniqid(rand()));
			$this->CI->session->set_userdata('id', $id);
			redirect(base_url());
		}else{
			$this->CI->session->set_flashdata('sukses','Oops... username_admin/password_admin salah');
			redirect(base_url('login'));
		}
		return false;
	}
	// Proteksi halaman
	public function cek_login() {
		if($this->CI->session->userdata('username_admin') == '') {
			$this->CI->session->set_flashdata('sukses','Anda belum login');
			redirect(base_url('login'));
		}
	}
	// Fungsi logout
	public function logout() {
		$this->CI->session->unset_userdata('username_admin');
		$this->CI->session->unset_userdata('nama_admin');
		$this->CI->session->unset_userdata('id_login');
		$this->CI->session->unset_userdata('id');
		$this->CI->session->set_flashdata('sukses','Anda berhasil logout');
		redirect(base_url('login'));
	}
}
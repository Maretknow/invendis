<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Admin_model','Alat_medis_model','Detail_alat_model'));
        $this->load->library('form_validation');
        $this->simple_login->cek_login();  
    }

	public function index() 
	 {
	        $data = array(
	        	 'total_row_admin' => $this->Admin_model->total_rows('Admin'),
	        	 'total_row_Alat_medis' => $this->Alat_medis_model->total_rows(),
	        	 'total_row_Alat_baik' => $this->Detail_alat_model->total_baik(),
	        	 'total_row_Alat_rusak' => $this->Detail_alat_model->total_rusak(),
	    );
	        $this->template->set('title', 'dashboard');
	        $this->template->load('template', 'content', 'admin/admin_dashboard', $data);
	        
	        //$this->load->view('admin/admin_form', $data);
    }

}
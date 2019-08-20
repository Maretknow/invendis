<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->simple_login->cek_login();  
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/index.html';
            $config['first_url'] = base_url() . 'admin/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_model->total_rows($q);
        $admin = $this->Admin_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_data' => $admin,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'admin/admin_list', $data);
        //$this->load->view('admin/admin_list', $data);
    }

    

    public function read($id) 
    {
        $row = $this->Admin_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_admin' => $row->id_admin,
		'nama_admin' => $row->nama_admin,
		'foto_admin' => $row->foto_admin,
		'password_admin' => $row->password_admin,
		'username_admin' => $row->username_admin,
		'role' => $row->role,
	    );
            $this->template->set('title', 'invendismas purwantoro');
            $this->template->load('template', 'content', 'admin/admin_read', $data);

            //$this->load->view('admin/admin_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/create_action'),
	    'id_admin' => set_value('id_admin'),
	    'nama_admin' => set_value('nama_admin'),
	    'foto_admin' => set_value('foto_admin'),
	    'password_admin' => set_value('password_admin'),
	    'username_admin' => set_value('username_admin'),
	    'role' => set_value('role'),
	);
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'admin/admin_form', $data);
        
        //$this->load->view('admin/admin_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_admin' => $this->input->post('nama_admin',TRUE),
		'foto_admin' => $this->input->post('foto_admin',TRUE),
		'password_admin' => md5($this->input->post('password_admin',TRUE)),
		'username_admin' => $this->input->post('username_admin',TRUE),
		'role' => $this->input->post('role',TRUE),
	    );
            if ($_FILES['foto_admin']['name']!=null || $_FILES['foto_admin']['name']!='') {
                    $config['upload_path']          = './upload/foto_admin/';
                    $config['allowed_types']        = 'jpeg|png|jpg';
                    $config['overwrite']            = true;
                    
            
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('foto_admin')){  
                       // $this->update();
                        var_dump($config);
                        die();
                    }
                    else{
                        $data['foto_admin'] = $this->upload->data('file_name');
                    }
        }
            if ($_SESSION['role'] != 'Admin') {
                $this->session->set_flashdata('message', 'Gagal, Action Not Autorize For User Account');
                redirect(site_url('admin'));
            } else {
            $this->Admin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin'));
        }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/update_action'),
		'id_admin' => set_value('id_admin', $row->id_admin),
		'nama_admin' => set_value('nama_admin', $row->nama_admin),
		'foto_admin' => set_value('foto_admin', $row->foto_admin),
		'password_admin' => set_value('password_admin', $row->password_admin),
		'username_admin' => set_value('username_admin', $row->username_admin),
		'role' => set_value('role', $row->role),
	    );
            $this->template->set('title', 'invendismas purwantoro');
            $this->template->load('template', 'content', 'admin/admin_form', $data);
            
            //$this->load->view('admin/admin_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_admin', TRUE));
        } else {
            $data = array(
		'nama_admin' => $this->input->post('nama_admin',TRUE),
		'foto_admin' => $this->input->post('foto_admin',TRUE),
		'password_admin' => $this->input->post('password_admin',TRUE),
		'username_admin' => $this->input->post('username_admin',TRUE),
		'role' => $this->input->post('role',TRUE),
	    );
            if ($_SESSION['role'] != 'Admin') {
                $this->session->set_flashdata('message', 'Gagal, Action Not Autorize For User Account');
                redirect(site_url('admin'));
            } else {
            $this->Admin_model->update($this->input->post('id_admin', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin'));
        }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            if ($_SESSION['role'] != 'Admin') {
                $this->session->set_flashdata('message', 'Gagal, Action Not Autorize For User Account');
                redirect(site_url('admin'));
            } else {
            $this->Admin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin'));
        }
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_admin', 'nama admin', 'trim|required');
	// $this->form_validation->set_rules('foto_admin', 'foto admin', 'trim|required');
	$this->form_validation->set_rules('password_admin', 'password admin', 'trim|required');
	$this->form_validation->set_rules('username_admin', 'username admin', 'trim|required');
	$this->form_validation->set_rules('role', 'role', 'trim|required');

	$this->form_validation->set_rules('id_admin', 'id_admin', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "admin.xls";
        $judul = "admin";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Admin");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto Admin");
	xlsWriteLabel($tablehead, $kolomhead++, "Password Admin");
	xlsWriteLabel($tablehead, $kolomhead++, "Username Admin");
	xlsWriteLabel($tablehead, $kolomhead++, "Role");

	foreach ($this->Admin_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_admin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto_admin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password_admin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username_admin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->role);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=admin.doc");

        $data = array(
            'admin_data' => $this->Admin_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('admin/admin_doc',$data);
    }

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-20 17:10:13 */
/* http://harviacode.com */
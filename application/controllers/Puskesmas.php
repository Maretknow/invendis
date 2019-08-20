<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Puskesmas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Puskesmas_model');
        $this->load->library('form_validation');
        $this->simple_login->cek_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'puskesmas/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'puskesmas/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'puskesmas/index.html';
            $config['first_url'] = base_url() . 'puskesmas/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Puskesmas_model->total_rows($q);
        $puskesmas = $this->Puskesmas_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'puskesmas_data' => $puskesmas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->set('title', 'invendismas purwantoro');
        //echo "string";
        $this->template->load('template', 'content', 'puskesmas/puskesmas_list', $data);
        //$this->load->view('jenis/jenis_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Puskesmas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_puskesmas' => $row->id_puskesmas,
		'nama_puskesmas' => $row->nama_puskesmas,
        'keterangan_puskesmas' => $row->keterangan_puskesmas,
        'alamat_puskesmas' => $row->alamat_puskesmas,
	    );
            $this->template->set('title', 'invendismas purwantoro');
            $this->template->load('template', 'content', 'puskesmas/puskesmas_read', $data);
            //$this->load->view('jenis/jenis_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('puskesmas/create_action'),
	    'id_puskesmas' => set_value('id_jenis'),
	    'nama_puskesmas' => set_value('nama_puskesmas'),
        'keterangan_puskesmas' => set_value('keterangan_puskesmas'),
        'alamat_puskesmas' => set_value('alamat_puskesmas'),
	);
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'puskesmas/puskesmas_form', $data);
        //$this->load->view('jenis/jenis_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_puskesmas' => $this->input->post('nama_puskesmas',TRUE),
        'keterangan_puskesmas' => $this->input->post('keterangan_puskesmas',TRUE),
        'alamat_puskesmas' => $this->input->post('alamat_puskesmas',TRUE),
	    );

            $this->Puskesmas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('puskesmas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Puskesmas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('puskesmas/update_action'),
		'id_puskesmas' => set_value('id_puskesmas', $row->id_puskesmas),
		'nama_puskesmas' => set_value('nama_puskesmas', $row->nama_puskesmas),
        'keterangan_puskesmas' => set_value('keterangan_puskesmas', $row->keterangan_puskesmas),
        'alamat_puskesmas' => set_value('alamat_puskesmas', $row->alamat_puskesmas),
	    );
            $this->template->set('title', 'invendismas purwantoro');
            $this->template->load('template', 'content', 'puskesmas/puskesmas_form', $data);
            //$this->load->view('jenis/jenis_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_puskesmas', TRUE));
        } else {
            $data = array(
		'nama_puskesmas' => $this->input->post('nama_puskesmas',TRUE),
        'keterangan_puskesmas' => $this->input->post('keterangan_puskesmas',TRUE),
        'alamat_puskesmas' => $this->input->post('alamat_puskesmas',TRUE),
	    );

            $this->Puskesmas_model->update($this->input->post('id_puskesmas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('puskesmas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Puskesmas_model->get_by_id($id);

        if ($row) {
            $this->Puskesmas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('puskesmas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('puskesmas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_puskesmas', 'nama puskesmas', 'trim|required');

	$this->form_validation->set_rules('id_puskesmas', 'id_puskesmas', 'trim');
    $this->form_validation->set_rules('keterangan_puskesmas', 'keterangan_puskesmas', 'trim');
    $this->form_validation->set_rules('alamat_puskesmas', 'alamat_puskesmas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "puskesmas.xls";
        $judul = "puskesmas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama puskesmas");

	foreach ($this->Puskesmas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_puskesmas);
        xlsWriteLabel($tablebody, $kolombody++, $data->keterangan_puskesmas);
        xlsWriteLabel($tablebody, $kolombody++, $data->alamat_puskesmas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=jenis.doc");

        $data = array(
            'puskesmas_data' => $this->Puskesmas_model->get_all(),
            'start' => 0
        );
        
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'puskesmas/puskesmas_doc', $data);
        //$this->load->view('jenis/jenis_doc',$data);
    }

}
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_model');
        $this->load->library('form_validation');
        $this->simple_login->cek_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jenis/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jenis/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jenis/index.html';
            $config['first_url'] = base_url() . 'jenis/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jenis_model->total_rows($q);
        $jenis = $this->Jenis_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jenis_data' => $jenis,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'jenis/jenis_list', $data);
        //$this->load->view('jenis/jenis_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Jenis_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jenis' => $row->id_jenis,
		'nama_jenis' => $row->nama_jenis,
	    );
            $this->template->set('title', 'invendismas purwantoro');
            $this->template->load('template', 'content', 'jenis/jenis_read', $data);
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
            'action' => site_url('jenis/create_action'),
	    'id_jenis' => set_value('id_jenis'),
	    'nama_jenis' => set_value('nama_jenis'),
	);
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'jenis/jenis_form', $data);
        //$this->load->view('jenis/jenis_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_jenis' => $this->input->post('nama_jenis',TRUE),
	    );

            $this->Jenis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenis'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jenis_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis/update_action'),
		'id_jenis' => set_value('id_jenis', $row->id_jenis),
		'nama_jenis' => set_value('nama_jenis', $row->nama_jenis),
	    );
            $this->template->set('title', 'invendismas purwantoro');
            $this->template->load('template', 'content', 'jenis/jenis_form', $data);
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
            $this->update($this->input->post('id_jenis', TRUE));
        } else {
            $data = array(
		'nama_jenis' => $this->input->post('nama_jenis',TRUE),
	    );

            $this->Jenis_model->update($this->input->post('id_jenis', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenis'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jenis_model->get_by_id($id);

        if ($row) {
            $this->Jenis_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_jenis', 'nama jenis', 'trim|required');

	$this->form_validation->set_rules('id_jenis', 'id_jenis', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jenis.xls";
        $judul = "jenis";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Jenis");

	foreach ($this->Jenis_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_jenis);

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
            'jenis_data' => $this->Jenis_model->get_all(),
            'start' => 0
        );
        
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'jenis/jenis_doc', $data);
        //$this->load->view('jenis/jenis_doc',$data);
    }

}

/* End of file Jenis.php */
/* Location: ./application/controllers/Jenis.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-20 17:10:13 */
/* http://harviacode.com */
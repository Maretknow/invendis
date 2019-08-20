<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_alat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Kondisi_model', 'Alat_medis_model' ,'Detail_alat_model'));
        $this->load->library('form_validation');
        $this->simple_login->cek_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'detail_alat/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'detail_alat/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'detail_alat/index.html';
            $config['first_url'] = base_url() . 'detail_alat/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Detail_alat_model->total_rows($q);
        $detail_alat = $this->Detail_alat_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'detail_alat_data' => $detail_alat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'detail_alat/detail_alat_list', $data);
        //$this->load->view('detail_alat/detail_alat_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Detail_alat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_detail_alat' => $row->id_detail_alat,
		'id_alat' => $row->id_alat,
		'id_kondisi' => $row->id_kondisi,
		'jumlah_kondisi' => $row->jumlah_kondisi,
		'tanggal_kondisi' => $row->tanggal_kondisi,
	    );
            $this->template->set('title', 'invendismas purwantoro');
            $this->template->load('template', 'content', 'detail_alat/detail_alat_read', $data);
            //$this->load->view('detail_alat/detail_alat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_alat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detail_alat/create_action'),
	    'id_detail_alat' => set_value('id_detail_alat'),
	    'id_alat' => set_value('id_alat'),
	    'id_kondisi' => set_value('id_kondisi'),
	    'jumlah_kondisi' => set_value('jumlah_kondisi'),
	    'tanggal_kondisi' => set_value('tanggal_kondisi'),
	);
        $data['query']=$this->Alat_medis_model->get_list();
        $data['query2']=$this->Kondisi_model->get_list();

        //print_r($data['query2']);
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'detail_alat/detail_alat_form', $data);
        //$this->load->view('detail_alat/detail_alat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_alat' => $this->input->post('id_alat',TRUE),
		'id_kondisi' => $this->input->post('id_kondisi',TRUE),
		'jumlah_kondisi' => $this->input->post('jumlah_kondisi',TRUE),
		'tanggal_kondisi' => $this->input->post('tanggal_kondisi',TRUE),
	    );

            $this->Detail_alat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detail_alat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Detail_alat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detail_alat/update_action'),
		'id_detail_alat' => set_value('id_detail_alat', $row->id_detail_alat),
		'id_alat' => set_value('id_alat', $row->id_alat),
		'id_kondisi' => set_value('id_kondisi', $row->id_kondisi),
		'jumlah_kondisi' => set_value('jumlah_kondisi', $row->jumlah_kondisi),
		'tanggal_kondisi' => set_value('tanggal_kondisi', $row->tanggal_kondisi),
	    );
            $data['query']=$this->Alat_medis_model->get_list();
        $data['query2']=$this->Kondisi_model->get_list();
            $this->template->set('title', 'invendismas purwantoro');
            $this->template->load('template', 'content', 'detail_alat/detail_alat_form', $data);
            //$this->load->view('detail_alat/detail_alat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_alat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_detail_alat', TRUE));
        } else {
            $data = array(
		'id_alat' => $this->input->post('id_alat',TRUE),
		'id_kondisi' => $this->input->post('id_kondisi',TRUE),
		'jumlah_kondisi' => $this->input->post('jumlah_kondisi',TRUE),
		'tanggal_kondisi' => $this->input->post('tanggal_kondisi',TRUE),
	    );

            $this->Detail_alat_model->update($this->input->post('id_detail_alat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detail_alat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Detail_alat_model->get_by_id($id);

        if ($row) {
            $this->Detail_alat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detail_alat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_alat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_alat', 'id alat', 'trim|required');
	$this->form_validation->set_rules('id_kondisi', 'id kondisi', 'trim|required');
	$this->form_validation->set_rules('jumlah_kondisi', 'jumlah kondisi', 'trim|required');
	$this->form_validation->set_rules('tanggal_kondisi', 'tanggal kondisi', 'trim|required');

	$this->form_validation->set_rules('id_detail_alat', 'id_detail_alat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detail_alat.xls";
        $judul = "detail_alat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Alat");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kondisi");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Kondisi");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Kondisi");

	foreach ($this->Detail_alat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_alat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kondisi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_kondisi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_kondisi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=detail_alat.doc");

        $data = array(
            'detail_alat_data' => $this->Detail_alat_model->get_all(),
            'start' => 0
        );
        
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'detail_alat/detail_alat_doc', $data);
        //$this->load->view('detail_alat/detail_alat_doc',$data);
    }

}

/* End of file Detail_alat.php */
/* Location: ./application/controllers/Detail_alat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-20 17:10:13 */
/* http://harviacode.com */
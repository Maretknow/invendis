<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alat_medis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Jenis_model','Alat_medis_model','Puskesmas_model'));
        $this->load->library('form_validation');
        $this->simple_login->cek_login();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'alat_medis/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'alat_medis/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'alat_medis/index.html';
            $config['first_url'] = base_url() . 'alat_medis/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Alat_medis_model->total_rows($q);
        $alat_medis = $this->Alat_medis_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'alat_medis_data' => $alat_medis,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'alat_medis/alat_medis_list', $data);
        //$this->load->view('alat_medis/alat_medis_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Alat_medis_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_alat' => $row->id_alat,
		'nama_alat' => $row->nama_alat,
		'foto_alat' => $row->foto_alat,
		'jumlah' => $row->jumlah,
		'tanggal_alat_medis' => $row->tanggal_alat_medis,
		'id_jenis' => $row->id_jenis,
	    );
            $this->template->set('title', 'invendismas purwantoro');
            $this->template->load('template', 'content', 'alat_medis/alat_medis_read', $data);
            //$this->load->view('alat_medis/alat_medis_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alat_medis'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('alat_medis/create_action'),
	    'id_alat' => set_value('id_alat'),
	    'nama_alat' => set_value('nama_alat'),
	    'foto_alat' => set_value('foto_alat'),
	    'jumlah' => set_value('jumlah'),
	    'tanggal_alat_medis' => set_value('tanggal_alat_medis'),
	    'id_jenis' => set_value('id_jenis'),
        'id_puskesmas' => set_value('id_puskesmas'),
	);
        $data['query']=$this->Jenis_model->get_list();
        $data['query1']=$this->Puskesmas_model->get_list();
        // print_r($data['query']);
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'alat_medis/alat_medis_form', $data);
        //$this->load->view('alat_medis/alat_medis_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_alat' => $this->input->post('nama_alat',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'tanggal_alat_medis' => $this->input->post('tanggal_alat_medis',TRUE),
		'id_jenis' => $this->input->post('id_jenis',TRUE),
        'id_puskesmas' => $this->input->post('id_puskesmas',TRUE),
	    );
            if ($_FILES['foto_alat']['name']!=null || $_FILES['foto_alat']['name']!='') {
                    $config['upload_path']          = './upload/foto_alat/';
                    $config['allowed_types']        = 'jpeg|png|jpg';
                    $config['overwrite']            = true;
                    
            
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('foto_alat')){  
                       // $this->update();
                        var_dump($config);
                        die();
                    }
                    else{
                        $data['foto_alat'] = $this->upload->data('file_name');
                    }
        }

            $this->Alat_medis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('alat_medis'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Alat_medis_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('alat_medis/update_action'),
		'id_alat' => set_value('id_alat', $row->id_alat),
		'nama_alat' => set_value('nama_alat', $row->nama_alat),
		'foto_alat' => set_value('foto_alat', $row->foto_alat),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'tanggal_alat_medis' => set_value('tanggal_alat_medis', $row->tanggal_alat_medis),
		'id_jenis' => set_value('id_jenis', $row->id_jenis),
        'id_puskesmas' => set_value('id_puskesmas', $row->id_jenis),
	    );
            $data['query']=$this->Jenis_model->get_list();
            $data['query1']=$this->Puskesmas_model->get_list();
            $this->template->set('title', 'invendismas purwantoro');
            $this->template->load('template', 'content', 'alat_medis/alat_medis_form', $data);
            $this->load->view('alat_medis/alat_medis_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alat_medis'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_alat', TRUE));
        } else {
            $data = array(
		'nama_alat' => $this->input->post('nama_alat',TRUE),
		'foto_alat' => $this->input->post('foto_alat',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'tanggal_alat_medis' => $this->input->post('tanggal_alat_medis',TRUE),
		'id_jenis' => $this->input->post('id_jenis',TRUE),
        'id_puskesmas' => $this->input->post('id_puskesmas',TRUE),
	    );
            if ($_FILES['foto_alat']['name']!=null || $_FILES['foto_alat']['name']!='') {
                    $config['upload_path']          = './upload/foto_alat/';
                    $config['allowed_types']        = 'jpeg|png|jpg';
                    $config['overwrite']            = true;
                    
            
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('foto_alat')){  
                       // $this->update();
                        var_dump($config);
                        die();
                    }
                    else{
                        $data['foto_alat'] = $this->upload->data('file_name');
                    }
        }

            $this->Alat_medis_model->update($this->input->post('id_alat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('alat_medis'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Alat_medis_model->get_by_id($id);

        if ($row) {
            $this->Alat_medis_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('alat_medis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alat_medis'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_alat', 'nama alat', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('tanggal_alat_medis', 'tanggal alat medis', 'trim|required');
	$this->form_validation->set_rules('id_jenis', 'id jenis', 'trim|required');

	$this->form_validation->set_rules('id_alat', 'id_alat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "alat_medis.xls";
        $judul = "alat_medis";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Alat");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto Alat");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Alat Medis");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Jenis");

	foreach ($this->Alat_medis_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_alat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto_alat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_alat_medis);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_jenis);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=alat_medis.doc");

        $data = array(
            'alat_medis_data' => $this->Alat_medis_model->get_all(),
            'start' => 0
        );
        $this->template->set('title', 'invendismas purwantoro');
        $this->template->load('template', 'content', 'alat_medis/alat_medis_doc', $data);
        $this->load->view('alat_medis/alat_medis_doc',$data);
    }

}

/* End of file Alat_medis.php */
/* Location: ./application/controllers/Alat_medis.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-20 17:10:13 */
/* http://harviacode.com */
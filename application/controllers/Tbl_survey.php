<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_survey extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tbl_survey_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_survey/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_survey/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_survey/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_survey_model->total_rows($q);
        $tbl_survey = $this->Tbl_survey_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_survey_data' => $tbl_survey,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_survey/tbl_survey_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_survey_model->get_by_id($id);
        if ($row) {
            $data = array(
		'catatan' => $row->catatan,
		'foto_jaminan' => $row->foto_jaminan,
		'foto_rumah' => $row->foto_rumah,
		'id_pengajuan' => $row->id_pengajuan,
		'id_survey' => $row->id_survey,
		'status' => $row->status,
		'tempat_kerja' => $row->tempat_kerja,
	    );
            $this->template->load('template','tbl_survey/tbl_survey_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_survey'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_survey/create_action'),
	    'catatan' => set_value('catatan'),
	    'foto_jaminan' => set_value('foto_jaminan'),
	    'foto_rumah' => set_value('foto_rumah'),
	    'id_pengajuan' => set_value('id_pengajuan'),
	    'id_survey' => set_value('id_survey'),
	    'status' => set_value('status'),
	    'tempat_kerja' => set_value('tempat_kerja'),
	);
        $this->template->load('template','tbl_survey/tbl_survey_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'catatan' => $this->input->post('catatan',TRUE),
		'foto_jaminan' => $this->input->post('foto_jaminan',TRUE),
		'foto_rumah' => $this->input->post('foto_rumah',TRUE),
		'id_pengajuan' => $this->input->post('id_pengajuan',TRUE),
		'status' => $this->input->post('status',TRUE),
		'tempat_kerja' => $this->input->post('tempat_kerja',TRUE),
	    );

            $this->Tbl_survey_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_survey'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_survey_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_survey/update_action'),
		'catatan' => set_value('catatan', $row->catatan),
		'foto_jaminan' => set_value('foto_jaminan', $row->foto_jaminan),
		'foto_rumah' => set_value('foto_rumah', $row->foto_rumah),
		'id_pengajuan' => set_value('id_pengajuan', $row->id_pengajuan),
		'id_survey' => set_value('id_survey', $row->id_survey),
		'status' => set_value('status', $row->status),
		'tempat_kerja' => set_value('tempat_kerja', $row->tempat_kerja),
	    );
            $this->template->load('template','tbl_survey/tbl_survey_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_survey'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_survey', TRUE));
        } else {
            $data = array(
		'catatan' => $this->input->post('catatan',TRUE),
		'foto_jaminan' => $this->input->post('foto_jaminan',TRUE),
		'foto_rumah' => $this->input->post('foto_rumah',TRUE),
		'id_pengajuan' => $this->input->post('id_pengajuan',TRUE),
		'status' => $this->input->post('status',TRUE),
		'tempat_kerja' => $this->input->post('tempat_kerja',TRUE),
	    );

            $this->Tbl_survey_model->update($this->input->post('id_survey', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_survey'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_survey_model->get_by_id($id);

        if ($row) {
            $this->Tbl_survey_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_survey'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_survey'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('catatan', 'catatan', 'trim|required');
	$this->form_validation->set_rules('foto_jaminan', 'foto jaminan', 'trim|required');
	$this->form_validation->set_rules('foto_rumah', 'foto rumah', 'trim|required');
	$this->form_validation->set_rules('id_pengajuan', 'id pengajuan', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('tempat_kerja', 'tempat kerja', 'trim|required');

	$this->form_validation->set_rules('id_survey', 'id_survey', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tbl_survey.php */
/* Location: ./application/controllers/Tbl_survey.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-09-10 13:27:01 */
/* http://harviacode.com */
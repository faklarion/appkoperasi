<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_pengajuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tbl_pengajuan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_pengajuan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_pengajuan/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_pengajuan/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_pengajuan_model->total_rows($q);
        $tbl_pengajuan = $this->Tbl_pengajuan_model->get_all();
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_pengajuan_data' => $tbl_pengajuan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_pengajuan/tbl_pengajuan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_pengajuan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_pengajuan' => $row->id_pengajuan,
                'no_pengajuan' => $row->no_pengajuan,
                'nama' => $row->nama,
                'alamat' => $row->alamat,
                'penghasilan' => $row->penghasilan,
                'jaminan' => $row->jaminan,
                'total_pinjaman' => $row->total_pinjaman,
                'tenor' => $row->tenor,
                'status' => $row->status,
	    );
            $this->template->load('template','tbl_pengajuan/tbl_pengajuan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengajuan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_pengajuan/create_action'),
            'id_pengajuan' => set_value('id_pengajuan'),
            'no_pengajuan' => set_value('no_pengajuan'),
            'nama' => set_value('nama'),
            'alamat' => set_value('alamat'),
            'penghasilan' => set_value('penghasilan'),
            'jaminan' => set_value('jaminan'),
            'total_pinjaman' => set_value('total_pinjaman'),
            'tenor' => set_value('tenor'),
            'status' => set_value('status'),
	);
        $this->template->load('template','tbl_pengajuan/tbl_pengajuan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_pengajuan' => $this->input->post('no_pengajuan',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'penghasilan' => $this->input->post('penghasilan',TRUE),
                'jaminan' => $this->input->post('jaminan',TRUE),
                'total_pinjaman' => $this->input->post('total_pinjaman',TRUE),
                'tenor' => $this->input->post('tenor',TRUE),
                'status' => '0',
            );

            $this->Tbl_pengajuan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success !');
            redirect(site_url('tbl_pengajuan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_pengajuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_pengajuan/update_action'),
                'id_pengajuan' => set_value('id_pengajuan', $row->id_pengajuan),
                'no_pengajuan' => set_value('no_pengajuan', $row->no_pengajuan),
                'nama' => set_value('nama', $row->nama),
                'alamat' => set_value('alamat', $row->alamat),
                'penghasilan' => set_value('penghasilan', $row->penghasilan),
                'jaminan' => set_value('jaminan', $row->jaminan),
                'total_pinjaman' => set_value('total_pinjaman', $row->total_pinjaman),
                'tenor' => set_value('tenor', $row->tenor),
                'status' => set_value('status', $row->status),
	        );
            $this->template->load('template','tbl_pengajuan/tbl_pengajuan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengajuan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pengajuan', TRUE));
        } else {
            $data = array(
                'no_pengajuan' => $this->input->post('no_pengajuan',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'penghasilan' => $this->input->post('penghasilan',TRUE),
                'jaminan' => $this->input->post('jaminan',TRUE),
                'total_pinjaman' => $this->input->post('total_pinjaman',TRUE),
                'tenor' => $this->input->post('tenor',TRUE),
                );

            $this->Tbl_pengajuan_model->update($this->input->post('id_pengajuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_pengajuan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_pengajuan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pengajuan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_pengajuan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengajuan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_pengajuan', 'no pengajuan', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('penghasilan', 'penghasilan', 'trim|required');
	$this->form_validation->set_rules('jaminan', 'jaminan', 'trim|required');
	$this->form_validation->set_rules('total_pinjaman', 'total pinjaman', 'trim|required');
	$this->form_validation->set_rules('tenor', 'tenor', 'trim|required');
	//$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_pengajuan', 'id_pengajuan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tbl_pengajuan.php */
/* Location: ./application/controllers/Tbl_pengajuan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-09-06 06:42:01 */
/* http://harviacode.com */
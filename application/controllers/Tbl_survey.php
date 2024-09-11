<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_survey extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_survey_model');
        $this->load->model('Tbl_pengajuan_model');
        $this->load->library('upload');
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
        $tbl_survey = $this->Tbl_survey_model->get_all();
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
            'data_pengajuan' => $this->Tbl_pengajuan_model->get_all(),
	);
        $this->template->load('template','tbl_survey/tbl_survey_form', $data);
    }

        // Fungsi untuk menangani multiple upload
        private function multiple_upload_rumah($field_name)
        {
            // Konfigurasi upload untuk foto rumah
            $config['upload_path']   = './assets/foto_rumah/'; // Tentukan direktori upload
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Tipe file yang diizinkan
            $config['max_size']      = 2048; // Ukuran maksimal (dalam kilobytes)
        
            // Load library upload dengan konfigurasi baru
            $this->load->library('upload', $config);
        
            $files = $_FILES[$field_name];
            $file_count = count($files['name']);
            $uploaded_files = array();
        
            for ($i = 0; $i < $file_count; $i++) {
                $_FILES['file']['name'] = $files['name'][$i];
                $_FILES['file']['type'] = $files['type'][$i];
                $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['file']['error'] = $files['error'][$i];
                $_FILES['file']['size'] = $files['size'][$i];
        
                // Proses upload
                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $uploaded_files[] = $upload_data['file_name']; // Simpan nama file yang di-upload
                } else {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                }
            }
        
            return $uploaded_files;
        }
        
        private function multiple_upload_jaminan($field_name)
        {
            // Konfigurasi upload untuk foto jaminan
            $config['upload_path']   = './assets/foto_jaminan/'; // Tentukan direktori upload
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Tipe file yang diizinkan
            $config['max_size']      = 4096; // Ukuran maksimal (dalam kilobytes)
        
            // Load library upload dengan konfigurasi baru
            $this->upload->initialize($config); // Perbaikan: gunakan initialize di sini!
        
            $files = $_FILES[$field_name];
            $file_count = count($files['name']);
            $uploaded_files = array();
        
            for ($i = 0; $i < $file_count; $i++) {
                $_FILES['file']['name'] = $files['name'][$i];
                $_FILES['file']['type'] = $files['type'][$i];
                $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['file']['error'] = $files['error'][$i];
                $_FILES['file']['size'] = $files['size'][$i];
        
                // Proses upload
                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $uploaded_files[] = $upload_data['file_name']; // Simpan nama file yang di-upload
                } else {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                }
            }
        
            return $uploaded_files;
        }
        
        public function create_action() 
        {
            $this->_rules();
        
            $foto_jaminan = $this->multiple_upload_jaminan('foto_jaminan');
            $foto_rumah = $this->multiple_upload_rumah('foto_rumah');
        
            // Gabungkan file yang di-upload dengan koma
            $foto_jaminan_imploded = implode(',', $foto_jaminan);
            $foto_rumah_imploded = implode(',', $foto_rumah);
        
            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                // Data untuk disimpan ke database
                $data = array(
                    'catatan' => $this->input->post('catatan',TRUE),
                    'foto_jaminan' => $foto_jaminan_imploded,
                    'foto_rumah' => $foto_rumah_imploded,
                    'id_pengajuan' => $this->input->post('id_pengajuan',TRUE),
                    'status' => '0',
                    'tempat_kerja' => $this->input->post('tempat_kerja',TRUE),
                );
        
                $this->Tbl_survey_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success !');
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
                'data_pengajuan' => $this->Tbl_pengajuan_model->get_all(),
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
        // Ambil data lama dari database
        $survey = $this->Tbl_survey_model->get_by_id($this->input->post('id_survey', TRUE));

        // Menyimpan data yang diinput pengguna
        $data = array(
            'catatan' => $this->input->post('catatan', TRUE),
            'id_pengajuan' => $this->input->post('id_pengajuan', TRUE),
            'tempat_kerja' => $this->input->post('tempat_kerja', TRUE),
        );

        // Cek jika ada file foto_jaminan yang diunggah
        if (!empty($_FILES['foto_jaminan']['name'][0])) {
            $uploaded_jaminan = $this->multiple_upload_jaminan('foto_jaminan');
            if (!empty($uploaded_jaminan)) {
                // Menggabungkan foto baru dengan yang sudah ada jika ada
                $foto_jaminan_imploded = implode(',', array_merge(explode(',', $survey->foto_jaminan), $uploaded_jaminan));
                $data['foto_jaminan'] = $foto_jaminan_imploded;
            }
        }

        // Cek jika ada file foto_rumah yang diunggah
        if (!empty($_FILES['foto_rumah']['name'][0])) {
            $uploaded_rumah = $this->multiple_upload_rumah('foto_rumah');
            if (!empty($uploaded_rumah)) {
                // Menggabungkan foto baru dengan yang sudah ada jika ada
                $foto_rumah_imploded = implode(',', array_merge(explode(',', $survey->foto_rumah), $uploaded_rumah));
                $data['foto_rumah'] = $foto_rumah_imploded;
            }
        }

        // Update data ke database
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
    
    public function delete_photo_jaminan() {
        // Retrieve the photo URL from the form submission
        $photo_url = $this->input->post('photo_url');
        $id = $this->input->post('id_survey');
    
        // Perform deletion logic (update your database accordingly)
        // Example: Delete from database
        $success = $this->Tbl_survey_model->delete_photo_jaminan_by_url($id, $photo_url);
    
        if ($success) {
            // Redirect or refresh the page after deletion
            redirect('Tbl_survey');
        } else {
            // Handle deletion failure
            echo "Failed to delete photo.";
        }
    }

    public function delete_photo_rumah() {
        // Retrieve the photo URL from the form submission
        $photo_url = $this->input->post('photo_url');
        $id = $this->input->post('id_survey');
    
        // Perform deletion logic (update your database accordingly)
        // Example: Delete from database
        $success = $this->Tbl_survey_model->delete_photo_rumah_by_url($id, $photo_url);
    
        if ($success) {
            // Redirect or refresh the page after deletion
            redirect('Tbl_survey');
        } else {
            // Handle deletion failure
            echo "Failed to delete photo.";
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('catatan', 'catatan', 'trim|required');
        //$this->form_validation->set_rules('foto_jaminan', 'foto jaminan', 'trim|required');
        //$this->form_validation->set_rules('foto_rumah', 'foto rumah', 'trim|required');
        //$this->form_validation->set_rules('id_pengajuan', 'id pengajuan', 'trim|required');
        //$this->form_validation->set_rules('status', 'status', 'trim|required');
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
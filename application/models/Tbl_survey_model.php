<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_survey_model extends CI_Model
{

    public $table = 'tbl_survey';
    public $id = 'id_survey';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->join('tbl_pengajuan', 'tbl_pengajuan.id_pengajuan = tbl_survey.id_pengajuan');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_foto_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    public function delete_photo_jaminan_by_url($id_survey, $photo_url) {
        // Fetch the existing photo URLs
        $foto = $this->db->select('foto_jaminan')
                               ->where('id_survey', $id_survey)
                               ->get($this->table)
                               ->row()
                               ->foto_jaminan;
    
        // Explode the fetched photo string into an array of photo URLs
        $photos = array_map('trim', explode(",", $foto));
    
        // Find the index of the photo URL to delete
        $index = array_search($photo_url, $photos);
    
        if ($index !== false) {
            // Remove the photo URL from the array
            unset($photos[$index]);
    
            // Implode the array back into a comma-separated string
            $updated_foto = implode(",", $photos);
    
            // Update the database record with the updated foto_jaminan
            $this->db->where('id_survey', $id_survey)
                     ->update($this->table, ['foto_jaminan' => $updated_foto]);
    
            // Path to the directory where the photos are stored
            $file_path = './assets/foto_jaminan/' . basename($photo_url);
    
            // Delete the physical file if it exists
            if (file_exists($file_path)) {
                unlink($file_path);
            }
    
            // Return TRUE if update and file deletion were successful
            return true;
        }
    
        // Return FALSE if photo URL was not found
        return false;
    }
    

    public function delete_photo_rumah_by_url($id_survey, $photo_url) {
        // Fetch the existing photo URLs
        $foto = $this->db->select('foto_rumah')
                               ->where('id_survey', $id_survey)
                               ->get($this->table)
                               ->row()
                               ->foto_rumah;
    
        // Explode the fetched photo string into an array of photo URLs
        $photos = array_map('trim', explode(",", $foto));
    
        // Find the index of the photo URL to delete
        $index = array_search($photo_url, $photos);
    
        if ($index !== false) {
            // Remove the photo URL from the array
            unset($photos[$index]);
    
            // Implode the array back into a comma-separated string
            $updated_foto = implode(",", $photos);
    
            // Update the database record with the updated foto_rumah
            $this->db->where('id_survey', $id_survey)
                     ->update($this->table, ['foto_rumah' => $updated_foto]);
    
            // Path to the directory where the photos are stored
            $file_path = './assets/foto_jaminan/' . basename($photo_url);
    
            // Delete the physical file if it exists
            if (file_exists($file_path)) {
                unlink($file_path);
            }
    
            // Return TRUE if update and file deletion were successful
            return true;
        }
    
        // Return FALSE if photo URL was not found
        return false;
    }
    
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_survey', $q);
        $this->db->or_like('catatan', $q);
        $this->db->or_like('foto_jaminan', $q);
        $this->db->or_like('foto_rumah', $q);
        $this->db->or_like('id_pengajuan', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('tempat_kerja', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_survey', $q);
	$this->db->or_like('catatan', $q);
	$this->db->or_like('foto_jaminan', $q);
	$this->db->or_like('foto_rumah', $q);
	$this->db->or_like('id_pengajuan', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('tempat_kerja', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Tbl_survey_model.php */
/* Location: ./application/models/Tbl_survey_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-09-10 13:27:01 */
/* http://harviacode.com */
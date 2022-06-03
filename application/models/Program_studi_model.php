<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Program_studi_model extends CI_Model 
{

    public function get_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('program_studi')->row_array();
    }

    public function get_all()
    {
        return $this->db->get('program_studi')->result_array();
    }

}
<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Auth_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function authenticate()
    // melakukan authentikasi user
    {
        $username = $this->input->post('username',TRUE);
        $password = md5($this->input->post('password'));
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $result = $this->db->get('user');
        if ($result->num_rows()>0){
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
} 
 
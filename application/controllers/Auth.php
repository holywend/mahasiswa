<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    // fungsi default controller Auth 
    {
        if($this->session->userdata('login'))
        {
            redirect('Mahasiswa');
        }
        $this->load->view('signin');
    }

    public function signin()
    {
        $this->load->model('Auth_model');
        if ($this->Auth_model->authenticate())
        // jika autentikasi benar
        // simpan ke data sesi dan panggil controller Mahasiswa
        {
            $data_session = array(
                'username'=>$this->input->post('username'),
                'login'=>TRUE
            );
            $this->session->set_userdata($data_session);
            redirect('Mahasiswa');
        }
        else
        // jika autentikasi salah
        {
            $this->session->set_flashdata('fail','Username dan password salah!');
            redirect('Auth');
       }
    }

   public function signout()
   {
       $this->session->sess_destroy();
       redirect('Auth');
   }
}

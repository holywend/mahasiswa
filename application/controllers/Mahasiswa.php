<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model');
        $this->load->model('Program_studi_model');
        if (!$this->session->userdata('login'))
        // jika login false maka redirect ke controller Auth
        {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['content'] = 'mahasiswa/list';
        $data['partials'] = array(
            'mahasiswa/js','mahasiswa/modal'
        );
        $data['program_studies'] = $this->Program_studi_model->get_all();
        $this->load->view('template', $data);
    }

    public function ajax_list()
    {
        $list = $this->Mahasiswa_model->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        // $row berisi array yang akan di tampilkan pada satu row di datatables
        // $data berisi array dari $row
        foreach ($list as $item)
        {
            $row = array();
            $row[] = $item['nim'];
            $row[] = strtoupper($item['nama']);
            $row[] = strtoupper($item['jenis_kelamin']);
            $row[] = strtoupper($item['tempat']);
            $row[] = $item['tanggal'];
            $program_studi = $this->Program_studi_model->get_by_id($item['id_program_studi']);
            $row[] = strtoupper($program_studi['nama']);
            $row[] = "<img class='img-fluid' style='width:100px;' src=".site_url('uploads/'.$item['file_foto']).">";
            $row[] = "<a class='btn btn-small text-warning ml-1 pl-0 mr-1 pr-0' onclick=edit_mahasiswa('".$item['nim']."')><i class='fas fa-edit' title='Update'></i></a><a class='btn btn-small text-danger ml-1 pl-0 mr-1 pr-0' onclick=delete_confirm('".$item['nim']."')><i class='fas fa-trash' title='Hapus'></i></a>";
            $data[] = $row;
        }
        $output = array(
            "draw"=>$_POST['draw'],
            "recordsTotal"=> $this->Mahasiswa_model->count_all(),
            "recordsFiltered" => $this->Mahasiswa_model->count_filtered(),
            "data"=>$data
        );
        echo json_encode($output);
    }

    public function ajax_add()
    {
        // melakukan validasi berdasarkan rules
        $rules = $this->_get_validation_rules();
        $this->form_validation->set_rules($rules);
        // nim ketika add harus unik
        $this->form_validation->set_rules('nim','NIM','required|exact_length[9]|is_unique[mahasiswa.nim]');
        // userfile wajib diisi ketika nambah data baru
        if (empty($_FILES['userfile']['name']))
        {
            $this->form_validation->set_rules('userfile', 'Foto', 'required');
        }
        if ($this->form_validation->run())
        {
            $file_foto = $this->_do_upload();
            if ($this->Mahasiswa_model->insert_mahasiswa($file_foto) > 0)
            {
                echo json_encode(array('status'=>TRUE,'message'=>'Tambah mahasiswa berhasil'));
            }
            else
            {
                echo json_encode(array('status'=>FALSE,'message'=>'Tambah mahasiswa gagal'));
            }
        }
        else
        {
            $invalid = $this->form_validation->error_array();
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = FALSE;
            foreach ($invalid as $key=>$value)
            {
                $data['inputerror'][] = $key;
                $data['error_string'][] = $value;
            }
            echo json_encode($data);
        }
    }
    
    public function ajax_edit($nim)
    {
        $data = $this->Mahasiswa_model->get_mahasiswa_by_nim($nim);
        if (empty($data))
        {
            echo json_encode(array('status'=>FALSE,'message'=>'Mahasiswa tidak ketemu'));
            exit();
        }
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    public function ajax_update()
    {
        // melakukan validasi berdasarkan rules
        $rules = $this->_get_validation_rules();
        $this->form_validation->set_rules($rules);
        // nim ketika edit tidak unik
        $this->form_validation->set_rules('nim','NIM','required|exact_length[9]');
        // userfile tidak wajib diisi ketika edit
        if ($this->form_validation->run())
        {
            if (!empty($_FILES['userfile']['name']))
            {
                $file_foto = $this->_do_upload();
            }
            // $this->load->model('Mahasiswa_model');
            if (isset($file_foto))
            {
                $result = $this->Mahasiswa_model->update_mahasiswa($file_foto);
            }
            else
            {
                $result = $this->Mahasiswa_model->update_mahasiswa();
            }
            if ($result > 0)
            {
                echo json_encode(array('status'=>TRUE,'message'=>'Update mahasiswa berhasil'));
            }
            else
            {
                echo json_encode(array('status'=>FALSE,'message'=>'Update mahasiswa gagal'));
            }
        }
        else
        {
            $invalid = $this->form_validation->error_array();
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = FALSE;
            foreach ($invalid as $key=>$value)
            {
                $data['inputerror'][] = $key;
                $data['error_string'][] = $value;
            }
            echo json_encode($data);
        }
    }

    public function ajax_delete($nim)
    {
        $mahasiswa = $this->Mahasiswa_model->get_mahasiswa_by_nim($nim);
        // hapus file foto mahasiswa tersebut dari server
        if (file_exists('uploads/'.$mahasiswa['file_foto']))
        {
            unlink('uploads/'.$mahasiswa['file_foto']);
        }
        $result = $this->Mahasiswa_model->delete_mahasiswa($nim);
        if ($result > 0)
        {
            echo json_encode(array('status'=>TRUE,'message'=>'Hapus mahasiswa berhasil'));
        }
        else
        {
            echo json_encode(array('status'=>FALSE,'message'=>'Hapus mahasiswa gagal'));
        }
    }

    private function _do_upload()
    {
        $config = array(
            'file_name' => $this->input->post('nim',TRUE),
            'upload_path' => "uploads",
            'allowed_types' => "jpg|jpeg|png",
            'overwrite' => TRUE,
            'max_size' => "512" 
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload())
        {
            return $this->upload->data('file_name');
        }
        else
        {
            $data = array();
            $data['status'] = FALSE;
            $data['inputerror'][] = 'userfile';
            $data['error_string'][] = $this->upload->display_errors('', '');;
            echo json_encode($data);
            exit();
        }
    }

    private function _get_validation_rules()
    // validasi form kecuali nim dan userfile 
    {
        $rules = array(
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required'
            ),
            array(
                'field' => 'tempat',
                'label' => 'Tempat Lahir',
                'rules' => 'required'
            ),
            array(
                'field' => 'tanggal',
                'label' => 'Tanggal Lahir',
                'rules' => 'required'
            ),
            array(
                'field' => 'jenis_kelamin',
                'label' => 'Jenis Kelamin',
                'rules' => 'required'
            ),
            array(
                'field' => 'id_program_studi',
                'label' => 'Program Studi',
                'rules' => 'required'
            )
        );
        return $rules;
    }    

}
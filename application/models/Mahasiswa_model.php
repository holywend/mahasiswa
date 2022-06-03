<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Mahasiswa_model extends CI_Model 
{
    // column yang kita gunakan untuk sorting
    var $column_order = array('nim','mahasiswa.nama','jenis_kelamin','tempat','tanggal','program_studi.nama');
    // column yang kita gunakan untuk searching
    var $column_search = array('nim','mahasiswa.nama','jenis_kelamin','tempat','tanggal');
    // field sorting default
    var $order = array('nim', 'desc');

    public function get_datatables()
    {
        $this->_get_datatables_query();
        // jika length bukan unlimited maka gunakan limit sebanyak length dimulai dari index start
        // length dan start dari datatables
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered()
    // mendapatkan jumlah record termasuk ketika sudah di filter dari searchnya datatables
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    // mendapatkan jumlah record tanpa filter dari datatables
    {
        $this->db->from('mahasiswa');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_mahasiswa_by_nim($nim)
    {
        $this->db->where('nim', $nim);
        return $this->db->get('mahasiswa')->row_array();
    }

    public function insert_mahasiswa($file_foto)
    // melakukan penambahan data mahasiswa baru
    {
        $data_mahasiswa = array(
            'nim' => $this->input->post('nim',TRUE),
            'nama' => $this->input->post('nama',TRUE),
            'tempat' => $this->input->post('tempat',TRUE),
            'tanggal' => $this->input->post('tanggal',TRUE),
            'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
            'id_program_studi' => $this->input->post('id_program_studi',TRUE),
            'file_foto' => $file_foto
        );
        $this->db->set($data_mahasiswa);
        $this->db->insert('mahasiswa');
        return $this->db->affected_rows();
    }

    public function update_mahasiswa($file_foto = NULL)
    // melakukan perubahan data mahasiswa, nim tidak boleh diubah
    {
        $data_mahasiswa = array(
            'nama' => $this->input->post('nama',TRUE),
            'tempat' => $this->input->post('tempat',TRUE),
            'tanggal' => $this->input->post('tanggal',TRUE),
            'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
            'id_program_studi' => $this->input->post('id_program_studi',TRUE)
        );
        if ($file_foto != NULL)
        // jika file_foto terisi maka di update
        // jika NULL maka file_foto tidak perlu di update
        {
            $data_mahasiswa['file_foto'] = $file_foto;
        }
        $nim = $this->input->post('nim',TRUE);
        $this->db->where('nim',$nim);
        $this->db->update('mahasiswa',$data_mahasiswa);
        return $this->db->affected_rows();
    }

    public function delete_mahasiswa($nim)
    // melakukan penghapusan data mahasiswa
    {
        $this->db->where('nim',$nim);
        $this->db->delete('mahasiswa');
        return $this->db->affected_rows();
    }

    private function _get_datatables_query()
    {
        $this->db->select('mahasiswa.*, program_studi.nama as nama_prodi');
        $this->db->from('mahasiswa');
        $this->db->join('program_studi','mahasiswa.id_program_studi = program_studi.id','left');
        $i = 0;
        foreach($this->column_search as $item)
        {
            // jalankan ketika user mengetik value di kotak search datatables
            if ($_POST['search']['value'])
            {
                if ($i == 0) // loop pertama
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else // loop kedua gunakan or_like
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search)-1 == $i) // loop terakhir
                {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order)){
            $this->db->order_by($this->order[0], $this->order[1]);
        }
    }    
}
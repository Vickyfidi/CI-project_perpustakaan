<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_petugas extends CI_Model
{
    public function ambil_petugas()
    {
        $this->db->from('user');
        $this->db->where('id', $this->session->userdata('id'));
        $query = $this->db->get();
        return $query->row();
    }

    function cari_username($username)
    {
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->result();
    }
}

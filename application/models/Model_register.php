<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Model_register extends CI_Model
{

    function save_registrasi()
    {
        $data = [
            'nama'              => htmlspecialchars($this->input->post('nama', true)),
            'username'          => htmlspecialchars($this->input->post('username', true)),
            'password'          => md5($this->input->post('password')),
            'level_pengguna'    => htmlspecialchars($this->input->post('level_pengguna', true))
        ];
        $this->db->insert('user', $data);
    }

    function cek_username($username)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('username', $username);
        $Q = $this->db->get('user');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
}

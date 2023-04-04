<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

class Profile extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $sesi_login = $this->session->userdata('loginMasuk');
        $level = $this->session->userdata('level_pengguna');
        if ($sesi_login == false || $level != 'Admin') {
            redirect('login');
        }
    }

    public function index()
    {
        $data['judul'] = 'My Profile';
        $data['header'] = 'admin/template/header';
        $data['sidebar'] = 'admin/template/sidebar';
        $data['isi'] = 'admin/isi/my_profile';
        $data['footer'] = 'admin/template/footer';
        $data['profile'] = $this->m_user->ambil_user();
        $this->load->view('admin/template/layout', $data);
    }

    public function update_profil()
    {
        $this->_validate_update_profile();

        $data1 = array(
            'nama'    => $this->input->post('nama'),
            'username'    => $this->input->post('username')
        );
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('user', $data1);
        echo json_encode(array("status" => TRUE));
    }

    public function update_password()
    {
        $this->validate_password();
        $data = array(
            'password'    => md5($this->input->post('password_baru'))
        );
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('user', $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate_update_profile()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $admin = $this->m_user->ambil_user();
        $username = $this->input->post('username');
        $jum_user = count($this->m_user->cari_username($username));

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($jum_user == 1 && $this->input->post('username') != $admin->username) {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username telah digunakan';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function validate_password()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $admin = $this->m_user->ambil_user();
        $username = $this->input->post('username');
        $jum_user = count($this->m_user->cari_username($username));

        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if (md5($this->input->post('password')) != $admin->password) {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password tidak sesuai';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password_baru') == '') {
            $data['inputerror'][] = 'password_baru';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('ketik_ulang_password_baru') == '') {
            $data['inputerror'][] = 'ketik_ulang_password_baru';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('ketik_ulang_password_baru') != $this->input->post('password_baru')) {
            $data['inputerror'][] = 'ketik_ulang_password_baru';
            $data['error_string'][] = 'Field tidak sesuai dengan password baru';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

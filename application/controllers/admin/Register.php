<?php
defined('BASEPATH') or exit('No dirrect script access allowed');
class Register extends CI_Controller
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
        $data['judul'] = 'Register | Perpus Darul Ilmi';
        $data['header'] = 'admin/template/header';
        $data['sidebar'] = 'admin/template/sidebar';
        $data['isi'] = 'admin/isi/register';
        $data['footer'] = 'admin/template/footer';
        $this->load->view('admin/template/layout', $data);
    }

    public function simpan_pendaftaran()
    {
        $this->_validate_pendaftaran();
        $this->model_register->save_registrasi();
        $this->session->set_flashdata('pesan', '<script>swal.fire("Berhasil","Pendaftaran Berhasil, silahkan login menggunakan username dan password yang telah terdaftar","success")</script>');
        echo json_encode(array("status" => TRUE));
    }

    private function _validate_pendaftaran()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $username = $this->input->post('username');
        $cek_usernamenya = count($this->model_register->cek_username($username));

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('password_ulang') == '') {
            $data['inputerror'][] = 'password_ulang';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('level_pengguna') == '') {
            $data['inputerror'][] = 'level_pengguna';
            $data['error_string'][] = 'Level Pengguna Harus diPilih';
            $data['status'] = FALSE;
        }
        if ($cek_usernamenya == 1) {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username telah digunakan';
            $data['status'] = FALSE;
        }
        if ($this->input->post('password_ulang') != $this->input->post('password')) {
            $data['inputerror'][] = 'password_ulang';
            $data['error_string'][] = 'Verifikasi password tidak sama';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

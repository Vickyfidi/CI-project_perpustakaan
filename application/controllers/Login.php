<?php
defined('BASEPATH') or exit('No dirrect script access allowed');
class Login extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Login | Perpustakaan Darul Ilmi';
        $this->load->view('login', $data);
    }

    public function cek_login()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");

        $cek = $this->m_login->cek_data_pengguna($username, md5($password));

        if (count($cek) == 1) {
            foreach ($cek as $rows) {
                $id = $rows['id'];
                $nama = $rows['nama'];
                $level_pengguna = $rows['level_pengguna'];
            }

            $this->session->set_userdata(array(
                'loginMasuk'        => TRUE,
                'id'             => $id,
                'nama'         => $nama,
                'level_pengguna'     => $level_pengguna
            ));

            if ($this->session->userdata('level_pengguna') == 'Admin') {
                redirect('admin/dashboard');
            } else {
                redirect('petugas/dashboard');
            }
        } else {
            $this->session->set_flashdata('pesan', '<script>swal.fire("Error","Username atau password Salah","error")</script>');
            redirect('login');
        }
    }


    function keluar()
    {
        $this->session->unset_userdata('loginMasuk');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('level_pengguna');
        $this->session->sess_destroy();
        redirect('login');
    }
}

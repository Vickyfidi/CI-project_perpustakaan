<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

class Data_user extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $cek = $this->session->userdata('loginMasuk');
        if ($cek == FALSE) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['judul'] = 'Data User';
        $data['header'] = 'admin/template/header';
        $data['sidebar'] = 'admin/template/sidebar';
        $data['isi'] = 'admin/isi/data_user';
        $data['footer'] = 'admin/template/footer';
        $this->load->view('admin/template/layout', $data);
    }

    public function ajax_list()
    {
        $list = $this->m_user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $user->nama;
            $row[] = $user->username;
            $row[] = $user->level_pengguna;
            $row[] = ' <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
            <a href="javascript:void(0)" class="btn btn-danger" title="Hapus" onclick="delete_user(' . "'" . $user->id . "'" . ')"><i class="fas fa-trash"></i></a>
            </div>
            </td>
            ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_user->count_all(),
            "recordsFiltered" => $this->m_user->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_delete($id)
    {
        $this->m_user->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
}

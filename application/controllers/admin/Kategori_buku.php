<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

class Kategori_buku extends CI_Controller
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
        $data['judul'] = 'Kategori Buku';
        $data['header'] = 'admin/template/header';
        $data['sidebar'] = 'admin/template/sidebar';
        $data['isi'] = 'admin/isi/kategori_buku';
        $data['footer'] = 'admin/template/footer';
        $this->load->view('admin/template/layout', $data);
    }

    public function ajax_list()
    {
        $list = $this->model_kategori->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;
        foreach ($list as $kategori) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $kategori->kode_kategori;
            $row[] = $kategori->nama_kategori;
            $row[] = ' <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
            <a href="javascript:void(0)" class="btn btn-primary"><i class="fas fa-edit" title="Edit" onclick="edit_kategori(' . "'" . $kategori->id_kategori . "'" . ')"></i></a>
            <a href="javascript:void(0)" class="btn btn-danger" title="Hapus" onclick="delete_kategori(' . "'" . $kategori->id_kategori . "'" . ')"><i class="fas fa-trash"></i></a>
            </div>
            </td>
            ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_kategori->count_all(),
            "recordsFiltered" => $this->model_kategori->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
            'kode_kategori' => $this->input->post('kode_kategori'),
            'nama_kategori' => $this->input->post('nama_kategori')
        );
        $insert = $this->model_kategori->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id_kategori)
    {
        $data = $this->model_kategori->get_by_id($id_kategori);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('kode_kategori') == '') {
            $data['inputerror'][] = 'kode_kategori';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nama_kategori') == '') {
            $data['inputerror'][] = 'nama_kategori';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
        $data = array(
            'kode_kategori' => htmlspecialchars($this->input->post('kode_kategori')),
            'nama_kategori' => $this->input->post('nama_kategori')
        );
        $this->model_kategori->update(array('id_kategori' => $this->input->post('id_kategori')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id_kategori)
    {
        $this->model_kategori->delete_by_id($id_kategori);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $kode_kategori = $this->input->post('kode_kategori');
        $cek_kodekategori = count($this->model_kategori->cek_kode_kategori($kode_kategori));
        $nama_kategori = $this->input->post('nama_kategori');
        $cek_namakategori = count($this->model_kategori->cek_kategori($nama_kategori));

        if ($this->input->post('kode_kategori') == '') {
            $data['inputerror'][] = 'kode_kategori';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nama_kategori') == '') {
            $data['inputerror'][] = 'nama_kategori';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($cek_kodekategori == 1) {
            $data['inputerror'][] = 'kode_kategori';
            $data['error_string'][] = 'kode Kategori telah ada';
            $data['status'] = FALSE;
        }
        if ($cek_namakategori == 1) {
            $data['inputerror'][] = 'nama_kategori';
            $data['error_string'][] = 'Nama Kategori telah ada';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

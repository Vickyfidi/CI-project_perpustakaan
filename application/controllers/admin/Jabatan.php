<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

class Jabatan extends CI_Controller
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
        $data['judul'] = 'Jabatan';
        $data['header'] = 'admin/template/header';
        $data['sidebar'] = 'admin/template/sidebar';
        $data['isi'] = 'admin/isi/jabatan';
        $data['footer'] = 'admin/template/footer';
        $this->load->view('admin/template/layout', $data);
    }

    public function ajax_list()
    {
        $list = $this->m_jabatan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;
        foreach ($list as $jabatan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $jabatan->nama_jabatan;
            $row[] = ' <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
            <a href="javascript:void(0)" class="btn btn-primary"><i class="fas fa-edit" title="Edit" onclick="edit_jabatan(' . "'" . $jabatan->id_jabatan . "'" . ')"></i></a>
            <a href="javascript:void(0)" class="btn btn-danger" title="Hapus" onclick="delete_jabatan(' . "'" . $jabatan->id_jabatan . "'" . ')"><i class="fas fa-trash"></i></a>
            </div>
            </td>
            ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_jabatan->count_all(),
            "recordsFiltered" => $this->m_jabatan->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
            'nama_jabatan' => $this->input->post('nama_jabatan')
        );
        $insert = $this->m_jabatan->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id_jabatan)
    {
        $data = $this->m_jabatan->get_by_id($id_jabatan);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_jabatan') == '') {
            $data['inputerror'][] = 'nama_jabatan';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
        $data = array(
            'nama_jabatan' => $this->input->post('nama_jabatan')
        );
        $this->m_jabatan->update(array('id_jabatan' => $this->input->post('id_jabatan')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id_jabatan)
    {
        $this->m_jabatan->delete_by_id($id_jabatan);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $nama_jabatan = $this->input->post('nama_jabatan');
        $cek_namajabatan = count($this->m_jabatan->cek_jabatan($nama_jabatan));

        if ($this->input->post('nama_jabatan') == '') {
            $data['inputerror'][] = 'nama_jabatan';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($cek_namajabatan == 1) {
            $data['inputerror'][] = 'nama_jabatan';
            $data['error_string'][] = 'Nama jabatan telah terdaftar';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

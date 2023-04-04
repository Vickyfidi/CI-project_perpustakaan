<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

class Pegawai extends CI_Controller
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
        $this->load->helper('url');
        $data['judul'] = 'Data Staf/Pegawai Perpustakaan';
        $data['header'] = 'admin/template/header';
        $data['sidebar'] = 'admin/template/sidebar';
        $data['isi'] = 'admin/isi/pegawai';
        $data['footer'] = 'admin/template/footer';
        $data['getjabatan'] = $this->m_pegawai->ambil_jabatan();
        $this->load->view('admin/template/layout', $data);
    }


    public function ajax_list()
    {
        $this->load->helper('url');
        $list = $this->m_pegawai->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;
        foreach ($list as $pegawai) {
            $no++;
            $row = array();
            $row[] = $no;
            if ($pegawai->foto)
                $row[] = '<img href="' . base_url('./upload/foto/pegawai/' . $pegawai->foto) . '"><img src="' . base_url('./upload/foto/pegawai/' . $pegawai->foto) . '" class="img-fluid" width="50"/></img>';
            else
                $row[] = '(No foto)';
            $row[] = $pegawai->nama;
            $row[] = $pegawai->nip;
            $row[] = $pegawai->tmpt_lahir;
            $row[] = $pegawai->tgl_lahir;
            $row[] = $pegawai->no_telp;
            $row[] = $pegawai->nama_jabatan;
            $row[] = $pegawai->alamat;


            $row[] = '<td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
            <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Edit" onclick="edit_pegawai(' . "'" . $pegawai->id . "'" . ')"><i class="fas fa-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Hapus" onclick="delete_pegawai(' . "'" . $pegawai->id . "'" . ')"><i class="fas fa-trash"></i></a>
            </div>
            </td>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_pegawai->count_all(),
            "recordsFiltered" => $this->m_pegawai->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->m_pegawai->get_by_id($id);
        echo json_encode($data);
    }


    public function ajax_add()
    {
        $this->_validate();

        $data = array(
            'id_jabatan' => $this->input->post('id_jabatan'),
            'nama' => $this->input->post('nama'),
            'nip' => $this->input->post('nip'),
            'tmpt_lahir' => $this->input->post('tmpt_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat')
        );

        if (!empty($_FILES['foto']['name'])) {
            $upload = $this->_do_upload();
            $data['foto'] = $upload;
        }

        $insert = $this->m_pegawai->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nip') == '') {
            $data['inputerror'][] = 'nip';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tmpt_lahir') == '') {
            $data['inputerror'][] = 'tmpt_lahir';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('tgl_lahir') == '') {
            $data['inputerror'][] = 'tgl_lahir';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('no_telp') == '') {
            $data['inputerror'][] = 'no_telp';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('id_jabatan') == '') {
            $data['inputerror'][] = 'id_jabatan';
            $data['error_string'][] = 'Jabatan harus dipilih';
            $data['status'] = FALSE;
        }

        $data = array(
            'id_jabatan' => $this->input->post('id_jabatan'),
            'nama' => $this->input->post('nama'),
            'nip' => $this->input->post('nip'),
            'tmpt_lahir' => $this->input->post('tmpt_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat')
        );

        if ($this->input->post('remove_foto')) // if remove photo checked
        {
            if (file_exists('./upload/foto/pegawai/' . $this->input->post('remove_foto')) && $this->input->post('remove_foto'))
                unlink('./upload/foto/pegawai/' . $this->input->post('remove_foto'));
            $data['foto'] = '';
        }

        if (!empty($_FILES['foto']['name'])) {
            $upload = $this->_do_upload();

            //delete file
            $pegawai = $this->m_pegawai->get_by_id($this->input->post('id'));
            if (file_exists('./upload/foto/pegawai/' . $pegawai->foto) && $pegawai->foto)
                unlink('./upload/foto/pegawai/' . $pegawai->foto);

            $data['foto'] = $upload;
        }

        $this->m_pegawai->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        //delete file
        $pegawai = $this->m_pegawai->get_by_id($id);
        if (file_exists('./upload/foto/pegawai/' . $pegawai->foto) && $pegawai->foto)
            unlink('./upload/foto/pegawai/' . $pegawai->foto);

        $this->m_pegawai->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = './upload/foto/pegawai/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2000; //set max size allowed in Kilobyted
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('foto')) //upload and validate
        {
            $data['inputerror'][] = 'foto';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('error', 'bbbb'); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $nip = $this->input->post('nip');
        $cek_nip = count($this->m_pegawai->cek_pegawai($nip));

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nip') == '') {
            $data['inputerror'][] = 'nip';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($cek_nip == 1) {
            $data['inputerror'][] = 'nip';
            $data['error_string'][] = 'NIP sudah digunakan';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tmpt_lahir') == '') {
            $data['inputerror'][] = 'tmpt_lahir';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('tgl_lahir') == '') {
            $data['inputerror'][] = 'tgl_lahir';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('no_telp') == '') {
            $data['inputerror'][] = 'no_telp';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('id_jabatan') == '') {
            $data['inputerror'][] = 'id_jabatan';
            $data['error_string'][] = 'Jabatan harus dipilih';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

class Siswa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $cek = $this->session->userdata('loginMasuk');
        if ($cek == FALSE) {
            redirect('login');
        }
        $this->load->model('model_siswa', 'm_siswa');
    }

    public function index()
    {
        $this->load->helper('url');
        $data['judul'] = 'Data Anggota';
        $data['header'] = 'petugas/template/header';
        $data['sidebar'] = 'petugas/template/sidebar';
        $data['isi'] = 'petugas/isi/siswa';
        $data['footer'] = 'petugas/template/footer';
        $data['no_anggota'] = $this->m_siswa->getKodeAnggota();
        $this->load->view('petugas/template/layout', $data);
    }


    public function ajax_list()
    {
        $this->load->helper('url');
        $list = $this->m_siswa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;
        foreach ($list as $siswa) {
            $no++;
            $row = array();
            $row[] = $no;
            if ($siswa->foto)
                $row[] = '<img href="' . base_url('./upload/foto/siswa/' . $siswa->foto) . '"><img src="' . base_url('./upload/foto/siswa/' . $siswa->foto) . '" class="img-fluid" width="50"/></img>';
            else
                $row[] = '(No foto)';
            $row[] = $siswa->no_anggota;
            $row[] = $siswa->nama;
            $row[] = $siswa->nis;
            $row[] = $siswa->jk;
            $row[] = $siswa->tmpt_lahir;
            $row[] = $siswa->tgl_lahir;
            $row[] = $siswa->no_telp;
            $row[] = $siswa->alamat;
            $row[] = '<td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
            <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Edit" onclick="edit_siswa(' . "'" . $siswa->id . "'" . ')"><i class="fas fa-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Hapus" onclick="delete_siswa(' . "'" . $siswa->id . "'" . ')"><i class="fas fa-trash"></i></a>
            </div>
            </td>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_siswa->count_all(),
            "recordsFiltered" => $this->m_siswa->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->m_siswa->get_by_id($id);
        echo json_encode($data);
    }
    public function ajax_detail($id)
    {
        $data = $this->m_siswa->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = array(
            'no_anggota' => $this->input->post('no_anggota'),
            'nama' => $this->input->post('nama'),
            'nis' => $this->input->post('nis'),
            'jk' => $this->input->post('jk'),
            'tmpt_lahir' => $this->input->post('tmpt_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat'),
        );

        if (!empty($_FILES['foto']['name'])) {
            $upload = $this->_do_upload();
            $data['foto'] = $upload;
        }

        $insert = $this->m_siswa->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nis') == '') {
            $data['inputerror'][] = 'nis';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('jk') == '') {
            $data['inputerror'][] = 'jk';
            $data['error_string'][] = 'Jenis Kelamin harus dipilih';
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

        $data = array(
            'no_anggota' => $this->input->post('no_anggota'),
            'nama' => $this->input->post('nama'),
            'nis' => $this->input->post('nis'),
            'jk' => $this->input->post('jk'),
            'tmpt_lahir' => $this->input->post('tmpt_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat'),
        );

        if ($this->input->post('remove_foto')) // if remove photo checked
        {
            if (file_exists('./upload/foto/siswa/' . $this->input->post('remove_foto')) && $this->input->post('remove_foto'))
                unlink('./upload/foto/siswa/' . $this->input->post('remove_foto'));
            $data['foto'] = '';
        }

        if (!empty($_FILES['foto']['name'])) {
            $upload = $this->_do_upload();

            //delete file
            $siswa = $this->m_siswa->get_by_id($this->input->post('id'));
            if (file_exists('./upload/foto/siswa/' . $siswa->foto) && $siswa->foto)
                unlink('./upload/foto/siswa/' . $siswa->foto);

            $data['foto'] = $upload;
        }

        $this->m_siswa->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        //delete file
        $siswa = $this->m_siswa->get_by_id($id);
        if (file_exists('./upload/foto/siswa/' . $siswa->foto) && $siswa->foto)
            unlink('./upload/foto/siswa/' . $siswa->foto);

        $this->m_siswa->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = './upload/foto/siswa/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('foto')) //upload and validate
        {
            $data['inputerror'][] = 'foto';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
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

        $nis = $this->input->post('nis');
        $cek_nis = count($this->m_siswa->cek_siswa($nis));

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('nis') == '') {
            $data['inputerror'][] = 'nis';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($cek_nis == 1) {
            $data['inputerror'][] = 'nis';
            $data['error_string'][] = 'NIS sudah digunakan';
            $data['status'] = FALSE;
        }
        if ($this->input->post('jk') == '') {
            $data['inputerror'][] = 'jk';
            $data['error_string'][] = 'Jenis Kelamin harus dipilih';
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

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

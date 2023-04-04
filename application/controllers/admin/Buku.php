<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

class Buku extends CI_Controller
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
        $this->load->helper('url');
        $this->load->helper('form');
        $data['judul'] = 'Data E-Book';
        $data['header'] = 'admin/template/header';
        $data['sidebar'] = 'admin/template/sidebar';
        $data['isi'] = 'admin/isi/buku';
        $data['footer'] = 'admin/template/footer';
        $data['getkategori'] = $this->m_buku->ambil_kategori();

        $category = $this->m_buku->get_list_kategori();

        $opt = array('' => 'Semua Kategori');
        foreach ($category as $kategori) {
            $opt[$kategori] = $kategori;
        }

        $data['form_kategori'] = form_dropdown('', $opt, '', 'id="nama_kategori" class="custom-select custom-select-sm"');
        $this->load->view('admin/template/layout', $data);
    }

    public function ajax_list()
    {
        $this->load->helper('url');
        $list = $this->m_buku->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $nomor = 1;
        foreach ($list as $buku) {
            $no++;
            $row = array();
            $row[] = $no;
            if ($buku->foto)
                $row[] = '<a href="' . base_url('./upload/foto/buku/' . $buku->foto) . '" target="_blank"><img src="' . base_url('./upload/foto/buku/' . $buku->foto) . '" class="img-fluid" width="50"/></a>';
            else
                $row[] = '(No foto)';
            $row[] = $buku->judul;
            $row[] = $buku->pengarang;
            $row[] = $buku->penerbit;
            $row[] = $buku->isbn;
            $row[] = $buku->thn_buku;
            $row[] = $buku->nama_kategori;

            if ($buku->berkas_file)
                $row[] =  $buku->berkas_file;
            else
                $row[] = '(No Berkas)';

            $row[] = '<td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
            <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Edit" onclick="edit_buku(' . "'" . $buku->id . "'" . ')"><i class="fas fa-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Hapus" onclick="delete_buku(' . "'" . $buku->id . "'" . ')"><i class="fas fa-trash"></i></a>
            </div>
            </td>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_buku->count_all(),
            "recordsFiltered" => $this->m_buku->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->m_buku->get_by_id($id);
        echo json_encode($data);
    }
    public function ajax_detail($id)
    {
        $data = $this->m_buku->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = array(
            'id_kategori' => $this->input->post('id_kategori'),
            'judul' => htmlspecialchars($this->input->post('judul')),
            'penerbit' => htmlspecialchars($this->input->post('penerbit')),
            'pengarang' =>  htmlspecialchars($this->input->post('pengarang')),
            'isbn' =>  htmlspecialchars($this->input->post('isbn')),
            'thn_buku' => htmlspecialchars($this->input->post('thn_buku'))
        );

        if (!empty($_FILES['foto']['name'])) {
            $upload = $this->_do_upload();
            $data['foto'] = $upload;
        }

        if (!empty($_FILES['berkas_file']['name'])) {
            $upload = $this->_do_upload_file();
            $data['berkas_file'] = $upload;
        }


        $insert = $this->m_buku->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        if ($this->input->post('judul') == '') {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('penerbit') == '') {
            $data['inputerror'][] = 'penerbit';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('pengarang') == '') {
            $data['inputerror'][] = 'pengarang';
            $data['error_string'][] = 'Jenis Kelamin harus dipilih';
            $data['status'] = FALSE;
        }

        if ($this->input->post('isbn') == '') {
            $data['inputerror'][] = 'isbn';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('thn_buku') == '') {
            $data['inputerror'][] = 'thn_buku';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('id_kategori') == '') {
            $data['inputerror'][] = 'id_kategori';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }

        $data = array(
            'judul' => $this->input->post('judul'),
            'penerbit' => $this->input->post('penerbit'),
            'pengarang' => $this->input->post('pengarang'),
            'isbn' => $this->input->post('isbn'),
            'thn_buku' => $this->input->post('thn_buku'),
            'id_kategori' => $this->input->post('id_kategori')
        );

        if ($this->input->post('remove_foto')) // if remove photo checked
        {
            if (file_exists('./upload/foto/buku/' . $this->input->post('remove_foto')) && $this->input->post('remove_foto'))
                unlink('./upload/foto/buku/' . $this->input->post('remove_foto'));
            $data['foto'] = '';
        }

        if (!empty($_FILES['foto']['name'])) {
            $upload = $this->_do_upload();

            //delete file
            $buku = $this->m_buku->get_by_id($this->input->post('id'));
            if (file_exists('./upload/foto/buku' . $buku->foto) && $buku->foto)
                unlink('./upload/foto/buku/' . $buku->foto);

            $data['foto'] = $upload;
        }

        if ($this->input->post('remove_berkas')) // if remove photo checked
        {
            if (file_exists('./upload/buku/' . $this->input->post('remove_berkas')) && $this->input->post('remove_berkas'))
                unlink('./upload/buku/' . $this->input->post('remove_berkas'));
            $data['berkas_file'] = '';
        }

        if (!empty($_FILES['berkas_file']['name'])) {
            $upload = $this->_do_upload_file();

            //delete file
            $buku = $this->m_buku->get_by_id($this->input->post('id'));
            if (file_exists('./upload/buku/' . $buku->berkas_file) && $buku->berkas_file)
                unlink('./upload/buku/' . $buku->berkas_file);

            $data['berkas_file'] = $upload;
        }

        $this->m_buku->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        //delete file
        $buku = $this->m_buku->get_by_id($id);
        if (file_exists('./upload/foto/buku/' . $buku->foto) && $buku->foto)
            unlink('./upload/foto/buku/' . $buku->foto);

        if (file_exists('./upload/buku/' . $buku->berkas_file) && $buku->berkas_file)
            unlink('./upload/buku/' . $buku->berkas_file);

        $this->m_buku->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = './upload/foto/buku/';
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

    private function _do_upload_file()
    {
        $config['upload_path']          = './upload/buku/';
        $config['allowed_types']        = 'pdf|docx';
        $config['max_size']             = 3000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed//just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('berkas_file')) //upload and validate
        {
            $data['inputerror'][] = 'berkas_file';
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

        $isbn = $this->input->post('isbn');
        $cek_isbn = count($this->m_buku->cek_isbn($isbn));

        if ($this->input->post('judul') == '') {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('penerbit') == '') {
            $data['inputerror'][] = 'penerbit';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($cek_isbn == 1) {
            $data['inputerror'][] = 'isbn';
            $data['error_string'][] = 'ISBN sudah digunakan';
            $data['status'] = FALSE;
        }

        if ($this->input->post('pengarang') == '') {
            $data['inputerror'][] = 'pengarang';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('thn_buku') == '') {
            $data['inputerror'][] = 'thn_buku';
            $data['error_string'][] = 'Field tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if ($this->input->post('id_kategori') == '') {
            $data['inputerror'][] = 'id_kategori';
            $data['error_string'][] = 'kategori harus dipilih';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

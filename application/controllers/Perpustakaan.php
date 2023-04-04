<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perpustakaan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['judul'] = 'Perpustakaan';
		$this->load->view('perpustakaan', $data);
	}
	public function ebook()
	{
		$data['judul'] = 'Koleksi E-book';

		$data['getkategori'] = $this->m_buku->ambil_kategori();

		$category = $this->m_buku->get_list_kategori();

		$opt = array('' => 'Semua Kategori');
		foreach ($category as $kategori) {
			$opt[$kategori] = $kategori;
		}

		$data['form_kategori'] = form_dropdown('', $opt, '', 'id="nama_kategori" class="custom-select custom-select-sm"');
		$this->load->view('ebook', $data);
	}
	public function staf_perpustakaan()
	{
		$data['judul'] = 'Data Staf/Pegawai Perpustakaan';
		$data['staff'] = $this->m_pegawai->tampil_data();
		$this->load->view('staf_perpustakaan', $data);
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
			$row[] = $buku->judul;
			$row[] = $buku->pengarang;
			$row[] = $buku->nama_kategori;
			if ($buku->foto)
				$row[] = '<a href="' . base_url('./upload/foto/buku/' . $buku->foto) . '" target="_blank"><img src="' . base_url('./upload/foto/buku/' . $buku->foto) . '" class="img-fluid" width="35"/></a>';
			else
				$row[] = '(No foto)';



			//if ($buku->berkas_file)
			//	$row[] =  $buku->berkas_file;
			//else
			//	$row[] = '(No Berkas)';
			$row[] = '
            <a href="' . base_url('./upload/buku/' . $buku->berkas_file) . '" target="_blank" class="btn btn-info btn-sm" title="View"><i class="fas fa-book-open"></i> View</a>';
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
}

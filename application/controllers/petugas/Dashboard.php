<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$sesi_login = $this->session->userdata('loginMasuk');
		$level = $this->session->userdata('level_pengguna');
		if ($sesi_login == false || $level != 'Petugas') {
			redirect('login');
		}
	}

	public function index()
	{
		$data['judul'] = 'Dashboard';
		$data['header'] = 'petugas/template/header';
		$data['sidebar'] = 'petugas/template/sidebar';
		$data['isi'] = 'petugas/isi/dashboard';
		$data['footer'] = 'petugas/template/footer';
		$data['total_kategori'] = $this->model_kategori->total_rows();
		$data['total_pegawai'] = $this->m_pegawai->total_rows();
		$data['total_siswa'] = $this->m_siswa->total_rows();
		$data['total_buku'] = $this->m_buku->total_rows();
		$this->load->view('petugas/template/layout', $data);
	}
}

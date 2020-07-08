<?php

class Kategori extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		chek_role();
		$this->load->model('Model_kategori');
	}

	function index()
	{
		$data['record'] = $this->Model_kategori->tampilkan_data();
		$this->template->load('template/template', 'Kategori/lihat_data', $data);
		$this->load->view('template/datatables');

	}

	function post()
	{
		if (isset($_POST['submit'])) {
			//proses kategori
			$this->Model_kategori->post();
			redirect('kategori');
		} else {
			$this->template->load('template/template', 'kategori/form_input');
		}
	}
	function edit()
	{
		if (isset($_POST['submit'])) {
			//proses kategori
			$this->Model_kategori->edit();
			redirect('kategori');
		} else {
			$id = $this->uri->segment(3);
			$data['record'] = $this->Model_kategori->get_one($id)->row_array();
			$this->template->load('template/template','kategori/form_edit', $data);
		}
	}

	function hapus()
	{
		$td = $this->uri->segment(3);
		$this->Model_kategori->hapus($td);
		redirect('kategori');
	}
}

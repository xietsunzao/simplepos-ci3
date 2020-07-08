<?php
class Operator extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		chek_role();
		$this->load->model('Model_operator');
	}

	function index()
	{
		$data['record'] = $this->Model_operator->tampilkan_data()->result();
		$this->template->load('template/template', 'operator/lihat_data', $data);
		$this->load->view('template/datatables');
	}

	function post()
	{
		if (isset($_POST['submit'])) {
			//proses data
			$config['upload_path']          = './uploads/operator/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1024;
			$config['max_width']            = 6000;
			$config['max_height']           = 6000;
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				redirect($_SERVER['HTTP_REFERER']);
				return false;
			} else {
				$data = array('upload_data' => $this->upload->data());
				$nama 		= $this->input->post('operator', true);
				$username	= $this->input->post('username', true);
				$password	= $this->input->post('password', true);
				$akses 		= $this->input->post('akses', true);
				$foto = $this->upload->data('file_name');
				$data 		= array(
					'nama_operator' => $nama,
					'username' => $username,
					'password' => md5($password),
					'id_akses' => $akses,
					'foto' => $foto,

				);
				$this->db->insert('operator', $data);
				redirect('operator');
			}
		} else {
			$data['akses'] = $this->Model_operator->getAkses();
			$data['error'] = $this->upload->display_errors();
			$this->template->load('template/template', 'operator/form_input', $data);
		}
	}

	function edit()
	{
		if (isset($_POST['submit'])) {
			//proses operator
			$config['upload_path']          = './uploads/operator/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1024;
			$config['max_width']            = 6000;
			$config['max_height']           = 6000;
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				redirect($_SERVER['HTTP_REFERER']);
				return false;
			} else {
				$data = array('upload_data' => $this->upload->data());
				$nama 		= $this->input->post('operator', true);
				$username	= $this->input->post('username', true);
				$akses 		= $this->input->post('akses', true);
				$foto = $this->upload->data('file_name');
				$data = array(
					'nama_operator' => $nama,
					'username' => $username,
					'id_akses' => $akses,
					'foto' => $foto
				);
				$this->Model_operator->edit($data);
				redirect('operator');
			}
		} else {

			$id = $this->uri->segment(3);
			$data['record'] = $this->Model_operator->get_one($id)->row_array();
			$data['akses'] = $this->Model_operator->getAkses();
			$this->template->load('template/template', 'operator/form_edit', $data);
		}
	}

	function hapus()
	{
		$id = $this->uri->segment(3);
		$this->db->where('id_operator', $id);
		$this->db->delete('operator');
		redirect('operator');
	}
}

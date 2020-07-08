<?php
class Model_kategori extends CI_Model {

	function tampilkan_data() {

		return 
		$this->db->get('kategori')->result(); 
	}
		function post()
		{
			$data=array
			(
				'nama_kategori'=> $this->input->post('kategori')
			);
			$this->db->insert('kategori', $data);
		}

		function edit()
		{
			$data=array('nama_kategori'=> $this->input->post('kategori'));
			$this->db->where('id_kategori', $this->input->post('id'));
			$this->db->update('kategori',$data);
		}

		function get_one($id)
		{
			$param = array('id_kategori'=>$id);
			return $this->db->get_where('kategori',$param);
		}

		function hapus($id)
		{
			$this->db->where('id_kategori', $id);
			$this->db->delete('kategori');
		}

}
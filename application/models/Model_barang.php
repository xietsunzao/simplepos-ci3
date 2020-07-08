
<?php

class Model_barang extends CI_Model
{

	function tampil_data()
	{
		return
			$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left')
			->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
			->distinct()
			->get('barang');
	}

	function tampilkan_ukuran()
	{
		return  $this->db->get('ukuran');
	}

	function tampil_dropdown()
	{
		return
			$this->db->select('id_barang, nama_barang')
			->from('barang')
			->get();
	}

	function post($data)
	{
		$this->db->insert('barang', $data);
	}

	function get_one($id)
	{
		$param = array('id_barang' => $id);
		return $this->db->get_where('barang', $param);
	}

	function edit($data, $id)
	{
		$this->db->where('id_barang', $id);
		$this->db->update('barang', $data);
	}

	function hapus($id)
	{
		$this->db->where('id_barang', $id);
		$this->db->delete('barang');
	}

	function get_detail_modal($id)
	{
		return $this->db->where('id_barang', $id)
			->get('barang')
			->row();
	}
}

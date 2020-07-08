<?php


class Model_penjualan extends Ci_Model
{
	public $id = 'id_barang';


	function lihat_barang($id)
	{
		return $this->db->select('SUM(stok_barang) as jumlah')
			->join('barang', 'barang.id_barang = stok.id_barang')
			->where('stok.id_barang', $id)
			->get('stok');
	}

	function hasilcari($key)
	{
		return $this->db->or_like('nama_barang', $key)
			->get('barang')
			->result();
	}

	function stok_list()
	{
		return $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'left')
			->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
			->get('stok')->num_rows();
	}

	function halaman($number, $offset)
	{
		return $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'left')
			->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
			->get('stok', $number, $offset)->result();
	}

	function cart($id)
	{
		return $this->db->where('barang.id_barang', $id)
			->join('stok', 'stok.id_barang = barang.id_barang', 'left')
			->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
			->get('barang')
			->row();
	}

	function tambah_trf($payment)
	{
		$this->db->insert('detail_penjualan', $payment);
	}

	function get_byr($id)
	{
		return $this->db->where('id_byr', $id)->get('pembayaran')->row();
	}

	function get_nourut()
	{
		return $this->db->select('max(id) as nomor')
			->from('detail_penjualan')->get()->result();
	}

	function get_id($id)
	{
		return $this->db->select('id')->where('no_trf', $id)->get('detail_penjualan')->row_array();
	}

	function tambah_pjl($penjualan)
	{
		$this->db->insert_batch('penjualan', $penjualan);
	}

	function pengurangan_stok($pjl)
	{
		$this->db->update_batch('stok', $pjl, 'id_barang');
	}

	function cek_transaksi($id)
	{
		return $this->db->join('penjualan', 'penjualan.id_dtlpen = detail_penjualan.id', 'left')
			->join('barang', 'barang.id_barang = penjualan.id_barang', 'left')
			->join('pembayaran', 'pembayaran.id_byr = detail_penjualan.id_pembayaran', 'inner')
			->join('bank', 'bank.id = detail_penjualan.id_bank', 'left')
			->where('detail_penjualan.id', $id)->get('detail_penjualan')->result();
	}

	function get_detail_modal($id)
	{
		return $this->db->where('barang.id_barang', $id)
			->join('stok', 'stok.id_barang = barang.id_barang', 'left')
			->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
			->get('barang')
			->row();
	}

	function total_barang($id)
	{
		return $this->db->select('sum(stok_barang) as total')
			->where('id_barang', $id)
			->get('stok');
	}

	function filter_barang($kategori, $ukuran, $number, $offset)
	{
		if ($kategori != '' && $ukuran != '') {
			return $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'left')
				->where('barang.ukuran', $ukuran)
				->where('barang.id_kategori', $kategori)
				->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
				->get('stok')->result();
		} else if ($kategori != '' && $ukuran == '') {
			return $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'left')
				->where('barang.id_kategori', $kategori)
				->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
				->get('stok')->result();
		} else if ($kategori == '' & $ukuran != '') {
			return $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'left')
				->where('barang.ukuran', $ukuran)
				->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
				->get('stok')->result();
		} else {
			return $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'left')
				->join('ukuran', 'ukuran.id_ukuran = barang.ukuran', 'left')
				->get('stok', $number, $offset)->result();
		}
	}
}

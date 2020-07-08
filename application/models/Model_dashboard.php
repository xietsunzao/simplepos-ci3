<?php

class Model_dashboard extends CI_Model
{

    public function total($table)
    {
        $query = $this->db->get($table)->num_rows();
        return $query;
    }

    public function total_penjualan()
    {
        return $this->db->select('sum(jumlah_stok) as total')
            ->from('penjualan')->get()->row();
    }

    public function total_stok()
    {
        return $this->db->select('sum(stok_barang) as total')
            ->from('stok')->get()->row();
    }

    public function graph_stok()
    {
        return $this->db->select('barang.nama_barang,sum(stok_barang) as total,barang.foto')
            ->from('stok')->join('barang', 'barang.id_barang = stok.id_barang', 'left')
            ->group_by('stok.id_barang')
            ->get()
            ->result();
    }

    public function graph_kategori()
    {
        return $this->db->select('barang.nama_barang,sum(stok_barang) as total,kategori.nama_kategori')
            ->from('stok')->join('barang', 'barang.id_barang = stok.id_barang', 'left')
            ->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left')
            ->group_by('kategori.nama_kategori')
            ->get()
            ->result();
    }

    public function barang_laris()
    {
        return $this->db->select('barang.nama_barang,sum(jumlah_stok) as total,barang.foto,detail_penjualan.tgl_trf')
            ->from('penjualan')
            ->join('barang', 'barang.id_barang = penjualan.id_barang', 'left')
            ->join('detail_penjualan', 'detail_penjualan.id = penjualan.id_dtlpen', 'left')
            ->group_by('barang.nama_barang')
            ->order_by('total', 'ASC')
            ->where('month(detail_penjualan.tgl_trf) = month(CURRENT_date())')
            ->limit('5')
            ->get()->result();
    }
}

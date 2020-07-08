<?php

class Model_lapbulanan extends Ci_Model
{

    public function bulanan($thn)
    {
        return $this->db->select('tgl_trf,sum(grand_total) as gtotal')
            ->from('detail_penjualan')
            ->where('YEAR(tgl_trf)', $thn)
            ->group_by('MONTH(tgl_trf)')
            ->get()
            ->result();
    }

    public function income()
    {
        return $this->db->select('sum(grand_total) as gtotal')
            ->from('detail_penjualan')
            ->where('month(tgl_trf) = month(CURRENT_date())')
            ->get()
            ->row();
    }

    public function total_penjualan()
    {
        return $this->db->select('sum(jumlah_stok) as total')
            ->join('detail_penjualan', 'detail_penjualan.id = penjualan.id_dtlpen', 'left')
            ->where('month(detail_penjualan.tgl_trf) = month(CURRENT_date())')
            ->from('penjualan')->get()->row();
    }

    public function total_transaksi()
    {
        return $this->db->select('count(id) as total')
            ->where('month(tgl_trf) = month(CURRENT_date())')
            ->from('detail_penjualan')->get()->row();
    }

    public function total_barang()
    {
        return $this->db->select('sum(jumlah_stok) as total')
            ->from('penjualan')->get()->row();
    }
    public function barang_laris()
    {
        $query =  $this->db->select('barang.nama_barang,sum(jumlah_stok) as total,barang.foto,detail_penjualan.tgl_trf')
            ->from('penjualan')
            ->join('barang', 'barang.id_barang = penjualan.id_barang', 'left')
            ->join('detail_penjualan', 'detail_penjualan.id = penjualan.id_dtlpen', 'left')
            ->group_by('barang.nama_barang')
            ->order_by('total', 'ASC')
            ->where(    'month(detail_penjualan.tgl_trf) = month(CURRENT_date())')
            ->limit('1')
            ->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
}

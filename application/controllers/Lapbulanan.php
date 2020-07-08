<?php

class Lapbulanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        chek_session();
        $this->load->model('Model_lapbulanan');
    }

    function index()
    {
        $data['tahun'] = $this->uri->segment(3);
        $thn = $this->uri->segment(3);
        $data['bulanan'] = $this->Model_lapbulanan->bulanan($thn);
        $data['cards'] = $this->cards();
        $this->template->load('template/template', 'laporan/lap_bulanan', $data);
    }

    public function cards()
    {
        $data['laris'] = $this->Model_lapbulanan->barang_laris();
        if ($data['laris'] == FALSE) {
            $laris = 'kosong';
        } else {
            $laris = $data['laris']->nama_barang;
        }
        $card = [
            [
                'box'         => 'green',
                'total'     => 'Rp.' . number_format($this->Model_lapbulanan->income()->gtotal),
                'title'        => 'Pendapatan',
                'description'    => 'Total Pendapatan',
                'icon'        => 'money'
            ],
            [
                'box'         => 'blue',
                'total'     => $this->Model_lapbulanan->total_penjualan()->total,
                'title'        => 'Barang Terjual',
                'description'    => 'Total Barang Terjual',
                'icon'        => 'shopping-cart'
            ],
            [
                'box'         => 'yellow-active',
                'total'     =>  $this->Model_lapbulanan->total_transaksi()->total,
                'title'        => 'Total Penjualan',
                'description'    => 'Total Penjualan',
                'icon'        => 'shopping-basket'
            ],
            [
                'box'         => 'red',
                'total'     => $laris,
                'title'        => 'Barang Terlaris',
                'description'    => 'Barang Terlaris',
                'icon'        => 'cube'
            ],

        ];
        $info_card = json_decode(json_encode($card), FALSE);
        return $info_card;
    }
}

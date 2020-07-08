<?php
class Penjualan extends CI_Controller
{
    // halaman construct sebagai konstruktor method yang pertama kali akan dipanggil
    function __construct()
    {
        parent::__construct();
        chek_session();
        $this->load->model('Model_barang');
        $this->load->model('Model_kategori');
        $this->load->model('Model_stok');
        $this->load->model('Model_penjualan');
        $this->load->library('cart');
    }
    // halaman construct sebagai konstruktor method yang pertama kali akan dipanggil

    // sebagai index yang sudah di custom oleh Apllication/config/routes.php
    function store()
    {
        // kondisi jika menekan tombol filter
        if (isset($_POST['filter'])) {
            // $this->input->post untuk memproses data dari form $_POST
            $kategori = $this->input->post('kategori');
            $ukuran = $this->input->post('ukuran');
            // ---- $this->input->post untuk memproses data dari form $_POST
            $total = $this->Model_penjualan->stok_list();
            // load library pagination(halaman) beserta confignya
            $this->load->library('pagination');
            $config['base_url'] = base_url('penjualan/store/');  //halaman utama
            $config['total_rows'] = $total; //total baris berdasarkan dari databse
            $config['per_page']         = 0; // set 0 karena masuk kondisi ketika memilih filter "pilih semua"
            $config['first_link']       = 'First'; // config tombol halaman awal
            $config['last_link']        = 'Last'; // config tombol halaman akhir
            $config['next_link']        = 'Next'; // config tombol halaman selanjutnya
            $config['prev_link']        = 'Prev'; // config tombol halaman sebelumnya
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';
            $this->pagination->initialize($config); // setelah config , config tersebut akan di inialisasi, jika tidak config tersebut tidak akan berfungsi
            $from = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            //sebuah kumpulan variable yang di satukan menjadi array pada variable $data
            $data = array(
                'halaman'     => $this->pagination->create_links(),
                'result'    => $this->Model_penjualan->filter_barang($kategori, $ukuran, $config['per_page'], $from),
                'kategori' => $this->Model_kategori->tampilkan_data(),
                'ukuran' => $this->Model_barang->tampilkan_ukuran()->result(),
            );
            //-----sebuah kumpulan variable yang di satukan menjadi array pada variable $data
            $this->template->load('template/template', 'Penjualan/penjualan', $data);  //memanggil template dan view dari controller beserta variable $data
        } else {
            
            $total = $this->Model_penjualan->stok_list();
            $this->load->library('pagination');
            $config['base_url'] = base_url('penjualan/store/');
            $config['per_page']         = 8;
            $config['total_rows'] = $total;
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';
            $this->pagination->initialize($config);
            $from = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data = array(
                'halaman'     => $this->pagination->create_links(),
                'result'    => $this->Model_penjualan->Halaman($config['per_page'], $from),
                'kategori' => $this->Model_kategori->tampilkan_data(),
                'ukuran' => $this->Model_barang->tampilkan_ukuran()->result(),
            );
            $this->template->load('template/template', 'Penjualan/penjualan', $data);
        }
    }

    function tambah_barang($id, $qty)
    {
        $barang = $this->Model_penjualan->lihat_barang($this->input->post('idbarang'));
        if ($barang->row()->jumlah > 100) {
            $this->session->set_flashdata('message', 'Stok Barang melebihi kapasitas');
            redirect(base_url('index.php/penjualan'));
        } else {
            $result = $this->Model_penjualan->cart($id);
            $data = array(
                'id_barang'    => $result->id_barang,
                'stok_barang'      => $result->jumlah_stok,
                'id'        => $result->id_barang,
                'name'      => $result->nama_barang,
                'qty'       => $qty,
                'price'     => $result->harga,
                'size'      => $result->ukuran,
                'namesize' => $result->nama_ukuran,
            );
            $this->cart->insert($data);
            redirect(base_url('index.php/penjualan'));
        }
    }
    function caribarang()
    {
        $key = $this->input->get('q');
        $data = $this->Model_penjualan->hasilcari($key);
        foreach ($data as $result) {
            echo '<a href="' . base_url() . 'index.php/penjualan/tambah_barang/' . $result->id_barang . '/1">' . $result->nama_barang . '</a><br />';
        }
    }
    function ubah_qty()
    {
        $barang = $this->Model_penjualan->lihat_barang($this->input->post('idbarang'));
        $permintaan = intval($this->input->post('qty'));
        $jumlahstok = intval($barang->row()->jumlah);
        if ($permintaan >= $jumlahstok) {
            $this->session->set_flashdata('message', 'Jumlah permintaan melebihi stok barang');
            redirect(base_url('index.php/penjualan'));
        } else {
            $data = array(
                'rowid' => $this->input->post('rowid'),
                'qty'   => $this->input->post('qty')
            );
            $this->cart->update($data);
            redirect(base_url('index.php/penjualan'));
        }
    }
    function hapus_cart($row)
    {
        $data = array(
            'rowid' => $row,
            'qty'   => 0,
        );
        $this->cart->update($data);
        redirect(base_url('index.php/penjualan'));
    }
    function cancel()
    {
        $this->cart->destroy();
        redirect(base_url('index.php/penjualan'));
    }

    function formatNbr($nbr)
    {
        if ($nbr == 0 || $nbr == NULL)
            return "001";
        else if ($nbr < 10)
            return "00" . $nbr;
        elseif ($nbr >= 10 && $nbr < 100)
            return "0" . $nbr;
        else
            return strval($nbr);
    }

    function transaksi()
    {
        $no_trf = $this->Model_penjualan->get_byr($this->input->post('metode'));
        if ($no_trf->id_byr == 1) {
            $metode = strtoupper($no_trf->metode);
            $notrf = substr($metode, 0, 1);
        } else if ($no_trf->id_byr == 2) {
            $metode = strtoupper($no_trf->metode);
            $notrf = substr($metode, 0, 1);
        } else {
            $notrf = "0";
        }
        $kode = $this->Model_penjualan->get_nourut();
        $nourut = $this->formatNbr($kode[0]->nomor);
        $tgl = date('Ymd');
        $kodeurut = $notrf . $tgl . $nourut;
        $payment = array(
            'no_trf' => $kodeurut,
            'nama_pelanggan' => $this->input->post('pelanggan'),
            'totalpure' => $this->input->post('totalpure'),
            'grand_total ' => $this->input->post('grandtotal'),
            'diskon' => $this->input->post('diskon'),
            'bayar' => $this->input->post('bayar'),
            'kembalian' => $this->input->post('kembalian'),
            'catatan' => $this->input->post('note'),
            'tgl_trf' => date('Y-m-d'),
            'jam_trf' => date('H:i:s'),
            'id_pembayaran' => $this->input->post('metode'),
            'no_rek' => $this->input->post('norek'),
            'atas_nama' => $this->input->post('atas_nama'),
            'id_bank' => $this->input->post('payments'),
            'operator' => $this->session->userdata['username'],
        );
        $detail_penjualan =  $this->Model_penjualan->tambah_trf($payment);
        $id_dtlpenjualan = $this->Model_penjualan->get_id($kodeurut);

        $pjl = array();
        foreach ($this->cart->contents() as $q) {
            $pjl[] = array(
                'id_barang' => $q['id_barang'],
                'stok_barang' => intval($this->Model_penjualan->total_barang($q['id_barang'])->row()->total) - intval($q['qty']),
                'tanggal_stok' => date('Y-m-d'),
            );
        }

        foreach ($this->cart->contents() as $items) {
            $penjualan[] = array(
                'id_dtlpen'    => $id_dtlpenjualan['id'],
                'id_barang'     => $items['id_barang'],
                'jumlah_stok'     => $items['qty'],
                'harga_barang' => $items['price'],
                'sub_total' => $items['subtotal'],
            );
        }

        $png = $this->Model_penjualan->pengurangan_stok($pjl);
        $pjl = $this->Model_penjualan->tambah_pjl($penjualan);
        if (!$detail_penjualan && !$pjl && !$png) {
            $this->cart->destroy();
            $this->session->set_flashdata('message', 'Penjualan Sukses');
            redirect('penjualan/struk/' . $id_dtlpenjualan['id']);
        } else {
            $this->session->set_flashdata('message', 'Ooopss! Penjualan Gagal, Namun Stok Data Berubah!');
            redirect('penjualan');
        }
    }

    function struk($id)
    {
        $cek = $this->Model_penjualan->cek_transaksi($this->uri->segment(3));
        $data = array(
            'tanggal' => $cek[0]->tgl_trf,
            'jam' => $cek[0]->jam_trf,
            'nota' => $cek[0]->no_trf,
            'operator' => $cek[0]->operator,
            'pelanggan' => $cek[0]->nama_pelanggan,
            'total' => $cek[0]->totalpure,
            'diskon' => $cek[0]->diskon,
            'grand_total' => $cek[0]->grand_total,
            'result' => $cek,
            'metode' => $cek[0]->metode,
            'bayar' => $cek[0]->bayar,
            'kembalian' => $cek[0]->kembalian,
            'rekening' => $cek[0]->no_rek,
            'bank' => $cek[0]->nama_bank,
            'atasnama' => $cek[0]->atas_nama,
        );
        $this->template->load('template/template', 'penjualan/struk', $data);
    }

    function detail_modal($id)
    {
        $id = $this->input->get('id');
        $data['detail'] = $this->Model_penjualan->get_detail_modal($id);
        $this->load->view('penjualan/modal_detail', $data);
    }
}

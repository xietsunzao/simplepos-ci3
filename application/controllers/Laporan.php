<?php


class Laporan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        chek_role();
        $this->load->model('Model_laporan');
    }


    function index($start = null , $end = null)
    {
        if (isset($_POST['search'])) {
            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');
            $metode = $this->input->post('metode');
            $data['laporan'] = $this->Model_laporan->get_range($start,$end,$metode);
            $data['metode'] = $this->Model_laporan->get_metode();
            $this->template->load('template/template', 'laporan/lihat_data', $data);
            $this->load->view('template/datatables');
        } else {
            $data['laporan'] = $this->Model_laporan->get_data();
            $data['metode'] = $this->Model_laporan->get_metode();
            $this->template->load('template/template', 'laporan/lihat_data', $data);
            $this->load->view('template/datatables');
        }
    }

    function hapus($id)
    {
        $this->Model_laporan->hapus_trf($id);
        $this->Model_laporan->hapus_id($id);
    }
}

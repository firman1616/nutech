<?php
class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') == FALSE || $this->session->userdata('level') != 1) {

            redirect(base_url("login"));
        }
        $this->load->model('M_transaksi', 'transaksi');
    }

    public function index()
    {
        $data = [
            'name' => $this->session->userdata('nama'),
            'title' => 'Transaksi',
            'conten' => 'conten/transaksi',
            'kd_barang' => $this->m_data->get_data('tbl_barang'),
            'kd_trans' => $this->transaksi->kd_trans(),
            'list_trans' => $this->transaksi->list_trans(),
            'get_data' => $this->m_data->get_data('tbl_transaksi'),
            'footer_js' => [
                'assets/js/transaksi.js',
                'assets/js/alert_transaksi.js',
            ],
        ];
        $this->load->view('template/conten', $data);
    }

    public function cari()
    {
        $kode = $_GET['kode'];
        $cari = $this->transaksi->cari($kode)->row_array();
        echo json_encode($cari);
    }

    public function tambah_transaksi()
    {
        $table = 'tbl_transaksi';
        $data = [
            'kd_transaksi' => $this->input->post('kd_transaksi'),
            'kd_barang' => $this->input->post('kd_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'harga_satuan' => $this->input->post('harga_jual'),
            'qty_beli' => $this->input->post('qty'),
            'sub_total' => $this->input->post('sub_total')
        ];
        $this->m_data->simpan_data($table, $data);
        $this->session->set_flashdata('transaksi', 'Disimpan');
        redirect('Transaksi');
    }

    public function v_edit($id)
    {
        $data = [
            'name' => $this->session->userdata('nama'),
            'title' => 'Transaksi',
            'conten' => 'conten/edit_transaksi',
            'kd_barang' => $this->m_data->get_data('tbl_barang'),
            'kd_trans' => $this->transaksi->kd_trans(),
            // 'list_trans' => $this->transaksi->list_trans(),
            'get_data' => $this->m_data->get_data_by_id('tbl_transaksi', array('id_transaksi' => $id)),
            'footer_js' => [
                'assets/js/transaksi.js',
                'assets/js/alert_transaksi.js',
            ],
        ];
        $this->load->view('template/conten', $data);
    }

    public function update_trans($id)
    {
        $table = 'tbl_transaksi';
        $data = [
            // 'kd_transaksi' => $this->input->post('kd_transaksi'),
            'kd_barang' => $this->input->post('kd_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'harga_satuan' => $this->input->post('harga_jual'),
            'qty_beli' => $this->input->post('qty'),
            'sub_total' => $this->input->post('sub_total')
        ];
        $where = ['id_transaksi' => $id];
        $this->m_data->update_data($table, $data, $where);
        $this->session->set_flashdata('transaksi', 'Diupdate');
        redirect('Transaksi');
    }

    public function hapus_transaksi($id)
    {
        $table = 'tbl_transaksi';
        $where = ['id_transaksi' => $id];
        $this->m_data->hapus_data($table, $where);
        $this->session->set_flashdata('transaksi', 'Dihapus');
        redirect('Transaksi');
    }
}

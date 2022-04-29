<?php
class Master extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') == FALSE || $this->session->userdata('level') != 1) {

            redirect(base_url("login"));
        }
        $this->load->model('M_master', 'master');
    }

    public function index()
    {
        $data = [
            'title' => 'Master Barang',
            'name' => $this->session->userdata('nama'),
            'conten' => 'conten/master_barang',
            'kd_barang' => $this->master->CreateCode(),
            'list_barang' => $this->master->list_barang(),
            'footer_js' => [
                'assets/js/master.js',
                'assets/js/alert_master.js',
            ],

        ];
        $this->load->view('template/conten', $data);
    }

    function upload($name, $directory)
    {
        $gbr_name = '';
        $config['upload_path'] = './assets/' . $directory; //path folder
        $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '100'; //maksimum besar file 100kb
        $config['max_width']  = '5000'; //lebar maksimum 5000 px
        $config['max_height']  = '5000'; //tinggi maksimu 5000 px
        $config['file_name'] = 'BR_' . date('dmYHis'); //nama yang terupload nantinya

        $this->upload->initialize($config);
        if ($this->upload->do_upload($name)) {
            $fileData = $this->upload->data();
            $gbr_name = $fileData['file_name'];
        }
        return $gbr_name;
    }

    public function tambah_data()
    {

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'is_unique[tbl_barang.nama_barang]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $gambar = $this->upload('filefoto', 'img');
            $table = 'tbl_barang';
            $data = [
                'kd_barang' => $this->input->post('kd_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'harga_beli' => $this->input->post('harga_beli'),
                'harga_jual' => $this->input->post('harga_jual'),
                'stock' => $this->input->post('stock'),
                'foto' => $gambar,
            ];
            $this->m_data->simpan_data($table, $data);
            $this->session->set_flashdata('master', 'Disimpan');
            redirect('Master');
        }
    }

    public function update_barang($id)
    {
        $gambar = $this->m_data->get_data_by_id('tbl_barang', array('id_barang' => $id));
        foreach ($gambar->result() as $row) {
            $foto = $row->foto; //untuk mengambil gambar pada colom gambar di database berdasarkan ID
        }

        // $table = 'tbl_barang';
        if ($_FILES["filefoto"]['error']) {
            $data = [
                // 'kd_barang' => $this->input->post('kd_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'harga_beli' => $this->input->post('harga_beli'),
                'harga_jual' => $this->input->post('harga_jual'),
                'stock' => $this->input->post('stock'),
                'foto' => $foto,
            ];
            $this->M_data->update_data('tbl_barang', $data, array('id_barang' => $id));
            $this->session->set_flashdata('master', 'Diubah');
            redirect('Master');
        } else {
            unlink('./assets/img/' . $foto);
            $gambar = $this->upload('filefoto', 'img');
            $data = [
                // 'kd_barang' => $this->input->post('kd_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'harga_beli' => $this->input->post('harga_beli'),
                'harga_jual' => $this->input->post('harga_jual'),
                'stock' => $this->input->post('stock'),
                'foto' => $gambar,
            ];
            $this->M_data->update_data('tbl_barang', $data, array('id_barang' => $id));
            $this->session->set_flashdata('master', 'Diubah');
            redirect('Master');
        }
    }

    public function nonaktif_data($id)
    {
        // $image = $this->M_data->get_data_by_id('tbl_barang', array('id_barang' => $id));
        // $path = './assets/img/';
        // foreach ($image->result() as $row) {
        //     unlink($path . $row->foto);
        // }
        // $table = 'tbl_barang';
        // $where = array('id_barang' => $id);
        // $this->M_data->hapus_data($table, $where);
        // $this->session->set_flashdata('item', 'Deleted');
        // redirect('Master');
        $table = 'tbl_barang';
        $data = [
            'flag' => 1,
        ];
        $where = ['id_barang' => $id];
        $this->m_data->update_data($table, $data, $where);
        $this->session->set_flashdata('master', 'Dinonaktifkan');
        redirect('Master');
    }
}

<?php
class M_transaksi extends CI_Model
{
    function cari($id)
    {
        return $this->db->query("SELECT * FROM `tbl_barang` WHERE id_barang = '$id'");
    }

    public function kd_trans()
    {
        $this->db->select('RIGHT(tbl_transaksi.id_transaksi,5) as kode_transaksi', FALSE);
        $this->db->order_by('id_transaksi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_transaksi');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_transaksi) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodetampil = "TR" . $batas;
        return $kodetampil;
    }

    public function list_trans()
    {
        return $this->db->query("SELECT
        a.id_transaksi,
        a.kd_transaksi,
        a.nama_barang,
        a.harga_satuan,
        a.qty_beli,
        a.sub_total,
        b.kd_barang,	
        b.foto 
    FROM
        `tbl_transaksi` as a
        JOIN tbl_barang as b on a.kd_barang = b.id_barang");
    }
}

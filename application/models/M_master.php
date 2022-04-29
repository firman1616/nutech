<?php
class M_master extends CI_Model
{
    public function CreateCode()
    {
        $this->db->select('RIGHT(tbl_barang.id_barang,5) as kode_barang', FALSE);
        $this->db->order_by('id_barang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_barang');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_barang) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodetampil = "BR" . $batas;
        return $kodetampil;
    }

    public function list_barang()
    {
        return $this->db->query("SELECT * FROM tbl_barang WHERE flag = 0");
    }
}

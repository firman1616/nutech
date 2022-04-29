<?php
foreach ($get_data->result() as $row) {
    $a = $row->kd_barang;
    $b = $row->nama_barang;
    $c = $row->harga_satuan;
    $d = $row->qty_beli;
    $e = $row->sub_total;
    $f = $row->id_transaksi;
}
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Transaksi</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Transaksi</h6>
        </div>
        <div class="card-body">
            <form action="<?= site_url('Transaksi/update_trans/' . $f) ?>" method="post">
                <input type="text" id="kd_transaksi" name="kd_transaksi" class="form-control" value="<?= $kd_trans ?>" hidden>
                <div class="row">
                    <div class="form-group col-md-4 col-xs-4 col-lg-4">
                        <label for="exampleFormControlInput1">Kode Barang</label>
                        <select name="kd_barang" id="kd_barang" class="form-control" onchange="return autofill();">
                            <option value="" disabled selected>Pilih Kode Barang</option>
                            <?php foreach ($kd_barang->result() as $row) { ?>
                                <option value="<?= $row->id_barang ?>" <?php if ($a == $row->id_barang) {
                                                                            echo "SELECTED";
                                                                        } ?>><?= $row->kd_barang ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-xs-4 col-lg-4">
                        <label for="exampleFormControlInput1">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control" readonly value="<?= $b ?>">
                    </div>
                    <div class="form-group col-md-4 col-xs-4 col-lg-4">
                        <label for="exampleFormControlInput1">Harga Barang</label>
                        <input type="number" id="harga_jual" name="harga_jual" class="form-control" readonly onkeyup="sum();" value="<?= $c ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-6 col-lg-6">
                        <label for="exampleFormControlInput1">Qty Beli <small>(tersedia : <b id="qty-tersedia">-</b>)</small></label>
                        <input type="number" id="qty" name="qty" class="form-control" onkeyup="sum();" value="<?= $d; ?>">
                    </div>
                    <div class="form-group col-md-6 col-xs-6 col-lg-6">
                        <label for="exampleFormControlInput1">Sub Total</label>
                        <input type="number" id="sub_total" name="sub_total" class="form-control" readonly value="<?= $e ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> | Update Transaksi</button>
            </form>
        </div>
    </div>
</div>
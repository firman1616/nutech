<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Transaksi</h1>

    <div class="flash-transaksi" data-flashdata="<?= $this->session->flashdata('transaksi') ?>"></div>


    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus"></i> | Tambah Data Transaksi</button>
    <br><br>
    <div class="card shadow mb-4 collapse" id="collapseExample">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Transaksi</h6>
        </div>
        <div class="card-body">
            <form action="<?= site_url('Transaksi/tambah_transaksi') ?>" method="post">
                <input type="text" id="kd_transaksi" name="kd_transaksi" class="form-control" value="<?= $kd_trans ?>" hidden>
                <div class="row">
                    <div class="form-group col-md-4 col-xs-4 col-lg-4">
                        <label for="exampleFormControlInput1">Kode Barang</label>
                        <select name="kd_barang" id="kd_barang" class="form-control" onchange="return autofill();">
                            <option value="" disabled selected>Pilih Kode Barang</option>
                            <?php foreach ($kd_barang->result() as $row) { ?>
                                <option value="<?= $row->id_barang ?>"><?= $row->kd_barang ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-xs-4 col-lg-4">
                        <label for="exampleFormControlInput1">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-4 col-xs-4 col-lg-4">
                        <label for="exampleFormControlInput1">Harga Barang</label>
                        <input type="number" id="harga_jual" name="harga_jual" class="form-control" readonly onkeyup="sum();">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-6 col-lg-6">
                        <label for="exampleFormControlInput1">Qty Beli <small>(tersedia : <b id="qty-tersedia">-</b>)</small></label>
                        <input type="number" id="qty" name="qty" class="form-control" onkeyup="sum();">
                    </div>
                    <div class="form-group col-md-6 col-xs-6 col-lg-6">
                        <label for="exampleFormControlInput1">Sub Total</label>
                        <input type="number" id="sub_total" name="sub_total" class="form-control" readonly>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> | Simpan Transaksi</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Barang</th>
                            <th>QTY</th>
                            <th>Sub Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $x = 1;
                        $no = 1;
                        foreach ($list_trans->result() as $row) { ?>
                            <tr>
                                <td><?= $x++; ?></td>
                                <td><?= $row->kd_transaksi ?></td>
                                <td><?= $row->nama_barang ?></td>
                                <td><?= $row->qty_beli ?></td>
                                <td><?= number_format($row->sub_total, 2) ?></td>
                                <td>
                                    <a href="<?= site_url('Transaksi/v_edit/' . $row->id_transaksi) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="<?= site_url('Transaksi/hapus_transaksi/' . $row->id_transaksi) ?>" class="hapus-transaksi btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
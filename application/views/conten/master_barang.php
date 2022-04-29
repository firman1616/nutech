<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Master Barang</h1>

    <div class="flash-master" data-flashdata="<?= $this->session->flashdata('master') ?>"></div>


    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>
        | Tambah Data
    </button>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Master Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $x = 1;
                        $no = 1;
                        foreach ($list_barang->result() as $row) { ?>
                            <tr>
                                <td><?= $x++; ?></td>
                                <td><?= $row->kd_barang  ?></td>
                                <td><?= $row->nama_barang ?></td>
                                <td><?= 'Harga Beli Rp.' . number_format($row->harga_beli, 2) . '<br> Harga Jual Rp.' . number_format($row->harga_jual, 2) ?></td>
                                <td><?= number_format($row->stock) ?></td>
                                <td><img src="<?= base_url('./assets/img/' . $row->foto) ?>" alt="<?= $row->foto ?>" style="width: 150px;"></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?= $no++; ?>"><i class="fa fa-edit"></i></button>
                                    <a href="<?= site_url('Master/nonaktif_data/' . $row->id_barang) ?>" class="btn btn-danger hapus-master"><i class="fa fa-power-off"></i></a>
                                </td>
                            </tr>
                        <?php  }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= site_url('Master/tambah_data') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control" id="kd_barang" name="kd_barang" value="<?= $kd_barang; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 col-xl-4 col-lg-4">
                            <label>Harga Beli</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                        </div>
                        <div class="form-group col-md-4 col-xl-4 col-lg-4">
                            <label>Harga Jual</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual">
                        </div>
                        <div class="form-group col-md-4 col-xl-4 col-lg-4">
                            <label>Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Foto Barang</label>
                        <input type="file" class="form-control" id="filefoto" name="filefoto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<?php
$y = 1;
foreach ($list_barang->result() as $row) {
    $a = $row->kd_barang;
    $b = $row->nama_barang;
    $c = $row->harga_beli;
    $d = $row->harga_jual;
    $e = $row->stock;
    $f = $row->foto;
    $g = $row->id_barang;
?>
    <div class="modal fade" id="modalEdit<?= $y++; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= site_url('Master/update_barang/' . $g) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Barang</label>
                            <input type="text" class="form-control" id="kd_barang" name="kd_barang" value="<?= $a; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $b ?>">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-xl-4 col-lg-4">
                                <label>Harga Beli</label>
                                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?= $c ?>">
                            </div>
                            <div class="form-group col-md-4 col-xl-4 col-lg-4">
                                <label>Harga Jual</label>
                                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?= $d ?>">
                            </div>
                            <div class="form-group col-md-4 col-xl-4 col-lg-4">
                                <label>Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="<?= $e ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foto Barang</label>
                            <input type="file" class="form-control" id="filefoto" name="filefoto">
                            <br>
                            <img src="<?= base_url('./assets/img/' . $f) ?>" alt="" style="width: 150px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $no++;
} ?>
<!-- End Edit Modal -->
<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Table Peminjaman</h4>
                        <button class="btn btn-primary mb-2" data-toggle="tooltip" data-placement="bottom"
                            title="Add a new rent" onclick="window.location.href='/home/tambahpeminjaman'">Add
                            Peminjaman</button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>Nama Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $no = 1;
                                foreach ($vstaf as $k) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $no++ ?>
                                        </td>


                                        <td>
                                            <?php echo $k->nama ?>
                                        </td>
                                        <td>
                                            <?php echo $k->nama_b ?>
                                        </td>
                                        <td>
                                            <?php echo $k->tgl_pinjam ?>
                                        </td>
                                        <td>
                                            <?php echo $k->tgl_kembali ?>
                                        </td>
                                        <td>
                                            <?php echo $k->jumlah ?>
                                        </td>
                                        <td>
                                            <?php echo $k->status ?>
                                        </td>
                                        <style>
                                            .button-container {
                                                display: flex;
                                                gap: 10px;
                                                /* Sesuaikan nilai gap sesuai kebutuhan Anda */
                                            }
                                        </style>

                                        <td>
                                            <div class="button-container">
                                                <form method="post"
                                                    action="<?= base_url('/home/aksipinjam/' . $k->id_peminjaman) ?>">
                                                    <button class="btn btn-dark" type="submit"
                                                        <?= ($k->status === 'Dikembalikan') ? 'disabled' : '' ?>>
                                                        Update Status
                                                    </button>
                                                </form>

                                                <a class="btn btn-danger"
                                                    href="<?php echo base_url('/home/deletepeminjaman/' . $k->id_peminjaman) ?>">
                                                    Delete
                                                </a>
                                            </div>
                                        </td>
                                        <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    <!--**********************************-->
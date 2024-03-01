<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Table Kategori</h4>
                        <button class="btn btn-primary mb-2" data-toggle="tooltip" data-placement="bottom"
                            title="Add a new category" onclick="window.location.href='/home/tambahkategori'">Add
                            Kategori</button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
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
                                            <?php echo $k->nama_k ?>
                                        </td>
                                        <td>

                                            <a class="btn btn-warning"
                                                href="<?php echo base_url('/home/editkategori/' . $k->id_kategori) ?>">
                                                Edit
                                            </a>
                                            <a class="btn btn-danger"
                                                href="<?php echo base_url('/home/deletekategori/' . $k->id_kategori) ?>">
                                                Delete
                                            </a>
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
<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Table Buku</h4>
                        <button class="btn btn-primary mb-2" data-toggle="tooltip" data-placement="bottom"
                            title="Add a new book" onclick="window.location.href='/home/tambahbuku'">Add Buku</button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Cover</th>
                                        <th>Nama Buku</th>
                                        <th>Penulis</th>
                                       
                                        <th>Stok</th>
                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                <?php 
                                $no=1;
                                foreach ($a as $b) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td>
                                            <img src="<?=base_url('images/'.$b->cover)?>" height="100px">
                                        </td>
                                        <td><?php echo $b->nama_b?> </td>
                                        <td><?php echo $b->penulis?> </td>
                                      
                                       
                                     
                                        <td><?php echo $b->stok?> </td>
                                       
                                        <td>
                                        
                                        <a href="<?= base_url('/home/detail_buku/' . (int)$b->id_book) ?>">
   <button class="btn btn-warning">Detail Buku</button>
</a>

                                            <a href="<?=base_url('/home/editbuku/'.$b->id_book)?>"><button class="btn btn-primary">Edit</button></a>
                                            <a href="<?=base_url('/home/delete/'.$b->id_book)?>"><button class="btn btn-danger">Delete</button></a>
                                        </td>

                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    <!--**********************************-->
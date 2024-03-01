<div class="content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="<?= base_url('/home/aksi_editkategori') ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $a->id_kategori ?>">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Kategori <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" placeholder="Kategori" name="nama_k"
                                            value="<?php echo $a->nama_k ?>" </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
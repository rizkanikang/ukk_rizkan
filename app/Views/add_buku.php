<div class="content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Tambah Buku</h4>
                        <a href="<?= site_url('/home/buku') ?>" class="btn btn-light-secondary me-1 mb-1">Back</a>
                    </div>
                    <div class="card-body">
                        <form class="form form-validation" novalidate action="<?= base_url('/home/aksi_tambahbuku') ?>"
                            method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-cover">Cover</label>
                                <div class="col-lg-6">
                                    <div class="position-relative">
                                        <input type="file" class="form-control" placeholder="Cover" name="cover"
                                            id="cover" onchange="previewImage()" required>
                                        <img id="preview" src="" alt="" style="max-width: 100px; margin-top: 10px;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-nama-b">Nama Buku <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Nama Buku"
                                                name="nama_b" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-nama-b">Penulis <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Nama Penulis"
                                                name="penulis" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-nama-b">Penerbit <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Nama Penerbit"
                                                name="penerbit" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-nama-b">Tahun <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Tahun" name="tahun"
                                                required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-nama-b">Sinopsis <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Sinopsis"
                                                name="sinopsis" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-nama-b">Stok <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Stok" name="stok"
                                                required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-nama-b">Link Drive <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Link Drive" name="link"
                                                required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-kategori">Kategori <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" name="kategori" required>
                                                    <option value="">-PILIH-</option>
                                                    <?php
                                                    foreach ($a as $b) {
                                                        ?>
                                                        <option value="<?= $b->id_kategori ?>">
                                                            <?php echo $b->nama_k ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </fieldset>
                                            <div class="form-control-icon">
                                                <i class="bi bi-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add other form fields here -->
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

<script>
    function previewImage() {
        var preview = document.querySelector('#preview');
        var file = document.querySelector('#cover').files[0];
        var reader = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
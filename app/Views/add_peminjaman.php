<div class="content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="<?= base_url('Home/aksi_addpeminjaman') ?>" method="post">
                                <div class="col-md-4">
                                    <div class="col-md-4">
                                        <label for="book">Nama Peminjam</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <fieldset class="form-group">
                                                    <select class="btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown" name="user">
                                                        <option value="" disabled selected>Pilih Peminjam</option>
                                                        <?php
                                                        foreach ($a as $b) {
                                                            ?>
                                                            <option value="<?= $b->id_user ?>">
                                                                <?php echo $b->nama ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="book">Nama Buku</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <fieldset class="form-group">
                                                    <select class="btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown" name="book" id="bookSelect">
                                                        <option value="" disabled selected>Pilih Buku</option>
                                                        <?php foreach ($c as $b): ?>
                                                            <option value="<?= $b->id_book ?>" data-stok="<?= $b->stok ?>">
                                                                <?php echo $b->nama_b ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </fieldset>
                                                <p id="stokInfo" class="text-muted">Stok: -</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Tanggal Kembali</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="date" class="form-control" placeholder="Tanggal Kembali"
                                                    name="tgl_kembali" id="first-name-icon" required>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-clock"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Jumlah</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Jumlah"
                                                    name="jumlah" id="first-name-icon" required>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-123"></i>
                                                </div>
                                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Tanggapi perubahan pada dropdown
            $('#bookSelect').change(function () {
                // Ambil nilai stok dari atribut data-stok
                var selectedStok = $('option:selected', this).data('stok');

                // Tampilkan nilai stok di bawah dropdown
                $('#stokInfo').text('Stok: ' + selectedStok);
            });
        });
    </script>
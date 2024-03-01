<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Data Table</h4>
                        <button class="btn btn-primary mb-2" data-toggle="tooltip" data-placement="bottom"
                            title="Add a new user" onclick="window.location.href='/home/adduser'">Add User</button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $no = 1;
                                foreach ($vuser as $k) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $no++ ?>
                                        </td>
                                        <td>
                                            <?php echo $k->username ?>
                                        </td>
                                        <td>
                                            <?php echo $k->password ?>
                                        </td>
                                        <td>
                                            <?php echo $k->email ?>
                                        </td>
                                        <td>
                                            <?php echo $k->nama_level ?>
                                        </td>
                                        <td>
                                            <?php echo $k->created_at ?>
                                        </td>
                                        <td>
                                            <?php echo $k->update_at ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" onclick="confirmReset(<?= $k->id_user ?>)"
                                                data-toggle="tooltip" data-placement="bottom"
                                                title="Reset user password">Reset</button>
                                        </td>
                                    </tr>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmReset(userId) {
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to reset this user\'s password?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user clicks "Yes"
                    window.location.href = `/home/reset/${userId}`;
                }
            });
        }
    </script>
</div>
<?= $this->extend('admin/layout'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Data User</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Tanggal Lahir</th>
                            <th>Nomor telepon</th>
                            <th>Path Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        <?php
                        foreach ($users as $data) {
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['firstName']; ?></td>
                                <td><?php echo $data['lastName']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['password']; ?></td>
                                <td><?php echo $data['tanggalLahir']; ?></td>
                                <td><?php echo $data['nomorTelepon']; ?></td>
                                <td><img src="<?= base_url($data['pathFoto']); ?>" alt="<?= $data['pathFoto']; ?>" style="height: 150px; width: 150px; object-fit:cover"></td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-danger" style="text-decoration:none; color:white;" href="<?= base_url('Admin/deleteUser/' . $data['email']); ?>"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>
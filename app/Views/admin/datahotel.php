<?= $this->extend('admin/layout'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Data Hotel</h3>
        </div>
        <div class="card-body">
            <a class="btn-solid-lg page-scroll" style="float:right; margin-bottom:1rem" href="<?= base_url('Admin/toNewHotel'); ?>">NEW HOTEL</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Hotel</th>
                            <th>Fasilitas</th>
                            <th>Jumlah Kamar</th>
                            <th>Rating</th>
                            <th>Harga</th>
                            <th>Lokasi</th>
                            <th>Path Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        <?php
                        foreach ($hotels as $data) {
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['namaHotel']; ?></td>
                                <td><?php echo $data['fasilitas']; ?></td>
                                <td><?php echo $data['jumlahKamar']; ?></td>
                                <td><?php echo $data['rating']; ?></td>
                                <td><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo $data['lokasi']; ?></td>
                                <td><img src="<?= base_url($data['pathFoto']); ?>" alt="<?= $data['pathFoto']; ?>" style="height: 150px; width: 150px; object-fit:cover"></td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-primary" style="text-decoration:none; color:white;" href="<?= base_url('Admin/toEditHotel/' . $data['idHotel']); ?>"><i class="fas fa-edit"></i></a>
                                        <a type="button" class="btn btn-danger" style="text-decoration:none; color:white;" href="<?= base_url('Admin/deleteHotel/' . $data['idHotel']); ?>"><i class="fas fa-trash-alt"></i></a>
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
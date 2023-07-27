<?= $this->extend('admin/layout'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Data Booking</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No </th>
                            <th>ID Booking</th>
                            <th>Email User</th>
                            <th>ID Hotel</th>
                            <th>Nama Panjang Tamu</th>
                            <th>No Telp Tamu</th>
                            <th>Email Tamu</th>
                            <th>Jumlah Kamar</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Harga</th>
                            <th>Jam Booking</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        <?php
                        foreach ($bookings as $data) {
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['idBooking']; ?></td>
                                <td><?php echo $data['emailUser']; ?></td>
                                <td><?php echo $data['idHotel']; ?></td>
                                <td><?php echo $data['namaPanjangTamu']; ?></td>
                                <td><?php echo $data['nomorTeleponTamu']; ?></td>
                                <td><?php echo $data['emailTamu']; ?></td>
                                <td><?php echo $data['jumlahKamar']; ?></td>
                                <td><?php echo $data['checkin']; ?></td>
                                <td><?php echo $data['checkout']; ?></td>
                                <td><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo $data['jamBooking']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-primary" style="text-decoration:none; color:white;" href="<?= base_url('Admin/toEditBooking/' . $data['idBooking']); ?>"><i class="fas fa-edit"></i></a>
                                        <a type="button" class="btn btn-danger" style="text-decoration:none; color:white;" href="<?= base_url('Admin/deleteBooking/' . $data['idBooking']); ?>"><i class="fas fa-trash-alt"></i></a>
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
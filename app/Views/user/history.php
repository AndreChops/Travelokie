<?= $this->extend('user/layout'); ?>

<?= $this->section('content'); ?>

<!--History-->
<div id="history" class="filter">
    <div class="container">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h1 class="mb-2 text-primary">Booking History</h1><br>
        </div>
        <?php foreach ($bookings as $row) { ?>
            <div class="modal-box" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['namaHotel']; ?></h5>
                        <h5 class="modal-title" id="exampleModalLabel" style="float:right;">#<?= strtoupper(substr($row['idBooking'], 0, 7)); ?></h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2" style="padding-left:0">
                                <img src="<?= base_url($row['pathFotoHotel']); ?>" style="float:left; height:165px; width:165px; margin-right:30px;"></img>
                            </div>
                            <p>Guest: <?= $row['namaPanjangTamu']; ?></p>
                            <p>Phone Number: <?= $row['nomorTeleponTamu']; ?></p>
                            <p>Check In: <?= $row['checkin']; ?></p>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2" style="float: right">
                            <a href="<?= base_url('Home/showInvoice/' . $row['idBooking']); ?>" class="btn-solid-reg" style="float: right">DETAILS</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        <?php } ?>
    </div>
</div>
<!-- end of history -->

<?= $this->endSection(); ?>
<?= $this->extend('user/layout'); ?>

<?= $this->section('content'); ?>
<!-- Invoice -->
<div id="invoice" class="filter">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h1 class="mb-2 text-primary">Invoice</h1>
                <hr>
                <img class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" src="<?= base_url($hotel['pathFoto']); ?>" alt="<?= url_title($hotel['namaHotel'], '-', true); ?>.jpeg" style="float:right; height:290px; object-fit:cover; padding-bottom: 2rem">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                    <h5 class="text-primary">Booking Code:</h5>
                    <h3>#<?= strtoupper(substr($booking['idBooking'], 0, 7)); ?></h3>
                    <br>
                    <h5 class="text-primary"><?= $hotel['namaHotel']; ?></h5>
                    <h6 class="pt-1">Guest: <?= $booking['namaPanjangTamu']; ?></h6>
                    <h6 class="pt-1">Phone Number: <?= $booking['nomorTeleponTamu']; ?></h6>
                    <h6 class="pt-1">Email: <?= $booking['emailTamu']; ?></h6>
                    <h6 class="pt-1">Rooms: <?= $booking['jumlahKamar']; ?></h6>
                    <h6 class="pt-1">Check In: <?= $booking['checkin']; ?></h6>
                    <h6 class="pt-1">Check Out: <?= $booking['checkout']; ?></h6>
                    <h6 class="pt-1">Price: Rp. <?= number_format($booking['harga'], 0, ',', '.'); ?></h6>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 style="padding-top: 14px">Booked at <?= $booking['jamBooking']; ?></h6>
                        </div>
                        <div><a href="<?= base_url('Home/toBookingHistory'); ?>" class="btn-solid-lg page-scroll">BACK</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
<!-- end of invoice -->
<?= $this->endSection(); ?>
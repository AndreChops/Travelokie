<?= $this->extend('user/layout'); ?>

<?php $validation = \Config\Services::validation(); ?>

<?= $this->section('content'); ?>
<!-- Booking Form -->
<div id="booking" class="filter">
    <div class="container">
        <div class="row gutters">
            <div class="card-body">
                <?= form_open('Home/bookHotel', ['idHotel'], ['idHotel' => $idHotel]); ?>
                <div class="row gutters" onmouseover="limitCheckoutAndCalcPrice()">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h1 class="text-primary">Booking Form</h1>
                    </div>
                    <img class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12" src="<?= base_url($pathFoto); ?>" alt="<?= url_title($namaHotel, '-', true); ?>.jpeg" style="height:290px; object-fit:cover; padding-top: 1rem; padding-bottom: 2rem">
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
                        <h3 class="mt-3 mb-2"><?= $namaHotel; ?></h3>
                        <h5 class="mb-2">
                            <?php for ($i = 0; $i < $rating; $i++) { ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                        </h5>
                        <p style="text-align: justify"><?= $lokasi; ?></p>
                        <p style="text-align: justify"><?= $deskripsi; ?></p>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h3>Guest's Data</h3>
                        <hr>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <h5 for="namaPanjangTamu">Full Name</h5>
                            <input type="text" class="form-control <?= ($validation->hasError('namaPanjangTamu')) ? 'is-invalid' : ''; ?>" id="namaPanjangTamu" name="namaPanjangTamu" placeholder="Enter guest's full name" value="<?= old('namaPanjangTamu'); ?>" style="block-size: 50px;">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('namaPanjangTamu'); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <h5 for="nomorTeleponTamu">Phone Number</h5>
                            <input type="number" class="form-control <?= ($validation->hasError('nomorTeleponTamu')) ? 'is-invalid' : ''; ?>" id="nomorTeleponTamu" name="nomorTeleponTamu" placeholder="Enter guest's phone number" value="<?= old('nomorTeleponTamu'); ?>" style="block-size: 50px;">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('nomorTeleponTamu'); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <h5 for="emailTamu">Email</h5>
                            <input type="text" class="form-control <?= ($validation->hasError('emailTamu')) ? 'is-invalid' : ''; ?>" id="emailTamu" name="emailTamu" placeholder="Enter guest's email address" value="<?= old('emailTamu'); ?>" style="block-size: 50px;">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('emailTamu'); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <h5 for="jumlahKamar">Rooms (max. <?= $jumlahKamar; ?>)</h5>
                            <input type="number" class="form-control <?= ($validation->hasError('jumlahKamar')) ? 'is-invalid' : ''; ?>" id="jumlahKamar" min="1" max="<?= $jumlahKamar; ?>" name="jumlahKamar" placeholder="Enter number of rooms" value="<?= (old('jumlahKamar') ? old('jumlahKamar') : 1); ?>" onchange="calcPrice()" style="block-size: 50px;">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('jumlahKamar'); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <h5 for="checkin">Check In Date</h5>
                            <input type="date" class="form-control <?= ($validation->hasError('checkin')) ? 'is-invalid' : ''; ?>" id="checkin" name="checkin" min="<?= date('Y-m-d'); ?>" value="<?= old('checkin'); ?>" onchange="limitCheckoutAndCalcPrice()" style="block-size: 50px;">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('checkin'); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <h5 for="checkout">Check Out Date</h5>
                            <input type="date" class="form-control <?= ($validation->hasError('checkout')) ? 'is-invalid' : ''; ?>" id="checkout" name="checkout" min="<?= date('Y-m-d'); ?>" value="<?= old('checkout'); ?>" onchange="limitCheckoutAndCalcPrice()" style="block-size: 50px;">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('checkout'); ?></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <h3 class="text-primary">Price: Rp. <span id="total">0</span></h3>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-right">
                        <a href="<?= base_url(); ?>" class="btn-outline-reg page-scroll">CANCEL</a>
                        <button type="submit" name="submit" class="btn-solid-reg page-scroll">BOOK</button>
                    </div>
                    <input type="hidden" id="harga" value="<?= $harga; ?>">
                    <input type="hidden" id="hargaTotal" name="hargaTotal" value="0">
                </div>
                <?= form_close(); ?>
                <script>
                    function limitCheckoutAndCalcPrice() {
                        var checkin = document.querySelector('#checkin').value;
                        var checkout = document.querySelector('#checkout').value;
                        if (checkin >= checkout) {
                            document.getElementById("checkout").min = checkin;
                            document.getElementById("checkout").value = checkin;
                        }
                        calcPrice();
                    }

                    function calcPrice() {
                        var oneDay = 24 * 60 * 60 * 1000;
                        var price = document.querySelector('#harga').value;
                        var rooms = document.querySelector('#jumlahKamar').value;
                        var checkin = document.querySelector('#checkin').value;
                        var checkout = document.querySelector('#checkout').value;
                        checkin = checkin.replace(/\//g, ",");
                        checkout = checkout.replace(/\//g, ",");

                        checkin = new Date(checkin);
                        checkout = new Date(checkout);
                        var dayDiff = Math.round(Math.abs(((checkin.getTime() - checkout.getTime())) / (oneDay))) + 1;

                        var total = price * rooms * dayDiff;
                        if (isNaN(total)) total = 0;
                        total = total.toLocaleString().replaceAll(",", ".");
                        document.getElementById("total").innerHTML = total;
                        total = total.replaceAll(".", "");
                        document.getElementById("hargaTotal").value = total;
                    }
                </script>
            </div>
        </div>
    </div>
</div>
<!-- end of booking form -->
<?= $this->endSection(); ?>
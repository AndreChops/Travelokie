<?= $this->extend('admin/layout'); ?>

<?php $validation = \Config\Services::validation(); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Edit Hotel</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?= form_open_multipart(base_url('Admin/editBooking'), ['idBooking', 'emailUser', 'idHotel', 'namaHotel', 'jamBooking'], ['idBooking' => $idBooking, 'emailUser' => $emailUser, 'idHotel' => $idHotel, 'namaHotel' => $namaHotel, 'jamBooking' => $jamBooking]); ?>
                <div class="modal-body" onmouseover="limitCheckoutAndCalcPrice()">
                    <div class="container">
                        <!-- end of modal message -->
                        <div class="form-group">
                            <h5 for="idBooking">ID Booking</h5>
                            <input type="text" disabled id="idBooking" name="idBooking" class="form-control" value="<?= $idBooking; ?>">
                        </div>
                        <div class="form-group">
                            <h5 for="emailUser">Email User</h5>
                            <input type="text" disabled id="emailUser" name="emailUser" class="form-control" value="<?= $emailUser; ?>">
                        </div>
                        <div class="form-group">
                            <h5 for="idHotel">ID Hotel</h5>
                            <input type="text" disabled id="idHotel" name="idHotel" class="form-control" value="<?= $idHotel; ?>">
                        </div>
                        <div class="form-group">
                            <h5 for="namaHotel">Nama Hotel</h5>
                            <input type="text" disabled id="namaHotel" name="namaHotel" class="form-control" value="<?= $namaHotel; ?>">
                        </div>
                        <div class="form-group">
                            <h5 for="namaPanjangTamu">Nama Panjang Tamu</h5>
                            <input type="text" id="namaPanjangTamu" name="namaPanjangTamu" class="form-control <?= ($validation->hasError('namaPanjangTamu')) ? 'is-invalid' : ''; ?>" value="<?= (old('namaPanjangTamu')) ? old('namaPanjangTamu') : $namaPanjangTamu; ?>" placeholder="<?= $namaPanjangTamu; ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('namaPanjangTamu'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="nomorTeleponTamu">Nomor Telepon Tamu</h5>
                            <input type="number" id="nomorTeleponTamu" name="nomorTeleponTamu" class="form-control <?= ($validation->hasError('nomorTeleponTamu')) ? 'is-invalid' : ''; ?>" value="<?= (old('nomorTeleponTamu')) ? old('nomorTeleponTamu') : $nomorTeleponTamu; ?>" placeholder="<?= $nomorTeleponTamu; ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('nomorTeleponTamu'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="emailTamu">Email Tamu</h5>
                            <input type="text" id="emailTamu" name="emailTamu" class="form-control <?= ($validation->hasError('emailTamu')) ? 'is-invalid' : ''; ?>" value="<?= (old('emailTamu')) ? old('emailTamu') : $emailTamu; ?>" placeholder="<?= $emailTamu; ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('emailTamu'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="jumlahKamar">Jumlah Kamar</h5>
                            <input type="number" id="jumlahKamar" name="jumlahKamar" class="form-control <?= ($validation->hasError('jumlahKamar')) ? 'is-invalid' : ''; ?>" value="<?= (old('jumlahKamar')) ? old('jumlahKamar') : $jumlahKamar; ?>" placeholder="<?= $jumlahKamar; ?>" onchange="calcPrice()">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('jumlahKamar'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="checkin">Check In</h5>
                            <input type="date" id="checkin" name="checkin" class="form-control <?= ($validation->hasError('checkin')) ? 'is-invalid' : ''; ?>" min="<?= date('Y-m-d'); ?>" value="<?= (old('checkin')) ? old('checkin') : $checkin; ?>" placeholder="<?= $checkin; ?>" onchange="limitCheckoutAndCalcPrice()">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('checkin'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="checkout">Check Out</h5>
                            <input type="date" id="checkout" name="checkout" class="form-control <?= ($validation->hasError('checkout')) ? 'is-invalid' : ''; ?>" min="<?= date('Y-m-d'); ?>" value="<?= (old('checkout')) ? old('checkout') : $checkout; ?>" placeholder="<?= $checkout; ?>" onchange="limitCheckoutAndCalcPrice()">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('checkout'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="jamBooking">Jam Booking</h5>
                            <input type="text" disabled id="jamBooking" name="jamBooking" class="form-control" value="<?= $jamBooking; ?>">
                        </div>
                        <input type="hidden" id="harga" value="<?= $harga; ?>">
                        <input type="hidden" id="hargaTotal" name="hargaTotal" value="0">
                        <div class="form-group">
                            <h3 class="text-primary">Price: Rp. <span id="total">0</span></h3>
                        </div>
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
                <div class="modal-footer">
                    <button type="submit" class="btn-solid-lg page-scroll" name="submit" style="padding: 18px 28px; margin-right: 18px">EDIT HOTEL</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>
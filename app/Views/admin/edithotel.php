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
                <?= form_open_multipart(base_url('Admin/editHotel'), ['idHotel'], ['idHotel' => $idHotel]); ?>
                <div class="modal-body">
                    <div class="container">
                        <!-- end of modal message -->
                        <div class="form-group">
                            <h5 for="idHotel">ID Hotel</h5>
                            <input type="text" disabled id="idHotel" name="idHotel" class="form-control" value="<?= $idHotel; ?>">
                        </div>
                        <div class="form-group">
                            <h5 for="namaHotel">Nama Hotel</h5>
                            <input type="text" id="namaHotel" name="namaHotel" class="form-control <?= ($validation->hasError('namaHotel')) ? 'is-invalid' : ''; ?>" value="<?= (old('namaHotel')) ? old('namaHotel') : $namaHotel; ?>" placeholder="<?= $namaHotel; ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('namaHotel'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="deskripsi">Deskripsi</h5>
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" value="<?= (old('deskripsi')) ? old('deskripsi') : $deskripsi; ?>" placeholder="<?= $deskripsi; ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('deskripsi'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="fasilitas">Fasilitas</h5>
                            <input type="text" id="fasilitas" name="fasilitas" class="form-control <?= ($validation->hasError('fasilitas')) ? 'is-invalid' : ''; ?>" value="<?= (old('fasilitas')) ? old('fasilitas') : $fasilitas; ?>" placeholder="<?= $fasilitas; ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('fasilitas'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="jumlahKamar">Jumlah Kamar</h5>
                            <input type="number" id="jumlahKamar" name="jumlahKamar" class="form-control <?= ($validation->hasError('jumlahKamar')) ? 'is-invalid' : ''; ?>" value="<?= (old('jumlahKamar')) ? old('jumlahKamar') : $jumlahKamar; ?>" placeholder="<?= $jumlahKamar; ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('jumlahKamar'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="rating">Rating</h5>
                            <input type="number" id="rating" name="rating" class="form-control <?= ($validation->hasError('rating')) ? 'is-invalid' : ''; ?>" value="<?= (old('rating')) ? old('rating') : $rating; ?>" placeholder="<?= $rating; ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('rating'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="harga">Harga</h5>
                            <input type="number" id="harga" name="harga" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" value="<?= (old('harga')) ? old('harga') : $harga; ?>" placeholder="<?= $harga; ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('harga'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="lokasi">Lokasi</h5>
                            <input type="text" id="lokasi" name="lokasi" class="form-control <?= ($validation->hasError('lokasi')) ? 'is-invalid' : ''; ?>" value="<?= (old('lokasi')) ? old('lokasi') : $lokasi; ?>" placeholder="<?= $lokasi; ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('lokasi'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="foto">Path Foto</h5>
                            <input type="file" id="foto" name="foto" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" value="<?= old('foto'); ?>">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('foto'); ?></p>
                        </div>
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
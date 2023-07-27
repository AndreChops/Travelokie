<?= $this->extend('user/layout'); ?>

<?php $validation = \Config\Services::validation(); ?>

<?= $this->section('content'); ?>

<!-- Edit Profile -->
<div id="editprofile" class="filter">
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="<?= base_url($pathFoto); ?>" alt="Profile Picture">
                                </div>
                                <h5 class="user-name"><?= $firstName . ' ' . $lastName; ?></h5>
                                <h6 class="user-email"><?= $email; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <?= form_open_multipart('Home/editProfile', ['email'], ['email' => $email]); ?>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h1 class="mb-2 text-primary">Edit Profile</h1>
                                <hr>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <h3 for="firstName">First Name</h3>
                                    <input type="text" class="form-control <?= ($validation->hasError('firstName')) ? 'is-invalid' : ''; ?>" id="firstName" name="firstName" placeholder="<?= $firstName; ?>" value="<?= old('firstName') ? old('firstName') : $firstName; ?>" style="block-size: 50px;" />
                                    <p class="pt-1" style="color: #DC3545"><?= $validation->getError('firstName'); ?></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <h3 for="lastName">Last Name</h3>
                                    <input type="text" class="form-control <?= ($validation->hasError('lastName')) ? 'is-invalid' : ''; ?>" id="lastName" name="lastName" placeholder="<?= $lastName; ?>" value="<?= old('lastName') ? old('lastName') : $lastName; ?>" style="block-size: 50px;" />
                                    <p class="pt-1" style="color: #DC3545"><?= $validation->getError('lastName'); ?></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group"><br>
                                    <h3 for="email">Email</h3>
                                    <input type="email" disabled class="form-control" id="email" name="email" value="<?= $email ?>" style="block-size: 50px;" />
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group"><br>
                                    <h3 for="nomorTelepon">Phone Number</h3>
                                    <input type="number" class="form-control <?= ($validation->hasError('nomorTelepon')) ? 'is-invalid' : ''; ?>" id="nomorTelepon" name="nomorTelepon" placeholder="<?= $nomorTelepon; ?>" value="<?= old('nomorTelepon') ? old('nomorTelepon') : $nomorTelepon; ?>" style="block-size: 50px;" />
                                    <p class="pt-1" style="color: #DC3545"><?= $validation->getError('nomorTelepon'); ?></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group"><br>
                                    <h3 for="password">Password</h3>
                                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Enter password" value="<?= old('password'); ?>" style="block-size: 50px;" />
                                    <p class="pt-1" style="color: #DC3545"><?= $validation->getError('password'); ?></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group"><br>
                                    <h3 for="confirmPassword">Confirm Password</h3>
                                    <input type="password" class="form-control <?= ($validation->hasError('confirmPassword')) ? 'is-invalid' : ''; ?>" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" value="<?= old('confirmPassword'); ?>" style="block-size: 50px;" />
                                    <p class="pt-1" style="color: #DC3545"><?= $validation->getError('confirmPassword'); ?></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group"><br>
                                    <h3 for="tanggalLahir">Birth Date</h3>
                                    <input type="date" class="form-control <?= ($validation->hasError('tanggalLahir')) ? 'is-invalid' : ''; ?>" id="tanggalLahir" name="tanggalLahir" value="<?= old('tanggalLahir') ? old('tanggalLahir') : $tanggalLahir; ?>" style="block-size: 50px;" />
                                    <p class="pt-1" style="color: #DC3545"><?= $validation->getError('tanggalLahir'); ?></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group"><br>
                                    <h3 for="foto">Profile Picture</h3>
                                    <input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewPhoto()" style=" block-size: 50px;" />
                                    <p class="pt-1" style="color: #DC3545"><?= $validation->getError('foto'); ?></p>
                                    <img src="<?= base_url($pathFoto); ?>" alt="Image preview" id="preview-foto" style="max-width: 250px; max-height: 250px; text-align: center;">
                                </div>
                                <div class="text-right">
                                    <a href="<?= base_url(); ?>" class="btn-outline-reg page-scroll">CANCEL</a>
                                    <button type="submit" name="submit" class="btn-solid-reg page-scroll">EDIT</button>
                                </div>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of edit profile -->

<?= $this->endSection(); ?>
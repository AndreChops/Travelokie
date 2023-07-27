<?php $validation = \Config\Services::validation(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Title -->
    <title>Travelokie</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=latin-ext">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600&display=swap&subset=latin-ext">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/fontawesome-all.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/swiper.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/magnific-popup.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/styles.css'); ?>">

    <!-- Favicon  -->
    <link rel="icon" href="<?= base_url('assets/images/favicon.png'); ?>">
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark navbar-custom top-nav-collapse col-12" style="position: fixed; z-index:3">
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Aria</a> -->

        <!-- Image Logo -->
        <a class="navbar-brand logo-image" href="index.html"><img src="<?= base_url('assets/images/logo.png'); ?>" alt="Travelokie" style="block-size: auto"></a>

        <!-- Mobile Menu Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="<?= base_url(); ?>">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="<?= base_url('#hotels'); ?>">HOTELS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="<?= base_url('#about'); ?>">ABOUT US</a>
                </li>

                <li class="nav-item">
                <li class="nav-item"><a href="" class="nav-link page-scroll" data-toggle="modal" data-target="#loginModal">SIGN IN</a></li>
                </li>
            </ul>
        </div>
    </nav> <!-- end of navbar -->
    <!-- end of navbar -->

    <!-- If session is not setted or invalid credentials entered, show modal -->
    <?php if (session()->getFlashdata('showModal')) : ?>
        <script>
            showModal = true;
        </script>
    <?php endif ?>

    <!-- Login modal box -->
    <div class="modal fade" id="loginModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <?= form_open(base_url('Home/login'), ['sess_captcha'], ['sess_captcha' => session()->get('captcha')]); ?>
                <div class="modal-header">
                    <h5 class="mb-2 text-primary" style="padding-left: 15px; padding-top:10px;">Sign In</h5>
                    <button type="button" class="close" style="padding: 24px 30px" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <!-- Modal message -->
                        <?php if (session()->getFlashdata('modalMessage')) : ?>
                            <div class="form-group">
                                <div class="alert alert-success" role="alert">
                                    <span><?= session()->getFlashdata('modalMessage'); ?></span>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- end of modal message -->
                        <div class="form-group">
                            <h5 for="email">Email</h5>
                            <input type="text" id="email" name="email" class="form-control <?= ($validation->hasError('email')) ? 'has-error' : ''; ?>" value="<?= old('email'); ?>" placeholder="Enter username/email">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('email'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="password">Password</h5>
                            <input type="password" id="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'has-error' : ''; ?>" value="<?= old('password'); ?>" placeholder="Enter password">
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('password'); ?></p>
                        </div>
                        <div class="form-group">
                            <h5 for="captcha">Captcha</h5>
                            <div class="container row">
                                <input type="text" id="captcha" name="captcha" class="form-control col-5 <?= ($validation->hasError('captcha')) ? 'has-error' : ''; ?>" pattern=".{6}" placeholder="Enter Captcha">
                                <div class="col-7 row" style="margin-left:auto">
                                    <img src="" alt="<?= session()->get('captcha'); ?>" class="captcha-image col-10" style="height:38px; width:200px">
                                    <a href="?refresh" class="refreshCaptcha" style="border:0.5px solid #ced4da; border-radius:5px; height:90%; width:15%; padding:6px 9px 10px 9px; cursor:pointer">
                                        <img src="<?= base_url('assets/images/refresh.png'); ?>" style="height:12px; width:12px">
                                    </a>
                                </div>
                            </div>
                            <p class="pt-1" style="color: #DC3545"><?= $validation->getError('captcha'); ?></p>
                        </div>
                        <script>
                            var refreshCaptcha = document.querySelector(".refreshCaptcha");
                            refreshCaptcha.onclick = function() {
                                <?php
                                $new = null;
                                if (isset($_GET['refresh'])) {
                                    $controller->captcha();
                                    $new = session()->get('captcha');
                                    session()->setFlashdata('showModal', true);
                                }
                                ?>
                                var captcha = document.querySelector(".captcha-image");
                            }
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="mr-auto pt-3" style="padding-left: 15px">Don't have an account? <a href="<?= base_url('Home/toRegister'); ?>" class="green redirect-text">Register here.</a></p>
                    <button type="submit" class="btn-solid-reg page-scroll" name="submit" style="padding: 18px 28px; margin-right: 18px">SIGN IN</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
    <!-- end of login modal box -->

    <!--Register-->
    <div id="register" class="filter">
        <div class="container">
            <div class="row gutters">
                <div class="card-body">
                    <?= form_open_multipart('Home/register'); ?>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h1 class="mb-2 text-primary">Registration Form</h1>
                            <hr>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <h3 for="firstName">First Name</h3>
                                <input type="text" class="form-control <?= ($validation->hasError('firstName')) ? 'is-invalid' : ''; ?>" id="firstName" name="firstName" placeholder="Enter first name" value="<?= old('firstName'); ?>" style="block-size: 50px;">
                                <p class="pt-1" style="color: #DC3545"><?= $validation->getError('firstName'); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <h3 for="lastName">Last Name</h3>
                                <input type="text" class="form-control <?= ($validation->hasError('lastName')) ? 'is-invalid' : ''; ?>" id="lastName" name="lastName" placeholder="Enter last name" value="<?= old('lastName'); ?>" style="block-size: 50px;">
                                <p class="pt-1" style="color: #DC3545"><?= $validation->getError('lastName'); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><br>
                                <h3 for="email">Email</h3>
                                <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Enter email address" value="<?= old('email'); ?>" style="block-size: 50px;">
                                <p class="pt-1" style="color: #DC3545"><?= $validation->getError('email'); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><br>
                                <h3 for="nomorTelepon">Phone Number</h3>
                                <input type="number" class="form-control <?= ($validation->hasError('nomorTelepon')) ? 'is-invalid' : ''; ?>" id="nomorTelepon" name="nomorTelepon" placeholder="Enter phone number" value="<?= old('nomorTelepon'); ?>" style="block-size: 50px;">
                                <p class="pt-1" style="color: #DC3545"><?= $validation->getError('nomorTelepon'); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><br>
                                <h3 for="password">Password</h3>
                                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Enter password" value="<?= old('password'); ?>" style="block-size: 50px;">
                                <p class="pt-1" style="color: #DC3545"><?= $validation->getError('password'); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><br>
                                <h3 for="confirmPassword">Confirm Password</h3>
                                <input type="password" class="form-control <?= ($validation->hasError('confirmPassword')) ? 'is-invalid' : ''; ?>" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" value="<?= old('confirmPassword'); ?>" style="block-size: 50px;">
                                <p class="pt-1" style="color: #DC3545"><?= $validation->getError('confirmPassword'); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><br>
                                <h3 for="tanggalLahir">Birth Date</h3>
                                <input type="date" class="form-control <?= ($validation->hasError('tanggalLahir')) ? 'is-invalid' : ''; ?>" id="tanggalLahir" name="tanggalLahir" max="<?= date('Y-m-d'); ?>" value="<?= old('tanggalLahir'); ?>" style="block-size: 50px;">
                                <p class="pt-1" style="color: #DC3545"><?= $validation->getError('tanggalLahir'); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><br>
                                <h3 for="foto">Profile Picture</h3>
                                <input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewPhoto()" style="block-size: 50px;">
                                <p class="pt-1" style="color: #DC3545"><?= $validation->getError('foto'); ?></p>
                                <img src="<?= base_url('assets/images/user/default.png'); ?>" alt="Image preview" id="preview-foto" style="max-width: 250px; max-height: 250px; text-align: center;">
                            </div>
                            <div class="text-right">
                                <a href="<?= base_url(); ?>" class="btn-outline-reg page-scroll">CANCEL</a>
                                <button type="submit" name="submit" class="btn-solid-reg page-scroll">REGISTER</button>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end of register -->

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-container about">
                        <h4>Few Words About Travelokie</h4>
                        <p class="white">We're passionate about delivering the best hotel services for our customers.</p>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-md-2">
                    <div class="text-container">
                        <h4>Links</h4>
                        <ul class="list-unstyled li-space-lg white">
                            <li>
                                <a class="white" href="#your-link">startupguide.com</a>
                            </li>
                            <li>
                                <a class="white" href="terms-conditions.html">Terms & Conditions</a>
                            </li>
                            <li>
                                <a class="white" href="privacy-policy.html">Privacy Policy</a>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-md-2">
                    <div class="text-container">
                        <h4>Tools</h4>
                        <ul class="list-unstyled li-space-lg">
                            <li>
                                <a class="white" href="#your-link">businessgrowth.com</a>
                            </li>
                            <li>
                                <a class="white" href="#your-link">influencers.com</a>
                            </li>
                            <li class="media">
                                <a class="white" href="#your-link">optimizer.net</a>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-md-2">
                    <div class="text-container">
                        <h4>Partners</h4>
                        <ul class="list-unstyled li-space-lg">
                            <li>
                                <a class="white" href="#your-link">unicorns.com</a>
                            </li>
                            <li>
                                <a class="white" href="#your-link">staffmanager.com</a>
                            </li>
                            <li>
                                <a class="white" href="#your-link">association.gov</a>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Template by Inovatik</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->

    <!-- Scripts -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.min.js'); ?>"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script type="text/javascript" src="<?= base_url('assets/js/popper.min.js'); ?>"></script> <!-- Popper tooltip library for Bootstrap -->
    <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script> <!-- Bootstrap framework -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.easing.min.js'); ?>"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script type="text/javascript" src="<?= base_url('assets/js/swiper.min.js'); ?>"></script> <!-- Swiper for image and text sliders -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery.magnific-popup.js'); ?>"></script> <!-- Magnific Popup for lightboxes -->
    <script type="text/javascript" src="<?= base_url('assets/js/morphext.min.js'); ?>"></script> <!-- Morphtext rotating text in the header -->
    <script type="text/javascript" src="<?= base_url('assets/js/isotope.pkgd.min.js'); ?>"></script> <!-- Isotope for filter -->
    <script type="text/javascript" src="<?= base_url('assets/js/validator.min.js'); ?>"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script type="text/javascript" src="<?= base_url('assets/js/scripts.js'); ?>"></script> <!-- Custom scripts -->
    <script type="text/javascript" src="<?= base_url('assets/js/other.js'); ?>"></script> <!-- Custom scripts -->
</body>

</html>
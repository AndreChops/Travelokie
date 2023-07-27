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
    <nav class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top">
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Aria</a> -->

        <!-- Image Logo -->
        <a class="navbar-brand logo-image" href="<?= base_url(); ?>"><img src="<?= base_url('assets/images/logo.png'); ?>" alt="Travelokie" style="block-size: auto"></a>

        <!-- Mobile Menu Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#header">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#hotels">HOTELS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#about">ABOUT US</a>
                </li>

                <?php if (session()->get('log_sess')) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle page-scroll" href="#" id="navbarDrpdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?= strtoupper(session()->get('firstName') . ' ' . session()->get('lastName')); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="left: auto; right: 0">
                            <a class="dropdown-item" href="<?= base_url('Home/toEditProfile'); ?>"><span class="item-text">EDIT PROFILE</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="<?= base_url('Home/toBookingHistory'); ?>"><span class="item-text">BOOKING HISTORY</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="<?= base_url('Home/logout'); ?>"><span class="item-text">SIGN OUT</span></a>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="nav-item"><a href="#" class="nav-link page-scroll" data-toggle="modal" data-target="#loginModal">SIGN IN</a></li>
                <?php endif; ?>
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

    <!-- Header -->
    <header id="header" class="header">
        <!-- Message -->
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="container" style="z-index: 2; padding-top: 7rem">
                <div class="alert alert-success" role="alert">
                    <span><?= session()->getFlashdata('message'); ?></span>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            </div>
        <?php endif; ?>
        <!-- end of message -->
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-container">
                            <h1>Travelokie</h1>
                            <p class="p-heading p-large">A Website for fast and easy hotel booking</p>
                            <a class="btn-solid-lg page-scroll" href="#hotels">BOOK NOW</a>
                        </div>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    <!-- end of header -->

    <!-- Hotels -->
    <div id="hotels" class="filter">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Our Listed Hotels</h2>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- Filter -->
                    <div class="button-group filters-button-group d-flex justify-content-center">
                        <a class="button is-checked" data-filter="*"><span>SHOW ALL</span></a>

                        <!-- Location Dropdown -->
                        <div>
                            <a class="button dropdown-toggle page-scroll" href="#" id="locationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">LOCATION</a>
                            <div class="dropdown-menu" style="background: rgba(0, 0, 0, 0.5); padding:8px 10px 0 4px; text-align: center" aria-labelledby="locationDropdown">
                                <a class="dropdown-item button" data-filter=".bandung"><span>BANDUNG</span></a>
                                <div class="dropdown-items-divide-hr"></div>
                                <a class="dropdown-item button" data-filter=".jakarta"><span>JAKARTA</span></a>
                                <div class="dropdown-items-divide-hr"></div>
                                <a class="dropdown-item button" data-filter=".palembang"><span>PALEMBANG</span></a>
                            </div>
                        </div> <!-- end of location dropdown -->

                        <!-- Price Dropdown -->
                        <div>
                            <a class="button dropdown-toggle page-scroll" href="#" id="priceDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PRICE</a>
                            <div class="dropdown-menu" style="background: rgba(0, 0, 0, 0.5); padding:8px 10px 0 4px; text-align: center" aria-labelledby="priceDropdown">
                                <a class="dropdown-item button" data-filter=".price1"><span>
                                        < Rp. 250.000 </span> </a>
                                <div class="dropdown-items-divide-hr"></div>
                                <a class="dropdown-item button" data-filter=".price2"><span>
                                        Rp. 250.000 - 500.000</span></a>
                                <div class="dropdown-items-divide-hr"></div>
                                <a class="dropdown-item button" data-filter=".price3"><span>
                                        Rp. 500.000 - 750.000</span></a>
                                <div class="dropdown-items-divide-hr"></div>
                                <a class="dropdown-item button" data-filter=".price4"><span>
                                        Rp. 750.000 - 1.000.000</span></a>
                                <div class="dropdown-items-divide-hr"></div>
                                <a class="dropdown-item button" data-filter=".price5"><span>
                                        > Rp. 1.000.000</span></a>
                            </div>
                        </div> <!-- end of price dropdown -->

                        <!-- Rating Dropdown -->
                        <div>
                            <a class="button dropdown-toggle page-scroll" href="#" id="ratingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RATING</a>
                            <div class="dropdown-menu" style="background: rgba(0, 0, 0, 0.5); padding:8px 10px 0 4px; text-align: center" aria-labelledby="ratingDropdown">
                                <a class="dropdown-item button" data-filter=".1star">
                                    <span class="fa fa-star"></span>
                                </a>
                                <div class="dropdown-items-divide-hr"></div>
                                <a class="dropdown-item button" data-filter=".2star">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </a>
                                <div class="dropdown-items-divide-hr"></div>
                                <a class="dropdown-item button" data-filter=".3star">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </a>
                                <div class="dropdown-items-divide-hr"></div>
                                <a class="dropdown-item button" data-filter=".4star">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </a>
                                <div class="dropdown-items-divide-hr"></div>
                                <a class="dropdown-item button" data-filter=".5star">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </a>
                            </div>
                        </div> <!-- end of rating dropdown -->
                    </div> <!-- end of button group -->
                    <!-- end of filter -->

                    <div class="grid">
                        <?php foreach ($hotels as $row) {
                            $slug = url_title($row['namaHotel'], '-', true);
                            $lokasi = (strtolower(str_contains($row['lokasi'], 'bandung'))) ? 'bandung' : ((strtolower(str_contains($row['lokasi'], 'jakarta'))) ? 'jakarta' : 'palembang');
                            $harga = 'price';
                            $rating = $row['rating'] . 'star';

                            if ($row['harga'] < 250000) {
                                $harga .= '1';
                            } else if ($row['harga'] < 500000) {
                                $harga .= '2';
                            } else if ($row['harga'] < 750000) {
                                $harga .= '3';
                            } else if ($row['harga'] < 1000000) {
                                $harga .= '4';
                            } else {
                                $harga .= '5';
                            }
                        ?>
                            <div class="element-item <?= $lokasi . ' ' . $harga . ' ' . $rating; ?>">
                                <a class="popup-with-move-anim" href="#<?= $slug; ?>">
                                    <div class="element-item-overlay">
                                        <span><?= $row['namaHotel']; ?></span>
                                    </div>
                                    <img src="<?= base_url($row['pathFoto']); ?>" alt="<?= $slug; ?>.jpeg" style="width:300px; height:300px; object-fit:cover">
                                </a>
                            </div>
                        <?php } ?>
                    </div> <!-- end of grid -->
                    <!-- end of filter -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of filter -->
    <!-- end of hotels -->

    <!-- Top 3 hotels -->
    <div id="top3hotels" class="cards-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">TOP RATED</div>
                    <h2>Some of Our Top Rated Hotels</h2>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php foreach ($top3Hotels as $row) { ?>
                        <!-- Card -->
                        <div class="card">
                            <div class="card-image">
                                <img class="img-fluid" src="<?= base_url($row['pathFoto']); ?>" alt="<?= url_title($row['namaHotel'], '-', true); ?>.jpeg" style="width: 100%; height: 36vh; object-fit:cover">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><?= $row['namaHotel']; ?></h3>
                                <h5 style="text-align: center; padding-bottom: .5rem">
                                    <?php for ($i = 0; $i < $row['rating']; $i++) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php } ?>
                                </h5>
                                <p style="text-align:center; padding-bottom: .5rem"><?= $row['lokasi']; ?></p>
                                <ul class="list-unstyled li-space-lg">
                                    <h6>Facilities</h6>
                                    <?php
                                    $facilities = explode(',', $row['fasilitas']);
                                    foreach ($facilities as $f) { ?>
                                        <li class="media">
                                            <i class="fas fa-square"></i>
                                            <div class="media-body"><?= $f; ?></div>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <p class="price">Starting at <span>Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></span></p>
                            </div>
                            <div class="button-container">
                                <a class="btn-solid-reg page-scroll" href="<?= base_url('Home/toBookHotel/' . $row['idHotel']); ?>">BOOK HOTEL</a>
                            </div> <!-- end of button-container -->
                        </div>
                        <!-- end of card -->
                    <?php } ?>

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-2 -->
    <!-- end of top 3 hotels -->


    <!-- Project Lightboxes -->
    <!-- Lightbox -->
    <?php foreach ($hotels as $row) {
        $slug = url_title($row['namaHotel'], '-', true);
    ?>
        <div id="<?= $slug; ?>" class="lightbox-basic zoom-anim-dialog mfp-hide">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <img class="img-fluid" src="<?= base_url($row['pathFoto']); ?>" alt="<?= $slug; ?>.jpeg" style="width: 100%; height: 100vh; object-fit:cover">
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <div style="height: 92.3vh;">
                        <h3><?= $row['namaHotel']; ?></h3>
                        <h5>
                            <?php for ($i = 0; $i < $row['rating']; $i++) { ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                        </h5>
                        <hr>
                        <h6><?= $row['lokasi']; ?></h6>
                        <p style="text-align: justify; padding-right: 5px"><?= $row['deskripsi']; ?></p>
                    </div>
                    <div class="text-right">
                        <a class="btn-solid-reg" href="<?= base_url('Home/toBookHotel/' . $row['idHotel']); ?>">BOOK HOTEL</a>
                        <a class="btn-outline-reg mfp-close as-button" href="#hotels">BACK</a>
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of lightbox-basic -->
    <?php } ?>
    <!-- end of lightbox -->

    <!-- About -->
    <div id="about" class="counter">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-xl-6">
                    <div class="image-container">
                        <img class="img-fluid" src="<?= base_url('assets/images/about.jpg'); ?>" alt="image" style="height: 376px">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                <div class="col-lg-7 col-xl-6">
                    <div class="text-container">
                        <div class="section-title">ABOUT US</div>
                        <h2>Travelokie</h2>
                        <p>At Travelokie, we provided an easy and simple hotel booking services online. Travelokie was established by a team of UMN College Students in 2021.</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Andre Chandra Putra</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Chotiwut</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Darren Denisson Chandra</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">William Wijaya</div>
                            </li>
                        </ul>

                        <!-- Counter -->
                        <div id="counter">
                            <div class="cell">
                                <div class="counter-value number-count" data-count="237">1</div>
                                <div class="counter-info">Happy<br>Users</div>
                            </div>
                            <div class="cell">
                                <div class="counter-value number-count" data-count="401">1</div>
                                <div class="counter-info">Hotels<br>Booked</div>
                            </div>
                            <div class="cell">
                                <div class="counter-value number-count" data-count="359">1</div>
                                <div class="counter-info">Good<br>Reviews</div>
                            </div>
                        </div>
                        <!-- end of counter -->

                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of counter -->
    <!-- end of about -->

    <!-- Team -->
    <div class="basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Our Team</h2>
                    <p class="p-heading">The men behind the project</p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Team Member -->
                    <div class="team-member">
                        <div class="image-wrapper">
                            <img class="img-fluid" src="<?= base_url('assets/images/about/andre.jpg'); ?>" alt="andre.jpg">
                        </div> <!-- end of image-wrapper -->
                        <p class="p-large"><b>Andre Chandra Putra</b></p>
                        <p>00000036266</p>
                        <p class="job-title">Front-End</p>
                        <span class="social-icons">
                            <span class="fa-stack">
                                <a href="https://www.instagram.com/andrechandraap/">
                                    <span class="hexagon"></span>
                                    <i class="fab fa-instagram fa-stack-1x"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="mailto:andre.chandra@student.umn.ac.id">
                                    <span class="hexagon"></span>
                                    <i class="fas fa-envelope fa-stack-1x"></i>
                                </a>
                            </span>
                        </span>
                    </div> <!-- end of team-member -->
                    <!-- end of team member -->

                    <!-- Team Member -->
                    <div class="team-member">
                        <div class="image-wrapper">
                            <img class="img-fluid" src="<?= base_url('assets/images/about/chotiwut.jpg'); ?>" alt="chotiwut.jpg">
                        </div> <!-- end of image wrapper -->
                        <p class="p-large"><b>Chotiwut</b></p>
                        <p>00000034993</p>
                        <p class="job-title">Back-End</p>
                        <span class="social-icons">
                            <span class="fa-stack">
                                <a href="https://www.instagram.com/chotiwut_/">
                                    <span class="hexagon"></span>
                                    <i class="fab fa-instagram fa-stack-1x"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="mailto:chotiwut@student.umn.ac.id">
                                    <span class="hexagon"></span>
                                    <i class="fas fa-envelope fa-stack-1x"></i>
                                </a>
                            </span>
                        </span>
                    </div> <!-- end of team-member -->
                    <!-- end of team member -->

                    <!-- Team Member -->
                    <div class="team-member">
                        <div class="image-wrapper">
                            <img class="img-fluid" src="<?= base_url('assets/images/about/darren.jpg'); ?>" alt="darren.jpg">
                        </div> <!-- end of image wrapper -->
                        <p class="p-large"><b>Darren Denisson Chandra</b></p>
                        <p>00000034810</p>
                        <p class="job-title">Back-End</p>
                        <span class="social-icons">
                            <span class="fa-stack">
                                <a href="https://www.instagram.com/dc.darren/">
                                    <span class="hexagon"></span>
                                    <i class="fab fa-instagram fa-stack-1x"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="mailto:darren.denisson@student.umn.ac.id">
                                    <span class="hexagon"></span>
                                    <i class="fas fa-envelope fa-stack-1x"></i>
                                </a>
                            </span>
                        </span>
                    </div> <!-- end of team-member -->
                    <!-- end of team member -->

                    <!-- Team Member -->
                    <div class="team-member">
                        <div class="image-wrapper">
                            <img class="img-fluid" src="<?= base_url('assets/images/about/william.jpg'); ?>" alt="william.jpg">
                        </div> <!-- end of image wrapper -->
                        <p class="p-large"><b>William Wijaya</b></p>
                        <p>00000036425</p>
                        <p class="job-title">Front-End</p>
                        <span class="social-icons">
                            <span class="fa-stack">
                                <a href="https://www.instagram.com/wiliamwijaya40/">
                                    <span class="hexagon"></span>
                                    <i class="fab fa-instagram fa-stack-1x"></i>
                                </a>
                            </span>
                            <span class="fa-stack">
                                <a href="mailto:william.wijaya1@student.umn.ac.id">
                                    <span class="hexagon"></span>
                                    <i class="fas fa-envelope fa-stack-1x"></i>
                                </a>
                            </span>
                        </span>
                    </div> <!-- end of team-member -->
                    <!-- end of team member -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-2 -->
    <!-- end of team -->

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <a href="<?= base_url(); ?>"><img src="<?= base_url('assets/images/logo.png'); ?>" alt="Travelokie" style="block-size: auto"></a>
                </div> <!-- end of col -->
                <div class="col-md-6">
                    <div class="text-container about">
                        <h4>Few Words About Travelokie</h4>
                        <p class="white">We're passionate about delivering the best services for hotel bookings.</p>
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
                    <p class="p-small">Copyright © 2021 <a href="https://inovatik.com">Template by Inovatik</a></p>
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
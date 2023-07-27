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
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/other.css'); ?>">

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
                <!-- Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle page-scroll" href="#" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
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
                <!-- end of dropdown menu -->
            </ul>
        </div>
    </nav> <!-- end of navbar -->
    <!-- end of navbar -->

    <!-- Message -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="container" style="z-index: 2;">
            <div class="alert alert-success" role="alert">
                <span><?= session()->getFlashdata('message'); ?></span>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        </div>
    <?php endif; ?>
    <!-- end of message -->

    <!-- Content -->
    <?= $this->renderSection('content'); ?>
    <!-- end of content -->

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-container about">
                        <h4>Few Words About Travelokie</h4>
                        <p class="white">We're passionate about delivering the best services for hotel bookings.</p>
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
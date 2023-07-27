<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Title -->
    <title>Travelokie - Admin</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=latin-ext">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600&display=swap&subset=latin-ext">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/fontawesome-all.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/swiper.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/magnific-popup.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/styles.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css'); ?>">



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

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <form class="form-inline">
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <a style="text-decoration:none;" class="nav-link" href="<?= base_url('Admin'); ?>">Data Hotel</a>
                            <a style="text-decoration:none;" class="nav-link" href="<?= base_url('Admin/tableBooking'); ?>">Data Booking</a>
                            <a style="text-decoration:none;" class="nav-link" href="<?= base_url('Admin/tableUser'); ?>">Data User</a>
                            <a type="button" style="margin-left: 5px" class="btn btn-danger" href="<?= base_url('Home/logout'); ?>">Sign Out</a>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->

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
                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="p-small">Copyright © 2021 Travelokie</a></p>
                                </div> <!-- end of col -->
                            </div> <!-- enf of row -->
                        </div> <!-- end of container -->
                    </div> <!-- end of copyright -->
                    <!-- end of copyright -->
                </div>
            </div>

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

            <!-- Bootstrap core JavaScript-->
            <script type="text/javascript" src="<?= base_url('assets/admin/vendor/jquery/jquery.min.js'); ?>"></script>
            <script type="text/javascript" src="<?= base_url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>


            <!-- Core plugin JavaScript-->
            <script type="text/javascript" src="<?= base_url('assets/admin/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

            <!-- Custom scripts for all pages-->

            <script type="text/javascript" src="<?= base_url('assets/admin/js/sb-admin-2.min.js'); ?>"></script>

            <!-- Page level plugins -->
            <script type="text/javascript" src="<?= base_url('assets/admin/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
            <script type="text/javascript" src="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>


            <!-- Page level custom scripts -->
            <script type="text/javascript" src="<?= base_url('assets/admin/js/demo/datatables-demo.js'); ?>"></script>


            <script type="text/javascript">
                $(document).ready(function() {
                    $('#mainTable').DataTable();
                })
            </script>
    </body>

</html>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Landing | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= $appIdentity['app_icon']; ?>">

    <!--Swiper slider css-->
    <link href="<?= base_url(); ?>/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="<?= base_url(); ?>/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url(); ?>/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="<?= $appIdentity['app_brand']; ?>" class="card-logo card-logo-dark" alt="logo dark" height="35">
                    <img src="<?= $appIdentity['app_brand_light']; ?>" class="card-logo card-logo-light" alt="logo light" height="35">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url(); ?>">Home</a>
                        </li>
                    </ul>

                    <div class="">
                        <a href="<?= base_url(); ?>/login" class="btn btn-success">Login</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->

        <!-- start hero section -->
        <section class="section hero-section" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-sm-10">
                        <div class="text-center mt-lg-5 pt-5">
                            <h1 class="display-6 fw-semibold mb-3 lh-base">Selamat Datang di Aplikasi <span class="text-success"><?= $appIdentity['app_name']; ?> </span></h1>

                            <div class="d-flex gap-2 justify-content-center mt-4">
                                <a href="<?= base_url(); ?>/login" class="btn btn-success">Login <i class="ri-arrow-right-line align-middle ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
            <div class="position-absolute start-0 end-0 bottom-0 hero-shape-svg">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <g mask="url(&quot;#SvgjsMask1003&quot;)" fill="none">
                        <path d="M 0,118 C 288,98.6 1152,40.4 1440,21L1440 140L0 140z">
                        </path>
                    </g>
                </svg>
            </div>
            <!-- end shape -->
        </section>
        <!-- end hero section -->


        <!-- Start footer -->
        <footer class="custom-footer bg-dark py-5 position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mt-4">
                        <div>
                            <div>
                                <img src="<?= $appIdentity['app_brand_light']; ?>" alt="logo light" height="45">
                            </div>
                            <div class="mt-4 fs-13">
                                <p><?= $appIdentity['app_name']; ?></p>
                                <p class="ff-secondary"><?= $appIdentity['app_description']; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 ms-lg-auto">
                        <div class="row">
                            <div class="col-sm-12 mt-4">
                                <h5 class="text-white mb-0">Menu</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="<?= base_url(); ?>/login">Login</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center text-sm-start align-items-center mt-5">
                    <div class="col-sm-12">
                        <div>
                            <p class="copy-rights mb-0">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © <?= $appIdentity['app_title']; ?> - Asnanmtakim
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->


        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->


    <!-- JAVASCRIPT -->
    <script src="<?= base_url(); ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins.js"></script>

    <!--Swiper slider js-->
    <script src="<?= base_url(); ?>/assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- landing init -->
    <script src="<?= base_url(); ?>/assets/js/pages/landing.init.js"></script>
</body>

</html>
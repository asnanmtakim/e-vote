<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title><?= $title; ?> | <?= $appIdentity['app_name']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Asnanmtakim" />
    <meta name="description" content="<?= $appIdentity['app_description']; ?>" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= $appIdentity['app_icon']; ?>">

    <!-- Layout config Js -->
    <script src="<?= base_url(); ?>/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <?= $this->renderSection('libPageStyles') ?>

    <!-- App Css-->
    <link href="<?= base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url(); ?>/assets/css/custom.css" rel="stylesheet" type="text/css" />

    <?= $this->renderSection('pageStyles') ?>
    <style>
        .auth-one-bg {
            background-image: url("/assets/images/bg-login.jpeg");
        }
    </style>
</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="<?= $appIdentity['app_brand_light']; ?>" alt="" height="65">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Satu byte lebih dekat "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <?= $this->renderSection('main') ?>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> <?= $appIdentity['app_title']; ?>. Crafted with <i class="mdi mdi-heart text-danger"></i> by Asnanmtakim
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?= base_url(); ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins.js"></script>

    <?= $this->renderSection('libPageScripts') ?>

    <!-- particles js -->
    <script src="<?= base_url(); ?>/assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="<?= base_url(); ?>/assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="<?= base_url(); ?>/assets/js/pages/password-addon.init.js"></script>

    <?= $this->renderSection('pageScripts') ?>
</body>

</html>
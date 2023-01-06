<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

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
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?= $this->include('dashboard/layout/navbar') ?>
        <!-- ========== App Menu ========== -->
        <?= $this->include('dashboard/layout/sidebar') ?>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <?= $this->renderSection('main') ?>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2022 © <a href="<?= base_url(); ?>"><?= $appIdentity['app_title']; ?></a>.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by <a href="https://instagram.com/asnanmtakim/" target="_blank" rel="noopener noreferrer">Asnanmtakim</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div><!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div id="loading-ajax">
        <div id="status">
            <div class="spinner-border text-success avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

    <!-- Theme Settings -->
    <?= $this->include('dashboard/layout/settings') ?>

    <!-- JAVASCRIPT -->
    <script>
        var BASE_URL = '<?= base_url(); ?>';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url(); ?>/assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= base_url(); ?>/assets/js/plugins.js"></script>

    <?= $this->renderSection('libPageScripts') ?>

    <?= $this->renderSection('pageScripts') ?>

    <!-- App js -->
    <script src="<?= base_url(); ?>/assets/js/app.js"></script>

</body>

</html>
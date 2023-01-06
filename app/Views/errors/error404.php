<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="enable">

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
    <!-- App Css-->
    <link href="<?= base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url(); ?>/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">

        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden p-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="text-center">
                            <img src="<?= base_url(); ?>/assets/images/error400-cover.png" alt="error img" class="img-fluid">
                            <div class="mt-3">
                                <h3 class="text-uppercase">Sorry, Page not Found 😭</h3>
                                <p class="text-muted mb-4"><?= $message; ?></p>
                                <?php if (auth()->loggedIn()) : ?>
                                    <a href="<?= base_url(); ?>/dashboard" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Kembali ke Dashboard</a>
                                <?php else : ?>
                                    <a href="<?= base_url(); ?>" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Kembali ke Home</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth-page content -->
    </div>
    <!-- end auth-page-wrapper -->

</body>

</html>
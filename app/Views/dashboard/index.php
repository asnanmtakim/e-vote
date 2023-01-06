<?= $this->extend('dashboard/layout/layout') ?>

<?= $this->section('libPageStyles') ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/libs/jsvectormap/css/jsvectormap.min.css">
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle text-warning me-2 icon-sm">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                            <div class="flex-grow-1 text-truncate">
                                Welcome.
                            </div>
                        </div>

                        <div class="row align-items-end">
                            <div class="col-sm-8">
                                <div class="p-3">
                                    <p class="fs-16 lh-base">Selamat Datang di Aplikasi <?= $appIdentity['app_name']; ?> <i class="mdi mdi-arrow-right"></i></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="px-3">
                                    <img src="assets/images/user-illustarator-2.png" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div>
            </div> <!-- end col-->
        </div> <!-- end row-->

    </div>
    <!-- container-fluid -->
</div>
<?= $this->endSection() ?>

<?= $this->section('libPageScripts') ?>
<!-- apexcharts -->
<script src="<?= base_url(); ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Vector map-->
<script src="<?= base_url(); ?>/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="<?= base_url(); ?>/assets/libs/jsvectormap/maps/world-merc.js"></script>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url(); ?>/assets/js/pages/dashboard-analytics.init.js"></script>
<?= $this->endSection() ?>
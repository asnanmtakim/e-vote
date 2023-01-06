<?= $this->extend('dashboard/layout/layout') ?>

<?= $this->section('libPageStyles') ?>
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<!-- Magnific Popup -->
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/magnific-popup/dist/magnific-popup.css">
<!-- Sweet Alert css-->
<link href="<?= base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<style>
    .choices__placeholder {
        color: var(--vz-card-color) !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Data Calon Formatur</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Calon Formatur</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h5 class="card-title mb-0 flex-grow-1">Data Calon Formatur <?= $appIdentity['app_title']; ?></h5>
                        <div class="flex-shrink-0">
                            <a href="<?= base_url(); ?>/dashboard/calon/add" class="btn btn-sm btn-primary"><i class="ri-file-add-line fs-14 align-middle"></i> Tambah Calon Formatur</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-3">
                                <label for="select_gender">Pilih Gender</label>
                                <select class="form-control" data-choices id="select_gender">
                                    <option value="" selected>Semua Gender</option>
                                    <option value="L" <?= session()->get('gender') == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="P" <?= session()->get('gender') == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <hr class="mt-0">
                        <div class="table-responsive">
                            <table id="tb-data-calon" class="table table-bordered nowrap table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Gender</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
    <!-- container-fluid -->
</div>
<?= $this->endSection() ?>

<?= $this->section('libPageScripts') ?>
<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!-- Magnific Popup -->
<script src="<?= base_url() ?>/assets/libs/magnific-popup/dist/jquery.magnific-popup.js"></script>
<!-- Sweet Alerts js -->
<script src="<?= base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/pages/password-addon.init.js"></script>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url(); ?>/assets/js/pages/calon.init.js"></script>
<?= $this->endSection() ?>
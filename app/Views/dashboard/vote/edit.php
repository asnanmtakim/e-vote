<?= $this->extend('dashboard/layout/layout') ?>

<?= $this->section('libPageStyles') ?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/cropperjs/dist/cropper.css">
<!-- Sweet Alert css-->
<link href="<?= base_url(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
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
                    <h4 class="mb-sm-0"><?= $title; ?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard/calon">Calon Formatur</a></li>
                            <li class="breadcrumb-item active"><?= $title; ?></li>
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
                        <h4 class="card-title mb-0 flex-grow-1"><?= $title; ?> <?= $appIdentity['app_title']; ?></h4>
                        <div class="flex-shrink-0">
                            <h6 class="mb-0 flex-grow-1">* harus diisi</h6>
                        </div>
                    </div><!-- end card header -->
                    <form action="<?= base_url() ?>/dashboard/calon/edit" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_calon" value="<?= $calon['id_calon']; ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_calon" class="form-label">Nama Calon*</label>
                                        <input type="text" class="form-control" id="nama_calon" name="nama_calon" inputmode="text" autocomplete="nama_calon" placeholder="Nama Calon" value="<?= $calon['nama_calon']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Jenis Kelamin*</label>
                                        <div id="gender-form">
                                            <div class="form-check form-check-inline form-radio-success">
                                                <input class="form-check-input" type="radio" name="gender_calon" id="genderL" value="L" <?= $calon['gender_calon'] == 'L' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="genderL">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline form-radio-success">
                                                <input class="form-check-input" type="radio" name="gender_calon" id="genderP" value="P" <?= $calon['gender_calon'] == 'P' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="genderP">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto_calon" class="form-label">Foto</label>
                                        <div class="row">
                                            <div class="col-sm-4 mb-2">
                                                <img src="<?= checkImageCalon($calon['foto_calon'], $calon['gender_calon']); ?>" id="image-calon-show" class="img-fluid img-thumbnail rounded" />
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="file" accept="image/*" name="foto_calon" class="form-control image-calon-input" id="foto_calon" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-soft-dark">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div> <!-- container-fluid -->
</div>

<div class="modal fade" id="cropImage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cropImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="cropImageLabel">Crop dan Sesuaikan Gambar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-9">
                            <img src="" id="image-crop-upload" />
                        </div>
                        <div class="col-md-3">
                            <div class="preview-cropper"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="crop-save" class="btn btn-primary">Crop and Save</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('libPageScripts') ?>
<script src="<?= base_url() ?>/assets/libs/cropperjs/dist/cropper.js"></script>
<!-- Sweet Alerts js -->
<script src="<?= base_url(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url(); ?>/assets/js/pages/password-addon.init.js"></script>
<script src="<?= base_url(); ?>/assets/js/pages/calon-edit.init.js"></script>
<?= $this->endSection() ?>
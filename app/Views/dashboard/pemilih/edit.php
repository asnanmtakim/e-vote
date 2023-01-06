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
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard/pemilih">Pemilih</a></li>
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
                    <form action="<?= base_url() ?>/dashboard/pemilih/edit" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="user_id" value="<?= $user->id; ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label"><?= lang('Auth.email') ?>*</label>
                                        <input type="email" class="form-control" id="email" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= $user->email; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="username" class="form-label">Token*</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="username" name="username" inputmode="text" autocomplete="username" placeholder="Token" readonly value="<?= $user->username; ?>">
                                            <button type="button" class="input-group-text bg-danger" onclick="getToken()">Generate</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="first_name" class="form-label"><?= lang('Auth.first_name') ?>*</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" inputmode="text" autocomplete="first_name" placeholder="<?= lang('Auth.first_name') ?>" value="<?= $user->first_name; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="last_name" class="form-label"><?= lang('Auth.last_name') ?>*</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" inputmode="text" autocomplete="last_name" placeholder="<?= lang('Auth.last_name') ?>" value="<?= $user->last_name; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><?= lang('Auth.gender') ?>*</label>
                                        <div id="gender-form">
                                            <div class="form-check form-check-inline form-radio-success">
                                                <input class="form-check-input" type="radio" name="gender" id="genderL" value="L" <?= $user->gender == 'L' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="genderL"><?= lang('Auth.genderMale'); ?></label>
                                            </div>
                                            <div class="form-check form-check-inline form-radio-success">
                                                <input class="form-check-input" type="radio" name="gender" id="genderP" value="P" <?= $user->gender == 'P' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="genderP"><?= lang('Auth.genderFemale'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_user" class="form-label">Foto</label>
                                        <div class="row">
                                            <div class="col-sm-4 mb-2">
                                                <img src="<?= checkImageUser($user->image_user); ?>" id="image-user-show" class="img-fluid img-thumbnail rounded" />
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="file" accept="image/*" name="image_user" class="form-control image-user-input" id="image_user" />
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
<script src="<?= base_url(); ?>/assets/js/pages/pemilih-edit.init.js"></script>
<?= $this->endSection() ?>
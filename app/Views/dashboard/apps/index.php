<?= $this->extend('dashboard/layout/layout') ?>

<?= $this->section('libPageStyles') ?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/cropperjs/dist/cropper.css">
<!-- Sweet Alert css-->
<link href="<?= base_url(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<style>
    #sample_image3,
    #sample_image4,
    #sample_image5 {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        height: 200px;
        margin: 10px;
        border: 1px solid red;
    }

    .overlay {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.5);
        overflow: hidden;
        height: 0;
        transition: .5s ease;
        width: 100%;
    }

    .text {
        color: #333;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
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
                    <h4 class="mb-sm-0">Setting Aplikasi</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Setting Aplikasi</li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Setting Identitas Aplikasi</h4>
                        <div class="flex-shrink-0">
                            <h6 class="mb-0 flex-grow-1">* harus diisi</h6>
                        </div>
                    </div><!-- end card header -->
                    <form action="<?= base_url() ?>/dashboard/apps" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <?php foreach ($apps as $ap) : ?>
                                <?php if ($ap['conf_type'] == 'text') : ?>
                                    <div class="form-group mb-2 row">
                                        <label for="<?= $ap['conf_char'] ?>" class="col-sm-2 mt-2"><?= $ap['conf_name']; ?>*</label>
                                        <div class="col-sm-5">
                                            <div class="input-group mb-2">
                                                <span class="input-group-text" id="basic-addon1">ID</span>
                                                <input type="text" class="form-control" id="<?= $ap['conf_char'] ?>" name="<?= $ap['conf_char'] ?>" value="<?= $ap['conf_value']; ?>" placeholder="<?= $ap['conf_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="input-group mb-2">
                                                <span class="input-group-text" id="basic-addon1">EN</span>
                                                <input type="text" class="form-control" id="<?= $ap['conf_char'] ?>_en" name="<?= $ap['conf_char'] ?>_en" value="<?= $ap['conf_value_en']; ?>" placeholder="<?= $ap['conf_name']; ?> (EN)">
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif ($ap['conf_type'] == 'textarea') : ?>
                                    <div class="form-group mb-2 row">
                                        <label for="<?= $ap['conf_char']; ?>" class="col-sm-2 mt-2"><?= $ap['conf_name']; ?>*</label>
                                        <div class="col-sm-5">
                                            <div class="input-group mb-2">
                                                <span class="input-group-text" id="basic-addon1">ID</span>
                                                <textarea type="text" class="form-control" id="<?= $ap['conf_char']; ?>" name="<?= $ap['conf_char']; ?>" rows="5" placeholder="<?= $ap['conf_name']; ?>"><?= $ap['conf_value']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="input-group mb-2">
                                                <span class="input-group-text" id="basic-addon1">EN</span>
                                                <textarea type="text" class="form-control" id="<?= $ap['conf_char']; ?>_en" name="<?= $ap['conf_char']; ?>_en" rows="5" placeholder="<?= $ap['conf_name']; ?> (EN)"><?= $ap['conf_value_en']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="form-group mb-2 row">
                                        <label for="<?= $ap['conf_char']; ?>" class="col-sm-2 mt-2"><?= $ap['conf_name']; ?>*</label>
                                        <div class="col-sm-10">
                                            <label for="<?= $ap['conf_char']; ?>">
                                                <img src="<?= base_url(); ?>/<?= $ap['conf_value']; ?>" id="image<?= $ap['conf_char'] ?>" class="img-responsive img-fluid" style="max-height: 120px;" />
                                                <div class="overlay">
                                                    <div class="text">Klik Untuk Mengubah Gambar</div>
                                                </div>
                                                <input type="file" accept="image/*" name="image" class="image" id="<?= $ap['conf_char']; ?>" style="display:none" />
                                            </label>
                                            <div class="error-validation">

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
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

<div class="modal fade" id="modal3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop dan Sesuaikan Gambar</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-9">
                            <img src="" id="sample_image3" />
                        </div>
                        <div class="col-md-3">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop3" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop dan Sesuaikan Gambar</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-9">
                            <img src="" id="sample_image4" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop4" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop dan Sesuaikan Gambar</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-9">
                            <img src="" id="sample_image5" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop5" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
<script>
    $(document).ready(function() {
        <?php foreach ($apps as $key => $ap) : ?>
            <?php if ($ap['conf_type'] == 'img') : ?>
                var $modal<?= $key; ?> = $('#modal<?= $key; ?>');
                var image<?= $key; ?> = document.getElementById('sample_image<?= $key; ?>');
                var cropper<?= $key; ?>;
                var <?= $ap['conf_char']; ?>;

                $('#<?= $ap['conf_char']; ?>').change(function(event) {
                    var files = event.target.files;

                    var done = function(url) {
                        image<?= $key; ?>.src = url;
                        $modal<?= $key; ?>.modal('show');
                    };

                    if (files && files.length > 0) {
                        reader = new FileReader();
                        reader.onload = function(event) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(files[0]);
                    }
                });

                $modal<?= $key; ?>.on('shown.bs.modal', function() {
                    <?php if ($ap['conf_char'] == 'app_icon') : ?>
                        cropper<?= $key; ?> = new Cropper(image<?= $key; ?>, {
                            aspectRatio: 1 / 1,
                            viewMode: 1,
                            preview: '.preview'
                        });
                    <?php else : ?>
                        cropper<?= $key; ?> = new Cropper(image<?= $key; ?>, {
                            aspectRatio: 5 / 2,
                            viewMode: 1,
                            preview: '.preview'
                        });
                    <?php endif; ?>
                }).on('hidden.bs.modal', function() {
                    cropper<?= $key; ?>.destroy();
                    cropper<?= $key; ?> = null;
                });

                $('#crop<?= $key; ?>').click(function() {
                    <?php if ($ap['conf_char'] == 'app_icon') : ?>
                        canvas = cropper<?= $key; ?>.getCroppedCanvas({
                            width: 100,
                            height: 100
                        });
                    <?php else : ?>
                        canvas = cropper<?= $key; ?>.getCroppedCanvas({
                            width: 500,
                            height: 200
                        });
                    <?php endif; ?>

                    $('#image<?= $ap['conf_char'] ?>').attr('src', canvas.toDataURL());
                    <?= $ap['conf_char']; ?> = canvas.toDataURL();
                    $modal<?= $key; ?>.modal('hide');
                });
            <?php endif; ?>
        <?php endforeach; ?>

        $("form").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize() + '&app_icon=' + app_icon + '&app_brand=' + app_brand + '&app_brand_light=' + app_brand_light;
            $.ajax({
                url: $(this).attr("action"),
                data: formData,
                type: $(this).attr("method"),
                success: function(res) {
                    res = JSON.parse(res);
                    if (res.status == 200) {
                        Swal.fire({
                            title: "Sukses",
                            text: res.pesan,
                            icon: "success",
                            confirmButtonClass: "btn btn-info",
                            buttonsStyling: false,
                        }).then(function(_res_) {
                            location.reload();
                        });
                    } else {
                        if (res.status == 400) {
                            var frm = Object.keys(res.pesan);
                            var val = Object.values(res.pesan);
                            $('form .invalid-feedback').remove();
                            frm.forEach(function(el, ind) {
                                if (val[ind] != '') {
                                    $('form #' + el).removeClass('is-invalid').addClass("is-invalid");
                                    var app = '<div id="' + el + '-error" class="invalid-feedback" for="' + el + '">' + val[ind] + '</div>';
                                    $('form #' + el).closest('.input-group').append(app);
                                } else {
                                    $('form #' + el).removeClass('is-invalid');
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: res.pesan,
                                icon: "error",
                                confirmButtonClass: "btn btn-danger",
                                buttonsStyling: false,
                            });
                        }
                    }
                }
            })
            return false;
        });
    });
</script>
<?= $this->endSection() ?>
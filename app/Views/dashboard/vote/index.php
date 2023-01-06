<?= $this->extend('dashboard/layout/layout') ?>

<?= $this->section('libPageStyles') ?>
<!-- Sweet Alert css-->
<link href="<?= base_url(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<style>
    .nopad {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    /*image gallery*/
    .image-checkbox {
        cursor: pointer;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border: 4px solid transparent;
        margin-bottom: 0;
        outline: 0;
    }

    .image-checkbox input[type="checkbox"] {
        display: none;
    }

    .image-checkbox-checked {
        border-color: #4783B0;
    }

    .image-checkbox .icon {
        position: absolute;
        color: #4A79A3;
        background-color: #fff;
        padding: 10px;
        top: 0;
        right: 0;
    }

    .image-checkbox-checked .icon {
        display: block !important;
    }

    .submit-vote-btn {
        position: fixed;
        bottom: 40px;
        left: 46%;
        z-index: 1000;
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
                    <h4 class="mb-sm-0"><?= $title; ?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <?php if ($pilihan) : ?>
            <form action="<?= base_url(); ?>/dashboard/vote-submit" method="post">
                <div class="row justify-content-center">
                    <?php foreach ($calon as $cln) : ?>
                        <div class="col-md-2">
                            <div class="card card-body p-1">
                                <label class="image-checkbox text-center">
                                    <img class="img-fluid" src="<?= checkImageCalon($cln['foto_calon'], $cln['gender_calon']); ?>" alt="<?= $cln['nama_calon']; ?>" />
                                    <input type="checkbox" name="vote[]" value="<?= $cln['id_calon']; ?>" />
                                    <i class="icon ri-check-double-line d-none"></i>
                                    <span><?= $cln['nama_calon']; ?></span>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success submit-vote-btn">Submit Suara <span class="position-absolute topbar-badge fs-12 translate-middle badge rounded bg-secondary" id="count-pilihan">0</span></button>
                    </div>
                </div>
            </form>
        <?php else : ?>
            <div class="alert alert-success alert-dismissible alert-additional fade show" role="alert">
                <div class="alert-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <i class="ri-notification-off-line fs-16 align-middle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="alert-heading">Yey! Selamat anda sudah melakukan vote!</h5>
                            <p class="mb-0">Anda dinyatakan sudah memilih.</p>
                        </div>
                    </div>
                </div>
                <div class="alert-content">
                    <p class="mb-0">Terimakasih atas partitsipasinya, semoga sehat selalu.</p>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="<?= base_url(); ?>/logout" class="btn rounded-pill btn-warning waves-effect waves-light"><i class="ri-logout-box-line"></i> Keluar</a>
            </div>
        <?php endif; ?>

    </div>
    <!-- container-fluid -->
</div>
<?= $this->endSection() ?>

<?= $this->section('libPageScripts') ?>
<!-- Sweet Alerts js -->
<script src="<?= base_url(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
    // image gallery
    // init the state from the input
    $(".image-checkbox").each(function() {
        if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
            $(this).addClass('image-checkbox-checked');
        } else {
            $(this).removeClass('image-checkbox-checked');
        }
    });

    // sync the state to the input
    $(".image-checkbox").on("click", function(e) {
        $(this).toggleClass('image-checkbox-checked');
        var $checkbox = $(this).find('input[type="checkbox"]');
        $checkbox.prop("checked", !$checkbox.prop("checked"));
        let pilihan = $('.image-checkbox-checked').length;
        $('#count-pilihan').html(pilihan);
        e.preventDefault();
    });

    $(document).ready(function() {
        $("form").submit(function(e) {
            e.preventDefault();
            let pilihan = $('.image-checkbox-checked').length;
            let max = 2;
            if (pilihan < max) {
                Swal.fire({
                    html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Pilihan kurang dari ' + max + ' !</h4><p class="text-muted mx-4 mb-0"></p></div></div>',
                    showCancelButton: !0,
                    showConfirmButton: !1,
                    cancelButtonClass: "btn btn-primary w-xs mb-1",
                    cancelButtonText: "Pilih Kembali",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                });
            } else if (pilihan > max) {
                Swal.fire({
                    html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Pilihan lebih dari ' + max + ' !</h4><p class="text-muted mx-4 mb-0"></p></div></div>',
                    showCancelButton: !0,
                    showConfirmButton: !1,
                    cancelButtonClass: "btn btn-primary w-xs mb-1",
                    cancelButtonText: "Pilih Kembali",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                });
            } else {
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr("action"),
                    data: formData,
                    type: $(this).attr("method"),
                    success: function(res) {
                        console.log(res);
                        res = JSON.parse(res);
                        if (res.status == 200) {
                            Swal.fire({
                                title: "Sukses",
                                text: res.pesan,
                                icon: "success",
                                confirmButtonClass: "btn btn-info",
                                buttonsStyling: false,
                            }).then(function() {
                                location.href = "/dashboard/vote";
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
                    },
                });
                return false;
            }
        });
    });
</script>
<?= $this->endSection() ?>
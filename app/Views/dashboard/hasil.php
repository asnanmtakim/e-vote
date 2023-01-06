<?= $this->extend('dashboard/layout/layout') ?>

<?= $this->section('libPageStyles') ?>
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
                            <li class="breadcrumb-item active"><?= $title; ?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="live-preview">
                            <?php foreach ($hasil_vote as $hv) : ?>
                                <div class="card bg-light overflow-hidden shadow-none">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">
                                                    <img src="<?= checkImageCalon($hv['foto_calon'], $hv['gender_calon']); ?>" alt="" class="rounded avatar-xs"> <?= $hv['nama_calon']; ?>
                                                </h6>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h6 class="mb-0"><?= $hv['jumlah_hasil']; ?> | <?= $hv['persen']; ?>%</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress bg-soft-secondary rounded-0">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: <?= $hv['persen']; ?>%" aria-valuenow="<?= $hv['persen']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
        </div> <!-- end row-->
    </div>
    <!-- container-fluid -->
</div>
<?= $this->endSection() ?>

<?= $this->section('libPageScripts') ?>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<?= $this->endSection() ?>
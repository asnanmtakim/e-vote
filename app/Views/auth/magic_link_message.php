<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('main') ?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4">
            <div class="card-body p-4 text-center">
                <div class="text-center mt-2">
                    <h5 class="text-primary"><?= lang('Auth.useMagicLink') ?></h5>
                    <div class="avatar-lg mx-auto mt-4">
                        <div class="avatar-title bg-light text-success display-3 rounded-circle">
                            <i class="ri-checkbox-circle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-2">
                    <h4><?= lang('Auth.checkYourEmail') ?></h4>
                    <p class="text-muted mx-4"><?= lang('Auth.magicLinkDetails', [setting('Auth.magicLinkLifetime') / 60]) ?></p>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>
<?= $this->endSection() ?>
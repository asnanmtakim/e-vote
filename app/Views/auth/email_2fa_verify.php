<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('main') ?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4">

            <div class="card-body p-4">
                <div class="mb-4">
                    <div class="avatar-lg mx-auto">
                        <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                            <i class="ri-mail-line"></i>
                        </div>
                    </div>
                </div>

                <div class="p-2 mt-4">
                    <div class="text-muted text-center mb-4 mx-lg-3">
                        <h4><?= lang('Auth.emailEnterCode') ?></h4>
                        <p><?= lang('Auth.emailConfirmCode') ?></p>
                    </div>
                    <?php if (session('error') !== null) : ?>
                        <div class="alert alert-danger"><?= session('error') ?></div>
                    <?php endif ?>
                    <form action="<?= url_to('auth-action-verify') ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="number" class="form-control" name="token" placeholder="000000" inputmode="numeric" pattern="[0-9]*" autocomplete="off" required />
                        </div><!-- end col -->

                        <div class="mt-3">
                            <button type="submit" class="btn btn-success w-100"><?= lang('Auth.confirm') ?></button>
                        </div>
                    </form><!-- end form -->
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>

<?= $this->endSection() ?>
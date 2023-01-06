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
                        <h4><?= lang('Auth.emailActivateTitle') ?></h4>
                        <p><?= lang('Auth.emailActivateBody') ?></p>
                    </div>
                    <?php if (session('error')) : ?>
                        <div class="alert alert-danger"><?= session('error') ?></div>
                    <?php endif ?>
                    <form action="<?= site_url('auth/a/verify') ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="token" placeholder="000000" inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code" value="<?= old('token') ?>" required />
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success w-100"><?= lang('Auth.send') ?></button>
                        </div>
                    </form><!-- end form -->

                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
        <div class="mt-4 text-center">
            <p class="mb-0"><?= lang('Auth.emailResendTitle'); ?> <a href="<?= current_url(); ?>" class="fw-semibold text-primary text-decoration-underline"><?= lang('Auth.emailResendLink'); ?></a> </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
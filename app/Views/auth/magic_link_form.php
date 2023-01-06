<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('main') ?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4">

            <div class="card-body p-4">
                <div class="text-center mt-2">
                    <h5 class="text-primary"><?= lang('Auth.useMagicLink') ?></h5>
                    <p>Masukkan email Anda dan tautan masuk akan dikirimkan kepada Anda!</p>
                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl"></lord-icon>
                </div>
                <?php if (session('error') !== null) : ?>
                    <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                <?php endif ?>
                <div class="p-2">
                    <form action="<?= url_to('magic-link') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-4">
                            <label class="form-label"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control" name="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email', auth()->user()->email ?? null) ?>" required />
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-success w-100" type="submit"><?= lang('Auth.send') ?></button>
                        </div>
                    </form><!-- end form -->
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

        <div class="mt-4 text-center">
            <p class="mb-0">Tunggu, saya ingat kata sandi saya... <a href="<?= url_to('login'); ?>" class="fw-semibold text-primary text-decoration-underline"><?= lang('Auth.login'); ?></a></p>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('main') ?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4">

            <div class="card-body p-4">
                <div class="text-center mt-2">
                    <h5 class="text-primary"><?= lang('Auth.email2FATitle') ?></h5>
                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl"></lord-icon>
                </div>

                <div class="alert alert-borderless alert-info text-center mb-2 mx-2" role="alert">
                    <?= lang('Auth.confirmEmailAddress') ?>
                </div>
                <div class="p-2">
                    <form action="<?= url_to('auth-action-handle') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-4">
                            <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" <?php /** @var \CodeIgniter\Shield\Entities\User $user */ ?> value="<?= old('email', $user->email) ?>" required />
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
    </div>
</div>

<?= $this->endSection() ?>
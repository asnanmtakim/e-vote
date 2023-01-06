<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4">

            <div class="card-body p-4">
                <div class="text-center mt-2">
                    <h5 class="text-primary">Buat Akun Baru</h5>
                    <p class="text-muted"><?= lang('Auth.register') ?> <?= $appIdentity['app_name']; ?></p>
                </div>
                <?php if (session('error') !== null) : ?>
                    <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                <?php endif ?>
                <div class="p-2 mt-4">
                    <form action="<?= url_to('register') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="useremail" class="form-label"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control<?= isset(session('errors')['email']) ? ' is-invalid' : ''; ?>" aria-describedby="errorEmail" id="useremail" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                            <?php if (isset(session('errors')['email'])) : ?>
                                <div id="errorEmail" class="invalid-feedback">
                                    <?= session('errors')['email']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label"><?= lang('Auth.username') ?></label>
                            <input type="text" class="form-control<?= isset(session('errors')['username']) ? ' is-invalid' : ''; ?>" aria-describedby="errorUsername" id="username" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                            <?php if (isset(session('errors')['username'])) : ?>
                                <div id="errorUsername" class="invalid-feedback">
                                    <?= session('errors')['username']; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password-input"><?= lang('Auth.password') ?></label>
                            <div class="position-relative auth-pass-inputgroup">
                                <input type="password" class="form-control pe-5 password-input<?= isset(session('errors')['password']) ? ' is-invalid' : ''; ?>" aria-describedby="errorPassword" onpaste="return false" id="password-input" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                <?php if (isset(session('errors')['password'])) : ?>
                                    <div id="errorPassword" class="invalid-feedback">
                                        <?= session('errors')['password']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password-confirm"><?= lang('Auth.passwordConfirm') ?></label>
                            <div class="position-relative auth-pass-inputgroup">
                                <input type="password" class="form-control pe-5 password-input<?= isset(session('errors')['password_confirm']) ? ' is-invalid' : ''; ?>" aria-describedby="errorPasswordConfirm" onpaste="return false" id="password-confirm" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon-2"><i class="ri-eye-fill align-middle"></i></button>
                                <?php if (isset(session('errors')['password_confirm'])) : ?>
                                    <div id="errorPasswordConfirm" class="invalid-feedback">
                                        <?= session('errors')['password_confirm']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label"><?= lang('Auth.first_name') ?></label>
                                    <input type="text" class="form-control<?= isset(session('errors')['first_name']) ? ' is-invalid' : ''; ?>" aria-describedby="errorFirstName" id="first_name" name="first_name" inputmode="text" autocomplete="first_name" placeholder="<?= lang('Auth.first_name') ?>" value="<?= old('first_name') ?>" required>
                                    <?php if (isset(session('errors')['first_name'])) : ?>
                                        <div id="errorFirstName" class="invalid-feedback">
                                            <?= session('errors')['first_name']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label"><?= lang('Auth.last_name') ?></label>
                                    <input type="text" class="form-control<?= isset(session('errors')['last_name']) ? ' is-invalid' : ''; ?>" aria-describedby="errorLastName" id="last_name" name="last_name" inputmode="text" autocomplete="last_name" placeholder="<?= lang('Auth.last_name') ?>" value="<?= old('last_name') ?>" required>
                                    <?php if (isset(session('errors')['last_name'])) : ?>
                                        <div id="errorLastName" class="invalid-feedback">
                                            <?= session('errors')['last_name']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?= lang('Auth.gender') ?></label>
                            <div>
                                <div class="form-check form-check-inline form-radio-success">
                                    <input class="form-check-input<?= isset(session('errors')['gender']) ? ' is-invalid' : ''; ?>" aria-describedby="errorGender" type="radio" name="gender" id="genderL" value="L" <?= old('gender') == 'L' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="genderL"><?= lang('Auth.genderMale'); ?></label>
                                </div>
                                <div class="form-check form-check-inline form-radio-success">
                                    <input class="form-check-input<?= isset(session('errors')['gender']) ? ' is-invalid' : ''; ?>" aria-describedby="errorGender" type="radio" name="gender" id="genderP" value="P" <?= old('gender') == 'P' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="genderP"><?= lang('Auth.genderFemale'); ?></label>
                                </div>
                                <?php if (isset(session('errors')['gender'])) : ?>
                                    <div id="errorGender" class="error-validation">
                                        <?= session('errors')['gender']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label"><?= lang('Auth.phone_number') ?></label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="number" class="form-control<?= isset(session('errors')['phone_number']) ? ' is-invalid' : ''; ?>" aria-describedby="errorPhoneNumber" id="phone_number" name="phone_number" inputmode="text" autocomplete="phone_number" placeholder="<?= lang('Auth.phone_number') ?>" value="<?= old('phone_number') ?>" required>
                                <?php if (isset(session('errors')['phone_number'])) : ?>
                                    <div id="errorPhoneNumber" class="invalid-feedback">
                                        <?= session('errors')['phone_number']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-success w-100" type="submit"><?= lang('Auth.register') ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

        <div class="mt-4 text-center">
            <p class="mb-0"><?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login'); ?>" class="fw-semibold text-primary text-decoration-underline"><?= lang('Auth.login') ?></a></p>
        </div>

    </div>
</div>
<?= $this->endSection() ?>
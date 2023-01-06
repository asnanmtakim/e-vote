<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('main') ?>
<div class="p-lg-5 p-4">
    <div>
        <h5 class="text-primary">Selamat Datang !</h5>
        <p class="text-muted"><?= lang('Auth.login') ?> <?= $appIdentity['app_name']; ?>.</p>
    </div>

    <?php if (session('error') !== null) : ?>
        <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
    <?php elseif (session('errors') !== null) : ?>
        <div class="alert alert-danger" role="alert">
            <?php if (is_array(session('errors'))) : ?>
                <?php foreach (session('errors') as $error) : ?>
                    <?= $error ?>
                    <br>
                <?php endforeach ?>
            <?php else : ?>
                <?= session('errors') ?>
            <?php endif ?>
        </div>
    <?php endif ?>

    <?php if (session('message') !== null) : ?>
        <div class="alert alert-success" role="alert"><?= session('message') ?></div>
    <?php endif ?>

    <div class="mt-4">
        <form action="<?= url_to('login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="username" class="form-label">Token</label>
                <div class="position-relative auth-pass-inputgroup mb-3">
                    <input type="password" class="form-control pe-5 password-input<?= isset(session('errors')['username']) ? ' is-invalid' : ''; ?>" aria-describedby="errorUsername" name="username" inputmode="username" autocomplete="username" id="username" placeholder="Token" value="<?= old('username') ?>">
                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                    <?php if (isset(session('errors')['username'])) : ?>
                        <div id="errorUsername" class="invalid-feedback">
                            <?= session('errors')['username']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mb-3 d-none">
                <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                    <div class="float-end">
                        <?= lang('Auth.forgotPassword') ?>
                        <a href="<?= url_to('magic-link') ?>" class="text-muted"><?= lang('Auth.useMagicLink') ?></a>
                    </div>
                <?php endif; ?>
                <label class="form-label" for="password-input"><?= lang('Auth.password') ?></label>
                <div class="position-relative auth-pass-inputgroup mb-3">
                    <input type="password" class="form-control pe-5 password-input<?= isset(session('errors')['password']) ? ' is-invalid' : ''; ?>" aria-describedby="errorPassword" id="password-input" name="password" inputmode="text" autocomplete="current-password" value="123456" placeholder="<?= lang('Auth.password') ?>">
                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                    <?php if (isset(session('errors')['password'])) : ?>
                        <div id="errorPassword" class="invalid-feedback">
                            <?= session('errors')['password']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="auth-remember-check" <?php if (old('remember')) : ?> checked<?php endif ?>>
                    <label class="form-check-label" for="auth-remember-check"><?= lang('Auth.rememberMe') ?></label>
                </div>
            <?php endif; ?>

            <div class="mt-5">
                <button class="btn btn-success w-100" type="submit"><?= lang('Auth.login') ?></button>
            </div>
        </form>
    </div>

    <?php if (setting('Auth.allowRegistration')) : ?>
        <div class="mt-4 text-center">
            <p class="mb-0"><?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>" class="fw-semibold text-primary text-decoration-underline"><?= lang('Auth.register'); ?></a></p>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
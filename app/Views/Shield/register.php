<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-card">
    <div class="auth-header">
        <a href="<?= base_url() ?>" class="auth-brand">
            <i class="fas fa-layer-group text-primary me-2"></i>
            <span>SLCMS</span>
            <span class="badge bg-primary text-white ms-2" style="font-size: 0.65rem;">v1.0</span>
        </a>
        <h4 class="fw-bold text-dark mb-1">Create Account</h4>
        <p class="text-muted small mb-0">Join the SLCMS developer and creator ecosystem</p>
    </div>

    <div class="auth-body">
        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger py-2 small rounded-3" role="alert">
                <i class="fas fa-exclamation-circle me-1"></i> <?= esc(session('error')) ?>
            </div>
        <?php elseif (session('errors') !== null) : ?>
            <div class="alert alert-danger py-2 small rounded-3" role="alert">
                <?php if (is_array(session('errors'))) : ?>
                    <?php foreach (session('errors') as $error) : ?>
                        <div><i class="fas fa-exclamation-circle me-1"></i> <?= esc($error) ?></div>
                    <?php endforeach ?>
                <?php else : ?>
                    <i class="fas fa-exclamation-circle me-1"></i> <?= esc(session('errors')) ?>
                <?php endif ?>
            </div>
        <?php endif ?>

        <form action="<?= url_to('register') ?>" method="post">
            <?= csrf_field() ?>

            <!-- Email -->
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                <label for="floatingEmailInput"><i class="fas fa-envelope text-muted me-1"></i> <?= lang('Auth.email') ?></label>
            </div>

            <!-- Username -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingUsernameInput" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                <label for="floatingUsernameInput"><i class="fas fa-user text-muted me-1"></i> <?= lang('Auth.username') ?></label>
            </div>

            <!-- Password -->
            <div class="position-relative mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control pe-5" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                    <label for="floatingPasswordInput"><i class="fas fa-lock text-muted me-1"></i> <?= lang('Auth.password') ?></label>
                </div>
                <button type="button" class="password-toggle-btn" onclick="togglePassword('floatingPasswordInput', this)" title="Show/Hide Password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <!-- Password Confirmation -->
            <div class="position-relative mb-4">
                <div class="form-floating">
                    <input type="password" class="form-control pe-5" id="floatingPasswordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                    <label for="floatingPasswordConfirmInput"><i class="fas fa-check-double text-muted me-1"></i> <?= lang('Auth.passwordConfirm') ?></label>
                </div>
                <button type="button" class="password-toggle-btn" onclick="togglePassword('floatingPasswordConfirmInput', this)" title="Show/Hide Password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-auth-primary">
                    <i class="fas fa-user-plus me-2"></i><?= lang('Auth.register') ?>
                </button>
            </div>

            <p class="text-center small text-muted mb-3">
                <?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>" class="fw-bold text-primary text-decoration-none"><?= lang('Auth.login') ?></a>
            </p>

            <div class="text-center pt-2 border-top">
                <a href="<?= base_url() ?>" class="text-muted small text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i> Back to Homepage
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

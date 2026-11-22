<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-card">
    <div class="auth-header">
        <a href="<?= base_url() ?>" class="auth-brand">
            <i class="fas fa-layer-group text-primary me-2"></i>
            <span>SLCMS</span>
            <span class="badge bg-primary text-white ms-2" style="font-size: 0.65rem;">v1.0</span>
        </a>
        <h4 class="fw-bold text-dark mb-1">Welcome Back</h4>
        <p class="text-muted small mb-0">Sign in to access your administrative workspace</p>
    </div>

    <div class="auth-body">
        <!-- Quick Demo Autofill Bar -->
        <div class="p-3 bg-light rounded-3 mb-4 border">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <small class="fw-bold text-secondary"><i class="fas fa-bolt text-warning me-1"></i>Quick Test Demo Accounts:</small>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="demo-pill-btn flex-fill" onclick="fillCredentials('admin@mail.com', '12345678')">
                    <i class="fas fa-user-shield text-danger me-1"></i> Admin
                </button>
                <button type="button" class="demo-pill-btn flex-fill" onclick="fillCredentials('editor@mail.com', '12345678')">
                    <i class="fas fa-user-edit text-warning me-1"></i> Editor
                </button>
            </div>
        </div>

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

        <?php if (session('message') !== null) : ?>
            <div class="alert alert-success py-2 small rounded-3" role="alert">
                <i class="fas fa-check-circle me-1"></i> <?= esc(session('message')) ?>
            </div>
        <?php endif ?>

        <form action="<?= url_to('login') ?>" method="post" id="loginForm">
            <?= csrf_field() ?>

            <!-- Email -->
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                <label for="floatingEmailInput"><i class="fas fa-envelope text-muted me-1"></i> <?= lang('Auth.email') ?></label>
            </div>

            <!-- Password with Toggle -->
            <div class="position-relative mb-3">
                <div class="form-floating">
                    <input type="password" class="form-control pe-5" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                    <label for="floatingPasswordInput"><i class="fas fa-lock text-muted me-1"></i> <?= lang('Auth.password') ?></label>
                </div>
                <button type="button" class="password-toggle-btn" onclick="togglePassword('floatingPasswordInput', this)" title="Show/Hide Password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <!-- Remember me & Magic link -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="rememberMeCheck" <?php if (old('remember')): ?> checked<?php endif ?>>
                        <label class="form-check-label small text-muted" for="rememberMeCheck">
                            <?= lang('Auth.rememberMe') ?>
                        </label>
                    </div>
                <?php endif; ?>

                <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                    <a href="<?= url_to('magic-link') ?>" class="small text-decoration-none text-primary fw-semibold">
                        <?= lang('Auth.useMagicLink') ?>
                    </a>
                <?php endif ?>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-auth-primary">
                    <i class="fas fa-sign-in-alt me-2"></i><?= lang('Auth.login') ?>
                </button>
            </div>

            <?php if (setting('Auth.allowRegistration')) : ?>
                <p class="text-center small text-muted mb-3">
                    <?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>" class="fw-bold text-primary text-decoration-none"><?= lang('Auth.register') ?></a>
                </p>
            <?php endif ?>

            <div class="text-center pt-2 border-top">
                <a href="<?= base_url() ?>" class="text-muted small text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i> Back to Homepage
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
    function fillCredentials(email, password) {
        document.getElementById('floatingEmailInput').value = email;
        document.getElementById('floatingPasswordInput').value = password;
    }
</script>
<?= $this->endSection() ?>

<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.email2FA') ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-card">
    <div class="auth-header">
        <a href="<?= base_url() ?>" class="auth-brand">
            <i class="fas fa-layer-group text-primary me-2"></i>
            <span>SLCMS</span>
            <span class="badge bg-primary text-white ms-2" style="font-size: 0.65rem;">v1.0</span>
        </a>
        <h4 class="fw-bold text-dark mb-1"><?= lang('Auth.email2FA') ?></h4>
        <p class="text-muted small mb-0"><?= lang('Auth.confirmEmailAddress') ?></p>
    </div>

    <div class="auth-body">
        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger py-2 small rounded-3" role="alert">
                <i class="fas fa-exclamation-circle me-1"></i> <?= esc(session('error')) ?>
            </div>
        <?php endif ?>

        <form action="<?= url_to('auth-action-verify') ?>" method="post">
            <?= csrf_field() ?>

            <!-- Token -->
            <div class="form-floating mb-4">
                <input type="text" class="form-control text-center font-mono fs-4" id="floatingTokenInput" name="token" placeholder="000000" inputmode="numeric" autocomplete="one-time-code" required>
                <label for="floatingTokenInput"><i class="fas fa-key text-muted me-1"></i> <?= lang('Auth.token') ?></label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-auth-primary">
                    <i class="fas fa-check-circle me-2"></i><?= lang('Auth.confirm') ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

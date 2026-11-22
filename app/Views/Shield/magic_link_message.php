<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.useMagicLink') ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-card text-center">
    <div class="auth-header">
        <div class="mb-3">
            <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 70px; height: 70px;">
                <i class="fas fa-envelope-open-text fa-2x"></i>
            </span>
        </div>
        <h4 class="fw-bold text-dark mb-1"><?= lang('Auth.checkYourEmail') ?></h4>
        <p class="text-muted small mb-0"><?= lang('Auth.magicLinkDetails', [setting('Auth.magicLinkLifetime') / 60]) ?></p>
    </div>

    <div class="auth-body">
        <div class="d-grid mb-3">
            <a href="<?= url_to('login') ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-1"></i> <?= lang('Auth.backToLogin') ?>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

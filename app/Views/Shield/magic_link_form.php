<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.useMagicLink') ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-card">
    <div class="auth-header">
        <a href="<?= base_url() ?>" class="auth-brand">
            <i class="fas fa-layer-group text-primary me-2"></i>
            <span>SLCMS</span>
            <span class="badge bg-primary text-white ms-2" style="font-size: 0.65rem;">v1.0</span>
        </a>
        <h4 class="fw-bold text-dark mb-1"><?= lang('Auth.useMagicLink') ?></h4>
        <p class="text-muted small mb-0">We will email you a secure one-click sign-in link</p>
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

        <form action="<?= url_to('magic-link') ?>" method="post">
            <?= csrf_field() ?>

            <!-- Email -->
            <div class="form-floating mb-4">
                <input type="email" class="form-control" id="floatingEmailInput" name="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email', auth()->user()->email ?? null) ?>" required>
                <label for="floatingEmailInput"><i class="fas fa-envelope text-muted me-1"></i> <?= lang('Auth.email') ?></label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-auth-primary">
                    <i class="fas fa-paper-plane me-2"></i><?= lang('Auth.send') ?>
                </button>
            </div>

            <div class="text-center pt-2 border-top">
                <a href="<?= url_to('login') ?>" class="text-muted small text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i> <?= lang('Auth.backToLogin') ?>
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

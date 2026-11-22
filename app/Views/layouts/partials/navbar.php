<nav class="navbar navbar-expand-lg theme-navbar sticky-top py-2">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold text-dark" href="<?= base_url() ?>">
            <i class="fas fa-layer-group text-primary me-2"></i>
            <span>SLCMS</span>
            <span class="badge bg-primary text-white ms-2" style="font-size: 0.7rem;">v1.0</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#themeNav">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="themeNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link px-3" href="<?= base_url() ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link px-3 text-primary fw-bold" href="<?= base_url('marketplace') ?>"><i class="fas fa-store me-1"></i>Marketplace</a></li>
                <li class="nav-item"><a class="nav-link px-3 text-success fw-bold" href="<?= base_url('docs') ?>"><i class="fas fa-book me-1"></i>Developer Docs</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="<?= base_url('starter') ?>"><i class="fas fa-cubes me-1"></i>UI Starter</a></li>
            </ul>

            <div class="d-flex align-items-center">
                <?php if (auth()->loggedIn()) : ?>
                    <a href="<?= base_url('admin') ?>" class="btn btn-sm btn-primary me-2">
                        <i class="fas fa-tachometer-alt me-1"></i> Admin Panel
                    </a>
                    <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-outline-danger" title="Sign Out">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                <?php else : ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-sm btn-outline-primary me-2">
                        <i class="fas fa-sign-in-alt me-1"></i> Sign In
                    </a>
                    <a href="<?= base_url('register') ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>
</nav>

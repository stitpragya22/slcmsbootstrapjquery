<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($author['name']) ?> - Developer Portfolio & Plugins | SLCMS Marketplace</title>
    <meta name="description" content="Explore official and community plugins built by <?= esc($author['name']) ?> for the SLCMS lightweight CodeIgniter 4 CMS platform.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #0f172a;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0f172a;
            background-color: #f8fafc;
        }

        .navbar {
            backdrop-filter: blur(14px);
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid var(--border);
        }

        .author-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            padding: 100px 0 60px;
        }

        .author-avatar-lg {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb 0%, #38bdf8 100%);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2.8rem;
            font-weight: 800;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .plugin-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 4px 15px -2px rgba(15, 23, 42, 0.05);
            transition: all 0.2s ease;
        }

        .plugin-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 28px -4px rgba(15, 23, 42, 0.12);
            border-color: #cbd5e1;
        }

        .plugin-icon-sm {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            background: #eff6ff;
            color: var(--primary);
        }
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center text-dark fw-bold" href="<?= base_url() ?>">
                <i class="fas fa-layer-group text-primary me-2"></i>
                <span>SLCMS</span>
                <span class="badge bg-primary-subtle text-primary ms-2" style="font-size: 0.68rem;">MARKETPLACE</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link px-3" href="<?= base_url() ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-3 active fw-bold text-primary" href="<?= base_url('marketplace') ?>">Plugins Directory</a></li>
                    <li class="nav-item"><a class="nav-link px-3 text-success fw-bold" href="<?= base_url('docs') ?>"><i class="fas fa-book me-1"></i>Developer Docs</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="<?= base_url('starter') ?>"><i class="fas fa-cubes me-1"></i>UI Starter</a></li>
                </ul>

                <div class="d-flex align-items-center">
                    <?php if (auth()->loggedIn()) : ?>
                        <a href="<?= base_url('admin/marketplace') ?>" class="btn btn-sm btn-primary me-2">
                            <i class="fas fa-cogs me-1"></i> Manage Plugins
                        </a>
                    <?php else : ?>
                        <a href="<?= base_url('login') ?>" class="btn btn-sm btn-outline-primary me-2">Sign In</a>
                    <?php endif ?>
                    <a href="https://github.com/stitpragya22/slcmsbootstrapjquery.git" target="_blank" class="btn btn-sm btn-outline-dark">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Author Profile Hero -->
    <header class="author-hero">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small text-white-50">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('marketplace') ?>" class="text-white-50 text-decoration-none">Marketplace</a></li>
                    <li class="breadcrumb-item"><span class="text-white-50">Developers</span></li>
                    <li class="breadcrumb-item active text-white" aria-current="page"><?= esc($author['name']) ?></li>
                </ol>
            </nav>

            <div class="row align-items-center gy-4">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-4">
                        <div class="author-avatar-lg flex-shrink-0">
                            <?= strtoupper(substr($author['name'], 0, 1)) ?>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill small">
                                    <i class="fas fa-check-circle me-1"></i><?= esc($author['badge']) ?>
                                </span>
                                <span class="badge bg-primary px-3 py-1 rounded-pill small">
                                    <?= count($plugins) ?> Published Plugin(s)
                                </span>
                            </div>
                            <h1 class="fw-bold mb-2"><?= esc($author['name']) ?></h1>
                            <p class="lead text-white-50 mb-3" style="font-size: 1.05rem;">
                                <?= esc($author['bio']) ?>
                            </p>
                            <?php if (!empty($author['url'])) : ?>
                                <a href="<?= esc($author['url']) ?>" target="_blank" class="btn btn-sm btn-outline-light rounded-pill px-3">
                                    <i class="fas fa-external-link-alt me-1"></i> Visit Website (<?= esc(parse_url($author['url'], PHP_URL_HOST)) ?>)
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <div class="bg-white bg-opacity-10 rounded-4 p-4 text-white text-center border border-white border-opacity-10">
                        <h2 class="fw-bold mb-0 text-white"><?= count($plugins) ?></h2>
                        <span class="small text-white-50 text-uppercase tracking-wider">Total Active Addons</span>
                        <div class="mt-3">
                            <a href="<?= base_url('docs') ?>#plugin-structure" class="btn btn-light btn-sm fw-bold w-100">
                                <i class="fas fa-plus me-1"></i>Build a Plugin Like <?= esc($author['name']) ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Plugin Portfolio Listing -->
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Extensions by <?= esc($author['name']) ?></h3>
                <p class="text-muted small mb-0">Browse and download verified plugins authored by this developer</p>
            </div>
            <a href="<?= base_url('marketplace') ?>" class="btn btn-outline-secondary btn-sm">
                &larr; Back to Full Catalog
            </a>
        </div>

        <?php if (!empty($plugins) && count($plugins) > 0) : ?>
            <div class="row g-4">
                <?php foreach ($plugins as $p) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card plugin-card h-100 p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="plugin-icon-sm">
                                    <i class="fas fa-<?= esc($p['icon']) ?>"></i>
                                </div>
                                <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small">
                                    <?= esc($p['category']) ?>
                                </span>
                            </div>

                            <h5 class="fw-bold text-dark mb-2">
                                <a href="<?= base_url('marketplace/plugin/' . esc($p['slug'])) ?>" class="text-dark text-decoration-none">
                                    <?= esc($p['name']) ?>
                                </a>
                            </h5>

                            <p class="text-muted small flex-grow-1 mb-4" style="line-height: 1.6;">
                                <?= esc($p['description']) ?>
                            </p>

                            <div class="pt-3 border-top d-flex justify-content-between align-items-center mt-auto">
                                <span class="text-warning small">
                                    <i class="fas fa-star"></i> <?= esc($p['rating'] ?? '4.9') ?>
                                </span>

                                <div class="d-flex gap-2">
                                    <a href="<?= base_url('marketplace/plugin/' . esc($p['slug'])) ?>" class="btn btn-outline-primary btn-sm fw-bold">
                                        Details & Docs
                                    </a>
                                    <a href="<?= base_url('marketplace/download/' . esc($p['slug'])) ?>" class="btn btn-primary btn-sm" title="Download ZIP">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php else : ?>
            <div class="card p-5 text-center border-0 shadow-sm rounded-4">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <h5 class="fw-bold">No plugins found for this author</h5>
                <p class="text-muted small">Check back soon or explore the full marketplace directory.</p>
                <div>
                    <a href="<?= base_url('marketplace') ?>" class="btn btn-primary btn-sm">Browse All Plugins</a>
                </div>
            </div>
        <?php endif ?>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white-50 py-5 mt-5">
        <div class="container text-center">
            <p class="mb-2"><strong>SLCMS Global Plugin Directory</strong> &bull; Free & Open Source</p>
            <div class="d-flex justify-content-center gap-3 small">
                <a href="<?= base_url() ?>" class="text-white-50 text-decoration-none">Home</a>
                <a href="<?= base_url('marketplace') ?>" class="text-white-50 text-decoration-none">Marketplace</a>
                <a href="<?= base_url('docs') ?>" class="text-white-50 text-decoration-none">Developer SDK</a>
                <a href="https://github.com/stitpragya22/slcmsbootstrapjquery.git" target="_blank" class="text-white-50 text-decoration-none">GitHub</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

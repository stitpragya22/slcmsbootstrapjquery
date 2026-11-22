<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($plugin['name']) ?> - SLCMS Marketplace</title>
    <meta name="description" content="<?= esc($plugin['description']) ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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

        code, pre, .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .navbar {
            backdrop-filter: blur(14px);
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid var(--border);
        }

        .plugin-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            padding: 100px 0 50px;
        }

        .plugin-icon-lg {
            width: 90px;
            height: 90px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #38bdf8;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .nav-tabs-custom .nav-link {
            color: #64748b;
            font-weight: 600;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 12px 20px;
            transition: all 0.2s;
        }

        .nav-tabs-custom .nav-link:hover {
            color: var(--primary);
        }

        .nav-tabs-custom .nav-link.active {
            color: var(--primary);
            border-bottom: 3px solid var(--primary);
            background: transparent;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 4px 15px -2px rgba(15, 23, 42, 0.05);
        }

        .meta-list dt {
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 2px;
        }

        .meta-list dd {
            color: #0f172a;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .copy-input-btn {
            cursor: pointer;
            transition: all 0.2s;
        }

        .copy-input-btn:hover {
            background-color: #e2e8f0;
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

    <!-- Plugin Hero Header -->
    <header class="plugin-hero">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small text-white-50">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('marketplace') ?>" class="text-white-50 text-decoration-none">Marketplace</a></li>
                    <li class="breadcrumb-item"><span class="text-info"><?= esc($plugin['category']) ?></span></li>
                    <li class="breadcrumb-item active text-white" aria-current="page"><?= esc($plugin['name']) ?></li>
                </ol>
            </nav>

            <div class="row align-items-center gy-4">
                <div class="col-lg-8">
                    <div class="d-flex align-items-start gap-4">
                        <div class="plugin-icon-lg flex-shrink-0">
                            <i class="fas fa-<?= esc($plugin['icon']) ?>"></i>
                        </div>
                        <div>
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                <span class="badge bg-primary px-3 py-1 rounded-pill">v<?= esc($plugin['version']) ?></span>
                                <span class="badge bg-light text-dark px-3 py-1 rounded-pill border"><?= esc($plugin['category']) ?></span>
                                <?php if (!empty($plugin['is_active'])) : ?>
                                    <span class="badge bg-success px-3 py-1 rounded-pill"><i class="fas fa-check-circle me-1"></i>Active on System</span>
                                <?php endif ?>
                            </div>
                            <h1 class="fw-bold mb-2"><?= esc($plugin['name']) ?></h1>
                            <p class="lead text-white-50 mb-3" style="font-size: 1.05rem;">
                                <?= esc($plugin['description']) ?>
                            </p>
                            <div class="d-flex flex-wrap align-items-center gap-3 small text-white-50">
                                <span>
                                    Developed by: 
                                    <a href="<?= base_url('marketplace/developer/' . esc($plugin['author_slug'])) ?>" class="text-info fw-bold text-decoration-none">
                                        <i class="fas fa-user-check me-1"></i><?= esc($plugin['author']) ?>
                                    </a>
                                </span>
                                <span>&bull;</span>
                                <span class="text-warning">
                                    <i class="fas fa-star"></i> <?= esc($plugin['rating'] ?? '4.9') ?> / 5.0
                                </span>
                                <span>&bull;</span>
                                <span><i class="fas fa-download me-1"></i><?= esc($plugin['downloads'] ?? '1,200+') ?> downloads</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <div class="d-flex flex-column gap-2">
                        <a href="<?= base_url('marketplace/download/' . esc($plugin['slug'])) ?>" class="btn btn-primary btn-lg fw-bold py-3 shadow">
                            <i class="fas fa-file-download me-2"></i>Download .ZIP Package
                        </a>
                        <?php if (!empty($plugin['is_active'])) : ?>
                            <a href="<?= base_url('addons/' . esc($plugin['slug'])) ?>" target="_blank" class="btn btn-outline-light py-2">
                                <i class="fas fa-external-link-alt me-2"></i>Open Live Addon UI
                            </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="container py-5">
        <div class="row g-4">

            <!-- Left: Documentation & Tabs -->
            <div class="col-lg-8">
                <div class="card card-custom p-4 mb-4">
                    <ul class="nav nav-tabs nav-tabs-custom mb-4" id="pluginDetailTabs">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-overview">
                                <i class="fas fa-info-circle me-1"></i> Overview & Features
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-installation">
                                <i class="fas fa-terminal me-1"></i> Installation Guide
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-hooks">
                                <i class="fas fa-plug me-1"></i> Hooks & API
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pluginDetailTabContent">
                        <!-- Overview Tab -->
                        <div class="tab-pane fade show active" id="tab-overview">
                            <h4 class="fw-bold mb-3">About <?= esc($plugin['name']) ?></h4>
                            <p class="text-secondary leading-relaxed mb-4">
                                <?= esc($plugin['description']) ?> Engineered specifically for the SLCMS lightweight ecosystem, this extension integrates cleanly into the core CodeIgniter 4 framework with zero file modifications.
                            </p>

                            <h5 class="fw-bold mb-3"><i class="fas fa-check-circle text-primary me-2"></i>Key Capabilities</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <h6 class="fw-bold mb-1"><i class="fas fa-bolt text-warning me-2"></i>Dynamic Dispatch</h6>
                                        <p class="small text-muted mb-0">Dispatches routes automatically under <code>/addons/<?= esc($plugin['slug']) ?></code> without editing <code>Routes.php</code>.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <h6 class="fw-bold mb-1"><i class="fas fa-shield-alt text-success me-2"></i>Security Hardened</h6>
                                        <p class="small text-muted mb-0">Protected against CSRF and automated SQL injection via Database Forge and Shield authentication.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <h6 class="fw-bold mb-1"><i class="fas fa-sync text-info me-2"></i>Lifecycle Callbacks</h6>
                                        <p class="small text-muted mb-0">Includes automated schema migration and teardown via <code>onActivate()</code> and <code>onUninstall()</code>.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <h6 class="fw-bold mb-1"><i class="fas fa-plug text-primary me-2"></i>Hook Extensibility</h6>
                                        <p class="small text-muted mb-0">Listens and dispatches WordPress-style action & filter hooks across SLCMS.</p>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($plugin['readme'])) : ?>
                                <h5 class="fw-bold mb-3"><i class="fas fa-book me-2"></i>Included README Documentation</h5>
                                <div class="bg-light p-3 rounded-3 border font-mono small" style="white-space: pre-wrap;">
                                    <?= esc($plugin['readme']) ?>
                                </div>
                            <?php endif ?>
                        </div>

                        <!-- Installation Tab -->
                        <div class="tab-pane fade" id="tab-installation">
                            <h4 class="fw-bold mb-3">Installation Instructions</h4>

                            <h6 class="fw-bold text-dark mt-4 mb-2">Option A: Install via Admin Panel (Recommended)</h6>
                            <ol class="text-secondary small">
                                <li class="mb-2">Log in to your SLCMS Administration Panel at <code>/admin</code>.</li>
                                <li class="mb-2">Navigate to <strong>Marketplace &rarr; Online Catalog</strong>.</li>
                                <li class="mb-2">Locate <strong><?= esc($plugin['name']) ?></strong> and click <strong>Install & Activate</strong>.</li>
                                <li class="mb-2">The system will automatically initialize the database tables and register the addon.</li>
                            </ol>

                            <h6 class="fw-bold text-dark mt-4 mb-2">Option B: Manual ZIP Upload or Extraction</h6>
                            <ol class="text-secondary small">
                                <li class="mb-2">Download the package ZIP using the button above.</li>
                                <li class="mb-2">Extract the folder contents into your server's <code>Plugins/<?= esc($plugin['slug']) ?>/</code> directory.</li>
                                <li class="mb-2">Go to <strong>Admin &rarr; Marketplace &rarr; Installed Plugins</strong> and click <strong>Activate</strong>.</li>
                            </ol>
                        </div>

                        <!-- Hooks & API Tab -->
                        <div class="tab-pane fade" id="tab-hooks">
                            <h4 class="fw-bold mb-3">Hook Events & Addon Routing</h4>
                            <p class="text-muted small">This plugin exposes or listens to the following events and routes:</p>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle small">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Type</th>
                                            <th>Identifier / URL</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="badge bg-primary">Route</span></td>
                                            <td><code>/addons/<?= esc($plugin['slug']) ?></code></td>
                                            <td>Primary addon dashboard & user interface</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-success">Action</span></td>
                                            <td><code>slcms.plugin.activated</code></td>
                                            <td>Triggered when this plugin is activated</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge bg-danger">Action</span></td>
                                            <td><code>slcms.plugin.deactivated</code></td>
                                            <td>Triggered when this plugin is paused</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Sidebar & Developer Details -->
            <div class="col-lg-4">
                <!-- Developer Card -->
                <div class="card card-custom p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            <?= strtoupper(substr($plugin['author'], 0, 1)) ?>
                        </div>
                        <div>
                            <span class="badge bg-success-subtle text-success small mb-1"><i class="fas fa-check-circle me-1"></i>Verified Developer</span>
                            <h5 class="fw-bold text-dark mb-0"><?= esc($plugin['author']) ?></h5>
                        </div>
                    </div>

                    <p class="small text-muted mb-3">
                        Certified author in the SLCMS developer ecosystem. Building high-quality, lightweight extensions for CodeIgniter 4.
                    </p>

                    <div class="d-grid gap-2">
                        <a href="<?= base_url('marketplace/developer/' . esc($plugin['author_slug'])) ?>" class="btn btn-outline-primary btn-sm fw-bold">
                            <i class="fas fa-layer-group me-1"></i>View All Plugins by Author
                        </a>
                        <?php if (!empty($plugin['author_url'])) : ?>
                            <a href="<?= esc($plugin['author_url']) ?>" target="_blank" class="btn btn-light btn-sm border text-muted">
                                <i class="fas fa-globe me-1"></i>Visit Developer Website
                            </a>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Metadata Card -->
                <div class="card card-custom p-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="fas fa-sliders-h text-primary me-2"></i>Plugin Specifications</h6>
                    <dl class="meta-list mb-0">
                        <dt>Current Version</dt>
                        <dd><span class="badge bg-secondary">v<?= esc($plugin['version']) ?></span></dd>

                        <dt>Category</dt>
                        <dd><?= esc($plugin['category']) ?></dd>

                        <dt>PHP Compatibility</dt>
                        <dd>PHP 8.1 / PHP 8.2+</dd>

                        <dt>Framework</dt>
                        <dd>CodeIgniter 4.5.0 + Shield</dd>

                        <dt>License</dt>
                        <dd>MIT Open Source</dd>

                        <dt>Last Verified</dt>
                        <dd class="text-success"><i class="fas fa-shield-alt me-1"></i>Tested & Live</dd>
                    </dl>
                </div>
            </div>

        </div>
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

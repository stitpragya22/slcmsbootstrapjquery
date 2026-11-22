<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plugin Directory - SLCMS Global Marketplace</title>
    <meta name="description" content="Discover, download, and install free plugins for SLCMS. Official and community plugins for SEO, Forms, E-Commerce, Security, and Media.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --secondary: #0f172a;
            --border: #e2e8f0;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0f172a;
            background-color: #f8fafc;
        }

        code, pre {
            font-family: 'JetBrains Mono', monospace;
        }

        .navbar {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid var(--border);
        }

        .hero-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            padding: 110px 0 60px;
        }

        .search-container {
            max-width: 650px;
            margin: 0 auto;
        }

        .search-input {
            border-radius: 999px;
            padding: 16px 28px;
            font-size: 1.1rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background: #ffffff;
            color: #0f172a;
            border-color: #2563eb;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
        }

        .search-input::placeholder {
            color: #94a3b8;
        }

        .plugin-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 26px;
            transition: all 0.25s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .plugin-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px -10px rgba(15, 23, 42, 0.1);
            border-color: #93c5fd;
        }

        .plugin-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            margin-right: 16px;
            flex-shrink: 0;
        }

        .filter-btn {
            border-radius: 999px;
            padding: 6px 18px;
            font-size: 0.88rem;
            font-weight: 600;
            border: 1px solid var(--border);
            background: #fff;
            color: #475569;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .filter-btn.active, .filter-btn:hover {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }

        footer {
            background-color: var(--secondary);
            color: #94a3b8;
            padding: 60px 0 30px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center text-dark fw-bold" href="<?= base_url() ?>">
                <i class="fas fa-layer-group text-primary me-2"></i>
                <span>SLCMS</span>
                <span class="badge bg-primary-subtle text-primary ms-2" style="font-size: 0.7rem;">MARKETPLACE</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <i class="fas fa-bars text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link px-3" href="<?= base_url() ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-3 active fw-bold text-primary" href="<?= base_url('marketplace') ?>">Plugins Directory</a></li>
                    <li class="nav-item"><a class="nav-link px-3 text-success fw-bold" href="<?= base_url('docs') ?>"><i class="fas fa-book me-1"></i>Developer Docs</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#developer-hub">Developer SDK</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#how-it-works">How It Works</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <?php if ($currentUser) { ?>
                        <a href="<?= base_url('admin/marketplace') ?>" class="btn btn-primary px-3 me-2">
                            <i class="fas fa-cogs me-1"></i> Admin Marketplace
                        </a>
                    <?php } else { ?>
                        <a href="<?= base_url('login') ?>" class="btn btn-outline-secondary px-3 me-2">Sign In</a>
                        <a href="<?= base_url('login') ?>" class="btn btn-primary px-4">Open Admin</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Header -->
    <header class="hero-banner text-center">
        <div class="container">
            <span class="badge bg-primary px-3 py-1 rounded-pill mb-3">GLOBAL PLUGIN DIRECTORY</span>
            <h1 class="display-5 fw-bold mb-3">Discover Free Plugins for SLCMS</h1>
            <p class="lead text-white-50 max-w-700 mx-auto mb-4">
                Explore official extensions and community contributions to supercharge your CMS with SEO, payment gateways, custom forms, audit logs, and media tools.
            </p>

            <!-- Search Bar -->
            <div class="search-container mb-3">
                <div class="position-relative">
                    <input type="text" id="pluginSearch" class="form-control search-input w-100 ps-5" placeholder="Search plugins by keyword (e.g. SEO, Stripe, Form, Audit)...">
                    <i class="fas fa-search position-absolute text-muted" style="left: 22px; top: 22px;"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Directory -->
    <main class="py-5">
        <div class="container">
            <!-- Filter Tags -->
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-5" id="categoryFilters">
                <button class="filter-btn active" data-category="all">All Plugins (<?= count($catalog) ?>)</button>
                <button class="filter-btn" data-category="SEO & Marketing">SEO & Marketing</button>
                <button class="filter-btn" data-category="Forms & Leads">Forms & Leads</button>
                <button class="filter-btn" data-category="Security & Auditing">Security & Auditing</button>
                <button class="filter-btn" data-category="Media & Storage">Media & Storage</button>
                <button class="filter-btn" data-category="E-Commerce & Payments">E-Commerce</button>
            </div>

            <!-- Plugin Cards Grid -->
            <div class="row g-4" id="pluginGrid">
                <?php foreach ($catalog as $item) { ?>
                    <div class="col-md-6 col-lg-4 plugin-item" data-category="<?= esc($item['category']) ?>" data-search="<?= strtolower(esc($item['name'] . ' ' . $item['description'] . ' ' . $item['category'] . ' ' . $item['author'])) ?>">
                        <div class="plugin-card shadow-sm">
                            <div class="d-flex align-items-center mb-3">
                                <div class="plugin-icon-box">
                                    <i class="fas fa-<?= esc($item['icon']) ?>"></i>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="fw-bold mb-0 text-dark text-truncate" title="<?= esc($item['name']) ?>"><?= esc($item['name']) ?></h5>
                                    <span class="badge bg-light text-secondary border small"><?= esc($item['category']) ?></span>
                                </div>
                            </div>

                            <p class="text-muted small flex-grow-1 mb-3"><?= esc($item['description']) ?></p>

                            <div class="d-flex justify-content-between align-items-center text-muted small py-2 border-top border-bottom mb-3">
                                <span><i class="fas fa-star text-warning me-1"></i><?= $item['rating'] ?></span>
                                <span><i class="fas fa-download me-1"></i><?= $item['downloads'] ?> downloads</span>
                                <span class="badge bg-success-subtle text-success">Free</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted text-truncate me-2">by <a href="<?= esc($item['author_url']) ?>" target="_blank" class="text-decoration-none fw-semibold"><?= esc($item['author']) ?></a></small>
                                <div class="d-flex gap-2">
                                    <a href="<?= base_url('marketplace/download/' . $item['slug']) ?>" class="btn btn-sm btn-outline-secondary" title="Download ZIP">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="<?= base_url('admin/marketplace/install/' . $item['slug']) ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus me-1"></i>Install
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Empty Search State -->
            <div id="noResults" class="text-center py-5 d-none">
                <i class="fas fa-search fa-3x text-muted mb-3 d-block"></i>
                <h5 class="fw-bold text-secondary">No plugins match your search</h5>
                <p class="text-muted small">Try searching with a different keyword or reset filters.</p>
            </div>
        </div>
    </main>

    <!-- How It Works Section -->
    <section class="py-5 bg-white border-top border-bottom" id="how-it-works">
        <div class="container py-4">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="badge bg-primary text-white fw-bold px-3 py-1 rounded-pill mb-2">WORKFLOW</span>
                <h2 class="fw-bold text-dark mb-3">How Plugins Work in SLCMS</h2>
                <p class="text-muted">Extending your CMS takes less than a minute with zero file editing.</p>
            </div>

            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="rounded-circle bg-primary-subtle text-primary mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; font-size: 1.5rem;">
                            <i class="fas fa-search"></i>
                        </div>
                        <h5 class="fw-bold mb-2">1. Find or Download</h5>
                        <p class="text-muted small">Browse the official directory or download third-party community plugin ZIP packages.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3">
                        <div class="rounded-circle bg-success-subtle text-success mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; font-size: 1.5rem;">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-2">2. One-Click Install</h5>
                        <p class="text-muted small">Install directly from the admin catalog with 1-click or upload your custom <code>.zip</code> archive.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3">
                        <div class="rounded-circle bg-warning-subtle text-warning mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; font-size: 1.5rem;">
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <h5 class="fw-bold mb-2">3. Activate & Hook In</h5>
                        <p class="text-muted small">Toggle active state anytime. Hooks and routes are automatically wired into your dashboard.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Developer Hub Section -->
    <section class="py-5 bg-light" id="developer-hub">
        <div class="container py-4">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <span class="badge bg-info text-dark fw-bold px-3 py-1 rounded-pill mb-2">FOR DEVELOPERS</span>
                    <h2 class="fw-bold text-dark mb-3">Build & Publish Your Own Plugin</h2>
                    <p class="text-muted mb-4">
                        SLCMS is built from the ground up to empower the global developer community. Create plugins with standardized manifests and event hooks to extend anything from menus to CRUD life-cycles.
                    </p>

                    <div class="d-flex mb-3">
                        <div class="me-3 text-primary"><i class="fas fa-check-circle fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Standardized <code>plugin.json</code> Manifest</h6>
                            <p class="text-muted small">Define name, version, author, icon, and sidebar navigation in one clean JSON file.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="me-3 text-primary"><i class="fas fa-check-circle fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Action & Filter Hook Architecture</h6>
                            <p class="text-muted small">Hook into <code>slcms.crud.after_save</code>, <code>slcms.menu</code>, and <code>slcms.plugin.*</code> without touching core code.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="me-3 text-primary"><i class="fas fa-check-circle fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Standard Lifecycle Methods</h6>
                            <p class="text-muted small">Implement <code>onActivate()</code>, <code>onDeactivate()</code>, and <code>onUninstall()</code> for automatic table migrations and clean tear-downs.</p>
                        </div>
                    </div>

                    <a href="https://github.com/stitpragya22/slcmsbootstrapjquery.git" target="_blank" class="btn btn-dark px-4">
                        <i class="fab fa-github me-2"></i>View Plugin SDK on GitHub
                    </a>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-dark text-white">
                        <div class="card-header bg-black py-3 px-4 d-flex justify-content-between align-items-center">
                            <span class="small font-monospace text-light"><i class="fas fa-file-code me-2 text-warning"></i>plugins/my-plugin/plugin.json</span>
                            <span class="badge bg-primary">v1.0 Standard</span>
                        </div>
                        <div class="card-body p-4 font-monospace small">
<pre class="text-light mb-0"><code>{
  <span class="text-warning">"slug"</span>: <span class="text-info">"my-plugin"</span>,
  <span class="text-warning">"name"</span>: <span class="text-info">"My Awesome Plugin"</span>,
  <span class="text-warning">"version"</span>: <span class="text-info">"1.0.0"</span>,
  <span class="text-warning">"description"</span>: <span class="text-info">"Adds custom functionality to SLCMS."</span>,
  <span class="text-warning">"author"</span>: <span class="text-info">"Your Name"</span>,
  <span class="text-warning">"author_url"</span>: <span class="text-info">"https://yourwebsite.com"</span>,
  <span class="text-warning">"icon"</span>: <span class="text-info">"rocket"</span>,
  <span class="text-warning">"category"</span>: <span class="text-info">"Utilities"</span>,
  <span class="text-warning">"menu"</span>: {
    <span class="text-warning">"label"</span>: <span class="text-info">"My Plugin"</span>,
    <span class="text-warning">"icon"</span>: <span class="text-info">"rocket"</span>,
    <span class="text-warning">"route"</span>: <span class="text-info">"addons/my-plugin"</span>
  }
}</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <h5 class="text-white fw-bold mb-1"><i class="fas fa-layer-group text-primary me-2"></i>SLCMS Plugin Marketplace</h5>
                    <p class="small text-muted mb-0">Built on CodeIgniter 4, Shield, Bootstrap 5 & jQuery.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="small text-muted mb-0">
                        &copy; <?= date('Y') ?> <strong>SLCMS</strong> by <a href="https://stitpragya.in" class="text-decoration-none text-info" target="_blank">Stitpragya</a>.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery 3.6 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            var currentCategory = 'all';

            // Category filter
            $('.filter-btn').on('click', function() {
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');
                currentCategory = $(this).data('category');
                filterPlugins();
            });

            // Live Search
            $('#pluginSearch').on('keyup', function() {
                filterPlugins();
            });

            function filterPlugins() {
                var query = $('#pluginSearch').val().toLowerCase().trim();
                var visibleCount = 0;

                $('.plugin-item').each(function() {
                    var itemCat = $(this).data('category');
                    var itemSearch = $(this).data('search');

                    var matchesCat = (currentCategory === 'all' || itemCat === currentCategory);
                    var matchesQuery = (query === '' || itemSearch.indexOf(query) !== -1);

                    if (matchesCat && matchesQuery) {
                        $(this).removeClass('d-none');
                        visibleCount++;
                    } else {
                        $(this).addClass('d-none');
                    }
                });

                if (visibleCount === 0) {
                    $('#noResults').removeClass('d-none');
                } else {
                    $('#noResults').addClass('d-none');
                }
            }
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLCMS v1 - Modern Lightweight CodeIgniter 4 CMS (Bootstrap & jQuery)</title>
    <meta name="description" content="SLCMS v1 - Enterprise-grade lightweight CMS built on CodeIgniter 4, CodeIgniter Shield, Bootstrap 5, and jQuery. Zero file-mutation CRUD generator, modular plugin architecture, and dynamic routing.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #0f172a;
            --accent: #38bdf8;
            --surface: #ffffff;
            --surface-subtle: #f8fafc;
            --border: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            background-color: #ffffff;
            overflow-x: hidden;
        }

        code, pre {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Navbar */
        .navbar {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.92);
            border-bottom: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.35rem;
            letter-spacing: -0.5px;
            color: var(--secondary) !important;
        }

        .brand-badge {
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 999px;
            font-weight: 700;
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
            border: 1px solid rgba(37, 99, 235, 0.2);
            vertical-align: middle;
            margin-left: 6px;
        }

        /* Hero */
        .hero-section {
            padding: 130px 0 90px;
            background: radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.05) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(56, 189, 248, 0.06) 0%, transparent 40%);
            position: relative;
        }

        .hero-title {
            font-size: 3.25rem;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1.5px;
            color: var(--secondary);
        }

        .hero-gradient-text {
            background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-lead {
            font-size: 1.25rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Card Styles */
        .feature-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 32px 28px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
            position: relative;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -10px rgba(15, 23, 42, 0.08);
            border-color: rgba(37, 99, 235, 0.3);
        }

        .icon-box {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 22px;
        }

        .icon-box.blue { background: #eff6ff; color: #2563eb; }
        .icon-box.green { background: #f0fdf4; color: #16a34a; }
        .icon-box.purple { background: #faf5ff; color: #9333ea; }
        .icon-box.amber { background: #fffbeb; color: #d97706; }
        .icon-box.cyan { background: #ecfeff; color: #0891b2; }
        .icon-box.rose { background: #fff1f2; color: #e11d48; }

        /* Demo Card */
        .credentials-card {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 40px -15px rgba(15, 23, 42, 0.25);
        }

        .credential-box {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 12px;
        }

        .copy-btn {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            transition: all 0.2s ease;
        }

        .copy-btn:hover {
            background: #2563eb;
            color: #fff;
        }

        /* Pill tags */
        .tech-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
            background: #f1f5f9;
            color: #475569;
            margin-right: 8px;
            margin-bottom: 8px;
            border: 1px solid #e2e8f0;
        }

        .tech-pill i {
            margin-right: 6px;
        }

        /* Comparison Table */
        .comparison-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .comparison-table th {
            background: #f8fafc;
            padding: 16px 20px;
            font-weight: 700;
            border-bottom: 1px solid var(--border);
        }

        .comparison-table td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .comparison-table tr:last-child td {
            border-bottom: none;
        }

        /* Footer */
        footer {
            background-color: var(--secondary);
            color: #94a3b8;
            padding: 60px 0 30px;
        }

        /* Back to top */
        .back-to-top {
            position: fixed;
            display: none;
            right: 25px;
            bottom: 25px;
            z-index: 999;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
                <i class="fas fa-layer-group text-primary me-2"></i>
                <span>SLCMS</span>
                <span class="brand-badge">v1.0</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link px-3" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#generator">CRUD Generator</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#security">Shield Auth</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#plugins">Marketplace</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#architecture">Architecture</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#demo">Live Demo</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <?php if ($currentUser) { ?>
                        <a href="<?= base_url('admin') ?>" class="btn btn-primary px-4 me-2">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard (<?= esc($currentUser->username ?? 'Admin') ?>)
                        </a>
                        <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    <?php } else { ?>
                        <a href="<?= base_url('login') ?>" class="btn btn-outline-secondary px-3 me-2">
                            <i class="fas fa-sign-in-alt me-1"></i> Sign In
                        </a>
                        <a href="#demo" class="btn btn-primary px-4">
                            <i class="fas fa-bolt me-1"></i> Test Live
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-7">
                    <div class="d-inline-flex align-items-center bg-white border rounded-pill px-3 py-1 mb-3 shadow-sm">
                        <span class="badge bg-primary rounded-pill me-2">New Release</span>
                        <small class="text-secondary fw-semibold">SLCMS v1 Modernized & Live on Production</small>
                    </div>

                    <h1 class="hero-title mb-3">
                        Lightweight CodeIgniter 4 CMS Powered by <br>
                        <span class="hero-gradient-text" id="typed-headline">Bootstrap & jQuery</span>
                    </h1>

                    <p class="hero-lead mb-4">
                        A robust, developer-first Content Management System engineered for speed, extensibility, and simplicity. Features a zero file-mutation dynamic CRUD generator, enterprise CodeIgniter Shield multi-role RBAC, and modular plugin dispatch.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="<?= base_url('login') ?>" class="btn btn-primary btn-lg px-4 shadow-sm">
                            <i class="fas fa-play-circle me-2"></i>Launch Admin Panel
                        </a>
                        <a href="#demo" class="btn btn-outline-dark btn-lg px-4">
                            <i class="fas fa-key me-2"></i>Get Demo Credentials
                        </a>
                        <a href="https://github.com/stitpragya22/slcmsbootstrapjquery.git" target="_blank" class="btn btn-light border btn-lg px-3">
                            <i class="fab fa-github fa-lg"></i>
                        </a>
                    </div>

                    <!-- Tech Badges -->
                    <div class="d-flex flex-wrap align-items-center pt-2">
                        <span class="text-muted small fw-bold me-2">BUILT WITH:</span>
                        <span class="tech-pill"><i class="fab fa-php text-primary"></i>PHP 8.2</span>
                        <span class="tech-pill"><i class="fas fa-fire text-danger"></i>CI 4.5.0</span>
                        <span class="tech-pill"><i class="fas fa-shield-alt text-success"></i>CI Shield</span>
                        <span class="tech-pill"><i class="fab fa-bootstrap text-purple" style="color: #7952b3;"></i>Bootstrap 5</span>
                        <span class="tech-pill"><i class="fab fa-js-square text-warning"></i>jQuery 3.6</span>
                        <span class="tech-pill"><i class="fas fa-database text-info"></i>MySQL 8</span>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="credentials-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="mb-1 text-white fw-bold"><i class="fas fa-rocket text-primary me-2"></i>Instant Live Demo</h4>
                                <small class="text-white-50">Deployed live on <code>slcms.stitpragya.in</code></small>
                            </div>
                            <span class="badge bg-success px-3 py-2">LIVE READY</span>
                        </div>

                        <div class="credential-box">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-info"><i class="fas fa-user-shield me-1"></i>Administrator Account</span>
                                <button class="copy-btn" onclick="copyCred('admin@mail.com', '12345678')"><i class="far fa-copy me-1"></i>Copy Both</button>
                            </div>
                            <div class="small text-white-50">Email: <strong class="text-white font-monospace">admin@mail.com</strong></div>
                            <div class="small text-white-50">Password: <strong class="text-white font-monospace">12345678</strong></div>
                            <small class="badge bg-primary mt-2">Full Access: CRUD Generator, Modules, Plugins</small>
                        </div>

                        <div class="credential-box">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-warning"><i class="fas fa-user-edit me-1"></i>Editor Account</span>
                                <button class="copy-btn" onclick="copyCred('editor@mail.com', '12345678')"><i class="far fa-copy me-1"></i>Copy Both</button>
                            </div>
                            <div class="small text-white-50">Email: <strong class="text-white font-monospace">editor@mail.com</strong></div>
                            <div class="small text-white-50">Password: <strong class="text-white font-monospace">12345678</strong></div>
                            <small class="badge bg-secondary mt-2">Role: Content & Section Management</small>
                        </div>

                        <div class="d-grid mt-4">
                            <a href="<?= base_url('login') ?>" class="btn btn-primary btn-lg fw-bold">
                                <i class="fas fa-external-link-alt me-2"></i>Login to Admin Portal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Key Features Section -->
    <section class="py-5" id="features">
        <div class="container py-4">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-1 rounded-pill mb-2">FEATURES</span>
                <h2 class="fw-bold text-dark mb-3">Engineered for Rapid CMS Development</h2>
                <p class="text-muted">SLCMS v1 combines the simplicity of Bootstrap & jQuery with the robustness of CodeIgniter 4 and enterprise authentication.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="icon-box blue">
                            <i class="fas fa-magic"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Zero-Mutation CRUD Generator</h5>
                        <p class="text-muted small mb-0">Generate fully functional CRUD modules in seconds without editing or mutating <code>Routes.php</code> or sidebar layout files. Modules register cleanly in database tables.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="icon-box green">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-2">CodeIgniter Shield Auth & RBAC</h5>
                        <p class="text-muted small mb-0">Powered by official <code>codeigniter4/shield</code> with secure passwords, group matrix (Superadmin, Admin, Editor), route filters, and CSRF token verification.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="icon-box purple">
                            <i class="fas fa-plug"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Modular Plugin Architecture</h5>
                        <p class="text-muted small mb-0">Pluggable addon engine supporting dynamic installation and activation. Ready with built-in plugins such as HelloWorldPlugin and TaskManagerPlugin.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="icon-box amber">
                            <i class="fas fa-database"></i>
                        </div>
                        <h5 class="fw-bold mb-2">CI4 Database Forge Integration</h5>
                        <p class="text-muted small mb-0">Tables and columns are generated through CodeIgniter's Database Forge abstraction, guaranteeing SQL injection safety and cross-database compatibility.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="icon-box cyan">
                            <i class="fas fa-table"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Bootstrap 5 + jQuery UI</h5>
                        <p class="text-muted small mb-0">Clean responsive administration dashboard featuring DataTables with export buttons, FontAwesome icons, Select2 dropdowns, and Summernote rich editor.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="icon-box rose">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Centralized File Service</h5>
                        <p class="text-muted small mb-0">Unified image and document upload handling via <code>BaseAdminController</code>, featuring random hash naming, MIME type restrictions, and size guards.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CRUD Generator Deep Dive -->
    <section class="py-5 bg-light" id="generator">
        <div class="container py-4">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <span class="badge bg-primary text-white fw-bold px-3 py-1 rounded-pill mb-2">CRUD ENGINE</span>
                    <h2 class="fw-bold text-dark mb-3">Build Full CRUD Modules in 30 Seconds</h2>
                    <p class="text-muted mb-4">
                        Unlike traditional CMS engines that require manual scaffolding or corrupt route files with fragile string substitutions, SLCMS v1 uses a clean database registry and dynamic route mapping.
                    </p>

                    <div class="d-flex mb-3">
                        <div class="me-3 text-primary"><i class="fas fa-check-circle fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Define Schema in Web UI</h6>
                            <p class="text-muted small">Choose column names, SQL types (VARCHAR, TEXT, INT, DECIMAL, DATE), HTML field types, and validation constraints.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="me-3 text-primary"><i class="fas fa-check-circle fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Auto-Generated Controller, Model & View</h6>
                            <p class="text-muted small">Automatically writes clean MVC files extending <code>BaseAdminController</code> with built-in CSRF security and file upload handling.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="me-3 text-primary"><i class="fas fa-check-circle fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Instant Sidebar & Route Registration</h6>
                            <p class="text-muted small">Registered modules are dynamically loaded into the admin sidebar menu and mapped to <code>/admin/{module}</code> routes without touching configuration files.</p>
                        </div>
                    </div>

                    <a href="<?= base_url('admin/generator') ?>" class="btn btn-primary px-4">
                        <i class="fas fa-magic me-2"></i>Try CRUD Generator
                    </a>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-header bg-dark text-white py-3 px-4 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-danger rounded-circle me-1" style="width: 10px; height: 10px; padding: 0;"></span>
                                <span class="badge bg-warning rounded-circle me-1" style="width: 10px; height: 10px; padding: 0;"></span>
                                <span class="badge bg-success rounded-circle me-3" style="width: 10px; height: 10px; padding: 0;"></span>
                                <small class="font-monospace text-light">app/Config/Routes.php (Dynamic Registry)</small>
                            </div>
                            <span class="badge bg-primary">v1.0 Zero-Mutation</span>
                        </div>
                        <div class="card-body bg-dark text-light p-4 font-monospace small">
<pre class="text-success mb-0"><code><span class="text-secondary">// Dynamic CMS Module Routes (Zero File Mutation)</span>
<span class="text-info">$db</span> = \Config\Database::<span class="text-warning">connect</span>();
<span class="text-primary">if</span> (<span class="text-info">$db</span>-&gt;<span class="text-warning">tableExists</span>(<span class="text-warning">'cms_modules'</span>)) {
    <span class="text-info">$modules</span> = <span class="text-info">$db</span>-&gt;<span class="text-warning">table</span>(<span class="text-warning">'cms_modules'</span>)
        -&gt;<span class="text-warning">where</span>(<span class="text-warning">'is_active'</span>, 1)-&gt;<span class="text-warning">get</span>()-&gt;<span class="text-warning">getResultArray</span>();

    <span class="text-primary">foreach</span> (<span class="text-info">$modules</span> <span class="text-primary">as</span> <span class="text-info">$mod</span>) {
        <span class="text-info">$slug</span> = <span class="text-info">$mod</span>[<span class="text-warning">'slug'</span>];
        <span class="text-info">$ctrl</span> = <span class="text-info">$mod</span>[<span class="text-warning">'controller'</span>];

        <span class="text-secondary">// Instant dynamic route resolution</span>
        <span class="text-info">$routes</span>-&gt;<span class="text-warning">get</span>(<span class="text-info">$slug</span>, <span class="text-warning">"{\$ctrl}::index"</span>);
        <span class="text-info">$routes</span>-&gt;<span class="text-warning">get</span>(<span class="text-warning">"{\$slug}/(:num)"</span>, <span class="text-warning">"{\$ctrl}::index/\$1"</span>);
        <span class="text-info">$routes</span>-&gt;<span class="text-warning">post</span>(<span class="text-warning">"{\$slug}/store"</span>, <span class="text-warning">"{\$ctrl}::Store"</span>);
        <span class="text-info">$routes</span>-&gt;<span class="text-warning">get</span>(<span class="text-warning">"{\$slug}/delete/(:num)"</span>, <span class="text-warning">"{\$ctrl}::delete/\$1"</span>);
    }
}</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Architecture Comparison -->
    <section class="py-5" id="architecture">
        <div class="container py-4">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="badge bg-info text-dark fw-bold px-3 py-1 rounded-pill mb-2">COMPARISON</span>
                <h2 class="fw-bold text-dark mb-3">Architectural Modernization</h2>
                <p class="text-muted">How SLCMS v1 evolved from brittle file edits to clean modern engineering.</p>
            </div>

            <div class="table-responsive">
                <table class="comparison-table shadow-sm">
                    <thead>
                        <tr>
                            <th style="width: 28%;">Feature</th>
                            <th style="width: 36%;" class="text-danger"><i class="fas fa-times-circle me-1"></i>Legacy Implementation</th>
                            <th style="width: 36%;" class="text-success"><i class="fas fa-check-circle me-1"></i>SLCMS v1 Modernized</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Routing & Scaffolding</td>
                            <td class="text-muted"><code>str_replace()</code> directly mutated <code>Routes.php</code></td>
                            <td class="text-dark fw-semibold"><span class="badge bg-success me-1">Zero-Mutation</span> Database-driven dynamic dispatch</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Sidebar Navigation</td>
                            <td class="text-muted">Hardcoded array mutation in <code>admindash.php</code></td>
                            <td class="text-dark fw-semibold">Dynamic discovery via <code>cms_modules</code> registry table</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Authentication & RBAC</td>
                            <td class="text-muted">Unencrypted plain passwords, manual session checks</td>
                            <td class="text-dark fw-semibold"><span class="badge bg-primary me-1">CI Shield</span> Password hashing, groups, and filters</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Database Management</td>
                            <td class="text-muted">Raw string-concatenated SQL queries</td>
                            <td class="text-dark fw-semibold">CodeIgniter 4 Database Forge (SQL-injection immune)</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">File Uploads</td>
                            <td class="text-muted">Custom PHP <code>$_FILES</code> upload helper</td>
                            <td class="text-dark fw-semibold">Unified <code>BaseAdminController</code> CI4 file service</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Module Lifecycle</td>
                            <td class="text-muted">No automated uninstall or drop capabilities</td>
                            <td class="text-dark fw-semibold">1-Click Module Delete (drops table, views, controller, model)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Dynamic Modules Live Status -->
    <section class="py-5 bg-light" id="plugins">
        <div class="container py-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div>
                    <span class="badge bg-primary text-white fw-bold px-3 py-1 rounded-pill mb-2">LIVE DATABASE</span>
                    <h3 class="fw-bold text-dark mb-1">Active CMS Modules & Plugins</h3>
                    <p class="text-muted small mb-0">Dynamic modules currently registered on the production database</p>
                </div>
                <div>
                    <a href="<?= base_url('admin/marketplace') ?>" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-store me-1"></i>Plugin Marketplace
                    </a>
                    <a href="<?= base_url('admin/generator/modules') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-cubes me-1"></i>Manage Modules
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <?php if (!empty($modules) && count($modules) > 0) { ?>
                    <?php foreach ($modules as $mod) { ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card p-3 border rounded-3 bg-white shadow-sm h-100">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box blue me-3 mb-0" style="width: 44px; height: 44px; font-size: 1.1rem;">
                                        <i class="fas fa-<?= esc($mod['icon'] ?: 'folder') ?>"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold"><?= esc($mod['name']) ?></h6>
                                        <small class="text-muted">Route: <code>/admin/<?= esc($mod['slug']) ?></code></small>
                                    </div>
                                    <a href="<?= base_url('admin/' . $mod['slug']) ?>" class="btn btn-sm btn-outline-primary">Open</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-12">
                        <div class="card p-4 text-center border-dashed rounded-3 bg-white">
                            <i class="fas fa-box-open fa-2x text-muted mb-2"></i>
                            <h6 class="fw-bold mb-1">No custom CRUD modules created yet</h6>
                            <p class="text-muted small mb-3">Log into the admin dashboard to generate your first custom module instantly!</p>
                            <div>
                                <a href="<?= base_url('admin/generator') ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus me-1"></i>Create Module Now
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Test Credentials & CTA -->
    <section class="py-5" id="demo">
        <div class="container py-4">
            <div class="card border-0 rounded-4 p-5 text-center text-white" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                <div class="max-w-700 mx-auto">
                    <span class="badge bg-primary text-white fw-bold px-3 py-1 rounded-pill mb-3">READY TO TEST</span>
                    <h2 class="fw-bold mb-3">Experience SLCMS v1 Live on StackCP</h2>
                    <p class="text-white-50 mb-4">
                        Everything is deployed and connected to the high-performance MySQL database on <code>sdb-60.hosting.stackcp.net</code>. Login to experience the speed of CodeIgniter 4 and Bootstrap 5.
                    </p>

                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="<?= base_url('login') ?>" class="btn btn-primary btn-lg px-5 fw-bold shadow">
                            <i class="fas fa-sign-in-alt me-2"></i>Admin Login Portal
                        </a>
                        <a href="https://github.com/stitpragya22/slcmsbootstrapjquery.git" target="_blank" class="btn btn-outline-light btn-lg px-4">
                            <i class="fab fa-github me-2"></i>View GitHub Repository
                        </a>
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
                    <h5 class="text-white fw-bold mb-1"><i class="fas fa-layer-group text-primary me-2"></i>SLCMS v1</h5>
                    <p class="small text-muted mb-0">Engineered with CodeIgniter 4, Shield, Bootstrap 5 & jQuery.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="small text-muted mb-0">
                        &copy; <?= date('Y') ?> <strong>SLCMS</strong> by <a href="https://stitpragya.in" class="text-decoration-none text-info" target="_blank">Stitpragya</a>. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fas fa-chevron-up"></i></a>

    <!-- jQuery 3.6 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Typed.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>

    <script>
        $(document).ready(function() {
            // Typed headline effect
            if ($('#typed-headline').length) {
                new Typed('#typed-headline', {
                    strings: ['Bootstrap & jQuery', 'Zero-Mutation CRUD', 'CodeIgniter 4 & Shield', 'Modular Plugins'],
                    typeSpeed: 60,
                    backSpeed: 30,
                    backDelay: 2000,
                    loop: true
                });
            }

            // Smooth scrolling
            $('a[href^="#"]').on('click', function(e) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    e.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 80
                    }, 800);
                }
            });

            // Back to top button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('.back-to-top').fadeIn('slow');
                } else {
                    $('.back-to-top').fadeOut('slow');
                }
            });

            $('.back-to-top').click(function(e) {
                e.preventDefault();
                $('html, body').animate({scrollTop: 0}, 600);
            });
        });

        // 1-Click Credential Copy helper
        function copyCred(email, pass) {
            var text = "Email: " + email + "\nPassword: " + pass;
            navigator.clipboard.writeText(text).then(function() {
                alert("Copied credentials to clipboard:\n" + text);
            });
        }
    </script>
</body>
</html>

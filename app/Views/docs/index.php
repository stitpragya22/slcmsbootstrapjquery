<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Documentation & Plugin SDK - SLCMS v1</title>
    <meta name="description" content="Official Developer Documentation and Plugin Development SDK for SLCMS v1. Learn how to install, build custom plugins, listen to event hooks, and extend SLCMS with minimal effort.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Prism.js Syntax Highlighting (Tomorrow Night theme) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #0f172a;
            --sidebar-bg: #f8fafc;
            --border-color: #e2e8f0;
            --code-bg: #0f172a;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            background-color: #ffffff;
            scroll-behavior: smooth;
        }

        code, pre {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Top Navbar */
        .docs-navbar {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid var(--border-color);
            z-index: 1040;
        }

        /* Sidebar */
        .docs-sidebar {
            position: sticky;
            top: 72px;
            height: calc(100vh - 72px);
            overflow-y: auto;
            border-right: 1px solid var(--border-color);
            padding: 24px 16px 40px;
            background-color: var(--sidebar-bg);
        }

        .docs-sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .docs-sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .sidebar-section-title {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            margin-top: 20px;
            margin-bottom: 8px;
            padding-left: 12px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 0.88rem;
            color: #475569;
            text-decoration: none;
            transition: all 0.15s ease;
            font-weight: 500;
            margin-bottom: 2px;
        }

        .sidebar-link i {
            width: 20px;
            font-size: 0.85rem;
            margin-right: 8px;
            color: #94a3b8;
        }

        .sidebar-link:hover {
            color: var(--primary);
            background-color: #eff6ff;
        }

        .sidebar-link:hover i {
            color: var(--primary);
        }

        .sidebar-link.active {
            color: var(--primary);
            background-color: #dbeafe;
            font-weight: 700;
        }

        .sidebar-link.active i {
            color: var(--primary);
        }

        /* Content Area */
        .docs-content {
            padding: 40px 32px 100px;
            max-width: 950px;
        }

        .docs-section {
            padding-top: 20px;
            margin-bottom: 60px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 40px;
        }

        .docs-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--secondary);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .section-subtitle {
            font-size: 1.05rem;
            color: var(--text-muted);
            margin-bottom: 28px;
            line-height: 1.6;
        }

        h3.subheading {
            font-size: 1.35rem;
            font-weight: 700;
            color: #1e293b;
            margin-top: 36px;
            margin-bottom: 14px;
        }

        h4.subheading-sm {
            font-size: 1.05rem;
            font-weight: 700;
            color: #334155;
            margin-top: 24px;
            margin-bottom: 10px;
        }

        /* Code Blocks */
        .code-card {
            position: relative;
            background-color: var(--code-bg);
            border-radius: 12px;
            margin: 18px 0 24px;
            overflow: hidden;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .code-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.04);
            padding: 8px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            font-size: 0.78rem;
            color: #94a3b8;
        }

        .code-card-header .file-name {
            font-family: 'JetBrains Mono', monospace;
            display: flex;
            align-items: center;
        }

        .code-card-header .file-name i {
            margin-right: 6px;
        }

        .copy-btn {
            background: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
            border: none;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
        }

        .copy-btn:hover {
            background: var(--primary);
            color: #ffffff;
        }

        .copy-btn i {
            margin-right: 4px;
        }

        pre[class*="language-"] {
            margin: 0 !important;
            padding: 16px !important;
            font-size: 0.88rem !important;
            border-radius: 0 0 12px 12px !important;
            background: transparent !important;
        }

        /* Callout Alerts */
        .doc-alert {
            border-radius: 12px;
            padding: 16px 20px;
            margin: 20px 0;
            font-size: 0.95rem;
            border-left: 5px solid;
        }

        .doc-alert-info {
            background-color: #eff6ff;
            border-color: #2563eb;
            color: #1e40af;
        }

        .doc-alert-warning {
            background-color: #fffbeb;
            border-color: #f59e0b;
            color: #92400e;
        }

        .doc-alert-success {
            background-color: #f0fdf4;
            border-color: #16a34a;
            color: #166534;
        }

        /* Tables */
        .table-doc {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            margin: 20px 0;
            font-size: 0.9rem;
        }

        .table-doc th {
            background-color: #f8fafc;
            padding: 12px 16px;
            font-weight: 700;
            color: #334155;
            border-bottom: 1px solid var(--border-color);
        }

        .table-doc td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-doc tr:last-child td {
            border-bottom: none;
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
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
        }

        .back-to-top:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Search Highlight */
        .search-match {
            background-color: #fef08a;
            padding: 2px 4px;
            border-radius: 4px;
        }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#docsSidebarNav" data-bs-offset="100" tabindex="0">

    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg docs-navbar fixed-top py-2">
        <div class="container-fluid px-lg-4">
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary btn-sm d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand d-flex align-items-center text-dark fw-bold me-4" href="<?= base_url() ?>">
                    <i class="fas fa-layer-group text-primary me-2"></i>
                    <span>SLCMS</span>
                    <span class="badge bg-primary text-white ms-2" style="font-size: 0.68rem; letter-spacing: 0.05em;">DOCS v1.0</span>
                </a>
            </div>

            <!-- Instant Search Input -->
            <div class="d-flex align-items-center flex-grow-1 max-w-500 mx-lg-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0 text-muted">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="docSearchInput" class="form-control bg-light border-start-0" placeholder="Search documentation (e.g. plugin, hooks, routing, auth)...">
                    <button class="btn btn-outline-secondary d-none" id="clearSearchBtn" type="button">&times;</button>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <a href="<?= base_url('marketplace') ?>" class="btn btn-sm btn-outline-primary me-2">
                    <i class="fas fa-store me-1"></i> Marketplace
                </a>
                <a href="https://github.com/stitpragya22/slcmsbootstrapjquery.git" target="_blank" class="btn btn-sm btn-outline-dark me-2">
                    <i class="fab fa-github me-1"></i> GitHub
                </a>
                <?php if ($currentUser) { ?>
                    <a href="<?= base_url('admin') ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-tachometer-alt me-1"></i> Admin Panel
                    </a>
                <?php } else { ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-sign-in-alt me-1"></i> Login Demo
                    </a>
                <?php } ?>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container-fluid px-lg-4" style="margin-top: 60px;">
        <div class="row">

            <!-- Desktop Sidebar (Sticky) -->
            <div class="col-lg-3 col-xl-2 d-none d-lg-block px-0">
                <div class="docs-sidebar" id="docsSidebarNav">
                    <div class="sidebar-section-title">Getting Started</div>
                    <a href="#quickstart" class="sidebar-link active"><i class="fas fa-bolt"></i> 5-Minute Quickstart</a>
                    <a href="#requirements" class="sidebar-link"><i class="fas fa-check-circle"></i> System Requirements</a>
                    <a href="#credentials" class="sidebar-link"><i class="fas fa-key"></i> Default Credentials</a>

                    <div class="sidebar-section-title">Architecture</div>
                    <a href="#ci4-core" class="sidebar-link"><i class="fas fa-cubes"></i> CodeIgniter 4 Core</a>
                    <a href="#shield-auth" class="sidebar-link"><i class="fas fa-shield-alt"></i> Shield Auth & RBAC</a>
                    <a href="#ui-stack" class="sidebar-link"><i class="fas fa-palette"></i> Bootstrap & jQuery Stack</a>
                    <a href="#dynamic-modules" class="sidebar-link"><i class="fas fa-magic"></i> Zero-Mutation Modules</a>

                    <div class="sidebar-section-title">Plugin Development SDK</div>
                    <a href="#plugin-structure" class="sidebar-link"><i class="fas fa-folder-tree"></i> Directory Structure</a>
                    <a href="#plugin-manifest" class="sidebar-link"><i class="fas fa-file-code"></i> Manifest (plugin.json)</a>
                    <a href="#plugin-lifecycle" class="sidebar-link"><i class="fas fa-sync-alt"></i> Lifecycle Callbacks</a>
                    <a href="#hooks-system" class="sidebar-link"><i class="fas fa-plug"></i> Event Hooks API</a>
                    <a href="#addon-routing" class="sidebar-link"><i class="fas fa-route"></i> Addon Auto-Routing</a>
                    <a href="#starter-boilerplate" class="sidebar-link text-primary fw-bold"><i class="fas fa-file-download"></i> Starter Boilerplate</a>

                    <div class="sidebar-section-title">Database & Security</div>
                    <a href="#database-forge" class="sidebar-link"><i class="fas fa-database"></i> Database Forge & SQL</a>
                    <a href="#security-hardening" class="sidebar-link"><i class="fas fa-user-shield"></i> Security & CSRF</a>

                    <div class="sidebar-section-title">Deployment & CLI</div>
                    <a href="#deployment-guide" class="sidebar-link"><i class="fas fa-server"></i> Server Deployment</a>
                    <a href="#spark-cli" class="sidebar-link"><i class="fas fa-terminal"></i> Spark CLI Commands</a>
                </div>
            </div>

            <!-- Mobile Offcanvas Sidebar -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title fw-bold text-primary"><i class="fas fa-layer-group me-2"></i>SLCMS Docs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body p-3">
                    <div class="sidebar-section-title">Getting Started</div>
                    <a href="#quickstart" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-bolt"></i> 5-Minute Quickstart</a>
                    <a href="#requirements" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-check-circle"></i> System Requirements</a>
                    <a href="#credentials" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-key"></i> Default Credentials</a>

                    <div class="sidebar-section-title">Architecture</div>
                    <a href="#ci4-core" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-cubes"></i> CodeIgniter 4 Core</a>
                    <a href="#shield-auth" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-shield-alt"></i> Shield Auth & RBAC</a>
                    <a href="#ui-stack" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-palette"></i> Bootstrap & jQuery</a>

                    <div class="sidebar-section-title">Plugin Development SDK</div>
                    <a href="#plugin-structure" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-folder-tree"></i> Directory Structure</a>
                    <a href="#plugin-manifest" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-file-code"></i> Manifest (plugin.json)</a>
                    <a href="#plugin-lifecycle" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-sync-alt"></i> Lifecycle Callbacks</a>
                    <a href="#hooks-system" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-plug"></i> Event Hooks API</a>
                    <a href="#starter-boilerplate" class="sidebar-link text-primary fw-bold" data-bs-dismiss="offcanvas"><i class="fas fa-file-download"></i> Starter Boilerplate</a>

                    <div class="sidebar-section-title">Deployment & CLI</div>
                    <a href="#deployment-guide" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-server"></i> Server Deployment</a>
                    <a href="#spark-cli" class="sidebar-link" data-bs-dismiss="offcanvas"><i class="fas fa-terminal"></i> Spark CLI Commands</a>
                </div>
            </div>

            <!-- Content Column -->
            <div class="col-lg-9 col-xl-10">
                <div class="docs-content">

                    <!-- ============================================== -->
                    <!-- QUICKSTART SECTION -->
                    <!-- ============================================== -->
                    <section id="quickstart" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-bolt text-warning me-3"></i> 5-Minute Quickstart
                        </div>
                        <div class="section-subtitle">
                            Get a full, production-ready SLCMS instance running locally on your machine in under 5 minutes with zero complex container setup.
                        </div>

                        <p>Open your terminal and run the following 4-step sequence:</p>

                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fas fa-terminal"></i> Terminal / Bash</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-bash"># 1. Clone the repository
git clone https://github.com/stitpragya22/slcmsbootstrapjquery.git slcms
cd slcms

# 2. Install PHP Composer dependencies (CodeIgniter 4 + Shield)
composer install

# 3. Create your environment configuration file
cp env .env

# 4. Open .env and set your database connection details:
# database.default.hostname = localhost
# database.default.database = slcms_db
# database.default.username = root
# database.default.password = 
# app.baseURL = 'http://localhost:8080/'

# 5. Run database migrations & seed initial admin accounts
php spark migrate
php spark db:seed InitialSeeder

# 6. Start the built-in development server
php spark serve</code></pre>
                        </div>

                        <div class="doc-alert doc-alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>That's it!</strong> Open <code>http://localhost:8080</code> in your browser to see your live landing page, public marketplace, and admin portal.
                        </div>
                    </section>

                    <!-- ============================================== -->
                    <!-- REQUIREMENTS SECTION -->
                    <!-- ============================================== -->
                    <section id="requirements" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-check-circle text-success me-3"></i> System Requirements
                        </div>
                        <div class="section-subtitle">
                            SLCMS is designed to run everywhere—from shared cPanel hosting to enterprise cloud VPS instances.
                        </div>

                        <table class="table-doc">
                            <thead>
                                <tr>
                                    <th>Requirement</th>
                                    <th>Minimum Version</th>
                                    <th>Recommended</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>PHP</strong></td>
                                    <td><code>>= 8.1</code></td>
                                    <td><code>PHP 8.2+</code></td>
                                    <td>Extensions required: <code>curl</code>, <code>intl</code>, <code>mbstring</code>, <code>json</code>, <code>mysqli</code>, <code>zip</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Database</strong></td>
                                    <td><code>MySQL 5.7+</code></td>
                                    <td><code>MariaDB 10.4+ / MySQL 8.0</code></td>
                                    <td>Default collation: <code>utf8mb4_general_ci</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Web Server</strong></td>
                                    <td><code>Apache 2.4+</code> or <code>Nginx</code></td>
                                    <td><code>Apache with mod_rewrite</code></td>
                                    <td><code>.htaccess</code> is pre-configured in project root and <code>public/</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Package Manager</strong></td>
                                    <td><code>Composer 2.x</code></td>
                                    <td><code>Composer 2.6+</code></td>
                                    <td>Used to manage CodeIgniter 4 framework and Shield</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>

                    <!-- ============================================== -->
                    <!-- CREDENTIALS SECTION -->
                    <!-- ============================================== -->
                    <section id="credentials" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-key text-primary me-3"></i> Default Credentials
                        </div>
                        <div class="section-subtitle">
                            The initial seeder creates two pre-configured role-based users for local testing and demonstration.
                        </div>

                        <table class="table-doc">
                            <thead>
                                <tr>
                                    <th>Role / Access Level</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Authorized Areas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-danger">Superadmin / Admin</span></td>
                                    <td><code>admin@mail.com</code></td>
                                    <td><code>12345678</code></td>
                                    <td>Full access: <code>/admin</code>, Marketplace management, Plugin activator, Module CRUD generator</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-warning text-dark">Editor</span></td>
                                    <td><code>editor@mail.com</code></td>
                                    <td><code>12345678</code></td>
                                    <td>Editor workspace: <code>/editor</code>, Content editing, Lead inspection</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="doc-alert doc-alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Production Security Warning:</strong> Always change the default admin passwords immediately after running migrations in a public production environment via <code>/admin/profile</code> or the database.
                        </div>
                    </section>

                    <!-- ============================================== -->
                    <!-- ARCHITECTURE SECTION -->
                    <!-- ============================================== -->
                    <section id="ci4-core" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-cubes text-info me-3"></i> CodeIgniter 4 Core & Directory Structure
                        </div>
                        <div class="section-subtitle">
                            Clean MVC separation with modern PHP 8 strict typing, service containers, and HMVC-style plugin modularity.
                        </div>

                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fas fa-folder"></i> Project Directory Layout</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-bash">slcms/
├── app/
│   ├── Config/
│   │   ├── Routes.php              # Global explicit routes & admin group definitions
│   │   ├── addons_routes.php       # Dynamic /addons/{plugin}/{method} route dispatcher
│   │   ├── Filters.php             # CSRF, Auth, and Security filters
│   │   ├── Routing.php             # $autoRoute = false (Harden security)
│   ├── Controllers/                # Core controllers (Home, Admin, Marketplace, Generator)
│   ├── Libraries/
│   │   ├── Hook.php                # WordPress-style Action & Filter Hook engine
│   │   ├── PluginManager.php       # Plugin discovery, lifecycle runner & catalog
│   ├── Views/                      # Blade-like native PHP view templates
├── Plugins/                        # Modular Plugins directory (Capital 'P' for Linux compatibility)
│   ├── contact-form-builder/       # Lead capture & inbox plugin
│   ├── seo-optimizer/              # XML sitemap & robots.txt generator
│   ├── activity-audit-log/         # Enterprise security audit logger
│   └── webp-media-compressor/      # Media asset scanner
├── public/                         # Public web root (index.php, CSS, JS, uploads)
├── writable/                       # Cache, session, and log storage (chmod 775/777)
└── spark                           # CodeIgniter CLI executable runner</code></pre>
                        </div>
                    </section>

                    <!-- ============================================== -->
                    <!-- SHIELD AUTH SECTION -->
                    <!-- ============================================== -->
                    <section id="shield-auth" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-shield-alt text-danger me-3"></i> Shield Auth & Role-Based Access (RBAC)
                        </div>
                        <div class="section-subtitle">
                            Powered by CodeIgniter Shield for robust session management, password hashing (Argon2id/Bcrypt), and granular group permissions.
                        </div>

                        <h3 class="subheading">Protecting Routes with Shield Filters</h3>
                        <p>Protect any route group using the built-in <code>group:role1,role2</code> filter directly in <code>app/Config/Routes.php</code>:</p>

                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fab fa-php"></i> app/Config/Routes.php</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-php">// Protect an admin route group for Superadmins and Admins
$routes->group('admin', ['filter' => 'group:admin,superadmin'], function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('marketplace', 'MarketplaceController::index');
    $routes->get('marketplace/activate/(:segment)', 'MarketplaceController::activate/$1');
});

// Protect editor routes
$routes->group('editor', ['filter' => 'group:editor,admin,superadmin'], function ($routes) {
    $routes->get('/', 'EditorController::index');
});</code></pre>
                        </div>

                        <h3 class="subheading">Accessing Current Authenticated User</h3>
                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fab fa-php"></i> PHP Controller / View</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-php">// Check if someone is logged in
if (auth()->loggedIn()) {
    $user = auth()->user();
    $userId   = $user->id;
    $email    = $user->email;
    $username = $user->username;
    
    // Check role membership
    if ($user->inGroup('superadmin', 'admin')) {
        // High-privilege action
    }
}</code></pre>
                        </div>
                    </section>

                    <!-- ============================================== -->
                    <!-- UI STACK SECTION -->
                    <!-- ============================================== -->
                    <section id="ui-stack" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-palette text-primary me-3"></i> Bootstrap 5 & jQuery Frontend Stack
                        </div>
                        <div class="section-subtitle">
                            Zero heavy NodeJS builds. No webpack, vite, or npm compilation required. Just write HTML, CSS, and jQuery.
                        </div>

                        <p>SLCMS was engineered so developers can immediately modify views and write plugins without waiting for node builds or dealing with breaking package updates:</p>

                        <ul>
                            <li><strong>Bootstrap 5.1.3:</strong> Responsive CSS grid, modern utility classes, and mobile-friendly components.</li>
                            <li><strong>jQuery 3.6+:</strong> Fast, expressive DOM manipulation, AJAX requests, and interactive widgets.</li>
                            <li><strong>FontAwesome 5:</strong> Over 1,500 vector icons ready via simple <code>&lt;i class="fas fa-icon"&gt;&lt;/i&gt;</code> tags.</li>
                            <li><strong>Animate.css:</strong> Lightweight micro-animations for cards, notifications, and modal popups.</li>
                        </ul>
                    </section>

                    <!-- ============================================== -->
                    <!-- PLUGIN DEVELOPMENT SDK -->
                    <!-- ============================================== -->
                    <section id="plugin-structure" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-plug text-primary me-3"></i> Plugin Development SDK
                        </div>
                        <div class="section-subtitle">
                            The core philosophy of SLCMS: <em>Extend everything without modifying a single core file.</em>
                        </div>

                        <h3 class="subheading" id="plugin-manifest">1. Plugin Manifest (plugin.json)</h3>
                        <p>Every plugin placed inside <code>Plugins/{slug}/</code> must contain a valid <code>plugin.json</code> manifest file:</p>

                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fas fa-file-code"></i> Plugins/sample-plugin/plugin.json</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-json">{
  "name": "Custom Analytics & Tracking",
  "slug": "custom-analytics",
  "version": "1.0.0",
  "description": "Inject custom tracking scripts and monitor page visits seamlessly.",
  "author": "Your Name / Organization",
  "author_url": "https://yourwebsite.com",
  "icon": "chart-line",
  "category": "SEO & Marketing",
  "settings": {
    "tracking_id": "UA-XXXXX-Y",
    "anonymize_ip": true
  }
}</code></pre>
                        </div>

                        <h3 class="subheading" id="plugin-lifecycle">2. Lifecycle Callbacks (Plugin.php)</h3>
                        <p>When a user activates, deactivates, or uninstalls your plugin through the marketplace, SLCMS invokes static methods on your plugin's <code>Plugin</code> class:</p>

                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fab fa-php"></i> Plugins/sample-plugin/Plugin.php</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-php">&lt;?php

namespace Plugins\CustomAnalytics;

use App\Libraries\Hook;

class Plugin
{
    /**
     * Triggered on plugin activation.
     * Ideal for creating database tables or inserting default configurations.
     */
    public static function onActivate(): void
    {
        $forge = \Config\Database::forge();
        $forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'page_url' => ['type' => 'VARCHAR', 'constraint' => 255],
            'views' => ['type' => 'INT', 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $forge->addPrimaryKey('id');
        $forge->createTable('cms_analytics_stats', true);
    }

    /**
     * Triggered on plugin deactivation.
     */
    public static function onDeactivate(): void
    {
        // Temporary cleanup if needed
    }

    /**
     * Triggered on plugin deletion/uninstall.
     */
    public static function onUninstall(): void
    {
        $forge = \Config\Database::forge();
        $forge->dropTable('cms_analytics_stats', true);
    }
}</code></pre>
                        </div>

                        <h3 class="subheading" id="hooks-system">3. Event Hooks API (App\Libraries\Hook)</h3>
                        <p>SLCMS provides a full WordPress-style Hook and Event architecture. Attach custom logic to lifecycle actions or filter data in real-time:</p>

                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fab fa-php"></i> Hook Usage Example</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-php">use App\Libraries\Hook;

// 1. Listen to an Action Hook
Hook::addAction('slcms.plugin.activated', function ($pluginSlug) {
    log_message('info', "Plugin {$pluginSlug} was just activated!");
});

// 2. Trigger an Action Hook
Hook::doAction('slcms.order.completed', $orderId, $totalAmount);

// 3. Register a Filter Hook (Transform data)
Hook::addFilter('slcms.page_title', function ($title) {
    return $title . ' | Powered by SLCMS';
});

// 4. Apply a Filter Hook
$finalTitle = Hook::applyFilters('slcms.page_title', 'Home Page');</code></pre>
                        </div>

                        <h3 class="subheading" id="addon-routing">4. Automatic Dynamic Addon Routing</h3>
                        <p>You <strong>do not need to modify Routes.php</strong> to add web pages, controllers, or APIs for your plugin! SLCMS routes them automatically:</p>

                        <div class="doc-alert doc-alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Route Pattern:</strong> <code>https://your-domain.com/addons/{plugin-slug}/{method}</code><br>
                            Automatically maps to <code>Plugins\{StudlySlug}\{StudlySlug}Controller::{method}()</code>
                        </div>

                        <table class="table-doc">
                            <thead>
                                <tr>
                                    <th>URL Accessed</th>
                                    <th>Resolves To Controller & Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>/addons/contact-form-builder</code></td>
                                    <td><code>Plugins\ContactFormBuilder\ContactFormBuilderController::index()</code></td>
                                </tr>
                                <tr>
                                    <td><code>/addons/contact-form-builder/submit</code></td>
                                    <td><code>Plugins\ContactFormBuilder\ContactFormBuilderController::submit()</code></td>
                                </tr>
                                <tr>
                                    <td><code>/addons/seo-optimizer/sitemap</code></td>
                                    <td><code>Plugins\SeoOptimizer\SeoOptimizerController::sitemap()</code></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>

                    <!-- ============================================== -->
                    <!-- STARTER BOILERPLATE -->
                    <!-- ============================================== -->
                    <section id="starter-boilerplate" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-file-download text-success me-3"></i> 30-Second Ready Starter Plugin
                        </div>
                        <div class="section-subtitle">
                            Copy this complete, working plugin directly into <code>Plugins/hello-world/</code> to create your first SLCMS plugin immediately.
                        </div>

                        <p><strong>Step 1:</strong> Create file <code>Plugins/hello-world/plugin.json</code>:</p>
                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fas fa-file-code"></i> Plugins/hello-world/plugin.json</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-json">{
  "name": "Hello World Extension",
  "slug": "hello-world",
  "version": "1.0.0",
  "description": "My first custom extension for SLCMS with interactive UI.",
  "author": "Developer Community",
  "author_url": "https://slcms.stitpragya.in",
  "icon": "globe",
  "category": "Utilities"
}</code></pre>
                        </div>

                        <p><strong>Step 2:</strong> Create file <code>Plugins/hello-world/Plugin.php</code>:</p>
                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fab fa-php"></i> Plugins/hello-world/Plugin.php</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-php">&lt;?php

namespace Plugins\HelloWorld;

class Plugin
{
    public static function onActivate(): void
    {
        // Runs once when plugin is activated
    }

    public static function onDeactivate(): void
    {
        // Runs when deactivated
    }

    public static function onUninstall(): void
    {
        // Cleanup upon deletion
    }
}</code></pre>
                        </div>

                        <p><strong>Step 3:</strong> Create file <code>Plugins/hello-world/HelloWorldController.php</code>:</p>
                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fab fa-php"></i> Plugins/hello-world/HelloWorldController.php</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-php">&lt;?php

namespace Plugins\HelloWorld;

use App\Controllers\BaseController;

class HelloWorldController extends BaseController
{
    public function index()
    {
        return '
        &lt;!DOCTYPE html&gt;
        &lt;html&gt;
        &lt;head&gt;
            &lt;title&gt;Hello World Plugin&lt;/title&gt;
            &lt;link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"&gt;
        &lt;/head&gt;
        &lt;body class="bg-light p-5 text-center"&gt;
            &lt;div class="card shadow-sm p-5 mx-auto" style="max-width: 500px;"&gt;
                &lt;h2 class="text-primary fw-bold"&gt;&lt;i class="fas fa-rocket me-2"&gt;&lt;/i&gt;Hello from SLCMS!&lt;/h2&gt;
                &lt;p class="text-muted"&gt;Your custom plugin is running smoothly with dynamic routing.&lt;/p&gt;
                &lt;a href="' . base_url('admin/marketplace') . '" class="btn btn-outline-primary"&gt;&larr; Return to Marketplace&lt;/a&gt;
            &lt;/div&gt;
        &lt;/body&gt;
        &lt;/html&gt;';
    }

    public function api()
    {
        $resp = $this->response ?? \Config\Services::response();
        return $resp->setJSON([
            'status' => 'success',
            'message' => 'Hello from custom plugin API endpoint!'
        ]);
    }
}</code></pre>
                        </div>

                        <div class="doc-alert doc-alert-success">
                            <i class="fas fa-magic me-2"></i>
                            Activate it in <strong>Admin &rarr; Marketplace &rarr; Installed Plugins</strong>, then immediately test:
                            <br>• Browser view: <code>https://your-domain.com/addons/hello-world</code>
                            <br>• JSON API: <code>https://your-domain.com/addons/hello-world/api</code>
                        </div>
                    </section>

                    <!-- ============================================== -->
                    <!-- DATABASE FORGE SECTION -->
                    <!-- ============================================== -->
                    <section id="database-forge" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-database text-primary me-3"></i> Database Operations & Forge
                        </div>
                        <div class="section-subtitle">
                            Interacting with MariaDB / MySQL using CodeIgniter's Query Builder and Database Forge for safe schema manipulations.
                        </div>

                        <h3 class="subheading">Connecting & Running Queries</h3>
                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fab fa-php"></i> Query Builder Examples</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-php">$db = \Config\Database::connect();

// 1. SELECT query
$leads = $db->table('cms_leads')
            ->where('status', 'unread')
            ->orderBy('created_at', 'DESC')
            ->limit(20)
            ->get()
            ->getResultArray();

// 2. INSERT query
$db->table('cms_leads')->insert([
    'name'       => $name,
    'email'      => $email,
    'message'    => $message,
    'created_at' => date('Y-m-d H:i:s'),
]);

// 3. UPDATE query
$db->table('cms_leads')
   ->where('id', $leadId)
   ->update(['status' => 'read']);</code></pre>
                        </div>
                    </section>

                    <!-- ============================================== -->
                    <!-- SECURITY HARDENING -->
                    <!-- ============================================== -->
                    <section id="security-hardening" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-user-shield text-danger me-3"></i> Security Hardening & Best Practices
                        </div>
                        <div class="section-subtitle">
                            SLCMS is hardened out-of-the-box against the OWASP Top 10 web vulnerabilities.
                        </div>

                        <div class="row g-4 my-2">
                            <div class="col-md-6">
                                <div class="card h-100 border p-3">
                                    <h5 class="fw-bold text-danger"><i class="fas fa-ban me-2"></i>Disabled Auto-Routing</h5>
                                    <p class="small text-muted mb-0">Legacy CodeIgniter 3/4 auto-routing is strictly disabled (<code>$autoRoute = false</code> in <code>Routing.php</code>). Attackers cannot guess or invoke arbitrary controllers or methods.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border p-3">
                                    <h5 class="fw-bold text-primary"><i class="fas fa-lock me-2"></i>Global CSRF Defense</h5>
                                    <p class="small text-muted mb-0">CSRF tokens protect every state-changing POST/PUT request. Public API webhooks and form endpoints are selectively exempted via <code>app/Config/Filters.php</code>.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border p-3">
                                    <h5 class="fw-bold text-success"><i class="fas fa-shield-virus me-2"></i>XSS Prevention (esc)</h5>
                                    <p class="small text-muted mb-0">Never echo raw user inputs. Always pass data through the native <code>esc($string)</code> helper to sanitize HTML and JavaScript entities.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border p-3">
                                    <h5 class="fw-bold text-warning text-dark"><i class="fas fa-database me-2"></i>Parameterized Queries</h5>
                                    <p class="small text-muted mb-0">Never concatenate SQL queries with variables. Use Query Builder parameter binding (<code>where('email', $email)</code>) to eliminate SQL injection risks.</p>
                                </div>
                            </div>
                        </div>

                        <h3 class="subheading">CSRF Form Protection Example</h3>
                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fab fa-html5"></i> HTML Form with CSRF Token</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-html">&lt;!-- 1. Standard HTML Form --&gt;
&lt;form action="&lt;?= base_url('admin/profile') ?&gt;" method="POST"&gt;
    &lt;?= csrf_field() ?&gt;
    &lt;input type="text" name="username" class="form-control"&gt;
    &lt;button type="submit" class="btn btn-primary"&gt;Save Profile&lt;/button&gt;
&lt;/form&gt;

&lt;!-- 2. jQuery AJAX with CSRF Header --&gt;
&lt;script&gt;
$.ajax({
    url: '&lt;?= base_url('admin/marketplace/install/sample-plugin') ?&gt;',
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': '&lt;?= csrf_hash() ?&gt;'
    },
    data: { id: 123 },
    success: function(response) {
        console.log('Installed successfully:', response);
    }
});
&lt;/script&gt;</code></pre>
                        </div>
                    </section>

                    <!-- ============================================== -->
                    <!-- DEPLOYMENT GUIDE -->
                    <!-- ============================================== -->
                    <section id="deployment-guide" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-server text-secondary me-3"></i> Production Deployment Guide
                        </div>
                        <div class="section-subtitle">
                            Instructions for deploying SLCMS to cPanel, Apache, StackCP, and Linux VPS servers.
                        </div>

                        <h3 class="subheading">1. Directory Permissions</h3>
                        <p>Ensure web server write permissions on <code>writable/</code> and <code>public/uploads/</code>:</p>
                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fas fa-terminal"></i> Terminal</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-bash">chmod -R 775 writable public/uploads</code></pre>
                        </div>

                        <h3 class="subheading">2. Linux Case-Sensitivity Symlink (Important!)</h3>
                        <p>Because Linux is case-sensitive, Git stores plugin folders as <code>Plugins/</code> (capital P). To ensure both lowercase <code>plugins/</code> and uppercase <code>Plugins/</code> work identically across all server environments, create a quick symlink on your server:</p>
                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fas fa-terminal"></i> Terminal</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-bash"># Run inside your project root
ln -s Plugins plugins</code></pre>
                        </div>

                        <h3 class="subheading">3. Apache .htaccess Rewrite Rules</h3>
                        <p>SLCMS includes a production-tested <code>.htaccess</code> in the project root to forward requests to CodeIgniter's front controller:</p>
                        <div class="code-card">
                            <div class="code-card-header">
                                <span class="file-name"><i class="fas fa-cog"></i> .htaccess</span>
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                            <pre><code class="language-apache">RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]</code></pre>
                        </div>
                    </section>

                    <!-- ============================================== -->
                    <!-- SPARK CLI REFERENCE -->
                    <!-- ============================================== -->
                    <section id="spark-cli" class="docs-section">
                        <div class="section-title">
                            <i class="fas fa-terminal text-primary me-3"></i> Spark CLI Cheatsheet
                        </div>
                        <div class="section-subtitle">
                            CodeIgniter 4 CLI commands to speed up your development workflow.
                        </div>

                        <table class="table-doc">
                            <thead>
                                <tr>
                                    <th>Command</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>php spark serve</code></td>
                                    <td>Starts local lightweight development web server at <code>http://localhost:8080</code></td>
                                </tr>
                                <tr>
                                    <td><code>php spark routes</code></td>
                                    <td>Lists all registered routes, HTTP methods, and matched handlers</td>
                                </tr>
                                <tr>
                                    <td><code>php spark migrate</code></td>
                                    <td>Runs all pending database schema migrations</td>
                                </tr>
                                <tr>
                                    <td><code>php spark db:seed InitialSeeder</code></td>
                                    <td>Populates the database with initial users, roles, and default settings</td>
                                </tr>
                                <tr>
                                    <td><code>php spark db:table &lt;table_name&gt;</code></td>
                                    <td>Inspects columns, indexes, and live row data inside any database table</td>
                                </tr>
                                <tr>
                                    <td><code>php spark make:controller &lt;Name&gt;</code></td>
                                    <td>Generates a clean skeleton controller class in <code>app/Controllers/</code></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>

                    <!-- Footer note -->
                    <div class="text-center py-5 text-muted border-top">
                        <p class="mb-1"><strong>SLCMS Developer Documentation v1.0</strong></p>
                        <p class="small">Built with CodeIgniter 4, Shield, Bootstrap 5 & jQuery. Open source under MIT License.</p>
                        <div class="mt-3">
                            <a href="<?= base_url('marketplace') ?>" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-store me-1"></i> Browse Plugins</a>
                            <a href="https://github.com/stitpragya22/slcmsbootstrapjquery.git" target="_blank" class="btn btn-sm btn-outline-dark"><i class="fab fa-github me-1"></i> Star on GitHub</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTopBtn"><i class="fas fa-arrow-up"></i></a>

    <!-- jQuery & Bootstrap 5 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Prism.js Syntax Highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-json.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-apacheconf.min.js"></script>

    <script>
        // 1. One-Click Code Snippet Copy Function
        function copyCode(btn) {
            const card = $(btn).closest('.code-card');
            const codeText = card.find('code').text();
            
            navigator.clipboard.writeText(codeText).then(function() {
                const originalHtml = $(btn).html();
                $(btn).html('<i class="fas fa-check text-success"></i> Copied!');
                $(btn).addClass('bg-success text-white');
                
                setTimeout(function() {
                    $(btn).html(originalHtml);
                    $(btn).removeClass('bg-success text-white');
                }, 2000);
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
            });
        }

        // 2. Instant Search Filter
        $(document).ready(function() {
            $('#docSearchInput').on('input', function() {
                const term = $(this).val().toLowerCase().trim();
                
                if (term.length > 0) {
                    $('#clearSearchBtn').removeClass('d-none');
                    
                    $('.docs-section').each(function() {
                        const text = $(this).text().toLowerCase();
                        if (text.indexOf(term) !== -1) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });

                    // Also filter sidebar links
                    $('.sidebar-link').each(function() {
                        const linkText = $(this).text().toLowerCase();
                        if (linkText.indexOf(term) !== -1) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                } else {
                    $('#clearSearchBtn').addClass('d-none');
                    $('.docs-section').show();
                    $('.sidebar-link').show();
                }
            });

            $('#clearSearchBtn').on('click', function() {
                $('#docSearchInput').val('').trigger('input');
            });

            // 3. Back to Top Button visibility
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('#backToTopBtn').fadeIn();
                } else {
                    $('#backToTopBtn').fadeOut();
                }
            });

            $('#backToTopBtn').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({scrollTop: 0}, 400);
            });
        });
    </script>
</body>
</html>

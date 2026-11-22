# SLCMS v1 - Modern Lightweight CodeIgniter 4 CMS

[![PHP Version](https://img.shields.io/badge/php-%3E%3D%208.1-8892BF.svg?style=flat-square)](https://www.php.net/)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.5.0-EF4444.svg?style=flat-square)](https://codeigniter.com/)
[![CodeIgniter Shield](https://img.shields.io/badge/Shield%20Auth-v1.4.1-10B981.svg?style=flat-square)](https://github.com/codeigniter4/shield)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.1.3-7952B3.svg?style=flat-square)](https://getbootstrap.com/)
[![jQuery](https://img.shields.io/badge/jQuery-3.6.0-0769AD.svg?style=flat-square)](https://jquery.com/)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE)

A high-performance, developer-first Content Management System engineered on top of **CodeIgniter 4**, **Bootstrap 5**, and **jQuery**. Built for speed, extensibility, and effortless deployment on everything from shared cPanel/StackCP hosting to modern containerized environments.

---

## 🌟 Key Features

- **🛡️ Enterprise Authentication & RBAC (CodeIgniter Shield):**
  - Powered by official `codeigniter4/shield` (`v1.4.1`).
  - Pre-configured role matrix: `superadmin`, `admin`, `editor`, and `user`.
  - Secure session management, bcrypt password hashing, magic link login, and route filter guards.

- **⚡ Zero-Mutation Dynamic CRUD Generator:**
  - Build full database-driven CRUD modules in 30 seconds from the web UI.
  - Generates CodeIgniter 4 Database Forge schemas without raw SQL concatenation.
  - Zero file-mutation architecture: modules register in `cms_modules` and automatically wire up dynamic routes and sidebar menus without altering core configuration files.

- **🏪 In-Admin Plugin Marketplace & ZIP Installer:**
  - Curated online marketplace catalog directly inside the admin dashboard (`/admin/marketplace`).
  - 1-Click remote installation, activation, deactivation, and clean uninstallation.
  - Direct `.ZIP` package upload with manifest validation and anti-traversal security guards.

- **🪝 WordPress-Style Event & Hook System:**
  - Standardized `App\Libraries\Hook` with Actions (`Hook::addAction`, `Hook::doAction`) and Filters (`Hook::addFilter`, `Hook::applyFilter`).
  - Plugins can intercept menus, lifecycle operations, and view outputs cleanly without modifying core files.

- **🔒 Hardened Security Architecture:**
  - Legacy Auto-Routing permanently disabled to prevent unauthorized controller method execution.
  - Global CSRF token verification and `invalidchars` filter active on all endpoints.
  - Unified file service in `BaseAdminController` with extension, MIME, and size validation.

- **🎨 Sleek Responsive Administration Dashboard:**
  - Built with Bootstrap 5 and jQuery.
  - Integrated DataTables with print and export capabilities (CSV, Excel, PDF).
  - Summernote rich text editor and Select2 dropdowns.

---

## 🚀 Live Demo & Production Credentials

- **Live URL:** [https://slcms.stitpragya.in/](https://slcms.stitpragya.in/)
- **Admin Portal:** [https://slcms.stitpragya.in/admin](https://slcms.stitpragya.in/admin)
- **Marketplace:** [https://slcms.stitpragya.in/admin/marketplace](https://slcms.stitpragya.in/admin/marketplace)

| Role | Email | Password | Access Level |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@mail.com` | `12345678` | Full system control, CRUD generator, marketplace |
| **Editor** | `editor@mail.com` | `12345678` | Section & content management |

---

## 💻 System Requirements

- **PHP:** `^8.1` or `^8.2` (PHP 8.2 recommended)
- **PHP Extensions:** `intl`, `mbstring`, `curl`, `json`, `mysqli`, `zip`
- **Database:** MySQL `>= 5.7` or MariaDB `>= 10.3`
- **Package Manager:** Composer `>= 2.0`
- **Web Server:** Apache (with `mod_rewrite`) or Nginx

---

## 📦 Step-by-Step Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/stitpragya22/slcmsbootstrapjquery.git slcms
cd slcms
```

### 2. Install Composer Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

### 3. Configure Environment File

Copy the template `env` file to `.env`:

```bash
cp env .env
```

Open `.env` in your editor and configure your **base URL** and **database credentials**:

```ini
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------
CI_ENVIRONMENT = production

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------
app.baseURL = 'http://localhost:8080/'
app.indexPage = ''

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------
database.default.hostname = localhost
database.default.database = slcms
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

### 4. Create Storage Directories & Set Permissions

Ensure all writable directories exist and are writable by the web server (e.g. `chmod 775` or `755`):

```bash
mkdir -p writable/cache writable/session writable/debugbar writable/logs writable/uploads public/uploads plugins
chmod -R 775 writable public/uploads plugins
```

### 5. Run Database Migrations

Run all database migrations to set up Shield tables (`users`, `auth_identities`, etc.), `cms_modules`, and `cms_plugins`:

```bash
php spark migrate --all
```

### 6. Seed Default Admin & Editor Accounts

Populate the database with the initial roles and accounts:

```bash
php spark db:seed ShieldSeeder
```

This seeds:
- **Admin Account:** `admin@mail.com` / `12345678` (Groups: `admin`, `superadmin`)
- **Editor Account:** `editor@mail.com` / `12345678` (Group: `editor`)

### 7. Launch Local Development Server

Run CodeIgniter's built-in development server:

```bash
php spark serve
```

Visit [http://localhost:8080](http://localhost:8080) in your browser!

---

## 🌐 Web Server Configuration

### Apache VirtualHost (Recommended)

Point your `DocumentRoot` strictly to the `public/` directory for security:

```apache
<VirtualHost *:80>
    ServerName slcms.local
    DocumentRoot "/path/to/slcms/public"

    <Directory "/path/to/slcms/public">
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/slcms_error.log
    CustomLog ${APACHE_LOG_DIR}/slcms_access.log combined
</VirtualHost>
```

### Shared Hosting (StackCP / cPanel)

When installing parallel to `public_html`, configure your hosting root to point to `~/slcms/public`. Ensure `.htaccess` inside `public/` is active for URL rewriting.

---

## 🔌 How to Build a Plugin for SLCMS

SLCMS plugins are self-contained packages placed inside `plugins/<PluginSlug>/`.

### 1. Create Plugin Manifest (`plugin.json`)

```json
{
  "slug": "my-custom-plugin",
  "name": "My Custom Feature Plugin",
  "version": "1.0.0",
  "description": "Adds advanced features and hooks to SLCMS.",
  "author": "Your Name / Organization",
  "author_url": "https://yourwebsite.com",
  "icon": "rocket",
  "category": "Utilities"
}
```

### 2. Implement Bootstrap Class (`Plugin.php`)

```php
<?php

namespace Plugins\MyCustomPlugin;

use App\Libraries\Hook;

class Plugin
{
    public static function onActivate(): void
    {
        // Run database migrations or initial setup
    }

    public static function onDeactivate(): void
    {
        // Suspend background tasks
    }

    public static function onUninstall(): void
    {
        // Drop custom tables and purge media
    }

    public static function boot(): void
    {
        // Hook into core actions or filters
        Hook::addAction('slcms.crud.after_save', function($module, $id, $data) {
            log_message('info', "Record {$id} saved in module {$module}.");
        });
    }
}
```

### 3. Distribute as ZIP

Zip the plugin directory and distribute it. Anyone can install it via **Admin Panel > Plugin Marketplace > Upload ZIP** or publish it to the community registry!

---

## 📁 Project Architecture

```
slcms/
├── app/
│   ├── Config/              # Application & routing configuration
│   ├── Controllers/         # Base and Administrative controllers
│   │   ├── Admin/           # BaseAdminController with upload & auth helpers
│   │   ├── Generator.php    # Zero-mutation CRUD generator
│   │   └── MarketplaceController.php # Plugin marketplace & ZIP installer
│   ├── Database/            # Migrations & Seeds (ShieldSeeder)
│   ├── Libraries/           # Hook.php (Actions/Filters) & PluginManager.php
│   ├── Models/              # CmsModuleModel, CmsPluginModel, UserModel
│   └── Views/               # Landing page, generator, marketplace & admin UI
├── plugins/                 # Safe directory for third-party & marketplace plugins
├── public/                  # Public web root
│   ├── assets/              # Bootstrap 5, jQuery, DataTables, FontAwesome
│   ├── templates/           # Generator templates (Controller, Model, View)
│   ├── uploads/             # Managed user uploads
│   └── index.php            # Web front controller
└── writable/                # Cache, logs, sessions, debugbar storage
```

---

## 🤝 Contributing

Contributions, bug reports, and plugin submissions are welcome!
1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingPlugin`)
3. Commit your Changes (`git commit -m 'Add some AmazingPlugin'`)
4. Push to the Branch (`git push origin feature/AmazingPlugin`)
5. Open a Pull Request

---

## 📄 License

Distributed under the MIT License. See [LICENSE](LICENSE) for more details.

---

## 👨‍💻 Maintained By

Developed & maintained by **[Stitpragya Technologies](https://stitpragya.in)**.
Visit the live portal at **[https://slcms.stitpragya.in](https://slcms.stitpragya.in)**.

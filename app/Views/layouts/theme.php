<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <meta name="csrf-header" content="<?= csrf_header() ?>">
    <title><?= $this->renderSection('title') ?: 'SLCMS - Modern Web Application' ?></title>

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 (Free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Font Awesome 5 Compatibility -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- SLCMS Theme Global Stylesheet -->
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #0f172a;
            --secondary-hover: #1e293b;
            --accent: #38bdf8;
            --surface: #ffffff;
            --surface-subtle: #f8fafc;
            --border: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 18px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            background-color: var(--surface-subtle);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        code, pre, .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Glassmorphism Navbar */
        .theme-navbar {
            backdrop-filter: blur(14px);
            background-color: rgba(255, 255, 255, 0.92);
            border-bottom: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        /* Modern Card Styling */
        .card-custom {
            background-color: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-custom:hover {
            box-shadow: 0 10px 30px -6px rgba(15, 23, 42, 0.1);
        }

        /* Custom Button Styling */
        .btn-theme-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #ffffff;
            font-weight: 600;
            border-radius: var(--radius-sm);
            padding: 9px 18px;
            transition: all 0.2s ease;
        }

        .btn-theme-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            color: #ffffff;
            transform: translateY(-1px);
        }

        /* Form Inputs */
        .form-control:focus, .form-select:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
        }

        /* Sticky Footer */
        .theme-footer {
            margin-top: auto;
            background-color: var(--secondary);
            color: #94a3b8;
            padding: 30px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>

    <!-- Page Specific Styles Slot -->
    <?= $this->renderSection('styles') ?>
</head>
<body>

    <!-- Header / Navbar Slot (Optional Override) -->
    <?= $this->renderSection('navbar') ?: $this->include('layouts/partials/navbar') ?>

    <!-- Main Content Wrapper -->
    <main class="flex-grow-1">
        <?= $this->renderSection('content') ?>
        <?= $this->renderSection('body') ?>
    </main>

    <!-- Footer Slot (Optional Override) -->
    <?= $this->renderSection('footer') ?: $this->include('layouts/partials/footer') ?>

    <!-- Essential JavaScript CDNs -->
    <!-- jQuery 3.7.1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5.3.3 Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Global SLCMS JavaScript Helpers -->
    <script>
        // 1. Automatic CSRF Protection for all jQuery AJAX Calls
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                '<?= csrf_header() ?>': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // 2. Global Toastr Notification Options
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "4000",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // 3. Auto-Trigger Flash Message Alerts from CodeIgniter Session
        <?php if (session()->getFlashdata('message')) : ?>
            toastr.success(<?= json_encode(session()->getFlashdata('message')) ?>);
        <?php endif ?>

        <?php if (session()->getFlashdata('error')) : ?>
            toastr.error(<?= json_encode(session()->getFlashdata('error')) ?>);
        <?php endif ?>

        <?php if (session()->getFlashdata('errors')) : ?>
            <?php foreach ((array) session()->getFlashdata('errors') as $err) : ?>
                toastr.error(<?= json_encode($err) ?>);
            <?php endforeach ?>
        <?php endif ?>

        // Helper: Quick SweetAlert Confirmation Modal
        window.confirmAction = function(title, text, confirmBtnText = 'Yes, Proceed!') {
            return Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#64748b',
                confirmButtonText: confirmBtnText,
                customClass: {
                    popup: 'rounded-4 border-0 shadow-lg',
                    confirmButton: 'btn btn-primary px-4 py-2 me-2',
                    cancelButton: 'btn btn-outline-secondary px-4 py-2'
                },
                buttonsStyling: false
            });
        };
    </script>

    <!-- Page Specific Scripts Slot -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>

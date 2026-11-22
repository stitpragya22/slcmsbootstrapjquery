<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <title><?= $this->renderSection('title') ?: 'Authentication' ?> - SLCMS</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #0f172a;
            --surface: #ffffff;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
            color: #1e293b;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 460px;
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .auth-header {
            background: #ffffff;
            padding: 36px 36px 20px;
            text-align: center;
        }

        .auth-brand {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: var(--secondary);
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .auth-body {
            padding: 10px 36px 36px;
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: var(--primary);
        }

        .form-control:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
        }

        .btn-auth-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #ffffff;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .btn-auth-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
        }

        .demo-pill-btn {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #475569;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.15s;
            cursor: pointer;
        }

        .demo-pill-btn:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .password-toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            z-index: 10;
        }

        .password-toggle-btn:hover {
            color: var(--primary);
        }
    </style>

    <?= $this->renderSection('pageStyles') ?>
</head>
<body>

    <main class="w-100 d-flex justify-content-center">
        <?= $this->renderSection('main') ?>
    </main>

    <!-- jQuery & Bootstrap 5 JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Password visibility toggle
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

    <?= $this->renderSection('pageScripts') ?>
</body>
</html>

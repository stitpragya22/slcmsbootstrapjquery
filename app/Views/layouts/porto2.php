<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Basic -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= isset($landingPage) ? $landingPage['title'] : '' ?></title>

	<meta name="keywords" content="<?= isset($landingPage) ? $landingPage['keywords'] : '' ?>" />
	<meta name="description" content="<?= isset($landingPage) ? $landingPage['meta_description'] : '' ?>">
	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

	<!-- Web Fonts  -->
	<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7COpen+Sans:400,700,800&display=swap" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/vendor/animate/animate.compat.css">
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/vendor/simple-line-icons/css/simple-line-icons.min.css">
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/vendor/owl.carousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/vendor/owl.carousel/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/vendor/magnific-popup/magnific-popup.min.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/css/theme.css">
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/css/theme-elements.css">
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/css/theme-blog.css">
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/css/theme-shop.css">

	<!-- Demo CSS -->
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/css/demos/demo-landing.css">

	<!-- Skin CSS -->
	<link id="skinCSS" rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/css/skins/skin-landing.css">

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/css/custom.css">
	<style>
		  .workshop-section {
            background-color: #f5f5f5;
            padding: 40px;
        }
        .workshop-section h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .card {
            border: 1px solid #ff8800;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-body p {
            color: #555;
        }
		.cta-button {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            display: block;
            margin: 20px auto;
            width: 300px;
            border-radius: 5px;
        }
		.fscontact {
			font-size: 20px;
		}

		.whatsapp-btn {
			position: fixed;
			bottom: 20px;
			right: 20px;
			background-color: #25D366;
			color: white;
			border-radius: 50%;
			padding: 15px;
			font-size: 24px;
			z-index: 1000;
		}

		.whatsapp-btn:hover {
			background-color: #fff;
		}
	</style>
	<?= $this->renderSection('style') ?>
</head>

<body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay data-plugin-options="{'hideDelay': 0, 'effect': 'pulse'}">
	<div class="loading-overlay">
		<div class="bounce-loader">
			<div class="wrapper-pulse">
				<div class="cssload-pulse-loader"></div>
			</div>
		</div>
	</div>

	<div class="body">
		<div role="main" class="main">
			<?= $this->renderSection('body') ?>
			<!-- WhatsApp Floating Button -->
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Vendor -->
	<script src="<?= base_url('public/assets/porto') ?>/vendor/plugins/js/plugins.min.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="<?= base_url('public/assets/porto') ?>/js/theme.js"></script>

	<!-- Current Page Vendor and Views -->
	<script src="<?= base_url('public/assets/porto') ?>/js/views/view.landing.js"></script>

	<!-- Theme Custom -->
	<script src="<?= base_url('public/assets/porto') ?>/js/custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="<?= base_url('public/assets/porto') ?>/js/theme.init.js"></script>
	<?= $this->renderSection('script') ?>

</body>

</html>
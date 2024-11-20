<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Basic -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= isset($seo) ? $seo['title'] : '' ?></title>

	<meta name="keywords" content="<?= isset($seo) ? $seo['keywords'] : '' ?>" />
	<meta name="description" content="<?= isset($seo) ? $seo['description'] : '' ?>">
	<meta name="author" content="<?= isset($seo) ? $seo['author'] : '' ?>">

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

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?= base_url('uploads/settings/home/' . $settings['favicon']) ?>" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?= base_url('uploads/settings/home/' . $settings['favicon']) ?>">

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="<?= base_url('public/assets/porto') ?>/css/custom.css">
	<style>
		.page-header.page-header-modern.page-header-background.page-header-background-md {
			padding: 50px 0;
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
		<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 45, 'stickySetTop': '-4px', 'stickyChangeLogo': true}">
			<div class="header-body">
				<div class="header-container container">
					<div class="header-row">
						<div class="header-column">
							<div class="header-row">
								<div class="header-logo">
									<a href="<?= base_url('/') ?>">
										<img alt="logo" src="<?= base_url('uploads/settings/home/' . $settings['logo']) ?>" class="opacity-9 p-2" width="200" data-plugin-options="{'appearEffect': 'fadeIn'}">
									</a>
								</div>
							</div>
						</div>
						<div class="header-column justify-content-end">
							<div class="header-row pt-3">
								<nav class="header-nav-top">
									<ul class="nav nav-pills">
										<li class="nav-item nav-item-anim-icon d-none d-md-block">
											<a class="nav-link ps-0" href="<?= base_url('blogs') ?>"><i class="fas fa-angle-right"></i> Blogs</a>
										</li>
										<li class="nav-item nav-item-anim-icon d-none d-md-block">
											<a class="nav-link" href="<?= base_url('contact') ?>"><i class="fas fa-angle-right"></i> Contact Us</a>
										</li>
										<li class="nav-item nav-item-left-border nav-item-left-border-remove nav-item-left-border-md-show">
											<span class="ws-nowrap"><i class="fas fa-phone"></i><?= $settings['contact_no_one'] ?></span>
										</li>
									</ul>
								</nav>
								<div class="header-nav-features">

								</div>
							</div>
							<div class="header-row">
								<div class="header-nav pt-1">
									<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
										<nav class="collapse">
											<ul class="nav nav-pills" id="mainNav">
												<li class="dropdown">
													<a class="dropdown-item dropdown-toggle <?= ($current == 'home') ? 'active' : '' ?>" href="<?= base_url('/') ?>">
														Home
													</a>
												</li>
												<li class="dropdown">
													<a class="dropdown-item dropdown-toggle <?= ($current == 'about') ? 'active' : '' ?>" href="<?= base_url('/about') ?>">
														About
													</a>
												</li>
												<li class="dropdown">
													<a class="dropdown-item dropdown-toggle <?= ($current == 'services') ? 'active' : '' ?>" href="<?= base_url('/services') ?>">
														Services
													</a>
												</li>
												<li class="dropdown">
													<a class="dropdown-item dropdown-toggle <?= ($current == 'galleries') ? 'active' : '' ?>" href="<?= base_url('/galleries') ?>">
														Gallery
													</a>
												</li>
												<li class="dropdown">
													<a class="dropdown-item dropdown-toggle <?= ($current == 'testimonials') ? 'active' : '' ?>" href="<?= base_url('/testimonials') ?>">
														Testimonial
													</a>
												</li>
												<li class="dropdown">
													<a class="dropdown-item dropdown-toggle <?= ($current == 'enquiry') ? 'active' : '' ?>" href="<?= base_url('/enquiry') ?>">
														Enquiry
													</a>
												</li>
											</ul>
										</nav>
									</div>
									<ul class="header-social-icons social-icons d-none d-sm-block">
										<?php if ($settings['facebook_link'] != '#') { ?>
											<li class="social-icons-facebook"><a href="<?= $settings['facebook_link'] ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
										<?php } ?>
										<?php if ($settings['twitter_link'] != '#') { ?>
											<li class="social-icons-twitter"><a href="<?= $settings['twitter_link'] ?>" target="_blank" title="Twitter"><i class="fab fa-x-twitter"></i></a></li>
										<?php } ?>
										<?php if ($settings['instagram_link'] != '#') { ?>
											<li class="social-icons-instagram"><a href="<?= $settings['instagram_link'] ?>" target="_blank" title="Linkedin"><i class="fab fa-instagram"></i></a></li>
										<?php } ?>
										<?php if ($settings['youtube_link'] != '#') { ?>
											<li class="social-icons-youtube"><a href="<?= $settings['youtube_link'] ?>" target="_blank" title="youtube"><i class="fab fa-youtube"></i></a></li>
										<?php } ?>
										<?php if ($settings['telegram_link'] != '#') { ?>
											<li class="social-icons-twitter"><a href="<?= $settings['telegram_link'] ?>" target="_blank" title="telegram"><i class="fab fa-telegram"></i></a></li>
										<?php } ?>
									</ul>
									<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
										<i class="fas fa-bars"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div role="main" class="main">
			<?= $this->renderSection('body') ?>
			<!-- WhatsApp Floating Button -->
			<a href="https://wa.me/<?= $settings['whatsapp_number'] ?>" target="_blank" class="whatsapp-btn">
				<i class="fab fa-whatsapp"></i>
			</a>
		</div>
		<footer id="footer">
			<div class="container">
				<div class="footer-ribbon">
					<span>Get in Touch</span>
				</div>
				<div class="row py-5 my-4">
					<div class="col-md-6 col-lg-4 mb-4 mb-md-0">
						<div class="contact-details">
							<h5 class="text-3 mb-3">CONTACT US</h5>
							<ul class="list list-icons list-icons-lg">
								<li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i>
									<p class="m-0"><?= $settings['contact_address'] ?></p>
								</li>
								<li class="mb-1"><i class="fab fa-whatsapp text-color-primary"></i>
									<p class="m-0"><a href="tel:<?= $settings['contact_no_one'] ?>"><?= $settings['contact_no_one'] ?></a></p>
								</li>
								<li class="mb-1"><i class="far fa-envelope text-color-primary"></i>
									<p class="m-0"><a href="mailto:<?= $settings['contact_email'] ?>"><?= $settings['contact_email'] ?></a></p>
								</li>
								<li class="mb-1"><i class="fa-regular fa-clock"></i>
									<p class="m-0"><b>Working Hours: </b><br /><?= $settings['working_hours'] ?></p>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
						<div class="contact-details">
							<h5 class="text-3 mb-3">Quick Links</h5>
							<ul class="list list-icons list-icons-lg">
								<li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i>
									<p class="m-0"><a href="<?= base_url('/') ?>"> Home</a></p>
								</li>
								<li class="mb-1"><i class="fab fa-whatsapp text-color-primary"></i>
									<p class="m-0"><a href="<?= base_url('blogs') ?>"> Blog</a></p>
								</li>
								<li class="mb-1"><i class="far fa-envelope text-color-primary"></i>
									<p class="m-0"><a href="<?= base_url('contact') ?>"> Contact Us</a></p>
								</li>
								<li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i>
									<p class="m-0"><a href="<?= base_url('legal/refund') ?>"> Refund</a></p>
								</li>
								<li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i>
									<p class="m-0"><a href="<?= base_url('legal/policy') ?>"> Privacy Policy</a></p>
								</li>
								<li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i>
									<p class="m-0"><a href="<?= base_url('legal/terms') ?>"> Terms & Conditions</a></p>
								</li>
								<li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i>
									<p class="m-0"><a href="<?= base_url('legal/disclaimer') ?>"> Disclaimer</a></p>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
						<h5 class="text-3 mb-3">BLOG CATEGORIES</h5>
						<ul class="list-unstyled mb-0">
							<?php foreach ($allcategories as $cat) { ?>
								<li class="mb-2 pb-1">
									<a href="<?= base_url('category/' . $cat['slug']) ?>">
										<p class="text-3 text-color-light opacity-8 mb-0"><i class="fas fa-angle-right text-color-primary"></i><strong class="ms-2 font-weight-semibold"><?= $cat['title'] ?></strong></p>
									</a>
								</li>
							<?php } ?>
						</ul>
					</div>

					<div class="col-md-6 col-lg-2">
						<h5 class="text-3 mb-3">FOLLOW US</h5>
						<ul class="social-icons">
							<?php if ($settings['facebook_link'] != '#') { ?>
								<li class="social-icons-facebook"><a href="<?= $settings['facebook_link'] ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
							<?php } ?>
							<?php if ($settings['twitter_link'] != '#') { ?>
								<li class="social-icons-twitter"><a href="<?= $settings['twitter_link'] ?>" target="_blank" title="Twitter"><i class="fab fa-x-twitter"></i></a></li>
							<?php } ?>
							<?php if ($settings['instagram_link'] != '#') { ?>
								<li class="social-icons-instagram"><a href="<?= $settings['instagram_link'] ?>" target="_blank" title="Linkedin"><i class="fab fa-instagram"></i></a></li>
							<?php } ?>
							<?php if ($settings['youtube_link'] != '#') { ?>
								<li class="social-icons-youtube"><a href="<?= $settings['youtube_link'] ?>" target="_blank" title="youtube"><i class="fab fa-youtube"></i></a></li>
							<?php } ?>
							<?php if ($settings['telegram_link'] != '#') { ?>
								<li class="social-icons-twitter"><a href="<?= $settings['telegram_link'] ?>" target="_blank" title="telegram"><i class="fab fa-telegram"></i></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container py-2">
					<div class="row py-4">
						<div class="col-lg-3 bg-light d-flex align-items-center justify-content-center justify-content-lg-start mb-2 mb-lg-0">
							<a href="<?= base_url('/') ?>" class="logo pe-0 pe-lg-3">
								<img alt="logo" src="<?= base_url('uploads/settings/home/' . $settings['logo']) ?>" class="opacity-9 p-2" width="200" data-plugin-options="{'appearEffect': 'fadeIn'}">
							</a>
						</div>
						<div class="col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start mb-4 mb-lg-0">
							<p>© Copyright 2024. All Rights Reserved.</p>
						</div>
						<div class="col-lg-2 d-flex align-items-center justify-content-center justify-content-lg-end">

						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>

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
	<?= $this->renderSection('scripts') ?>

</body>

</html>
<?= $this->extend('layouts/admindash') ?>

<?= $this->section('body') ?>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1"><i class="fas fa-sliders-h text-primary me-2"></i>Global CMS Settings & Custom Code</h3>
            <p class="text-muted small mb-0">Configure global metadata, inject custom CSS styles, and add header/footer JavaScript (Analytics, Pixels, Chat widgets).</p>
        </div>
        <a href="<?= base_url() ?>" target="_blank" class="btn btn-outline-secondary">
            <i class="fas fa-external-link-alt me-1"></i> Preview Live Site
        </a>
    </div>

    <?php if (session()->getFlashdata('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> <?= session()->getFlashdata('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-1"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <form action="<?= base_url('admin/settings/update') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="row g-4">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white py-3">
                        <ul class="nav nav-tabs card-header-tabs" id="settingsTabs">
                            <li class="nav-item">
                                <button class="nav-link active fw-bold" data-bs-toggle="tab" data-bs-target="#tab-site" type="button">
                                    <i class="fas fa-globe text-primary me-1"></i> General Site Info
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link fw-bold" data-bs-toggle="tab" data-bs-target="#tab-css" type="button">
                                    <i class="fab fa-css3-alt text-info me-1"></i> Custom Header CSS
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link fw-bold" data-bs-toggle="tab" data-bs-target="#tab-header-js" type="button">
                                    <i class="fab fa-js-square text-warning me-1"></i> Custom Header JS (Analytics)
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link fw-bold" data-bs-toggle="tab" data-bs-target="#tab-footer-js" type="button">
                                    <i class="fas fa-code text-success me-1"></i> Custom Footer JS (Widgets)
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body p-4">
                        <div class="tab-content">
                            <!-- 1. Site Info Tab -->
                            <div class="tab-pane fade show active" id="tab-site">
                                <h5 class="fw-bold text-dark mb-3">General Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Site Title</label>
                                        <input type="text" name="site_title" class="form-control" value="<?= esc($settings['site_title'] ?? 'SLCMS v1') ?>" placeholder="e.g. My Awesome CMS">
                                        <small class="text-muted">Displayed in the browser title bar and SEO metadata.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Site Tagline</label>
                                        <input type="text" name="site_tagline" class="form-control" value="<?= esc($settings['site_tagline'] ?? '') ?>" placeholder="e.g. Lightweight & Pluggable CMS">
                                        <small class="text-muted">Short slogan or description.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Custom Header CSS Tab -->
                            <div class="tab-pane fade" id="tab-css">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h5 class="fw-bold text-dark mb-0"><i class="fab fa-css3-alt text-info me-2"></i>Custom Header CSS</h5>
                                        <small class="text-muted">Injected automatically into <code>&lt;head&gt;&lt;style&gt;...&lt;/style&gt;&lt;/head&gt;</code> on all frontend pages.</small>
                                    </div>
                                </div>
                                <div class="border rounded-3 overflow-hidden mt-3">
                                    <textarea name="custom_header_css" class="form-control font-mono p-3 bg-dark text-light border-0" rows="12" placeholder="/* Write custom CSS rules here without <style> tags */
body {
    /* custom background or font */
}"><?= esc($settings['custom_header_css'] ?? '') ?></textarea>
                                </div>
                            </div>

                            <!-- 3. Custom Header JS Tab -->
                            <div class="tab-pane fade" id="tab-header-js">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h5 class="fw-bold text-dark mb-0"><i class="fab fa-js-square text-warning me-2"></i>Custom Header Scripts</h5>
                                        <small class="text-muted">Injected into <code>&lt;head&gt;</code>. Ideal for Google Analytics (gtag.js), Meta Pixel, or Google Tag Manager.</small>
                                    </div>
                                </div>
                                <div class="border rounded-3 overflow-hidden mt-3">
                                    <textarea name="custom_header_js" class="form-control font-mono p-3 bg-dark text-light border-0" rows="12" placeholder="<!-- Paste tracking scripts including <script> tags here -->
<script async src='https://www.googletagmanager.com/gtag/js?id=G-XXXXX'></script>"><?= esc($settings['custom_header_js'] ?? '') ?></textarea>
                                </div>
                            </div>

                            <!-- 4. Custom Footer JS Tab -->
                            <div class="tab-pane fade" id="tab-footer-js">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h5 class="fw-bold text-dark mb-0"><i class="fas fa-code text-success me-2"></i>Custom Footer Scripts</h5>
                                        <small class="text-muted">Injected right before <code>&lt;/body&gt;</code>. Ideal for chat widgets (Tawk.to, WhatsApp, Crisp) or custom jQuery functions.</small>
                                    </div>
                                </div>
                                <div class="border rounded-3 overflow-hidden mt-3">
                                    <textarea name="custom_footer_js" class="form-control font-mono p-3 bg-dark text-light border-0" rows="12" placeholder="<!-- Paste chat widgets or custom JS right before closing </body> -->
<script>
    console.log('SLCMS Custom Footer Script Loaded');
</script>"><?= esc($settings['custom_footer_js'] ?? '') ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 mt-4 border-top d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary fw-bold px-4 py-2">
                                <i class="fas fa-save me-1"></i> Save Global Settings
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

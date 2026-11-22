<?= $this->extend("layouts/admindash") ?>

<?= $this->section("body") ?>
<div class="container-fluid">
    <div class="row">
        <?php if (session()->get('message') != "") { ?>
        <div class="alert alert-<?= session()->get('mtype') ?? 'info' ?> alert-dismissible fade show col-12" role="alert">
            <?= session()->get('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>

        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary"><strong><i class="fas fa-plug me-2"></i>Installed Plugins & Addons</strong></h5>
                    <div>
                        <a href="<?= base_url('admin/marketplace') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-store me-1"></i>Plugin Marketplace
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty($plugins) && count($plugins) > 0) { ?>
                        <div class="row g-4">
                            <?php foreach ($plugins as $plugin) { ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border shadow-none">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="card-title fw-bold text-dark mb-0"><?= esc($plugin['name']) ?></h6>
                                                <span class="badge <?= $plugin['isActive'] ? 'bg-success' : 'bg-secondary' ?>">
                                                    <?= $plugin['isActive'] ? 'Active' : 'Inactive' ?>
                                                </span>
                                            </div>
                                            <p class="text-muted small mb-3"><?= esc($plugin['description']) ?></p>
                                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                                <small class="text-muted">v<?= esc($plugin['version']) ?> by <?= esc($plugin['author']) ?></small>
                                                <div>
                                                    <?php if ($plugin['isActive']) { ?>
                                                        <a href="<?= base_url('addons/' . $plugin['slug']) ?>" class="btn btn-sm btn-outline-primary me-1" target="_blank">
                                                            <i class="fas fa-external-link-alt"></i> Open
                                                        </a>
                                                        <a href="<?= base_url('admin/plugins/deactivate/' . $plugin['slug']) ?>" class="btn btn-sm btn-outline-warning">
                                                            Deactivate
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="<?= base_url('admin/plugins/activate/' . $plugin['slug']) ?>" class="btn btn-sm btn-success">
                                                            Activate
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="text-center py-5">
                            <i class="fas fa-puzzle-piece fa-3x text-muted mb-3 d-block"></i>
                            <h5 class="fw-bold text-secondary">No plugins installed yet</h5>
                            <p class="text-muted small mb-3">Expand your SLCMS features by exploring community plugins from the Marketplace.</p>
                            <a href="<?= base_url('admin/marketplace') ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-store me-1"></i>Explore Marketplace
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

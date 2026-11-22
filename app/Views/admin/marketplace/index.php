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
            <!-- Header Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body py-4 d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-primary fw-bold"><i class="fas fa-store me-2"></i>SLCMS Plugin Marketplace & Ecosystem</h4>
                        <p class="text-muted small mb-0">Browse, install, and extend SLCMS with community and official plugins</p>
                    </div>
                    <div class="mt-3 mt-md-0">
                        <ul class="nav nav-pills" id="marketplaceTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active fw-bold" id="catalog-tab" data-bs-toggle="pill" data-bs-target="#catalog" type="button" role="tab">
                                    <i class="fas fa-globe me-1"></i>Online Catalog (<?= count($catalog) ?>)
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold" id="installed-tab" data-bs-toggle="pill" data-bs-target="#installed" type="button" role="tab">
                                    <i class="fas fa-cubes me-1"></i>Installed (<?= count($installed) ?>)
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold" id="upload-tab" data-bs-toggle="pill" data-bs-target="#upload" type="button" role="tab">
                                    <i class="fas fa-file-archive me-1"></i>Upload ZIP
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content" id="marketplaceTabContent">
                <!-- 1. Catalog Tab -->
                <div class="tab-pane fade show active" id="catalog" role="tabpanel">
                    <div class="row g-4">
                        <?php foreach ($catalog as $item) { ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border shadow-sm">
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-primary text-white rounded-3 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-<?= esc($item['icon']) ?> fa-lg"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0 text-dark"><?= esc($item['name']) ?></h6>
                                                <span class="badge bg-light text-secondary border"><?= esc($item['category']) ?></span>
                                            </div>
                                        </div>

                                        <p class="text-muted small flex-grow-1"><?= esc($item['description']) ?></p>

                                        <div class="d-flex justify-content-between align-items-center text-muted small py-2 border-top border-bottom mb-3">
                                            <span><i class="fas fa-star text-warning me-1"></i><?= $item['rating'] ?></span>
                                            <span><i class="fas fa-download me-1"></i><?= $item['downloads'] ?></span>
                                            <span class="badge bg-success-subtle text-success"><?= $item['price'] ?></span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">by <a href="<?= esc($item['author_url']) ?>" target="_blank" class="text-decoration-none"><?= esc($item['author']) ?></a></small>
                                            <div>
                                                <?php if ($item['is_installed']) { ?>
                                                    <span class="badge bg-success py-2 px-3"><i class="fas fa-check me-1"></i>Installed</span>
                                                <?php } else { ?>
                                                    <a href="<?= base_url('admin/marketplace/install/' . $item['slug']) ?>" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-download me-1"></i>Install Now
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- 2. Installed Tab -->
                <div class="tab-pane fade" id="installed" role="tabpanel">
                    <div class="card shadow-sm border">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Plugin Name</th>
                                        <th>Slug</th>
                                        <th>Version</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th style="width: 200px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($installed) && count($installed) > 0) { ?>
                                        <?php foreach ($installed as $p) { ?>
                                            <tr>
                                                <td>
                                                    <i class="fas fa-<?= esc($p['icon'] ?: 'plug') ?> text-primary me-2"></i>
                                                    <strong><?= esc($p['name']) ?></strong>
                                                </td>
                                                <td><code><?= esc($p['slug']) ?></code></td>
                                                <td>v<?= esc($p['version']) ?></td>
                                                <td><?= esc($p['author']) ?></td>
                                                <td><span class="badge bg-light text-dark border"><?= esc($p['category']) ?></span></td>
                                                <td>
                                                    <?php if ($p['is_active']) { ?>
                                                        <span class="badge bg-success">Active</span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($p['is_active']) { ?>
                                                        <a href="<?= base_url('admin/marketplace/deactivate/' . $p['slug']) ?>" class="btn btn-sm btn-outline-warning me-1">
                                                            Deactivate
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="<?= base_url('admin/marketplace/activate/' . $p['slug']) ?>" class="btn btn-sm btn-success me-1">
                                                            Activate
                                                        </a>
                                                    <?php } ?>
                                                    <a href="<?= base_url('admin/marketplace/uninstall/' . $p['slug']) ?>" 
                                                       class="btn btn-sm btn-outline-danger" 
                                                       onclick="return confirm('Are you sure you want to uninstall and remove plugin \'<?= esc($p['name']) ?>\'?')"
                                                       title="Delete Plugin">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="7" class="text-center py-4 text-muted">
                                                <i class="fas fa-box-open fa-2x mb-2 d-block text-secondary"></i>
                                                No plugins installed yet. Explore the <strong>Online Catalog</strong> to get started!
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- 3. Upload Tab -->
                <div class="tab-pane fade" id="upload" role="tabpanel">
                    <div class="card shadow-sm border col-lg-8 mx-auto">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-cloud-upload-alt text-primary me-2"></i>Upload Plugin ZIP Package</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="<?= base_url('admin/marketplace/upload') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="mb-4">
                                    <label class="form-label font-weight-bold">Select Plugin Package (.ZIP)</label>
                                    <input type="file" name="plugin_zip" class="form-control form-control-lg" accept=".zip" required>
                                    <div class="form-text">
                                        The ZIP archive must contain a valid <code>plugin.json</code> manifest file in its root.
                                    </div>
                                </div>

                                <div class="alert alert-info border-0 rounded-3 small">
                                    <h6 class="fw-bold mb-1"><i class="fas fa-info-circle me-1"></i>Developer Manifest Standard:</h6>
                                    <code>plugin.json</code> example:
                                    <pre class="mb-0 mt-2 text-dark bg-white p-2 rounded"><code>{
  "name": "My Custom Plugin",
  "version": "1.0.0",
  "description": "Adds custom features to SLCMS.",
  "author": "Your Name",
  "icon": "cog",
  "category": "Utilities"
}</code></pre>
                                </div>

                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-upload me-1"></i>Upload & Install Plugin
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->extend('layouts/admindash') ?>

<?= $this->section('body') ?>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1"><i class="fas fa-file-alt text-success me-2"></i>Custom Pages Manager</h3>
            <p class="text-muted small mb-0">Create and manage dynamic static pages (About Us, Terms, Privacy Policy, Landing pages).</p>
        </div>
        <a href="<?= base_url('admin/pages/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add New Page
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

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Page Title</th>
                            <th>Slug / URL</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th class="text-end" style="width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pages) && count($pages) > 0) : ?>
                            <?php $i = 1; foreach ($pages as $p) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>
                                        <strong class="text-dark"><?= esc($p['title']) ?></strong>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('page/' . esc($p['slug'])) ?>" target="_blank" class="font-mono text-decoration-none small">
                                            /page/<?= esc($p['slug']) ?> <i class="fas fa-external-link-alt fa-xs ms-1"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if ($p['is_published']) : ?>
                                            <a href="<?= base_url('admin/pages/toggle/' . $p['id']) ?>" class="badge bg-success text-decoration-none" title="Click to unpublish">
                                                <i class="fas fa-check me-1"></i> Published
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('admin/pages/toggle/' . $p['id']) ?>" class="badge bg-secondary text-decoration-none" title="Click to publish">
                                                <i class="fas fa-clock me-1"></i> Draft
                                            </a>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?= date('M j, Y H:i', strtotime($p['updated_at'] ?? $p['created_at'])) ?></small>
                                    </td>
                                    <td class="text-end">
                                        <a href="<?= base_url('page/' . esc($p['slug'])) ?>" target="_blank" class="btn btn-sm btn-outline-info me-1" title="View Live">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('admin/pages/edit/' . $p['id']) ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('admin/pages/delete/' . $p['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this page?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-file-alt fa-3x mb-3 text-secondary d-block"></i>
                                    <h5>No custom pages created yet</h5>
                                    <p class="small">Click "+ Add New Page" above to create your first page.</p>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

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
                    <h5 class="mb-0 text-primary"><strong><i class="fas fa-cubes me-2"></i>Installed CMS Modules</strong></h5>
                    <a href="<?= base_url('admin/generator') ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i>Create New Module
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-hover table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Module Name</th>
                                <th>Route Slug</th>
                                <th>DB Table</th>
                                <th>Controller</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 160px;">Created</th>
                                <th style="width: 180px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($modules) && count($modules) > 0) { ?>
                                <?php $i = 1; foreach ($modules as $m) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>
                                        <i class="fas fa-<?= esc($m['icon'] ?: 'folder') ?> text-primary me-2"></i>
                                        <strong><?= esc($m['name']) ?></strong>
                                    </td>
                                    <td><code>/admin/<?= esc($m['slug']) ?></code></td>
                                    <td><code><?= esc($m['table_name']) ?></code></td>
                                    <td><small class="text-muted"><?= esc($m['controller']) ?></small></td>
                                    <td>
                                        <?php if ($m['is_active']) { ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php } else { ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td><small class="text-muted"><?= date('d M Y, H:i', strtotime($m['created_at'] ?? 'now')) ?></small></td>
                                    <td>
                                        <a href="<?= base_url('admin/' . $m['slug']) ?>" class="btn btn-sm btn-outline-primary me-1" title="Open CRUD">
                                            <i class="fas fa-external-link-alt"></i> View
                                        </a>
                                        <a href="<?= base_url('admin/generator/delete/' . $m['id']) ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Are you sure you want to delete module \'<?= esc($m['name']) ?>\'? This will drop table \'<?= esc($m['table_name']) ?>\' and delete all files.')" 
                                           title="Delete Module">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="fas fa-box-open fa-3x mb-3 text-secondary d-block"></i>
                                        No custom modules installed yet.<br>
                                        <a href="<?= base_url('admin/generator') ?>" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus me-1"></i>Create First Module
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

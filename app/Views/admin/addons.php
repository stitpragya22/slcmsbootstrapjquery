<?= $this->extend("layouts/admindash") ?>

<?= $this->section("body") ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Plugin Management Dashboard</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($plugins as $plugin): ?>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <img src="<?= $plugin['thumbnail'] ?>" class="card-img-top" alt="<?= $plugin['name'] ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $plugin['name'] ?></h5>
                                        <a href="<?= base_url('addons/' . $plugin['name']) ?>" class="btn btn-primary me-2">View Plugin</a>
                                        <?php if ($plugin['isActive']): ?>
                                            <a href="<?= base_url('plugins/deactivate/' . $plugin['name']) ?>" class="btn btn-danger">Deactivate</a>
                                        <?php else: ?>
                                            <a href="<?= base_url('plugins/activate/' . $plugin['name']) ?>" class="btn btn-success">Activate</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

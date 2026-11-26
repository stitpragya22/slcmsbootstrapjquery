<?= $this->extend('layouts/theme') ?>

<?= $this->section('title') ?><?= esc($page['meta_title'] ?: $page['title']) ?> - SLCMS<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Page Header Banner -->
<section class="py-5 bg-white border-bottom">
    <div class="container py-3">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small text-muted">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><span class="text-muted">Pages</span></li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page"><?= esc($page['title']) ?></li>
            </ol>
        </nav>
        <h1 class="fw-bold text-dark mb-2"><?= esc($page['title']) ?></h1>
        <?php if (!empty($page['updated_at'])) : ?>
            <small class="text-muted"><i class="fas fa-clock me-1"></i>Last updated: <?= date('F j, Y', strtotime($page['updated_at'])) ?></small>
        <?php endif ?>
    </div>
</section>

<!-- Page Content Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-custom p-4 p-md-5">
                    <div class="page-body-content lh-lg">
                        <?= $page['content'] ?>
                    </div>

                    <div class="pt-4 mt-5 border-top d-flex justify-content-between align-items-center">
                        <a href="<?= base_url() ?>" class="btn btn-outline-secondary btn-sm">
                            &larr; Back to Home
                        </a>
                        <small class="text-muted">&copy; <?= date('Y') ?> SLCMS</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

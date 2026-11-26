<?= $this->extend('layouts/admindash') ?>

<?= $this->section('body') ?>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1"><i class="fas fa-plus-circle text-primary me-2"></i>Create New Custom Page</h3>
            <p class="text-muted small mb-0">Build a rich static or dynamic page for your website.</p>
        </div>
        <a href="<?= base_url('admin/pages') ?>" class="btn btn-outline-secondary">
            &larr; Back to Pages
        </a>
    </div>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger" role="alert">
            <h6 class="fw-bold"><i class="fas fa-exclamation-triangle me-1"></i> Please fix the following errors:</h6>
            <ul class="mb-0 small">
                <?php foreach ((array) session()->getFlashdata('errors') as $err) : ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form action="<?= base_url('admin/pages/store') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="row g-4">
            <!-- Left: Main Content & Title -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Page Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="pageTitle" class="form-control form-control-lg" placeholder="e.g. About Our Company" value="<?= old('title') ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Slug / URL Path <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted font-mono"><?= base_url('page/') ?>/</span>
                                <input type="text" name="slug" id="pageSlug" class="form-control font-mono" placeholder="about-our-company" value="<?= old('slug') ?>" required>
                            </div>
                            <small class="text-muted">Unique URL segment. Auto-generated from title, or customize manually.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Page Content (WYSIWYG)</label>
                            <textarea name="content" id="summernote" class="form-control" rows="12"><?= old('content') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Settings & SEO Meta -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white py-3 fw-bold">
                        <i class="fas fa-toggle-on text-primary me-2"></i>Publishing Options
                    </div>
                    <div class="card-body p-4">
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" name="is_published" id="publishCheck" value="1" checked>
                            <label class="form-check-label fw-bold" for="publishCheck">Publish Page Immediately</label>
                            <div class="small text-muted">If unchecked, this page will be saved as a private draft.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold py-2">
                                <i class="fas fa-save me-1"></i> Save & Publish Page
                            </button>
                            <a href="<?= base_url('admin/pages') ?>" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white py-3 fw-bold">
                        <i class="fas fa-search text-success me-2"></i>SEO & Meta Tags
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" placeholder="Search engine display title" value="<?= old('meta_title') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3" placeholder="Brief 150-160 character description..."><?= old('meta_description') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Auto slug generator from title
    document.getElementById('pageTitle').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('pageSlug').value = slug;
    });

    $(document).ready(function() {
        if ($('#summernote').length) {
            $('#summernote').summernote({
                height: 350,
                placeholder: 'Write your page content, insert images, format text, and embed videos here...'
            });
        }
    });
</script>
<?= $this->endSection() ?>

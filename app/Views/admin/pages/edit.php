<?= $this->extend('layouts/admindash') ?>

<?= $this->section('body') ?>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1"><i class="fas fa-edit text-primary me-2"></i>Edit Page: <?= esc($page['title']) ?></h3>
            <p class="text-muted small mb-0">Update content, SEO settings, or publish state.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('page/' . esc($page['slug'])) ?>" target="_blank" class="btn btn-outline-info">
                <i class="fas fa-external-link-alt me-1"></i> View Live
            </a>
            <a href="<?= base_url('admin/pages') ?>" class="btn btn-outline-secondary">
                &larr; Back to Pages
            </a>
        </div>
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

    <form action="<?= base_url('admin/pages/update/' . $page['id']) ?>" method="POST">
        <?= csrf_field() ?>

        <div class="row g-4">
            <!-- Left: Main Content & Title -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Page Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="pageTitle" class="form-control form-control-lg" placeholder="e.g. About Our Company" value="<?= old('title', $page['title']) ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Slug / URL Path <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted font-mono"><?= base_url('page/') ?>/</span>
                                <input type="text" name="slug" id="pageSlug" class="form-control font-mono" placeholder="about-our-company" value="<?= old('slug', $page['slug']) ?>" required>
                            </div>
                            <small class="text-muted">Unique URL segment.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Page Content (WYSIWYG)</label>
                            <textarea name="content" id="summernote" class="form-control" rows="12"><?= old('content', $page['content']) ?></textarea>
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
                            <input class="form-check-input" type="checkbox" name="is_published" id="publishCheck" value="1" <?= $page['is_published'] ? 'checked' : '' ?>>
                            <label class="form-check-label fw-bold" for="publishCheck">Page is Published</label>
                            <div class="small text-muted">Toggle off to unpublish and save as draft.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold py-2">
                                <i class="fas fa-save me-1"></i> Update Page
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
                            <input type="text" name="meta_title" class="form-control" placeholder="Search engine display title" value="<?= old('meta_title', $page['meta_title']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3" placeholder="Brief 150-160 character description..."><?= old('meta_description', $page['meta_description']) ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
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

<?= $this->extend('layouts/theme') ?>

<?= $this->section('title') ?>Frontend UI Starter Template - SLCMS<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<section class="py-5 bg-white border-bottom">
    <div class="container py-3">
        <div class="row align-items-center gy-4">
            <div class="col-lg-8">
                <div class="d-inline-flex align-items-center bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1 mb-3 small fw-bold">
                    <i class="fas fa-sparkles me-2"></i>Rapid UI Development Kit for Humans & AI
                </div>
                <h1 class="fw-bold text-dark mb-3">SLCMS Frontend Starter Theme</h1>
                <p class="lead text-muted mb-4">
                    A lightweight, ultra-fast frontend starter template pre-configured with modern CDNs (Bootstrap 5.3, jQuery 3.7, FontAwesome 6, SweetAlert2, Toastr). Scaffold production-grade pages in seconds.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-primary fw-bold px-4" onclick="triggerToast('success', 'Toast notification working flawlessly!')">
                        <i class="fas fa-bell me-2"></i>Test Toastr
                    </button>
                    <button class="btn btn-outline-primary fw-bold px-4" onclick="triggerSwal()">
                        <i class="fas fa-check-circle me-2"></i>Test SweetAlert2
                    </button>
                    <a href="<?= base_url('docs') ?>" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-book me-2"></i>Documentation
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-light">
                    <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-code text-primary me-2"></i>How to Use This Template:</h6>
                    <p class="small text-muted mb-2">Simply extend <code>layouts/theme</code> in any CodeIgniter 4 view:</p>
                    <pre class="bg-dark text-white p-3 rounded-3 small font-mono mb-0"><code>&lt;?= $this-&gt;extend('layouts/theme') ?&gt;

&lt;?= $this-&gt;section('content') ?&gt;
  &lt;!-- Your HTML / AI UI here --&gt;
&lt;?= $this-&gt;endSection() ?&gt;</code></pre>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Component Showcase Container -->
<div class="container py-5">

    <!-- 1. Stats Counter Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3 col-sm-6">
            <div class="card card-custom p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small fw-bold">TOTAL USERS</span>
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1"><i class="fas fa-arrow-up me-1"></i>+14%</span>
                </div>
                <h3 class="fw-bold mb-1">1,248</h3>
                <small class="text-muted">Active Shield accounts</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-custom p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small fw-bold">PLUGINS INSTALLED</span>
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1">Active</span>
                </div>
                <h3 class="fw-bold mb-1">4 Addons</h3>
                <small class="text-muted">Live modular plugins</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-custom p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small fw-bold">API STATUS</span>
                    <span class="badge bg-info-subtle text-info rounded-pill px-3 py-1">Healthy</span>
                </div>
                <h3 class="fw-bold mb-1">99.9%</h3>
                <small class="text-muted">Avg response &lt; 45ms</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-custom p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small fw-bold">FRAMEWORK</span>
                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1">CI 4.5.0</span>
                </div>
                <h3 class="fw-bold mb-1">PHP 8.2</h3>
                <small class="text-muted">Shield RBAC enabled</small>
            </div>
        </div>
    </div>

    <!-- 2. Interactive Form & Card Layout -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="card card-custom p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0"><i class="fas fa-edit text-primary me-2"></i>Form Starter Layout</h5>
                    <span class="badge bg-light text-dark border">Floating Labels</span>
                </div>

                <form onsubmit="handleDemoSubmit(event)">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="demoName" placeholder="Full Name" required>
                                <label for="demoName">Full Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="demoEmail" placeholder="name@example.com" required>
                                <label for="demoEmail">Email address</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select" id="demoRole">
                                    <option value="developer">Full Stack Developer</option>
                                    <option value="designer">UI/UX Designer</option>
                                    <option value="creator">Content Creator</option>
                                </select>
                                <label for="demoRole">Professional Role</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a message" id="demoComments" style="height: 100px;"></textarea>
                                <label for="demoComments">Brief Bio / Notes</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary fw-bold px-4 py-2">
                                <i class="fas fa-paper-plane me-1"></i> Submit Demo Form
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card card-custom p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0"><i class="fas fa-magic text-warning me-2"></i>Interactive SweetAlert & Modals</h5>
                    <span class="badge bg-light text-dark border">Pre-wired JS</span>
                </div>

                <p class="text-muted small mb-4">
                    All dialogs, alerts, and confirmations are pre-wired. No external setup or boilerplate code required.
                </p>

                <div class="d-grid gap-2">
                    <button class="btn btn-outline-success text-start py-3 px-4 rounded-3 d-flex align-items-center justify-content-between" onclick="triggerToast('success', 'Operation saved successfully!')">
                        <span><i class="fas fa-check-circle text-success me-2"></i>Success Toast Notification</span>
                        <small class="text-muted">Toastr</small>
                    </button>
                    <button class="btn btn-outline-danger text-start py-3 px-4 rounded-3 d-flex align-items-center justify-content-between" onclick="triggerToast('error', 'Something went wrong! Please try again.')">
                        <span><i class="fas fa-exclamation-triangle text-danger me-2"></i>Error Alert Toast</span>
                        <small class="text-muted">Toastr</small>
                    </button>
                    <button class="btn btn-outline-primary text-start py-3 px-4 rounded-3 d-flex align-items-center justify-content-between" onclick="confirmDemoAction()">
                        <span><i class="fas fa-question-circle text-primary me-2"></i>Async Confirmation Modal</span>
                        <small class="text-muted">SweetAlert2</small>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function triggerToast(type, msg) {
        if (type === 'success') {
            toastr.success(msg);
        } else if (type === 'error') {
            toastr.error(msg);
        } else if (type === 'info') {
            toastr.info(msg);
        }
    }

    function triggerSwal() {
        Swal.fire({
            title: 'Welcome to SLCMS Starter!',
            text: 'You have Bootstrap 5, jQuery 3.7, SweetAlert2, and Toastr fully loaded and ready to rock.',
            icon: 'info',
            confirmButtonText: 'Awesome!',
            confirmButtonColor: '#2563eb'
        });
    }

    function confirmDemoAction() {
        window.confirmAction('Delete this item?', 'This action cannot be undone and will test the global confirmation wrapper.')
            .then((result) => {
                if (result.isConfirmed) {
                    toastr.success('Item deleted successfully (Demo Simulation)!');
                }
            });
    }

    function handleDemoSubmit(e) {
        e.preventDefault();
        toastr.success('Form submitted successfully! (Pre-wired AJAX ready)');
    }
</script>
<?= $this->endSection() ?>

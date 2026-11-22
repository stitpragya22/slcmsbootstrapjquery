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
                    <h5 class="mb-0 text-primary"><strong><i class="fas fa-magic me-2"></i>Create New CRUD Module</strong></h5>
                    <a href="<?= base_url('admin/generator/modules') ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-cubes me-1"></i>View All Modules
                    </a>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('admin/generator/generate') ?>">
                        <?= csrf_field() ?>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">Module Name (Singular, No Spaces, e.g. Product, Employee)</label>
                                <input name="modulename" type="text" class="form-control" placeholder="e.g. Service" required>
                                <small class="text-muted">Primary key 'id' will be added automatically.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">Module Icon (FontAwesome)</label>
                                <select id="moduleicon" class="form-select select2" name="moduleicon" required>
                                    <?php foreach ($faicons as $k => $v) { ?>
                                        <option value="<?= $k ?>"><?= $v ?> (<?= $k ?>)</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 font-weight-bold">Module Fields</h6>
                            <div>
                                <button type="button" class="btn btn-sm btn-success me-2" onclick="addRow('tblClone')">
                                    <i class="fas fa-plus me-1"></i>Add Field
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="delRow('tblClone')">
                                    <i class="fas fa-minus me-1"></i>Remove Last
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle" id="tblClone">
                                <thead class="table-light">
                                    <tr>
                                        <th>Field / Column Name</th>
                                        <th>SQL Type</th>
                                        <th>HTML Input Type</th>
                                        <th>Required?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="col[]" class="form-control" placeholder="e.g. title" required>
                                        </td>
                                        <td>
                                            <select name="sqlType[]" class="form-select" required>
                                                <option value="varchar(255)">VARCHAR(255)</option>
                                                <option value="text">TEXT</option>
                                                <option value="int(11)">INT</option>
                                                <option value="bigint">BIGINT</option>
                                                <option value="decimal(10,2)">DECIMAL(10,2)</option>
                                                <option value="date">DATE</option>
                                                <option value="datetime">DATETIME</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="htmlType[]" class="form-select" onchange="getHtml(this);" required>
                                                <option value="text">Text Input</option>
                                                <option value="textarea">Textarea</option>
                                                <option value="number">Number</option>
                                                <option value="email">Email</option>
                                                <option value="image">Image Upload</option>
                                                <option value="file">File Upload</option>
                                                <option value="fixedselect">Fixed Select Options</option>
                                                <option value="dbselect">Model Select (Foreign Key)</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="htmlRequired[]" class="form-select" required>
                                                <option value="required">Yes</option>
                                                <option value="">No</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-save me-1"></i>Generate CRUD Module
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addRow(id) {
    var tbl = document.getElementById(id).getElementsByTagName('tbody')[0];
    var clone = tbl.rows[0].cloneNode(true);
    var inputs = clone.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }
    // Remove any dynamic inputs added to select cell
    var selects = clone.getElementsByTagName('select');
    var parent = selects[1].parentElement;
    while (parent.children.length > 1) {
        parent.removeChild(parent.lastChild);
    }
    tbl.appendChild(clone);
}

function delRow(id) {
    var tbl = document.getElementById(id).getElementsByTagName('tbody')[0];
    if (tbl.rows.length > 1) {
        tbl.deleteRow(tbl.rows.length - 1);
    }
}

function getHtml(sel) {
    var parent = sel.parentElement;
    while (parent.children.length > 1) {
        parent.removeChild(parent.lastChild);
    }
    if (sel.value === "fixedselect") {
        var node = document.createElement("textarea");
        node.name = "fixedselecthtmlType[]";
        node.className = "form-control mt-2";
        node.placeholder = "Enter key:value pairs separated by comma, e.g. active:Active,inactive:Inactive";
        node.required = true;
        parent.appendChild(node);
    } else if (sel.value === "dbselect") {
        var node = document.createElement("input");
        node.type = "text";
        node.name = "dbselecthtmlType[]";
        node.className = "form-control mt-2";
        node.placeholder = "ModelName,id_column,display_column e.g. CategoryModel,id,name";
        node.required = true;
        parent.appendChild(node);
    }
}
</script>
<?= $this->endSection() ?>

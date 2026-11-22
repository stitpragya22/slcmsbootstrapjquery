<?php

namespace App\Controllers;

use App\Controllers\Admin\BaseAdminController;
use App\Models\CmsModuleModel;

class Generator extends BaseAdminController
{
    public function index()
    {
        $faicons = FontAwaysome::getAllIcons();
        $data = [
            'faicons'     => $faicons,
            'currentMenu' => 'generator',
            'bread'       => 'CRUD Generator',
            'user'        => $this->currentUser,
        ];

        return view('admin/generator/create', $data);
    }

    public function modules()
    {
        $model = new CmsModuleModel();
        $modules = $model->orderBy('sort_order', 'ASC')->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'modules'     => $modules,
            'currentMenu' => 'modules',
            'bread'       => 'Manage Modules',
            'user'        => $this->currentUser,
        ];

        return view('admin/generator/modules', $data);
    }

    public function deleteModule($id)
    {
        $model = new CmsModuleModel();
        $module = $model->find($id);

        if (!$module) {
            $this->flashError('Module not found.');
            return redirect()->to(base_url('admin/generator/modules'));
        }

        // 1. Drop Database Table
        try {
            $forge = \Config\Database::forge();
            $forge->dropTable($module['table_name'], true);
        } catch (\Throwable $e) {
            log_message('error', 'Failed to drop table ' . $module['table_name'] . ': ' . $e->getMessage());
        }

        // 2. Delete Controller File
        $controllerFile = APPPATH . 'Controllers/' . $module['controller'] . '.php';
        if (file_exists($controllerFile)) {
            unlink($controllerFile);
        }

        // 3. Delete Model File
        $modelFile = APPPATH . 'Models/' . $module['model'] . '.php';
        if (file_exists($modelFile)) {
            unlink($modelFile);
        }

        // 4. Delete View Directory and files
        $viewDir = APPPATH . 'Views/admin/' . $module['slug'];
        if (is_dir($viewDir)) {
            $files = glob($viewDir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($viewDir);
        }

        // 5. Delete Module Record
        $model->delete($id);

        $this->flashSuccess('Module "' . $module['name'] . '" and its resources were deleted successfully.');
        return redirect()->to(base_url('admin/generator/modules'));
    }

    public function controllergenerate()
    {
        $rawName = trim((string) $this->request->getPost('modulename'));
        $name = ucfirst(preg_replace('/[^a-zA-Z0-9]/', '', $rawName));

        if (empty($name)) {
            $this->flashError('Module name is required and must contain only letters and numbers.');
            return redirect()->back()->withInput();
        }

        $slug = strtolower($name);
        $rawIcon = trim((string) ($this->request->getPost('moduleicon') ?? 'folder'));
        $icon = str_replace('fa-', '', $rawIcon);

        $moduleModel = new CmsModuleModel();
        if ($moduleModel->where('slug', $slug)->first()) {
            $this->flashError("A module with the slug '{$slug}' already exists. Please choose another name or delete the existing module.");
            return redirect()->back()->withInput();
        }

        $cols = $this->request->getPost('col') ?? [];
        $sqlTypes = $this->request->getPost('sqlType') ?? [];
        $htmlTypes = $this->request->getPost('htmlType') ?? [];
        $htmlRequireds = $this->request->getPost('htmlRequired') ?? [];
        $fixedSelectVals = $this->request->getPost('fixedselecthtmlType') ?? [];
        $dbSelectVals = $this->request->getPost('dbselecthtmlType') ?? [];

        if (empty($cols) || count($cols) === 0) {
            $this->flashError('Please define at least one field for this module.');
            return redirect()->back()->withInput();
        }

        // Forge Fields & Schema Setup
        $forge = \Config\Database::forge();
        $fieldsSchema = [
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
        ];

        $modelKeys = "'id'";
        $storeFields = '';
        $uploadFields = '';
        $fieldVariables = '';
        $tableHeads = '';
        $tableFields = '';
        $formFields = '';
        $selectDBModels = '';
        $selectDBModelsData = '';
        $fieldsMetadata = [];

        $fixedIndex = 0;
        $dbIndex = 0;

        for ($i = 0; $i < count($cols); $i++) {
            $colName = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower(trim($cols[$i])));
            if (empty($colName) || $colName === 'id') {
                continue;
            }

            $sqlType = strtolower(trim($sqlTypes[$i] ?? 'varchar(255)'));
            $htmlType = strtolower(trim($htmlTypes[$i] ?? 'text'));
            $isRequired = !empty($htmlRequireds[$i]) && $htmlRequireds[$i] === 'required';
            $requiredAttr = $isRequired ? 'required' : '';

            $options = [];
            if ($htmlType === 'fixedselect' && isset($fixedSelectVals[$fixedIndex])) {
                $rawOptions = explode(',', $fixedSelectVals[$fixedIndex]);
                foreach ($rawOptions as $opt) {
                    $opt = trim($opt);
                    if ($opt !== '') {
                        $parts = explode(':', $opt);
                        if (count($parts) === 2) {
                            $options[trim($parts[0])] = trim($parts[1]);
                        } else {
                            $options[$opt] = $opt;
                        }
                    }
                }
                $fixedIndex++;
            } elseif ($htmlType === 'dbselect' && isset($dbSelectVals[$dbIndex])) {
                $options = array_map('trim', explode(',', $dbSelectVals[$dbIndex]));
                $dbIndex++;
            }

            $fieldsMetadata[$colName] = [
                'sqlType'  => $sqlType,
                'htmlType' => $htmlType,
                'required' => $isRequired,
                'options'  => $options,
            ];

            // Map SQL types for Forge
            $fieldsSchema[$colName] = $this->parseForgeFieldType($sqlType);

            $modelKeys .= ", '{$colName}'";

            // Store fields vs Upload fields in Controller
            if ($htmlType === 'image') {
                $uploadFields .= "        if (\$uploaded = \$this->uploadImage('{$colName}', '{$slug}')) {\n";
                $uploadFields .= "            \$data['{$colName}'] = \$uploaded;\n";
                $uploadFields .= "        } elseif (\$id === 0 && '{$requiredAttr}' === 'required') {\n";
                $uploadFields .= "            \$this->flashError('The {$colName} image is required.');\n";
                $uploadFields .= "            return redirect()->back()->withInput();\n";
                $uploadFields .= "        }\n\n";
            } elseif ($htmlType === 'file') {
                $uploadFields .= "        if (\$uploaded = \$this->uploadFile('{$colName}', '{$slug}')) {\n";
                $uploadFields .= "            \$data['{$colName}'] = \$uploaded;\n";
                $uploadFields .= "        } elseif (\$id === 0 && '{$requiredAttr}' === 'required') {\n";
                $uploadFields .= "            \$this->flashError('The {$colName} file is required.');\n";
                $uploadFields .= "            return redirect()->back()->withInput();\n";
                $uploadFields .= "        }\n\n";
            } else {
                $storeFields .= "            '{$colName}' => \$this->request->getPost('{$colName}'),\n";
            }

            // View variable defaults
            $fieldVariables .= "    \${$colName} = (isset(\$CurrentRecord['{$colName}'])) ? \$CurrentRecord['{$colName}'] : '';\n";

            // Table headers and columns
            $colTitle = ucfirst(str_replace('_', ' ', $colName));
            $tableHeads .= "                            <th>{$colTitle}</th>\n";

            if ($htmlType === 'image') {
                $tableFields .= "                            <td>\n";
                $tableFields .= "                                <?php if (!empty(\$record['{$colName}'])) { ?>\n";
                $tableFields .= "                                    <img src=\"<?= base_url('uploads/{$slug}/' . \$record['{$colName}']) ?>\" style=\"max-height: 50px; border-radius: 4px;\" alt=\"{$colName}\">\n";
                $tableFields .= "                                <?php } ?>\n";
                $tableFields .= "                            </td>\n";
            } elseif ($htmlType === 'file') {
                $tableFields .= "                            <td>\n";
                $tableFields .= "                                <?php if (!empty(\$record['{$colName}'])) { ?>\n";
                $tableFields .= "                                    <a href=\"<?= base_url('uploads/{$slug}/' . \$record['{$colName}']) ?>\" target=\"_blank\" class=\"btn btn-sm btn-outline-secondary\"><i class=\"fas fa-download me-1\"></i>File</a>\n";
                $tableFields .= "                                <?php } ?>\n";
                $tableFields .= "                            </td>\n";
            } else {
                $tableFields .= "                            <td><?= esc(\$record['{$colName}']) ?></td>\n";
            }

            // Form inputs
            $formFields .= $this->buildFormFieldHtml($colName, $colTitle, $htmlType, $requiredAttr, $slug, $options);
        }

        // 1. Create DB Table with Forge
        try {
            $forge->addField($fieldsSchema);
            $forge->addPrimaryKey('id');
            $forge->createTable($slug, true);
        } catch (\Throwable $e) {
            $this->flashError('Failed to create database table: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }

        // 2. Generate Controller
        $tplBase = is_dir(FCPATH . 'templates') ? FCPATH . 'templates/' : ROOTPATH . 'public/templates/';
        $controllerTemplate = file_get_contents($tplBase . 'controller/Controller.html');
        $controllerContent = str_replace([
            '{ClassName}',
            '{ModelClassName}',
            '{StoreFields}',
            '{UploadFields}',
            '{Name}',
            '{folder}',
            '{SelectDBModels}',
            '{SelectDBModelsData}',
        ], [
            $name . 'Controller',
            $name . 'Model',
            rtrim($storeFields),
            rtrim($uploadFields),
            $name,
            $slug,
            $selectDBModels,
            $selectDBModelsData,
        ], $controllerTemplate);

        file_put_contents(APPPATH . 'Controllers/' . $name . 'Controller.php', $controllerContent);

        // 3. Generate Model
        $modelTemplate = file_get_contents($tplBase . 'model/Model.html');
        $modelContent = str_replace([
            '{ClassName}',
            '{Fields}',
            '{TableName}',
        ], [
            $name . 'Model',
            $modelKeys,
            $slug,
        ], $modelTemplate);

        file_put_contents(APPPATH . 'Models/' . $name . 'Model.php', $modelContent);

        // 4. Generate Views
        $viewTemplate = file_get_contents($tplBase . 'view/View.html');
        $viewContent = str_replace([
            '{Name}',
            '{folder}',
            '{fieldVariables}',
            '{TableHeads}',
            '{TableFields}',
            '{FormFields}',
        ], [
            $name,
            $slug,
            rtrim($fieldVariables),
            rtrim($tableHeads),
            rtrim($tableFields),
            rtrim($formFields),
        ], $viewTemplate);

        $viewDir = APPPATH . 'Views/admin/' . $slug;
        if (!is_dir($viewDir)) {
            mkdir($viewDir, 0755, true);
        }
        file_put_contents($viewDir . '/add_edit.php', $viewContent);

        // 5. Ensure Upload directory exists
        $uploadBase = is_dir(FCPATH . 'uploads') ? FCPATH . 'uploads/' : ROOTPATH . 'public/uploads/';
        $uploadDir = $uploadBase . $slug;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // 6. Register Module in cms_modules table (Zero File Mutation)
        $moduleModel->insert([
            'name'        => $name,
            'slug'        => $slug,
            'icon'        => $icon,
            'table_name'  => $slug,
            'controller'  => $name . 'Controller',
            'model'       => $name . 'Model',
            'fields_json' => json_encode($fieldsMetadata),
            'in_menu'     => 1,
            'sort_order'  => 0,
            'is_active'   => 1,
        ]);

        $this->flashSuccess("Module '{$name}' created successfully with modern zero-mutation routing!");
        return redirect()->to(base_url('admin/' . $slug));
    }

    private function parseForgeFieldType(string $sqlType): array
    {
        $sqlType = trim($sqlType);
        if (preg_match('/^varchar\((\d+)\)$/i', $sqlType, $m)) {
            return ['type' => 'VARCHAR', 'constraint' => (int) $m[1], 'null' => true];
        }
        if (preg_match('/^decimal\((\d+),(\d+)\)$/i', $sqlType, $m)) {
            return ['type' => 'DECIMAL', 'constraint' => "{$m[1]},{$m[2]}", 'null' => true];
        }
        if (preg_match('/^int/i', $sqlType)) {
            return ['type' => 'INT', 'constraint' => 11, 'null' => true];
        }
        if ($sqlType === 'bigint') {
            return ['type' => 'BIGINT', 'null' => true];
        }
        if ($sqlType === 'text') {
            return ['type' => 'TEXT', 'null' => true];
        }
        if ($sqlType === 'date') {
            return ['type' => 'DATE', 'null' => true];
        }
        if ($sqlType === 'datetime') {
            return ['type' => 'DATETIME', 'null' => true];
        }

        return ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true];
    }

    private function buildFormFieldHtml(string $col, string $title, string $type, string $req, string $slug, array $options = []): string
    {
        $reqAttr = $req ? 'required' : '';
        $reqStar = $req ? '<span class="text-danger">*</span>' : '';

        switch ($type) {
            case 'textarea':
                return <<<HTML
                    <div class="col-md-12">
                        <label for="{$col}" class="form-label font-weight-bold">{$title} {$reqStar}</label>
                        <textarea id="{$col}" name="{$col}" class="form-control" rows="3" {$reqAttr}><?= old('{$col}', \${$col}) ?></textarea>
                    </div>\n
HTML;

            case 'number':
                return <<<HTML
                    <div class="col-md-6">
                        <label for="{$col}" class="form-label font-weight-bold">{$title} {$reqStar}</label>
                        <input id="{$col}" name="{$col}" type="number" step="any" class="form-control" value="<?= old('{$col}', \${$col}) ?>" {$reqAttr}>
                    </div>\n
HTML;

            case 'email':
                return <<<HTML
                    <div class="col-md-6">
                        <label for="{$col}" class="form-label font-weight-bold">{$title} {$reqStar}</label>
                        <input id="{$col}" name="{$col}" type="email" class="form-control" value="<?= old('{$col}', \${$col}) ?>" {$reqAttr}>
                    </div>\n
HTML;

            case 'image':
                return <<<HTML
                    <div class="col-md-6">
                        <label for="{$col}" class="form-label font-weight-bold">{$title} {$reqStar}</label>
                        <input id="{$col}" name="{$col}" type="file" accept="image/*" class="form-control" <?= (!isset(\$CurrentRecord)) ? '{$reqAttr}' : '' ?>>
                        <?php if (isset(\$CurrentRecord) && !empty(\${$col})) { ?>
                            <div class="mt-2">
                                <img src="<?= base_url('uploads/{$slug}/' . \${$col}) ?>" style="max-height: 80px; border-radius: 4px;" alt="{$title}">
                                <small class="text-muted d-block">Leave blank to keep existing image</small>
                            </div>
                        <?php } ?>
                    </div>\n
HTML;

            case 'file':
                return <<<HTML
                    <div class="col-md-6">
                        <label for="{$col}" class="form-label font-weight-bold">{$title} {$reqStar}</label>
                        <input id="{$col}" name="{$col}" type="file" class="form-control" <?= (!isset(\$CurrentRecord)) ? '{$reqAttr}' : '' ?>>
                        <?php if (isset(\$CurrentRecord) && !empty(\${$col})) { ?>
                            <div class="mt-2">
                                <a href="<?= base_url('uploads/{$slug}/' . \${$col}) ?>" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="fas fa-download me-1"></i>Current File</a>
                                <small class="text-muted d-block">Leave blank to keep existing file</small>
                            </div>
                        <?php } ?>
                    </div>\n
HTML;

            case 'fixedselect':
                $optsHtml = "<option value=\"\">-- Select {$title} --</option>\n";
                foreach ($options as $k => $v) {
                    $optsHtml .= "                            <option value=\"{$k}\" <?= (\${$col} == '{$k}') ? 'selected' : '' ?>>{$v}</option>\n";
                }
                return <<<HTML
                    <div class="col-md-6">
                        <label for="{$col}" class="form-label font-weight-bold">{$title} {$reqStar}</label>
                        <select id="{$col}" name="{$col}" class="form-select" {$reqAttr}>
{$optsHtml}                        </select>
                    </div>\n
HTML;

            default:
                return <<<HTML
                    <div class="col-md-6">
                        <label for="{$col}" class="form-label font-weight-bold">{$title} {$reqStar}</label>
                        <input id="{$col}" name="{$col}" type="text" class="form-control" value="<?= old('{$col}', \${$col}) ?>" {$reqAttr}>
                    </div>\n
HTML;
        }
    }
}

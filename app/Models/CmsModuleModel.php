<?php

namespace App\Models;

use CodeIgniter\Model;

class CmsModuleModel extends Model
{
    protected $table            = 'cms_modules';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'name', 'slug', 'icon', 'table_name', 'controller', 'model',
        'fields_json', 'in_menu', 'sort_order', 'is_active', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
}

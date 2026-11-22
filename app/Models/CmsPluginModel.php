<?php

namespace App\Models;

use CodeIgniter\Model;

class CmsPluginModel extends Model
{
    protected $table            = 'cms_plugins';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'slug',
        'name',
        'version',
        'description',
        'author',
        'author_url',
        'icon',
        'category',
        'is_active',
        'settings_json',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
}

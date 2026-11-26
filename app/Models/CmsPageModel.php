<?php

namespace App\Models;

use CodeIgniter\Model;

class CmsPageModel extends Model
{
    protected $table            = 'cms_pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'is_published',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'title' => 'required|min_length[2]|max_length[255]',
        'slug'  => 'required|min_length[2]|max_length[255]|is_unique[cms_pages.slug,id,{id}]',
    ];
}

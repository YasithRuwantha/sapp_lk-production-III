<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LinkProjectExtensionFileModel extends Model
{
    protected $table      = 'link_project_extension_file';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['project_extension_id', 'file_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
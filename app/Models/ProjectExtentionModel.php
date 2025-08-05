<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectExtentionModel extends Model
{
    protected $table = 'project_extension';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['id', 'project_id', 'extentend_completion_date', 'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
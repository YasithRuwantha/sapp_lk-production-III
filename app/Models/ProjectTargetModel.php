<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectTargetModel extends Model
{
    protected $table = 'project_target';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['id', 'project_id', 'category_name', 'type', 'qty', 'target_amount', 'no_of_farmers'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectTargetItemModel extends Model
{
    protected $table = 'project_target_item';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['id', 'project_target_id', 'item_description', 'qty', 'amount'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
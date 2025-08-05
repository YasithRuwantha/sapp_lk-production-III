<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkProjectTargetUserModel extends Model
{
    protected $table = 'link_project_target_user';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['id', 'project_target_id', 'user_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
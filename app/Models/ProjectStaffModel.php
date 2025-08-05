<?php

namespace App\Models;
 
use CodeIgniter\Model;

class ProjectStaffModel extends Model
{
    protected $table      = 'link_project_staff';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['project_id', 'user_id', 'role'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
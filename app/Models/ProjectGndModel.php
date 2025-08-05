<?php

namespace App\Models;
 
use CodeIgniter\Model;

class ProjectGndModel extends Model
{
    protected $table      = 'link_project_gnd';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['project_id', 'gnd_id', 'role'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
<?php

namespace App\Models;
 
use CodeIgniter\Model;

class ResourcePersonModel extends Model
{
    protected $table      = 'resource_person';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['resource_name', 'designation', 'work_place', 'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
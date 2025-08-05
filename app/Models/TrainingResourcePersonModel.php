<?php

namespace App\Models;
 
use CodeIgniter\Model;

class TrainingResourcePersonModel extends Model
{
    protected $table      = 'training_resource_person';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_training', 'id_resource'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
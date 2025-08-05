<?php

namespace App\Models;
 
use CodeIgniter\Model;

class TrainingDocsModel extends Model
{
    protected $table      = 'training_docs';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_training', 'doc_type', 'doc_path', 'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
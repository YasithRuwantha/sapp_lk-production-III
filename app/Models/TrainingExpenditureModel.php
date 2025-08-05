<?php

namespace App\Models;
 
use CodeIgniter\Model;

class TrainingExpenditureModel extends Model
{
    protected $table      = 'training_expenditure';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_training', 'expenditure_type', 'amount'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
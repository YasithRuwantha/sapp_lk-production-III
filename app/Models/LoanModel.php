<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table      = 'loan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['project_id', 'type_of_loan_scheme', 'loan_scheme_name', 'main_purpose', 'sub_purpose', 'loan_requirement', 'loan_status', 'category'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LoanDisbursementStatusModel extends Model
{
    protected $table      = 'loan_disbursement_status';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['loan_disbursement_id', 'disbursement_status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
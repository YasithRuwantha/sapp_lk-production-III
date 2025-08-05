<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LoanDisbursementModel extends Model
{
    protected $table      = 'loan_disbursement';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['loan_id', 'loan_disbursement_entity', 'cbsl_reg_no', 'cbsl_reg_amount', 'required_loan_amount', 'actual_loan_amount','disbursement_status','loan_disbursement_date', 'remarks', 'refinance_date', 'refinance_amount'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
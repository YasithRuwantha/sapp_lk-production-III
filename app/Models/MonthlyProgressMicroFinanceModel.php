<?php

namespace App\Models;
 
use CodeIgniter\Model;

class MonthlyProgressMicroFinanceModel extends Model
{
    protected $table      = 'monthly_progress_micro_finance';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['monthly_progress_id', 'loans_applied_month', 'loans_reg_cbsl_month', 'no_loans_issued_month', 'loans_applied_cumilative', 'loans_reg_cbsl_cumilative', 'loans_issued_cumilative', 'loans_applied_lkr_month', 'loans_reg_cbsl_lkr_month', 'loans_issued_lkr_month', 'loans_applied_lkr_cumilative','loans_issued_lkr_cumilative','type_of_loan'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
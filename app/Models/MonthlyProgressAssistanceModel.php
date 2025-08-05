<?php

namespace App\Models;
 
use CodeIgniter\Model;

class MonthlyProgressAssistanceModel extends Model
{
    protected $table      = 'monthly_progress_assistance';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['monthly_progress_id', 'assistance_input', 'physical_progress_reporting_month', 'physical_progress_reporting_cumilative', 'financial_progress_reporting_month', 'financial_progress_reporting_cumilative', 'assistance_type'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
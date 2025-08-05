<?php

namespace App\Models;
 
use CodeIgniter\Model;

class MonthlyProgressReportModel extends Model
{
    protected $table      = 'monthly_progress_report';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['promoter_id', 'reporting_user_id', 'project_id', 'target_male', 'target_female', 'actual_male', 'actual_female', 'reg_farmers', 'target_farmers', 'actual_farmer', 'reporting_month'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
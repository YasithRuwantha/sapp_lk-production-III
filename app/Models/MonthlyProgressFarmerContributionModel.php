<?php

namespace App\Models;
 
use CodeIgniter\Model;

class MonthlyProgressFarmerContributionModel extends Model
{
    protected $table      = 'monthly_progress_farmer_contribution';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['monthly_progress_id', 'activity', 'other_activity', 'no_of_activity_reporting_month', 'estimated_cost_reporting_month', 'no_of_activity_cumilative', 'estimated_cost_cumilative'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
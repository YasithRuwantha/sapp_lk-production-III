<?php

namespace App\Models;
 
use CodeIgniter\Model;

class MonthlyProgressPurchaseFarmerModel extends Model
{
    protected $table      = 'monthly_progress_purchase_farmer_income';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['monthly_progress_id', 'produce', 'no_of_farmers', 'production_month', 'production_cumilative', 'amount_month', 'amount_cumilative', 'avg_income_predicted_bp'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
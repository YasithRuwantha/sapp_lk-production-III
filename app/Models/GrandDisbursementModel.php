<?php

namespace App\Models;
 
use CodeIgniter\Model;

class GrandDisbursementModel extends Model
{
    protected $table      = 'grant_disbursement';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['grant_id', 'farmer_category', 'farmer_id', 'remarks', 'total_grant_provided', 'max_grant_amount', 'max_credit_amount', 'disbursement_status', 'date_of_grant','schedule_by','schedule_on','disbursed_by','hold_by','hold_on','hold_reason'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
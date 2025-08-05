<?php

namespace App\Models;
 
use CodeIgniter\Model;

class OffFarmPaymentModel extends Model
{
    protected $table      = 'off_farm_payment';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['off_farm_development_id', 'payment_date', 'payment_amount', 'remarks', 'off_farm_activity_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
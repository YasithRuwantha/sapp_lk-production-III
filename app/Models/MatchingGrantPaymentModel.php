<?php

namespace App\Models;
 
use CodeIgniter\Model;

class MatchingGrantPaymentModel extends Model
{
    protected $table      = 'matching_grant_payment';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['matching_grant_development_id', 'payment_date', 'payment_amount', 'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
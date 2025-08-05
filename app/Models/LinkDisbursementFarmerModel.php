<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LinkDisbursementFarmerModel extends Model
{
    protected $table      = 'link_disbursement_farmer';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['loan_disbursement_id', 'user_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
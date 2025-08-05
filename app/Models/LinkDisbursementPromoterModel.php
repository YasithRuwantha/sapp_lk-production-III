<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LinkDisbursementPromoterModel extends Model
{
    protected $table      = 'link_disbursement_promoter';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['loan_disbursement_id', 'promoter_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
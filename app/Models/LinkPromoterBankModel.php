<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LinkPromoterBankModel extends Model
{
    protected $table      = 'link_promoter_bank';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['bank_details_id', 'promoter_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
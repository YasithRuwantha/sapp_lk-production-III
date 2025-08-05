<?php

namespace App\Models;

use CodeIgniter\Model;

class ContractExtentionModel extends Model
{
    protected $table = 'contract_extention';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['id', 'contract_id', 'extention_approved', 'extention_date', 'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
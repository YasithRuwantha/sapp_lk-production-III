<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffContractMgtModel extends Model
{
    protected $table = 'staff_contract_mgt';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'user_id', 'contract_effective_date', 'contract_expiary_date', 'contract_status', 'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
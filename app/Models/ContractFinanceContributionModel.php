<?php

namespace App\Models;

use CodeIgniter\Model;

class ContractFinanceContributionModel extends Model
{
    protected $table = 'contract_finance_contribution';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'contract_id', 'fianance_source', 'amount', 'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
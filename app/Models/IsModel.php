<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class IsModel extends Model
{
    protected $table = 'is';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'is_service_provider_id', 'project_id', 'promoter_id', 'contract_start_date', 'contract_end_date', 'benificiary_male', 'benificiary_female', 'benificiary_gender_not_specified', 'contract_amount', 'status', 'remark'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
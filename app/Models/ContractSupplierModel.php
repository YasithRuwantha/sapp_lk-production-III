<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class ContractSupplierModel extends Model
{
    protected $table = 'contract_supplier';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'name', 'reg_no', 'country_of_origin'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
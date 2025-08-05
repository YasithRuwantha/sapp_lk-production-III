<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class IsServiceProviderModel extends Model
{
    protected $table = 'is_service_provider';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'name_service_provider', 'address', 'name_in_charge', 'phone_in_charge', 'email_in_charge'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
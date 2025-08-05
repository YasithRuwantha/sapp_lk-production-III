<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class PromoterModel extends Model
{
    protected $table = 'promoter';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'business_type', 'org_name', 'business_registration_no', 'auth_officer_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
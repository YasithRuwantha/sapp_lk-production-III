<?php

namespace App\Models;
 
use CodeIgniter\Model;

class OffFarmActivityModel extends Model
{
    protected $table      = 'off_farm_activity';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['off_farm_development_id', 'activity', 'estimated_cost', 'agreed_amount', 'admin_cost', 'implementation_agency',  'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
<?php

namespace App\Models;
 
use CodeIgniter\Model;

class OwnerFixedAssertModel extends Model
{
    protected $table      = 'fixed_asset_owner';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['fixed_asset_registry_id', 'user_id', 'ownership_status', 'ownership_transfer_date', 'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
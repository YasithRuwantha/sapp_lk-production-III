<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class FarmerLandModel extends Model
{
    protected $table = 'farmer_land';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'farmer_id', 'land_extent', 'land_ownership'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
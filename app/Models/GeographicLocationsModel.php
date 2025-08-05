<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class GeographicLocationsModel extends Model
{
    protected $table = 'geographic_locations';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'entity_table', 'label', 'entity_id', 'lat', 'lng', 'altitude'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
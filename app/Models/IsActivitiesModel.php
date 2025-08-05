<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class IsActivitiesModel extends Model
{
    protected $table = 'is_activities';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'is_id', 'activity', 'deadline'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
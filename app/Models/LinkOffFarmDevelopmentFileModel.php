<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LinkOffFarmDevelopmentFileModel extends Model
{
    protected $table      = 'link_off_farm_development_file';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['off_farm_development_id', 'file_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
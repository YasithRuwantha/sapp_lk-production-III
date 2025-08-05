<?php

namespace App\Models;
 
use CodeIgniter\Model;

class EoiModel extends Model
{
    protected $table      = 'eoi';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['eoi_name', 'eoi_type', 'eoi_date', 'eoi_status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
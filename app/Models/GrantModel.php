<?php

namespace App\Models;
 
use CodeIgniter\Model;

class GrantModel extends Model
{
    protected $table      = 'grant';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['project_id', 'grant_name', 'grant_details', 'value'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
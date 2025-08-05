<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDesignationModel extends Model
{
    protected $table = 'user_designation';

//    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
//    protected $useSoftDeletes = true;

    protected $allowedFields = ['user_id', 'designation_id', 'start_on', 'end_on', 'is_delete'];

//    protected $useTimestamps = true;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';
}
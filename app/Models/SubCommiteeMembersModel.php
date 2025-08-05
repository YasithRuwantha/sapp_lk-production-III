<?php

namespace App\Models;
 
use CodeIgniter\Model;

class SubCommiteeMembersModel extends Model
{
    protected $table      = 'sub_commitee_members';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['first_name', 'last_name', 'designation', 'organization', 'category', 'status', 'sub_commitee'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
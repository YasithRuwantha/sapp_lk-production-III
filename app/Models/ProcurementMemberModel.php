<?php

namespace App\Models;
 
use CodeIgniter\Model;

class ProcurementMemberModel extends Model
{
    protected $table      = 'link_procurement_member';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['procurement_id', 'sub_commitee_id', 'category'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
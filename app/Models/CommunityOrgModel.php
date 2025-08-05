<?php

namespace App\Models;
 
use CodeIgniter\Model;

class CommunityOrgModel extends Model
{
    protected $table      = 'community_org';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['organization_name', 'org_type'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
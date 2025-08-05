<?php

namespace App\Models;
 
use CodeIgniter\Model;

class MatchingGrantDevelopmentModel extends Model
{
    protected $table      = 'matching_grant_development';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['matching_grant_dev_name', 'project_id', 'no_direct_benificiary', 'no_indirect_benificiary', 'estimated_cost', 'implementation_ajency', 'nsc_paper_id', 'status_nsc_approval', 'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
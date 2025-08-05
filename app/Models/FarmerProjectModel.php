<?php

namespace App\Models;
 
use CodeIgniter\Model;

class FarmerProjectModel extends Model
{
    protected $table      = 'farmer_project';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['farmer_id', 'project_id', 'contribution', 'purpose', 'project_status', 'eligible_status', 'pfi_ref_no', 'obtained_benifit'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
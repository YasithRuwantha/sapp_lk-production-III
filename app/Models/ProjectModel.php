<?php

namespace App\Models;
 
use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table      = 'project';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['project_name', 'project_type', 'address_no', 'address_street', 'address_city', 'lat', 'lon', 'project_incharge_id', 'est_loan_amount', 'total_loan_amount', 'project_status', 'start_date', 'end_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
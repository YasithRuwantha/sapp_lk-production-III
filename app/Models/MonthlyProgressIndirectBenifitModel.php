<?php

namespace App\Models;
 
use CodeIgniter\Model;

class MonthlyProgressIndirectBenifitModel extends Model
{
    protected $table      = 'monthly_progress_indirect_benifit';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['monthly_progress_id', 'benifit', 'reporting_month', 'cumilative'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
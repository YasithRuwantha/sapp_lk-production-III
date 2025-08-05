<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class TemplateModel extends Model
{
    protected $table = 'contract';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'contract_name', 'contract_number', 'procurement_discrption', 'supplier_id', 'date_of_signed', 'duration_months', 'respective_sapp_division', 'sapp_representive_id', 'prior_post_review', 'start_date', 'end_date', 'currency', 'ifad_financing', 'ifad_no_objection_no', 'contract_status', 'percentage_physical_progress', 'performance_evaluation', 'remarks', 'claimed_widrawal'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
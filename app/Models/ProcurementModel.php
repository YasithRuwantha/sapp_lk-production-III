<?php

namespace App\Models;
 
use CodeIgniter\Model;

class ProcurementModel extends Model
{
    protected $table      = 'procurement';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['procurement_name', 'title', 'type', 'project_id', 'budget', 'procurement_agency', 'advertize_date', 'opening_date', 'tec_report_submission_date', 'doc_considered', 'tec_consent', 'procurement_consent', 'no_objection', 'objection_remarks', 'source_of_financing','contractual_agreement','noc_obtained_date','awpb_code','tags','project_area','procurement_method_01','procurement_method_02','contract_award_date','agreement_signing_date','supplier_name','actual_amount'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
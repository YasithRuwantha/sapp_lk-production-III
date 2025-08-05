<?php

namespace App\Models;
 
use CodeIgniter\Model;

class EoiApplicationModel extends Model
{
    protected $table      = 'eoi_application';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['eoi_id', 'eoi_applicant_id', 'bp_application_acknowladgement_date', 'bp_reg_date', 'shortlist_date', 'shortlist_marks','initial_discussion_date','1st_imc_meeting_date','1st_imc_remarks','feasibility_study_visit_date','feasibility_study_completion_date','2nd_imc_meeting_date','2nd_imc_remarks','bp_submission_date','3rd_imc_meeting_date','3rd_imc_remarks','bpec_meeting_date','bpec_remarks','eoi_application_status','remarks','final_bp_submission_mc_date','bpec_approval_date','nsc_approval_date','ifad_approval_date','agreement_signed_date','implementation_start_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
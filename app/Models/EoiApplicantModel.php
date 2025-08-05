<?php

namespace App\Models;
 
use CodeIgniter\Model;

class EoiApplicantModel extends Model
{
    protected $table      = 'eoi_applicant';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['title_of_applicant', 'first_name', 'last_name', 'address', 'district_id', 'contact_no_land','contact_no_mobile','email','nature_of_business'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
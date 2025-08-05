<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class StaffMetaModel extends Model
{
    protected $table = 'staff_meta';

    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'user_id', 'title', 'designation', 'permanant_address_no', 'permanant_address_street', 'permanant_address_city', 'temp_address_no', 'temp_address_street', 'temp_address_city', 'emergency_contact', 'assigned_admin_region', 'assigned_admin_division', 'appointment_date', 'employee_no', 'employer_no', 'maritial_status', 'recruitment_type', 'phone_office', 'phone_extension', 'heighest_education_qualification', 'professional_membership', 'salary_scale', 'basic_salary', 'allowance', 'net_salary', 'employment_status', 'last_date_sapp'];
}
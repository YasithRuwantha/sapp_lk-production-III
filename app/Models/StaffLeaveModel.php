<?php

namespace App\Models;
 
use CodeIgniter\Model;

class StaffLeaveModel extends Model
{
    protected $table      = 'staff_leave';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['user_id', 'report_period', 'no_casual_leave', 'no_annual_leave', 'no_sick_leave', 'no_duty_leave', 'no_nopay_leave', 'no_lieu_leave', 'no_short_leave', 'hrs_overtime', 'no_ph_work'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
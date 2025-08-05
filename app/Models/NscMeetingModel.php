<?php

namespace App\Models;
 
use CodeIgniter\Model;

class NscMeetingModel extends Model
{
    protected $table      = 'nsc_meeting';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nsc_meeting_no', 'nsc_meeting_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
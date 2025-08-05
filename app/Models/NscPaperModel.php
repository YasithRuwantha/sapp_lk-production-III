<?php

namespace App\Models;
 
use CodeIgniter\Model;

class NscPaperModel extends Model
{
    protected $table      = 'nsc_paper';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nsc_meeting_id', 'nsc_paper_no', 'subject', 'matter_discussed'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
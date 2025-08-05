<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LinkNscSubCommiteeModel extends Model
{
    protected $table      = 'link_nsc_sub_commitee';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nsc_meeting_id', 'sub_commitee_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
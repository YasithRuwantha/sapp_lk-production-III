<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LinkNscPaperFileModel extends Model
{
    protected $table      = 'link_nsc_paper_file';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nsc_paper_id', 'file_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
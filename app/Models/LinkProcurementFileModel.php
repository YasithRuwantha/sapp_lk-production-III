<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LinkProcurementFileModel extends Model
{
    protected $table      = 'link_procurement_file';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['procurement_id', 'file_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
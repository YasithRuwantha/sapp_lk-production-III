<?php

namespace App\Models;

use CodeIgniter\Model;

class DocArchiveModel extends Model
{
    protected $table = 'doc_archive';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'category', 'project_id', 'description', 'uploaded_by'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
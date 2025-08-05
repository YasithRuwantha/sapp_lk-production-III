<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class LinkDocArchiveFileModel extends Model
{
    protected $table = 'link_doc_archive_file';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'doc_archive_id', 'file_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
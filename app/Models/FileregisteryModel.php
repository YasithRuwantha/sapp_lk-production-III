<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class FileregisteryModel extends Model
{
    protected $table = 'file_registry';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['added_on', 'ref_table', 'file_name', 'relative_path', 'status'];
}
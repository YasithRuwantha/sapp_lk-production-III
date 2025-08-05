<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class CdnregistryModel extends Model
{
    protected $table = 'ven_cdn_registery';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['bucket', 's3_path', 'reference', 'uploaded_date', 'status'];
}
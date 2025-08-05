<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkContractExtentionFileModel extends Model
{
    protected $table = 'link_contract_extention_file';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['id', 'contract_extention_id', 'file_id'];
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkStaffContractMgtFileModel extends Model
{
    protected $table = 'link_staff_contract_mgt_file';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'staff_contract_mgt_id', 'file_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
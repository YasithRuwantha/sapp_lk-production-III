<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $table      = 'bank_details';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['acc_no', 'bank_id', 'bank_code', 'branch', 'branch_code'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
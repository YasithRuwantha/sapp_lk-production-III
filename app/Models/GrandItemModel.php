<?php

namespace App\Models;

use CodeIgniter\Model;

class GrandItemModel extends Model
{
    protected $table      = 'grant_item_farmer';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['grant_disbursement_id', 'item_name', 'project_target_item_id', 'qty', 'price', 'supplier_name','status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
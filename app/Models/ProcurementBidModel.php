<?php

namespace App\Models;
 
use CodeIgniter\Model;

class ProcurementBidModel extends Model
{
    protected $table      = 'procurement_bid';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['item', 'supplier', 'cost', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
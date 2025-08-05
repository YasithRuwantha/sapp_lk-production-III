<?php

namespace App\Models;
 
use CodeIgniter\Model;

class LinkProcurementBidModel extends Model
{
    protected $table      = 'link_procurement_bid';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['procurement_id', 'bid_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
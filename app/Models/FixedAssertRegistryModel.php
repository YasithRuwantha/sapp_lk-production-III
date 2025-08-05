<?php

namespace App\Models;
 
use CodeIgniter\Model;

class FixedAssertRegistryModel extends Model
{
    protected $table      = 'fixed_asset_registry';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['sapp_serial_no', 'description', 'manufactor_serial_no', 'asset_code','type_of_asset', 'latest_working_status', 'remarks', 'price', 'folio_no', 'grn_no', 'supplier_name', 'purchased_by', 'disposal_date','disposal_remark','voucher_no'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
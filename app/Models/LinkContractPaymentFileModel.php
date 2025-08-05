<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkContractPaymentFileModel extends Model
{
    protected $table = 'link_contract_payment_file';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['id', 'contract_payment_id', 'file_id'];
}
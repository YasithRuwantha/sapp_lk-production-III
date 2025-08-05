<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class AccentryitemModel extends Model
{
    protected $table = 'ven_acc_entry_items';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['entity_id', 'ledger_id', 'amount', 'debit_credit'];
}
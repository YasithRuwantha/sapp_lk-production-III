<?php

namespace App\Models;

use CodeIgniter\Model;

class LedgerModel extends Model
{
    protected $table = 'ven_acc_ledgers';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['account_id', 'group_id', 'name', 'code', 'opening_balance', 'opening_balance_debit_credit', 'type', 'reconciliation', 'notes'];
}
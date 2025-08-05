<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class AccountModel extends Model
{
    protected $table = 'ven_account';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['label', 'account_owner', 'fy_start', 'fy_end', 'currency_symbol', 'date_format', 'status'];
}
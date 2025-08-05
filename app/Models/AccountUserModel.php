<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class AccountUserModel extends Model
{
    protected $table = 'ven_account_user';

    protected $primaryKey = ['account_id','user_id'];
    
    protected $allowedFields = ['account_id', 'user_id', 'start_date', 'end_date', 'priviledge'];
}
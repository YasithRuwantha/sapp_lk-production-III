<?php

namespace App\Models;

use CodeIgniter\Model;

class AccGroupModel extends Model
{
    protected $table = 'ven_acc_groups';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['account_id', 'parent_id', 'name', 'code', 'affects_gross'];
}
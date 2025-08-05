<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class AccentryModel extends Model
{
    protected $table = 'ven_acc_entries';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['entry_type_id', 'planned_date', 'paid_date', 'cr_total', 'dr_total', 'notes'];
}
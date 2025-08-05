<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class LibModel extends Model
{
    protected $table = 'wp_users';

    protected $primaryKey = 'ID';
    
    protected $allowedFields = ['user_login', 'user_nicename'];
}
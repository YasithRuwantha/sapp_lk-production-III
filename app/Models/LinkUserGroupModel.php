<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class LinkUserGroupModel extends Model
{
    protected $table = 'link_user_group';

    protected $primaryKey = ['group_id','user_id'];
    
    protected $allowedFields = ['group_id','user_id','start_at','end_at'];
}
<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class CountriesModel extends Model
{
    protected $table = 'countries';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'phone_code', 'country_code', 'country_name'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
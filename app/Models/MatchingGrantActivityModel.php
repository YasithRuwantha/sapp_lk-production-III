<?php

namespace App\Models;
 
use CodeIgniter\Model;

class MatchingGrantActivityModel extends Model
{
    protected $table      = 'matching_grant_activity';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['matching_grant_development_id', 'activity', 'expense', 'remarks'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
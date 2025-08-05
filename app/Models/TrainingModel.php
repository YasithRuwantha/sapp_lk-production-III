<?php

namespace App\Models;
 
use CodeIgniter\Model;

class TrainingModel extends Model
{
    protected $table      = 'training';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_project', 'training_name', 'start_date', 'end_date', 'objective', 'type_of_training', 'category', 'training_status', 'organized_by', 'organizer_name', 'participants_male', 'participants_female', 'participants_gender_not_specified', 'no_guest_attendees', 'key_points_discussed'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
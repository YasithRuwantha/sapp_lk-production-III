<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class MlModel extends Model
{
    protected $table = 'ven_ml_bot_logs';

    protected $primaryKey = 'id';
    
    protected $allowedFields = ['question_key', 'question', 'response', 'bot_name', 'intent', 'dialog_state', 'sentiment_label', 'occurrent', 'status'];
}
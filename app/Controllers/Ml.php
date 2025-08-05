<?php

namespace App\Controllers;
use App\Models\MlModel;

class Ml extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
    }

    public function log_chat()
	{
        $entity_model = new MlModel();

        $q = strtolower(trim(preg_replace('/[^\p{L}\p{N}\s]/u', '',preg_replace('!\s+!', ' ',$this->request->getVar('question_key')))));

        $record = $entity_model->select("id, question_key, question, response, bot_name, intent, dialog_state, sentiment_label, occurrent, status")
                            ->distinct()
                            ->where("question_key = '" . md5($q) . "'")
                            ->first();

        $data_item = [
            'question_key' => md5($q),
            'question' => $q,
            'response' => $this->request->getVar('response'),
            'bot_name' => $this->request->getVar('bot_name'),
            'intent' => $this->request->getVar('intent'),
            'dialog_state' => $this->request->getVar('dialog_state'),
            'sentiment_label' => $this->request->getVar('sentiment_label')
        ];

        if(!isset($record['id']))
        {            
            $entity_model->insert($data_item);
        }
        else
        {
            $data_item['occurrent'] = $record['occurrent'] + 1;
            $entity_model->update($record['id'],$data_item);
        }

        pre($_POST);
        pre($record);
    }

}
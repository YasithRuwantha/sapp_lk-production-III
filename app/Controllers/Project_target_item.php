<?php

namespace App\Controllers;
use App\Models\ProjectTargetModel;
use App\Models\ProjectTargetItemModel;
use App\Models\ProjectModel;

class Project_target_item extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['entity_model'] = new ProjectTargetItemModel();
        $this->data['entity_model_1'] = new ProjectTargetModel();  

        $this->data['type'] = json_decode(get_config(46),TRUE);
                
        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/project_target_item/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        $this->data['project_id'] = $this->data['entity_model_1']->select("project_id")
            ->where("id",$entity_id)
            ->first();
        
        $this->data['list_all'] = $this->data['entity_model']->select("project_target_item.*")                         
                            ->where($this->get_filter())
                            ->findAll();

        return view('project_target_item/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/project_target_item/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->process_form_add_edit($entity_id,$id);   
        
        return view('project_target_item/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());

            $this->data['details'] = [
                'item_description' => $this->request->getVar('item_description'),
                'qty' => $this->request->getVar('qty'),
                'amount' => $this->request->getVar('amount'),
                'project_target_id' => $entity_id,
            ];            

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $this->data['entity_model']->insert($this->data['details']);
                    $this->data['id'] = $this->data['entity_model']->getInsertID();
                }
                else
                {
                    $this->data['entity_model']->update($id,$this->data['details']);
                }
                
                header("Location:" . base_url("/project_target_item/list_all/" . $entity_id . "/" . $id . "/")); 
                die;

                $this->data['record'] = $this->data['entity_model']->find($id);
            }
            else
            {
                $this->data['record'] = $_POST;
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_entity_add_edit()
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'item_description' => [
                'label'  => 'Item description',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'qty' => [
                'label'  => 'Qty',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'amount' => [
                'label'  => 'Amount',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($entity_id=0,$id=0)
    {
        $this->data['entity_id'] = $entity_id;

        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/project_target_item/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = "project_target_item.created_at IS NOT NULL AND project_target_item.project_target_id =" . $this->data['entity_id'];

        $field_name = "item_description";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND project_target_item." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
<?php

namespace App\Controllers;
use App\Models\UserGroupModel;
use App\Models\UserModel;
use App\Models\ModuleModel;
use App\Models\ModuleActionModel;
use App\Models\LinkActionGroupModel;

class User_group extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['contract_status'] = json_decode(get_config(55),TRUE);

        $this->data['entity_model'] = new UserGroupModel();
        $this->data['entity_model_1'] = new LinkActionGroupModel();
        $this->data['entity_model_2'] = new ModuleActionModel();
        $this->data['entity_model_3'] = new ModuleModel();

        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/user_group/list_all/";
        $this->data['csrf'] = 1;
        
        $this->data['list_all'] = $this->data['entity_model']->select("user_group.*")
                            ->where($this->get_filter())
                            ->findAll();

        $this->data['user_id'] = $this->data['entity_model_1']->select("*")->findAll();
     
        return view('user_group/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/user_group/add_edit/";
        $this->data['csrf'] = 1;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();

        $this->data['module_action'] = $this->data['entity_model_2']->select("*")->findAll();
        $selected_actions = $this->data['entity_model_1']->select("*")
                            ->where("group_id",$id)
                            ->findAll();

        $this->data['selected_actions'][] = array();

        if(isset($selected_actions) && is_array($selected_actions))
        {
            foreach($selected_actions as $key=>$val)
            {
                $this->data['selected_actions'][] = $val['action_id'];
            }
        }                            
        
        $this->process_form_add_edit($id);        

        return view('user_group/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'group_name' => $this->request->getVar('group_name'),
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

                $this->data['entity_model_1']->where('group_id', $this->data['id'])->delete();
                $this->data['entity_model_1']->purgeDeleted();
                $module_action = $this->request->getVar('module_action');

                if(isset($module_action) && is_array($module_action))
                {
                    foreach($module_action as $val)
                    {
                        $this->data['details_action'] = [
                            'action_id' => $val,
                            'group_id' => $this->data['id'],
                        ]; 
                        $this->data['entity_model_1']->insert($this->data['details_action']);
                        $act_id = $this->data['entity_model_1']->getInsertID();
                    }
                }
                
                
                header("Location:" . base_url("/user_group/list_all/")); 
                die;
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
            'group_name' => [
                'label'  => ucfirst(str_replace("_"," ","group_name")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        $this->data['entity_model']->delete($id);
        $this->data['entity_model_1']->where('group_id', $id)->delete();
        $this->data['entity_model_1']->purgeDeleted();
        header("Location:" . base_url("/user_group/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "user_group.group_name IS NOT NULL";

        $field_name = "group_name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND user_group." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
<?php

namespace App\Controllers;
use App\Models\ProjectTargetModel;
use App\Models\ProjectModel;
use App\Models\UserModel;
use App\Models\LinkProjectTargetUserModel;

class Project_target extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['entity_model'] = new ProjectTargetModel();
        $this->data['entity_model_1'] = new ProjectModel();  
        $this->data['entity_model_2'] = new UserModel(); 
        $this->data['entity_model_3'] = new LinkProjectTargetUserModel(); 

        $this->data['type'] = json_decode(get_config(46),TRUE);
                
        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/project_target/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['list_all'] = $this->data['entity_model']->select("project.project_name, project_target.*")
                            ->join('project', 'project.id = project_target.project_id', 'left')                            
                            ->where($this->get_filter())
                            ->findAll();

        return view('project_target/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/project_target/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['farmer_list'] = $this->data['entity_model_2']->select("user.*")
                            ->where("user_type",2)
                            ->findAll(5000);

        $selected_farmers = $this->data['entity_model_3']->select("*")
                            ->where("project_target_id",$id)
                            ->findAll();

        $this->data['selected_farmers'] = array();
        if(isset($selected_farmers) && is_array($selected_farmers))
        {
            foreach($selected_farmers as $farm_val)
            {
                $this->data['selected_farmers'][] = $farm_val['user_id'];
            }
        }
        
        
        $this->process_form_add_edit($entity_id,$id);   
        
        return view('project_target/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());

            $this->data['details'] = [
                'category_name' => $this->request->getVar('category_name'),
                'type' => $this->request->getVar('type'),
                'qty' => $this->request->getVar('qty'),
                'target_amount' => $this->request->getVar('target_amount'),
                'no_of_farmers' => $this->request->getVar('no_of_farmers'),
                'project_id' => $entity_id,
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

                /**
                $this->data['entity_model_3']->where('project_target_id', $this->data['id'])->delete();
                $this->data['entity_model_3']->purgeDeleted();

                $farmer_list = $this->request->getVar('farmer_list');
                if(isset($farmer_list) && is_array($farmer_list))
                {
                    foreach($farmer_list as $farm_val)
                    {
                        $this->data['farm_details'] = [
                            'project_target_id' => $this->data['id'],
                            'user_id' => $farm_val,
                        ];   

                        $this->data['entity_model_3']->insert($this->data['farm_details']);
                        $fid = $this->data['entity_model_3']->getInsertID();
                    }
                }
                */
                
                header("Location:" . base_url("/project_target/list_all/" . $entity_id . "/" . $id . "/")); 
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
            'category_name' => [
                'label'  => 'Category name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'type' => [
                'label'  => 'Type',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            
            'no_of_farmers' => [
                'label'  => 'Number of farmers',
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

        //$this->data['entity_model']->delete($id);
        header("Location:" . base_url("/project_target/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = "project_target.created_at IS NOT NULL AND project_target.project_id =" . $this->data['entity_id'];

        $field_name = "category_name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND project_target." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
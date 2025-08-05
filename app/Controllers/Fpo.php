<?php

namespace App\Controllers;
use App\Models\FpoModel;
use App\Models\FileregisteryModel;
use App\Models\ProjectModel;

class Fpo extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['role'] = json_decode(get_config(22),TRUE);

        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/fpo/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new FpoModel();

        $this->data['list_all'] = $entity_model->select("startupfund_fpo.*")
                            ->where($this->get_filter())
                            ->findAll();
     
        return view('fpo/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/fpo/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new FpoModel();
        $entity1_model = new ProjectModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['project_list'] = $entity1_model->select("*")
                            ->findAll();
        
        $this->process_form_add_edit($id);        

        return view('fpo/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new FpoModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

          
            $this->data['details'] = [
                'project_id' => $this->request->getVar('project_id'),
                'name_organization' => $this->request->getVar('name_organization'),
                'name_in_charge' => $this->request->getVar('name_in_charge'),
                'contact_no' => $this->request->getVar('contact_no'),
                'email' => $this->request->getVar('email'),
            ];
            

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                }
                else
                {
                    $entity_model->update($id,$this->data['details']);
                }   
                
                header("Location:" . base_url("/fpo/list_all/")); 
                die;

                $this->data['record'] = $entity_model->find($id);
            }
            else
            {
                $this->data['record'] = $_POST;
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_entity_add_edit($id)
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'project_id' => [
                'label'  => 'Project',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'name_organization' => [
                'label'  => 'Name Organization',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'name_in_charge' => [
                'label'  => 'Name of In-charge officer',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'contact_no' => [
                'label'  => 'Contact no',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        $entity_model = new FpoModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/fpo/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "startupfund_fpo.created_at IS NOT NULL";

        if(isset($_GET['name_organization']) && strlen(trim($_GET['name_organization'])) > 0)
        {
            $where .= " AND startupfund_fpo.name_organization LIKE '%" . trim($_GET['name_organization']) . "%'";
        }

        if(isset($_GET['name_in_charge']) && strlen(trim($_GET['name_in_charge'])) > 0)
        {
            $where .= " AND startupfund_fpo.name_in_charge LIKE '%" . trim($_GET['name_in_charge']) . "%'";
        }

        return $where;
    }
}
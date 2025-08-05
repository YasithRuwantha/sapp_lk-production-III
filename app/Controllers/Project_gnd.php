<?php

namespace App\Controllers;
use App\Models\ProjectGndModel;
use App\Models\GndModel;
use App\Models\ProjectModel;


class Project_gnd extends BaseController
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

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/project_gnd/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new ProjectGndModel();
        $gnd_model = new GndModel();
        $project_model = new ProjectModel();

        $this->data['list_all'] = $entity_model->select("link_project_gnd.*,project.project_name,gnd.gnd")
                            ->join('project', 'project.id = link_project_gnd.project_id', 'left')
                            ->join('gnd', 'gnd.id = link_project_gnd.gnd_id', 'left')
                            ->where('link_project_gnd.project_id', $entity_id)
                            ->findAll();

        $this->data['gnd_list'] = $gnd_model->findAll();
        $this->data['project_list'] = $project_model->findAll();

        

        return view('project_gnd/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/project_gnd/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new ProjectGndModel();
        $gnd_model = new GndModel();
        $project_model = new ProjectModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  
        $this->data['gnd_list'] = $gnd_model->findAll();
        $this->data['project_list'] = $project_model->findAll();


        $this->process_form_add_edit($entity_id,$id);        

        return view('project_gnd/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new ProjectGndModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'project_id' => $entity_id,
                'gnd_id' => $this->request->getVar('gnd_id'),
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
                
                header("Location:" . base_url("/project_gnd/list_all/" . $entity_id . "/")); 
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
            'gnd_id' => [
                'label'  => 'GND',
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
        $entity_model = new ProjectGndModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/project_gnd/list_all/" . $entity_id)); 
        die;
    }
}
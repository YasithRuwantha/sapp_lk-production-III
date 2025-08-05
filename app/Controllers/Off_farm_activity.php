<?php

namespace App\Controllers;
use App\Models\OffFarmActivityModel;


class Off_farm_activity extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['disbursement_status'] = json_decode(get_config(23),TRUE);

        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd(121);
        $this->data['active_module'] = "/off_farm_activity/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new OffFarmActivityModel();

        $this->data['list_all'] = $entity_model->select("off_farm_activity.*")
                            ->join('off_farm_development', 'off_farm_development.id = off_farm_activity.off_farm_development_id', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        return view('off_farm_activity/list_all',$this->data);
    }

    public function view($entity_id=0,$id=0)
	{
        auth_rd(122);
        $this->data['active_module'] = "/off_farm_activity/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new OffFarmActivityModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->process_form_add_edit($entity_id,$id);        

        return view('off_farm_activity/add_edit',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        // auth_rd();
        ($id == 0) ? auth_rd(123) : auth_rd(124); // Add : Edit
        $this->data['active_module'] = "/off_farm_activity/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new OffFarmActivityModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->process_form_add_edit($entity_id,$id);        

        return view('off_farm_activity/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new OffFarmActivityModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $this->data['details'] = [
                'off_farm_development_id' => $entity_id,
                'activity' => $this->request->getVar('activity'),
                'estimated_cost' => $this->request->getVar('estimated_cost'),
                'agreed_amount' => $this->request->getVar('agreed_amount'),
                'admin_cost' => $this->request->getVar('admin_cost'),
                'remarks' => $this->request->getVar('remarks'),
                'implementation_agency' => $this->request->getVar('implementation_agency'),
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
                
                header("Location:" . base_url("/off_farm_activity/list_all/" . $entity_id . "/")); 
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
            'activity' => [
                'label'  => 'Activity',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'estimated_cost' => [
                'label'  => 'Estimated Cost',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'agreed_amount' => [
                'label'  => 'Agreed Amount',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'admin_cost' => [
                'label'  => 'Admin Cost',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'implementation_agency' => [
                'label'  => 'Implementation agency',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($entity_id=0,$id=0)
    {
        auth_rd(125);
        $this->data['entity_id'] = $entity_id;
        $entity_model = new OffFarmActivityModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/off_farm_activity/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = 'off_farm_activity.off_farm_development_id =' . $this->data['entity_id'];

        $field_name = "activity";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND off_farm_activity." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "expense";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND off_farm_activity." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "remarks";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND off_farm_activity." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "implementation_agency";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND off_farm_activity." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
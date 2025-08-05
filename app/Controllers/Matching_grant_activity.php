<?php

namespace App\Controllers;
use App\Models\MatchingGrantActivityModel;


class Matching_grant_activity extends BaseController
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
        auth_rd();
        $this->data['active_module'] = "/matching_grant_activity/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new MatchingGrantActivityModel();

        $this->data['list_all'] = $entity_model->select("matching_grant_activity.*")
                            ->join('matching_grant_development', 'matching_grant_development.id = matching_grant_activity.matching_grant_development_id', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        return view('matching_grant_activity/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/matching_grant_activity/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new MatchingGrantActivityModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->process_form_add_edit($entity_id,$id);        

        return view('matching_grant_activity/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new MatchingGrantActivityModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $this->data['details'] = [
                'matching_grant_development_id' => $entity_id,
                'activity' => $this->request->getVar('activity'),
                'expense' => $this->request->getVar('expense'),
                'remarks' => $this->request->getVar('remarks'),
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
                
                header("Location:" . base_url("/matching_grant_activity/list_all/" . $entity_id . "/")); 
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
            'expense' => [
                'label'  => 'expense',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'remarks' => [
                'label'  => 'Remarks',
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
        $entity_model = new MatchingGrantActivityModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/matching_grant_activity/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = 'matching_grant_activity.matching_grant_development_id =' . $this->data['entity_id'];

        $field_name = "activity";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND matching_grant_activity." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "expense";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND matching_grant_activity." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "remarks";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND matching_grant_activity." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
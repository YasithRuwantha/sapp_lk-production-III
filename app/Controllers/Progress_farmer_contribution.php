<?php

namespace App\Controllers;
use App\Models\MonthlyProgressFarmerContributionModel;
use App\Models\MonthlyProgressReportModel;

class Progress_farmer_contribution extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['activity'] = json_decode(get_config(48),TRUE);

        $this->data['entity_model'] = new MonthlyProgressFarmerContributionModel();
        $this->data['entity_model_1'] = new MonthlyProgressReportModel();         
        
        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/progress_farmer_contribution/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
       
        $this->data['list_all'] = $this->data['entity_model']->select("monthly_progress_farmer_contribution.*")                   
                            ->where($this->get_filter())
                            ->findAll();
                            
        return view('progress_farmer_contribution/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/progress_farmer_contribution/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->process_form_add_edit($entity_id,$id);

        return view('progress_farmer_contribution/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'monthly_progress_id' => $entity_id,
                'activity' => $this->request->getVar('activity'),
                'other_activity' => $this->request->getVar('other_activity'),
                'no_of_activity_reporting_month' => $this->request->getVar('no_of_activity_reporting_month'),
                'estimated_cost_reporting_month' => $this->request->getVar('estimated_cost_reporting_month'),
                'no_of_activity_cumilative' => $this->request->getVar('no_of_activity_cumilative'),
                'estimated_cost_cumilative' => $this->request->getVar('estimated_cost_cumilative'),
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
                
                header("Location:" . base_url("/progress_farmer_contribution/list_all/" . $entity_id . "/" . $id . "/")); 
                die;

                $this->data['record'] = $this->data['entity_model']->find($id);
            }
            else
            {
                //echo $validation->listErrors(); die;
                $this->data['record'] = $_POST;
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_entity_add_edit()
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
            'other_activity' => [
                'label'  => 'Other activity',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'no_of_activity_reporting_month' => [
                'label'  => 'No of activity reporting month',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'estimated_cost_reporting_month' => [
                'label'  => 'Estimated cost reporting month',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'no_of_activity_cumilative' => [
                'label'  => 'No of activity cumilative',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'estimated_cost_cumilative' => [
                'label'  => 'Estimated cost cumilative',
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
        header("Location:" . base_url("/progress_farmer_contribution/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = "monthly_progress_farmer_contribution.created_at IS NOT NULL AND monthly_progress_farmer_contribution.monthly_progress_id =" . $this->data['entity_id'];

        $field_name = "activity";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND monthly_progress_farmer_contribution." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "other_activity";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND monthly_progress_farmer_contribution." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
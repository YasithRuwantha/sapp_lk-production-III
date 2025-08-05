<?php

namespace App\Controllers;
use App\Models\MonthlyProgressAssistanceModel;
use App\Models\MonthlyProgressReportModel;

class Progress_assistance extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['assistance_type'] = json_decode(get_config(47),TRUE);

        $this->data['entity_model'] = new MonthlyProgressAssistanceModel();
        $this->data['entity_model_1'] = new MonthlyProgressReportModel();         
        
        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/progress_assistance/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
       
        $this->data['list_all'] = $this->data['entity_model']->select("monthly_progress_assistance.*")                   
                            ->where($this->get_filter())
                            ->findAll();
                            
        return view('progress_assistance/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/progress_assistance/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->process_form_add_edit($entity_id,$id);

        return view('progress_assistance/add_edit',$this->data);
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
                'assistance_input' => $this->request->getVar('assistance_input'),
                'physical_progress_reporting_month' => $this->request->getVar('physical_progress_reporting_month'),
                'physical_progress_reporting_cumilative' => $this->request->getVar('physical_progress_reporting_cumilative'),
                'financial_progress_reporting_month' => $this->request->getVar('financial_progress_reporting_month'),
                'financial_progress_reporting_cumilative' => $this->request->getVar('financial_progress_reporting_cumilative'),
                'assistance_type' => $this->request->getVar('assistance_type'),
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
                
                header("Location:" . base_url("/progress_assistance/list_all/" . $entity_id . "/" . $id . "/")); 
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
            'assistance_input' => [
                'label'  => 'Assistance input',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'physical_progress_reporting_month' => [
                'label'  => 'Physical progress reporting month',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'physical_progress_reporting_cumilative' => [
                'label'  => 'Physical progress reporting cumilative',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'financial_progress_reporting_month' => [
                'label'  => 'Financial progress reporting month',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'financial_progress_reporting_cumilative' => [
                'label'  => 'Financial progress reporting cumilative',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'assistance_type' => [
                'label'  => 'Assistance type',
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
        header("Location:" . base_url("/progress_assistance/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = "monthly_progress_assistance.created_at IS NOT NULL AND monthly_progress_assistance.monthly_progress_id =" . $this->data['entity_id'];

        $field_name = "assistance_input";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND monthly_progress_assistance." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "assistance_type";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND monthly_progress_assistance." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
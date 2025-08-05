<?php

namespace App\Controllers;
use App\Models\MonthlyProgressMicroFinanceModel;
use App\Models\MonthlyProgressReportModel;

class Progress_micro_finance extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['type_of_loan'] = json_decode(get_config(49),TRUE);

        $this->data['entity_model'] = new MonthlyProgressMicroFinanceModel();
        $this->data['entity_model_1'] = new MonthlyProgressReportModel();         
        
        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/progress_micro_finance/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
       
        $this->data['list_all'] = $this->data['entity_model']->select("monthly_progress_micro_finance.*")                   
                            ->where($this->get_filter())
                            ->findAll();
                            
        return view('progress_micro_finance/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/progress_micro_finance/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->process_form_add_edit($entity_id,$id);

        return view('progress_micro_finance/add_edit',$this->data);
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
                'loans_applied_month' => $this->request->getVar('loans_applied_month'),
                'loans_reg_cbsl_month' => $this->request->getVar('loans_reg_cbsl_month'),
                'no_loans_issued_month' => $this->request->getVar('no_loans_issued_month'),
                'loans_applied_cumilative' => $this->request->getVar('loans_applied_cumilative'),
                'loans_reg_cbsl_cumilative' => $this->request->getVar('loans_reg_cbsl_cumilative'),
                'loans_issued_cumilative' => $this->request->getVar('loans_issued_cumilative'),
                'loans_applied_lkr_month' => $this->request->getVar('loans_applied_lkr_month'),
                'loans_reg_cbsl_lkr_month' => $this->request->getVar('loans_reg_cbsl_lkr_month'),
                'loans_issued_lkr_month' => $this->request->getVar('loans_issued_lkr_month'),
                'loans_applied_lkr_cumilative' => $this->request->getVar('loans_applied_lkr_cumilative'),
                'loans_issued_lkr_cumilative' => $this->request->getVar('loans_issued_lkr_cumilative'),
                'type_of_loan' => $this->request->getVar('type_of_loan'),
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
                
                header("Location:" . base_url("/progress_micro_finance/list_all/" . $entity_id . "/" . $id . "/")); 
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
            'loans_applied_month' => [
                'label'  => ucfirst(str_replace("_"," ","loans_applied_month")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'loans_reg_cbsl_month' => [
                'label'  => ucfirst(str_replace("_"," ","loans_reg_cbsl_month")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'no_loans_issued_month' => [
                'label'  => ucfirst(str_replace("_"," ","no_loans_issued_month")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'loans_applied_cumilative' => [
                'label'  => ucfirst(str_replace("_"," ","loans_applied_cumilative")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'loans_reg_cbsl_cumilative' => [
                'label'  => ucfirst(str_replace("_"," ","loans_reg_cbsl_cumilative")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'loans_issued_cumilative' => [
                'label'  => ucfirst(str_replace("_"," ","loans_issued_cumilative")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'loans_applied_lkr_month' => [
                'label'  => ucfirst(str_replace("_"," ","loans_applied_lkr_month")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'loans_reg_cbsl_lkr_month' => [
                'label'  => ucfirst(str_replace("_"," ","loans_reg_cbsl_lkr_month")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'loans_issued_lkr_month' => [
                'label'  => ucfirst(str_replace("_"," ","loans_issued_lkr_month")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'loans_applied_lkr_cumilative' => [
                'label'  => ucfirst(str_replace("_"," ","loans_applied_lkr_cumilative")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'loans_issued_lkr_cumilative' => [
                'label'  => ucfirst(str_replace("_"," ","loans_issued_lkr_cumilative")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'type_of_loan' => [
                'label'  => ucfirst(str_replace("_"," ","type_of_loan")),
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
        header("Location:" . base_url("/progress_micro_finance/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = "monthly_progress_micro_finance.created_at IS NOT NULL AND monthly_progress_micro_finance.monthly_progress_id =" . $this->data['entity_id'];

        $field_name = "type_of_loan";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND monthly_progress_micro_finance." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "loans_applied_month";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND monthly_progress_micro_finance." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
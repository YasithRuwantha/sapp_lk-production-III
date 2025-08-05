<?php

namespace App\Controllers;
use App\Models\MonthlyProgressPurchaseFarmerModel;
use App\Models\MonthlyProgressReportModel;

class Progress_purchase_farmer_income extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['type_of_loan'] = json_decode(get_config(49),TRUE);

        $this->data['entity_model'] = new MonthlyProgressPurchaseFarmerModel();
        $this->data['entity_model_1'] = new MonthlyProgressReportModel();         
        
        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/progress_purchase_farmer_income/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
       
        $this->data['list_all'] = $this->data['entity_model']->select("monthly_progress_purchase_farmer_income.*")                   
                            ->where($this->get_filter())
                            ->findAll();
                            
        return view('progress_purchase_farmer_income/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/progress_purchase_farmer_income/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->process_form_add_edit($entity_id,$id);

        return view('progress_purchase_farmer_income/add_edit',$this->data);
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
                'produce' => $this->request->getVar('produce'),
                'no_of_farmers' => $this->request->getVar('no_of_farmers'),
                'production_month' => $this->request->getVar('production_month'),
                'production_cumilative' => $this->request->getVar('production_cumilative'),
                'amount_month' => $this->request->getVar('amount_month'),
                'amount_cumilative' => $this->request->getVar('amount_cumilative'),
                'avg_income_predicted_bp' => $this->request->getVar('avg_income_predicted_bp'),
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
                
                header("Location:" . base_url("/progress_purchase_farmer_income/list_all/" . $entity_id . "/" . $id . "/")); 
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
            'produce' => [
                'label'  => ucfirst(str_replace("_"," ","produce")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'no_of_farmers' => [
                'label'  => ucfirst(str_replace("_"," ","no_of_farmers")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'production_month' => [
                'label'  => ucfirst(str_replace("_"," ","production_month")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'production_cumilative' => [
                'label'  => ucfirst(str_replace("_"," ","production_cumilative")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'amount_month' => [
                'label'  => ucfirst(str_replace("_"," ","amount_month")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'amount_cumilative' => [
                'label'  => ucfirst(str_replace("_"," ","amount_cumilative")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'avg_income_predicted_bp' => [
                'label'  => ucfirst(str_replace("_"," ","avg_income_predicted_bp")),
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
        header("Location:" . base_url("/progress_purchase_farmer_income/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = "monthly_progress_purchase_farmer_income.created_at IS NOT NULL AND monthly_progress_purchase_farmer_income.monthly_progress_id =" . $this->data['entity_id'];

        $field_name = "produce";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND monthly_progress_purchase_farmer_income." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
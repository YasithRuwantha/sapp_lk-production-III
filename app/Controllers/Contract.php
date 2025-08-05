<?php

namespace App\Controllers;
use App\Models\ContractModel;
use App\Models\ContractSupplierModel;
use App\Models\UserModel;

class Contract extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        // $this->data['respective_sapp_division'] = json_decode(get_config(40),TRUE);
        $this->data['respective_sapp_division'] = json_decode(get_config(29),TRUE);
        $this->data['currency'] = json_decode(get_config(41),TRUE);
        $this->data['ifad_financing'] = json_decode(get_config(42),TRUE);
        $this->data['contract_status'] = json_decode(get_config(43),TRUE);
        $this->data['performance_evaluation'] = json_decode(get_config(44),TRUE);

        $this->data['entity_model'] = new ContractModel();
        $this->data['entity_model_1'] = new ContractSupplierModel();
        $this->data['entity_model_2'] = new UserModel();

        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/contract/list_all/";
        $this->data['csrf'] = 1;        

        $this->data['list_all'] = $this->data['entity_model']->select("contract.*")
                            ->where($this->get_filter())
                            ->findAll();

        $this->data['supplier_id'] = $this->data['entity_model_1']->select("*")->findAll();
        $this->data['sapp_representive_id'] = $this->data['entity_model_2']->select("*")->findAll(5000,0);
     
        return view('contract/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/contract/add_edit/";
        $this->data['csrf'] = 1;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['supplier_id'] = $this->data['entity_model_1']->select("*")->findAll();
        $this->data['sapp_representive_id'] = $this->data['entity_model_2']->select("*")            
            ->where('user_type', 1)
            ->findAll(5000,0);
        
        $this->process_form_add_edit($id);        

        return view('contract/add_edit',$this->data);
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
                'contract_name' => $this->request->getVar('contract_name'),
                'contract_number' => $this->request->getVar('contract_number'),
                'procurement_discrption' => $this->request->getVar('procurement_discrption'),
                'supplier_id' => $this->request->getVar('supplier_id'),
                'date_of_signed' => $this->request->getVar('date_of_signed'),
                'duration_months' => $this->request->getVar('duration_months'),
                'respective_sapp_division' => $this->request->getVar('respective_sapp_division'),
                'sapp_representive_id' => $this->request->getVar('sapp_representive_id'),
                'prior_post_review' => $this->request->getVar('prior_post_review'),
                'start_date' => $this->request->getVar('start_date'),
                'end_date' => $this->request->getVar('end_date'),
                'currency' => $this->request->getVar('currency'),
                'ifad_financing' => $this->request->getVar('ifad_financing'),
                'ifad_no_objection_no' => $this->request->getVar('ifad_no_objection_no'),
                'contract_status' => $this->request->getVar('contract_status'),
                'percentage_physical_progress' => $this->request->getVar('percentage_physical_progress'),
                'performance_evaluation' => $this->request->getVar('performance_evaluation'),
                'remarks' => $this->request->getVar('remarks'),
                'claimed_widrawal' => $this->request->getVar('claimed_widrawal'),
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
                
                header("Location:" . base_url("/contract/list_all/")); 
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
            'contract_name' => [
                'label'  => 'Contract name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'contract_number' => [
                'label'  => 'Contract number',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'procurement_discrption' => [
                'label'  => 'Procurement discrption',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'supplier_id' => [
                'label'  => 'Supplier',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'date_of_signed' => [
                'label'  => 'Date of signed',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'duration_months' => [
                'label'  => 'Duration months',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'respective_sapp_division' => [
                'label'  => 'Respective sapp division',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'sapp_representive_id' => [
                'label'  => 'SAPP representive',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'start_date' => [
                'label'  => 'Start date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'end_date' => [
                'label'  => 'End date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'currency' => [
                'label'  => 'Currency',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'ifad_financing' => [
                'label'  => 'IFAD financing',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'ifad_no_objection_no' => [
                'label'  => 'IFAD no objection no',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'contract_status' => [
                'label'  => 'Contract status',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ]
        ];
        
    }

    public function delete($id=0)
    {
        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/contract/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "contract.created_at IS NOT NULL";

        $field_name = "contract_name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND contract." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "contract_number";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND contract." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "date_of_signed";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND contract." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }

    public function notify_expiry()
	{
        $sql="SELECT contract.contract_name, contract.contract_number, contract_supplier.name AS supplier_name, 
        contract.end_date AS completion_ate, contract_extention.extention_date AS extended_completion_date,
        user.email, user.fname, user.lname FROM sapp_core.contract
        LEFT Join contract_supplier ON contract.supplier_id = contract_supplier.id
        LEFT join user ON contract.sapp_representive_id = user.id
        LEFT JOIN contract_extention ON contract.id = contract_extention.contract_id
        WHERE (contract.end_date > '" . date('Y-m-d', strtotime('-32 days')) . "' AND contract.end_date < '" . date('Y-m-d', strtotime('-30 days')) . "') 
        OR (contract_extention.extention_date > '" . date('Y-m-d', strtotime('-32 days')) . "' AND contract_extention.extention_date < '" . date('Y-m-d', strtotime('-30 days')) . "') 
        GROUP BY contract.contract_number
        ";

        $query = $this->data["db"]->query($sql);
        $list_all = $query->getResultArray();

        if(isset($list_all) && is_array($list_all))
        {
            foreach($list_all as $val)
            {
                $to = $val['email'];
                $mail_subject = "Notification on contract expiry date";
                $body_title = "Contract will expire soon<br />Take necessary action before 30 days.";
                $message = '<p>Hi ' . $val['fname'] . ' ' . $val['lname'] . ' </p><p> We\'d like to inform that the contract ' . $val['contract_name'] . ' (' . $val['contract_number'] . ') will expire in 30 days. Please take necessary action on it. </p>';

                send_mail($to,$mail_subject,$body_title,$message); 
            }
        }
    }
}
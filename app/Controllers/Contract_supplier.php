<?php

namespace App\Controllers;
use App\Models\ContractSupplierModel;
use App\Models\CountriesModel;

class Contract_supplier extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['entity_model'] = new ContractSupplierModel();
        $this->data['entity_model_1'] = new CountriesModel();

        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/contract_supplier/list_all/";
        $this->data['csrf'] = 1;        

        $this->data['list_all'] = $this->data['entity_model']->select("countries.country_name,contract_supplier.*")
                            ->join('countries', 'countries.id = contract_supplier.country_of_origin', 'left')         
                            ->where($this->get_filter())
                            ->findAll();

        $this->data['country_of_origin'] = $this->data['entity_model_1']->select("*")->findAll();
     
        return view('contract_supplier/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/contract_supplier/add_edit/";
        $this->data['csrf'] = 1;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['country_of_origin'] = $this->data['entity_model_1']->select("*")->findAll();
        
        $this->process_form_add_edit($id);        

        return view('contract_supplier/add_edit',$this->data);
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
                'name' => $this->request->getVar('name'),
                'reg_no' => $this->request->getVar('reg_no'),
                'country_of_origin' => $this->request->getVar('country_of_origin'),
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
                
                header("Location:" . base_url("/contract_supplier/list_all/")); 
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
            'name' => [
                'label'  => 'Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'reg_no' => [
                'label'  => 'reg no',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'country_of_origin' => [
                'label'  => 'Country of origin',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/contract_supplier/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "contract_supplier.created_at IS NOT NULL";

        $field_name = "name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND contract_supplier." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "reg_no";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND contract_supplier." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
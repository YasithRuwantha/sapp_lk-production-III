<?php

namespace App\Controllers;
use App\Models\IsServiceProviderModel;

class Is_service_provider extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['entity_model'] = new IsServiceProviderModel();

        track();
    }

    public function list_all()
	{
        auth_rd(133);
        $this->data['active_module'] = "/is_service_provider/list_all/";
        $this->data['csrf'] = 1;
        

        $this->data['list_all'] = $this->data['entity_model']->select("is_service_provider.*")
                            ->where($this->get_filter())
                            ->findAll();
     
        return view('is_service_provider/list_all',$this->data);
    }

    public function view($id=0)
	{
        // pre($_SESSION);
        // die;
        auth_rd(134);
        $this->data['active_module'] = "/is_service_provider/add_edit/";
        $this->data['csrf'] = 1;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->process_form_add_edit($id);        

        return view('is_service_provider/add_edit',$this->data);
    }

    public function add_edit($id=0)
	{
        // auth_rd();
        ($id == 0) ? auth_rd(135) : auth_rd(136);
        $this->data['active_module'] = "/is_service_provider/add_edit/";
        $this->data['csrf'] = 1;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->process_form_add_edit($id);        

        return view('is_service_provider/add_edit',$this->data);
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
                'name_service_provider' => $this->request->getVar('name_service_provider'),
                'address' => $this->request->getVar('address'),
                'name_in_charge' => $this->request->getVar('name_in_charge'),
                'phone_in_charge' => $this->request->getVar('phone_in_charge'),
                'email_in_charge' => $this->request->getVar('email_in_charge'),
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
                
                header("Location:" . base_url("/is_service_provider/list_all/")); 
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
            'name_service_provider' => [
                'label'  => ucfirst(str_replace("_"," ","name_service_provider")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'address' => [
                'label'  => ucfirst(str_replace("_"," ","address")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'name_in_charge' => [
                'label'  => ucfirst(str_replace("_"," ","name_in_charge")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'phone_in_charge' => [
                'label'  => ucfirst(str_replace("_"," ","phone_in_charge")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ]
        ];
        
    }

    public function delete($id=0)
    {
        auth_rd(137);
        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/is_service_provider/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "`is_service_provider`.created_at IS NOT NULL";

        $field_name = "name_service_provider";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND `is_service_provider`." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "name_in_charge";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND `is_service_provider`." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
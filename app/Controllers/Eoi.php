<?php

namespace App\Controllers;
use App\Models\EoiModel;

class Eoi extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['eoi_type'] = json_decode('{"1":"Grant Only", "2":"Loan Only", "3":"Grant & Loan"}',TRUE);
        $this->data['eoi_status'] = json_decode('{"1":"Planned", "2":"Published", "3":"Closed", "4":"BP Accepted"}',TRUE);
        $this->data['status_color'] = array(1=>"warning",2=>"default",3=>"primary",4=>"success",5=>"purple");

        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/eoi/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new EoiModel();

        $this->data['list_all'] = $entity_model->select("*")
                             ->where($this->get_filter())
                            ->findAll();

        return view('eoi/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/eoi/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new EoiModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->process_form_add_edit($id);        

        return view('eoi/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new EoiModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));
          
            $this->data['details'] = [
                'eoi_name' => $this->request->getVar('eoi_name'),
                'eoi_type' => $this->request->getVar('eoi_type'),
                'eoi_date' => $this->request->getVar('eoi_date'),
                'eoi_status' => $this->request->getVar('eoi_status'),
            ];
            

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();

                    header("Location:" . base_url("/eoi/list_all")); 
                    die;
                }
                else
                {
                    $entity_model->update($id,$this->data['details']);
                    header("Location:" . base_url("/eoi/list_all")); 
                    die;
                }                

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
            'eoi_name' => [
                'label'  => 'Project',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'eoi_type' => [
                'label'  => 'Scheme name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'eoi_date' => [
                'label'  => 'Main purpose',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'eoi_status' => [
                'label'  => 'Sub purpose',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        $entity_model = new EoiModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/eoi/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = 'eoi.created_at IS NOT NULL';

        $field_name = "eoi_name";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND eoi." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        $field_name = "eoi_type";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND eoi." . $field_name . "= " .$_POST[$field_name]."";
        }

        $field_name = "eoi_status";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND eoi." . $field_name . "= " .$_POST[$field_name]."";
        }

        return $where;
    }
}
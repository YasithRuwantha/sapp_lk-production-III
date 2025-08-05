<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PromoterMetaModel;

class Promoter extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['business_type'] = json_decode(get_config(20),TRUE);

        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/promoter/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new PromoterMetaModel();
        $this->data['list_all'] = $entity_model->select("promoter.*,user.fname,user.lname")
                            ->join('user', 'user.id = promoter.auth_officer_id', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        return view('promoter/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/promoter/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new PromoterMetaModel();
        $user_model = new UserModel();
        $this->data['id'] = $id;      
        
        $this->data['record'] = $entity_model->find($id);
        $this->data['user_list'] = $user_model->where('user_type = 4')
                            ->findAll();

        $this->process_form_add_edit($id);        

        return view('promoter/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new PromoterMetaModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));
          
            $this->data['details'] = [
                'id' => $id,
                'business_type' => $this->request->getVar('business_type'),
                'org_name' => $this->request->getVar('org_name'),
                'business_registration_no' => $this->request->getVar('business_registration_no'),
                'auth_officer_id' => $this->request->getVar('auth_officer_id'),
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

                $this->data['record'] = $entity_model->find($id);

                header("Location:" . base_url("promoter/list_all/")); 
                die;
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
            'org_name' => [
                'label'  => 'Organization Name',
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => '{field} must have minimum of 3 letters.',
                ]
            ],
            'business_type' => [
                'label'  => 'Business type',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'auth_officer_id' => [
                'label'  => 'Authorizing Officer',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'business_registration_no' => [
                'label'  => 'Business registration no',
                'rules'  => 'max_length[64]',
                'errors' => [
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        $entity_model = new PromoterMetaModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/promoter/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "promoter.created_at IS NOT NULL";

        $field_name = "business_type";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND promoter." . $field_name . "= " .$_POST[$field_name]."";
        }

        $field_name = "org_name";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND promoter." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        $field_name = "business_registration_no";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND promoter." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        return $where;
    }
}
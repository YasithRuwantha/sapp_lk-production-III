<?php

namespace App\Controllers;
use App\Models\ProcurementMemberModel;
use App\Models\ProcurementModel;
use App\Models\SubCommiteeMembersModel;

class Procurement_member extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['category'] = json_decode('{"4":"Procurement", "5":"Techinical"}',TRUE);
        $this->data['status'] = json_decode(get_config(25),TRUE);
        $this->data['sub_commitee'] = json_decode(get_config(26),TRUE);

        $this->data['entity_model'] = new SubCommiteeMembersModel();
        $this->data['entity_model_1'] = new ProcurementMemberModel();  
        
        $this->data['title_label'] = json_decode('{"4":"Procurement", "5":"Techinical"}',TRUE);

        track();
    }

    public function list_all($entity_id=0,$category=1)
	{
        auth_rd();
        $this->data['active_module'] = "/procurement_member/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;

        // if(!isset($_SESSION['record']['category']))
        // {
            $_SESSION['record']['category'] = $category;
        // }
        
        $this->data['list_all'] = $this->data['entity_model']->select("sub_commitee_members.*")
                            ->join('link_procurement_member', 'sub_commitee_members.id = link_procurement_member.sub_commitee_id', 'left')
                            ->join('procurement', 'procurement.id = link_procurement_member.procurement_id', 'left')                            
                            ->where($this->get_filter())
                            ->where('sub_commitee_members.category', $category)
                            ->findAll();
                            
        return view('procurement_member/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/procurement_member/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->process_form_add_edit($entity_id,$id);        

        return view('procurement_member/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());
            // $validation->setRules($this->validation_rules_entity_add_edit());


            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                'designation' => $this->request->getVar('designation'),
                'organization' => $this->request->getVar('organization'),
                'category' => $_SESSION['record']['category'],
                'status' => $this->request->getVar('status'),
                'sub_commitee' => $_SESSION['record']['category'],
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

                $this->data['link_record'] = $this->data['entity_model_1']->select("*")
                            ->where("sub_commitee_id", $this->data['id'])
                            ->where("procurement_id", $this->data['entity_id'])
                            ->first();  

                if(!isset($this->data['link_record']['procurement_id']))
                {
                    $this->data['link_details'] = [
                        'sub_commitee_id' => $this->data['id'],
                        'procurement_id' => $this->data['entity_id'],
                    ];
                    $this->data['entity_model_1']->insert($this->data['link_details']);
                }
                
                header("Location:" . base_url("/procurement_member/list_all/" . $entity_id . "/" . $_SESSION['record']['category'] . "/")); 
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
            'first_name' => [
                'label'  => 'First name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'last_name' => [
                'label'  => 'Last name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'designation' => [
                'label'  => 'Designation',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'organization' => [
                'label'  => 'Organization',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            // 'category' => [
            //     'label'  => 'Category',
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            // 'sub_commitee' => [
            //     'label'  => 'Sub commitee',
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
        ];
        
    }

    public function delete($entity_id=0,$id=0)
    {
        $this->data['entity_id'] = $entity_id;

        $this->data['entity_model_1']->where('procurement_id', $entity_id)->where('sub_commitee_id', $id)->delete();
        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/procurement_member/list_all/" . $entity_id . "/" . $_SESSION['record']['category'])); 
        die;
    }

    private function get_filter()
    {
        $where = "sub_commitee_members.created_at IS NOT NULL AND link_procurement_member.procurement_id =" . $this->data['entity_id'];

        $field_name = "first_name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND sub_commitee_members." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "last_name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND sub_commitee_members." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "designation";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND sub_commitee_members." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "organization";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND sub_commitee_members." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "category";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND sub_commitee_members." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "status";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND sub_commitee_members." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "sub_commitee";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND sub_commitee_members." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
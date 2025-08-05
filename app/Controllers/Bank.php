<?php

namespace App\Controllers;
use App\Models\BankModel;
use App\Models\LinkPromoterBankModel;
use App\Models\LinkUserBankModel;
use App\Models\BankListModel;

class Bank extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['entity_model'] = new BankModel();
        $this->data['entity_model_1'] = new LinkUserBankModel();
        $this->data['entity_model_2'] = new LinkPromoterBankModel(); 
        $this->data['entity_model_3'] = new BankListModel(); 

        track();
    }

    public function list_all($entity_id=0,$mode="user")
	{
        auth_rd();
        $this->data['active_module'] = "/bank/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        $this->data['mode'] = $mode;        

        if($mode=="user")
        {
            $this->data['list_all'] = $this->data['entity_model']->select("bank_details.*,banks.bank")
                        ->join('link_user_bank', 'bank_details.id = link_user_bank.bank_details_id', 'left')  
                        ->join('banks', 'bank_details.bank_id = banks.id', 'left')                        
                        ->where($this->get_filter($mode))
                        ->findAll();
        }

        if($mode=="promoter")
        {
            $this->data['list_all'] = $this->data['entity_model']->select("bank_details.*,banks.bank")
                        ->join('link_promoter_bank', 'bank_details.id = link_promoter_bank.bank_details_id', 'left')     
                        ->join('banks', 'bank_details.bank_id = banks.id', 'left')                            
                        ->where($this->get_filter($mode))
                        ->findAll();
        }

        $this->data['bank_id'] = $this->data['entity_model_3']->select("*")
                            ->findAll();
                            
        return view('bank/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0,$mode="user")
	{
        auth_rd();
        $this->data['active_module'] = "/bank/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        $this->data['mode'] = $mode;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['bank_id'] = $this->data['entity_model_3']->select("*")
                            ->findAll();
        
        $this->process_form_add_edit($entity_id,$id,$mode);   
        
        return view('bank/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0,$mode="user")
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;
        $this->data['id'] = $id;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());
          
            $this->data['details'] = [
                'acc_no' => $this->request->getVar('acc_no'),
                'bank_id' => $this->request->getVar('bank_id'),
                'bank_code' => $this->request->getVar('bank_code'),
                'branch' => $this->request->getVar('branch'),
                'branch_code' => $this->request->getVar('branch_code'),
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

                if($mode=="user")
                {
                    $this->data['link_record'] = $this->data['entity_model_1']->select("*")
                            ->where("user_id", $this->data['entity_id'])
                            ->where("bank_details_id", $this->data['id'])
                            ->first(); 
                }

                if($mode=="promoter")
                {
                    $this->data['link_record'] = $this->data['entity_model_2']->select("*")
                            ->where("promoter_id", $this->data['entity_id'])
                            ->where("bank_details_id", $this->data['id'])
                            ->first(); 
                }                 

                if(!isset($this->data['link_record']['bank_details_id']))
                {
                    if($mode=="user")
                    {
                        $this->data['link_details'] = [
                            'user_id' => $this->data['entity_id'],
                            'bank_details_id' => $this->data['id'],
                        ];
                        $this->data['entity_model_1']->insert($this->data['link_details']);
                    }

                    if($mode=="promoter")
                    {
                        $this->data['link_details'] = [
                            'promoter_id' => $this->data['entity_id'],
                            'bank_details_id' => $this->data['id'],
                        ];
                        $this->data['entity_model_2']->insert($this->data['link_details']);
                    }                    
                }

                
                header("Location:" . base_url("/bank/list_all/" . $entity_id . "/" . $mode)); 
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
            'acc_no' => [
                'label'  => 'Account no',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'bank_id' => [
                'label'  => 'Bank name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'bank_code' => [
                'label'  => 'Bank code',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'branch' => [
                'label'  => 'Branch',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'branch_code' => [
                'label'  => 'Branch code',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($entity_id=0,$id=0,$mode="user")
    {
        $this->data['entity_id'] = $entity_id;
        $this->data['mode'] = $mode;

        if($mode=="user")
        {
            $this->data['entity_model_1']->where('bank_details_id', $id)->where('user_id', $entity_id)->delete();
        }

        if($mode=="promoter")
        {
            $this->data['entity_model_2']->where('bank_details_id', $id)->where('promoter_id', $entity_id)->delete();
        }    
        
        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/bank/list_all/" . $entity_id . "/" . $id . "/" . $mode)); 
        die;
    }

    private function get_filter($mode)
    {
        if($mode=="promoter")
        {
            $where = "bank_details.created_at IS NOT NULL AND link_promoter_bank.promoter_id =" . $this->data['entity_id'];
        }  
        
        if($mode=="user")
        {
            $where = "bank_details.created_at IS NOT NULL AND link_user_bank.user_id =" . $this->data['entity_id'];
        }  

        $field_name = "acc_no";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND bank_details." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "bank_name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND bank_details." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "branch";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND bank_details." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
<?php

namespace App\Controllers;
use App\Models\GrandItemModel;
use App\Models\GrandDisbursementModel;
use App\Models\UserModel;
use App\Models\GrantModel;
use App\Models\ProjectTargetItemModel;


class Grant_item extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['disbursement_status'] = json_decode(get_config(23),TRUE);
        $this->data['status'] = json_decode(get_config(39),TRUE);

        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/grant_item/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new GrandItemModel();
        $disbursement_model = new GrandDisbursementModel();
        $grant_model = new GrantModel();
        $project_target_model = new ProjectTargetItemModel();

        $this->data['list_all'] = $entity_model->select("grant_item_farmer.*,grant_disbursement.remarks,project_target_item.item_description")
                            ->join('grant_disbursement', 'grant_disbursement.id = grant_item_farmer.grant_disbursement_id', 'left')
                            ->join('project_target_item', 'project_target_item.id = grant_item_farmer.project_target_item_id', 'left')        
                            ->where($this->get_filter())
                            ->findAll();
        $this->data['disbursement'] = $disbursement_model->select("*")
                            ->where("id", $entity_id)
                            ->first();  
        $this->data['project_target_item_id'] = $project_target_model->select("project_target_item.*")
                            ->findAll();

        $this->data['parent_id'] = $this->data['disbursement']['grant_id'];

        $this->data['grant_list'] = $grant_model->findAll();

        return view('grant_item/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/grant_item/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new GrandItemModel();
        $disbursement_model = new GrandDisbursementModel();
        $grant_model = new GrantModel();
        $project_target_model = new ProjectTargetItemModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->data['disbursement'] = $disbursement_model->select("*")
                            ->where("id", $entity_id)
                            ->first();  
        $this->data['project_target_item_id'] = $project_target_model->select("project_target_item.*")
                            ->join('project_target', 'project_target.id = project_target_item.project_target_id', 'left')
                            ->join('grant', 'grant.project_id = project_target.project_id', 'left')
                            ->join('grant_disbursement', 'grant_disbursement.grant_id = grant.id', 'left')
                            ->where("grant_disbursement.id", $entity_id)
                            ->findAll();

        $this->data['parent_id'] = $this->data['disbursement']['grant_id'];

        $this->data['grant_list'] = $grant_model->findAll();


        $this->process_form_add_edit($entity_id,$id);        

        return view('grant_item/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new GrandItemModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'grant_disbursement_id' => $entity_id,
                'project_target_item_id' => $this->request->getVar('project_target_item_id'),
                'qty' => $this->request->getVar('qty'),
                'price' => $this->request->getVar('price'),
                'supplier_name' => $this->request->getVar('supplier_name'),
                'status' => $this->request->getVar('status'),
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
                
                header("Location:" . base_url("/grant_item/list_all/" . $entity_id . "/")); 
                die;

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
            'project_target_item_id' => [
                'label'  => 'Item',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'qty' => [
                'label'  => 'Qty',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'price' => [
                'label'  => 'Price',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'supplier_name' => [
                'label'  => 'Supplier name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'status' => [
                'label'  => 'Status',
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
        $entity_model = new GrandItemModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/grant_item/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = 'grant_disbursement.id =' . $this->data['entity_id'];

        if(isset($_GET['item_name']) && strlen(trim($_GET['item_name'])) > 0)
        {
            $where .= " AND grant_item_farmer.item_name LIKE '%" . trim($_GET['item_name']) . "%'";
        }

        if(isset($_GET['qty']) && strlen(trim($_GET['qty'])) > 0)
        {
            $where .= " AND grant_item_farmer.qty LIKE '%" . trim($_GET['remarks']) . "%'";
        }

        if(isset($_GET['supplier_name']) && strlen(trim($_GET['supplier_name'])) > 0)
        {
            $where .= " AND grant_item_farmer.supplier_name LIKE '%" . trim($_GET['supplier_name']) . "%'";
        }

        return $where;
    }
}
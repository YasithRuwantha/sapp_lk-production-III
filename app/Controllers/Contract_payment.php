<?php

namespace App\Controllers;
use App\Models\ContractPaymentModel;
use App\Models\ContractModel;
use App\Models\FileregisteryModel;
use App\Models\LinkContractPaymentFileModel;

class Contract_payment extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['entity_model'] = new ContractPaymentModel();
        $this->data['entity_model_1'] = new ContractModel();  
        
        $this->data['reg_model'] = new FileregisteryModel();
        $this->data['link_model'] = new LinkContractPaymentFileModel();
        
        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/contract_payment/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['list_all'] = $this->data['entity_model']->select("contract.contract_name, contract.contract_number, contract_payment.*")
                            ->join('contract', 'contract.id = contract_payment.contract_id', 'left')                            
                            ->where($this->get_filter())
                            ->findAll();

        return view('contract_payment/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/contract_payment/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->process_form_add_edit($entity_id,$id);   
        
        $this->data['list_docs'] = $this->data['link_model']->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_contract_payment_file.file_id', 'left')
                            ->where("link_contract_payment_file.contract_payment_id",$id)
                            ->findAll();

        return view('contract_payment/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());

            $this->data['details'] = [
                'amount' => $this->request->getVar('amount'),
                'transection_date' => $this->request->getVar('transection_date'),
                'remarks' => $this->request->getVar('remarks'),
                'contract_id' => $entity_id,
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

                $total = count($_FILES['img']['name']);

                for( $i=0 ; $i < $total ; $i++ ) {
                    if(is_file($_FILES["img"]["tmp_name"][$i])) 
                    {
                        $path = $_FILES['img']['name'][$i];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $sub_path = "public/resource/contract/" . md5($path . time()) . "." . $ext;
                        $target_file = ROOTPATH . $sub_path;
                        if(move_uploaded_file($_FILES["img"]["tmp_name"][$i], $target_file)) 
                        {
                            $this->data['file_registery'] = [
                                'added_on' => time(),
                                'relative_path' => '/' . $sub_path,
                                'ref_table' => 'contract_payment',
                                'file_name' => $path,
                                'status' => 1,
                            ];

                            $this->data['reg_model']->insert($this->data['file_registery']);
                            $file_id = $this->data['reg_model']->getInsertID();

                            $this->data['file_link'] = [
                                'contract_payment_id' => $this->data['id'],
                                'file_id' => $file_id,
                            ];

                            $this->data['link_model']->insert($this->data['file_link']);
                            $link_id = $this->data['link_model']->getInsertID();

                            s3_upload($target_file,$sub_path);
                        }
                    }
                }
                
                header("Location:" . base_url("/contract_payment/list_all/" . $entity_id . "/" . $id . "/")); 
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
            'transection_date' => [
                'label'  => 'Extention approved',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'amount' => [
                'label'  => 'Extention date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'remarks' => [
                'label'  => 'remarks',
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
        header("Location:" . base_url("/contract_payment/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = "contract_payment.created_at IS NOT NULL AND contract_payment.contract_id =" . $this->data['entity_id'];

        $field_name = "remarks";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND contract_payment." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "transection_date";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND contract_payment." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "amount";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND contract_payment." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
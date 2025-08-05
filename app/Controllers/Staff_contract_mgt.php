<?php

namespace App\Controllers;
use App\Models\StaffContractMgtModel;
use App\Models\UserModel;
use App\Models\FileregisteryModel;
use App\Models\LinkStaffContractMgtFileModel;

class Staff_contract_mgt extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['contract_status'] = json_decode(get_config(55),TRUE);

        $this->data['entity_model'] = new StaffContractMgtModel();
        $this->data['entity_model_1'] = new UserModel();

        $this->data['reg_model'] = new FileregisteryModel();
        $this->data['link_model'] = new LinkStaffContractMgtFileModel();


        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/staff_contract_mgt/list_all/";
        $this->data['csrf'] = 1;
        

        $this->data['list_all'] = $this->data['entity_model']->select("staff_contract_mgt.*,user.fname,user.lname")
                            ->join('user', 'user.id = staff_contract_mgt.user_id', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        $this->data['user_id'] = $this->data['entity_model_1']->select("*")->findAll(5000,0);
     
        return view('staff_contract_mgt/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/staff_contract_mgt/add_edit/";
        $this->data['csrf'] = 1;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['user_id'] = $this->data['entity_model_1']->select("user.*")
                            ->where('user_type', 1)
                            ->findAll(5000,0);

        $this->data['list_docs'] = $this->data['link_model']->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_staff_contract_mgt_file.file_id', 'left')
                            ->where("link_staff_contract_mgt_file.staff_contract_mgt_id",$id)
                            ->findAll();

        $this->data['project_id'] = $this->data['entity_model_1']->select("*")->findAll(5000,0);
        
        $this->process_form_add_edit($id);        

        return view('staff_contract_mgt/add_edit',$this->data);
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
                'user_id' => $this->request->getVar('user_id'),
                'contract_effective_date' => $this->request->getVar('contract_effective_date'),
                'contract_expiary_date' => $this->request->getVar('contract_expiary_date'),
                'contract_status' => $this->request->getVar('contract_status'),
                'remarks' => $this->request->getVar('remarks'),
            ];
            
            // pre($this->request);
            // die;

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

                $reg_model = new FileregisteryModel();
                
                $total = count($_FILES['img']['name']);

                for( $i=0 ; $i < $total ; $i++ ) {
                    if(is_file($_FILES["img"]["tmp_name"][$i])) 
                    {
                        $path = $_FILES['img']['name'][$i];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $sub_path = "public/resource/staff_contract_mgt/" . md5($path . time()) . "." . $ext;
                        $target_file = ROOTPATH . $sub_path;
                        if(move_uploaded_file($_FILES["img"]["tmp_name"][$i], $target_file)) 
                        {
                            $this->data['file_registery'] = [
                                'added_on' => time(),
                                'relative_path' => '/' . $sub_path,
                                'ref_table' => 'staff_contract_mgt',
                                'file_name' => $path,
                                'status' => 1,
                            ];

                            $this->data['reg_model']->insert($this->data['file_registery']);
                            $file_id = $this->data['reg_model']->getInsertID();

                            $this->data['file_link'] = [
                                'staff_contract_mgt_id' => $this->data['id'],
                                'file_id' => $file_id,
                            ];

                            $this->data['link_model']->insert($this->data['file_link']);
                            $link_id = $this->data['link_model']->getInsertID();

                            s3_upload($target_file,$sub_path);
                        }
                    }
                }
                
                header("Location:" . base_url("/staff_contract_mgt/list_all/")); 
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
            'user_id' => [
                'label'  => ucfirst(str_replace("_"," ","user")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'contract_effective_date' => [
                'label'  => ucfirst(str_replace("_"," ","contract_effective_date")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'contract_expiary_date' => [
                'label'  => ucfirst(str_replace("_"," ","contract_expiary_date")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    // 'greater_than' => 'Contract expiary date must be Greater than contract effective date.'
                ]
            ],
            'contract_status' => [
                'label'  => ucfirst(str_replace("_"," ","contract_status")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            // 'remarks' => [
            //     'label'  => ucfirst(str_replace("_"," ","remarks")),
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
        ];
        
    }

    public function delete($id=0)
    {
        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/staff_contract_mgt/list_all/")); 
        die;
    }

    public function ajax_is_active_staff($id)
	{
        auth_rd();
        
        $record = $this->data['entity_model']->select("*")
                            ->where("user_id", $id)
                            ->where("contract_status", 1)
                            ->first();
        if(isset($record['id']))
        {
            echo '<div style="color: #dc3545;">User Already Have an Active Contract</div>';
        }
        else
        {
            echo '';
        }
    }

    private function get_filter()
    {
        $where = "staff_contract_mgt.created_at IS NOT NULL";

        $field_name = "user_id";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND staff_contract_mgt." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "remarks";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND staff_contract_mgt." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
<?php

namespace App\Controllers;
use App\Models\IsModel;
use App\Models\ProjectModel;
use App\Models\IsServiceProviderModel;
use App\Models\PromoterModel;
use App\Models\FileregisteryModel;
use App\Models\LinkIsFileModel;

class Is extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['status'] = json_decode(get_config(50),TRUE);

        $this->data['entity_model'] = new IsModel();
        $this->data['entity_model_1'] = new ProjectModel();
        $this->data['entity_model_2'] = new PromoterModel();
        $this->data['entity_model_3'] = new IsServiceProviderModel();

        $this->data['reg_model'] = new FileregisteryModel();
        $this->data['link_model'] = new LinkIsFileModel();

        track();
    }

    public function list_all()
	{
        auth_rd(127);
        $this->data['active_module'] = "/is/list_all/";
        $this->data['csrf'] = 1;
        

        $this->data['list_all'] = $this->data['entity_model']->select("`is`.*,is_service_provider.name_service_provider,project.project_name,promoter.org_name")
                            ->join('is_service_provider', 'is_service_provider.id = `is`.is_service_provider_id', 'left')
                            ->join('project', 'project.id = `is`.project_id', 'left')
                            ->join('promoter', 'promoter.id = `is`.promoter_id', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        $this->data['project_id'] = $this->data['entity_model_1']->select("*")->findAll();
        $this->data['promoter_id'] = $this->data['entity_model_2']->select("*")->findAll();
        $this->data['is_service_provider_id'] = $this->data['entity_model_3']->select("*")->findAll();
     
        return view('is/list_all',$this->data);
    }

    public function view($id=0)
	{
        auth_rd(128);
        $this->data['active_module'] = "/is/add_edit/";
        $this->data['csrf'] = 1;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['list_docs'] = $this->data['link_model']->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_is_file.file_id', 'left')
                            ->where("link_is_file.is_id",$id)
                            ->findAll();

        $this->data['project_id'] = $this->data['entity_model_1']->select("*")->findAll();
        $this->data['promoter_id'] = $this->data['entity_model_2']->select("*")->findAll();
        $this->data['is_service_provider_id'] = $this->data['entity_model_3']->select("*")->findAll();
        
        $this->process_form_add_edit($id);        

        return view('is/add_edit',$this->data);
    }

    public function add_edit($id=0)
	{
        // auth_rd();
        ($id == 0) ? auth_rd(129) : auth_rd(130); // Add: Edit
        $this->data['active_module'] = "/is/add_edit/";
        $this->data['csrf'] = 1;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['list_docs'] = $this->data['link_model']->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_is_file.file_id', 'left')
                            ->where("link_is_file.is_id",$id)
                            ->findAll();

        $this->data['project_id'] = $this->data['entity_model_1']->select("*")->findAll();
        $this->data['promoter_id'] = $this->data['entity_model_2']->select("*")->findAll();
        $this->data['is_service_provider_id'] = $this->data['entity_model_3']->select("*")->findAll();
        
        $this->process_form_add_edit($id);        

        return view('is/add_edit',$this->data);
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
                'is_service_provider_id' => $this->request->getVar('is_service_provider_id'),
                'project_id' => $this->request->getVar('project_id'),
                'promoter_id' => $this->request->getVar('promoter_id'),
                'contract_start_date' => $this->request->getVar('contract_start_date'),
                'contract_end_date' => $this->request->getVar('contract_end_date'),
                'benificiary_male' => $this->request->getVar('benificiary_male'),
                'benificiary_female' => $this->request->getVar('benificiary_female'),
                'benificiary_gender_not_specified' => $this->request->getVar('benificiary_gender_not_specified'),
                'contract_amount' => $this->request->getVar('contract_amount'),
                'status' => $this->request->getVar('status'),
                'remark' => $this->request->getVar('remark'),
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

                $reg_model = new FileregisteryModel();
                
                $total = count($_FILES['img']['name']);

                for( $i=0 ; $i < $total ; $i++ ) {
                    if(is_file($_FILES["img"]["tmp_name"][$i])) 
                    {
                        $path = $_FILES['img']['name'][$i];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $sub_path = "public/resource/is/" . md5($path . time()) . "." . $ext;
                        $target_file = ROOTPATH . $sub_path;
                        if(move_uploaded_file($_FILES["img"]["tmp_name"][$i], $target_file)) 
                        {
                            $this->data['file_registery'] = [
                                'added_on' => time(),
                                'relative_path' => '/' . $sub_path,
                                'ref_table' => 'is',
                                'file_name' => $path,
                                'status' => 1,
                            ];

                            $this->data['reg_model']->insert($this->data['file_registery']);
                            $file_id = $this->data['reg_model']->getInsertID();

                            $this->data['file_link'] = [
                                'is_id' => $this->data['id'],
                                'file_id' => $file_id,
                            ];

                            $this->data['link_model']->insert($this->data['file_link']);
                            $link_id = $this->data['link_model']->getInsertID();

                            s3_upload($target_file,$sub_path);
                        }
                    }
                }
                
                header("Location:" . base_url("/is/list_all/")); 
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
            'is_service_provider_id' => [
                'label'  => ucfirst(str_replace("_"," ","is_service_provider")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'project_id' => [
                'label'  => ucfirst(str_replace("_"," ","project")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'promoter_id' => [
                'label'  => ucfirst(str_replace("_"," ","promoter")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'contract_start_date' => [
                'label'  => ucfirst(str_replace("_"," ","contract_start_date")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'contract_end_date' => [
                'label'  => ucfirst(str_replace("_"," ","contract_end_date")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'benificiary_male' => [
                'label'  => ucfirst(str_replace("_"," ","benificiary_male")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'benificiary_female' => [
                'label'  => ucfirst(str_replace("_"," ","benificiary_female")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'benificiary_gender_not_specified' => [
                'label'  => ucfirst(str_replace("_"," ","benificiary_gender_not_specified")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'contract_amount' => [
                'label'  => ucfirst(str_replace("_"," ","contract_amount")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'status' => [
                'label'  => ucfirst(str_replace("_"," ","status")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ]
        ];
        
    }

    public function delete($id=0)
    {
        auth_rd(131);
        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/is/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "`is`.created_at IS NOT NULL";

        $field_name = "is_service_provider_id";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND `is`." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "promoter_id";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND `is`." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "project_id";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND `is`." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
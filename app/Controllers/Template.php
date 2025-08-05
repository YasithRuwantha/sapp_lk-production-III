<?php

namespace App\Controllers;
use App\Models\ProcurementModel;
use App\Models\ProjectModel;
use App\Models\FileregisteryModel;
use App\Models\LinkProcurementFileModel;

class Template extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['type'] = json_decode(get_config(27),TRUE);
        $this->data['no_objection'] = json_decode(get_config(28),TRUE);

        $this->data['entity_model'] = new ProcurementModel();
        $this->data['entity_model_1'] = new ProjectModel();

        $this->data['reg_model'] = new FileregisteryModel();
        $this->data['link_model'] = new LinkProcurementFileModel();


        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/template/list_all/";
        $this->data['csrf'] = 1;
        

        $this->data['list_all'] = $this->data['entity_model']->select("procurement.*")
                            ->join('project', 'project.id = procurement.project_id', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        $this->data['project_id'] = $this->data['entity_model_1']->select("*")->findAll();
     
        return view('template/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/template/add_edit/";
        $this->data['csrf'] = 1;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['list_docs'] = $this->data['link_model']->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_procurement_file.file_id', 'left')
                            ->where("link_procurement_file.procurement_id",$id)
                            ->findAll();

        $this->data['project_id'] = $this->data['entity_model_1']->select("*")->findAll();
        
        $this->process_form_add_edit($id);        

        return view('template/add_edit',$this->data);
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
                'procurement_name' => $this->request->getVar('procurement_name'),
                'title' => $this->request->getVar('title'),
                'type' => $this->request->getVar('type'),
                'project_id' => $this->request->getVar('project_id'),
                'budget' => $this->request->getVar('budget'),
                'procurement_agency' => $this->request->getVar('procurement_agency'),
                'advertize_date' => $this->request->getVar('advertize_date'),
                'opening_date' => $this->request->getVar('opening_date'),
                'doc_considered' => $this->request->getVar('doc_considered'),
                'tec_consent' => $this->request->getVar('tec_consent'),
                'procurement_consent' => $this->request->getVar('procurement_consent'),
                'no_objection' => $this->request->getVar('no_objection'),
                'objection_remarks' => $this->request->getVar('objection_remarks'),
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
                
                header("Location:" . base_url("/template/list_all/")); 
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
            'produce' => [
                'label'  => ucfirst(str_replace("_"," ","produce")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'no_of_farmers' => [
                'label'  => ucfirst(str_replace("_"," ","no_of_farmers")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'production_month' => [
                'label'  => ucfirst(str_replace("_"," ","production_month")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'production_cumilative' => [
                'label'  => ucfirst(str_replace("_"," ","production_cumilative")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'amount_month' => [
                'label'  => ucfirst(str_replace("_"," ","amount_month")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'amount_cumilative' => [
                'label'  => ucfirst(str_replace("_"," ","amount_cumilative")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'avg_income_predicted_bp' => [
                'label'  => ucfirst(str_replace("_"," ","avg_income_predicted_bp")),
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
        header("Location:" . base_url("/template/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "procurement.created_at IS NOT NULL";

        $field_name = "procurement_name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND procurement." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "title";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND procurement." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "procurement_agency";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND procurement." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
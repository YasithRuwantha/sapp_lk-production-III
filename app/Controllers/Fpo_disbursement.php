<?php

namespace App\Controllers;
use App\Models\FpoModel;
use App\Models\FpoDisbursementModel;
use App\Models\FileregisteryModel;
use App\Models\LinkStartupfundDisbursementModel;

class Fpo_disbursement extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['activity_status'] = json_decode(get_config(117),TRUE); 

        $this->data['reg_model'] = new FileregisteryModel();
        $this->data['link_model'] = new LinkStartupfundDisbursementModel();

        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/fpo/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new FpoDisbursementModel();

        $this->data['list_all'] = $entity_model->select("startupfund_disbursement.*")
                            ->where($this->get_filter())
                            ->findAll(); 
                           

     
        return view('fpo_disbursement/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/fpo_disbursement/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new FpoDisbursementModel();
        $entity1_model = new FpoModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['project_list'] = $entity1_model->select("*")
                            ->findAll();

        $this->data['list_docs'] = $this->data['link_model']->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_startupfund_disbursement_file.file_id', 'left')
                            ->where("link_startupfund_disbursement_file.startupfund_disbursement_id",$id)
                            ->findAll();
        
        $this->process_form_add_edit($id);        

        return view('fpo_disbursement/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new FpoDisbursementModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

          
            $this->data['details'] = [
                'fpo_id' => $this->request->getVar('fpo_id'),
                'activity' => $this->request->getVar('activity'),
                'qty' => $this->request->getVar('qty'),
                'proposal_amount' => $this->request->getVar('proposal_amount'),
                'revised_amount' => $this->request->getVar('revised_amount'),
                'paper_advertisement_date' => $this->request->getVar('paper_advertisement_date'),
                'bid_opening_date' => $this->request->getVar('bid_opening_date'),
                'award_letter_issued_date' => $this->request->getVar('award_letter_issued_date'),
                'contract_signed_date' => $this->request->getVar('contract_signed_date'),
                'contract_end_date' => $this->request->getVar('contract_end_date'),
                'disbursement_date' => $this->request->getVar('disbursement_date'),
                'activity_status' => $this->request->getVar('activity_status'),
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

                $reg_model = new FileregisteryModel();
                
                $total = count($_FILES['img']['name']);

                for( $i=0 ; $i < $total ; $i++ ) {
                    if(is_file($_FILES["img"]["tmp_name"][$i])) 
                    {
                        $path = $_FILES['img']['name'][$i];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $sub_path = "public/resource/startupfund_disbursement/" . md5($path . time()) . "." . $ext;
                        $target_file = ROOTPATH . $sub_path;
                        if(move_uploaded_file($_FILES["img"]["tmp_name"][$i], $target_file)) 
                        {
                            $this->data['file_registery'] = [
                                'added_on' => time(),
                                'relative_path' => '/' . $sub_path,
                                'ref_table' => 'startupfund_disbursement',
                                'file_name' => $path,
                                'status' => 1,
                            ];

                            $this->data['reg_model']->insert($this->data['file_registery']);
                            $file_id = $this->data['reg_model']->getInsertID();

                            $this->data['file_link'] = [
                                'startupfund_disbursement_id' => $this->data['id'],
                                'file_id' => $file_id,
                            ];

                            $this->data['link_model']->insert($this->data['file_link']);
                            $link_id = $this->data['link_model']->getInsertID();

                            s3_upload($target_file,$sub_path);
                        }
                    }
                }
                
                header("Location:" . base_url("/fpo_disbursement/list_all/")); 
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
            'fpo_id' => [
                'label'  => 'FPO Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'activity' => [
                'label'  => 'Name of activity',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'qty' => [
                'label'  => 'Quantity of item',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'disbursement_date' => [
                'label'  => 'Disbursement Date  ',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'activity_status' => [
                'label'  => 'Activity Status ',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        $entity_model = new FpoDisbursementModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/fpo_disbursement/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "startupfund_disbursement.created_at IS NOT NULL";

        if(isset($_GET['activity']) && strlen(trim($_GET['activity'])) > 0)
        {
            $where .= " AND startupfund_disbursement.activity LIKE '%" . trim($_GET['activity']) . "%'";
        }

        return $where;
    }
}
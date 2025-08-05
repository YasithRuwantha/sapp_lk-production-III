<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\FarmerProjectModel;
use App\Models\ProjectModel;

class Farmer extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['vcm_recomendation'] = json_decode('{"1": "Approved", "2":"Rejected", "3":"Pending"}',TRUE);
        $this->data['rpc_recomendation'] = json_decode('{"1": "Approved", "2":"Rejected", "3":"Pending"}',TRUE);
        $this->data['liason_recomendation'] = json_decode('{"1": "Approved", "2":"Rejected", "3":"Pending"}',TRUE);
        $this->data['eligible_status'] = json_decode('{"1": "Recomended Farmer", "2":"Non Recommended Farmer"}',TRUE);
        $this->data['obtained_benifit'] = json_decode('{"1": "Loan", "2":"Grant"}',TRUE);
        $this->data['project_status'] = json_decode(get_config(19),TRUE);

        track();
    }

    public function project_update($id=0)
	{
        auth_rd();
        $this->data['csrf'] = 1;
        
        $entity_model = new FarmerProjectModel();
        $project_model = new ProjectModel();
        $this->data['id'] = $id;
        $this->data['obtained_benifit'] = json_decode('{"1": "Loan", "2":"Grant"}',TRUE);      
        
        $this->data['project_list'] = $project_model->select("*")
                                        ->findAll();

        $this->data['record'] = $entity_model->where('farmer_id', $id)
                                        ->first();

        $this->process_form_add_edit($id);        

        return view('farmer/project_update',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new FarmerProjectModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));
          
            $this->data['details'] = [
                'farmer_id' => $id,
                'project_id' => $this->request->getVar('project_id'),
                'purpose' => $this->request->getVar('purpose'),
                'contribution' => $this->request->getVar('contribution'),
                'vcm_recomendation' => $this->request->getVar('vcm_recomendation'),
                'vcm_recomendation_remark' => $this->request->getVar('vcm_recomendation_remark'),
                'rpc_recomendation' => $this->request->getVar('rpc_recomendation'),
                'rpc_recomendation_remark' => $this->request->getVar('rpc_recomendation_remark'),
                'liason_recomendation' => $this->request->getVar('liason_recomendation'),
                'liason_recomendation_remark' => $this->request->getVar('liason_recomendation_remark'),
                'vcm_approval_date_time' => $this->request->getVar('vcm_approval_date_time'),
                'rpc_approval_date_time' => $this->request->getVar('rpc_approval_date_time'),
                'liason_approval_date_time' => $this->request->getVar('liason_approval_date_time'),
                'project_status' => $this->request->getVar('project_status'),
                'eligible_status' => $this->request->getVar('eligible_status'),
                'pfi_ref_no' => $this->request->getVar('pfi_ref_no'),
                'obtained_benifit' => $this->request->getVar('obtained_benifit'),                
            ];

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['farmer_id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                    header("Location:" . base_url("/farmer/project_update/" . $id)); 
                    die;
                }
                else
                {
                    $entity_model->whereIn('farmer_id', [$id])
                                ->set($this->data['details'])
                                ->update();
                }                

                $this->data['record'] = $entity_model->where('farmer_id', $id)
                                                    ->first();
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
            'project_id' => [
                'label'  => 'Project',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'contribution' => [
                'label'  => 'Contribution',
                'rules'  => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            'purpose' => [
                'label'  => 'Purpose',
                'rules'  => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            'vcm_recomendation' => [
                'label'  => 'VCM Recomendation',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'vcm_recomendation_remark' => [
                'label'  => 'VCM Recomendation Remark',
                'rules'  => 'required|max_length[128]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 128 letters.",
                ]
            ],
            'rpc_recomendation' => [
                'label'  => 'RPC Recomendation',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'rpc_recomendation_remark' => [
                'label'  => 'RPC Recomendation Remark',
                'rules'  => 'required|max_length[128]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 128 letters.",
                ]
            ],
            'liason_recomendation' => [
                'label'  => 'Liason Recomendation',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'liason_recomendation_remark' => [
                'label'  => 'Liason Recomendation Remark',
                'rules'  => 'required|max_length[128]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 128 letters.",
                ]
            ],
            'vcm_approval_date_time' => [
                'label'  => 'VCM Approval Date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'rpc_approval_date_time' => [
                'label'  => 'RPC Approval Date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'liason_approval_date_time' => [
                'label'  => 'Liason Approval Date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'project_status' => [
                'label'  => 'Project Status',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'eligible_status' => [
                'label'  => 'Eligible Status',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'pfi_ref_no' => [
                'label'  => 'Pf Ref No',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'obtained_benifit' => [
                'label'  => 'Obtained Benefit',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'nature_agri_expense' => [
                'label'  => ucfirst(str_replace("_"," ","nature_agri_expense")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'expense_agri' => [
                'label'  => ucfirst(str_replace("_"," ","expense_agri")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],            
        ];
        
    }

    public function delete($id=0)
    {
        $entity_model = new FarmerProjectModel();

        $entity_model->delete($id);
        header("Location:" . base_url("farmer/project_update/" . $id)); 
        die;
    }
}
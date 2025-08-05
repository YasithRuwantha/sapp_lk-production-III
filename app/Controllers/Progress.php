<?php

namespace App\Controllers;
use App\Models\ProjectModel;
use App\Models\MonthlyProgressReportModel;
use App\Models\UserModel;
use App\Models\PromoterMetaModel;

class Progress extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect();  
        
        for($i=-24;$i<24;$i++)
        {
            if($i < 0)
            {
                $sign = "";
            }
            else
            {
                $sign = "+";
            }
            $this->data['reporting_month'][] = date('M - Y',strtotime($sign . $i . " month"));
        }

        track();        
    }

    public function list_all()
	{
        auth_rd(31);
        $this->data['active_module'] = "/progress/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new MonthlyProgressReportModel();
        $this->data['list_all'] = $entity_model->select("monthly_progress_report.id,monthly_progress_report.reporting_month,promoter.org_name,user.fname,user.lname,project.project_name")
                            ->join('promoter', 'promoter.id = monthly_progress_report.promoter_id', 'left')
                            ->join('user', 'user.id = monthly_progress_report.reporting_user_id ', 'left')
                            ->join('project', 'project.id = monthly_progress_report.project_id ', 'left')
                            ->findAll();

        return view('progress/list_all',$this->data);
    }

    public function view($id=0)
	{
        auth_rd(32);
        $this->data['active_module'] = "/progress/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new MonthlyProgressReportModel();
        $project_model = new ProjectModel();
        $user_model = new UserModel();
        $promoter_model = new PromoterMetaModel();
        $this->data['id'] = $id; 
                
        $this->data['record'] = $entity_model->find($id);
        $this->data['project_list'] = $project_model->findAll();
        $this->data['user_list'] = $user_model->findAll();
        $this->data['promoter_list'] = $promoter_model->findAll();

        $this->process_form_add_edit($id);        

        return view('progress/add_edit',$this->data);
    }


    public function add_edit($id=0)
	{
        // auth_rd(33);
        ($id == 0)? auth_rd(33): auth_rd(34); // Add:Edit
        $this->data['active_module'] = "/progress/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new MonthlyProgressReportModel();
        $project_model = new ProjectModel();
        $user_model = new UserModel();
        $promoter_model = new PromoterMetaModel();
        $this->data['id'] = $id; 
                
        $this->data['record'] = $entity_model->find($id);
        $this->data['project_list'] = $project_model->findAll();
        $this->data['user_list'] = $user_model->select("*")->whereIn('user_type', array(1,4))->findAll();
        $this->data['promoter_list'] = $promoter_model->findAll();

        $this->process_form_add_edit($id);        

        return view('progress/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new MonthlyProgressReportModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));
          
            $this->data['details'] = [
                'reporting_month' => $this->request->getVar('reporting_month'),
                'promoter_id' => $this->request->getVar('promoter_id'),
                'reporting_user_id' => $this->request->getVar('reporting_user_id'),
                'project_id' => $this->request->getVar('project_id'),
                'target_male' => $this->request->getVar('target_male'),
                'target_female' => $this->request->getVar('target_female'),
                'actual_male' => $this->request->getVar('actual_male'),
                'actual_female' => $this->request->getVar('actual_female'),
                'reg_farmers' => $this->request->getVar('reg_farmers'),
                'target_farmers' => $this->request->getVar('target_farmers'),
                'actual_farmer' => $this->request->getVar('actual_farmer'),
            ];

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                    header("Location:" . base_url("/progress/list_all")); 
                    die;
                }
                else
                {
                    $entity_model->update($id,$this->data['details']);
                    header("Location:" . base_url("/progress/list_all")); 
                    die;
                }                

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
            'reporting_month' => [
                'label'  => 'Report month',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'promoter_id' => [
                'label'  => 'Promoter',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'reporting_user_id' => [
                'label'  => 'Reporting user',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'project_id' => [
                'label'  => 'Project',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'target_male' => [
                'label'  => 'Target male',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'target_female' => [
                'label'  => 'Target female',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'actual_male' => [
                'label'  => 'Actual male',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'actual_female' => [
                'label'  => 'Actual female',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'reg_farmers' => [
                'label'  => 'Reg farmers',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'target_farmers' => [
                'label'  => 'Target farmers',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'actual_farmer' => [
                'label'  => 'Actual farmers',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        auth_rd(35);
        $entity_model = new MonthlyProgressReportModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/progress/list_all/")); 
        die;
    }

}
<?php

namespace App\Controllers;

use App\Models\GrandDisbursementModel;
use App\Models\GrandItemModel;
use App\Models\GrantModel;
use App\Models\ProjectModel;
use App\Models\ProjectStaffModel;

class Grant extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['role'] = json_decode(get_config(22),TRUE);

        track();
    }

    public function list_all()
	{
        auth_rd(145);
        $this->data['active_module'] = "/grant/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new GrantModel();
        $project_model = new ProjectModel();
        $grant_dis_model = new GrandDisbursementModel();

        $projectViewerList = array(25, 26, 27, 28, 29, 30, 31, 32, 33, 36);

        if(array_intersect($_SESSION['user']['groups'], $projectViewerList) && !in_array(2, $_SESSION['user']['groups'])){
            // get farmers related assigned project
        // if (in_array(32, $_SESSION['user']['groups']) && !in_array(2, $_SESSION['user']['groups'])) {
        // if (!in_array(2, $_SESSION['user']['groups'])) {
            $project_staff_model = new ProjectStaffModel();

            $projectData = $project_staff_model->select("*")
                ->where('user_id', $_SESSION['user']['id'])
                ->findAll();

            $projectList = array_column($projectData, 'project_id');

            // check if project is not empty
            if(isset($projectList)){
                $this->data['list_all'] = $entity_model->select("grant.*,project.project_name")
                    ->join('project', 'project.id = grant.project_id', 'left')
                    ->join('grant_disbursement', 'grant_disbursement.grant_id = grant.id', 'left')
                    // ->join('grant_item_farmer', 'grant_item_farmer.grant_disbursement_id = grant_disbursement.id', 'left')
                    // ->join('project_target', 'project_target.id = grant_disbursement.farmer_category','left')
                    ->where($this->get_filter())
                    ->whereIn('project.id', $projectList)
                    ->groupBy('grant.id')
                    ->findAll();
            }
            
        } else {
            $this->data['list_all'] = $entity_model->select("grant.*,project.project_name")
                ->join('project', 'project.id = grant.project_id', 'left')
                ->join('grant_disbursement', 'grant_disbursement.grant_id = grant.id', 'left')
                // ->join('grant_item_farmer', 'grant_item_farmer.grant_disbursement_id = grant_disbursement.id', 'left')
                // ->join('project_target', 'project_target.id = grant_disbursement.farmer_category','left')
                ->where($this->get_filter())
                ->groupBy('grant.id')
                ->findAll();
        }
        
        foreach($this->data['list_all'] as &$single_data)
        {

            $this->data['list_all_data'] = $grant_dis_model->select("*")
                                ->join('grant_item_farmer', 'grant_disbursement.id = grant_item_farmer.grant_disbursement_id','left')
                                // ->join('project_target', 'project_target.id = grant_disbursement.farmer_category','left')
                                ->join('project_target_item', 'project_target_item.id = grant_item_farmer.project_target_item_id', 'left')
                                ->where("grant_id", $single_data['id'])
                                ->groupBy('grant_disbursement.grant_id')
                                ->first();
            
            // append item discription to the list all
            if(isset($this->data['list_all_data']['item_description'])){
                $single_data['item_description'] = $this->data['list_all_data']['item_description'];
            } else {
                $single_data['item_description'] = '';
            }
        }

        $this->data['project_list'] = $project_model->findAll();

        return view('grant/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        if($id == 0){
            // add
            auth_rd(147);
        } else {
            // edit
            auth_rd(148);
        }
        $this->data['active_module'] = "/grant/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new GrantModel();
        $project_model = new ProjectModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->data['project_list'] = $project_model->select("*")
            ->whereIn('project_type', [1,2,3,4,6])
            ->where('deleted_at IS NULL')
            ->findAll();

        $this->process_form_add_edit($id);        

        return view('grant/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new GrantModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            // $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');

            // find already exist claim no
            $foundedClaimNo = $entity_model->select('*')
            ->where('project_id', $this->request->getVar('project_id'))
            ->where('grant_name', $this->request->getVar('grant_name'))
            ->findAll();

            // if claim no already exist
            if(isset($this->data['record']['id'])){
                if(!empty($foundedClaimNo) && $foundedClaimNo[0]['id'] != $this->data['record']['id'])
                {
                    $validation->setError('grant_name', 'This Claim No is already exist in this project.'); // set error
                }
            } else {
                if(!empty($foundedClaimNo))
                {
                    $validation->setError('grant_name', 'This Claim No is already exist in this project.'); // set error
                }
            }
          
            $this->data['details'] = [
                'project_id' => $this->request->getVar('project_id'),
                'grant_name' => $this->request->getVar('grant_name'),
                'grant_details' => $this->request->getVar('grant_details'),
                'value' => $this->request->getVar('value'),
            ];
            

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    cano_set_alert("success", "Record added successfully.");
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                }
                else
                {
                    cano_set_alert("success", "Record updated successfully.");
                    $entity_model->update($id,$this->data['details']);
                }   
                
                header("Location:" . base_url("/grant/list_all/")); 
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
            'project_id' => [
                'label'  => 'Project',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'grant_name' => [
                'label'  => 'Claim No',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'grant_details' => [
                'label'  => 'Claim details',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        auth_rd(149);
        $entity_model = new GrantModel();
        $grant_dis_model = new GrandDisbursementModel();
        $grant_dis_item_model = new GrandItemModel();

        // find grant disbursement data
        $grant_dis_all_data = $grant_dis_model->select("*")
        ->where("grant_id", $id)
        ->findAll();
        
        foreach($grant_dis_all_data as $data)
        {
            $grant_dis_item_model->where("grant_disbursement_id", $data['id'])->delete();
            $grant_dis_model->delete($data['id']);
        }

        $entity_model->delete($id);
        cano_set_alert("success","Record deleted successfully.");
        header("Location:" . base_url("/grant/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "grant.created_at IS NOT NULL";

        $field_name = "grant_name";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND `grant`." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        $field_name = "project_name";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND `project`." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        return $where;
    }
}
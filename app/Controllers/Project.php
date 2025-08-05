<?php

namespace App\Controllers;

use App\Models\FarmerProjectModel;
use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Models\GeographicLocationsModel;
use App\Models\GrandDisbursementModel;
use App\Models\GrandItemModel;
use App\Models\GrantModel;
use App\Models\LinkProjectTargetUserModel;
use App\Models\LoanDisbursementModel;
use App\Models\LoanModel;
use App\Models\ProjectExtentionModel;
use App\Models\ProjectStaffModel;
use App\Models\ProjectTargetItemModel;
use App\Models\ProjectTargetModel;
use Exception;

class Project extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['project_type'] = json_decode(get_config(18),TRUE);
        $this->data['project_status'] = json_decode(get_config(19),TRUE);
        $this->data['status_color'] = array(1=>"warning",2=>"default",3=>"primary",4=>"success",5=>"purple");

        $this->data['geo_model'] = new GeographicLocationsModel(); //GEO class

        track();
    }

    public function list_all()
	{
        auth_rd(13);
        $this->data['active_module'] = "/project/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new ProjectModel();
        $this->data['list_all'] = $entity_model->select("project.*,user.fname,user.lname")
                            ->join('user', 'user.id = project.project_incharge_id', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        // user's project list
        // Allows to Super admin and filter only their project
        // if(!in_array(2, $_SESSION['user']['groups']) && (in_array(32, $_SESSION['user']['groups']) || in_array(33, $_SESSION['user']['groups']) || in_array(34, $_SESSION['user']['groups']))){
        //     $project_staff_model = new ProjectStaffModel();
        //     $this->data['list_all'] = $project_staff_model->select("project.*,user.fname,user.lname")
        //         ->join('project', 'project.id = project_id', 'left')
        //         ->join('user', 'user.id = project.project_incharge_id', 'left')
        //         ->where($this->get_filter())
        //         ->where("user_id", $_SESSION['user']['id'])
        //         ->findAll();
        // }

        $projectViewerList = array(25, 26, 27, 28, 29, 30, 31, 32, 33, 36);

        if(array_intersect($_SESSION['user']['groups'], $projectViewerList) && !in_array(2, $_SESSION['user']['groups'])){
            // get farmers related assigned project
            $project_staff_model = new ProjectStaffModel();

            $projectData = $project_staff_model->select("*")
                ->where('user_id', $_SESSION['user']['id'])
                ->findAll();

            $projectList = array_column($projectData, 'project_id');

            // pre($projectList);

            // check if project is not empty
            if(isset($projectList)){

                // $this->data['list_all'] = $entity_model->select("loan.*,project.project_name")
                //     ->join('project', 'project.id = loan.project_id', 'left')
                //     ->where($this->get_filter())
                //     ->whereIn('project.id', $projectList)
                //     ->findAll();


                $this->data['list_all'] = $project_staff_model->select("project.*,user.fname,user.lname")
                    ->join('project', 'project.id = project_id', 'left')
                    ->join('user', 'user.id = project.project_incharge_id', 'left')
                    ->where($this->get_filter())
                    // ->where("user_id", $_SESSION['user']['id'])
                    ->whereIn('project.id', $projectList)
                    ->findAll();

                // pre($this->data['list_all']);
            }
            
        } else {
            $this->data['list_all'] = $entity_model->select("project.*,user.fname,user.lname")
                ->join('user', 'user.id = project.project_incharge_id', 'left')
                ->where($this->get_filter())
                ->findAll();
        }

        $user_model = new UserModel();
        $this->data['user_list'] = $user_model->select("*")
                            ->where("is_delete = 0")
                            ->findAll(5000,0);
        // pre($_SESSION['user']);
        // pre($this->data['list_all']);
        // die;

        return view('project/list_all',$this->data);
    }

    public function view($id=0){
        auth_rd(14); // check if user have view access
        
        $this->data['active_module'] = "/project/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new ProjectModel();
        $this->data['id'] = $id;      
        
        $user_model = new UserModel();
        $this->data['user_list'] = $user_model->select("*")
                            ->where("is_delete = 0 AND user_type = 4")
                            ->findAll(5000,0);

        $this->data['record'] = $entity_model->find($id);

        $this->data['geo_data'] = $this->data['geo_model']->select("*")->where("entity_table","project")->where("entity_id",$id)->first(); //GEO data

        $this->process_form_add_edit($id); 
        
        $this->data['geo_data'] = $this->data['geo_model']->select("*")->where("entity_table","project")->where("entity_id",$id)->first(); //GEO data       

        return view('project/add_edit',$this->data);
    }

    public function add_edit($id=0)
	{
        // auth_rd();
        ($id == 0)? auth_rd(15) : auth_rd(16); // check if user have add or edit access

        $this->data['active_module'] = "/project/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new ProjectModel();
        $this->data['id'] = $id;      
        
        $user_model = new UserModel();
        $this->data['user_list'] = $user_model->select("*")
                            ->where("is_delete = 0 AND user_type = 4")
                            ->findAll(5000,0);

        $this->data['record'] = $entity_model->find($id);

        $this->data['geo_data'] = $this->data['geo_model']->select("*")->where("entity_table","project")->where("entity_id",$id)->first(); //GEO data

        $this->process_form_add_edit($id); 
        
        $this->data['geo_data'] = $this->data['geo_model']->select("*")->where("entity_table","project")->where("entity_id",$id)->first(); //GEO data       

        return view('project/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new ProjectModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));
            // pre($this->request);
            // die;

            ($this->request->getVar('start_date')== null) ? $startDate = null : $startDate = $this->request->getVar('start_date');
            ($this->request->getVar('end_date')== null) ? $endDate = null : $endDate = $this->request->getVar('end_date');
            
          
            $this->data['details'] = [
                'project_name' => $this->request->getVar('project_name'),
                'project_type' => $this->request->getVar('project_type'),
                'address_no' => $this->request->getVar('address_no'),
                'address_street' => $this->request->getVar('address_street'),
                'address_city' => $this->request->getVar('address_city'),
                'project_incharge_id' => $this->request->getVar('project_incharge_id'),
                'project_status' => $this->request->getVar('project_status'),
                'start_date' => $startDate,
                'end_date' => $endDate
            ];

            if($validation->withRequest($this->request)->run())
            { 
                if($id==0)
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                    header("Location:" . base_url("/project/list_all")); 
                    die;
                }
                else
                {
                    $entity_model->update($this->data['id'],$this->data['details']);
                    header("Location:" . base_url("/project/list_all")); 
                    die;
                }

                /**
                 * GEO data related code
                 */
                $this->data['geo_details'] = [
                    'entity_table' => "project",
                    'entity_id' => $this->data['id'],
                ];                

                if(!isset($this->data['geo_data']['id']))
                {
                    $this->data['geo_model']->insert($this->data['geo_details']);
                }
                else
                {
                    $this->data['geo_model']->update($this->data['geo_data']['id'],$this->data['geo_details']);
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
            'project_name' => [
                'label'  => 'Project Name',
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => '{field} must have minimum of 3 letters.',
                ]
            ],
            'project_type' => [
                'label'  => 'Project type',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'project_incharge_id' => [
                'label'  => 'Project incharge',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'project_status' => [
                'label'  => 'Project status',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        auth_rd(17);
        
        $entity_model = new ProjectModel();
        $farmer_project_model = new FarmerProjectModel();
        $loan_model = new LoanModel();
        $loan_dis_model = new LoanDisbursementModel();
        $grant_model = new GrantModel();
        $grant_dis_model = new GrandDisbursementModel();
        $grant_item_farmer_model = new GrandItemModel();
        $link_project_staff_model = new ProjectStaffModel();
        $project_extension_model = new ProjectExtentionModel();
        $project_target_model = new ProjectTargetModel();
        $project_target_item_model = new ProjectTargetItemModel();
        $geographic_location_model = new GeographicLocationsModel();

        try {
            $this->data["db"]->transBegin();

            // find loan
            $loans = $loan_model->where('project_id', $id)->findAll();

            foreach ($loans as $loan) {
                // Delete loan 
                $loan_model->delete($loan['id']);
                // Delete loan disbursement
                $loan_dis_model->where('loan_disbursement_id', $loan['id'])->delete();
            }

            $grants = $grant_model->where('project_id', $id)->findAll();

            foreach($grants as $grant){
                // delete grant
                $grant_model->delete($grant['id']);

                // find grant disbursement list
                $grantDisList = $grant_dis_model->where('grant_id', $grant['id'])->findAll();

                foreach ($grantDisList as $grantDis) {
                    // delete grant disbursement
                    $grant_dis_model->delete($grantDis['id']);
                    // delete grant item
                    $grant_item_farmer_model->where('grant_disbursement_id', $grantDis['id'])->delete();
                }
            }

            // delete project staff model
            $link_project_staff_model->where('project_id', $id)->delete();

            // delete project extension
            $project_extension_model->where('project_id', $id)->delete();

            // find project target
            $projectTargets = $project_target_model->where('project_id', $id)->findAll();

            foreach ($projectTargets as $projectTarget) {
                // delete project target
                $project_target_model->delete($projectTarget['id']);
                // delete project target item
                $project_target_item_model->where('project_target_id', $projectTarget['id'])->delete();
            }

            // delete project geo data
            $geographic_location_model->where('entity_table', 'project')->where('entity_id', $id)->delete();

            // delete farmer project
            $farmer_project_model->where('project_id', $id)->delete();

            // delete project
            $entity_model->delete($id);

            $this->data["db"]->transCommit();
            cano_set_alert('success', 'Project deleted successfully.');
            
        } catch (Exception $e) {
            $this->data["db"]->transRollback();
            cano_set_alert('warning', $e->getMessage());
        }

        header("Location:" . base_url("/project/list_all/")); 
        die;      
    }

    private function get_filter()
    {
        $where = 'project.created_at IS NOT NULL';

        if(isset($_GET['project_name']) && strlen(trim($_GET['project_name'])) > 0)
        {
            $where .= " AND project.project_name LIKE '%" . trim($_GET['project_name']) . "%'";
        }

        if(isset($_GET['project_type']) && strlen(trim($_GET['project_type'])) > 0)
        {
            $where .= " AND project.project_type LIKE '%" . trim($_GET['project_type']) . "%'";
        }

        if(isset($_GET['project_incharge_id']) && strlen(trim($_GET['project_incharge_id'])) > 0)
        {
            $where .= " AND project.project_incharge_id LIKE '%" . trim($_GET['project_incharge_id']) . "%'";
        }

        if(isset($_GET['project_incharge_id']) && strlen(trim($_GET['project_incharge_id'])) > 0)
        {
            $where .= " AND project.project_incharge_id LIKE '%" . trim($_GET['project_incharge_id']) . "%'";
        }

        return $where;
    }
}
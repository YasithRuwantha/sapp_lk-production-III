<?php

namespace App\Controllers;
use App\Models\LoanModel;
use App\Models\ProjectModel;
use App\Models\ProjectStaffModel;
use App\Models\ProjectTargetModel;

class Loan extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['status_color'] = array(1=>"warning",2=>"default",3=>"primary",4=>"success",5=>"purple");
        $this->data['loan_status'] = json_decode('{"1":"Completed", "2":"In progress"}',TRUE);
        $this->data['status_applicant'] = json_decode('{"1":"Individual of a Company", "2":"Farmer Organization", "3":"Producer Organization", "4":"Farmer Group", "5":"Promoter"}',TRUE);
        $this->data['source_of_loan'] = json_decode('{"1":"IFAD Direct Line", "2":"RF - GoSL"}',TRUE);
        $this->data['type_of_loan_scheme'] = json_decode(get_config(31),TRUE);

        track();
    }

    public function get_project($id){
        auth_rd();

        if($id == 1){
            $project_type = array(1,2,3,4);
        } elseif($id == 2) {
            $project_type = 6;
        } elseif ($id == 3) {
            $project_type = 5;
        }
        
        $project_model = new ProjectModel();

        if(is_array($project_type)){
            // foreach ($project_type as $key => $value) {
                $project_list = $project_model->select("id, project_name")
                            ->whereIn('project_type', $project_type)
                            ->findAll();
            // }
        } else {
            $project_list = $project_model->select("id, project_name")
                                ->where('project_type', $project_type)
                                ->findAll();
        }

                            
        $field_name = "project_id";
        echo '<select class="form-select" name="' . $field_name . '">';
		if(!isset($record[$field_name])){ 
			echo  '<option value="">-- Select --</option>';
		}
        foreach($project_list as $key=>$val){ 
            if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ 
                $select = 'selected';  
            }else{
                $select = ''; 
            }
            echo '<option ' . $select . ' value="' . $val['id'] . '">' . $val['project_name'] . '</option>';
        }
		echo '</select>';

    }

    public function get_cat($lid=0,$id=0)
	{
        auth_rd();
        $entity_model = new ProjectTargetModel();
        $loan_model = new LoanModel();

        $cat_list = $entity_model->select("id, category_name")
                            ->where('project_id', $id)
                            ->findAll();                            
        
        $this->data['id'] = $id;
        
        $record = $loan_model->select("loan.*,project.project_name")
                            ->join('project', 'project.id = loan.project_id', 'left')
                            ->where("loan.id =" . $lid)
                            ->first();  

        $field_name = "category";

        echo '<select class="form-select" id="field-label-22" name="' . $field_name . '">';
		if(!isset($record[$field_name])){ 
			echo  '<option value="">-- Select --</option>';
		}
        foreach($cat_list as $key=>$val){ 
            if(isset($record[$field_name]) && $val['id'] == $record[$field_name]){ $select = 'selected';  }else{ $select = ''; }
            echo '<option ' . $select . ' value="' . $val['id'] . '">' . $val['category_name'] . '</option>';
        }
		echo '</select>';
    }

    public function list_all()
	{
        auth_rd(139);
        $this->data['active_module'] = "/loan/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new LoanModel();
        $project_model = new ProjectModel();

        // $this->data['list_all'] = $entity_model->select("loan.*,project.project_name")
        //                     ->join('project', 'project.id = loan.project_id', 'left')
        //                     ->where($this->get_filter())
        //                     ->findAll();
        $this->data['project_list'] = $project_model->select("*")
                            ->findAll();
        
        $projectViewerList = array(25, 26, 27, 28, 29, 30, 31, 32, 33, 36);

        if(array_intersect($_SESSION['user']['groups'], $projectViewerList) && !in_array(2, $_SESSION['user']['groups'])){
            // get farmers related assigned project
            $project_staff_model = new ProjectStaffModel();

            $projectData = $project_staff_model->select("*")
                ->where('user_id', $_SESSION['user']['id'])
                ->findAll();

            $projectList = array_column($projectData, 'project_id');

            // check if project is not empty
            if(isset($projectList)){

                $this->data['list_all'] = $entity_model->select("loan.*,project.project_name")
                    ->join('project', 'project.id = loan.project_id', 'left')
                    ->where($this->get_filter())
                    ->whereIn('project.id', $projectList)
                    ->findAll();
            }
            
        } else {
            $this->data['list_all'] = $entity_model->select("loan.*,project.project_name")
            ->join('project', 'project.id = loan.project_id', 'left')
            ->where($this->get_filter())
            ->findAll();
        }

        return view('loan/list_all',$this->data);
    }

    public function view($id=0){
        auth_rd(140);
        $this->data['active_module'] = "/loan/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new LoanModel();
        $project_model = new ProjectModel();
        
        $this->data['id'] = $id;

        $this->data['project_list'] = $project_model->select("*")
                            ->findAll();
        
        $this->data['record'] = $entity_model->select("loan.*,project.project_name")
                            ->join('project', 'project.id = loan.project_id', 'left')
                            ->where("loan.id =" . $this->data['id'])
                            ->first();  

        $this->process_form_add_edit($id);        

        return view('loan/add_edit',$this->data);
    }

    public function add_edit($id=0)
	{
        // auth_rd();
        if($id == 0){
            // add
            auth_rd(141);
        } else {
            // edit
            auth_rd(142);
        }
        // ($id == 0) ? auth_rd(141) : auth_rd(142); // add , edit

        $this->data['active_module'] = "/loan/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new LoanModel();
        $project_model = new ProjectModel();
        
        $this->data['id'] = $id;

        $this->data['project_list'] = $project_model->select("*")
                            ->findAll();
        
        $this->data['record'] = $entity_model->select("loan.*,project.project_name")
                            ->join('project', 'project.id = loan.project_id', 'left')
                            ->where("loan.id =" . $this->data['id'])
                            ->first();  

        $this->process_form_add_edit($id);        

        return view('loan/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new LoanModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            if("" !== $this->request->getVar('project_id'))
            {
                $project_id = $this->request->getVar('project_id');
            }else{
                $project_id = 1;
            }
          
            $this->data['details'] = [
                'project_id' => $project_id,
                'loan_scheme_name' => $this->request->getVar('loan_scheme_name'),
                'main_purpose' => $this->request->getVar('main_purpose'),
                'sub_purpose' => $this->request->getVar('sub_purpose'),
                'type_of_loan_scheme' => $this->request->getVar('type_of_loan_scheme'),
                'loan_requirement' => $this->request->getVar('loan_requirement'),
                'loan_status' => $this->request->getVar('loan_status'),
                'category' => $this->request->getVar('category'),
            ];
            
            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();

                    // cano_set_alert("success", "Loan scheme added successfully."); 
                    header("Location:" . base_url("/loan/list_all")); 
                    die;
                }
                else
                {
                    $entity_model->update($id,$this->data['details']);
                    // cano_set_alert("success", "Loan scheme updated successfully.");
                    header("Location:" . base_url("/loan/list_all")); 
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
            'type_of_loan_scheme' => [
                'label'  => 'Type of loan scheme',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],         
            'loan_scheme_name' => [
                'label'  => 'Scheme name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'main_purpose' => [
                'label'  => 'Main purpose',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'sub_purpose' => [
                'label'  => 'Sub purpose',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],            
            'loan_requirement' => [
                'label'  => 'Loan requirement',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],         
            'loan_status' => [
                'label'  => 'Loan status',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        auth_rd(143);
        $entity_model = new LoanModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/loan/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "loan.created_at IS NOT NULL";

        if(isset($_GET['project_id']) && strlen(trim($_GET['project_id'])) > 0)
        {
            $where .= " AND loan.project_id = " . trim($_GET['project_id']);
        }

        if(isset($_GET['loan_scheme_name']) && strlen(trim($_GET['loan_scheme_name'])) > 0)
        {
            $where .= " AND loan.loan_scheme_name LIKE '%" . trim($_GET['loan_scheme_name']) . "%'";
        }

        if(isset($_GET['status_applicant']) && strlen(trim($_GET['status_applicant'])) > 0)
        {
            $where .= " AND loan.status_applicant = " . trim($_GET['status_applicant']);
        }

        if(isset($_GET['loan_status']) && strlen(trim($_GET['loan_status'])) > 0)
        {
            $where .= " AND loan.loan_status = " . trim($_GET['loan_status']);
        }

        return $where;
    }
}
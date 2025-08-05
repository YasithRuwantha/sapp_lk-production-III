<?php

namespace App\Controllers;
use App\Models\ProjectStaffModel;
use App\Models\UserModel;
use App\Models\ProjectModel;


class Project_staff extends BaseController
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

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/project_staff/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new ProjectStaffModel();
        $user_model = new UserModel();
        $project_model = new ProjectModel();

        $this->data['list_all'] = $entity_model->select("link_project_staff.*,project.project_name,user.fname,user.lname,user.pin")
                            ->join('project', 'project.id = link_project_staff.project_id', 'left')
                            ->join('user', 'user.id = link_project_staff.user_id', 'left')
                            ->where($this->get_filter($entity_id))
                            ->findAll();
        // $this->data['user_list'] = $user_model->findAll();
        $this->data['project_list'] = $project_model->findAll();

        return view('project_staff/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/project_staff/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new ProjectStaffModel();
        $user_model = new UserModel();
        $project_model = new ProjectModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  
        $this->data['user_list'] = $user_model->where('user_type', 1)->findAll();
        $this->data['project_list'] = $project_model->findAll();


        $this->process_form_add_edit($entity_id,$id);        

        return view('project_staff/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new ProjectStaffModel();        

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'project_id' => $entity_id,
                'user_id' => $this->request->getVar('user_id'),
                'role' => $this->request->getVar('role'),
            ];
            

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();

                    $user_model = new UserModel();
                    $project_model = new ProjectModel();

                    $user = $user_model->select("*")
                                        ->where("id", $this->request->getVar('user_id'))
                                        ->first();

                    $project = $project_model->select("*")
                                        ->where("id", $entity_id)
                                        ->first();

                    $to = $user['email'];
                    $subject = "Added to project";
                    $title = "You are added to a project<br />Check the SAPP for the details.";
                    $message = '<p>Hi ' . $user['fname'] . ' ' . $user['lname'] . ' </p><p> We\'d like to inform that you are allocated to project: ' . $project['project_name'] . '. Please visit SAPP for more details. </p>';
                    
                    send_mail($to,$subject,$title,$message); 
                }
                else
                {
                    $entity_model->update($id,$this->data['details']);
                }   
                
                header("Location:" . base_url("/project_staff/list_all/" . $entity_id . "/")); 
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
            'user_id' => [
                'label'  => 'Staff',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'role' => [
                'label'  => 'Role',
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
        $entity_model = new ProjectStaffModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/project_staff/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter($entity_id)
    {
        $where = "link_project_staff.project_id = ".$entity_id;

        $field_name = "full_name";
        $field_first_name = "user.fname";
        $field_last_name = "user.lname";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND CONCAT(".$field_first_name.",' ',".$field_last_name . ") LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        $field_name = "role";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND link_project_staff." . $field_name . "= " .$_POST[$field_name]."";
        }

        return $where;
    }

    public function get_staff_list($group_id){
        auth_rd();
        $this->data['csrf'] = 1;
        
        $entity_model = new ProjectStaffModel();
        $user_model = new UserModel();
        $project_model = new ProjectModel();
        
        if($group_id == 1){
            // VCM
            $group_id = 32;
        } elseif ($group_id == 2){
            // RPC
            $group_id = 33;
        } elseif ($group_id == 3){
            // PMU Support Staff
            $group_id = array(4, 5, 6, 7, 8, 9, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 34, 37);
        } elseif ($group_id == 4){
            // Consultant
            $group_id = array(10, 11, 12, 13, 14, 15, 38);
        } elseif ($group_id == 5){
            // Liaison Officer
            $group_id = 36;
        }
        
        $this->data['user_list'] = array();
        if(is_array($group_id)){
            foreach($group_id as $value){
                $users = $user_model->select("*")
                    ->join('link_user_group', 'link_user_group.user_id = id', 'left')
                    ->where('link_user_group.group_id', $value)
                    ->where('user_type', 1)
                    ->findAll();
                $this->data['user_list'] = array_merge($this->data['user_list'], $users);;
            }
        } else {
            $this->data['user_list'] = $user_model->select("*")
                ->join('link_user_group', 'link_user_group.user_id = id', 'left')
                ->where('link_user_group.group_id', $group_id)
                ->where('user_type', 1)
                ->findAll();
        }


        // Avoid duplicate data
        $uniqueResults = [];
        $seenData = [];

        foreach ($this->data['user_list'] as $row) {
            // Define a key based on the criteria you want to use for uniqueness
            $key = $row['id']; // Example key, use the criteria that defines uniqueness
        
            if (!isset($seenData[$key])) {
                $uniqueResults[] = $row;
                $seenData[$key] = true;
            }
        }

        echo '<option value="">-- Select --</option>';
        foreach ($uniqueResults as $key => $val) {
            echo '<option class="entity" value="' . $val['id'] . '">' . $val['fname'] . ' ' . $val['lname'] . '</option>';
        }
        die;
    }
}
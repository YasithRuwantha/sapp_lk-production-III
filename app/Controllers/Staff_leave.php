<?php

namespace App\Controllers;
use App\Models\StaffLeaveModel;
use App\Models\UserModel;

class Staff_leave extends BaseController
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
            $this->data['report_period'][] = date('M/y',strtotime($sign . $i . " month"));
        }
        track();
    }

    public function list_all()
	{
        auth_rd(37);
        $this->data['active_module'] = "/staff_leave/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new StaffLeaveModel();
        $this->data['list_all'] = $entity_model->select("staff_leave.*,user.fname,user.lname")
                            ->join('user', 'user.id = staff_leave.user_id', 'left')
                            ->findAll();

        return view('staff_leave/list_all',$this->data);
    }

    public function list_mine()
	{
        auth_rd();
        $this->data['active_module'] = "/staff_leave/list_mine/";
        $this->data['csrf'] = 1;
        
        $entity_model = new StaffLeaveModel();
        $this->data['list_all'] = $entity_model->select("staff_leave.*,user.fname,user.lname")
                            ->join('user', 'user.id = staff_leave.user_id', 'left')
                            ->where('staff_leave.user_id',$_SESSION['user']['id'])
                            ->findAll();

        return view('staff_leave/list_mine',$this->data);
    }

    public function add_edit($id=0)
	{
        // auth_rd();
        ($id == 0)? auth_rd(39): auth_rd(40); // Add:Edit
        $this->data['active_module'] = "/staff_leave/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new StaffLeaveModel();
        $user_model = new UserModel();
        
        $this->data['user_list'] = $user_model->where("user_type",1)->findAll();
        $this->data['id'] = $id;      
        
        $this->data['record'] = $entity_model->find($id);

        $this->process_form_add_edit($id);        

        return view('staff_leave/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new StaffLeaveModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));
          
            $this->data['details'] = [
                'user_id' => $this->request->getVar('user_id'),
                'report_period' => $this->request->getVar('report_period'),
                'no_casual_leave' => $this->request->getVar('no_casual_leave'),
                'no_annual_leave' => $this->request->getVar('no_annual_leave'),
                'no_sick_leave' => $this->request->getVar('no_sick_leave'),
                'no_duty_leave' => $this->request->getVar('no_duty_leave'),
                'no_nopay_leave' => $this->request->getVar('no_nopay_leave'),
                'no_lieu_leave' => $this->request->getVar('no_lieu_leave'),
                'no_short_leave' => $this->request->getVar('no_short_leave'),
                'hrs_overtime' => $this->request->getVar('hrs_overtime'),
                //'no_ph_work' => $this->request->getVar('no_ph_work'),
            ];

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                    header("Location:" . base_url("/staff_leave/list_all/")); 
                    die;
                }
                else
                {
                    $entity_model->update($id,$this->data['details']);
                    header("Location:" . base_url("/staff_leave/list_all/")); 
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
            'user_id' => [
                'label'  => 'User',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'report_period' => [
                'label'  => 'Report period',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        auth_rd(41);
        $entity_model = new StaffLeaveModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/staff_leave/list_all/")); 
        die;
    }
}
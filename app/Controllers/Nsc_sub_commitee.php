<?php

namespace App\Controllers;
use App\Models\SubCommiteeMembersModel;
use App\Models\LinkNscSubCommiteeModel;


class Nsc_sub_commitee extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['category'] = json_decode(get_config(24),TRUE);
        $this->data['status'] = json_decode(get_config(25),TRUE);
        $this->data['sub_commitee'] = json_decode(get_config(26),TRUE);

        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd(73);
        $this->data['active_module'] = "/nsc_sub_commitee/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new SubCommiteeMembersModel();

        $this->data['list_all'] = $entity_model->select("sub_commitee_members.*,nsc_meeting.nsc_meeting_no,nsc_meeting.nsc_meeting_date")
                            ->join('link_nsc_sub_commitee', 'sub_commitee_members.id = link_nsc_sub_commitee.sub_commitee_id', 'left')
                            ->join('nsc_meeting', 'nsc_meeting.id = link_nsc_sub_commitee.nsc_meeting_id ', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        return view('nsc_sub_commitee/list_all',$this->data);
    }

    public function view($entity_id=0,$id=0)
	{
        auth_rd(74);
        $this->data['active_module'] = "/nsc_sub_commitee/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new SubCommiteeMembersModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->process_form_add_edit($entity_id,$id);        

        return view('nsc_sub_commitee/add_edit',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        // auth_rd();
        ($id == 0) ? auth_rd(75) : auth_rd(76); // Add : Edit
        $this->data['active_module'] = "/nsc_sub_commitee/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new SubCommiteeMembersModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->process_form_add_edit($entity_id,$id);        

        return view('nsc_sub_commitee/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new SubCommiteeMembersModel();
        $link_model = new LinkNscSubCommiteeModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $this->data['details'] = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                'designation' => $this->request->getVar('designation'),
                'organization' => $this->request->getVar('organization'),
                'category' => $this->request->getVar('category'),
                'status' => $this->request->getVar('status'),
                // 'sub_commitee' => $this->request->getVar('sub_commitee'),
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

                $this->data['link_record'] = $link_model->select("*")
                            ->where("sub_commitee_id", $this->data['id'])
                            ->where("nsc_meeting_id", $this->data['entity_id'])
                            ->first();  

                if(!isset($this->data['link_record']['nsc_meeting_id']))
                {
                    $this->data['link_details'] = [
                        'sub_commitee_id' => $this->data['id'],
                        'nsc_meeting_id' => $this->data['entity_id'],
                    ];
                    $link_model->insert($this->data['link_details']);
                }
                
                header("Location:" . base_url("/nsc_sub_commitee/list_all/" . $entity_id . "/")); 
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
            'first_name' => [
                'label'  => 'First name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'last_name' => [
                'label'  => 'Last name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'designation' => [
                'label'  => 'Designation',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'organization' => [
                'label'  => 'Organization',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'category' => [
                'label'  => 'Category',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            // 'sub_commitee' => [
            //     'label'  => 'Sub commitee',
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
        ];
        
    }

    public function delete($entity_id=0,$id=0)
    {
        auth_rd(77);
        $this->data['entity_id'] = $entity_id;
        $entity_model = new SubCommiteeMembersModel();
        $link_model = new LinkNscSubCommiteeModel();

        $link_model->where('nsc_meeting_id', $entity_id)->where('sub_commitee_id', $id)->delete();
        $entity_model->delete($id);
        header("Location:" . base_url("/nsc_sub_commitee/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = 'link_nsc_sub_commitee.nsc_meeting_id =' . $this->data['entity_id'];

        $field_name = "first_name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND link_nsc_sub_commitee." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "last_name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND link_nsc_sub_commitee." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "designation";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND link_nsc_sub_commitee." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "organization";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND link_nsc_sub_commitee." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "category";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND link_nsc_sub_commitee." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "status";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND link_nsc_sub_commitee." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "sub_commitee";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND link_nsc_sub_commitee." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}
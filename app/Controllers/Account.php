<?php

namespace App\Controllers;
use App\Models\AccountModel;
use App\Models\AccountUserModel;

class Account extends BaseController
{
    private $data;

    public function __construct()
    {
        helper('cano'); //Constructer won't auto load helpers. So manual load required.

        $this->data = array();
        $_SESSION['cu'] = get_current_url();

        $this->data['account_status'] = array(1=>"Active",2=>"Locked");
        $this->data['date_formats'] = array(
            'dd/mm/yyyy' => '21/04/' . date('Y'),
            'mm/dd/yyyy' => '04/21/' . date('Y'),
            'yyyy-mm-dd' => date('Y') . '-04-21'
        );

        $this->data["user"] = json_decode(json_encode(wp_get_current_user()),TRUE);
        
        if(!isset($_SESSION['account']['id']))
        {            
            cano_set_alert("danger",'<strong>Select an account!</strong> Please select an account to work with accounting section. Account can be selected <a href="'.base_url("/account/list_all").'">here</a>');
        }     
    }

    public function select_account($id)
	{
        auth_rd();  //Checking for authenticated user
        $account_model = new AccountModel();
        $account_details = $account_model->select('id,label,fy_start,fy_end,status,priviledge')->join('ven_account_user', 'ven_account.id = ven_account_user.account_id', 'left')->where("ven_account.id =".$id." AND ven_account_user.user_id =" . $this->data["user"]['ID'])->first();
        if(isset($account_details['id']))
        {
            cano_set_alert("primary",'<strong>Success!</strong> You have successfully selected the account "'.$account_details['label'].'".');
            $_SESSION['account']['id'] = $id;
        }
        else
        {
            cano_set_alert("warning",'<strong>Warning!</strong> You don\'t have priviledge to select that account.');
        }
        return $this->response->redirect(base_url('/account/list_all'));
    }

    public function list_all()
	{
        auth_rd();  //Checking for authenticated user

        $account_model = new AccountModel();

        /**
         * Building breadcrumb for selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Accounts','url'=>base_url("/account/list_all")),
            array('label'=>'Account List')
        );

        $this->data['list_all'] = $account_model->select('id,label,fy_start,fy_end,status,priviledge')->join('ven_account_user', 'ven_account.id = ven_account_user.account_id', 'left')->where("ven_account_user.user_id =" . $this->data["user"]['ID'])->findAll();

        return view('account/list_all',$this->data);
    }

    public function add_edit($id=0,$lock=0)
	{
        auth_rd();  //Checking for authenticated user
        $this->data['id'] = $id;    //Assigining the selected entity id for front end  

        /**
         * Handle entity locking
         */
        $this->data['entity_lock'] = lock_entity($id,"ven_account");
        if($lock==1 && isset($this->data['entity_lock']['id']))
        {
            relese_entity($this->data['entity_lock']['id']);
            $this->response->redirect(base_url('/account/list_all'));
        }

        /**
         * Building breadcrumb fo selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Accounts','url'=>base_url("/account/list_all")),
            array('label'=>'Account Details')
        );


        /**
         * Load the data for editing
         */
        $this->get_account($id);  

        /**
         * Processing form submission
         */
        $this->process_form($id);

        $this->data['csrf'] = $this->data['entity_lock']['csrf_id'];

		return view('account/add_edit',$this->data);
    }

    public function delete($id)
    {
        $account_model = new AccountModel();    
        $account_user_model = new AccountUserModel(); 

        $account_details = $account_model->select('id,label,fy_start,fy_end,status,priviledge')->join('ven_account_user', 'ven_account.id = ven_account_user.account_id', 'left')->where("ven_account.id =".$id." AND ven_account_user.user_id =" . $this->data["user"]['ID'])->first();
        if(isset($account_details['id']))
        {
            $account_user_model->where('account_id = ' . $id)->delete();
            $account_model->where('id = ' . $id)->delete();            
            cano_set_alert("primary",'<strong>Success!</strong> Account "'.$account_details['label'].'" deleted successfully.');
        }
        else
        {
            cano_set_alert("warning",'<strong>Warninig!</strong> You don\'t have priviledge to access that account.');
        }
        return $this->response->redirect(base_url('/account/list_all'));
    }

    private function get_account($id=0)
    {
        if($id > 0)
        {
            $account_model = new AccountModel();    
            $account_user_model = new AccountUserModel(); 
            $this->data['details'] = $account_model->where('id', $id)->first();

            if(isset($this->data['details']['id']))
            {
                $this->data['details']['fy_start'] = date("Y-m-d", $this->data['details']['fy_start']);
                $this->data['details']['fy_end'] = date("Y-m-d", $this->data['details']['fy_end']);
                $users = $account_user_model->select('user_id')->where('account_id', $id)->findAll();
                if(isset($users) && is_array($users))
                {
                    foreach($users as $uval)
                    {
                        $this->data['details1']['users[]'][] = $uval['user_id'];
                    }
                }
            }
            else
            {
                $this->response->redirect(base_url('/account/list_all'));
                die;
            }
        }
    }

    private function process_form($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $account_model = new AccountModel();        

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_account());

            
            
            $this->data['details'] = [
                'label' => $this->request->getVar('label'),
                'account_owner' => $this->data["user"]['ID'],
                'currency_symbol' => $this->request->getVar('currency_symbol'),
                'date_format' => $this->request->getVar('date_format'),
                'status' => $this->request->getVar('status'),
                'fy_start' => strtotime($this->request->getVar('fy_start') . " 00:00:00"),
                'fy_end' => strtotime($this->request->getVar('fy_end') . " 23:59:00"),
            ];

            if($validation->withRequest($this->request)->run())
            { 
                if($id==0)
                {
                    $account_model->insert($this->data['details']);
                    $this->data['id'] = $account_model->getInsertID();
                }
                else
                {
                    $account_model->update($this->data['id'],$this->data['details']);
                }
                
                $this->update_user_account();   //updating the secondry tables

                if(isset($this->data['entity_lock']['id']))
                {
                    relese_entity($this->data['entity_lock']['id']);
                }
                return $this->response->redirect(base_url('/account/list_all'));
            }
            else
            {
                $this->data['details']['fy_start'] = $this->request->getVar('fy_start');
                $this->data['details']['fy_end'] = $this->request->getVar('fy_end');
            }
        }
    }

    private function update_user_account()
    {
        $account_user_model = new AccountUserModel();

        $this->data['details1']['users[]'] = $this->request->getVar('users');
                
        $account_user_model->where('account_id', $this->data['id'])->delete();

        $ua_data = [
            'account_id' => $this->data['id'],
            'user_id' => $this->data["user"]['ID'],
            'start_date' => time(),
            'end_date' => (time() + 1576800000),
            'priviledge' => '{"read":1,"write":1,"grand":1}'
        ];
        $account_user_model->insert($ua_data);                

        if(isset($this->data['details1']['users[]']) && is_array($this->data['details1']['users[]']))
        {
            foreach($this->data['details1']['users[]'] as $uval)
            {
                $ua_data = [
                    'account_id' => $this->data['id'],
                    'user_id' => $uval,
                    'start_date' => time(),
                    'end_date' => (time() + 1576800000),
                    'priviledge' => '{"read":1,"write":1,"grand":1}'
                ];
                if($this->data["user"]['ID']!=$uval)
                {
                    $account_user_model->insert($ua_data);
                }
            }
        }
    }

    private function validation_rules_account()
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'label' => [
                'label'  => 'Account name',
                'rules'  => 'required|min_length[5]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => '{field} must have minimum of 5 letters.'
                ]
            ],
            'fy_start' => [
                'label'  => 'Financial year start',
                'rules'  => 'required|cano_date_earlier['.$this->request->getVar('fy_end').']',
                'errors' => [
                    'required' => '{field} is mandatory.',
                    'cano_date_earlier' => '{field} must be earlier than end date.'
                ]
            ],
            'fy_end' => [
                'label'  => 'Financial year end',
                'rules'  => 'required|cano_date_later['.$this->request->getVar('fy_start').']',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'cano_date_later' => '{field} must be earlier than end date.'
                ]
            ],
            'currency_symbol' => [
                'label'  => 'Currency symbol',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'date_format' => [
                'label'  => 'Date format',
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
            ]
        ];
    }
}
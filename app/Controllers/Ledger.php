<?php

namespace App\Controllers;
use App\Models\LedgerModel;
use App\Models\AccGroupModel;

class Ledger extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect();
        
        $_SESSION['cu'] = get_current_url();

        $this->data["user"] = json_decode(json_encode(wp_get_current_user()),TRUE);   

        $this->data["opening_balance"] = array('c' => "Credit", 'd' => "Debit");

        if(!isset($_SESSION['account']['id']))
        {
            cano_set_alert("danger",'<strong>Select an account!</strong> Please select an account to work with accounting section. Account can be selected <a href="'.base_url("/account/list_all").'">here</a>');
            header('Location: '.base_url('/account/list_all'));
            exit(); 
        }
    }

    public function list_all()
	{
        auth_rd();  //Checking for authenticated user

        $entity_model = new LedgerModel();

        /**
         * Building breadcrumb fo selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Accounts','url'=>base_url("/account/list_all")),
            array('label'=>'Account List')
        );

        $this->data['list_all'] = $entity_model->select('ven_acc_ledgers.id,ven_acc_ledgers.name AS ledger,ven_acc_ledgers.code,ven_acc_groups.name AS acc_group')
                            ->join('ven_acc_groups', 'ven_acc_groups.id = ven_acc_ledgers.group_id', 'left')
                            ->where("ven_acc_ledgers.account_id =" . $_SESSION['account']['id'])->findAll();

        return view('ledger/list_all',$this->data);
    }

    public function add_edit($id=0,$lock=0)
	{
        auth_rd();  //Checking for authenticated user
        $this->data['id'] = $id;    //Assigining the selected entity id for front end  

        $acc_group_model = new AccGroupModel();  
        $this->data['acc_group'] = $acc_group_model->where('account_id IS NULL OR account_id =' . $_SESSION['account']['id'])->findAll();

        /**
         * Handle entity locking
         */
        $this->data['entity_lock'] = lock_entity($id,"ven_acc_ledgers");
        if($lock==1 && isset($this->data['entity_lock']['id']))
        {
            relese_entity($this->data['entity_lock']['id']);
            return $this->response->redirect(base_url('/ledger/list_all'));
        }

        /**
         * Building breadcrumb fo selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Ledgers','url'=>base_url("/accgroup/list_all")),
            array('label'=>'Ledger Details')
        );


        /**
         * Load the data for editing
         */
        $this->get_entity($id);  

        /**
         * Processing form submission
         */
        $this->process_form($id);

        $this->data['csrf'] = $this->data['entity_lock']['csrf_id'];

		return view('ledger/add_edit',$this->data);
    }

    public function delete($id)
    {
        $entity_model = new LedgerModel(); 

        $entity_details = $entity_model->select('id,name')->where('id', $id)->where('account_id', $_SESSION['account']['id'])->first();
        
        $query = $this->data["db"]->query('SELECT * FROM ven_acc_entry_items WHERE ledger_id =' . $id);
        $num = $query->getNumRows();
        
        if(isset($entity_details['id']) && $num==0)
        {
            $entity_model->where('id', $id)->where('account_id', $_SESSION['account']['id'])->delete();            
            cano_set_alert("primary",'<strong>Success!</strong> Account "'.$entity_details['name'].'" deleted successfully.');
        }
        else
        {
            cano_set_alert("warning",'<strong>Warning!</strong> You don\'t have priviledge to access that account. Or the record have dependencies.');
        }
        return $this->response->redirect(base_url('/accgroup/list_all'));
    }

    private function get_entity($id=0)
    {
        if($id > 0)
        {
            $entity_model = new LedgerModel();  
            $this->data['details'] = $entity_model->where('id', $id)->where('account_id', $_SESSION['account']['id'])->first();

            if(!isset($this->data['details']['id']))
            {                
                $this->response->redirect(base_url('/ledger/list_all'));
                die;
            }
        }

        $this->data["db"] = \Config\Database::connect();

        $sub_query = "SELECT COUNT(*) FROM `ven_acc_ledgers` WHERE `group_id` = ";
        $query = $this->data["db"]->query("SELECT id, name, code, parent_id, '' AS parent_group, 0 AS depth, (".$sub_query." ven_acc_groups.id) AS num FROM ven_acc_groups WHERE parent_id IS NULL AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")");
        $result_set = $query->getResultArray();
        $this->data['group_list'] = $result_set;

        if(isset($this->data['group_list']) && is_array($this->data['group_list']))
        {
            foreach($this->data['group_list'] as $lid=>$lval)
            {
                $query1 = $this->data["db"]->query("SELECT id, name, code, parent_id, '" . $lval['name'] . "' AS parent_group, 1 AS depth, (".$sub_query." ven_acc_groups.id) AS num FROM ven_acc_groups WHERE parent_id =" . $lval['id'] . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")");
                $this->data['group_list'][$lid]['child'] = $query1->getResultArray();

                $this->data['list_all'][$lval['id']] = $lval;

                if(isset($this->data['group_list'][$lid]['child']) && is_array($this->data['group_list'][$lid]['child']))
                {
                    foreach($this->data['group_list'][$lid]['child'] as $lid1=>$lval1)
                    {
                        $query2 = $this->data["db"]->query("SELECT id, name, code, parent_id, '" . $lval1['name'] . "' AS parent_group, 2 AS depth, (".$sub_query." ven_acc_groups.id) AS num FROM ven_acc_groups WHERE parent_id =" . $lval1['id'] . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")");
                        $this->data['group_list'][$lid]['child'][$lid1]['child'] = $query2->getResultArray();
                        $this->data['list_all'][$lval1['id']] = $lval1;

                        if(isset($this->data['group_list'][$lid]['child'][$lid1]['child']) && is_array($this->data['group_list'][$lid]['child'][$lid1]['child']))
                        {
                            foreach($this->data['group_list'][$lid]['child'][$lid1]['child'] as $lval2)
                            {
                                unset($lval2['child']);
                                $this->data['list_all'][$lval2['id']] = $lval2;
                            }
                        }
                    }
                }
            }
        }
    }

    private function process_form($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new LedgerModel();      

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_account());

            $this->data['details'] = [
                'account_id' => $_SESSION['account']['id'],
                'group_id' => $this->request->getVar('group_id'),
                'name' => $this->request->getVar('name'),
                'code' => $this->request->getVar('code'),
                'opening_balance' => $this->request->getVar('opening_balance'),
                'opening_balance_debit_credit' => $this->request->getVar('opening_balance_debit_credit'),
                'notes' => $this->request->getVar('notes'),
            ];

            if($validation->withRequest($this->request)->run())
            { 
                if($id==0)
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                }
                else
                {
                    $entity_model->update($this->data['id'],$this->data['details']);
                }
                
                if(isset($this->data['entity_lock']['id']))
                {
                    relese_entity($this->data['entity_lock']['id']);
                }
                return $this->response->redirect(base_url('/accgroup/list_all'));
            }
        }
    }

    private function validation_rules_account()
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'name' => [
                'label'  => 'Ledger name',
                'rules'  => 'required|min_length[5]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => '{field} must have minimum of 5 letters.'
                ]
            ],
            'code' => [
                'label'  => 'Ledger code',
                'rules'  => 'alpha',
                'errors' => [
                    'alpha' => 'Only letters are allowed'
                ]
            ],
            'opening_balance' => [
                'label'  => 'Opening balance',
                'rules'  => 'decimal',
                'errors' => [
                    'alpha' => 'Only numbers allowed (Ex. 2500.00)'
                ]
            ],
            'opening_balance_debit_credit' => [
                'label'  => 'Opening balance (credit / debit)',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'group_id' => [
                'label'  => 'Parent group',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'notes' => [
                'label'  => 'Remarks',
                'rules'  => 'min_length[5]',
                'errors' => [
                    'min_length' => '{field} must have minimum of 5 letters.'
                ]
            ],
        ];
    }
}
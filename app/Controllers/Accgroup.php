<?php

namespace App\Controllers;
use App\Models\AccGroupModel;
use App\Models\LedgerModel;

class Accgroup extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect();
        
        $_SESSION['cu'] = get_current_url();

        $this->data["user"] = json_decode(json_encode(wp_get_current_user()),TRUE);   

        if(!isset($_SESSION['account']['id']))
        {
            cano_set_alert("danger",'<strong>Select an account!</strong> Please select an account to work with accounting section. Account can be selected <a href="'.base_url("/account/list_all").'">here</a>');
            header('Location: '.base_url('/account/list_all'));
            exit(); 
        }

        $sub_query = "SELECT COUNT(*) FROM `ven_acc_ledgers` WHERE `group_id` = ";
        $ledger_sub_query = "SELECT COUNT(*) FROM `ven_acc_entry_items` WHERE `ledger_id` = ";
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
                            foreach($this->data['group_list'][$lid]['child'][$lid1]['child'] as $lid2=>$lval2)
                            {
                                unset($lval2['child']);
                                $this->data['list_all'][$lval2['id']] = $lval2;

                                /**
                                 * Ledgers of this group loaded here
                                 */
                                $ledquery3 = $this->data["db"]->query("SELECT id, name, code, group_id AS parent_id, '" . $lval2['name'] . "' AS parent_group, 3 AS depth, (".$ledger_sub_query." ven_acc_ledgers.id) AS num, 1 AS ledger FROM ven_acc_ledgers WHERE group_id =" . $lval2['id'] . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")");
                                $this->data['group_list'][$lid]['child'][$lid1]['child'][$lid2]['child'] = $ledquery3->getResultArray();
                                $this->data['list_all'][$lval2['id']] = $lval2;

                                if(isset($this->data['group_list'][$lid]['child'][$lid1]['child'][$lid2]['child']) && is_array($this->data['group_list'][$lid]['child'][$lid1]['child'][$lid2]['child']))
                                {
                                    foreach($this->data['group_list'][$lid]['child'][$lid1]['child'][$lid2]['child'] as $lval3)
                                    {
                                        unset($lval3['child']);
                                        $this->data['list_all']["ledger" . $lval3['id']] = $lval3;
                                    }
                                }
                            }
                        }

                        /**
                         * Ledgers of this group loaded here
                         */
                        $ledquery2 = $this->data["db"]->query("SELECT id, name, code, group_id AS parent_id, '" . $lval1['name'] . "' AS parent_group, 2 AS depth, (".$ledger_sub_query." ven_acc_ledgers.id) AS num, 1 AS ledger FROM ven_acc_ledgers WHERE group_id =" . $lval1['id'] . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")");
                        $this->data['group_list'][$lid]['child'][$lid1]['child'] = $ledquery2->getResultArray();
                        $this->data['list_all'][$lval1['id']] = $lval1;

                        if(isset($this->data['group_list'][$lid]['child'][$lid1]['child']) && is_array($this->data['group_list'][$lid]['child'][$lid1]['child']))
                        {
                            foreach($this->data['group_list'][$lid]['child'][$lid1]['child'] as $lval2)
                            {
                                unset($lval2['child']);
                                $this->data['list_all']["ledger" . $lval2['id']] = $lval2;
                            }
                        }
                    }
                }

                /**
                 * Ledgers of this group loaded here
                 */
                $ledquery1 = $this->data["db"]->query("SELECT id, name, code, group_id AS parent_id, '" . $lval['name'] . "' AS parent_group, 1 AS depth, (".$ledger_sub_query." ven_acc_ledgers.id) AS num, 1 AS ledger FROM ven_acc_ledgers WHERE group_id =" . $lval['id'] . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")");
                $this->data['group_list'][$lid]['child'] = $ledquery1->getResultArray();
                $this->data['list_all'][$lval['id']] = $lval;

                if(isset($this->data['group_list'][$lid]['child']) && is_array($this->data['group_list'][$lid]['child']))
                {
                    foreach($this->data['group_list'][$lid]['child'] as $lval1)
                    {
                        unset($lval1['child']);
                        $this->data['list_all']["ledger" . $lval1['id']] = $lval1;
                    }
                }
            }
        }

        $this->data["affects"] = array(0 => "Net profit & loss", 1 => "Gross profit & loss");
    }

    public function list_all()
	{
        auth_rd();  //Checking for authenticated user

        /**
         * Building breadcrumb fo selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Account group','url'=>base_url("/accgroup/list_all")),
            array('label'=>'Account Group')
        );        

        return view('accgroup/list_all',$this->data);
    }

    public function add_edit($id=0,$lock=0)
	{
        auth_rd();  //Checking for authenticated user
        $this->data['id'] = $id;    //Assigining the selected entity id for front end 
                
        /**
         * Handle entity locking
         */
        $this->data['entity_lock'] = lock_entity($id,"ven_acc_groups");
        if($lock==1 && isset($this->data['entity_lock']['id']))
        {
            relese_entity($this->data['entity_lock']['id']);
            return $this->response->redirect(base_url('/accgroup/list_all'));
        }

        /**
         * Building breadcrumb fo selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Account Group','url'=>base_url("/accgroup/list_all")),
            array('label'=>'Group Details')
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

		return view('accgroup/add_edit',$this->data);
    }

    public function delete($id)
    {
        $entity_model = new AccGroupModel(); 

        $entity_details = $entity_model->select('id,name')->where('id', $id)->where('account_id', $_SESSION['account']['id'])->first();
        
        $query = $this->data["db"]->query('SELECT * FROM `ven_acc_ledgers` WHERE `group_id` =' . $id);
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
            $entity_model = new AccGroupModel();  
            $this->data['details'] = $entity_model->where('id', $id)->where('account_id', $_SESSION['account']['id'])->first();

            if(!isset($this->data['details']['id']))
            {                
                $this->response->redirect(base_url('/accgroup/list_all'));
                die;
            }
        }
    }

    private function process_form($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new AccGroupModel();      

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity());

            $this->data['details'] = [
                'account_id' => $_SESSION['account']['id'],
                'parent_id' => $this->request->getVar('parent_id'),
                'name' => $this->request->getVar('name'),
                'code' => $this->request->getVar('code'),
                'affects_gross' => $this->request->getVar('affects_gross'),
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

    private function validation_rules_entity()
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
            ]
        ];
    }
}
<?php

namespace App\Controllers;
use App\Models\AccGroupModel;
use App\Models\LedgerModel;

class Accreport extends BaseController
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
    }

    public function transactions($id=0)
	{
        auth_rd();  //Checking for authenticated user

        /**
         * Building breadcrumb fo selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Group','url'=>base_url("/accgroup/list_all")),
            array('label'=>'Balance Sheet')
        );   
        
        $this->data['list_all1'] = array();
        
        $query = $this->data["db"]->query("SELECT * FROM ven_acc_ledgers AS al 
                    LEFT JOIN ven_account AS a ON al.account_id = a.id
                    WHERE al.id = " . $id . " AND al.account_id = " . $_SESSION['account']['id']);
        $result_set = $query->getResultArray();

        $balance_progress = 0;

        if($result_set[0]['id'])
        {
            $this->data['ledger'] = $result_set[0];
            $data = array("notes"=>"Opening balance","date"=>$result_set[0]['fy_start']);
            if($result_set[0]['opening_balance_debit_credit']=="c")
            {
                $data['credit'] = $result_set[0]['opening_balance'];   
                $balance_progress = 0-$result_set[0]['opening_balance'];             
            }
            else
            {
                $data['debit'] = $result_set[0]['opening_balance'];
                $balance_progress = $result_set[0]['opening_balance'];
            }
            $data['net_balance'] = $balance_progress;
            $this->data['list_all1'][] = $data;
        }

        $query = $this->data["db"]->query("SELECT * FROM ven_acc_entry_items AS ei
                LEFT JOIN ven_acc_entries AS e ON ei.entity_id = e.id
                WHERE ei.ledger_id = " . $id . " ORDER BY e.planned_date ASC, e.id ASC");
        $result_set = $query->getResultArray();

        foreach($result_set as $val)
        {
            $data = array("notes"=>$val['notes'],"date"=>$val['planned_date']);
            if($val['debit_credit']=="c")
            {
                $data['credit'] = $val['amount'];
                $balance_progress = $balance_progress - $val['amount'];
            }
            else
            {
                $data['debit'] = $val['amount'];
                $balance_progress = $balance_progress + $val['amount'];
            }
            $data['net_balance'] = $balance_progress;
            $this->data['list_all1'][] = $data;
        }

        return view('accreport/transactions',$this->data);
    }

    public function list_all()
	{
        auth_rd();  //Checking for authenticated user

        /**
         * Building breadcrumb fo selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Reports','url'=>base_url("/account/list_all")),
            array('label'=>'Balance Sheet')
        );        

        $this->data['list_all1'] = $this->get_group(1,"d");
        $this->data['list_all2'] = $this->get_group(2,"c");

        return view('accreport/list_all',$this->data);
    }

    public function profit_loss()
	{
        auth_rd();  //Checking for authenticated user

        /**
         * Building breadcrumb fo selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Reports','url'=>base_url("/account/list_all")),
            array('label'=>'Profit and Loss Statement')
        );        

        $this->data['list_all1'] = $this->get_group(4,"d");
        $this->data['list_all2'] = $this->get_group(3,"c");

        return view('accreport/profit_loss',$this->data);
    }

    private function get_group($id,$crdr="c")
    {
        $this->data['group_list'] = array();
        $this->data['list_all'] = array();

        $sub_query = "SELECT COUNT(*) FROM `ven_acc_ledgers` WHERE `group_id` = ";
        $ledger_sub_query = "SELECT COUNT(*) FROM `ven_acc_entry_items` WHERE `ledger_id` = ";
        $query = $this->data["db"]->query("SELECT id, name, code, parent_id, '' AS parent_group, 0 AS depth, (".$sub_query." ven_acc_groups.id) AS num, affects_gross FROM ven_acc_groups WHERE parent_id IS NULL AND id=". $id . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")");
        $result_set = $query->getResultArray();
        $this->data['group_list'] = $result_set;

        if(isset($this->data['group_list']) && is_array($this->data['group_list']))
        {
            foreach($this->data['group_list'] as $lid=>$lval)
            {
                $query1 = $this->data["db"]->query("SELECT id, name, code, parent_id, '" . $lval['name'] . "' AS parent_group, 1 AS depth, (".$sub_query." ven_acc_groups.id) AS num, affects_gross FROM ven_acc_groups WHERE parent_id =" . $lval['id'] . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")");
                $this->data['group_list'][$lid]['child'] = $query1->getResultArray();

                $this->data['list_all'][$lval['id']] = $lval;

                if(isset($this->data['group_list'][$lid]['child']) && is_array($this->data['group_list'][$lid]['child']))
                {
                    foreach($this->data['group_list'][$lid]['child'] as $lid1=>$lval1)
                    {
                        $query2 = $this->data["db"]->query("SELECT id, name, code, parent_id, '" . $lval1['name'] . "' AS parent_group, 2 AS depth, (".$sub_query." ven_acc_groups.id) AS num, affects_gross FROM ven_acc_groups WHERE parent_id =" . $lval1['id'] . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")");
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
                                $sql = "SELECT id, name, code, group_id AS parent_id, opening_balance, opening_balance_debit_credit, '" . $lval2['name'] . "' AS parent_group, 
                                3 AS depth, (".$ledger_sub_query." ven_acc_ledgers.id) AS num, 
                                1 AS ledger, 
                                (SELECT SUM(amount) FROM ven_acc_entry_items WHERE ledger_id = ven_acc_ledgers.id AND debit_credit LIKE 'd') AS dr_total,
                                (SELECT SUM(amount) FROM ven_acc_entry_items WHERE ledger_id = ven_acc_ledgers.id AND debit_credit LIKE 'c') AS cr_total,
                                (SELECT affects_gross FROM ven_acc_groups WHERE id = ven_acc_ledgers.group_id LIMIT 1) AS affects_gross                         
                                FROM ven_acc_ledgers WHERE group_id =" . $lval2['id'] . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")";                                
                                $ledquery3 = $this->data["db"]->query($sql);
                                $this->data['group_list'][$lid]['child'][$lid1]['child'][$lid2]['child'] = $ledquery3->getResultArray();
                                $this->data['list_all'][$lval2['id']] = $lval2;
                                $this->data['list_all'][$lval2['id']]['net_total'] = $this->net_total($lval2,$crdr);

                                if(isset($this->data['group_list'][$lid]['child'][$lid1]['child'][$lid2]['child']) && is_array($this->data['group_list'][$lid]['child'][$lid1]['child'][$lid2]['child']))
                                {
                                    foreach($this->data['group_list'][$lid]['child'][$lid1]['child'][$lid2]['child'] as $lval3)
                                    {
                                        unset($lval3['child']);
                                        $this->data['list_all']["ledger" . $lval3['id']] = $lval3;
                                        $this->data['list_all']["ledger" . $lval3['id']]['net_total'] = $this->net_total($lval3,$crdr);
                                    }
                                }
                            }
                        }

                        /**
                         * Ledgers of this group loaded here
                         */
                        $sql = "SELECT id, name, code, group_id AS parent_id, opening_balance, opening_balance_debit_credit, '" . $lval1['name'] . "' AS parent_group, 2 AS depth, 
                        (".$ledger_sub_query." ven_acc_ledgers.id) AS num, 1 AS ledger,
                        (SELECT SUM(amount) FROM ven_acc_entry_items WHERE ledger_id = ven_acc_ledgers.id AND debit_credit LIKE 'd') AS dr_total,
                        (SELECT SUM(amount) FROM ven_acc_entry_items WHERE ledger_id = ven_acc_ledgers.id AND debit_credit LIKE 'c') AS cr_total,
                        (SELECT affects_gross FROM ven_acc_groups WHERE id = ven_acc_ledgers.group_id LIMIT 1) AS affects_gross
                        FROM ven_acc_ledgers WHERE group_id =" . $lval1['id'] . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")";
                        $ledquery2 = $this->data["db"]->query($sql);
                        $this->data['group_list'][$lid]['child'][$lid1]['child'] = $ledquery2->getResultArray();
                        $this->data['list_all'][$lval1['id']] = $lval1;

                        if(isset($this->data['group_list'][$lid]['child'][$lid1]['child']) && is_array($this->data['group_list'][$lid]['child'][$lid1]['child']))
                        {
                            foreach($this->data['group_list'][$lid]['child'][$lid1]['child'] as $lval2)
                            {
                                unset($lval2['child']);
                                $this->data['list_all']["ledger" . $lval2['id']] = $lval2;
                                $this->data['list_all']["ledger" . $lval2['id']]['net_total'] = $this->net_total($lval2,$crdr);
                            }
                        }
                    }
                }

                /**
                 * Ledgers of this group loaded here
                 */
                $sql = "SELECT id, name, code, group_id AS parent_id, opening_balance, opening_balance_debit_credit, '" . $lval['name'] . "' AS parent_group, 1 AS depth, 
                (".$ledger_sub_query." ven_acc_ledgers.id) AS num, 1 AS ledger,
                (SELECT SUM(amount) FROM ven_acc_entry_items WHERE ledger_id = ven_acc_ledgers.id AND debit_credit LIKE 'd') AS dr_total,
                (SELECT SUM(amount) FROM ven_acc_entry_items WHERE ledger_id = ven_acc_ledgers.id AND debit_credit LIKE 'c') AS cr_total,
                (SELECT affects_gross FROM ven_acc_groups WHERE id = ven_acc_ledgers.group_id LIMIT 1) AS affects_gross 
                FROM ven_acc_ledgers WHERE group_id =" . $lval['id'] . " AND (account_id IS NULL OR account_id = " . $_SESSION['account']['id'] . ")";
                $ledquery1 = $this->data["db"]->query($sql);
                $this->data['group_list'][$lid]['child'] = $ledquery1->getResultArray();
                $this->data['list_all'][$lval['id']] = $lval;               

                if(isset($this->data['group_list'][$lid]['child']) && is_array($this->data['group_list'][$lid]['child']))
                {
                    foreach($this->data['group_list'][$lid]['child'] as $lval1)
                    {
                        unset($lval1['child']);
                        $this->data['list_all']["ledger" . $lval1['id']] = $lval1;
                        $this->data['list_all']["ledger" . $lval1['id']]['net_total'] = $this->net_total($lval1,$crdr);
                    }
                }
            }
        }

        return $this->data['list_all'];
    }    

    private function net_total($obj,$crdr="c")
    {
        $total = 0;

        if(isset($obj['opening_balance_debit_credit']) && $obj['opening_balance_debit_credit']==$crdr)
        {
            if(isset($obj['opening_balance'])){ $total += $obj['opening_balance']; }
        }
        else
        {
            if(isset($obj['opening_balance'])){ $total -= $obj['opening_balance']; }            
        }

        if($crdr=="c")
        {
            if(isset($obj['cr_total'])){ $total += $obj['cr_total']; }
            if(isset($obj['dr_total'])){ $total -= $obj['dr_total']; }
        }
        else
        {
            if(isset($obj['cr_total'])){ $total -= $obj['cr_total']; }
            if(isset($obj['dr_total'])){ $total += $obj['dr_total']; }
        }

        return $total;
    }

    public function poc($id=0)
	{
        auth_rd();  //Checking for authenticated user

        /**
         * Building breadcrumb fo selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Group','url'=>base_url("/accgroup/list_all")),
            array('label'=>'Balance Sheet')
        );   
        
        $this->data['list_all1'] = array();
        
        $query = $this->data["db"]->query("SELECT * FROM ven_acc_ledgers AS al 
                    LEFT JOIN ven_account AS a ON al.account_id = a.id
                    WHERE al.id = " . $id . " AND al.account_id = " . $_SESSION['account']['id']);
        $result_set = $query->getResultArray();

        $balance_progress = 0;

        if($result_set[0]['id'])
        {
            $this->data['ledger'] = $result_set[0];
            $data = array("notes"=>"Opening balance","date"=>$result_set[0]['fy_start']);
            if($result_set[0]['opening_balance_debit_credit']=="c")
            {
                $data['credit'] = $result_set[0]['opening_balance'];   
                $balance_progress = 0-$result_set[0]['opening_balance'];             
            }
            else
            {
                $data['debit'] = $result_set[0]['opening_balance'];
                $balance_progress = $result_set[0]['opening_balance'];
            }
            $data['net_balance'] = $balance_progress;
            $this->data['list_all1'][] = $data;
        }

        $query = $this->data["db"]->query("SELECT * FROM ven_acc_entry_items AS ei
                LEFT JOIN ven_acc_entries AS e ON ei.entity_id = e.id
                WHERE ei.ledger_id = " . $id . " ORDER BY e.planned_date ASC, e.id ASC");
        $result_set = $query->getResultArray();

        foreach($result_set as $val)
        {
            $data = array("notes"=>$val['notes'],"date"=>$val['planned_date']);
            if($val['debit_credit']=="c")
            {
                $data['credit'] = $val['amount'];
                $balance_progress = $balance_progress - $val['amount'];
            }
            else
            {
                $data['debit'] = $val['amount'];
                $balance_progress = $balance_progress + $val['amount'];
            }
            $data['net_balance'] = $balance_progress;
            $this->data['list_all1'][] = $data;
        }

        pre($this->data['list_all1']);
    }
}
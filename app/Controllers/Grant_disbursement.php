<?php

namespace App\Controllers;

use App\Models\FarmerProjectModel;
use DateTime;
use Exception;
use App\Models\UserModel;
use App\Models\GrantModel;
use App\Models\ProjectModel;
use App\Models\GrandItemModel;
use App\Models\ProjectTargetModel;
use App\Models\UserDesignationModel;
use App\Models\GrandDisbursementModel;
use App\Models\ProjectTargetItemModel;
use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\isEmpty;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Grant_disbursement extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();

        helper('cano_helper'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect();

        $this->data['disbursement_status'] = json_decode(get_config(23), TRUE);

        track();
    }

    public function list_all($entity_id = 0)
    {
        auth_rd(145);
        $this->data['active_module'] = "/grant_disbursement/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;

        $entity_model = new GrandDisbursementModel();
        $user_model = new UserModel();
        $grant_model = new GrantModel();

        $this->data['list_all'] = $entity_model->select("grant_disbursement.*,grant.grant_name,user.fname,user.lname,user.pin")
            ->join('grant', 'grant.id = grant_disbursement.grant_id', 'left')
            ->join('user', 'user.id = grant_disbursement.farmer_id', 'left')
            ->where($this->get_filter())
            ->findAll();
        $this->data['user_list'] = $user_model->where("user_type", 2)->findAll();
        $this->data['grant_list'] = $grant_model->findAll();

        return view('grant_disbursement/list_all', $this->data);
    }

    public function group_list_all($entity_id = 0)
    {
        auth_rd(145);
        $this->data['active_module'] = "/grant_disbursement/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;

        $entity_model = new GrandDisbursementModel();
        $user_model = new UserModel();
        $grant_model = new GrantModel();
        $grant_item_model = new GrandItemModel();

        // $this->data['list_all2'] = $entity_model->select("project_target_item.*,grant_disbursement.*,grant_item_farmer.qty as per_farmer_qty,project_target.category_name as category_name,grant.grant_name,user.fname,user.lname,user.pin")
        //     ->join('grant', 'grant.id = grant_disbursement.grant_id', 'left')
        //     ->join('user', 'user.id = grant_disbursement.farmer_id', 'left')
        //     ->join('grant_item_farmer', 'grant_disbursement.id = grant_item_farmer.grant_disbursement_id', 'left')
        //     ->join('project_target_item', 'project_target_item.id = grant_item_farmer.project_target_item_id', 'left')
        //     ->where($this->group_get_filter())
            //->groupBy(['grant_disbursement.grant_id', 'grant_disbursement.remarks'])
            // ->findAll();

        $this->data['list_all_data'] = $entity_model->select("project_target_item.*,grant_disbursement.*,project_target.category_name,grant_item_farmer.qty as per_farmer_qty")
            ->join('grant_item_farmer', 'grant_disbursement.id = grant_item_farmer.grant_disbursement_id','left')
            ->join('project_target', 'project_target.id = grant_disbursement.farmer_category','left')
            ->join('project_target_item', 'project_target_item.id = grant_item_farmer.project_target_item_id', 'left')
            ->where("grant_id", $entity_id)
            // ->groupBy("grant_disbursement.remarks","grant_item_farmer.per_farmer_qty","grant_disbursement.date_of_grant","project_target.category_name")
            ->findAll();

            // Duplicate subarrays remove
            $this->data['list_all']= [];
            $uniqueArray = [];
            foreach($this->data['list_all_data'] as $subArray){
                // Creating a unique key based on 'remarks', 'per_farmer_qty', 'date_of_grant', and 'category_name'
                $key = $subArray['remarks'] . '-' . $subArray['per_farmer_qty']. '-' . $subArray['date_of_grant']. '-' . $subArray['category_name'];
                if (!isset($uniqueArray[$key])) {
                    $uniqueArray[$key] = $subArray;
                }
            }
            $this->data['list_all'] = array_values($uniqueArray); // Re-index the array to remove keys
            
        //     $query = $this->data["db"]->query("SELECT id, category_name FROM project_target where project_id = " . $this->data['grant']['project_id']);
        // $this->data['demo'] = $query->getResultArray();

//        $this->data['item_list_my'] =  $grant_item_model->select('*')
//            ->where("grant_disbursement_id",$entity_id)
//            ->findAll();

        // $this->data['user_list'] = $user_model->where("user_type", 2)->findAll();
        $this->data['grant_list'] = $grant_model->findAll();

//        echo $this->data['entity_id'];
    //    pre($this->data['list_all_data']);
    //    die();

        return view('grant_disbursement/group_list_all', $this->data);
    }

    public function view($entity_id = 0, $id = 0){
        auth_rd(146);
        $this->data['active_module'] = "/group_grant_disbursement/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;

        $this->data['disbursement_status'] = json_decode(get_config(100), TRUE);

        $entity_model = new GrandDisbursementModel();
        $user_model = new UserModel();
        $grant_model = new GrantModel();

        $this->data['id'] = $id;

        $this->data['record'] = $entity_model->select("*")
            ->where("id", $id)
            ->first();

        $this->data['grant_list'] = $grant_model->findAll();

        $this->data['grant'] = $grant_model->select("*")
            ->where("id", $entity_id)
            ->first();
        $query = $this->data["db"]->query("SELECT id, category_name, no_of_farmers FROM project_target where project_id = " . $this->data['grant']['project_id'] ." AND deleted_at IS NULL");
        $this->data['farmer_category'] = $query->getResultArray();

        $query = $this->data["db"]->query("SELECT * FROM grant_item_farmer WHERE grant_disbursement_id = " . $id);
        $this->data['item_record'] = $query->getRowArray();


        if (isset($this->data['record']['schedule_by'])) {
            $query = $this->data["db"]->query("SELECT fname,lname FROM user WHERE id = " . $this->data['record']['schedule_by']);
            $this->data['user'] = $query->getRowArray();
        } elseif (isset($this->data['record']['hold_by'])) {
            $query = $this->data["db"]->query("SELECT fname, lname FROM user WHERE id = " . $this->data['record']['hold_by']);
            $this->data['user'] = $query->getRowArray();
        } elseif (isset($this->data['record']['disbursed_by'])){
            $query = $this->data["db"]->query("SELECT fname, lname FROM user WHERE id = " . $this->data['record']['disbursed_by']);
            $this->data['user'] = $query->getRowArray();
        }

        $query = $this->data["db"]->query("SELECT project_target_item.id, project_target_item.item_description FROM project_target_item 
        left JOIN project_target ON project_target_item.project_target_id = project_target.id
        WHERE project_target.project_id =" . $this->data['grant']['project_id'] . " AND project_target.id = 6");
        $this->data['item_list'] = $query->getResultArray();

        $where_farm_cat = "";

        if (isset($this->data['record']['farmer_category']) && $this->data['record']['farmer_category'] > 0) {
            $where_farm_cat = " and project_target.id = " . $this->data['record']['farmer_category'];
        }

        $query = $this->data["db"]->query("SELECT DISTINCT user.id, eligible_status as category, concat(user.fname, user.lname, '/',user.pin) AS farmer FROM farmer_project 
        LEFT JOIN user ON farmer_project.farmer_id = user.id 
        LEFT JOIN project_target ON project_target.project_id = farmer_project.project_id
        WHERE farmer_project.deleted_at IS NULL AND user.deleted_at IS NULL AND farmer_project.project_id =" . $this->data['grant']['project_id'] . $where_farm_cat );
        $this->data['farmer_list'] = $query->getResultArray();

        // $query = $this->data["db"]->query("SELECT farmer_id FROM grant_disbursement WHERE grant_id = " . $entity_id);
        // $selected_farmers = $query->getResultArray();

        $query = $this->data["db"]->query("SELECT * FROM grant_item_farmer WHERE grant_disbursement_id =" . $id);
        $selected_items= $query->getResultArray();

        if ($id != 0) {
            // $selected_farmers = $entity_model->select("grant_disbursement.farmer_id")
            // $selected_farmers = $entity_model->select("*")
            //     ->join('grant_item_farmer', 'grant_item_farmer.grant_disbursement_id = grant_disbursement.id', 'left')
            //     ->where('grant_item_farmer.project_target_item_id' , $selected_items[0]['project_target_item_id'])
            //     ->where('grant_disbursement.grant_id' , $entity_id)
            //     ->where('grant_disbursement.id' , $id)
            //     // ->groupBy('remarks')
            //     ->findAll();

                // select farmer using id and entity id
            $farmer = $entity_model->select("*")
                ->join('grant_item_farmer', 'grant_item_farmer.grant_disbursement_id = grant_disbursement.id', 'left')
                ->where('grant_disbursement.grant_id' , $entity_id)
                ->where('grant_disbursement.id' , $id)
                ->first();

                // get the remark
            // $common_remark = $farmer['remarks'];

                // find farmers same remak and grant_dis_id
            $selected_farmers = $entity_model->select("*")
                ->join('grant_item_farmer', 'grant_item_farmer.grant_disbursement_id = grant_disbursement.id', 'left')
                ->where('grant_item_farmer.project_target_item_id' , $selected_items[0]['project_target_item_id'])
                ->where('grant_disbursement.grant_id' , $entity_id)
                // ->groupBy('remarks')
                ->findAll();

        }

        $query = $this->data["db"]->query("SELECT project_target_item.id, project_target_item.item_description, project_target_item.amount FROM project_target_item 
        left JOIN project_target ON project_target_item.project_target_id = project_target.id
        WHERE project_target.project_id =" . $this->data['grant']['project_id'] . $where_farm_cat);
        $this->data['item_list'] = $query->getResultArray();

        if (isset($selected_farmers) && is_array($selected_farmers)) {
            foreach ($selected_farmers as $val) {
                $this->data['selected_farmers'][] = $val['farmer_id'];
            }
        } else {
            $this->data['selected_farmers'] = array();
        }

        if (isset($selected_items) && is_array($selected_items)) {
            foreach ($selected_items as $val) {
                $this->data['selected_items'][] = $val['project_target_item_id'];
            }
        } else {
           $this->data['selected_items'] = array();
        }

        if (isset($this->data['item_list']) && is_array($this->data['item_list']) && isset($this->data['selected_items'])) {
            foreach($this->data['item_list'] as $val){
                if($this->data['selected_items'][0] == $val['id']){
                    $this->data['price_as_per_project_target'] = $val['amount'];
                }
            }
        }else{
            $this->data['price_as_per_project_target'] = 0;
        }

        if (isset($this->data['item_record']) && is_array($this->data['item_record'])) {
            $this->data['selected_items_actual_price'] = $this->data['item_record']['price'];
        }else{
            $this->data['selected_items_actual_price'] = 0;
        }

        $this->group_process_form_add_edit($entity_id, $id);

        return view('grant_disbursement/group_add_edit', $this->data);
    }

    public function add_edit($entity_id = 0, $id = 0)
    {
        auth_rd();
        $this->data['active_module'] = "/grant_disbursement/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;

        $this->data['disbursement_status'] = json_decode(get_config(100), TRUE);

        $entity_model = new GrandDisbursementModel();
        $user_model = new UserModel();
        $grant_model = new GrantModel();

        $this->data['id'] = $id;

        $this->data['record'] = $entity_model->select("*")
            ->where("id", $id)
            ->first();
        $this->data['user_list'] = $user_model->where('user_type', 2)->findAll();
        $this->data['grant_list'] = $grant_model->findAll();

        $this->data['grant'] = $grant_model->select("*")
            ->where("id", $entity_id)
            ->first();
        $query = $this->data["db"]->query("SELECT id, category_name FROM project_target where project_id = " . $this->data['grant']['project_id']);
        $this->data['farmer_category'] = $query->getResultArray();

        $query = $this->data["db"]->query("SELECT project_target_item.id, project_target_item.item_description FROM project_target_item 
        left JOIN project_target ON project_target_item.project_target_id = project_target.id
        WHERE project_target.project_id =" . $this->data['grant']['project_id'] . " AND project_target.id = 6");
        $this->data['item_list'] = $query->getResultArray();

        $this->process_form_add_edit($entity_id, $id);

        return view('grant_disbursement/add_edit', $this->data);
    }

    private function process_form_add_edit($entity_id = 0, $id = 0)
    {
        $validation = \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new GrandDisbursementModel();

        if (isset($_POST['csrf'])) {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');

            $this->data['details'] = [
                'grant_id' => $entity_id,
                'farmer_id' => $this->request->getVar('farmer_id'),
                'remarks' => $this->request->getVar('remarks'),
                'total_grant_provided' => $this->request->getVar('total_grant_provided'),
                'max_grant_amount' => $this->request->getVar('max_grant_amount'),
                'max_credit_amount' => $this->request->getVar('max_credit_amount'),
                'disbursement_status' => 1,
                'date_of_grant' => $this->request->getVar('date_of_grant'),
            ];


            if ($validation->withRequest($this->request)->run()) {
                if (!isset($this->data['record']['id'])) {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                } else {
                    $entity_model->update($id, $this->data['details']);
                }

                header("Location:" . base_url("/grant_disbursement/list_all/" . $entity_id . "/"));
                die;

                $this->data['record'] = $entity_model->find($id);
            } else {
                $this->data['record'] = $_POST;
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_entity_add_edit($id)
    {
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'farmer_id' => [
                'label' => 'Farmer',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'remarks' => [
                'label' => 'Remarks',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'total_grant_provided' => [
                'label' => 'Total grant',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'max_grant_amount' => [
                'label' => 'Max grant amount',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'max_credit_amount' => [
                'label' => 'Max credit amount',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'date_of_grant' => [
                'label' => 'Date of grant',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];

    }

    public function group_add_edit($entity_id = 0, $id = 0)
    {
        // auth_rd();
        if($id == 0){
            // add
            auth_rd(147);
        } else {
            // edit
            auth_rd(148);
        }

        $this->data['active_module'] = "/group_grant_disbursement/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;

        $this->data['disbursement_status'] = json_decode(get_config(100), TRUE);

        $entity_model = new GrandDisbursementModel();
        $user_model = new UserModel();
        $grant_model = new GrantModel();

        $this->data['id'] = $id;

        $this->data['record'] = $entity_model->select("*")
            ->where("id", $id)
            ->first();

        $this->data['grant_list'] = $grant_model->findAll();

        $this->data['grant'] = $grant_model->select("*")
            ->where("id", $entity_id)
            ->first();
        $query = $this->data["db"]->query("SELECT id, category_name, no_of_farmers FROM project_target where project_id = " . $this->data['grant']['project_id'] ." AND deleted_at IS NULL");
        $this->data['farmer_category'] = $query->getResultArray();

        $query = $this->data["db"]->query("SELECT * FROM grant_item_farmer WHERE grant_disbursement_id = " . $id);
        $this->data['item_record'] = $query->getRowArray();


        if (isset($this->data['record']['schedule_by'])) {
            $query = $this->data["db"]->query("SELECT fname,lname FROM user WHERE id = " . $this->data['record']['schedule_by']);
            $this->data['user'] = $query->getRowArray();
        } elseif (isset($this->data['record']['hold_by'])) {
            $query = $this->data["db"]->query("SELECT fname, lname FROM user WHERE id = " . $this->data['record']['hold_by']);
            $this->data['user'] = $query->getRowArray();
        } elseif (isset($this->data['record']['disbursed_by'])){
            $query = $this->data["db"]->query("SELECT fname, lname FROM user WHERE id = " . $this->data['record']['disbursed_by']);
            $this->data['user'] = $query->getRowArray();
        }

        $query = $this->data["db"]->query("SELECT project_target_item.id, project_target_item.item_description FROM project_target_item 
        left JOIN project_target ON project_target_item.project_target_id = project_target.id
        WHERE project_target.project_id =" . $this->data['grant']['project_id'] . " AND project_target.id = 6");
        $this->data['item_list'] = $query->getResultArray();

        $where_farm_cat = "";

        if (isset($this->data['record']['farmer_category']) && $this->data['record']['farmer_category'] > 0) {
            $where_farm_cat = " and project_target.id = " . $this->data['record']['farmer_category'];
        }

        $query = $this->data["db"]->query("SELECT DISTINCT user.id, eligible_status as category, concat(user.fname, user.lname, '/',user.pin) AS farmer FROM farmer_project 
        LEFT JOIN user ON farmer_project.farmer_id = user.id 
        LEFT JOIN project_target ON project_target.project_id = farmer_project.project_id
        WHERE farmer_project.deleted_at IS NULL AND user.deleted_at IS NULL AND farmer_project.project_id =" . $this->data['grant']['project_id'] . $where_farm_cat );
        $this->data['farmer_list'] = $query->getResultArray();

        // $query = $this->data["db"]->query("SELECT farmer_id FROM grant_disbursement WHERE grant_id = " . $entity_id);
        // $selected_farmers = $query->getResultArray();

        $query = $this->data["db"]->query("SELECT * FROM grant_item_farmer WHERE grant_disbursement_id =" . $id);
        $selected_items= $query->getResultArray();

        if ($id != 0) {
            // $selected_farmers = $entity_model->select("grant_disbursement.farmer_id")
            // $selected_farmers = $entity_model->select("*")
            //     ->join('grant_item_farmer', 'grant_item_farmer.grant_disbursement_id = grant_disbursement.id', 'left')
            //     ->where('grant_item_farmer.project_target_item_id' , $selected_items[0]['project_target_item_id'])
            //     ->where('grant_disbursement.grant_id' , $entity_id)
            //     ->where('grant_disbursement.id' , $id)
            //     // ->groupBy('remarks')
            //     ->findAll();

                // select farmer using id and entity id
            $farmer = $entity_model->select("*")
                ->join('grant_item_farmer', 'grant_item_farmer.grant_disbursement_id = grant_disbursement.id', 'left')
                ->where('grant_disbursement.grant_id' , $entity_id)
                ->where('grant_disbursement.id' , $id)
                ->first();

                // get the remark
            // $common_remark = $farmer['remarks'];

                // find farmers same remak and grant_dis_id
            $selected_farmers = $entity_model->select("*")
                ->join('grant_item_farmer', 'grant_item_farmer.grant_disbursement_id = grant_disbursement.id', 'left')
                ->where('grant_item_farmer.project_target_item_id' , $selected_items[0]['project_target_item_id'])
                ->where('grant_disbursement.grant_id' , $entity_id)
                // ->groupBy('remarks')
                ->findAll();

        }

        $query = $this->data["db"]->query("SELECT project_target_item.id, project_target_item.item_description, project_target_item.amount FROM project_target_item 
        left JOIN project_target ON project_target_item.project_target_id = project_target.id
        WHERE project_target.project_id =" . $this->data['grant']['project_id'] . $where_farm_cat);
        $this->data['item_list'] = $query->getResultArray();

        if (isset($selected_farmers) && is_array($selected_farmers)) {
            foreach ($selected_farmers as $val) {
                $this->data['selected_farmers'][] = $val['farmer_id'];
            }
        } else {
            $this->data['selected_farmers'] = array();
        }

        if (isset($selected_items) && is_array($selected_items)) {
            foreach ($selected_items as $val) {
                $this->data['selected_items'][] = $val['project_target_item_id'];
            }
        } else {
           $this->data['selected_items'] = array();
        }

        if (isset($this->data['item_list']) && is_array($this->data['item_list']) && isset($this->data['selected_items'])) {
            foreach($this->data['item_list'] as $val){
                if($this->data['selected_items'][0] == $val['id']){
                    $this->data['price_as_per_project_target'] = $val['amount'];
                }
            }
        }else{
            $this->data['price_as_per_project_target'] = 0;
        }

        if (isset($this->data['item_record']) && is_array($this->data['item_record'])) {
            $this->data['selected_items_actual_price'] = $this->data['item_record']['price'];
        }else{
            $this->data['selected_items_actual_price'] = 0;
        }

        $this->group_process_form_add_edit($entity_id, $id);

        return view('grant_disbursement/group_add_edit', $this->data);
    }

    private function group_process_form_add_edit($entity_id = 0, $id = 0)
    {
        $validation = \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new GrandDisbursementModel();
        $entity_model1 = new GrandItemModel();
        $user_model =  new UserModel();
        $project_target_item_model = new ProjectTargetItemModel();

        if (isset($_POST['csrf'])) {
            $validation->setRules($this->group_validation_rules_entity_add_edit($id));

            if ($validation->withRequest($this->request)->run()) {
                // Start the transaction
                $this->data["db"]->transBegin();

                $farmer_ids = $this->request->getVar('farmer_id');
                $project_target_item_id = $this->request->getVar('project_target_item_id');

                foreach($farmer_ids as $farmer_id){

                    // get user id existing in claim group
                    $existing_user_ids = $entity_model->select('farmer_id')
                        ->where('grant_id', $entity_id)
                        ->where('farmer_id', $farmer_id)
                        ->first();

                    $userDetails = $user_model->select("*")
                        ->where('user.id', $farmer_id)
                        ->first();

                    // Get maximum per farm qty
                    $itemData = $project_target_item_model->select("*")
                        ->where('id', $project_target_item_id[0])
                        ->first();

                    $max_per_farmer_qty = $itemData['qty'];

                    $granted_count = $entity_model1->selectSum('qty')
                        ->join('grant_disbursement', 'grant_disbursement.id = grant_item_farmer.grant_disbursement_id', 'left')    
                        ->where('grant_disbursement.farmer_id', $farmer_id)
                        ->where('grant_item_farmer.project_target_item_id', $project_target_item_id[0])
                        // ->groupBy('grant_item_farmer.project_target_item_id')
                        ->first();
                
                    if($id == 0 || !isset($existing_user_ids)){
                        if(isset($granted_count) && (($granted_count['qty'] + $this->request->getVar('qty')) > $max_per_farmer_qty)){
                            cano_set_alert("danger",
                                "You can't grant ".$this->request->getVar('qty')." ". $itemData['item_description']." to ". $userDetails['fname']. " ". $userDetails['lname'].". ". 
                                "Because, The maximum per farmer qty has been exceeded. Maximum per farmer qty is ".$max_per_farmer_qty.". Currently, ".$granted_count['qty']." have been given."
                            );
                            header("Location:" . base_url("/grant_disbursement/group_list_all/" . $entity_id . "/")); 
                            die;
                            // $validation->setError('qty', "The maximum per farmer qty has been exceeded. Maximum per farmer qty is ".$max_per_farmer_qty.". Currently, ".$granted_count['qty']." have been given.");
                        }
                    } else {
                        $updating_qty_data = $entity_model1->select("qty")
                            ->where('grant_disbursement_id', $id)
                            ->first();

                        if(isset($granted_count) && (($granted_count['qty'] - $updating_qty_data['qty'] + $this->request->getVar('qty')) > $max_per_farmer_qty)){
                            cano_set_alert("danger",
                                "You can't grant ".$this->request->getVar('qty')." ". $itemData['item_description']." to ". $userDetails['fname']. " ". $userDetails['lname'].". ". 
                                "Because, The maximum per farmer qty has been exceeded. Maximum per farmer qty is ".$max_per_farmer_qty.". Currently, ".$granted_count['qty']." have been given."
                            );
                            header("Location:" . base_url("/grant_disbursement/group_list_all/" . $entity_id . "/")); 
                            die;
                            // $validation->setError('qty', "The maximum per farmer qty has been exceeded. Maximum per farmer qty is ".$max_per_farmer_qty.". Currently, ".$granted_count['qty']." have been given.");
                        }
                    }
                }

                try{
                    foreach ($this->request->getVar('farmer_id') as $farmer_id) {

                        if ($id != 0) {
                            $query = $this->data["db"]->query("SELECT * FROM grant_item_farmer WHERE grant_disbursement_id =" . $id);
                            $selected_items= $query->getResultArray();
                
                            // find farmers same remak and grant_dis_id
                            $groupData = $entity_model->select("*")
                                ->join('grant_item_farmer', 'grant_item_farmer.grant_disbursement_id = grant_disbursement.id', 'left')
                                ->where('grant_item_farmer.project_target_item_id' , $selected_items[0]['project_target_item_id'])
                                ->where('grant_disbursement.grant_id' , $entity_id)
                                ->findAll();
                            
                            if (isset($groupData) && is_array($groupData)) {
                                foreach ($groupData as $dval) {
                                    $entity_model1->where('id', $dval['id'])->delete();
                                    $entity_model->where('id', $dval['grant_disbursement_id'])->delete();
                                }
                            } 
                
                        }
                    }
    
                    $farmer_id = $this->request->getVar('farmer_id');
                    $project_target_item_id = $this->request->getVar('project_target_item_id');
    
                    if (isset($farmer_id) && is_array($farmer_id)) {
                        $this->data['details'] = [];
                        foreach ($farmer_id as $farmer_val) {
                            $this->data['details'] = [
                                'grant_id' => $entity_id,
                                'farmer_id' => $farmer_val,
                                'remarks' => $this->request->getVar('remarks'),
                                'farmer_category' => $this->request->getVar('farmer_category'),
                                'disbursement_status' => $this->request->getVar('disbursement_status'),
                                'date_of_grant' => $this->request->getVar('date_of_grant'),
                            ];
    
                            if ($this->data['details']['disbursement_status'] == 2) {
                                $this->data['details']['schedule_by'] = $_SESSION['user']['id'];
                                $this->data['details']['schedule_on'] = date('Y-m-d');
                            } elseif ($this->data['details']['disbursement_status'] == 3) {
                                $this->data['details']['disbursed_by'] = $_SESSION['user']['id'];
                            } elseif ($this->data['details']['disbursement_status'] == 4) {
                                $this->data['details']['hold_by'] = $_SESSION['user']['id'];
                                $this->data['details']['hold_on'] = date('Y-m-d');
                                $this->data['details']['hold_reason'] = $this->request->getVar('hold_reason');
                            }
    
                            $entity_model->insert($this->data['details']);
                            $this->data['id'] = $entity_model->getInsertID();
    
                            if (isset($project_target_item_id) && is_array($project_target_item_id)) {
                                foreach ($project_target_item_id as $project_target_item_val) {
                                    $this->data['details1'] = [
                                        'grant_disbursement_id' => $this->data['id'],
                                        'project_target_item_id' => $project_target_item_val,
                                        'qty' => $this->request->getVar('qty'),
                                        'price' => $this->request->getVar('actual_price_per_unit'),
                                    ];
    
                                    $entity_model1->insert($this->data['details1']);
                                    $this->data['item_id'] = $entity_model1->getInsertID();
                                }
                            }
                        }
                    }
                    // Commit the transaction
                    $this->data["db"]->transCommit();
                } catch(\Exception $e){
                    // Rollback the transaction on error
                    $this->data["db"]->transRollback();
                    cano_set_alert("danger", "Transaction Failed". $e->getMessage() );
                    header("Location:" . base_url("/grant_disbursement/group_list_all/" . $entity_id . "/")); 
                    die;
                }
                
                header("Location:" . base_url("/grant_disbursement/group_list_all/" . $entity_id . "/"));
                die;
            } else {
                $this->data['record'] = $_POST;
                $this->data['item_record'] = $_POST;
            }
            $validation->listErrors();
        }
    }

    private function group_validation_rules_entity_add_edit($id)
    {
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'farmer_category' => [
                'label' => 'Farmer category',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'project_target_item_id' => [
                'label' => 'Item',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'qty' => [
                'label' => 'QTY',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            // 'date_of_grant' => [
            //     'label' => 'Date of grant',
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
//            'disbursement_status' => [
//                'label'  => 'Status',
//                'rules'  => 'required',
//                'errors' => [
//                    'required' => VALIDATION_MANDATORY_MSG
//                ]
//            ],
        ];

    }

    public function delete($entity_id = 0, $id = 0)
    {
        auth_rd(149);
        $this->data['entity_id'] = $entity_id;
        $entity_model = new GrandDisbursementModel();
        $grant_item_model = new GrandItemModel();
        
        // get id
        // get project id

        // find same grant_item_farmer list grant_disbursement.farmer_category, grant_disbursement.grant_id, grant_disbursement.remarks, 
        // and grant_item_farmer.project target_item_id, grant_item_farmer.qty, grant_item_farmer.price
        // $delete_list = $entity_model->select('*')
        //     ->join('grant_item_farmer', 'grant_disbursement.id = grant_item_farmer.grant_disbursement_id', 'left')
        //     // ->where('grant_disbursement.farmer_category', $this->request->getVar('farmer_category'))
        //     ->where('grant_disbursement.grant_id', $entity_id)
        //     ->where('grant_disbursement.id', $id)
        //     ->where('grant_item_farmer.project_target_item_id', $this->request->getVar('project_target_item_id'))
        //     ->findAll();

            $query = $this->data["db"]->query("SELECT * FROM grant_item_farmer WHERE grant_disbursement_id =" . $id);
            $selected_items= $query->getResultArray();

            // select farmer using id and entity id
            $farmer = $entity_model->select("*")
                ->where('grant_disbursement.grant_id' , $entity_id)
                ->where('grant_disbursement.id' , $id)
                ->first();

                // get the remark
            $common_remark = $farmer['remarks'];

            $selected_farmers = $entity_model->select("*")
                ->join('grant_item_farmer', 'grant_item_farmer.grant_disbursement_id = grant_disbursement.id', 'left')
                ->where('grant_item_farmer.project_target_item_id' , $selected_items[0]['project_target_item_id'])
                ->where('grant_disbursement.grant_id' , $entity_id)
                ->where('grant_disbursement.remarks' , $common_remark)
                // ->groupBy('remarks')
                ->findAll();

                // pre($selected_farmers);
                // die;

        // delete the List
        foreach($selected_farmers as $selected_farmer){
            // pre($selected_farmer);
            // die;
            $grant_item_model->delete($selected_farmer['id']);
            $entity_model->delete($selected_farmer['grant_disbursement_id']);
            
        }



        header("Location:" . base_url("/grant_disbursement/group_list_all/" . $entity_id));
        die;
    }

    private function get_filter()
    {
        $where = 'grant_disbursement.grant_id =' . $this->data['entity_id'];

        if (isset($_GET['farmer_id']) && strlen(trim($_GET['farmer_id'])) > 0) {
            $where .= " AND grant_disbursement.farmer_id LIKE '%" . trim($_GET['farmer_id']) . "%'";
        }

        if (isset($_GET['remarks']) && strlen(trim($_GET['remarks'])) > 0) {
            $where .= " AND grant_disbursement.remarks LIKE '%" . trim($_GET['remarks']) . "%'";
        }

        if (isset($_GET['disbursement_status']) && strlen(trim($_GET['disbursement_status'])) > 0) {
            $where .= " AND grant_disbursement.disbursement_status LIKE '%" . trim($_GET['disbursement_status']) . "%'";
        }

        return $where;
    }

    private function group_get_filter()
    {
        $where = 'grant_disbursement.grant_id =' . $this->data['entity_id'];

        if (isset($_GET['farmer_id']) && strlen(trim($_GET['farmer_id'])) > 0) {
            $where .= " AND grant_disbursement.farmer_id LIKE '%" . trim($_GET['farmer_id']) . "%'";
        }

        if (isset($_GET['remarks']) && strlen(trim($_GET['remarks'])) > 0) {
            $where .= " AND grant_disbursement.remarks LIKE '%" . trim($_GET['remarks']) . "%'";
        }

        if (isset($_GET['disbursement_status']) && strlen(trim($_GET['disbursement_status'])) > 0) {
            $where .= " AND grant_disbursement.disbursement_status LIKE '%" . trim($_GET['disbursement_status']) . "%'";
        }

        return $where;
    }

    public function get_farmer_list($entity_id, $id = 0)
    {
        auth_rd();

        $grant_model = new GrantModel();

        $this->data['grant'] = $grant_model->select("*")
            ->where("id", $entity_id)
            ->first();

        $query = $this->data["db"]->query("SELECT user.id, concat(user.fname, ' ', user.lname, '/',user.pin) AS farmer FROM farmer_project
        LEFT JOIN user ON farmer_project.farmer_id = user.id 
        WHERE project_id = " . $this->data['grant']['project_id'] . " AND eligible_status = " . $id . " AND farmer_project.deleted_at IS NULL AND user.deleted_at IS NULL");
        $selected_farmers = $query->getResultArray();

        foreach ($selected_farmers as $key => $val) {
            $sel = 'selected';
            // if (in_array($val['id'], $this->data['selected_farmers'])) {
            //     $sel = 'selected';
            // } else {
            //     $sel = '';
            // }
            echo '<option class="entity" ' . $sel . ' value="' . $val['id'] . '">' . $val['farmer'] . '</option>';
        }

        die; 
    }

    public function get_item_list($entity_id, $id = 0)
    {
        auth_rd();

        $grant_model = new GrantModel();

        $this->data['grant'] = $grant_model->select("*")
            ->where("id", $entity_id)
            ->first();

        $query = $this->data["db"]->query("SELECT project_target_item.id, project_target_item.item_description FROM project_target_item 
        left JOIN project_target ON project_target_item.project_target_id = project_target.id
        WHERE project_target.project_id =" . $this->data['grant']['project_id'] . " AND project_target.id = " . $id);
        $item_list = $query->getResultArray();

        echo '<option value="">-- Select --</option>';

        foreach ($item_list as $key => $val) {
            echo '<option class="entity" value="' . $val['id'] . '">' . $val['item_description'] . '</option>';
        }
    }

    public function get_maximum_no_of_grant_item($entity_id, $id = 0){
        auth_rd();

        // $project_target_model = new ProjectTargetModel();
        // $project_grant_item_model = new ProjectTargetItemModel();
        // $grant_model =  new GrantModel();

        // $project_id = $grant_model->select('project_id')
        //     ->where('id', $entity_id)
        //     ->first();

        // $project_target_item_ids = $project_target_model->select('id')
        //     ->where('project_id', $project_id)
        //     ->findAll();

        // $data = $project_grant_item_model->select('qty')
        //     ->where('project_target_id', $project_target_item_id)
        //     ->where('id', $id)
        //     ->first();

        $query = $this->data["db"]->query("SELECT pti.qty
        FROM project_target_item pti
        JOIN project_target pt ON pti.project_target_id = pt.id
        JOIN `grant` g ON pt.project_id = g.project_id
        WHERE g.id = ". $entity_id ." AND pti.id = ". $id);

        $data = $query->getResultArray();
  
        echo $data[0]['qty'];
        // die;
   

    }

    public function generate_template($entity_id = 0)
    {
        auth_rd();
        $this->data['active_module'] = "/grant/generate_template/";
        $this->data['csrf'] = 1;

        $grant_model = new GrantModel();
        $project_model = new ProjectModel();

        // Add sample details
        $this->data['grant'] = $grant_model->select("*")
            ->where("id", $entity_id)
            ->first();

        // find the project name
        $this->data['project'] = $project_model->select("project_name")
            ->where("id", $this->data['grant']['project_id'])
            ->first();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Apply header styles
        $headerStyle = $sheet->getStyle('A1:' . 'I2');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');
        $headerStyle->getAlignment()->setHorizontal('center');
        $headerStyle->getAlignment()->setWrapText(true);
        $sheet->getRowDimension('1')->setRowHeight(30);

        // Merge cells
        $sheet->mergeCells('A1:I1');

        // set table topic
        $sheet->setCellValue('A1', "Project: " . $this->data['project']['project_name'] . "\nGrant Disbursement Details");

        // Set table Header
        $sheet->setCellValue('A2', "ID");
        $sheet->setCellValue('B2', "Farmer Category ID *");
        $sheet->setCellValue('C2', "Farmer ID *");
        $sheet->setCellValue('D2', "Item ID *");
        $sheet->setCellValue('E2', "Per Farmer QTY *");
        $sheet->setCellValue('F2', "Actual Price per Unit");
        $sheet->setCellValue('G2', "Date Of Grant (yyyy-mm-dd)");
        $sheet->setCellValue('H2', "Status ID *");
        $sheet->setCellValue('I2', "Remarks");

        // Auto-size columns
        foreach (range('A', 'I') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create a writer object and save the Excel file
        $writer = new Xlsx($spreadsheet);
        $basePath = config("App")->basePath;
        $filename = $basePath . 'public/resource/upload/SAPP_Grant_Disbursement_Bulk.xlsx';
        $writer->save($filename);

        // Set appropriate headers for file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($filename);
        exit;

    }

    public function resource_generate($entity_id = 0)
    {
        auth_rd();
        $this->data['active_module'] = "/grant/resource_generate/";

        $grant_model = new GrantModel();
        $project_model = new ProjectModel();

        // Add sample details
        $this->data['grant'] = $grant_model->select("*")
            ->where("id", $entity_id)
            ->first();

        // find the project name
        $this->data['project'] = $project_model->select("project_name")
            ->where("id", $this->data['grant']['project_id'])
            ->first();

        // find Farmer category
        $query = $this->data["db"]->query("SELECT id, category_name FROM project_target where project_id = " . $this->data['grant']['project_id'] ." AND deleted_at IS NULL");
        $this->data['farmer_category'] = $query->getResultArray();

        // find the farmer list
        $query = $this->data["db"]->query("SELECT user.id, concat(user.fname, '/',user.pin) AS farmer FROM farmer_project 
        LEFT JOIN user ON farmer_project.farmer_id = user.id 
        LEFT JOIN project_target ON project_target.project_id = farmer_project.project_id
        WHERE farmer_project.deleted_at IS NULL AND farmer_project.project_id =" . $this->data['grant']['project_id'] . " GROUP BY user.id ORDER BY user.fname ASC LIMIT 5000");
        $this->data['farmer_list'] = $query->getResultArray();

        // find the item list
        $query = $this->data["db"]->query("SELECT project_target_item.id, project_target_item.item_description, project_target_item.amount FROM project_target_item 
        left JOIN project_target ON project_target_item.project_target_id = project_target.id
        WHERE project_target.project_id =" . $this->data['grant']['project_id'] . " ORDER BY project_target_item.item_description ASC");
        $this->data['item_list'] = $query->getResultArray();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Apply header styles
        $headerStyle = $sheet->getStyle('A1:' . 'L3');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');
        $headerStyle->getAlignment()->setHorizontal('center');
        $headerStyle->getAlignment()->setWrapText(true);
        $sheet->getRowDimension('1')->setRowHeight(30);

        // Auto-size columns
        foreach (range('A3', 'L3') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // set table topic
        $sheet->setCellValue('A1', "Project: " . $this->data['project']['project_name'] . "\nResources for the Grant Disbursement Details Sheet");
        $sheet->setCellValue('A2', "Farmer Category Details");
        $sheet->setCellValue('D2', "Farmer Details");
        $sheet->setCellValue('G2', "Item Details");
        $sheet->setCellValue('K2', "Status Details");

        // Merge cells
        $sheet->mergeCells('A1:L1');
        $sheet->mergeCells('A2:B2');
        $sheet->mergeCells('D2:E2');
        $sheet->mergeCells('G2:I2');
        $sheet->mergeCells('K2:L2');

        if (!empty($this->data['farmer_category'])) {
            // Create farmer category table
            // Write headers for farmer category table
            $headers = array_keys($this->data['farmer_category'][0]);
            $column = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($column . '3', $header);
                $column++;
            }

            // Load values to the farmer category table
            $row = 4;
            foreach ($this->data['farmer_category'] as $result) {
                $column = 'A';
                foreach ($result as $value) {
                    $sheet->setCellValue($column . $row, $value);
                    $column++;
                }
                $row++;
            }
        }

        if (!empty($this->data['farmer_list'])) {
            // Create farmer table
            // Write headers for farmer table
            $headers = array_keys($this->data['farmer_list'][0]);
            $column = 'D';
            foreach ($headers as $header) {
                $sheet->setCellValue($column . '3', $header);
                $column++;
            }

            // Load values to the farmer table
            $row = 4;
            foreach ($this->data['farmer_list'] as $result) {
                $column = 'D';
                foreach ($result as $value) {
                    $sheet->setCellValue($column . $row, $value);
                    $column++;
                }
                $row++;
            }
        }

        if (!empty($this->data['item_list'])) {
            // Create Item table
            // Write headers for item table
            $headers = array_keys($this->data['item_list'][0]);
            $column = 'G';
            foreach ($headers as $header) {
                $sheet->setCellValue($column . '3', $header);
                $column++;
            }

            // Load values to the farmer table
            $row = 4;
            foreach ($this->data['item_list'] as $result) {
                $column = 'G';
                foreach ($result as $value) {
                    $sheet->setCellValue($column . $row, $value);
                    $column++;
                }
                $row++;
            }
        }

        $status_array = array(
            "1"=>"Scheduling in Progress",
            "2"=>"Scheduled",
            "3"=>"Disbursed",
            "4"=>"Hold"
        );

        $status_title = array(
            "1"=>"ID",
            "2"=>"Status",
        );

        // Write headers for status details table
        // $headers = array_keys($this->data['farmer_list'][0]);
        $column = 'K';
        foreach ($status_title as $header) {
            $sheet->setCellValue($column . '3', $header);
            $column++;
        }

        // Load values to the status details table
        $row = 4;
        for ($i=1; $i <= count($status_array); $i++) { 
            $sheet->setCellValue('K' . $row, $i);
            $sheet->setCellValue('L' . $row, $status_array[$i]);
            $row++;
        }

        // Create a writer object and save the Excel file
        $writer = new Xlsx($spreadsheet);
        $basePath = config("App")->basePath;
        $filename = $basePath . 'public/resource/upload/SAPP_Grant_Disbursement_Resource.xlsx';
        $writer->save($filename);

        // Set appropriate headers for file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($filename);
        exit;

    }

    public function bulk_upload($entity_id = 0)
    {
        auth_rd();
        $this->data['active_module'] = "/grant_disbursement/bulk_upload/";
        $this->data['csrf'] = 1;

        $entity_model = new GrandDisbursementModel();
        $entity_model1 = new GrandItemModel();
        $user_model = new UserModel();

        $grant_model = new GrantModel();
        $project_model = new ProjectModel();
        $project_target_item_model = new ProjectTargetItemModel();
        $farmer_project_model = new FarmerProjectModel();

        $this->data['grant'] = $grant_model->select("*")
            ->where("id", $entity_id)
            ->first();

        // find the project name
        $this->data['project'] = $project_model->select("project_name")
            ->where("id", $this->data['grant']['project_id'])
            ->first();
        // Load Farmer Category IDs
        //user ID
        $this->data['farmer_id_list'] = $user_model->select("id")
        ->where("user_type", "2")
        ->findAll();

        // find Farmer category
        $query = $this->data["db"]->query("SELECT * FROM project_target where project_id = " . $this->data['grant']['project_id'] . " AND deleted_at IS NULL");
        $this->data['farmer_category'] = $query->getResultArray();

        // find the farmer list
        $query = $this->data["db"]->query("SELECT user.id, concat(user.fname, '/',user.pin) AS farmer FROM farmer_project 
        LEFT JOIN user ON farmer_project.farmer_id = user.id 
        LEFT JOIN project_target ON project_target.project_id = farmer_project.project_id
        WHERE farmer_project.project_id =" . $this->data['grant']['project_id'] . " GROUP BY user.id ORDER BY user.fname ASC LIMIT 5000");
        $this->data['farmer_list'] = $query->getResultArray();

        // find the item list
        $query = $this->data["db"]->query("SELECT project_target_item.id, project_target_item.item_description, project_target_item.amount FROM project_target_item 
        left JOIN project_target ON project_target_item.project_target_id = project_target.id
        WHERE project_target.project_id =" . $this->data['grant']['project_id'] . " ORDER BY project_target_item.item_description ASC");
        $this->data['item_list'] = $query->getResultArray();

        // convert to single array
        $farmers_category_list = array_column($this->data['farmer_category'], 'id');
        $farmers_id_list = array_column($this->data['farmer_list'], 'id');
        $items_id_list = array_column($this->data['item_list'], 'id');

        // Check if the file is uploaded successfully
        if ($_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
            die("File upload error.");
        }

        // Get the temporary path of the uploaded file
        $filePath = $_FILES['excel_file']['tmp_name'];

        // Load the Excel file
        $objPHPExcel = IOFactory::load($filePath);

        // Get the first worksheet
        $worksheet = $objPHPExcel->getActiveSheet();

        // Get the highest row and column number
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        // check item list has different items
        $commonCatId = $worksheet->getCell('B' . 3)->getValue();
        $commonItemId = $worksheet->getCell('D' . 3)->getValue();
        $commonPerFarmQty = $worksheet->getCell('E' . 3)->getValue();
        $commonActualPrice = $worksheet->getCell('F' . 3)->getValue();
        $commonDateOfGrant = $worksheet->getCell('G' . 3)->getValue();
        $commonStatusId = $worksheet->getCell('H' . 3)->getValue();
        $commonRemark = $worksheet->getCell('I' . 3)->getValue();

        for ($row = 3; $row <= $highestRow; $row++) {

            // Item ID validation
            if(empty($worksheet->getCell('D' . $row)->getValue()) || !in_array($worksheet->getCell('D' . $row)->getValue(), $items_id_list)){
                $errorMsg = "Item ID is empty or not match with the resource file.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }

            // Farmer Category ID validation
            if(empty($worksheet->getCell('B' . $row)->getValue()) || !in_array($worksheet->getCell('B' . $row)->getValue(), $farmers_category_list)){
                $errorMsg = "Farmer category ID is empty or not match with the resource file.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }

            // find farmer in that category
            $farmer_data_cat = $farmer_project_model->select("farmer_id")
                ->where("eligible_status", $worksheet->getCell('B' . $row)->getValue())
                ->where('farmer_id', $worksheet->getCell('C' . $row)->getValue())
                ->first();
        
            if(empty($farmer_data_cat)){
                $errorMsg = "Farmer is not match with the category ID.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }

            // Item id match with catogory
            $project_item_with_cat = $project_target_item_model->select("*")
                ->where("project_target_id", $worksheet->getCell('B' . $row)->getValue())
                ->where("id", $worksheet->getCell('D' . $row)->getValue())
                ->first();

            if(empty($project_item_with_cat)){
                $errorMsg = "Item is not match with the category ID.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }


            // Actual Price validation
            if(empty($worksheet->getCell('F' . 3)->getValue())){
                $errorMsg = "Cannot accept null value";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }

            //Grant date validation
            if(!empty($worksheet->getCell('G' . 3)->getFormattedValue())){
                // $cellValue = $worksheet->getCell('G' . $row)->getValue();
                // pre($worksheet->getCell('G' . 3)->getFormattedValue());
                // die;
                if (strtotime($worksheet->getCell('G' . 3)->getFormattedValue()) !== false) {
                    // Valid date
                    $date = new DateTime($worksheet->getCell('G' . 3)->getFormattedValue());
                    $dateOfGrantFormated = $date->format('Y-m-d');
                } else {
                    // Invalid date
                    $errorMsg = "Invalid Date.";
                    $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
                }
            }else{
                $dateOfGrantFormated = null;
            }

            // status validation
            if(empty($worksheet->getCell('H' . 3)->getValue()) || !in_array($worksheet->getCell('H' . 3)->getValue(), ['1','2','3','4'])){
                // pre("insid");
                $errorMsg = "Invalid status";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }


            // check if there all row contain same data
            // check if there have different cat ID
            if($commonCatId != $worksheet->getCell('B' . $row)->getValue()){
                $errorMsg = "Different category IDs cannot be uploaded in the same claim group.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }

            // check if there have different item ID
            if($commonItemId != $worksheet->getCell('D' . $row)->getValue()){
                $errorMsg = "Different items cannot be uploaded in the same claim group.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }

            // check if there have different per farmer qty
            if($commonPerFarmQty != $worksheet->getCell('E' . $row)->getValue()){
                $errorMsg = "Different per farmer quantities cannot be uploaded in the same claim group.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }

            // check if there have different actual price
            if($commonActualPrice != $worksheet->getCell('F' . $row)->getValue()){
                $errorMsg = "Different actual prices cannot be uploaded in the same claim group.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }

            // check if there have different date of grant
            if($commonDateOfGrant != $worksheet->getCell('G' . $row)->getValue()){
                $errorMsg = "Different date of grants cannot be uploaded in the same claim group.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }

            // check if there have different status
            if($commonStatusId != $worksheet->getCell('H' . $row)->getValue()){
                $errorMsg = "Different status cannot be uploaded in the same claim group.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }

            // check if there have different remarks
            if($commonRemark != $worksheet->getCell('I' . $row)->getValue()){
                $errorMsg = "Different remarks cannot be uploaded in the same claim group.";
                $this->bulk_upload_validation_error($entity_id, $row, $errorMsg);
            }
        }

        $this->data['record'] = array();
        $this->data['records'] = array();

        // temp data array
        // $allreadyInDB = array();
        // $wrongData = array();
        $errorMsg = '';

        // Process each row and store the data in the database
        for ($row = 3; $row <= $highestRow; $row++) { // Assuming the first row contains headers
            
            // Get the value in the current cell
            $farmerCategory = $worksheet->getCell('B' . $row)->getValue();
            $farmerId = $worksheet->getCell('C' . $row)->getValue();
            $itemId = $worksheet->getCell('D' . $row)->getValue();
            $perFarmerQty = $worksheet->getCell('E' . $row)->getValue();
            $actualPrice = $worksheet->getCell('F' . $row)->getValue();
            $dateOfGrant = $worksheet->getCell('G' . $row)->getFormattedValue();
            $status = $worksheet->getCell('H' . $row)->getValue();
            $remarks = $worksheet->getCell('I' . $row)->getValue();
            
            
            // Farmer ID validation
            if(empty($farmerId) || !in_array($farmerId, $farmers_id_list)){
                $errorMsg = "Farmer ID is empty or not match with the project.";
                $this->bulk_upload_error($entity_id, $row, $errorMsg);
            }

            // Per Farmer QTY validation
            if(!empty($perFarmerQty)){          

                $itemData = $project_target_item_model->select("*")
                    ->where('id', $itemId)
                    ->first();

                $max_per_farmer_qty = $itemData['qty'];
                $granted_count = $entity_model1->selectSum('qty')
                    ->join('grant_disbursement', 'grant_disbursement.id = grant_item_farmer.grant_disbursement_id', 'left')    
                    ->where('grant_disbursement.farmer_id', $farmerId)
                    ->where('grant_item_farmer.project_target_item_id', $itemId)
                    // ->groupBy('grant_item_farmer.project_target_item_id')
                    ->first();

                $granted_qty_same_claim = $entity_model1->selectSum('qty')
                    ->join('grant_disbursement', 'grant_disbursement.id = grant_item_farmer.grant_disbursement_id', 'left')
                    ->where('grant_disbursement.farmer_id', $farmerId)
                    ->where('grant_item_farmer.project_target_item_id', $itemId)
                    ->where('grant_disbursement.grant_id', $entity_id)
                    ->first();

                if($granted_count['qty'] > 0){
                    if(isset($granted_count) && (($granted_count['qty'] - $granted_qty_same_claim['qty'] + $perFarmerQty) > $max_per_farmer_qty)){
                        $errorMsg = "You can't grant ".$perFarmerQty ." ". $itemData['item_description']." to row number ". $row .". ". 
                            "Because, The maximum per farmer qty has been exceeded. Maximum per farmer qty is ".$max_per_farmer_qty.". Currently, ".$granted_count['qty']." have been given.";
                        $this->bulk_upload_error($entity_id, $row, $errorMsg);
                    }

                }else{
                    // new assignemnt
                    if(isset($granted_count) && (($granted_count['qty'] + $perFarmerQty) > $max_per_farmer_qty)){
                        // accept the qty
                        $errorMsg = "Invalid Farmer QTY. QTY Should be less than project definition. Maximum per farmer QTY is ".$max_per_farmer_qty;
                        $this->bulk_upload_error($entity_id, $row, $errorMsg);
                    }
                }

            } else {
                $errorMsg = "Cannot accept null value";
                $this->bulk_upload_error($entity_id, $row, $errorMsg);
            }

            // Date formatting
            if (strtotime($dateOfGrant) !== false) {
                // Valid date
                $date = new DateTime($dateOfGrant);
                $dateOfGrantFormated = $date->format('Y-m-d');
            }else{
                $dateOfGrantFormated = null;
            }
            
            // Set Data
            $this->data['details']=[
                'farmer_category' => $farmerCategory,
                'grant_id' => $entity_id,
                'farmer_id' => $farmerId,
                'remarks' => $remarks,
                'date_of_grant' => $dateOfGrantFormated,
                'disbursement_status' => $status
            ];

            // Set Status data
            if ($this->data['details']['disbursement_status'] == 2) {
                $this->data['details']['schedule_by'] = $_SESSION['user']['id'];
                $this->data['details']['schedule_on'] = date('Y-m-d');
            } elseif ($this->data['details']['disbursement_status'] == 3) {
                $this->data['details']['disbursed_by'] = $_SESSION['user']['id'];
            } elseif ($this->data['details']['disbursement_status'] == 4) {
                $this->data['details']['hold_by'] = $_SESSION['user']['id'];
                $this->data['details']['hold_on'] = date('Y-m-d');
                // $this->data['details']['hold_reason'] = $this->request->getVar('hold_reason');
            }

            $dis_list = $entity_model->select('*')
                ->join('grant_item_farmer', 'grant_disbursement.id = grant_item_farmer.grant_disbursement_id', 'left')
                ->where('grant_disbursement.farmer_category', $farmerCategory)
                ->where('grant_disbursement.grant_id', $entity_id)
                ->where('grant_disbursement.farmer_id', $farmerId)
                ->where('grant_item_farmer.project_target_item_id', $itemId)
                ->findAll();

            // Start the transaction
            $this->data["db"]->transBegin();
            try{
                // Delete the existing data
                if (isset($dis_list) && is_array($dis_list)) {
                    foreach ($dis_list as $dval) {
                        $entity_model1->where('id', $dval['id'])->delete();
                        $entity_model->where('id', $dval['grant_disbursement_id'])->delete();
                    }
                }

                // Save data in grant disbursement table
                $entity_model->insert($this->data['details']);
                $this->data['id'] = $entity_model->getInsertID();

                // Set Project item farmer data
                $this->data['details1'] = [
                    'grant_disbursement_id' => $this->data['id'],
                    'project_target_item_id' => $itemId,
                    'qty' => $perFarmerQty,
                    'price' => $actualPrice,
                ];

                // Save data in grant item farmer table
                $entity_model1->insert($this->data['details1']);
                $this->data['item_id'] = $entity_model1->getInsertID();

                // Commit the transaction
                $this->data["db"]->transCommit();

            } catch(\Exception $e){
                // Rollback the transaction on error
                $this->data["db"]->transRollback();
                $errorMsg = $e->getMessage();
                $this->bulk_upload_error($entity_id, $row, $errorMsg);
            }
            
        }

        cano_set_alert("success", "Bulk upload is successful");
        header("Location:" . base_url("/grant_disbursement/group_list_all/" . $entity_id . "/"));
        die;

    }

    private function bulk_upload_error($entity_id, $row, $message){
        cano_set_alert("danger", "The bulk upload is unsuccessful. A data row is wrong. But the above rows were successful. Please correct the row and try again. Wrong row numbers:- ". rtrim($row, ", "). ". ERROR:- ". $message );
        header("Location:" . base_url("/grant_disbursement/group_list_all/" . $entity_id . "/")); 
        die;
    }

    private function bulk_upload_validation_error($entity_id, $row, $message){
        cano_set_alert("danger", "The bulk upload is unsuccessful. Please correct the row and try again. Wrong row numbers:- ". rtrim($row, ", "). ". ERROR:- ". $message );
        header("Location:" . base_url("/grant_disbursement/group_list_all/" . $entity_id . "/")); 
        die;
    }

}

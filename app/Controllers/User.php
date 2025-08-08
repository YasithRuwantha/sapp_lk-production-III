<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StaffMetaModel;
use App\Models\FarmerModel;
use App\Models\FileregisteryModel;
use App\Models\LinkUserGroupModel;
use App\Models\GndModel;
use App\Models\GeographicLocationsModel;
use App\Models\AggrarianDivisionModel;
use App\Models\BankModel;
use App\Models\DesignationModel;
use App\Models\FarmerLandModel;
use App\Models\FarmerProjectModel;
use App\Models\GrandDisbursementModel;
use App\Models\GrandItemModel;
use App\Models\LinkDisbursementFarmerModel;
use App\Models\LoanDisbursementModel;
use App\Models\ProjectStaffModel;
use App\Models\UserDesignationModel;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use function PHPUnit\Framework\isEmpty;

class User extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();

        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        helper('nicvalidate');
        $this->data["db"] = \Config\Database::connect();

        $this->data['status'] = array(1 => "Active", 2 => "Suspended", 3 => "Pending", 4 => "Inactive");
        $this->data['status_color'] = array(1 => "primary", 2 => "danger", 3 => "warning", 4 => "default", 5 => "purple");
        $this->data['user_type'] = json_decode('{"1": "Staff","4": "Promoter"}', TRUE);
        $this->data['assigned_admin_division'] = json_decode(get_config(29), TRUE);
        $this->data['head_hh'] = json_decode(get_config(38), TRUE);

        $this->data['geo_model'] = new GeographicLocationsModel(); //GEO class

        track();
    }

    public function login()
    {

        $entity_model = new UserModel();

        $this->data['record'] = $entity_model->select("user.id, user.fname,user.lname, user.mobile, user.email, user.language, user.password,file_registry.relative_path")
            ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
            ->where("(user.mobile LIKE '" . $this->request->getVar('user') . "' OR user.email LIKE '" . $this->request->getVar('user') . "') AND user.password LIKE '" . md5($this->request->getVar('pwd')) . "' AND user.status = 1 AND user.is_delete = 0")->first();


        //$query = $this->data["db"]->getLastQuery();
//        echo (string)$query;die;

        if (isset($this->data['record']['id'])) {
            $_SESSION['user'] = $this->data['record'];

            $query = $this->data["db"]->query("SELECT DISTINCT link_action_group.action_id FROM link_user_group LEFT JOIN link_action_group ON link_user_group.group_id = link_action_group.group_id WHERE link_user_group.start_at <= '" . date('Y-m-d H:i:s') . "' AND link_user_group.end_at >= '" . date('Y-m-d H:i:s') . "' AND link_user_group.user_id = " . $this->data['record']['id'] . " ORDER BY link_action_group.action_id ASC");
            $action_list = $query->getResultArray();

            if (isset($action_list) && is_array($action_list)) {
                foreach ($action_list as $val) {
                    $_SESSION['user']['actions'][] = $val['action_id'];
                }
            }

            $query = $this->data["db"]->query("SELECT DISTINCT link_user_group.group_id FROM link_user_group WHERE link_user_group.start_at <= '" . date('Y-m-d H:i:s') . "' AND link_user_group.end_at >= '" . date('Y-m-d H:i:s') . "' AND link_user_group.user_id = " . $this->data['record']['id'] . " ORDER BY link_user_group.group_id ASC");
            $group_list = $query->getResultArray();

            if (isset($group_list) && is_array($group_list)) {
                foreach ($group_list as $val) {
                    $_SESSION['user']['groups'][] = $val['group_id'];
                }
            }

            header("Location:" . base_url("/dashboard/default"));
            die;
        } else {
            cano_set_alert("danger", "Username or password is incorrect.");
            header("Location:" . base_url());
            die;
        }
    }

    public function trap($uid = 0)
    {
        $entity_model = new UserModel();

        $this->data['record'] = $entity_model->select("user.id, user.fname,user.lname, user.mobile, user.email, user.language, user.password,file_registry.relative_path")
            ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
            ->where("(user.mobile LIKE '" . $uid . "' OR user.email LIKE '" . $uid . "') AND user.status = 1 AND user.is_delete = 0")->first();

        //$query = $this->data["db"]->getLastQuery();
        //echo (string)$query;die;

        if (isset($this->data['record']['id'])) {
            $_SESSION['user'] = $this->data['record'];

            $query = $this->data["db"]->query("SELECT DISTINCT link_action_group.action_id FROM link_user_group LEFT JOIN link_action_group ON link_user_group.group_id = link_action_group.group_id WHERE link_user_group.start_at <= '" . date('Y-m-d H:i:s') . "' AND link_user_group.end_at >= '" . date('Y-m-d H:i:s') . "' AND link_user_group.user_id = " . $this->data['record']['id'] . " ORDER BY link_action_group.action_id ASC");
            $action_list = $query->getResultArray();

            if (isset($action_list) && is_array($action_list)) {
                foreach ($action_list as $val) {
                    $_SESSION['user']['actions'][] = $val['action_id'];
                }
            }

            $query = $this->data["db"]->query("SELECT DISTINCT link_user_group.group_id FROM link_user_group WHERE link_user_group.start_at <= '" . date('Y-m-d H:i:s') . "' AND link_user_group.end_at >= '" . date('Y-m-d H:i:s') . "' AND link_user_group.user_id = " . $this->data['record']['id'] . " ORDER BY link_user_group.group_id ASC");
            $group_list = $query->getResultArray();

            if (isset($group_list) && is_array($group_list)) {
                foreach ($group_list as $val) {
                    $_SESSION['user']['groups'][] = $val['group_id'];
                }
            }

            header("Location:" . base_url("/dashboard/default"));
            die;
        } else {
            cano_set_alert("danger", "Username or password is incorrect.");
            header("Location:" . base_url());
            echo "Aio";
            die;
        }
    }

    public function list_all()
    {
        // auth_rd();
        if(!is_auth(7) && !is_auth(19)){
            cano_set_alert("danger","You don't have privilege to access this page.");
            $_SESSION['redirect'] = base_url();
            header("Location:" . base_url()); 
            die;
        }
        
        $this->data['active_module'] = "/user/list_all/";
        $this->data['csrf'] = 1;

        // only have promoter list access
        if(is_auth(19)==true && is_auth(7)==false){
            $query = $this->data["db"]->query("SELECT u.*,fr.relative_path FROM user AS u LEFT JOIN file_registry AS fr ON fr.id = u.profile_picture WHERE u.user_type IN (4) AND u.is_delete = 0" . $this->get_filter());
            $this->data['list_all'] = $query->getResultArray();
            
            return view('user/list_all', $this->data);
        }
        // only staff list access
        if(is_auth(19)==false && is_auth(7)==true){
            $query = $this->data["db"]->query("SELECT u.*,fr.relative_path FROM user AS u LEFT JOIN file_registry AS fr ON fr.id = u.profile_picture WHERE u.user_type IN (1) AND u.is_delete = 0" . $this->get_filter());
            $this->data['list_all'] = $query->getResultArray();
            
            return view('user/list_all', $this->data);
        }

        $query = $this->data["db"]->query("SELECT u.*,fr.relative_path FROM user AS u LEFT JOIN file_registry AS fr ON fr.id = u.profile_picture WHERE u.user_type IN (1,4) AND u.is_delete = 0" . $this->get_filter());
        $this->data['list_all'] = $query->getResultArray();

        return view('user/list_all', $this->data);
    }

    public function list_staff()
    {
        auth_rd();
        $this->data['active_module'] = "/user/list_staff/";
        $this->data['csrf'] = 1;

        $sql = "SELECT u.*,fr.relative_path,d.designation,sm.phone_office,sm.phone_extension,sm.assigned_admin_division FROM user AS u "
            . "LEFT JOIN file_registry AS fr ON fr.id = u.profile_picture "
            . "LEFT JOIN staff_meta AS sm ON sm.user_id = u.id "
            . "LEFT JOIN user_designation AS ud ON u.id = ud.user_id AND ud.start_on <= " . time() . " AND ud.end_on >= " . time()
            . " LEFT JOIN designation AS d ON d.id = ud.designation_id "
            . " WHERE u.user_type IN (1) AND u.is_delete = 0 " . $this->get_filter();

        $query = $this->data["db"]->query($sql);
        $this->data['list_all'] = $query->getResultArray();

        return view('user/list_staff', $this->data);
    }

    public function farmer_district()
    {
        auth_rd();
        $this->data['active_module'] = "/user/farmer_district/";
        $this->data['csrf'] = 1;

        $sql = "SELECT u.*,fr.relative_path,d.district FROM user AS u " .
            "LEFT JOIN file_registry AS fr ON fr.id = u.profile_picture " .
            "LEFT JOIN farmer AS f ON f.user_id = u.id " .
            "LEFT JOIN gnd ON gnd.id = f.gnd_id " .
            "LEFT JOIN dsd ON dsd.id = gnd.dsd_id " .
            "LEFT JOIN district AS d ON d.id = dsd.district_id " .
            "WHERE u.is_delete = 0" . $this->get_filter();

        $query = $this->data["db"]->query($sql);
        $this->data['list_all'] = $query->getResultArray();

        return view('user/farmer_district', $this->data);
    }

    public function farmer_project()
    {
        auth_rd(169);
        $this->data['active_module'] = "/user/farmer_project/";
        $this->data['csrf'] = 1;

        // Pagination setup
        $pager = service('pager');
        $perPage = 3000;  // Adjust this as needed
        $page = (int) ($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        // $sql = "SELECT u.*,fr.relative_path,p.project_name FROM user AS u " .
        //     "LEFT JOIN file_registry AS fr ON fr.id = u.profile_picture " .
        //     "LEFT JOIN farmer_project AS f ON f.farmer_id = u.id " .
        //     "LEFT JOIN project AS p ON p.id = f.project_id " .
        //     "WHERE u.is_delete = 0 AND f.deleted_at IS NULL" . $this->get_filter() . " LIMIT 5000";

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
                $projectList = implode(',', $projectList);
                $sql = "SELECT u.*,fr.relative_path,p.project_name FROM user AS u " .
                    "LEFT JOIN file_registry AS fr ON fr.id = u.profile_picture " .
                    "LEFT JOIN farmer_project AS f ON f.farmer_id = u.id " .
                    "LEFT JOIN project AS p ON p.id = f.project_id " .
                    "WHERE u.is_delete = 0 AND f.deleted_at IS NULL AND f.project_id IN (" . $projectList . ")" . $this->get_filter() . " LIMIT $perPage OFFSET $offset";
            } else {
                $sql = "SELECT u.*,fr.relative_path,p.project_name FROM user AS u " .
                    "LEFT JOIN file_registry AS fr ON fr.id = u.profile_picture " .
                    "LEFT JOIN (SELECT * FROM farmer_project WHERE deleted_at IS NULL) AS f ON f.farmer_id = u.id " .
                    "LEFT JOIN project AS p ON p.id = f.project_id " .
                    "WHERE u.is_delete = 0" . $this->get_filter() . " LIMIT $perPage OFFSET $offset";
            }

        } else {
            // get farmers all project
            $sql = "SELECT u.*,fr.relative_path,p.project_name FROM user AS u " .
                "LEFT JOIN file_registry AS fr ON fr.id = u.profile_picture " .
                "LEFT JOIN (SELECT * FROM farmer_project WHERE deleted_at IS NULL) AS f ON f.farmer_id = u.id " .
                "LEFT JOIN project AS p ON p.id = f.project_id " .
                "WHERE u.is_delete = 0" . $this->get_filter() . " LIMIT $perPage OFFSET $offset";
        }

        // Query for paginated results
        $query = $this->data["db"]->query($sql);
        $this->data['list_all'] = $query->getResultArray();

        // Query for total record count
        $sql_total = str_replace("LIMIT $perPage OFFSET $offset", "", $sql); // Removing LIMIT and OFFSET for total count
        $query_total = $this->data["db"]->query($sql_total);
        $total = $query_total->getNumRows();

        // Calculate start and end values for the current page
        $start = $offset + 1;
        $end = min($start + $perPage - 1, $total);

        // Generate pagination links
        $pager_links = $pager->makeLinks($page, $perPage, $total);
        $this->data['pager_links'] = $pager_links;
        $this->data['start'] = $start;
        $this->data['end'] = $end;
        $this->data['total'] = $total;

        return view('user/farmer_project', $this->data);
    }

    private function get_filter()
    {
        $where = "";

        if (isset($_GET['fname']) && strlen(trim($_GET['fname'])) > 0) {
            $where .= " AND u.fname LIKE '%" . trim($_GET['fname']) . "%'";
        }

        if (isset($_GET['lname']) && strlen(trim($_GET['lname'])) > 0) {
            $where .= " AND u.lname LIKE '%" . trim($_GET['lname']) . "%'";
        }

        if (isset($_GET['pin']) && strlen(trim($_GET['pin'])) > 0) {
            $where .= " AND u.pin LIKE '%" . trim($_GET['pin']) . "%'";
        }

        if (isset($_GET['mobile']) && strlen(trim($_GET['mobile'])) > 0) {
            $where .= " AND u.mobile LIKE '%" . trim($_GET['mobile']) . "%'";
        }

        if (isset($_GET['email']) && strlen(trim($_GET['email'])) > 0) {
            $where .= " AND u.email LIKE '%" . trim($_GET['email']) . "%'";
        }

        if (isset($_GET['user_type']) && strlen(trim($_GET['user_type'])) > 0) {
            $where .= " AND u.user_type = " . trim($_GET['user_type']);
        }

        if (isset($_GET['project_name']) && strlen(trim($_GET['project_name'])) > 0) {
            $where .= " AND p.project_name LIKE '%" . trim($_GET['project_name']) . "%'";
        }

        if (isset($_GET['district']) && strlen(trim($_GET['district'])) > 0) {
            $where .= " AND d.district LIKE '%" . trim($_GET['district']) . "%'";
        }

        return $where;
    }

    public function logout()
    {
        session_destroy();
        header("Location:" . base_url());
        die;
    }

    public function profile()
    {
        auth_rd();
        $this->data['csrf'] = 1;

        $entity_model = new UserModel();
        $this->data['id'] = $_SESSION['user']['id'];

        $this->data['record'] = $entity_model->select("user.id, user.pin, user.fname,user.lname, user.mobile, user.email, user.language,user.profile_picture,file_registry.relative_path")
            ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
            ->where("user.id = " . $_SESSION['user']['id'])->first();

        $this->process_form($_SESSION['user']['id']);

        $this->data['record'] = $entity_model->select("user.id, user.pin, user.fname,user.lname, user.mobile, user.email, user.language, user.profile_picture, user.dob, user.gender, file_registry.relative_path")
            ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
            ->where("user.id = " . $_SESSION['user']['id'])->first();

        return view('user/profile', $this->data);
    }

    private function process_form($id = 0)
    {
        $validation = \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new UserModel();
        $reg_model = new FileregisteryModel();

        if (isset($_POST['csrf'])) {
            $validation->setRules($this->validation_rules_entity());

            $profile_picture = $this->data['record']['profile_picture'];

            if (is_file($_FILES["img"]["tmp_name"])) {
                $check = getimagesize($_FILES["img"]["tmp_name"]);
                if ($check !== false) {
                    $path = $_FILES['img']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $sub_path = "public/resource/user/" . md5($path . time()) . "." . $ext;
                    $target_file = ROOTPATH . $sub_path;
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        $this->data['file_registery'] = [
                            'added_on' => time(),
                            'relative_path' => '/' . $sub_path,
                            'ref_table' => 'user',
                            'status' => 1,
                        ];

                        $_SESSION['user']['relative_path'] = '/' . $sub_path;

                        if ($profile_picture > 1) {
                            @unlink(substr(ROOTPATH, 0, -1) . $this->data['record']['relative_path']);
                            $profile_picture_old = $profile_picture;
                        }

                        $reg_model->insert($this->data['file_registery']);
                        $profile_picture = $reg_model->getInsertID();
                        s3_upload($target_file, $sub_path);
                    }
                }
            }

            $this->data['details'] = [
                'id' => $_SESSION['user']['id'],
                'fname' => $this->request->getVar('fname'),
                'lname' => $this->request->getVar('lname'),
                'email' => $this->request->getVar('email'),
                'mobile' => $this->request->getVar('mobile'),
                'dob' => $this->request->getVar('dob'),
                'gender' => $this->request->getVar('gender'),
                'pin' => $this->request->getVar('pin'),
                'profile_picture' => $profile_picture,
            ];

            if ($validation->withRequest($this->request)->run()) {
                if ($id == 0) {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                } else {
                    $entity_model->update($this->data['id'], $this->data['details']);
                }

                if (isset($profile_picture_old)) {
                    $reg_model->where('id', $profile_picture_old)->delete();
                }
            } else {
                $this->data['record'] = $_POST;
            }
            $validation->listErrors();
        }
    }

    private function validation_rules_entity()
    {
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'fname' => [
                'label' => 'First name',
                'rules' => 'required|alpha',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => '{field} must have minimum of 3 letters.',
                    'alpha' => 'Only letters are allowed'
                ]
            ],
            'lname' => [
                'label' => 'Last name',
                'rules' => 'required|alpha',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => '{field} must have minimum of 3 letters.',
                    'alpha' => 'Only letters are allowed'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'valid_email',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'mobile' => [
                'label' => 'Mobile',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'dob' => [
                'label' => 'Date of birth',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'gender' => [
                'label' => 'Gender',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ]
        ];
    }

    public function change_password()
    {
        auth_rd();
        $this->data['csrf'] = 1;

        $entity_model = new UserModel();
        $this->data['id'] = $_SESSION['user']['id'];

        $this->process_form_cp($_SESSION['user']['id']);

        return view('user/change_password', $this->data);
    }

    private function process_form_cp($id = 0)
    {
        $validation = \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new UserModel();
        $reg_model = new FileregisteryModel();

        if (isset($_POST['csrf'])) {
            $validation->setRules($this->validation_rules_cp());


            $this->data['details'] = [
                'password' => md5($this->request->getVar('pwd')),
            ];

            if ($validation->withRequest($this->request)->run()) {
                $entity_model->update($this->data['id'], $this->data['details']);
                header("Location:" . base_url("/user/profile"));
                die;
            }
            $validation->listErrors();
        }
    }

    private function validation_rules_cp()
    {
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'pwd' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => '{field} must have minimum of 8 letters.'
                ]
            ],
            'cpwd' => [
                'label' => 'Confirm password',
                'rules' => 'matches[pwd]',
                'errors' => [
                    'matches' => 'Passwords are not matching.'
                ]
            ]
        ];
    }

    public function view($id = 0){
        // auth_rd(170);
        // if(!is_auth(8) || !is_auth(20) || !is_auth(170)){
        //     cano_set_alert("danger","You don't have privilege to access this page.");
        //     $_SESSION['redirect'] = base_url();
        //     header("Location:" . base_url()); 
        //     die;
        // }

        // $this->data['active_module'] = "/user/add_edit/";
        $this->data['csrf'] = 1;
        if(isset($_GET['user_type'])){
            $this->data['active_module'] = "/user/add_edit/farmer/";
            if(!is_auth(170)){
                cano_set_alert("danger","You don't have privilege to access this page.");
                $_SESSION['redirect'] = base_url();
                header("Location:" . base_url()); 
                die;
            }
        }else{
            $this->data['active_module'] = "/user/add_edit/";
            if(!is_auth(8) && !is_auth(20)){
                cano_set_alert("danger","You don't have privilege to access this page.");
                $_SESSION['redirect'] = base_url();
                header("Location:" . base_url()); 
                die;
            }
        }

        $entity_model = new UserModel();
        $gnd_model = new GndModel();
        $agg_model = new AggrarianDivisionModel;

        $this->data['id'] = $id;

    $this->data['record'] = $entity_model->select("farmer.gnd_id,farmer.aggrarian_division_id,farmer.district_id,farmer.dsd_id,user.id, user.pin, user.status, user.created_on, user.fname,user.lname, user.mobile, user.email, user.gender, user.dob, user.user_type, user.language,user.profile_picture,user.password,file_registry.relative_path")
            ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
            ->join('farmer', 'farmer.user_id = user.id', 'left')
            ->where("user.id = " . $id . " AND user.is_delete = 0")->first();

        $this->process_form_add_edit($id);

        if (isset($this->data['record']['id'])) {
            $query = $this->data["db"]->query("SELECT DISTINCT link_user_group.group_id FROM link_user_group WHERE link_user_group.start_at <= '" . date('Y-m-d H:i:s') . "' AND link_user_group.end_at >= '" . date('Y-m-d H:i:s') . "' AND link_user_group.user_id = " . $this->data['record']['id']);
            $action_list = $query->getResultArray();
        } elseif (isset($_GET['user_type'])) {
            $this->data['record']["user_type"] = $_GET['user_type'];
            $this->data['active_module'] = "/user/add_edit/farmer/";
        }

        if (isset($action_list) && is_array($action_list)) {
            foreach ($action_list as $val) {
                $this->data['my_user_group'][] = $val['group_id'];
            }
        }
    // (Removed duplicate/incomplete assignment)
    $query = $this->data["db"]->query("SELECT * FROM user_group WHERE id != 3");
        $this->data['user_group'] = $query->getResultArray();
        $this->data['gnd_list'] = $gnd_model->findAll();
        $this->data['agg_list'] = $agg_model->findAll();

    // Always provide farmer_district_list and farmer_dsd_list for the view
    $district_query = $this->data["db"]->query("SELECT id, district FROM district ORDER BY district");
    $this->data['farmer_district_list'] = $district_query->getResultArray();
    $dsd_query = $this->data["db"]->query("SELECT id, dsd, district_id FROM dsd ORDER BY dsd");
    $this->data['farmer_dsd_list'] = $dsd_query->getResultArray();

    $this->data['mode'] = "view";
    return view('user/add_edit', $this->data);
    }

    public function add_edit($id = 0)
    {
        // auth_rd();
        if($id==0){
            // add user, promoter, and farmer
            if(isset($_GET['user_type'])){
                if(!is_auth(171)){
                    cano_set_alert("danger","You don't have privilege to access this page.");
                    $_SESSION['redirect'] = base_url();
                    header("Location:" . base_url()); 
                    die;
                }
            }
            if(!is_auth(9) && !is_auth(21)){
                cano_set_alert("danger","You don't have privilege to access this page.");
			    $_SESSION['redirect'] = base_url();
                header("Location:" . base_url()); 
                die;
            }
        } else {
            if(isset($_GET['user_type'])){
                if(!is_auth(172)){
                    cano_set_alert("danger","You don't have privilege to access this page.");
                    $_SESSION['redirect'] = base_url();
                    header("Location:" . base_url()); 
                    die;
                }
            }
            // edit user, promoter, and farmer
            if(!is_auth(10) && !is_auth(22)){
                cano_set_alert("danger","You don't have privilege to access this page.");
			    $_SESSION['redirect'] = base_url();
                header("Location:" . base_url()); 
                die;
            }

        }
        // $this->data['active_module'] = "/user/add_edit/";
        $this->data['csrf'] = 1;
        if(isset($_GET['user_type'])){
            $this->data['active_module'] = "/user/add_edit/farmer/";
        }else{
            $this->data['active_module'] = "/user/add_edit/";
        }

        $entity_model = new UserModel();
        $gnd_model = new GndModel();
        $agg_model = new AggrarianDivisionModel;

        $this->data['id'] = $id;

        $this->data['record'] = $entity_model->select("farmer.gnd_id,farmer.aggrarian_division_id,user.id, user.pin, user.status, user.created_on, user.fname,user.lname, user.mobile, user.email, user.gender, user.dob, user.user_type, user.language,user.profile_picture,user.password,file_registry.relative_path")
            ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
            ->join('farmer', 'farmer.user_id = user.id', 'left')
            ->where("user.id = " . $id . " AND user.is_delete = 0")->first();

        $this->process_form_add_edit($id);

        if (isset($this->data['record']['id'])) {
            $query = $this->data["db"]->query("SELECT DISTINCT link_user_group.group_id FROM link_user_group WHERE link_user_group.start_at <= '" . date('Y-m-d H:i:s') . "' AND link_user_group.end_at >= '" . date('Y-m-d H:i:s') . "' AND link_user_group.user_id = " . $this->data['record']['id']);
            $action_list = $query->getResultArray();
        } elseif (isset($_GET['user_type'])) {
            $this->data['record']["user_type"] = $_GET['user_type'];
            $this->data['active_module'] = "/user/add_edit/farmer/";
        }

        if (isset($action_list) && is_array($action_list)) {
            foreach ($action_list as $val) {
                $this->data['my_user_group'][] = $val['group_id'];
            }
        }

        $query = $this->data["db"]->query("SELECT * FROM user_group WHERE id != 3");
        $this->data['user_group'] = $query->getResultArray();
        
    // Load district data (for farmer context, use unique variable names)
    $district_query = $this->data["db"]->query("SELECT id, district FROM district ORDER BY district");
    $this->data['farmer_district_list'] = $district_query->getResultArray();
        
    // Load DSD data (for farmer context, use unique variable names)
    $dsd_query = $this->data["db"]->query("SELECT id, dsd, district_id FROM dsd ORDER BY dsd");
    $this->data['farmer_dsd_list'] = $dsd_query->getResultArray();
        
        // Load GND data with dsd_id for filtering
        $gnd_query = $this->data["db"]->query("SELECT id, gnd, dsd_id FROM gnd ORDER BY gnd");
        $this->data['gnd_list'] = $gnd_query->getResultArray();
        $this->data['agg_list'] = $agg_model->findAll();

        return view('user/add_edit', $this->data);
    }

    private function process_form_add_edit($id = 0)
    {
        $validation = \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new UserModel();
        $reg_model = new FileregisteryModel();
        $ln_usr_group_model = new LinkUserGroupModel();
        $farmer_model = new FarmerModel();

        $email = $this->request->getVar('email');
        $user_type = $this->request->getVar('user_type');

        if ($user_type == 2) {
            $this->data['validate_user_type'] = "is_unique[user.email]";
        } else {
            $this->data['validate_user_type'] = "required|valid_email|is_unique[user.email]";
        }

        if ($email == "") {
            $email = $this->request->getVar('pin') . "@mis-sapp.com";
        }

        if (isset($_POST['csrf'])) {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            if (!empty($this->request->getVar('pin'))) {
                $nic_validate_response = nic_parse(strtoupper($this->request->getVar('pin')));
                if ($nic_validate_response == false) {
                    $this->data['validation']->setError('pin', 'Invalid NIC Format');
                }
            }

            if (isset($this->data['record']['profile_picture'])) {
                $profile_picture = $this->data['record']['profile_picture'];
            } else {
                $profile_picture = 1;
            }

            $pwd = $this->request->getVar('pass');

            if (isset($this->data['record']['created_on']) && $this->data['record']['created_on'] > 10) {
                $created_on = $this->data['record']['created_on'];
            } else {
                $created_on = time();
            }

            if (strlen($pwd) > 3) {
                $pass = md5($pwd);
            } elseif (isset($this->data['record']['password'])) {
                $pass = $this->data['record']['password'];
            } else {
                $pass = md5($pwd);
            }

            if (is_file($_FILES["img"]["tmp_name"])) {
                $check = getimagesize($_FILES["img"]["tmp_name"]);
                if ($check !== false) {
                    $path = $_FILES['img']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $sub_path = "public/resource/user/" . md5($path . time()) . "." . $ext;
                    $target_file = ROOTPATH . $sub_path;
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        $this->data['file_registery'] = [
                            'added_on' => time(),
                            'relative_path' => '/' . $sub_path,
                            'ref_table' => 'user',
                            'status' => 1,
                        ];

                        $_SESSION['user']['relative_path'] = '/' . $sub_path;

                        if ($profile_picture > 1) {
                            @unlink(substr(ROOTPATH, 0, -1) . $this->data['record']['relative_path']);
                            $profile_picture_old = $profile_picture;
                        }

                        $reg_model->insert($this->data['file_registery']);
                        $profile_picture = $reg_model->getInsertID();
                    }
                }
            }

            $code = md5(date('YmdHis') . rand(1, 999) . $email);

            $this->data['details'] = [
                'fname' => $this->request->getVar('fname'),
                'lname' => $this->request->getVar('lname'),
                'email' => $email,
                'mobile' => $this->request->getVar('mobile'),
                'dob' => $this->request->getVar('dob'),
                'gender' => $this->request->getVar('gender'),
                'pin' => $this->request->getVar('pin'),
                'status' => $this->request->getVar('status'),
                'user_type' => $this->request->getVar('user_type'),
                'profile_picture' => $profile_picture,
                'created_on' => $created_on,
                'password' => $pass,
                'otp' => $code,
            ];

            if ($validation->withRequest($this->request)->run()) {
                if ($id == 0) {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                        $this->data['record'] = $entity_model->select("farmer.gnd_id,farmer.aggrarian_division_id,farmer.district_id,farmer.dsd_id,user.id, user.pin, user.status, user.created_on, user.fname,user.lname, user.mobile, user.email, user.gender, user.dob, user.user_type, user.language,user.profile_picture,user.password,file_registry.relative_path")
                            ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
                            ->join('farmer', 'farmer.user_id = user.id', 'left')
                            ->where("user.id = " . $id . " AND user.is_delete = 0")->first();
                        $this->data['details_farmer'] = [
                            'district_id' => $this->request->getVar('district_id'),
                            'dsd_id' => $this->request->getVar('dsd_id'),
                            'user_id' => $this->data['id'],
                        ];

                    $farmer_model->insert($this->data['details_farmer']);

                    $to = $email;
                    $subject = "Confirmation of Registration in SAPP MIS";
                    $title = "Welcome to MIS for SAPP<br />Let's get into the system.";
                    $message = '<p>Hi ' . $this->request->getVar('fname') . ' ' . $this->request->getVar('lname') . ' </p><p> We\'d like to confirm that your account was created successfully. To access MIS for SAPP click the link below. </p>
                    <p><a style="background-color: #9e1d1d; border-radius: 4px; color: #fcf6e7; padding: 15px; font-size: 14px; text-decoration: none; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;" href="' . base_url("/user/password_reset/" . $code) . '">Password Reset</a>. </p><p> Please note that this link will only work for one time.</p>';

                    send_mail($to, $subject, $title, $message);

                    $ln_usr_group_model->where('user_id', $this->data['id'])->delete();
                    $user_group = $this->request->getVar('user_group');
                    if (isset($user_group) && is_array($user_group)) {
                        foreach ($user_group as $ug_val) {
                            $priviledge_details = [
                                'group_id' => $ug_val,
                                'user_id' => $this->data['id'],
                                'start_at' => '2021-01-01 00:00:00',
                                'end_at' => '2072-03-09 22:37:59',
                            ];
                            $ln_usr_group_model->insert($priviledge_details);
                        }
                    }

                    if($this->request->getVar('user_type') != 2){
                        cano_set_alert("success", "User added successfully.");
                        header("Location:" . base_url("/user/list_all"));
                        die;
                    }

                    // header("Location:" . base_url("/user/farmer_project?user_type=2"));
                    cano_set_alert("success", "Farmer added successfully." . "<a href='" . base_url("/user/add_edit?user_type=2") . "'> Add new farmer</a>");
                    header("Location:" . base_url("/user/add_edit/".$this->data['id']."?user_type=2")); // redect to the same page
                    die;
                } else {
                    $ln_usr_group_model->where('user_id', $this->data['id'])->delete();
                    $user_group = $this->request->getVar('user_group');
                    if (isset($user_group) && is_array($user_group)) {
                        foreach ($user_group as $ug_val) {
                            $priviledge_details = [
                                'group_id' => $ug_val,
                                'user_id' => $this->data['id'],
                                'start_at' => '2021-01-01 00:00:00',
                                'end_at' => '2072-03-09 22:37:59',
                            ];
                            $ln_usr_group_model->insert($priviledge_details);
                        }
                    }

                    $entity_model->update($this->data['id'], $this->data['details']);

                    $farmer = $farmer_model->select("*")
                        ->where("user_id", $this->data['id'])
                        ->first();

                    if ($user_type == 2) {
                        $this->data['details_farmer'] = [
                            'gnd_id' => $this->request->getVar('gnd_id')?:14077,
                            'aggrarian_division_id' => $this->request->getVar('aggrarian_division_id')?:358,
                            'district_id' => $this->request->getVar('district_id'),
                            'dsd_id' => $this->request->getVar('dsd_id'),
                        ];

                        $farmer_model->update($farmer['id'], $this->data['details_farmer']);
                        // header("Location:" . base_url("/user/farmer_project?user_type=2"));
                        // die;
                        
                        if(is_auth("171")){
                            cano_set_alert("success", "Farmer updated successfully." . "<a href='" . base_url("/user/add_edit?user_type=2") . "'> Add new farmer</a>");
                        } else{
                            cano_set_alert("success", "Farmer updated successfully.");
                        }
                        header("Location:" . base_url("/user/add_edit/".$this->data['id']."?user_type=2")); // redect to the same page
                        die;
                    }

                    cano_set_alert("success", "User updated successfully.");
                    header("Location:" . base_url("/user/list_all"));
                    die;
                }

                if (isset($profile_picture_old)) {
                    $reg_model->where('id', $profile_picture_old)->delete();
                }

                $this->data['record'] = $entity_model->select("farmer.gnd_id,farmer.aggrarian_division_id,user.id,user.id,user.user_type, user.pin, user.status, user.created_on, user.fname,user.lname, user.mobile, user.email, user.gender, user.dob, user.user_type, user.language, user.profile_picture, user.dob, user.gender,user.password,file_registry.relative_path")
                    ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
                    ->join('farmer', 'farmer.user_id = user.id', 'left')
                    ->where("user.id = " . $id . " AND user.is_delete = 0")->first();
            } else {
                $this->data['record'] = $_POST;
            }
        }
    }

    private function validation_rules_entity_add_edit($id)
    {
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        if ($id == 0) {
            return [
                'fname' => [
                    'label' => 'First name',
                    'rules' => 'required|regex_match[/^([a-z .])+$/i]',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG,
                        'regex_match' => 'Only letters are allowed'
                    ]
                ],
                'lname' => [
                    'label' => 'Last name',
                    'rules' => 'required|regex_match[/^([a-z .])+$/i]',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG,
                        'regex_match' => 'Only letters are allowed'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'permit_empty|valid_email|is_unique[user.email]',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG,
                        'is_unique' => 'It is already exist'
                    ]
                ],
                'mobile' => [
                    'label' => 'Mobile',
                    'rules' => 'required|is_unique[user.mobile]|min_length[9]|max_length[12]',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG,
                        'is_unique' => 'It is already exist'
                    ]
                ],
                // 'dob' => [
                //     'label' => 'Date of birth',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => VALIDATION_MANDATORY_MSG
                //     ]
                // ],
                'gender' => [
                    'label' => 'Gender',
                    'rules' => 'required',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG
                    ]
                ],
                'pin' => [
                    'label' => 'NIC',
                    'rules' => 'required|is_unique[user.pin]',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG,
                        'is_unique' => 'It is already exist'
                    ]
                ],
                'status' => [
                    'label' => 'Gender',
                    'rules' => 'required',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG
                    ]
                ],
                'user_type' => [
                    'label' => 'User type',
                    'rules' => 'required',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG
                    ]
                ],
                'pass' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG,
                        'min_length' => '{field} must have minimum of 8 letters.'
                    ]
                ],
            ];
        } else {
            return [
                'fname' => [
                    'label' => 'First name',
                    'rules' => 'required|regex_match[/^([a-z .])+$/i]|min_length[3]',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG,
                        'min_length' => '{field} must have minimum of 3 letters.',
                        'regex_match' => 'Only letters are allowed'
                    ]
                ],
                'lname' => [
                    'label' => 'Last name',
                    'rules' => 'required|regex_match[/^([a-z .])+$/i]|min_length[3]',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG,
                        'min_length' => '{field} must have minimum of 3 letters.',
                        'regex_match' => 'Only letters are allowed'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG
                    ]
                ],
                'mobile' => [
                    'label' => 'Mobile',
                    'rules' => 'required|min_length[9]|max_length[12]',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG
                    ]
                ],
                // 'dob' => [
                //     'label' => 'Date of birth',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => VALIDATION_MANDATORY_MSG
                //     ]
                // ],
                'gender' => [
                    'label' => 'Gender',
                    'rules' => 'required',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG
                    ]
                ],
                'pin' => [
                    'label' => 'NIC',
                    'rules' => 'required',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG
                    ]
                ],
                'status' => [
                    'label' => 'Gender',
                    'rules' => 'required',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG
                    ]
                ],
                'user_type' => [
                    'label' => 'User type',
                    'rules' => 'required',
                    'errors' => [
                        'required' => VALIDATION_MANDATORY_MSG
                    ]
                ],
            ];
        }

    }

    public function staff_meta($id = 0)
    {
        auth_rd();
        $this->data['csrf'] = 1;

        // $this->data['maritial_status'] = array(1 => "Married", 2 => "Widowed", 3 => "Separated", 4 => "Divorced", 5 => "Single");
        $this->data['maritial_status'] = json_decode(get_config(97), TRUE);
        $this->data['recruitment_type'] = json_decode(get_config(4), TRUE);
        $this->data['heighest_education_qualification'] = json_decode(get_config(5), TRUE);
        $this->data['employment_status'] = array(1 => "Active", 2 => "Left");
        $this->data['title'] = array(1 => "Mr", 2 => "Mrs", 3 => "Miss");
        $this->data['designation'] = array();

        $entity_model = new StaffMetaModel();
        $designation_model = new DesignationModel();
        $this->data['id'] = $id;

        $this->data['designation_list'] = $designation_model->select("id, designation")
            ->findAll();

        foreach ($this->data['designation_list'] as $designation){
            $this->data['designation'][$designation['id']] = $designation['designation'];
        }

        $this->data['record'] = $entity_model->select("*")
            ->where("user_id = " . $id)->first();

        $this->process_form_meta($id);

        return view('user/staff_meta', $this->data);
    }

    private function process_form_meta($id = 0)
    {
        $validation = \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new StaffMetaModel();

        if (isset($_POST['csrf'])) {
            $validation->setRules($this->validation_rules_meta($id));

            $this->data['details'] = [
                'id' => $id,
                'user_id' => $id,
                'title' =>$this->request->getVar('title'),
                'designation'=>$this->request->getVar('designation'),
                'permanant_address_no' => $this->request->getVar('permanant_address_no'),
                'permanant_address_street' => $this->request->getVar('permanant_address_street'),
                'permanant_address_city' => $this->request->getVar('permanant_address_city'),
                'temp_address_no' => $this->request->getVar('temp_address_no'),
                'temp_address_street' => $this->request->getVar('temp_address_street'),
                'temp_address_city' => $this->request->getVar('temp_address_city'),
                //'emergency_contact' => $this->request->getVar('emergency_contact'),
                'assigned_admin_region' => $this->request->getVar('assigned_admin_region'),
                'assigned_admin_division' => $this->request->getVar('assigned_admin_division'),
                'appointment_date' => $this->request->getVar('appointment_date'),
                'employee_no' => $this->request->getVar('employee_no'),
                'employer_no' => $this->request->getVar('employer_no'),
                'maritial_status' => $this->request->getVar('maritial_status'),
                'recruitment_type' => $this->request->getVar('recruitment_type'),
                'phone_office' => $this->request->getVar('phone_office'),
                'phone_extension' => $this->request->getVar('phone_extension'),
                'heighest_education_qualification' => $this->request->getVar('heighest_education_qualification'),
                'professional_membership' => $this->request->getVar('professional_membership'),
                'salary_scale' => $this->request->getVar('salary_scale'),
                'basic_salary' => $this->request->getVar('basic_salary'),
                'allowance' => $this->request->getVar('allowance'),
                'net_salary' => $this->request->getVar('net_salary'),
                'employment_status' => $this->request->getVar('employment_status'),
                'last_date_sapp' => $this->request->getVar('last_date_sapp'),
            ];

            if ($validation->withRequest($this->request)->run()) {
                if (!isset($this->data['record']['id'])) {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                    cano_set_alert('success', 'Staff meta added successfully.');
                    header("Location:" . base_url("/user/list_all/" . $id));
                    die;
                } else {
                    $entity_model->update($this->data['id'], $this->data['details']);
                    cano_set_alert('success', 'Staff meta updated successfully.');
                    header("Location:" . base_url("/user/list_all/" . $id));
                    die;
                }

                $entity_model = new StaffMetaModel();
                $this->data['record'] = $entity_model->select("*")
                    ->where("user_id = " . $id)->first();

            } else {
                $this->data['record'] = $_POST;
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_meta($id)
    {
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'title' => [
                'label' => 'Title',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'designation' => [
                'label' => 'Designation',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            // 'permanant_address_no' => [
            //     'label' => 'Permanant address no',
            //     'rules' => 'required|max_length[32]',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'min_length' => "{field} can't have more than 32 letters.",
            //     ]
            // ],
            'permanant_address_street' => [
                'label' => 'Permanant address street',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            'permanant_address_city' => [
                'label' => 'Permanant address city',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            // 'emergency_contact' => [
            //     'label' => 'Emergency contact',
            //     'rules' => 'required|max_length[16]',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'min_length' => "{field} can't have more than 12 letters.",
            //     ]
            // ],
            'assigned_admin_region' => [
                'label' => 'Assigned admin region',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            'assigned_admin_division' => [
                'label' => 'Assigned admin division',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            'appointment_date' => [
                'label' => 'Appointment date',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'employee_no' => [
                'label' => 'Employee no',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            'employer_no' => [
                'label' => 'Employer no',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'maritial_status' => [
                'label' => 'Maritial status',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'recruitment_type' => [
                'label' => 'Recruitment type',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'phone_office' => [
                'label' => 'Phone office',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'phone_extension' => [
                'label' => 'Phone ext',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'heighest_education_qualification' => [
                'label' => 'Heighest education qualification',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'professional_membership' => [
                'label' => 'Professional membership',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'salary_scale' => [
                'label' => 'Salary scale',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'basic_salary' => [
                'label' => 'Basic salary',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'allowance' => [
                'label' => 'Allowance',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'net_salary' => [
                'label' => 'Net salary',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'employment_status' => [
                'label' => 'Employment status',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ]
        ];

    }

    public function onChangeValueDefiner()
    {
        if (isset($_POST['sourceOfDrinkingWater']) && !empty($_POST['sourceOfDrinkingWater'])) {
            return array(1 => "Yes", 2 => "No")[$_POST['sourceOfDrinkingWater']];
        }

        if (isset($_POST['beforeBurrow']) && !empty($_POST['beforeBurrow'])) {
            return json_decode(get_config(68), TRUE)[$_POST['beforeBurrow']];
        }

        if (isset($_POST['balanceDiet']) && !empty($_POST['balanceDiet'])) {
            return json_decode(get_config(65), TRUE)[$_POST['balanceDiet']];
        }

        if (isset($_POST['sourceOfCredit']) && !empty($_POST['sourceOfCredit'])) {
            $sourceOfCreditReturnArray = [];
            foreach ($_POST['sourceOfCredit'] as $sourceOfCreditId) {
                $sourceOfCreditReturnArray[] = json_decode(get_config(69), TRUE)[$sourceOfCreditId];
            }
            var_dump($sourceOfCreditReturnArray);
            die();
            return $sourceOfCreditReturnArray;
        }
    }

    public function farmer($id = 0)
    {
        auth_rd();
        $this->data['active_module'] = "/user/add_edit/farmer/";
        $this->data['csrf'] = 1;

        $this->data['barrower_type'] = array(1 => "Main", 2 => "Sub");
        $this->data['citizenship_by'] = array(1 => "By registration", 2 => "By descent");
        $this->data['heighest_education_qualification'] = json_decode(get_config(5), TRUE);
        $this->data['availability_drinking_water'] = array(1 => "Yes", 2 => "No");
        $this->data['source_drinking_water'] = json_decode(get_config(10), TRUE);
        $this->data['availability_water_crops'] = array(1 => "Yes", 2 => "No");
        $this->data['source_water_crops'] = json_decode(get_config(11), TRUE);
        $this->data['cond_house_floor'] = json_decode(get_config(12), TRUE);
        $this->data['consumer_durables'] = json_decode(get_config(13), TRUE);
        $this->data['avilability_vehicles'] = json_decode(get_config(14), TRUE);
        $this->data['availability_water_crops'] = array(1 => "Yes", 2 => "No");
        $this->data['sanitation'] = json_decode(get_config(15), TRUE);
        $this->data['agri_equipments'] = json_decode(get_config(16), TRUE);
        $this->data['tools_farmland'] = json_decode(get_config(9), TRUE);
        $this->data['main_source_income'] = json_decode(get_config(17), TRUE);
        $this->data['main_source_income_nature'] = json_decode(get_config(7), TRUE);
        $this->data['avg_main_agricultutre_income_nature'] = json_decode(get_config(7), TRUE);
        $this->data['other_income_nature'] = json_decode(get_config(7), TRUE);
        $this->data['availability_electricity'] = array(1 => "Yes", 2 => "No");
        $this->data['electricity_from'] = json_decode(get_config(8), TRUE);
        $this->data['vcm_recomendation'] = json_decode('{"1": "Approved", "2":"Rejected", "3":"Pending"}', TRUE);
        $this->data['rpc_recomendation'] = json_decode('{"1": "Approved", "2":"Rejected", "3":"Pending"}', TRUE);
        $this->data['liason_recomendation'] = json_decode('{"1": "Approved", "2":"Rejected", "3":"Pending"}', TRUE);
        $this->data['eligible_status'] = json_decode('{"1": "Recomended Farmer", "2":"Non Recommended Farmer"}', TRUE);
        $this->data['obtained_benifit'] = json_decode('{"1": "Loan", "2":"Grant"}', TRUE);
        $this->data['project_status'] = json_decode(get_config(19), TRUE);
        $this->data['undergo_training'] = json_decode(get_config(63), TRUE);
        $this->data['samurdhi_pds'] = json_decode(get_config(64), TRUE);
        $this->data['balance_diet'] = json_decode(get_config(65), TRUE);
        $this->data['hunger_period'] = json_decode(get_config(66), TRUE);
        $this->data['financial_decision'] = json_decode(get_config(67), TRUE);
        $this->data['before_barrow'] = json_decode(get_config(68), TRUE);
        $this->data['source_of_credit'] = json_decode(get_config(69), TRUE);
        $this->data['repaid_status_informal'] = json_decode(get_config(70), TRUE);
        $this->data['repaid_status_formal'] = json_decode(get_config(71), TRUE);
        $this->data['registered_in'] = json_decode(get_config(72), TRUE);
        $this->data['civil_status'] = json_decode(get_config(97), TRUE);
        $this->data['nature_agri_expense'] = json_decode(get_config(98), TRUE);
        $this->data['nature_expense_other'] = json_decode(get_config(99), TRUE);

        $entity_model = new FarmerModel();
        $gnd_model = new GndModel();
        $this->data['id'] = $id;

        $this->data['record'] = $entity_model->select("*")
            ->where("user_id = " . $id)->first();

        $this->data['gnd_list'] = $gnd_model->findAll();

        $this->data['geo_data'] = $this->data['geo_model']->select("*")->where("entity_table", "farmer")->where("entity_id", $id)->first(); //GEO data

        $this->process_form_farmer($id);

        $this->data['geo_data'] = $this->data['geo_model']->select("*")->where("entity_table", "farmer")->where("entity_id", $id)->first(); //GEO data

        /**
         * Multi select values are converted from json to array
         */
        if (isset($this->data['record']['source_drinking_water']) && !is_array($this->data['record']['source_drinking_water'])) {
            $this->data['record']['source_drinking_water'] = json_decode($this->data['record']['source_drinking_water']);
            $this->data['record']['source_water_crops'] = json_decode($this->data['record']['source_water_crops']);
            $this->data['record']['cond_house_floor'] = json_decode($this->data['record']['cond_house_floor']);
            $this->data['record']['consumer_durables'] = json_decode($this->data['record']['consumer_durables']);
            $this->data['record']['avilability_vehicles'] = json_decode($this->data['record']['avilability_vehicles']);
            $this->data['record']['sanitation'] = json_decode($this->data['record']['sanitation']);
            $this->data['record']['agri_equipments'] = json_decode($this->data['record']['agri_equipments']);
            $this->data['record']['tools_farmland'] = json_decode($this->data['record']['tools_farmland']);
            $this->data['record']['undergo_training'] = json_decode($this->data['record']['undergo_training']);
            $this->data['record']['source_of_credit'] = json_decode($this->data['record']['source_of_credit']);
        }

        return view('user/farmer', $this->data);
    }

    private function process_form_farmer($id = 0)
    {
        $validation = \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new FarmerModel();

        if (isset($_POST['csrf'])) {
            $validation->setRules($this->validation_rules_farmer($id));

            $this->data['details'] = [
                // 'id' => $id,
                'user_id' => $id,
                'barrower_type' => $this->request->getVar('barrower_type'),
                'head_hh' => $this->request->getVar('head_hh'),
                'address_no' => $this->request->getVar('address_no'),
                'address_street' => $this->request->getVar('address_street'),
                'address_city' => $this->request->getVar('address_city'),
                'whatsapp_no' => $this->request->getVar('whatsapp_no'),
                'citizenship_by' => $this->request->getVar('citizenship_by'),
                'heighest_education_qualification' => $this->request->getVar('heighest_education_qualification'),
                'age_while_register' => $this->request->getVar('age_while_register'),
                'availability_drinking_water' => $this->request->getVar('availability_drinking_water'),
                'source_drinking_water' => json_encode($this->request->getVar('source_drinking_water')),
                'availability_water_crops' => $this->request->getVar('availability_water_crops'),
                'source_water_crops' => json_encode($this->request->getVar('source_water_crops')),
                'cond_house_floor' => json_encode($this->request->getVar('cond_house_floor')),
                'consumer_durables' => json_encode($this->request->getVar('consumer_durables')),
                'avilability_vehicles' => json_encode($this->request->getVar('avilability_vehicles')),
                'availability_water_crops' => $this->request->getVar('availability_water_crops'),
                'sanitation' => json_encode($this->request->getVar('sanitation')),
                'agri_equipments' => json_encode($this->request->getVar('agri_equipments')),
                'tools_farmland' => json_encode($this->request->getVar('tools_farmland')),
                'main_source_income' => $this->request->getVar('main_source_income'),
                'main_source_income_nature' => $this->request->getVar('main_source_income_nature'),
                'avg_main_agriculture_income' => $this->request->getVar('avg_main_agriculture_income'),
                'avg_main_agricultutre_income_nature' => $this->request->getVar('avg_main_agricultutre_income_nature'),
                'avg_harvest_income' => $this->request->getVar('avg_harvest_income'),
                'other_income' => $this->request->getVar('other_income'),
                'other_income_nature' => $this->request->getVar('other_income_nature'),
                'other_income_discription' => $this->request->getVar('other_income_discription'),
                'availability_electricity' => $this->request->getVar('availability_electricity'),
                'electricity_from' => $this->request->getVar('electricity_from'),
                'nature_agri_expense' => $this->request->getVar('nature_agri_expense'),
                'expense_agri' => $this->request->getVar('expense_agri'),
                'nature_expense_other' => $this->request->getVar('nature_expense_other'),
                'expense_other' => $this->request->getVar('expense_other'),
                'undergo_training' => json_encode($this->request->getVar('undergo_training')),
                'samurdhi_pds' => $this->request->getVar('samurdhi_pds'),
                'balance_diet' => $this->request->getVar('balance_diet'),
                'hunger_period' => $this->request->getVar('hunger_period'),
                'financial_decision' => $this->request->getVar('financial_decision'),
                'before_barrow' => $this->request->getVar('before_barrow'),
                'source_of_credit' => json_encode($this->request->getVar('source_of_credit')),
                'informal_barrow' => $this->request->getVar('informal_barrow'),
                'formal_barrow' => $this->request->getVar('formal_barrow'),
                'repaid_status_informal' => $this->request->getVar('repaid_status_informal'),
                'repaid_status_formal' => $this->request->getVar('repaid_status_formal'),
                'repaid_formal' => $this->request->getVar('repaid_formal'),
                'repaid_informal' => $this->request->getVar('repaid_informal'),
                'registered_in' => $this->request->getVar('registered_in'),
                'register_org' => $this->request->getVar('register_org'),
                'no_balance_diet' => $this->request->getVar('no_balance_diet'),

                'civil_status' => $this->request->getVar('civil_status'),
                'no_household_members' => $this->request->getVar('no_household_members'),
                'male_under_5' => $this->request->getVar('male_under_5'),
                'female_under_5' => $this->request->getVar('female_under_5'),
                'male_5_to_14' => $this->request->getVar('male_5_to_14'),
                'female_5_to_14' => $this->request->getVar('female_5_to_14'),
                'male_15_to_29' => $this->request->getVar('male_15_to_29'),
                'female_15_to_29' => $this->request->getVar('female_15_to_29'),
                'male_30_to_49' => $this->request->getVar('male_30_to_49'),
                'female_30_to_49' => $this->request->getVar('female_30_to_49'),
                'male_50_to_64' => $this->request->getVar('male_50_to_64'),
                'female_50_to_64' => $this->request->getVar('female_50_to_64'),
                'male_over_65' => $this->request->getVar('male_over_65'),
                'female_over_65' => $this->request->getVar('female_over_65'),
            ];

            if ($validation->withRequest($this->request)->run()) {
                if (!isset($this->data['record']['id'])) {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                    // header("Location:" . base_url("/user/farmer/" . $id));
                    // header("Location:" . base_url("/user/farmer_project?user_type=2"));
                    // die;
                } else {
                    // $entity_model->where('id', $this->data['record']['id'])
                    //     ->update($this->data['details']);
                    $entity_model->update($this->data['record']['id'], $this->data['details']);

                }
                
                $this->data['record'] = $entity_model->select("*")
                    ->where("user_id = " . $id)->first();
                
                $this->data['geo_data'] = $this->data['geo_model']->select("*")
                ->where("entity_table", "farmer")
                ->where("entity_id", $id)
                ->first(); //GEO data


                /**
                 * GEO data related code
                 */
                $this->data['geo_details'] = [
                    'entity_table' => "farmer",
                    'entity_id' => $this->data['id'],
                    'lat' => $this->request->getVar('lat'),
                    'lng' => $this->request->getVar('lng'),
                ];

                if (!isset($this->data['geo_data']['id'])) {
                    $this->data['geo_model']->insert($this->data['geo_details']);
                } else {
                    $this->data['geo_model']->update($this->data['geo_data']['id'], $this->data['geo_details']);
                }

                header("Location:" . base_url("/user/farmer_project?user_type=2"));
                die;
            } else {
                $this->data['record'] = $_POST;
                if (isset($_POST['altitude'])) {
                    $this->data['geo_data']['lat'] = $_POST['lat'];
                    $this->data['geo_data']['lng'] = $_POST['lng'];
                }
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_farmer($id)
    {
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'barrower_type' => [
                'label' => 'Barrower type',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'head_hh' => [
                'label' => 'Head of household',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            // 'address_no' => [
            //     'label' => 'Address no',
            //     'rules' => 'required|max_length[32]',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'min_length' => "{field} can't have more than 32 letters.",
            //     ]
            // ],
            'address_street' => [
                'label' => 'Address street',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            'address_city' => [
                'label' => 'Address city',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            'whatsapp_no' => [
                'label' => 'Whatsapp no',
                'rules' => 'required|regex_match[/^(07)[0-9]{8}$/]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'regex_match' => "{field} can't have more than 10 letters and should start with 07.",
                ]
            ],
            'age_while_register' => [
                'label' => 'Age at the time of registration',
                'rules' => 'required|max_length[2]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 100.",
                ]
            ],
            'citizenship_by' => [
                'label' => 'Citizenship by',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'heighest_education_qualification' => [
                'label' => 'Heighest education qualification',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'availability_drinking_water' => [
                'label' => 'Availability drinking water',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            // 'source_drinking_water' => [
            //     'label' => 'Source drinking water',
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //     ]
            // ],
            'availability_water_crops' => [
                'label' => 'Aailability water crops',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            // 'source_water_crops' => [
            //     'label' => 'Source water crops',
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //     ]
            // ],
            'cond_house_floor' => [
                'label' => 'Cond house floor',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'consumer_durables' => [
                'label' => 'Consumer durables',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'avilability_vehicles' => [
                'label' => 'Avilability vehicles',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'availability_water_crops' => [
                'label' => 'Availability water crops',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'sanitation' => [
                'label' => 'Sanitation',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'agri_equipments' => [
                'label' => 'Agri equipments',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'tools_farmland' => [
                'label' => 'Tools farmland',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'main_source_income' => [
                'label' => 'Main source income',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'main_source_income_nature' => [
                'label' => 'Main source income nature',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'avg_main_agriculture_income' => [
                'label' => 'Avg main agriculture income',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'avg_main_agricultutre_income_nature' => [
                'label' => 'Avg main agricultutre income nature',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'avg_harvest_income' => [
                'label' => 'Avg harvest income',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'other_income' => [
                'label' => 'Other income',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'other_income_nature' => [
                'label' => 'Other income nature',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'other_income_discription' => [
                'label' => 'Other income discription',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'availability_electricity' => [
                'label' => 'Availability electricity',
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            // 'electricity_from' => [
            //     'label' => 'Electricity from',
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //     ]
            // ],

            'nature_expense_other' => [
                'label' => ucfirst(str_replace("_", " ", "nature_expense_other")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'expense_other' => [
                'label' => ucfirst(str_replace("_", " ", "expense_other")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'undergo_training' => [
                'label' => ucfirst(str_replace("_", " ", "undergo_training")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'samurdhi_pds' => [
                'label' => ucfirst(str_replace("_", " ", "samurdhi_pds")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'balance_diet' => [
                'label' => ucfirst(str_replace("_", " ", "balance_diet")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'hunger_period' => [
                'label' => ucfirst(str_replace("_", " ", "hunger_period")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'financial_decision' => [
                'label' => ucfirst(str_replace("_", " ", "financial_decision")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'before_barrow' => [
                'label' => ucfirst(str_replace("_", " ", "before_barrow")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'source_of_credit' => [
                'label' => ucfirst(str_replace("_", " ", "source_of_credit")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            // 'informal_barrow' => [
            //     'label'  => ucfirst(str_replace("_"," ","informal_barrow")),
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
            // 'formal_barrow' => [
            //     'label'  => ucfirst(str_replace("_"," ","formal_barrow")),
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
            // 'repaid_status_informal' => [
            //     'label'  => ucfirst(str_replace("_"," ","repaid_status_informal")),
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
            // 'repaid_status_formal' => [
            //     'label'  => ucfirst(str_replace("_"," ","repaid_status_formal")),
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
            // 'repaid_formal' => [
            //     'label'  => ucfirst(str_replace("_"," ","repaid_formal")),
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
            // 'repaid_informal' => [
            //     'label'  => ucfirst(str_replace("_"," ","repaid_informal")),
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
            'registered_in' => [
                'label' => ucfirst(str_replace("_", " ", "registered_in")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'register_org' => [
                'label' => ucfirst(str_replace("_", " ", "register_org")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'civil_status' => [
                'label' => ucfirst(str_replace("_", " ", "civil_status")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'no_household_members' => [
                'label' => ucfirst(str_replace("_", " ", "no_household_members")),
                'rules' => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'integer' => '{field} must be a number.',
                ]
            ],
            // 'male_under_5' => [
            //     'label' => ucfirst(str_replace("_", " ", "male_under_5")),
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'integer' => '{field} must be a number.',
            //     ]
            // ],
            // 'female_under_5' => [
            //     'label' => ucfirst(str_replace("_", " ", "female_under_5")),
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'integer' => '{field} must be a number.',
            //     ]
            // ],
            // 'male_5_to_14' => [
            //     'label' => ucfirst(str_replace("_", " ", "male_5_to_14")),
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'integer' => '{field} must be a number.',
            //     ]
            // ],
            // 'female_5_to_14' => [
            //     'label' => ucfirst(str_replace("_", " ", "female_5_to_14")),
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'integer' => '{field} must be a number.',
            //     ]
            // ],
            // 'male_15_to_29' => [
            //     'label' => ucfirst(str_replace("_", " ", "male_15_to_29")),
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'integer' => '{field} must be a number.',
            //     ]
            // ],
            // 'female_15_to_29' => [
            //     'label' => ucfirst(str_replace("_", " ", "female_15_to_29")),
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'integer' => '{field} must be a number.',
            //     ]
            // ],
            // 'male_30_to_49' => [
            //     'label' => ucfirst(str_replace("_", " ", "male_30_to_49")),
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'integer' => '{field} must be a number.',
            //     ]
            // ],
            // 'female_30_to_49' => [
            //     'label' => ucfirst(str_replace("_", " ", "female_30_to_49")),
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'integer' => '{field} must be a number.',
            //     ]
            // ],
            // 'male_50_to_64' => [
            //     'label' => ucfirst(str_replace("_", " ", "male_50_to_64")),
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'integer' => '{field} must be a number.',
            //     ]
            // ],
            // 'female_50_to_64' => [
            //     'label' => ucfirst(str_replace("_", " ", "female_50_to_64")),
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG,
            //         'integer' => '{field} must be a number.',
            //     ]
            // ],
            // 'no_balance_diet' => [
            //     'label'  => ucfirst(str_replace("_"," ","no_balance_diet")),
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
        ];

    }

    public function approvals($id = 0)
    {
        auth_rd();
        $this->data['csrf'] = 1;

        $this->data['vcm_recomendation'] = json_decode('{"1": "Approved", "2":"Rejected", "3":"Pending"}', TRUE);
        $this->data['rpc_recomendation'] = json_decode('{"1": "Approved", "2":"Rejected", "3":"Pending"}', TRUE);
        $this->data['liason_recomendation'] = json_decode('{"1": "Approved", "2":"Rejected", "3":"Pending"}', TRUE);
        $this->data['status_approvals'] = json_decode('{"1":"In Progress", "2":"Approved", "3":" Rejected"}', TRUE);

        $entity_model = new FarmerModel();
        $this->data['id'] = $id;

        $this->data['approval'] = $entity_model->select("*")
            ->where("user_id", $id)->first();

        // Add New Fields
        // find username
        $entity_user_model = new UserModel();

        $approvedUserName = $entity_user_model->select('fname,lname')
            ->where('id', $this->data['approval']['user'])->first();

        // bind user name to id
        if(!is_null($approvedUserName)){
            $this->data['approval']['user'] = $approvedUserName['fname'] . ' ' . $approvedUserName['lname'];
        }

        $this->data['user_record'] = $entity_user_model->select("*")
            ->where("id = " . $_SESSION['user']['id'])->first();
//        $_SESSION['user']['id'];

        // find designation id
        $designation_id = '';
        $entity_user_designation_model = new UserDesignationModel();
        $this->data['user_designation'] = $entity_user_designation_model->select("*")
            ->where("user_id = " . $_SESSION['user']['id'])->first();

        $array = $this->data['user_designation'];

        if (isset($array['designation_id'])) {
            $designation_id = $array['designation_id'];
        }

//        find designation name
        $entity_designation_model = new DesignationModel();
        $this->data['designation'] = $entity_designation_model->select("*")
            ->where("id = " . $designation_id)->first();
        
        $this->process_form_approvals($id);

        return view('user/approvals', $this->data);
    }

    private function process_form_approvals($id = 0)
    {
        $validation = \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new FarmerModel();
        $user_model = new UserModel();

        if (isset($_POST['csrf'])) {
            // $validation->setRules($this->validation_rules_approvals($id));

            // find user id
            // $this->request->getVar('user');

            $userId = $user_model->select('id')
                ->where('email', $_SESSION['user']['email'])->first();
            

            $this->data['details'] = [
                // 'id' => $id,
                // 'user_id' => $id,
                'status' => $this->request->getVar('status'),
                'approved_date' => $this->request->getVar('approved_date'),
                'user' => $userId['id'],
                'designation' => $this->request->getVar('designation'),
                'reason' => $this->request->getVar('reason'),
            ];

            // get user full name 
            $entity_user_model = new UserModel();
            $this->data['user_record'] = $entity_user_model->select("fname, lname")
                ->where("id", $id)->first();

            $farmerName =  ucwords(strtolower($this->data['user_record']['fname'] . " " . $this->data['user_record']['lname']));

            if(isset($this->data['details']['approved_date']) && is_array($this->data['details'])){
                $entity_model->set($this->data['details'])->where('user_id', $id)->update();

                if($this->data['details']['status']==1){
                    cano_set_alert("warning", $farmerName . "'s status changed to In Progress");
                } elseif ($this->data['details']['status']==2) {
                    cano_set_alert("success", $farmerName . "'s status changed to Approved");
                } elseif ($this->data['details']['status']==3){
                    cano_set_alert("warning", $farmerName . "'s status changed to Rejected");
                }

                header("Location:" . base_url("/user/farmer_project/" . $id. "?user_type=2"));
                die;
            }

        }
       
            
           
        $validation->listErrors();
    }

    public function delete($id = 0)
    {
        $entity_model = new UserModel();
        $farmer_model = new FarmerModel();
        $grant_dis_model = new GrandDisbursementModel();
        $grant_item_model = new GrandItemModel();
        $loan_dis_model = new LoanDisbursementModel();
        $link_loan_dis_model = new LinkDisbursementFarmerModel();
        $farmer_project_model = new FarmerProjectModel();

        $this->data['farmer_record'] = $farmer_model->select("*")
            ->where("user_id" , $id)->first();

        // if(isset($this->data['farmer_record'])){
            $this->data['user_data'] = $entity_model->select("*")
                ->where("id" , $id)->first();
        // }

        $this->data['record'] = $entity_model->select("user.mobile, user.email, user.pin")
            ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
            ->where("user.id = " . $id)->first();
        
        $this->data['details'] = [
            'is_delete' => 1,
            'pin' => $this->data['record']['pin'] . "-" . rand(1, 100),
            'mobile' => $this->data['record']['mobile'] . "-" . rand(1, 100),
            'email' => $this->data['record']['email'] . "-" . rand(1, 100),
        ];

        // Farmer delete
        if($this->data['user_data']['user_type'] == 2){

            // get related farmer grant disbursment data
            $related_grant_dis_data = $grant_dis_model->select("*")
                ->where("farmer_id", $id)
                ->findAll();

            // delete related farmer grant disbursment data
            foreach ($related_grant_dis_data as $val) {
                $grant_item_model->select('*')
                    ->where('grant_disbursement_id', $val['id'])
                    ->delete();

                $grant_dis_model->delete($val['id']);
            }
            
            // get link disbursement farmer data
            $related_link_loan_dis_data = $link_loan_dis_model->select("*")
                ->where("user_id", $id)
                ->findAll();

        
            // get related farmer loan disbursment data
            foreach($related_link_loan_dis_data as $key => $val){
                $related_loan_dis_data = $loan_dis_model->select("*")
                    ->where("id", $val['loan_disbursement_id'])
                    ->findAll();

                // delete related farmer loan disbursment data
                foreach ($related_loan_dis_data as $val) {
                    $loan_dis_model->delete($val['id']);
                }
            }
            
            // get farmer project data
            $related_farmer_project_data = $farmer_project_model->select("*")
                ->where("farmer_id", $id)
                ->findAll();
            
            // deleted related farmer project data
            foreach ($related_farmer_project_data as $val) {
                $farmer_project_model->where('farmer_id', $id)->delete();
            }

            //delete Farmer meta data
            $farmer_model->where('user_id', $id)->delete();

            // delete farmer user data
            $entity_model->update($id, $this->data['details']);
            $entity_model->delete($id);
            
            header("Location:" . base_url("/user/farmer_project?user_type=2"));
            die;
        }

        $entity_model->update($id, $this->data['details']);
        $entity_model->delete($id);
        header("Location:" . base_url("/user/list_all/"));
        die;
    }

    public function forget()
    {
        if (isset($_POST['email'])) {
            $entity_model = new UserModel();

            $this->data['record'] = $entity_model->select("user.id, user.fname,user.lname, user.mobile, user.email, user.language,file_registry.relative_path")
                ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
                ->where("(user.mobile LIKE '" . $this->request->getVar('email') . "' OR user.email LIKE '" . $this->request->getVar('email') . "') AND user.status = 1 AND user.is_delete = 0")->first();

            if (isset($this->data['record']['id'])) {
                $code = md5($this->data['record']['id'] . date('YmdHis') . rand(1, 9999));

                $this->data['details'] = [
                    'otp' => $code,
                ];

                $entity_model->update($this->data['record']['id'], $this->data['details']);

                $to = $this->data['record']['email'];
                $subject = "SAPP | Forgot password for your account";
                $title = "Forgot your password?<br />Let's get you a new one.";
                $message = '<p>Hi ' . $this->data['record']['fname'] . ' ' . $this->data['record']['lname'] . ' </p><p>If you\'ve lost your password <br> or wish to reset it, </p><br>
                <a class="link-btn" style="background-color: #9e1d1d; border-radius: 4px; color: #fcf6e7; padding: 15px; font-size: 14px; text-decoration: none; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;" href="' . base_url("/user/password_reset/" . $code) . '">Reset Password</a>';

                send_mail($to, $subject, $title, $message);

                cano_set_alert("danger", "Please check your mail and follow the link to reset the password.");

                header("Location:" . base_url(""));
                die;
            } else {
                cano_set_alert("danger", "Username or email does not exist.");
            }
        }

        return view('user/forget', $this->data);
    }

    public function password_reset($id)
    {
        $entity_model = new UserModel();

        $this->data['record'] = $entity_model->select("user.id, user.fname,user.lname, user.mobile, user.email, user.language,file_registry.relative_path")
            ->join('file_registry', 'file_registry.id = user.profile_picture', 'left')
            ->where("user.otp LIKE '" . $id . "' AND user.otp NOT LIKE '1' AND user.status = 1 AND user.is_delete = 0")->first();

        //$query = $this->data["db"]->getLastQuery();
        //echo (string)$query;die;

        if (isset($this->data['record']['id'])) {
            $_SESSION['user'] = $this->data['record'];

            $query = $this->data["db"]->query("SELECT DISTINCT link_action_group.action_id FROM link_user_group LEFT JOIN link_action_group ON link_user_group.group_id = link_action_group.group_id WHERE link_user_group.start_at <= '" . date('Y-m-d H:i:s') . "' AND link_user_group.end_at >= '" . date('Y-m-d H:i:s') . "' AND link_user_group.user_id = " . $this->data['record']['id'] . " ORDER BY link_action_group.action_id ASC");
            $action_list = $query->getResultArray();

            if (isset($action_list) && is_array($action_list)) {
                foreach ($action_list as $val) {
                    $_SESSION['user']['actions'][] = $val['action_id'];
                }
            }

            $this->data['details'] = [
                'otp' => 1,
            ];

            $entity_model->update($this->data['record']['id'], $this->data['details']);

            cano_set_alert("danger", "Please change the password now as the reset link will be expired.");

            header("Location:" . base_url("/user/change_password/"));
            die;
        } else {
            cano_set_alert("danger", "The password reset link is expired.");
            header("Location:" . base_url());
            die;
        }
    }

    public function generate_template()
    {
        auth_rd();
        $this->data['csrf'] = 1;

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Apply header styles
        $headerStyle = $sheet->getStyle('A1:' . 'N2');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');
        $headerStyle->getAlignment()->setHorizontal('center');
        $headerStyle->getAlignment()->setWrapText(true);

        // Merge cells
        $sheet->mergeCells('A1:N1');

        // set table topic
        $sheet->setCellValue('A1', "Basic Information- Farmer");

        // Set table Header
        $sheet->setCellValue('A2', "ID");
        $sheet->setCellValue('B2', "First Name *");
        $sheet->setCellValue('C2', "Last Name *");
        $sheet->setCellValue('D2', "NIC *");
        $sheet->setCellValue('E2', "Email");
        $sheet->setCellValue('F2', "Phone *");
        $sheet->setCellValue('G2', "Date Of Birth");
        $sheet->setCellValue('H2', "Gender(M/F) *");
        $sheet->setCellValue('I2', "Address no");
        $sheet->setCellValue('J2', "Address street");
        $sheet->setCellValue('K2', "Address city");
        $sheet->setCellValue('L2', "GND ID");
        $sheet->setCellValue('M2', "Agrarian Division ID");
        $sheet->setCellValue('N2', "Approved Date");

        // Auto-size columns
        foreach (range('A', 'N') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create a writer object and save the Excel file
        $writer = new Xlsx($spreadsheet);
        $basePath = config("App")->basePath;
        $filename = $basePath . 'public/resource/upload/SAPP_Beneficiary_Details_Farmer.xlsx';
        $writer->save($filename);

        // Set appropriate headers for file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($filename);
        exit;

    }

    public function resource_generate()
    {
        auth_rd();
        $this->data['active_module'] = "/grant/resource_generate/";

        $gnd_model = new GndModel();
        $agg_model = new AggrarianDivisionModel;

        // Find gnd list
        $this->data['gnd_list'] = $gnd_model->select("id, gnd")
            ->orderBy("gnd", "ASC")
            ->findAll();

        // Find agg list
        $this->data['agg_list'] = $agg_model->select("id, name, lat, lon")
            ->orderBy("name", "ASC")
            ->findAll();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Apply header styles
        $headerStyle = $sheet->getStyle('A1:' . 'G3');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');
        $headerStyle->getAlignment()->setHorizontal('center');
        $headerStyle->getAlignment()->setWrapText(true);
        $sheet->getRowDimension('1')->setRowHeight(30);

        // Auto-size columns
        foreach (range('A3', 'G3') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // set table topic
        $sheet->setCellValue('A1', "Basic Information - Farmer" . "\nResource");
        $sheet->setCellValue('A2', "GND Details");
        $sheet->setCellValue('D2', "Agrarian Division Details");

        // Merge cells
        $sheet->mergeCells('A1:G1');
        $sheet->mergeCells('A2:B2');
        $sheet->mergeCells('D2:G2');

        if (!empty($this->data['gnd_list'])) {
            // Create GND table
            // Write headers for GND table
            $headers = array_keys($this->data['gnd_list'][0]);
            $column = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($column . '3', $header);
                $column++;
            }

            // Load values to the farmer category table
            $row = 4;
            foreach ($this->data['gnd_list'] as $result) {
                $column = 'A';
                foreach ($result as $value) {
                    $sheet->setCellValue($column . $row, $value);
                    $column++;
                }
                $row++;
            }
        }

        if (!empty($this->data['agg_list'])) {
            // Create farmer table
            // Write headers for farmer table
            $headers = array_keys($this->data['agg_list'][0]);
            $column = 'D';
            foreach ($headers as $header) {
                $sheet->setCellValue($column . '3', $header);
                $column++;
            }

            // Load values to the farmer table
            $row = 4;
            foreach ($this->data['agg_list'] as $result) {
                $column = 'D';
                foreach ($result as $value) {
                    $sheet->setCellValue($column . $row, $value);
                    $column++;
                }
                $row++;
            }
        }

        // Create a writer object and save the Excel file
        $writer = new Xlsx($spreadsheet);
        $basePath = config("App")->basePath;
        $filename = $basePath . 'public/resource/upload/SAPP_Beneficiary_Details_Farmer_Resource.xlsx';
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
        $this->data['active_module'] = "/user/bulk_upload/";
        $this->data['csrf'] = 1;

        $user_model = new UserModel();
        $farmer_model = new FarmerModel();
        $gnd_model = new GndModel();
        $agg_model = new AggrarianDivisionModel();

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

        $this->data['record'] = array();
        $this->data['records'] = array();

        // temp data array
        $allreadyInDB = array();
        $wrongData = array();
        // $row_numbers = '';
        $errorMsg = '';

        for ($row = 3; $row <= $highestRow; $row++) {

            // NIC validate
            $cellNIC = '';
            if (!empty($worksheet->getCell('D' . $row)->getValue())) {
                $nic_validate_response = nic_parse(strtoupper($worksheet->getCell('D' . $row)->getValue()));
                if ($nic_validate_response == false) {
                    // $this->data['validation']->setError('pin', 'Invalid NIC Format');
                    // Invalid date
                    $errorMsg = "Invalid NIC Format.";
                    $this->bulk_upload_error($entity_id, $row, $errorMsg);
                }
            }

            if($worksheet->getCell('G' . $row)->getFormattedValue() !== ''){
                $cellValue = $worksheet->getCell('G' . $row)->getFormattedValue();

                if (strtotime($cellValue) !== false) {
                    // Valid date
                    $date = new DateTime($cellValue);
                    $dob = $date->format('Y-m-d');
                } else {
                    // Invalid date
                    $errorMsg = "Wrong DOB.";
                    $this->bulk_upload_error($entity_id, $row, $errorMsg);
                }
            }else{
                $dob = null;
            }
            
            $cellGender = strtoupper(trim($worksheet->getCell('H' . $row)->getValue()));
            if ($cellGender == "M" || $cellGender == "MALE") {
                $gender = "1";
            } elseif ($cellGender == "F" || $cellGender == "FEMALE") {
                $gender = "2";
            } else {
                // error
                $errorMsg = "Wrong gender.";
                $this->bulk_upload_error($entity_id, $row, $errorMsg);
            }

            // Empty Mobile number
            if ($worksheet->getCell('F' . $row)->getValue() == "") {
                $errorMsg = "Phone number cannot be empty.";
                $this->bulk_upload_error($entity_id, $row, $errorMsg);
            }

            // Agrarian Division wrong
            $this->data['agg_details']= $agg_model->select("*")
            ->where("id", $worksheet->getCell('M' . $row)->getValue())
            ->first();

            if(empty($this->data['agg_details'])){
                $errorMsg="Wrong Agrarian division ID.";
                $this->bulk_upload_error($entity_id, $row, $errorMsg);
            }

            // GND wrong
            $this->data['gnd_details']= $gnd_model->select("*")
            ->where("id", $worksheet->getCell('L' . $row)->getValue())
            ->first();

            if(empty($this->data['gnd_details'])){
                $errorMsg="Wrong GND ID.";
                $this->bulk_upload_error($entity_id, $row, $errorMsg);
            }

            // Founded Wrong row
            // if(!empty($wrongData)){
            //     $row_numbers = '';
            //     foreach($wrongData as $key=>$val){
            //         $row_numbers  = $row_numbers . $val . ', ';
            //     };
            //     cano_set_alert("danger", "The bulk upload is unsuccessful. A data row is wrong. But the above rows were successful. Please correct the row and try again. Wrong row numbers:- ". rtrim($row_numbers, ", "). ". ERROR:- ". $errorMsg );
            //     header("Location:" . base_url("/user/farmer_project?user_type=2")); 
            //     die;
            // }

            $approvedDate = null;
            if(trim($worksheet->getCell('N' . $row)->getFormattedValue()) !== ''){
                $cellValue = $worksheet->getCell('N' . $row)->getFormattedValue();

                if (strtotime($cellValue) !== false) {
                    // Valid date
                    $date = new DateTime($cellValue);
                    $approvedDate = $date->format('Y-m-d');
                } else {
                    // Invalid date
                    $errorMsg = "Invalid approved date";
                    $this->bulk_upload_error($entity_id, $row, $errorMsg);
                }
            }else{
                $approvedDate = null;
            }

            $this->data['details']=[
                'fname' => $worksheet->getCell('B' . $row)->getValue(),
                'lname' => $worksheet->getCell('C' . $row)->getValue(),
                'email' => $worksheet->getCell('E' . $row)->getValue(),
                'mobile' => $worksheet->getCell('F' . $row)->getValue(),
                'dob' => $dob,
                'gender' => $gender,
                'pin' => $worksheet->getCell('D' . $row)->getValue(),
                'status' => 1,
                'user_type' => 2,
            ];

            // Check email is empty
            if ($this->data['details']['email'] == "") {
                $this->data['details']['email'] = $this->data['details']['pin'] . "@mis-sapp.com";
            }

            $this->data['user_details'] = $user_model->select("*")
                ->join('farmer', 'farmer.user_id = user.id', 'left')
                ->where("pin" , $this->data['details']['pin'])
                ->first();

            if (isset($this->data['user_details'])) {
                // update farmer details
                array_push($allreadyInDB, $row);

                $user_model->update($this->data['user_details']['user_id'], $this->data['details']);

                $farmer = $farmer_model->select("*")
                    ->where("user_id", $this->data['user_details']['user_id'])
                    ->first();

                if(trim($worksheet->getCell('N' . $row)->getFormattedValue()) !== ''){
                    $this->data['details_farmer'] = [
                        'address_no' => $worksheet->getCell('I' . $row)->getValue(),
                        'address_street' => $worksheet->getCell('J' . $row)->getValue(),
                        'address_city' => $worksheet->getCell('K' . $row)->getValue(),
                        'gnd_id' => $worksheet->getCell('L' . $row)->getValue(),
                        'aggrarian_division_id' => $worksheet->getCell('M' . $row)->getValue(),
                        'user' => $_SESSION['user']['id'],
                        'status' => 2,
                        'approved_date' => $approvedDate
                    ];
                }else{
                    $this->data['details_farmer'] = [
                        'address_no' => $worksheet->getCell('I' . $row)->getValue(),
                        'address_street' => $worksheet->getCell('J' . $row)->getValue(),
                        'address_city' => $worksheet->getCell('K' . $row)->getValue(),
                        'gnd_id' => $worksheet->getCell('L' . $row)->getValue(),
                        'aggrarian_division_id' => $worksheet->getCell('M' . $row)->getValue(),
                    ];
                }

                $farmer_model->update($farmer['id'], $this->data['details_farmer']);
            
                // $farmer_model->update($this->data['user_details']['id'],$this->data['details']);
                // $user_model->update($this->data['user_details']['user_id'], $this->data['details']);

            }else{
                // Insert farmer details as a new record
                $user_model->insert($this->data['details']);
                $this->data['id'] = $user_model->getInsertID();

                if($worksheet->getCell('N' . $row)->getFormattedValue() !== ''){
                    // Approved date bind
                    $this->data['details_farmer'] = [
                        'address_no' => $worksheet->getCell('I' . $row)->getValue(),
                        'address_street' => $worksheet->getCell('J' . $row)->getValue(),
                        'address_city' => $worksheet->getCell('K' . $row)->getValue(),
                        'gnd_id' => $worksheet->getCell('L' . $row)->getValue(),
                        'aggrarian_division_id' => $worksheet->getCell('M' . $row)->getValue(),
                        'user_id' => $this->data['id'],
                        'user' => $_SESSION['user']['id'],
                        'status' => 2,
                        'approved_date' => $approvedDate
                    ];
                }else{
                    $this->data['details_farmer'] = [
                        'address_no' => $worksheet->getCell('I' . $row)->getValue(),
                        'address_street' => $worksheet->getCell('J' . $row)->getValue(),
                        'address_city' => $worksheet->getCell('K' . $row)->getValue(),
                        'gnd_id' => $worksheet->getCell('L' . $row)->getValue(),
                        'aggrarian_division_id' => $worksheet->getCell('M' . $row)->getValue(),
                        'user_id' => $this->data['id'],
                    ];
                }

                $farmer_model->insert($this->data['details_farmer']);
            }

        }

        // die;

        if(empty($allreadyInDB)){
            // Not founded allready recorded data
            cano_set_alert("success", "Bulk upload is successful");
            header("Location:" . base_url("/user/farmer_project?user_type=2")); 
            die;
        } else {
            // Founded allready recorded data
            $row_numbers = '';
            foreach($allreadyInDB as $key=>$val){
                $row_numbers  = $row_numbers . $val . ', ';
            };
            cano_set_alert("warning", "The bulk upload is successful. But some data rows were updated. Updated row numbers:- " . rtrim($row_numbers, ", ") );
            header("Location:" . base_url("/user/farmer_project?user_type=2")); 
            die;
        }
    }

    private function bulk_upload_error($entity_id, $row, $message){
        cano_set_alert("danger", "The bulk upload is unsuccessful. A data row is wrong. But the above rows were successful. Please correct the row and try again. Wrong row numbers:- ". rtrim($row, ", "). ". ERROR:- ". $message );
        header("Location:" . base_url("/user/farmer_project?user_type=2")); 
        die;
    }

}

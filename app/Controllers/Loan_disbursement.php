<?php

namespace App\Controllers;
use App\Models\LoanModel;
use App\Models\LoanDisbursementModel;
use App\Models\LoanDisbursementStatusModel;
use App\Models\LinkDisbursementFarmerModel;
use App\Models\LinkDisbursementCommunityOrgModel;
use App\Models\LinkDisbursementPromoterModel;
use App\Models\UserModel;
use App\Models\PromoterMetaModel;
use App\Models\CommunityOrgModel;
use App\Models\ProjectModel;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use function PHPUnit\Framework\isNull;

class Loan_disbursement extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['loan_disbursement_entity'] = json_decode(get_config(33),TRUE);
        $this->data['disbursement_status'] = json_decode(get_config(32),TRUE);

        track();
    }

    public function list_all($loan_id=0)
	{
        auth_rd(139);
        $this->data['active_module'] = "/loan_disbursement/list_all/";
        $this->data['csrf'] = 1;
        $this->data['loan_id'] = $loan_id;
        
        $entity_model = new LoanDisbursementModel();
        $user_model = new UserModel();
        // $link_community_model = new LinkDisbursementCommunityOrgModel();

        $promoter_model = new PromoterMetaModel();
        $community_model = new CommunityOrgModel();

        $this->data['list_all'] = $entity_model->select("loan_disbursement.*,loan.loan_scheme_name, link_disbursement_community_org.community_org_id, link_disbursement_promoter.promoter_id, link_disbursement_farmer.user_id")
            ->join('loan', 'loan_disbursement.loan_id = loan.id', 'left')
            ->join('link_disbursement_community_org', 'loan_disbursement.id = link_disbursement_community_org.loan_disbursement_id', 'left')
            ->join('link_disbursement_promoter', 'loan_disbursement.id = link_disbursement_promoter.loan_disbursement_id', 'left')
            ->join('link_disbursement_farmer', 'loan_disbursement.id = link_disbursement_farmer.loan_disbursement_id', 'left')
            ->where($this->get_filter($loan_id))
            ->findAll();
        // $this->data['user_list'] = $user_model->findAll();

        // $this->data['promoter_list'] = $promoter_model->findAll();
        // $this->data['community_list'] = $community_model->findAll();

        $this->data['list_all_with_beneficiary'] = array();

        // Update the list with all data and beneficiary name
        foreach($this->data['list_all'] as $val){
            if ($val['community_org_id'] != null){
                $this->data['tmp_data'] = $community_model->select("*")
                    ->where('id', $val['community_org_id'])
                    ->first();
                $val['beneficiary_name'] = $this->data['tmp_data']['organization_name'];        
            }elseif($val['promoter_id'] != null){
                $this->data['tmp_data'] = $promoter_model->select("*")
                    ->where('id', $val['promoter_id'])
                    ->first();
                    $val['beneficiary_name'] = $this->data['tmp_data']['org_name'];  
            }elseif($val['user_id'] != null){
                $this->data['tmp_data'] = $user_model->select("*")
                    ->where('id', $val['user_id'])
                    ->first();
                    $val['beneficiary_name'] = $this->data['tmp_data']['fname']." ".$this->data['tmp_data']['lname']."(".$this->data['tmp_data']['pin'].")"; 
            }
            else{
                $val['beneficiary_name']= null;
            }
            array_push($this->data['list_all_with_beneficiary'], $val);
        }

        return view('loan_disbursement/list_all',$this->data);
    }
    public function view($loan_id=0,$id=0){
        auth_rd(140);
        $this->data['active_module'] = "/loan_disbursement/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['loan_id'] = $loan_id;
        
        $entity_model = new LoanDisbursementModel();
        $loan_model = new LoanModel();
        $user_model = new UserModel();
        $promoter_model = new PromoterMetaModel();
        $community_model = new CommunityOrgModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $obtained_benifit = [1,3];

        $loan_detail = $loan_model->select("*")
        ->where("id", $loan_id)
        ->first();  
                            
        if(isset($loan_detail['project_id']))
        {            
            $this->data['farmer_list'] = $user_model
                                            ->join('farmer_project', 'user.id = farmer_project.farmer_id', 'left')
                                            ->where('user.user_type', 2)
                                            ->where('farmer_project.project_id', $loan_detail['project_id'])
                                            ->where('farmer_project.deleted_at', null)
                                            ->findAll();
                                            //$query = $this->data["db"]->getLastQuery();
                                            //echo (string)$query;die;
        }
        $this->data['promoter_list'] = $promoter_model->findAll();
        $this->data['community_list'] = $community_model->findAll();

        if(isset($this->data['record']['loan_disbursement_entity']) && $this->data['record']['loan_disbursement_entity']==1)
        {
            $link_model = new LinkDisbursementCommunityOrgModel();
            $link_record = $link_model->select("*")
                            ->where("loan_disbursement_id", $id)
                            ->first();  
            $this->data['record']['community_entity_id'] = $link_record['community_org_id'];
        }
        elseif(isset($this->data['record']['loan_disbursement_entity']) && $this->data['record']['loan_disbursement_entity']==2)
        {
            $link_model = new LinkDisbursementFarmerModel();
            $link_record = $link_model->select("*")
                            ->where("loan_disbursement_id", $id)
                            ->first(); 
            if(isset($link_record['user_id']))
            {
                $this->data['record']['farmer_entity_id'] = $link_record['user_id'];
            }
        }
        elseif(isset($this->data['record']['loan_disbursement_entity']) && $this->data['record']['loan_disbursement_entity']==3)
        {
            $link_model = new LinkDisbursementPromoterModel();
            $link_record = $link_model->select("*")
                            ->where("loan_disbursement_id", $id)
                            ->first(); 
            if(isset($link_record['promoter_id']))
            {
                $this->data['record']['promoter_entity_id'] = $link_record['promoter_id'];
            }
        }
        $this->process_form_add_edit($loan_id,$id);        

        return view('loan_disbursement/add_edit',$this->data);
    }

    public function add_edit($loan_id=0,$id=0)
	{
        // auth_rd();
        if($id == 0){
            // add
            auth_rd(141);
        } else {
            // edit
            auth_rd(142);
        }
        $this->data['active_module'] = "/loan_disbursement/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['loan_id'] = $loan_id;
        
        $entity_model = new LoanDisbursementModel();
        $loan_model = new LoanModel();
        $user_model = new UserModel();
        $promoter_model = new PromoterMetaModel();
        $community_model = new CommunityOrgModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $obtained_benifit = [1,3];

        $loan_detail = $loan_model->select("*")
        ->where("id", $loan_id)
        ->first();  
                            
        if(isset($loan_detail['project_id']))
        {            
            $this->data['farmer_list'] = $user_model
                                            ->join('farmer_project', 'user.id = farmer_project.farmer_id', 'left')
                                            ->where('user.user_type', 2)
                                            ->where('farmer_project.project_id', $loan_detail['project_id'])
                                            ->where('farmer_project.deleted_at', null)
                                            ->findAll();
                                            //$query = $this->data["db"]->getLastQuery();
                                            //echo (string)$query;die;
        }
        $this->data['promoter_list'] = $promoter_model->findAll();
        $this->data['community_list'] = $community_model->findAll();

        if(isset($this->data['record']['loan_disbursement_entity']) && $this->data['record']['loan_disbursement_entity']==1)
        {
            $link_model = new LinkDisbursementCommunityOrgModel();
            $link_record = $link_model->select("*")
                            ->where("loan_disbursement_id", $id)
                            ->first();  
            $this->data['record']['community_entity_id'] = $link_record['community_org_id'];
        }
        elseif(isset($this->data['record']['loan_disbursement_entity']) && $this->data['record']['loan_disbursement_entity']==2)
        {
            $link_model = new LinkDisbursementFarmerModel();
            $link_record = $link_model->select("*")
                            ->where("loan_disbursement_id", $id)
                            ->first(); 
            if(isset($link_record['user_id']))
            {
                $this->data['record']['farmer_entity_id'] = $link_record['user_id'];
            }
        }
        elseif(isset($this->data['record']['loan_disbursement_entity']) && $this->data['record']['loan_disbursement_entity']==3)
        {
            $link_model = new LinkDisbursementPromoterModel();
            $link_record = $link_model->select("*")
                            ->where("loan_disbursement_id", $id)
                            ->first(); 
            if(isset($link_record['promoter_id']))
            {
                $this->data['record']['promoter_entity_id'] = $link_record['promoter_id'];
            }
        }
        $this->process_form_add_edit($loan_id,$id);        

        return view('loan_disbursement/add_edit',$this->data);
    }

    private function process_form_add_edit($loan_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new LoanDisbursementModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
            $farmer_entity_id = $this->request->getVar('farmer_entity_id');
            $promoter_entity_id = $this->request->getVar('promoter_entity_id');
            $community_entity_id = $this->request->getVar('community_entity_id');
          
            $this->data['details'] = [
                'loan_id' => $loan_id,
                'loan_disbursement_entity' => $loan_disbursement_entity,
                'cbsl_reg_no' => $this->request->getVar('cbsl_reg_no'),
                'cbsl_reg_amount' => $this->request->getVar('cbsl_reg_amount'),
                'required_loan_amount' => $this->request->getVar('required_loan_amount'),
                'actual_loan_amount' => $this->request->getVar('actual_loan_amount'),
                'disbursement_status' => $this->request->getVar('disbursement_status'),
                'loan_disbursement_date' => $this->request->getVar('loan_disbursement_date'),
                'remarks' => $this->request->getVar('remarks'),
                'refinance_date' => $this->request->getVar('refinance_date'),
                'refinance_amount' => $this->request->getVar('refinance_amount'),
            ];
            
            if($validation->withRequest($this->request)->run()){ 

                if($id == 0){
                    // Check entity already in the Database
                    if($loan_disbursement_entity==1){
                        $this->data['list'] = $entity_model->select("*")
                            ->join('link_disbursement_community_org', 'loan_disbursement.id = link_disbursement_community_org.loan_disbursement_id', 'left')
                            ->where('loan_id', $loan_id)
                            ->where('link_disbursement_community_org.community_org_id', $community_entity_id)
                            ->findAll();
                    } elseif($loan_disbursement_entity==2) {
                        $this->data['list'] = $entity_model->select("*")
                            ->join('link_disbursement_farmer', 'loan_disbursement.id = link_disbursement_farmer.loan_disbursement_id', 'left')
                            ->where('loan_id', $loan_id)
                            ->where('link_disbursement_farmer.user_id', $farmer_entity_id)
                            ->findAll();
                    } else {
                        $this->data['list'] = $entity_model->select("*")
                            ->join('link_disbursement_promoter', 'loan_disbursement.id = link_disbursement_promoter.loan_disbursement_id', 'left')
                            ->where('loan_id', $loan_id)
                            ->where('link_disbursement_promoter.promoter_id', $promoter_entity_id)
                            ->findAll();
                    }
                    
                    if(!empty($this->data['list'])){
                        // If entity already in the Database, rederect to the add_edit and set alert
                        cano_set_alert('danger', 'A loan has already been assigned to this entity.');
                        header("Location:" . base_url("/loan_disbursement/add_edit/" . $loan_id)); 
                        die;
                    }
                } 

                if(empty($this->data['record'])){
                    // Save new data
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                }else{  
                    // Update the already exist data
                    $entity_model->where('id', $this->data['record']['id'])->delete();
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                }   
    
                if($loan_disbursement_entity==1){
                    // Add data to the link_disbursement_community_org
                    $link_model = new LinkDisbursementCommunityOrgModel();
                    $this->data['link_details'] = [
                        'loan_disbursement_id' => $this->data['id'],
                        'community_org_id' => $community_entity_id,
                    ];
                    $link_model->where('loan_disbursement_id', $this->data['id'])->delete();
                    $link_model->insert($this->data['link_details']);
                } elseif($loan_disbursement_entity==2) {
                    // Add data to the link_disbursement_farmer
                    $link_model = new LinkDisbursementFarmerModel();
                    $this->data['link_details'] = [
                        'loan_disbursement_id' => $this->data['id'],
                        'user_id' => $farmer_entity_id,
                    ];
                    $link_model->where('loan_disbursement_id', $this->data['id'])->delete();
                    $link_model->insert($this->data['link_details']);
                } else {
                    // Add data to the link_disbursement_promoter
                    $link_model = new LinkDisbursementPromoterModel();
                    $this->data['link_details'] = [
                        'loan_disbursement_id' => $this->data['id'],
                        'promoter_id' => $promoter_entity_id,
                    ];
                    $link_model->where('loan_disbursement_id', $this->data['id'])->delete();
                    $link_model->insert($this->data['link_details']);
                }
                $link_model->purgeDeleted();
                    
                header("Location:" . base_url("/loan_disbursement/list_all/" . $loan_id . "/")); 
                die;

                $this->data['record'] = $entity_model->find($id);
            } else {
                $this->data['record'] = $_POST;
            }
            
            $validation->listErrors();
        }
    }

    private function validation_rules_entity_add_edit()
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'loan_disbursement_entity' => [
                'label'  => 'Loan disbursement entity type',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'cbsl_reg_no' => [
                'label'  => 'CBSL reg no',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'cbsl_reg_amount' => [
                'label'  => 'CBSL reg amount',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'required_loan_amount' => [
                'label'  => 'Required loan amount',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            // 'actual_loan_amount' => [
            //     'label'  => 'Actual loan amount',
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
            'disbursement_status' => [
                'label'  => 'Disbursement status',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            // 'loan_disbursement_date' => [
            //     'label'  => 'Loan disbursement date',
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ],
            // 'entity_id' => [
            //     'label'  => 'Loan disbursement entity',
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => VALIDATION_MANDATORY_MSG
            //     ]
            // ]
        ];
        
    }

    public function delete($loan_id=0,$id=0)
    {
        auth_rd(143);
        $this->data['eoi_id'] = $id;
        $entity_model = new LoanDisbursementModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/loan_disbursement/list_all/" . $loan_id)); 
        die;
    }

    private function get_filter($loan_id)
    {
        $where = "`loan_disbursement`.loan_id = ".$loan_id;

        $field_name = "loan_scheme_name";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND `grant`." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        $field_name = "cbsl_reg_no";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND `loan_disbursement`." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        return $where;
    }

    public function generate_template($loan_id = 0)
    {
        auth_rd();
        $this->data['csrf'] = 1;

        $project_model = new ProjectModel();
        $loan_model = new LoanModel();

        // find project id
        $this->data['loan_project_id'] = $loan_model->select('project_id')
            ->where("id", $loan_id)
            ->first();

        
        // find the project name
        $this->data['project'] = $project_model->select("project_name")
            ->where("id", $this->data['loan_project_id']['project_id'])
            ->first();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Apply header styles
        $headerStyle = $sheet->getStyle('A1:' . 'L2');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');
        $headerStyle->getAlignment()->setHorizontal('center');
        $headerStyle->getAlignment()->setWrapText(true);
        $sheet->getRowDimension('1')->setRowHeight(30);

        // Merge cells
        $sheet->mergeCells('A1:L1');

        // set table topic
        $sheet->setCellValue('A1', "Project: " . $this->data['project']['project_name'] . "\nSAPP Loan Disbursement Details");

        // Set table Header
        $sheet->setCellValue('A2', "ID");
        $sheet->setCellValue('B2', "Loan Disbursement Entity Type *". "\nFarmer Organization - FO, Farmer - F, Promoter - P");
        $sheet->setCellValue('C2', "Loan disbursement Entity ID *");
        $sheet->setCellValue('D2', "CBSL reg no *");
        $sheet->setCellValue('E2', "Estimated Amount *");
        $sheet->setCellValue('F2', "Recommended Amount *");
        $sheet->setCellValue('G2', "Disbursed Amount");
        $sheet->setCellValue('H2', "Loan Disbursement Status *" . "\nRegisterd - Reg, Pending Bank Response - Pend," . "\nLoan Disbursedd - Dis, Loan Refinanced - Ref");
        $sheet->setCellValue('I2', "Refinance Date");
        $sheet->setCellValue('J2', "Refinance Amount");
        $sheet->setCellValue('K2', "Loan disbursement date");
        $sheet->setCellValue('L2', "Remarks");

        // Auto-size columns
        foreach (range('A', 'L') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create a writer object and save the Excel file
        $writer = new Xlsx($spreadsheet);
        $basePath = config("App")->basePath;
        $filename = $basePath . 'public/resource/upload/SAPP_Loan_Disbursement_Details.xlsx';
        $writer->save($filename);

        // Set appropriate headers for file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($filename);
        exit;

    }

    public function resource_generate($loan_id = 0)
    {
        auth_rd();
        $this->data['active_module'] = "/loan_disbursement/resource_generate/";
  
        $loan_model = new LoanModel();
        $user_model = new UserModel();
        $promoter_model = new PromoterMetaModel();
        $community_model = new CommunityOrgModel();
        $project_model = new ProjectModel();
        $loan_model = new LoanModel();

        // find project id
        $this->data['loan_project_id'] = $loan_model->select('project_id')
            ->where("id", $loan_id)
            ->first();

        // find the project name
        $this->data['project'] = $project_model->select("project_name")
            ->where("id", $this->data['loan_project_id']['project_id'])
            ->first();

        // Find farmer community list
        $this->data['community_list'] = $community_model->select("id, organization_name")->findAll();

        // Find farmer list
        $loan_detail = $loan_model->select("*")
            ->where("id", $loan_id)
            ->first(); 

        if(isset($loan_detail['project_id']))
        {            
            $this->data['farmer_list'] = $user_model->select("user.id, user.fname, user.lname, user.pin")
                ->join('farmer_project', 'user.id = farmer_project.farmer_id', 'left')
                ->where('user.user_type', 2)
                ->where('farmer_project.project_id', $loan_detail['project_id'])
                ->where('farmer_project.deleted_at', null)
                ->findAll();
        }else{
            $this->data['farmer_list'] = array();
        }

        // Find the promoter list
        $this->data['promoter_list'] = $promoter_model->select("id, org_name")->findAll();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Apply header styles
        $headerStyle = $sheet->getStyle('A1:' . 'J3');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');
        $headerStyle->getAlignment()->setHorizontal('center');
        $headerStyle->getAlignment()->setWrapText(true);
        $sheet->getRowDimension('1')->setRowHeight(30);

        $column = 'G';
        $format = NumberFormat::FORMAT_NUMBER;
        $sheet->getStyle($column)->getNumberFormat()->setFormatCode($format);

        // Auto-size columns
        foreach (range('A3', 'J3') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // set table topic
        $sheet->setCellValue('A1', "Project: " . $this->data['project']['project_name'] . "\nSAPP Loan Disbursement Resource");
        $sheet->setCellValue('A2', "Farmer Organization Details");
        $sheet->setCellValue('D2', "Farmer Details");
        $sheet->setCellValue('I2', "Promoter Details");

        // Merge cells
        $sheet->mergeCells('A1:J1');
        $sheet->mergeCells('A2:B2');
        $sheet->mergeCells('D2:G2');
        $sheet->mergeCells('I2:J2');

        if (!empty($this->data['community_list'])) {
            // Create community table
            // Write headers for community table
            $headers = array_keys($this->data['community_list'][0]);
            $column = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($column . '3', $header);
                $column++;
            }

            // Load values to the community table
            $row = 4;
            foreach ($this->data['community_list'] as $result) {
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

        if (!empty($this->data['promoter_list'])) {
            // Create promoter table
            // Write headers for promoter table
            $headers = array_keys($this->data['promoter_list'][0]);
            $column = 'I';
            foreach ($headers as $header) {
                $sheet->setCellValue($column . '3', $header);
                $column++;
            }

            // Load values to the promoter table
            $row = 4;
            foreach ($this->data['promoter_list'] as $result) {
                $column = 'I';
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


    public function bulk_upload($loan_id= 0)
    {
        auth_rd();
        $this->data['active_module'] = "/loan_disbursement/bulk_upload/";
        $this->data['csrf'] = 1;

        $loan_disbursement_model = new LoanDisbursementModel();
        $loan_model = new LoanModel();
        $user_model = new UserModel();
        $promoter_model = new PromoterMetaModel();
        $community_model = new CommunityOrgModel();
        $project_model = new ProjectModel();
        $loan_model = new LoanModel();

        // find project id
        $this->data['loan_project_id'] = $loan_model->select('project_id')
            ->where("id", $loan_id)
            ->first();

        // find the project name
        $this->data['project'] = $project_model->select("project_name")
            ->where("id", $this->data['loan_project_id']['project_id'])
            ->first();

        // Find farmer community list
        $this->data['community_list'] = $community_model->select("id, organization_name")->findAll();

        // Find farmer list
        $loan_detail = $loan_model->select("*")
            ->where("id", $loan_id)
            ->first(); 

        if(isset($loan_detail['project_id']))
        {            
            $this->data['farmer_list'] = $user_model->select("user.id, user.fname, user.lname, user.pin")
                ->join('farmer_project', 'user.id = farmer_project.farmer_id', 'left')
                ->where('user.user_type', 2)
                ->where('farmer_project.project_id', $loan_detail['project_id'])
                ->findAll();
        }else{
            $this->data['farmer_list'] = array();
        }

        // Find the promoter list
        $this->data['promoter_list'] = $promoter_model->select("id, org_name")->findAll();

        // convert to single array
        $community_id_list = array_column($this->data['community_list'], 'id');
        $farmers_id_list = array_column($this->data['farmer_list'], 'id');
        $promoter_id_list = array_column($this->data['promoter_list'], 'id');


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
        
        // Get data from the excel sheet
        for ($row = 3; $row <= $highestRow; $row++) {

            // Empty Loan disbursement enntity type
            if ($worksheet->getCell('B' . $row)->getValue() == "") {
                $errorMsg = "Loan disbursement entity type cannot be empty.";
                $this->bulk_upload_error($loan_id, $row, $errorMsg);
            }
            
            // Empty Loan disbursement enntity id
            if ($worksheet->getCell('C' . $row)->getValue() == "") {
                $errorMsg = "Loan disbursement entity id cannot be empty.";
                $this->bulk_upload_error($loan_id, $row, $errorMsg);
            }
            
            // Loan disbursement entity 
            if(strtoupper($worksheet->getCell('B' . $row)->getValue())=="FO"){
                $entity = 1;
                $community_entity_id = $worksheet->getCell('C' . $row)->getValue();
                if(!in_array($community_entity_id, $community_id_list)){
                    $errorMsg = "Loan disbursement entity id is wrong.";
                    $this->bulk_upload_error($loan_id, $row, $errorMsg);
                }
            }elseif(strtoupper($worksheet->getCell('B' . $row)->getValue())=="F"){
                $entity = 2;
                $farmer_entity_id = $worksheet->getCell('C' . $row)->getValue();
                if(!in_array($farmer_entity_id, $farmers_id_list)){
                    $errorMsg = "Loan disbursement entity id is wrong.";
                    $this->bulk_upload_error($loan_id, $row, $errorMsg);
                }
            }elseif(strtoupper($worksheet->getCell('B' . $row)->getValue())=="P"){
                $entity = 3;
                $promoter_entity_id = $worksheet->getCell('C' . $row)->getValue();
                if(!in_array($promoter_entity_id, $promoter_id_list)){
                    $errorMsg = "Loan disbursement entity id is wrong.";
                    $this->bulk_upload_error($loan_id, $row, $errorMsg);
                }
            }else{
                $errorMsg = "Wrong loan disbursement entity type.";
                $this->bulk_upload_error($loan_id, $row, $errorMsg);
            }

            // Empty CBSL reg no
            if ($worksheet->getCell('D' . $row)->getValue() == "") {
                $errorMsg = "CBSL registration number cannot be empty. Please set value.";
                $this->bulk_upload_error($loan_id, $row, $errorMsg);
            }

            // Empty Estimated amount
            if ($worksheet->getCell('E' . $row)->getValue() == "") {
                $errorMsg = "Estimated amount cannot be empty. Please set value or '0'.";
                $this->bulk_upload_error($loan_id, $row, $errorMsg);
            }

            // Empty Recommended amount
            if ($worksheet->getCell('F' . $row)->getValue() == "") {
                $errorMsg = "Recommended amount cannot be empty. Please set value or '0'.";
                $this->bulk_upload_error($loan_id, $row, $errorMsg);
            }

            // Empty Disbursed amount
            if ($worksheet->getCell('G' . $row)->getValue() == "") {
                $dis_amount = 0.00;
            } else {
                $dis_amount = $worksheet->getCell('G' . $row)->getValue();
            }

            // Empty Loan disbursement status
            if ($worksheet->getCell('H' . $row)->getValue() == "") {
                $errorMsg = "Loan disbursement status cannot be empty.";
                $this->bulk_upload_error($loan_id, $row, $errorMsg);
            }

            // Loan disbursement status
            if(strtoupper($worksheet->getCell('H' . $row)->getValue())=="REG"){
                $status = 1;
            }elseif(strtoupper($worksheet->getCell('H' . $row)->getValue())=="PEND"){
                $status = 2;
            }elseif(strtoupper($worksheet->getCell('H' . $row)->getValue())=="DIS"){
                $status = 3;
            }elseif(strtoupper($worksheet->getCell('H' . $row)->getValue())=="REF"){
                $status = 4;
            }else{
                $errorMsg = "Wrong loan disbursement status.";
                $this->bulk_upload_error($loan_id, $row, $errorMsg);
            }

            // Founded Wrong row
            if(!empty($wrongData)){
                $row_numbers = '';
                foreach($wrongData as $key=>$val){
                    $row_numbers  = $row_numbers . $val . ', ';
                };
                cano_set_alert("danger", "The bulk upload is unsuccessful. A data row is wrong. But the above rows were successful. Please correct the row and try again. Wrong row number:- ". rtrim($row_numbers, ", ") );
                header("Location:" . base_url("/loan_disbursement/list_all/" . $loan_id . "/")); 
                die;
            }

            // Set date format
            if($worksheet->getCell('K' . $row)->getFormattedValue() !== ''){
                $cellValue = $worksheet->getCell('K' . $row)->getFormattedValue();

                if (strtotime($cellValue) !== false) {
                    // Valid date
                    $date = new DateTime($cellValue);
                    $load_dis_date = $date->format('Y-m-d');
                } else {
                    // Invalid date
                    $errorMsg = "Wrong loan disbursement date.";
                    $this->bulk_upload_error($loan_id, $row, $errorMsg);
                }
            
            }else{
                $load_dis_date = null;
            }

            // Set date format
            if($worksheet->getCell('I' . $row)->getFormattedValue() !== ''){
                $cellValue = $worksheet->getCell('I' . $row)->getFormattedValue();

                if (strtotime($cellValue) !== false) {
                    // Valid date
                    $date = new DateTime($cellValue);
                    $refinanceDate = $date->format('Y-m-d');
                } else {
                    // Invalid date
                    $errorMsg = "Wrong refinance date.";
                    $this->bulk_upload_error($loan_id, $row, $errorMsg);
                }

            }else{
                $refinanceDate = null;
            }

            $this->data['record']=[
                'loan_id' => $loan_id,
                'loan_disbursement_entity' => $entity,
                'cbsl_reg_no' => $worksheet->getCell('D' . $row)->getValue(),
                'cbsl_reg_amount' => $worksheet->getCell('E' . $row)->getValue(),
                'required_loan_amount' => $worksheet->getCell('F' . $row)->getValue(),
                'actual_loan_amount' => $dis_amount,
                'disbursement_status' => $status,
                'loan_disbursement_date' => $load_dis_date,
                'remarks' => $worksheet->getCell('L' . $row)->getValue(),
                'refinance_date' => $refinanceDate,
                'refinance_amount' => $worksheet->getCell('J' . $row)->getValue(),
            ];

            // Check entity already in the Database
            if($entity==1){
                $this->data['list'] = $loan_disbursement_model->select("*")
                    ->join('link_disbursement_community_org', 'loan_disbursement.id = link_disbursement_community_org.loan_disbursement_id', 'left')
                    ->where('loan_id', $loan_id)
                    ->where('link_disbursement_community_org.community_org_id', $community_entity_id)
                    ->findAll();
            } elseif($entity==2) {
                $this->data['list'] = $loan_disbursement_model->select("*")
                    ->join('link_disbursement_farmer', 'loan_disbursement.id = link_disbursement_farmer.loan_disbursement_id', 'left')
                    ->where('loan_id', $loan_id)
                    ->where('link_disbursement_farmer.user_id', $farmer_entity_id)
                    ->findAll();
            } elseif($entity==3) {
                
                $this->data['list'] = $loan_disbursement_model->select("*")
                    ->join('link_disbursement_promoter', 'loan_disbursement.id = link_disbursement_promoter.loan_disbursement_id', 'left')
                    ->where('loan_id', $loan_id)
                    ->where('link_disbursement_promoter.promoter_id', $promoter_entity_id)
                    ->findAll();
            }
                
            if(!empty($this->data['list'])){
                // If already exist data, track the row number in excel sheet
                array_push($allreadyInDB, $row);

                // Delete the already exist data
                $loan_disbursement_model->where('id', $this->data['list'][0]['loan_disbursement_id'])->delete();
                // need to delete from link table also.
                if($entity == 1){
                    $link_model = new LinkDisbursementCommunityOrgModel();
                    $link_model->where('loan_disbursement_id', $this->data['list'][0]['loan_disbursement_id'])->delete();
                }elseif($entity == 2){
                    $link_model = new LinkDisbursementFarmerModel();
                    $link_model->where('loan_disbursement_id', $this->data['list'][0]['loan_disbursement_id'])->delete();
                }elseif($entity == 3){
                    $link_model = new LinkDisbursementPromoterModel();
                    $link_model->where('loan_disbursement_id', $this->data['list'][0]['loan_disbursement_id'])->delete();
                }
                $link_model->purgeDeleted();

            }
                
            // Insert data to the DB
            $loan_disbursement_model->insert($this->data['record']);
            $this->data['id'] = $loan_disbursement_model->getInsertID();
                
            if($entity == 1){
                // Add data to the link_disbursement_community_org
                $link_model = new LinkDisbursementCommunityOrgModel();
                $this->data['link_details'] = [
                    'loan_disbursement_id' => $this->data['id'],
                    'community_org_id' => $community_entity_id,
                ];
                $link_model->where('loan_disbursement_id', $this->data['id'])->delete();
                $link_model->insert($this->data['link_details']);

            }elseif($entity == 2){
                // Add data to the link_disbursement_farmer
                $link_model = new LinkDisbursementFarmerModel();
                $this->data['link_details'] = [
                    'loan_disbursement_id' => $this->data['id'],
                    'user_id' => $farmer_entity_id,
                ];
                $link_model->where('loan_disbursement_id', $this->data['id'])->delete();
                $link_model->insert($this->data['link_details']);

            }elseif($entity == 3){
                // Add data to the link_disbursement_promoter
                $link_model = new LinkDisbursementPromoterModel();
                $this->data['link_details'] = [
                    'loan_disbursement_id' => $this->data['id'],
                    'promoter_id' => $promoter_entity_id,
                ];
                $link_model->where('loan_disbursement_id', $this->data['id'])->delete();
                $link_model->insert($this->data['link_details']);

            }else{
                array_push($wrongData, $row);
            }
        }
        
        if(empty($allreadyInDB)){
            // Not founded allready recorded data
            cano_set_alert("success", "Bulk upload is successful");
            header("Location:" . base_url("/loan_disbursement/list_all/" . $loan_id . "/")); 
            die;
        } else {
            // Founded allready recorded data
            $row_numbers = '';
            foreach($allreadyInDB as $key=>$val){
                $row_numbers  = $row_numbers . $val . ', ';
            };
            cano_set_alert("warning", "The bulk upload is successful. But some data rows were updated. Updated row numbers:- " . rtrim($row_numbers, ", ") );
            header("Location:" . base_url("/loan_disbursement/list_all/" . $loan_id . "/")); 
            die;
        }
    }
    
    private function bulk_upload_error($loan_id, $row, $message){
        cano_set_alert("danger", "The bulk upload is unsuccessful. A data row is wrong. But the above rows were successful. Please correct the row and try again. Wrong row numbers:- ". rtrim($row, ", "). ". ERROR:- ". $message );
        header("Location:" . base_url("/loan_disbursement/list_all/" . $loan_id . "/")); 
        die;
    }

}
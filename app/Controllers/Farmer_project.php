<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Models\GrandItemModel;
use App\Models\FarmerProjectModel;
use App\Models\ProjectTargetModel;
use App\Models\LoanDisbursementModel;
use App\Models\GrandDisbursementModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\LinkDisbursementFarmerModel;

class Farmer_project extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['eligible_status'] = json_decode(get_config(57),TRUE);
        $this->data['obtained_benifit'] = json_decode(get_config(58),TRUE);
        $this->data['project_status'] = json_decode(get_config(19),TRUE);

        $this->data['entity_model'] = new FarmerProjectModel();
        $this->data['entity_model_1'] = new UserModel();  
        $this->data['entity_model_2'] = new ProjectModel();  
        $this->data['entity_model_3'] = new ProjectTargetModel();  
                
        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/farmer_project/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;

        // $this->data['list_all'] = $this->data['entity_model']->select("farmer_project.*,user.fname,user.lname,user.pin")
        //                     ->join('user', 'user.id = farmer_project.farmer_id', 'left')
        //                     ->join('project', 'project.id = farmer_project.project_id', 'left')
        //                     ->where($this->get_filter())
        //                     ->findAll();

        // Pagination setup
        $pager = service('pager');
        $perPage = 3000;  // Set the number of records per page
        $page = (int) ($this->request->getGet('page') ?? 1);  // Current page, default to 1
        $offset = ($page - 1) * $perPage;  // Calculate the offset for the current page

        $this->data['list_all'] = $this->data['entity_model']
            ->select("farmer_project.*,user.fname,user.lname,user.pin")
            ->join('user', 'user.id = farmer_project.farmer_id', 'left')
            ->join('project', 'project.id = farmer_project.project_id', 'left')
            ->where($this->get_filter())
            ->paginate($perPage, 'default', $page);  // Fetch paginated records


        // Get the total number of records (for pagination calculations)
        $total = $this->data['entity_model']
            ->select("farmer_project.*, user.fname, user.lname, user.pin")
            ->join('user', 'user.id = farmer_project.farmer_id', 'left')
            ->join('project', 'project.id = farmer_project.project_id', 'left')
            ->where($this->get_filter())
            ->countAllResults(false);  // Fetch the total number of records

        // Calculate start, end, and total entries
        $start = $offset + 1;  // First entry on the current page
        $end = min($start + $perPage - 1, $total);  // Last entry on the current page

        // Get the pagination links
        $this->data['pager_links'] = $pager->makeLinks($page, $perPage, $total);

        // Pass the calculated values to the view
        $this->data['start'] = $start;
        $this->data['end'] = $end;
        $this->data['total'] = $total;
        
        return view('farmer_project/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/farmer_project/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("project_id", $entity_id)
                            ->where("farmer_id", $id)
                            ->first();  

        // $this->data['farmer_list'] = $this->data['entity_model_1']->select("user.*")
        // $this->data['farmer_list'] = $this->data['entity_model_1']->select("user.id,user.fname,user.lname,user.pin")
        //                     ->where("user_type",2)
                            // ->findAll(10000,0);
                            // ->findAll(5,0);

        $this->data['eligible_status'] = $this->data['entity_model_3']->select("*")
                            ->where("project_id",$entity_id)
                            ->findAll(10000,0);
        
        $this->process_form_add_edit($entity_id,$id);   
        
        if($id != 0) {
            $farmer = $this->data['entity_model_1']->select("user.fname,user.lname,user.pin")
                ->where("user.id",$this->data['record']['farmer_id'])
                ->first();

            $this->data['record']['farmer_name'] = $farmer['fname'].' '.$farmer['lname'].' '.$farmer['pin'];
        }

        
        return view('farmer_project/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());

            $this->data['details'] = [
                'farmer_id' => $this->request->getVar('farmer_id'),
                'farmer_name' => $this->request->getVar('farmer_name'),
                'project_id' => $entity_id,
                'purpose' => $this->request->getVar('purpose'),
                'contribution' => $this->request->getVar('contribution'),
                'eligible_status' => $this->request->getVar('eligible_status'),
                'pfi_ref_no' => $this->request->getVar('pfi_ref_no'),
            ];

            $projectTargetData = $this->data['entity_model_3']->select('*')
                ->where('id', $this->data['details']['eligible_status'])
                ->where('project_id', $this->data['details']['project_id'])
                ->first();
            
            $farmersCount = $this->data['entity_model']->select('*')
                ->where('project_id', $this->data['details']['project_id'])
                ->where('eligible_status', $this->data['details']['eligible_status'])
                ->where('deleted_at', NULL)
                ->countAllResults();

            if($id == 0){
                // farmer already exist in the project
                $alreadyExists = $this->data['entity_model']->select('*')
                    ->where('project_id', $this->data['details']['project_id'])
                    ->where('farmer_id', $this->data['details']['farmer_id'])
                    // ->where('eligible_status', $this->data['details']['eligible_status'])
                    ->where('deleted_at', NULL)
                    ->countAllResults();
    
                if($alreadyExists > 0)
                {
                    $validation->setError('farmer_id', "The Farmer already assigned to a category in this project.");
                }
            }

            if(isset($projectTargetData['no_of_farmers'])){
                if($farmersCount >= $projectTargetData['no_of_farmers'] && $id == 0)
                {
                    // echo 'exceed';
                    $validation->setError('farmer_id', "The maximum number of farmers has been exceeded. You cannot assign a new farmer to this project.");
                }
            }
            
            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['project_id']))
                {
                    $this->data['entity_model']->insert($this->data['details']);
                    $this->data['id'] = $this->data['entity_model']->getInsertID();
                }
                else
                {
                    $this->data['entity_model']->where('project_id', $entity_id)->where('farmer_id', $id)->delete();
                    $this->data['entity_model']->insert($this->data['details']);
                }
                
                header("Location:" . base_url("/farmer_project/list_all/" . $entity_id . "/" . $id . "/")); 
                die;

                $this->data['record'] = $this->data['entity_model']->find($id);
            }
            else
            {
                $this->data['record'] = $_POST;
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_entity_add_edit()
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'farmer_id' => [
                'label'  => 'Farmer',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'eligible_status' => [
                'label'  => 'Category',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($entity_id=0,$id=0)
    {
        $grant_dis_model = new GrandDisbursementModel();
        $grant_item_model = new GrandItemModel();
        $loan_dis_model = new LoanDisbursementModel();
        $link_loan_dis_model = new LinkDisbursementFarmerModel();

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

        $this->data['entity_model']->where('project_id', $entity_id)->where('farmer_id', $id)->delete();
        header("Location:" . base_url("/farmer_project/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = "farmer_project.created_at IS NOT NULL AND farmer_project.project_id =" . $this->data['entity_id'];

        $field_name = "fname";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND user." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "lname";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND user." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "obtained_benifit";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND farmer_project." . $field_name . "= " .$_GET[$field_name]."";
        }

        return $where;
    }

    public function get_farmer_state($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/farmer_project/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->join('project', 'project.id = farmer_project.project_id', 'left')
                            ->where("project_id", $entity_id)
                            ->where("farmer_id", $id)
                            ->first();  

        if(!isset($this->data['record']['farmer_id']))
        {
            $this->data['record'] = $this->data['entity_model']->select("*")
                                ->join('project', 'project.id = farmer_project.project_id', 'left')
                                ->where("farmer_id", $id)
                                ->first();  
        }

        echo json_encode($this->data['record']);
    }

    public function generate_template($projectId)
    {
        auth_rd();
        $this->data['csrf'] = 1;

        $projectModel = new ProjectModel();
        $projectDetails = $projectModel->select('*')
            ->where('id', $projectId)
            ->first();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Apply header styles
        $headerStyle = $sheet->getStyle('A1:' . 'E2');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');
        $headerStyle->getAlignment()->setHorizontal('center');
        $headerStyle->getAlignment()->setWrapText(true);
        $sheet->getRowDimension('1')->setRowHeight(30);

        // Merge cells
        $sheet->mergeCells('A1:E1');

        // set table topic
        $sheet->setCellValue('A1', "Project: " . $projectDetails['project_name'] . "\nFarmer Project Details");

        // Set table Header
        $sheet->setCellValue('A2', "Farmer ID *");
        $sheet->setCellValue('B2', "Category ID *");
        $sheet->setCellValue('C2', "Contribution");
        $sheet->setCellValue('D2', "Purpose");
        $sheet->setCellValue('E2', "PFI ref No");

        // Auto-size columns
        foreach (range('A', 'E') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create a writer object and save the Excel file
        $writer = new Xlsx($spreadsheet);
        $basePath = config("App")->basePath;
        $filename = $basePath . 'public/resource/upload/'. $projectDetails['project_name'].'-Farmer_project.xlsx';
        // $filename = '../public/'. $projectDetails['project_name'] .'-Farmer_project.xlsx';
        $writer->save($filename);

        // Set appropriate headers for file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($filename);
        exit;

    }

    public function resource_generate($projectId)
    {
        auth_rd();
        // $this->data['active_module'] = "/grant/resource_generate/";

        $user_model = new UserModel();
        $project_target_model = new ProjectTargetModel();
        $project_model = new ProjectModel();
        $farmer_project_model = new FarmerProjectModel();

        // Get Project Details
        $projectDetails = $project_model->select('*')
            ->where('id', $projectId)
            ->first();

        $assignedFarmerIds = $farmer_project_model->select('farmer_id')
            // ->where('project_id', $projectId) // Assuming 'project_id' field exists
            ->findColumn('farmer_id');
            
        $filteredFarmerData = $user_model->select('id, pin, fname, lname')
            ->where('user_type', 2)
            ->whereNotIn('id', $assignedFarmerIds)  // Directly filter out assigned farmers
            ->findAll();

        // Get Category details
        $categoryData = $project_target_model->select('id, category_name')
            ->where('project_id', $projectId)
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
        $sheet->setCellValue('A1', "Project: " . $projectDetails['project_name'] . "\nResources for the Farmer Project Details Sheet");
        $sheet->setCellValue('A2', "Farmer Details");
        $sheet->setCellValue('F2', "Category Details");

        // Merge cells
        $sheet->mergeCells('A1:G1');
        $sheet->mergeCells('A2:D2');
        $sheet->mergeCells('F2:G2');

        if (!empty($filteredFarmerData)) {
            // Create farmer category table
            // Write headers for farmer category table
            // $headers = array_keys($filteredfarmerData[0]);
            $headers = array("Farmer ID", "NIC", "First Name", "Last Name");
            $column = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($column . '3', $header);
                $column++;
            }

            // Load values to the farmer category table
            $row = 4;
            foreach ($filteredFarmerData as $singleFarmerData) {
                $column = 'A';
                foreach ($singleFarmerData as $value) {
                    $sheet->setCellValue($column . $row, $value);
                    $column++;
                }
                $row++;
            }
        }

        if (!empty($categoryData)) {
            // Create farmer table
            // Write headers for farmer table
            // $headers = array_keys($categoryData[0]);
            $headers = array("Category ID", "Category Name");
            $column = 'F';
            foreach ($headers as $header) {
                $sheet->setCellValue($column . '3', $header);
                $column++;
            }

            // Load values to the farmer table
            $row = 4;
            foreach ($categoryData as $singleCategoryData) {
                $column = 'F';
                foreach ($singleCategoryData as $value) {
                    $sheet->setCellValue($column . $row, $value);
                    $column++;
                }
                $row++;
            }
        }

        // Create a writer object and save the Excel file
        $writer = new Xlsx($spreadsheet);
        $basePath = config("App")->basePath;
        $filename = $basePath . 'public/resource/upload/'.$projectDetails['project_name'].'-Farmer_project_Resources.xlsx';
        // $filename = '../public/'. $projectDetails['project_name'] .'-Farmer_project_Resources.xlsx';
        $writer->save($filename);

        // Set appropriate headers for file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($filename);
        exit;

    }

    public function bulk_upload($projectId)
    {
        auth_rd();
        // $this->data['active_module'] = "/grant_disbursement/bulk_upload/";
        $this->data['csrf'] = 1;

        $user_model = new UserModel();
        $project_target_model = new ProjectTargetModel();
        $project_model = new ProjectModel();
        $farmer_project_model = new FarmerProjectModel();

        // Get Project Details
        $projectDetails = $project_model->select('*')
            ->where('id', $projectId)
            ->first();

        // Get farmer details
        $farmerData =  $user_model->select('id, pin, fname, lname')
            ->where('user_type', 2)
            ->findAll();

        // Get Category details
        $categoryData = $project_target_model->select('*')
            ->where('project_id', $projectId)
            ->findAll();
        
        // Get farmer project list match with project id
        $farmerProjectList = $farmer_project_model->select('*')
            ->where('project_id', $projectId)
            ->findAll();

        // convert to single array
        $farmers_id_list = array_column($farmerData, 'id');
        $category_id_list = array_column($categoryData, 'id');

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
        // $wrongData = array();
        $errorMsg = '';

        // no of farmer validate
        $allCategoryIds = array();
        $allFarmerIds = array();
        for ($row = 3; $row <= $highestRow; $row++) {
            $farmerId = $worksheet->getCell('A' . $row)->getValue();
            $categoryId = $worksheet->getCell('B' . $row)->getValue();
            array_push($allFarmerIds, $farmerId);
            array_push($allCategoryIds, $categoryId);
        }

        $categoryCountedArray = $this->no_of_farmer_validate($allCategoryIds);

        // exist no ot farmer count
        foreach ($categoryData as $singleCategoryData) {
            if(array_key_exists($singleCategoryData['id'], $categoryCountedArray)){
                if($categoryCountedArray[$singleCategoryData['id']] > $singleCategoryData['no_of_farmers']){
                    // Set error message
                    // $this->farmer_count_exist_error_message($projectId, $singleCategoryData['id'], $singleCategoryData['no_of_farmers']);
                    $errorMsg = "The bulk upload is unsuccessful. Number of farmer count exist. Category ID :- ". rtrim($singleCategoryData['id'], ", "). ". Maximum number of farmers count:- ". $singleCategoryData['no_of_farmers'];
                    $this->common_error_message($projectId, $errorMsg);
                }
            }
        }
        // pre(in_array('', $allFarmerIds));

        // Find if there have empty farmer ID
        if(in_array('', $allFarmerIds)){
            $errorMsg = "Farmer ID is empty in uploaded file. Please check again.";
            $this->common_error_message($projectId, $errorMsg);
        }

        // find if sheet have duplicate farmer id
        $duplicateResult = $this->is_duplicated($allFarmerIds);

        if(isset($duplicateResult) && count($duplicateResult) > 0){
            $errorMsg = "The bulk upload is unsuccessful. Farmer id duplicated. Please recheck the file. Duplicated IDs:- ". implode(", ", $duplicateResult); 
            $this->common_error_message($projectId, $errorMsg);
        }

        // Process each row and store the data in the database
        for ($row = 3; $row <= $highestRow; $row++) { // Assuming the first row contains headers
            
            // Get the value in the current cell
            $farmerId = $worksheet->getCell('A' . $row)->getValue();
            $categoryId = $worksheet->getCell('B' . $row)->getValue();
            $contribution = $worksheet->getCell('C' . $row)->getValue();
            $purpose = $worksheet->getCell('D' . $row)->getValue();
            $pfiRefNo = $worksheet->getCell('E' . $row)->getValue();
            
            // Farmer ID validation
            if(empty($farmerId) || !in_array($farmerId, $farmers_id_list)){
                $errorMsg = "Farmer ID is empty or not match with the resource file data.";
                $this->bulk_upload_error($projectId, $row, $errorMsg);
            }

            // Category ID validation
            if(empty($categoryId) || !in_array($categoryId, $category_id_list)){
                $errorMsg = "Category ID is empty or not match with the resource file data.";
                $this->bulk_upload_error($projectId, $row, $errorMsg);
            }
            
            // Set Data
            $this->data['details']=[
                'farmer_id' => $farmerId,
                'project_id' => $projectId,
                'contribution' => $contribution,
                'purpose' => $purpose,
                'eligible_status' => $categoryId,
                'pfi_ref_no' => $pfiRefNo
            ];
            
            // farmer validate already existing the DB
            // foreach($farmerProjectList as $farmerProject){
            //     if($farmerProject['farmer_id'] == $farmerId && $farmerProject['eligible_status'] == $categoryId){
            //         $errorMsg = "This farmer already assign to this project under this category. Please remove this row.";
            //         $this->bulk_upload_error($projectId, $row, $errorMsg);
            //     }
            // }


            // Start the transaction
            $this->data["db"]->transBegin();
            try{
                // Delete the existing data
                if (isset($farmerProjectList) && is_array($farmerProjectList)) {
                    foreach ($farmerProjectList as $farmerProject) {
                        if($farmerProject['farmer_id'] == $farmerId && $farmerProject['project_id'] == $projectId){
                            array_push($allreadyInDB, $row); // updatetd row list
                            // soft delete the data
                            $farmer_project_model
                                ->where('farmer_id', $farmerId)
                                ->where('project_id', $projectId)
                                // ->where('eligible_status', $categoryId)
                                ->delete();
                        }
                    }
                }
                
                // Save data in grant disbursement table
                $farmer_project_model->insert($this->data['details']);

                // Commit the transaction
                $this->data["db"]->transCommit();

            } catch(\Exception $e){
                // Rollback the transaction on error
                $this->data["db"]->transRollback();
                $errorMsg = $e->getMessage();
                $this->bulk_upload_error($projectId, $row, $errorMsg);
            }
            
        }

        if(empty($allreadyInDB)){
            // Not founded allready recorded data
            cano_set_alert("success", "Bulk upload is successful");
            header("Location:" . base_url("/farmer_project/list_all/" . $projectId . "/")); 
            die;
        } else {
            // Founded allready recorded data
            $row_numbers = '';
            foreach($allreadyInDB as $key=>$val){
                $row_numbers  = $row_numbers . $val . ', ';
            };
            cano_set_alert("warning", "The bulk upload is successful. But some data rows were updated. Updated row numbers:- " . rtrim($row_numbers, ", ") );
            header("Location:" . base_url("/farmer_project/list_all/" . $projectId . "/")); 
            die;
        }
    }

    private function bulk_upload_error($entity_id, $row, $message){
        cano_set_alert("danger", "The bulk upload is unsuccessful. A data row is wrong. But the above rows were successful. Please correct the row and try again. Wrong row numbers:- ". rtrim($row, ", "). ". ERROR:- ". $message );
        header("Location:" . base_url("/farmer_project/list_all/" . $entity_id)); 
        die;
    }
    
    private function common_error_message($entity_id, $message){
        cano_set_alert("danger", $message);
        header("Location:" . base_url("/farmer_project/list_all/" . $entity_id)); 
        die;
    }

    private function no_of_farmer_validate($originalArray){
        // Initialize an empty result array
        $resultArray = array();

        // Loop through the original array to count occurrences
        foreach ($originalArray as $value) {
            if (isset($resultArray[$value])) {
                // If the number already exists in the result array, increment the count
                $resultArray[$value]++;
            } else {
                // If the number doesn't exist, create a new entry with count 1
                $resultArray[$value] = 1;
            }
        }
        return $resultArray;
    }    

    private function is_duplicated($data){
        // Count the occurrences of each element in the array
        $elementCounts = array_count_values($data);

        // Find elements with a count greater than 1 (duplicates)
        $duplicates = array_filter($elementCounts, function ($count) {
            return $count > 1;
        });

        if (empty($duplicates)) {
            return array();
        } else {
            // echo "Duplicated data found:";
            $duplicatedId = array();
            foreach ($duplicates as $value => $count) {
                $duplicatedId[] = $value;
            }
            return $duplicatedId;
        }
    }

}
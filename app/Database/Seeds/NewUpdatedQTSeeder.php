<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed NewUpdatedQTSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NewUpdatedQTSeeder extends Seeder
{
    public function run()
    {
        $reportProjectWiseGrant = [
                'id'            => 78,
                'query_reference'     => 'Report Project wise Grant',
                'query_string'         => "SELECT
                project.project_name AS 'Project Name',
                project_target.category_name AS 'Category',
                project_target_item.item_description AS 'Item',
                FORMAT((SUM(grant_item.total_value)/SUM(grant_item.disbursed_qty)),2,2) AS 'Average Unit Price',
                FORMAT(SUM(grant_item.disbursed_qty),2,2) AS 'Disbursed QTY',
                FORMAT(SUM(grant_item.total_value),2,2) AS 'Value',
                FORMAT(SUM(grant_item.no_of_farmers),0,2) AS 'No of Farmer'
                FROM
                (SELECT 
                grant_disbursement.grant_id AS 'grant_id',
                grant_disbursement.farmer_category AS 'farmer_cat',
                grant_item_farmer.project_target_item_id AS 'item',
                grant_disbursement.disbursement_status,
                min(grant_item_farmer.price) AS 'unit_price',
                sum(grant_item_farmer.qty) AS 'disbursed_qty',
                sum(grant_item_farmer.price*grant_item_farmer.qty) AS 'total_value',
                count(DISTINCT grant_disbursement.farmer_id) AS 'no_of_farmers'
                FROM sapp_core.grant_item_farmer
                LEFT JOIN project_target_item ON grant_item_farmer.project_target_item_id = project_target_item.id
                LEFT JOIN grant_disbursement ON grant_disbursement.id = grant_item_farmer.grant_disbursement_id
                WHERE grant_disbursement.deleted_at IS NULL
                GROUP BY (grant_disbursement.id)) AS grant_item 
                LEFT JOIN sapp_core.grant ON sapp_core.grant.id = grant_item.grant_id
                LEFT JOIN project ON project.id	= sapp_core.grant.project_id
                LEFT JOIN project_target_item ON grant_item.item = project_target_item.id
                LEFT JOIN project_target ON project_target.id = grant_item.farmer_cat
                WHERE <CANO_FILTER> project.deleted_at IS NULL AND 
                sapp_core.grant.deleted_at IS NULL 
                GROUP BY (grant_item.item);"
        ];

        $this->db->table('query_template')->where('id', '78')->update($reportProjectWiseGrant);


        $reportInventory = [
            'id'            => 41,
            'query_reference'     => 'Report Inventory',
            'query_string'         => "SELECT
            fixed_asset_registry.sapp_serial_no AS 'Name of Asset',
            fixed_asset_registry.description AS 'Description',  
            fixed_asset_registry.manufactor_serial_no AS 'Serial No (Manufacture)', 
            fixed_asset_registry.asset_code AS 'Asset Code', 
            user.fname AS 'User First Name', 
            user.lname AS 'User Last Name', 
            CONCAT('attom:29:',staff_meta.assigned_admin_division) AS 'Division',
            user.mobile AS 'Mobile No', 
            fixed_asset_registry.price AS 'Price',
            fixed_asset_registry.folio_no AS 'Folio No',
            fixed_asset_registry.grn_no AS 'GRN No',
            fixed_asset_registry.disposal_date AS 'Disposal Date',
            fixed_asset_registry.supplier_name AS 'Supplier Name'
            FROM sapp_core.fixed_asset_registry LEFT JOIN 
            sapp_core.fixed_asset_owner ON fixed_asset_registry.id = fixed_asset_owner.fixed_asset_registry_id 
            LEFT JOIN user ON user.id = fixed_asset_owner.user_id 
            LEFT JOIN staff_meta ON staff_meta.user_id = user.id
            WHERE <CANO_FILTER> fixed_asset_registry.deleted_at IS NULL AND fixed_asset_owner.deleted_at IS NULL ;"
        ];

        $this->db->table('query_template')->where('id', '41')->update($reportInventory);
       
        $reportStaffProfile = [
            'id'            => 73,
            'query_reference'     => 'Report Staff Profile',
            'query_string'         => "SELECT 
            user.fname AS 'First Name', 
            user.lname AS 'Last Name', 
            CONCAT ('attom:29:',staff_meta.assigned_admin_division) AS 'Division', 
            user.pin AS 'NIC',
              staff_meta.appointment_date AS 'Appointment Date', 
            CONCAT ('attom:51:',user.gender) AS 'Gender', 	
            user.dob AS 'Date of Birth', 
              staff_meta.employee_no AS 'Employee No',
             staff_meta.employer_no AS 'Employer No', 
             CONCAT ('attom:97:',staff_meta.maritial_status) AS 'Maritial Status', 
            CONCAT ('attom:4:',staff_meta.recruitment_type) AS 'Recruitment Type',
            designation.designation AS 'Designation',
              staff_meta.permanant_address_no AS 'House No', 
            staff_meta.permanant_address_street AS 'Lane / Road',
            staff_meta.permanant_address_city AS 'City', 
            user.mobile AS 'Mobile (Personal)', 
            staff_meta.phone_office AS 'Phone (Office)',
              staff_meta.phone_extension AS 'Phone Ext', 
            CONCAT ('attom:5:',staff_meta.heighest_education_qualification) AS 'Heighest Educational Qualification',
             staff_meta.professional_membership AS 'Professional Membership', 
            staff_meta.salary_scale AS 'Salary Scale', staff_meta.basic_salary AS 'Basic Salary', 
             staff_meta.allowance AS 'Allowance',
             staff_meta.net_salary AS 'Net Salary',
            CONCAT ('attom:43:',staff_meta.employment_status) AS 'Employement Status', 	staff_meta.last_date_sapp AS 'Last date in SAPP' 
            FROM sapp_core.user
             LEFT JOIN staff_meta ON staff_meta.user_id = user.id
            LEFT JOIN designation ON designation.id = staff_meta.designation
            WHERE <CANO_FILTER> user.user_type =1 AND user.deleted_at IS NULL ;"
        ];

        $this->db->table('query_template')->where('id', '73')->update($reportStaffProfile);

        $reportLoanProject = [
          'id'            => 87,
          'query_reference'     => 'Report Laon Project',
          'query_string'         => "SELECT
          CONCAT ('attom:31:',loan.type_of_loan_scheme) AS 'Loan Type',
           SUM(loan_disbursement.actual_loan_amount) AS 'Total Loan',
           COUNT(loan_disbursement.loan_disbursement_entity) AS 'No of Farmer'
          FROM loan
           LEFT JOIN loan_disbursement ON loan_disbursement.loan_id = loan.id
           LEFT JOIN project ON project.id = loan.project_id
           WHERE <CANO_FILTER> loan.deleted_at is NULL AND loan_disbursement.deleted_at IS NULL
           GROUP BY (loan.type_of_loan_scheme);"
      ];

        $this->db->table('query_template')->where('id', '87')->update($reportLoanProject);



        $reportLoanDis = [
          'id'            => 10,
          'query_reference'     => 'Report Loan Disbursement',
          'query_string'         => "SELECT 
          farmer.barrower_type AS 'Barrower Type',
          user.fname AS 'First Name',
          user.lname AS 'Last Name',
          user.pin AS 'NIC',
          project.project_name AS 'Project Name',
          CONCAT('attom:51:',user.gender) AS 'Gender',
          concat(farmer.address_no, ' ', farmer.address_street, ' ', farmer.address_city) AS 'Address',
          user.mobile AS 'TP No',
          user.email AS 'Email',
          gnd.gnd AS 'GND',
          dsd.dsd AS 'DSD',
        aggrarian_division.name AS 'ASC',
          district.district AS 'District',
          province.province AS 'Province',
           farmer.heighest_education_qualification AS 'Education Level',
          loan.loan_scheme_name AS 'Loan Scheme Name',
          bank_details.acc_no AS 'Acc No',
          banks.bank AS 'Bank',
          bank_details.branch_code AS 'Branch Code',
          bank_details.branch AS 'Branch',
           CONCAT('attom:18:',project.project_type) AS 'Project Type',
          loan.main_purpose AS 'Main Purpose',
          loan.sub_purpose AS 'Sub Purpose',
            loan_disbursement.cbsl_reg_amount AS 'Estimated Amount',
          loan_disbursement.required_loan_amount AS 'Recomended Amount',
          farmer_project.pfi_ref_no AS 'PFI Ref',
           loan_disbursement.cbsl_reg_no AS 'Loan No',
          loan_disbursement.actual_loan_amount AS 'Disbursed Amount',
          loan_disbursement.loan_disbursement_date AS 'Disbursed Date',
           loan_disbursement.remarks AS 'Disbursement Remarks'
           from loan_disbursement
          LEFT JOIN loan ON loan.id = loan_disbursement.loan_id
          LEFT JOIN link_disbursement_farmer ON link_disbursement_farmer.loan_disbursement_id = loan_disbursement.id
          LEFT JOIN user ON link_disbursement_farmer.user_id = user.id
          LEFT JOIN farmer ON farmer.user_id = user.id
          LEFT JOIN project ON project.id = loan.project_id
          LEFT JOIN gnd ON farmer.gnd_id = gnd.id
          LEFT JOIN dsd ON dsd.id = gnd.dsd_id
          LEFT JOIN district ON district.id = dsd.district_id
          LEFT JOIN province ON province.id = district.province_id
          LEFT JOIN aggrarian_division ON aggrarian_division.id = farmer.aggrarian_division_id
          LEFT JOIN link_user_bank ON user.id = link_user_bank.user_id
          LEFT JOIN bank_details ON link_user_bank.bank_details_id = bank_details.id
          LEFT JOIN banks ON banks.id = bank_details.bank_id
          LEFT JOIN farmer_project ON farmer_project.farmer_id = user.id
          where <CANO_FILTER>  
           project.id = farmer_project.project_id AND 
           loan_disbursement.deleted_at IS NULL AND 
           farmer_project.deleted_at IS NULL AND
           user.deleted_at IS NULL AND
           loan.deleted_at IS NULL AND
           farmer.deleted_at IS NULL AND
           project.deleted_at IS NULL AND
           gnd.deleted_at IS NULL AND
           dsd.deleted_at IS NULL AND
           district.deleted_at IS NULL AND
           province.deleted_at IS NULL AND
           aggrarian_division.deleted_at IS NULL AND
           bank_details.deleted_at IS NULL AND
           banks.deleted_at IS NULL AND
           link_user_bank.deleted_at IS NULL AND
           link_disbursement_farmer.deleted_at IS NULL AND
           farmer_project.deleted_at IS NULL;"
        ];

        $this->db->table('query_template')->where('id', '10')->update($reportLoanDis);


        $reportLoanType = [
          'id'            => 75,
          'query_reference'     => 'Report Loan Type',
          'query_string'         => "SELECT project.project_name AS 'Project Name',
          CONCAT('attom:31:',loan.type_of_loan_scheme) AS 'Type of Loan',
          sum(ld.sum_loan) AS 'Total Loan',
          count(ld.count_farmer) AS 'No of Farmer'
          FROM
          (SELECT loan_disbursement.loan_id,
           loan_disbursement.actual_loan_amount as sum_loan, 
           loan_disbursement.loan_disbursement_entity as count_farmer,
           loan_disbursement.loan_disbursement_date,
           loan_disbursement.disbursement_status
           FROM loan_disbursement 
           where loan_disbursement.deleted_at is null) AS ld
           LEFT JOIN loan ON ld.loan_id = loan.id
           LEFT JOIN project ON project.id = loan.project_id
           WHERE <CANO_FILTER> loan.deleted_at is NULL
           group by project.project_name, loan.type_of_loan_scheme"
        ];

        $this->db->table('query_template')->where('id', '75')->update($reportLoanType);

        $reportFrantDisProject = [
          'id'            => 84,
          'query_reference'     => 'Report Grant Dis - Project',
          'query_string'         => "SELECT 
          a.item AS 'Item', 
          a.project AS 'Project', 
          FORMAT(a.sum_qty,0,0) AS 'Total Qty', 
          FORMAT(a.sum_price,2,0) AS 'Total Value'
          FROM
          (select project_target_item.item_description AS item,
          project.project_name AS project,
          sum(grant_item_farmer.qty) as sum_qty,
          sum(grant_item_farmer.price*grant_item_farmer.qty) as sum_price
          FROM grant_item_farmer
          LEft join grant_disbursement ON grant_disbursement.id = grant_item_farmer.grant_disbursement_id
          left join sapp_core.grant on sapp_core.grant.id =grant_disbursement.grant_id
          left join project_target_item on project_target_item.id =grant_item_farmer.project_target_item_id
          left join project ON project.id = sapp_core.grant.project_id
          where  <CANO_FILTER>  
          grant_item_farmer.deleted_at is null AND 
          project_target_item.deleted_at IS NULL AND 
          grant.deleted_at IS NULL AND 
          project.deleted_at IS NULL
          group by project_target_item.item_description
          order by project_target_item.item_description) AS a;"
        ];

        $this->db->table('query_template')->where('id', '84')->update($reportFrantDisProject);

        $projectStatus = [
          'id'            => 30,
          'query_reference'     => 'project status',
          'query_string'         => "SELECT 
          project_status AS label, 
          COUNT(1) AS value 
          from project 
          WHERE deleted_at IS NULL AND
          project_type IN (1,2,3,4)
          GROUP BY project_status;"
        ];

        $this->db->table('query_template')->where('id', '30')->update($projectStatus);

        $projectGrantProgressUp = [
          'id'            => 104,
          'query_reference'     => 'Project dashboard grant progres up',
          'query_string'         => "SELECT 
          COUNT(DISTINCT grant_disbursement.farmer_id) AS 'value'
          FROM grant_disbursement
          LEFT JOIN sapp_core.grant ON grant_disbursement.grant_id = sapp_core.grant.id
          LEFT JOIN project AS p ON sapp_core.grant.project_id = p.id 
          WHERE <CANO_FILTER> grant_disbursement.disbursement_status = 3 AND 
          grant_disbursement.deleted_at IS NULL AND
          sapp_core.grant.deleted_at IS NULL AND
          p.deleted_at IS NULL;"
        ];

        // $this->db->table('query_template')->where('id', '104')->insert($projectGrantProgressUp);


        $dashboardRuralFinanceGrant = [
          'id'            => 105,
          'query_reference'     => 'Ddashboard Rural finance progress grant',
          'query_string'         => "SELECT 
          FORMAT(sum(grant_item_farmer.price)/1000000,4,0) AS y1, 
          DATE_FORMAT(grant_disbursement.date_of_grant, '%Y-%M') AS x
          FROM grant_disbursement
          LEFT JOIN grant_item_farmer ON grant_item_farmer.grant_disbursement_id=grant_disbursement.id
          WHERE grant_disbursement.deleted_at IS NULL AND 
          grant_item_farmer.deleted_at IS NULL AND
          grant_disbursement.disbursement_status = 3 
          GROUP by DATE_FORMAT(grant_disbursement.date_of_grant, '%Y-%M');"
        ];

        // $this->db->table('query_template')->where('id', '105')->insert($dashboardRuralFinanceGrant);


        $projectDashboardProjectDetails = [
          'id'            => 90,
          'query_reference'     => 'Project Dashboard Project Details',
          'query_string' => "SELECT 
          p.project_name AS 'Project Name',  
          CONCAT ('attom:19:',p.project_status) AS 'Project Status',  
          CONCAT ('attom:18:',project_type) AS 'Project Type', p.start_date AS 'Project Start Date',
          p.end_date AS 'Project End Date', p_extention.no_of_extentions AS 'No of Extentions', 
          p_extention.extend_date AS 'Extended Completion Date' 
          from project AS p  
          LEFT JOIN (SELECT project_extension.project_id, COUNT(project_extension.id) AS no_of_extentions, max(project_extension.extentend_completion_date) AS extend_date FROM project_extension WHERE project_extension.deleted_at IS NULL GROUP BY project_extension.project_id) AS p_extention ON p_extention.project_id = p.id 
          where <CANO_FILTER> p.deleted_at IS NULL LIMIT 1"
        ];

        $this->db->table('query_template')->where('id', '90')->update($projectDashboardProjectDetails);

        // $statusOfGrantDis = [
        //   'id'            => 33,
        //   'query_reference'     => 'Status of Grant Disbursement',
        //   'query_string' => "SELECT 
        //   count(grant_disbursement.id) AS value, 
        //   grant_disbursement.disbursement_status AS label 
        //   FROM grant_disbursement 
        //   WHERE grant_disbursement.deleted_at IS NULL 
        //   group by grant_disbursement.disbursement_status;"
        // ];

        $statusOfGrantDis = [
          'id'            => 33,
          'query_reference'     => 'Status of Grant Disbursement',
          'query_string' => "SELECT
          count(DISTINCT grant_disbursement.farmer_id) AS value, 
          grant_disbursement.disbursement_status AS label 
          FROM grant_disbursement 
          WHERE grant_disbursement.deleted_at IS NULL
          group by grant_disbursement.disbursement_status;"
        ];

        $this->db->table('query_template')->where('id', '33')->update($statusOfGrantDis);

        // $statusOfLoanDis = [
        //   'id'            => 44,
        //   'query_reference'     => 'Dashboard status of loan disbursment',
        //   'query_string' => "SELECT 
        //   count(loan_disbursement.id) AS value, 
        //   loan_disbursement.disbursement_status AS label  
        //   FROM loan_disbursement 
        //   JOIN loan on loan_disbursement.loan_id = loan.id
        //   WHERE loan_disbursement.deleted_at IS NULL AND
        //   loan.deleted_at IS NULL
        //   group by loan_disbursement.disbursement_status;"
        // ];

        $statusOfLoanDis = [
          'id'            => 44,
          'query_reference'     => 'Dashboard status of loan disbursment',
          'query_string' => "SELECT 
          count(DISTINCT link_disbursement_farmer.user_id) AS value, 
          loan_disbursement.disbursement_status AS label  
          FROM loan_disbursement 
          JOIN loan on loan_disbursement.loan_id = loan.id
          LEFT JOIN link_disbursement_farmer on link_disbursement_farmer.loan_disbursement_id=loan_disbursement.id
          WHERE loan_disbursement.deleted_at IS NULL AND
          loan.deleted_at IS NULL
          group by loan_disbursement.disbursement_status;"
        ];
        
        $this->db->table('query_template')->where('id', '44')->update($statusOfLoanDis);
        
        $report4pProject = [
          'id'            => 38,
          'query_reference'     => 'Report List of 4P Projects',
          'query_string' => "SELECT project.project_name AS 'Project Name', 
          CONCAT ('attom:18:',project.project_type) AS 'Project Type',
          CONCAT (project.address_no, ' ', project.address_street, ' ', project.address_city) AS 'Address' ,
           promoter.org_name AS 'Promoter Name',
           concat(user.fname,  user.lname) AS 'Promoter Focal Point', 
           user.mobile AS 'Mobile No', 
           user.email AS 'Email' ,
           CONCAT ('attom:19:',project.project_status) AS 'Project Status',
           project.start_date AS 'Start Date',
           project.end_date AS 'End Date'
           FROM sapp_core.project JOIN user ON project.project_incharge_id = user.id 
           LEFT JOIN promoter ON promoter.auth_officer_id = project.project_incharge_id
           LEFT JOIN (SELECT 
           project.id,
           gnd.gnd,
           dsd.dsd,
           district.district
           FROM project
           LEFT JOIN link_project_gnd ON link_project_gnd.project_id = project.id 
           LEFT JOIN gnd on gnd.id = link_project_gnd.gnd_id
           LEFT JOIN dsd on dsd.id = gnd.dsd_id
           LEFT JOIN district ON district.id = dsd.district_id
           WHERE project.deleted_at IS NULL AND link_project_gnd.deleted_at IS NULL) AS gnd_dsd_district ON project.id = gnd_dsd_district.id
          WHERE <CANO_FILTER> project.project_type IN (1,2,3,4) and project.deleted_at IS NULL 
          group by project.project_name;"
        ];

        $this->db->table('query_template')->where('id', '38')->update($report4pProject);

        $dashboardTraining = [
          'id'            => 95,
          'query_reference'     => 'Project Dashboard Training Table',
          'query_string' => "SELECT 
          training_name AS 'Training Name', 
          training.start_date AS 'Start Date', 
          objective AS 'Objective',  
          CONCAT ('attom:21:',type_of_training) AS 'Type of Training',   
          (participants_female + participants_male + participants_gender_not_specified) AS 'No of Participants',  CASE   
            WHEN training_status = 1 THEN 'Planned'  
             WHEN training_status = 2 THEN 'Completed'  
             ELSE 'Cancelled' END AS 'Status'   
             FROM sapp_core.training   
          LEFT JOIN project AS p ON p.id = training.id_project  
          WHERE <CANO_FILTER> p.deleted_at is null;"
        ];

        $this->db->table('query_template')->where('id', '95')->update($dashboardTraining);

        $contractExpire = [
          'id'            => 34,
          'query_reference'     => 'Contracts Expiring within Next 45 Days',
          'query_string' => "SELECT 
          contract.contract_name 'AS Contract Name', 
          contract.contract_status AS 'Present Status', 
          contract.date_of_signed AS 'Date of Signed', 
          contract.end_date AS 'Expiray Date', 
          contract_supplier.name AS 'Supplier', 
          contract_extntion.extended_date AS 'Extended Date' 
          FROM contract 
          JOIN contract_supplier ON contract.supplier_id = contract_supplier.id 
          LEFT JOIN 
          (SELECT 
            contract_id, 
            max(extention_date) AS extended_date 
             FROM sapp_core.contract_extention
             WHERE contract_extention.deleted_at is null
             group by contract_id) AS contract_extntion ON  contract.id = contract_extntion.contract_id
          WHERE contract_supplier.deleted_at is null AND
          IF(contract_extntion.extended_date, CURDATE() + INTERVAL 45 DAY >= contract_extntion.extended_date , CURDATE() + INTERVAL 45 DAY >= contract.end_date );"
        ];

        $this->db->table('query_template')->where('id', '34')->update($contractExpire);

        $projectLoanProgressUpUpdate = [
          'id'            => 68,
          'query_reference'     => 'Dashboard Rural finance progress',
          'query_string'         => "SELECT 
          FORMAT(COALESCE(SUM(actual_loan_amount)/1000000, 0), 4, 0) AS y1,
          date_range.month AS x
      FROM (
          SELECT 
              DATE_FORMAT(NOW() - INTERVAL seq MONTH, '%Y-%m') AS month
          FROM (
              SELECT 
                  (0) AS seq 
              UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 
              UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 
              UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 
              UNION ALL SELECT 10 UNION ALL SELECT 11
          ) AS sequence
      ) AS date_range
      LEFT JOIN (
          SELECT 
              DATE_FORMAT(loan_disbursement_date, '%Y-%m') AS month,
              actual_loan_amount
          FROM 
              loan_disbursement
          JOIN 
              loan ON loan.id = loan_disbursement.loan_id
          WHERE 
              loan_disbursement.deleted_at IS NULL 
              AND loan.deleted_at IS NULL 
              AND disbursement_status = 3
              AND loan_disbursement_date >= CURDATE() - INTERVAL 12 MONTH
      ) AS data ON date_range.month = data.month
      GROUP BY 
          date_range.month
      ORDER BY 
          STR_TO_DATE(date_range.month, '%Y-%m');"
        ];

        $this->db->table('query_template')->where('id', '68')->update($projectLoanProgressUpUpdate);

        $dashboardOffFarmStatus = [
          'id'            => 101,
          'query_reference'     => 'Dashboard off farm status',
          'query_string' => "SELECT 
          CASE 
          WHEN (off_farm_activity.agreed_amount/ payment.paid) < 1 THEN 3
          ELSE 1
          END AS label,
          count(off_farm_activity.id) AS value 
          FROM sapp_core.off_farm_activity
          LEFT join (SELECT off_farm_activity_id, sum(payment_amount) as paid FROM sapp_core.off_farm_payment 
                     WHERE off_farm_payment.deleted_at IS NULL
                     group by off_farm_activity_id) AS payment
          ON payment.off_farm_activity_id = off_farm_activity.id
          where off_farm_activity.deleted_at IS NULL
          group by label;"
        ];

        $this->db->table('query_template')->where('id', '101')->update($dashboardOffFarmStatus);

        $dashboardIncomePresentage = [
          'id'            => 25,
          'query_reference'     => 'Dashboard income generation percentage',
          'query_string' => "SELECT 
          round(count(f.farmer_id)/12000*100,2) AS value 
          FROM(
             Select farmer_project.farmer_id, project.project_type 
                from farmer_project 
                JOIN project ON farmer_project.project_id = project.id 
                Where farmer_project.deleted_at IS NULL AND 
                project.deleted_at IS NULL AND
                project.project_type IN (5)) AS f;"
        ];

        $this->db->table('query_template')->where('id', '25')->update($dashboardIncomePresentage);
    }
}
<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed UpdateQTNewSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateQTNewSeeder extends Seeder
{
    public function run()
    {
        $detailedDashboardProjectTarget = [
                'id'            => 62,
                'query_reference'     => 'Project dashboard project target table',
                'query_string'         => "SELECT 
                category_name AS 'Category',
                CASE   
                WHEN type = 1 THEN 'Loan'  
                WHEN type = 2 THEN 'Grant'  
                ELSE 'Loan & Grant' 
                END AS 'Type',   
                qty AS 'Qty', 
                target_amount AS 'Target Amount', 
                no_of_farmers AS 'No of Farmers' 
                FROM project_target 
                LEFT JOIN project AS p ON project_target.project_id = p.id
                WHERE <CANO_FILTER> p.deleted_at IS NULL AND project_target.deleted_at IS NULL"
        ];

        $this->db->table('query_template')->where('id', '62')->update($detailedDashboardProjectTarget);

        $statusOfLoanDisbursement = [
            'id'            => 64,
            'query_reference'     => 'Project dashboard loan disbursement status pie',
            'query_string'         => "SELECT 
            count(loan_disbursement.id) AS value, 
            loan_disbursement.disbursement_status AS label  
            FROM loan_disbursement 
            LEFT JOIN loan ON loan_disbursement.loan_id = loan.id
            LEFT JOIN project AS p ON `loan`.project_id = p.id 
            WHERE <CANO_FILTER>  
            p.deleted_at IS NULL AND 
            loan_disbursement.deleted_at IS NULL AND
            loan.deleted_at IS NULL
            group by loan_disbursement.disbursement_status;"
        ];

        $this->db->table('query_template')->where('id', '64')->update($statusOfLoanDisbursement);


        $projectProgresUp = [
            'id'            => 57,
            'query_reference'     => 'Project dashboard credit progres up',
            'query_string'         => "SELECT 
            count(1) AS value 
            FROM loan_disbursement
            LEFT JOIN loan ON loan_disbursement.loan_id = loan.id
            LEFT JOIN project AS p ON loan.project_id = p.id 
            WHERE <CANO_FILTER> loan_disbursement.disbursement_status = 3 AND 
            loan_disbursement.deleted_at IS NULL AND
            loan.deleted_at IS NULL AND
            p.deleted_at IS NULL"
        ];

        $this->db->table('query_template')->where('id', '57')->update($projectProgresUp);

        $projectProgresDown = [
            'id'            => 58,
            'query_reference'     => 'Project dashboard credit progres down',
            'query_string'         => "SELECT sum(pt.no_of_farmers) AS value 
            FROM project_target AS pt 
            LEFT JOIN project AS p ON pt.project_id = p.id 
            WHERE <CANO_FILTER> pt.deleted_at IS null AND p.deleted_at IS NULL"
        ];

        $this->db->table('query_template')->where('id', '58')->update($projectProgresDown);

        $projectTargetDashboard = [
            'id'            => 98,
            'query_reference'     => 'Project Dashboard Grant Table',
            'query_string'         => "SELECT   
            a.item AS 'Item',  
            FORMAT(a.sum_qty,0,0) AS 'Disbursed Qty', 
            FORMAT(a.sum_price*a.sum_qty,2,0) AS 'Total Value'  
             FROM  (
            select 
            project_target_item.item_description AS item,  
            p.project_name AS project,  
            sum(grant_item_farmer.qty) as sum_qty,  
             avg(grant_item_farmer.price) as sum_price  
             FROM grant_item_farmer  
             LEft join grant_disbursement ON grant_disbursement.id = grant_item_farmer.grant_disbursement_id  
             left join sapp_core.grant on sapp_core.grant.id =grant_disbursement.grant_id  
             left join project_target_item on project_target_item.id =grant_item_farmer.project_target_item_id  
             left join project AS p ON p.id = sapp_core.grant.project_id  
             where <CANO_FILTER>  grant_disbursement.disbursement_status=3 AND  
             grant_item_farmer.deleted_at is null AND
             grant_disbursement.deleted_at is null AND
             grant.deleted_at is null AND
             project_target_item.deleted_at is null AND
             p.deleted_at is null 
             group by project_target_item.item_description  
             order by project_target_item.item_description) AS a"
        ];

        $this->db->table('query_template')->where('id', '98')->update($projectTargetDashboard);

        $grantDisPieChart = [
            'id'            => 63,
            'query_reference'     => 'Project dashboard Grant disbursement status pie',
            'query_string'         => "SELECT count(grant_disbursement.id) AS value, 
            grant_disbursement.disbursement_status AS label 
            FROM grant_disbursement 
            LEFT JOIN `grant` ON grant_disbursement.grant_id = `grant`.id 
            LEFT JOIN project AS p ON `grant`.project_id = p.id 
            WHERE <CANO_FILTER>  grant_disbursement.deleted_at IS NULL AND 
            `grant`.deleted_at IS NULL AND p.deleted_at IS NULL 
            group by grant_disbursement.disbursement_status;"
        ];

        $this->db->table('query_template')->where('id', '63')->update($grantDisPieChart);


        $loanDisReport = [
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
            where <CANO_FILTER>  loan_disbursement.disbursement_status=3 AND
             project.id = farmer_project.project_id AND 
             loan_disbursement.deleted_at IS NULL AND 
             farmer_project.deleted_at IS NULL AND
             user.deleted_at IS NULL AND
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
             farmer_project.deleted_at IS NULL"
        ];

        $this->db->table('query_template')->where('id', '10')->update($loanDisReport);

        $grantDisReport = [
            'id'            => 84,
            'query_reference'     => 'Report Grant Dis - Project',
            'query_string'         => "SELECT 
            a.item AS 'Item', 
            a.project AS 'Project', 
            FORMAT(a.sum_qty,0,0) AS 'Disbursed Qty', 
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
            project.deleted_at IS NULL AND
            grant_disbursement.disbursement_status = 3
            group by project_target_item.item_description
            order by project_target_item.item_description) AS a;"
        ];

        $this->db->table('query_template')->where('id', '84')->update($grantDisReport);

        $statusOfGrantDisOverview = [
            'id'            => 33,
            'query_reference'     => 'Status of Grant Disbursement',
            'query_string'         => "SELECT 
            count(grant_disbursement.id) AS value, 
            grant_disbursement.disbursement_status AS label 
            FROM grant_disbursement 
            WHERE grant_disbursement.deleted_at IS NULL 
            group by grant_disbursement.disbursement_status;"
        ];

        $this->db->table('query_template')->where('id', '33')->update($statusOfGrantDisOverview);

        $statusOfLoanDisOverview = [
            'id'            => 44,
            'query_reference'     => 'Dashboard status of loan disbursment',
            'query_string'         => "SELECT 
            count(loan_disbursement.id) AS value, 
            loan_disbursement.disbursement_status AS label  
            FROM loan_disbursement 
            WHERE loan_disbursement.deleted_at IS NULL
            group by loan_disbursement.disbursement_status;"
        ];

        $this->db->table('query_template')->where('id', '44')->update($statusOfLoanDisOverview);

        $projectDashLoan = [
            'id'            => 97,
            'query_reference'     => 'Project Dashboard Loan Table',
            'query_string'         => "SELECT     
            concat(user.fname, ' ',  user.lname) AS 'Benificiary Name',   
            user.pin AS 'NIC',   
            CONCAT('attom:51:',user.gender) AS 'Gender',   
            concat(farmer.address_no, ' ', farmer.address_street, ' ', farmer.address_city) AS 'Address',   
            user.mobile AS 'TP No',   
            gnd.gnd AS 'GND',   
            dsd.dsd AS 'DSD',   
            district.district AS 'District',        
            loan.loan_scheme_name AS 'Loan Scheme Name',    
            banks.bank AS 'Bank',   
            loan.main_purpose AS 'Main Purpose',    
            loan_disbursement.loan_disbursement_date AS 'Disbursed Date',   
            loan_disbursement.actual_loan_amount AS 'Disbursed Amount'     
             from loan_disbursement   
             LEFT JOIN loan ON loan.id = loan_disbursement.loan_id  
             LEFT JOIN project AS p ON p.id = loan.project_id  
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
             where <CANO_FILTER>   loan_disbursement.disbursement_status=3 AND 
             p.id = farmer_project.project_id AND
             loan_disbursement.deleted_at IS NULL AND 
             farmer_project.deleted_at IS NULL AND 
             loan.deleted_at IS NULL AND
             user.deleted_at IS NULL AND
             farmer.deleted_at IS NULL AND
             p.deleted_at IS NULL AND
             gnd.deleted_at IS NULL AND
             dsd.deleted_at IS NULL AND
             district.deleted_at IS NULL AND
             province.deleted_at IS NULL AND
             aggrarian_division.deleted_at IS NULL AND
             bank_details.deleted_at IS NULL AND
             banks.deleted_at IS NULL AND
             link_user_bank.deleted_at IS NULL AND
             link_disbursement_farmer.deleted_at IS NULL
             order by loan_disbursement.loan_disbursement_date DESC LIMIT 10;"
        ];
        $this->db->table('query_template')->where('id', '97')->update($projectDashLoan);

        $reportPOC = [
            'id'            => 52,
            'query_reference'     => 'Report POC',
            'query_string'         => "SELECT DISTINCT 
            u.fname AS 'First Name',
            u.lname AS 'Last Name',
            u.pin AS 'NIC Number',
            u.mobile AS 'Mobile',
            f.whatsapp_no AS 'WhatsApp No',
            CONCAT(f.address_no,
                    ' ',
                    f.address_street,
                    ' ',
                    f.address_city) AS 'Address',
            CONCAT('attom:35:', f.citizenship_by) AS 'Citizenship By',
            CASE
                WHEN f.barrower_type = 1 THEN 'Main'
                WHEN f.barrower_type = 2 THEN 'Sub'
                ELSE ''
            END AS 'Barrower Type',
            p.project_name AS 'Project Name',
            CASE 
            WHEN f.status =1 Then 'In Progress'
            WHEN f.status = 2 then 'Approved'
            when f.status =3 then 'Rejected'
            END AS 'Status',
            f.user AS 'Officer Name',
            f.designation AS 'Approved officer Designation',
            f.approved_date AS 'Approved Date',
            CONCAT('attom:38:', f.head_hh) AS 'Is it Women Headed HH',
            CONCAT('attom:97:', f.civil_status) AS 'Civil Status',
            u.dob AS 'Date of Birth',
            CONCAT('attom:51:', u.gender) AS 'Gender',
            gnd.gnd AS 'GND',
            dsd.dsd AS 'DSD',
            aggrarian_division.name AS 'ASC',
            district.district AS 'District',
            bd.acc_no AS 'Account No',
            bd.branch AS 'Branch Name',
            b.bank AS 'Bank Name',
            bd.bank_code AS 'Bank Code',
            f.age_while_register AS 'Age while Reg',
            fp.purpose AS 'Purpose of Assistance',
            fp.pfi_ref_no AS 'PFI Number',
            CONCAT('attom:36:', f.availability_electricity) AS 'Availability of Electricity',
            CONCAT('attom:8:', f.electricity_from) AS 'Electricity From',
            CONCAT('attom:37:', f.availability_water_crops) AS 'Availability of water for Crops',
            CONCAT('json:11:', f.source_water_crops) AS 'Source of Water for Crops',
            CONCAT('attom:36:',
                    f.availability_drinking_water) AS 'Availability of Drinking Water',
            CASE
                WHEN f.source_drinking_water = 1 THEN 'Well'
                WHEN f.source_drinking_water = 2 THEN 'Pipe'
                WHEN f.source_drinking_water = 3 THEN 'Public tap'
                WHEN f.source_drinking_water = 4 THEN 'Tube wells'
                WHEN f.source_drinking_water = 5 THEN 'lake pond'
                WHEN f.source_drinking_water = 6 THEN 'River Stream'
                WHEN f.source_drinking_water = 7 THEN 'Tap water (Main)'
                WHEN f.source_drinking_water = 8 THEN 'Tap water (other)'
            END AS 'Source of Drinking Water',
            CONCAT('json:12:', f.cond_house_floor) AS 'Condition of House floor',
            CONCAT('json:13:', f.consumer_durables) AS 'Consumer Durables',
            CONCAT('json:15:', f.sanitation) AS 'Sanitation Facility',
            CONCAT('json:16:', f.agri_equipments) AS 'Available Agriculture Equipments',
            CONCAT('attom:5:',
                    f.heighest_education_qualification) AS 'Heighest Education Qualification',
            CONCAT('json:14:', f.avilability_vehicles) AS 'Availability of Vehicles',
            CONCAT('json:9:', f.tools_farmland) AS 'Available Tools for Farmland',
            CONCAT('attom:72:', f.registered_in) AS 'Registered in Any Org',
            f.register_org AS 'Registed Org',
            CONCAT('attom:17:', f.main_source_income) AS 'Main Source of Income',
            CONCAT('attom:7:', f.main_source_income_nature) AS 'Nature of Main Income source',
            f.avg_main_agriculture_income AS 'Avg. Main Source income (Agriculture)',
            CONCAT('attom:7:',
                    f.avg_main_agricultutre_income_nature) AS 'Nature of Agriculture Income',
            f.avg_harvest_income AS 'Avg Harvesting Income',
            f.other_income AS 'Other Income',
            CONCAT('json:7:', f.other_income_nature) AS 'Nature of Other Income',
            f.other_income_discription AS 'Description of Other Income sources',
            f.expense_agri AS 'Expense on Agriculture',
            CONCAT('attom:98:', f.nature_agri_expense) AS 'Nature of Agri Expenses',
            f.expense_other AS 'Expenditure on Other',
            CONCAT('attom:99:', f.nature_expense_other) AS 'Nature of Other Expenses',
            CONCAT('json:63:', f.undergo_training) AS 'Udergo any Training',
            CONCAT('attom:64:', f.samurdhi_pds) AS 'Member of Samurdhi or PDS',
            CONCAT('attom:65:', f.balance_diet) AS 'Balance Diet',
            f.no_balance_diet AS 'No of Balance Diet',
            CONCAT('attom:66:', f.hunger_period) AS 'Hunger Period',
            CONCAT('attom:67:', f.financial_decision) AS 'Who is taking Financial Decission',
            CONCAT('attom:68:', f.before_barrow) AS 'Do you Barrowed Before',
            CONCAT('attom:69:', f.source_of_credit) AS 'Source of Credit',
            f.informal_barrow AS 'Informal Barrow',
            CONCAT('attom:70:', f.repaid_status_informal) AS 'Repaid Status of Informal',
            f.repaid_informal AS 'Repaid Informal',
            f.formal_barrow AS 'Formal Barrow',
            CONCAT('attom:71:', f.repaid_status_formal) AS 'Repaid Status of Formal',
            f.repaid_formal AS 'Repaid Formal',
            CONCAT('attom:72:', f.registered_in) AS 'Registered Organization',
            f.register_org AS 'Name of Org',
            f.no_household_members AS 'No household members',
            f.male_under_5 AS 'Male under 5',
            f.female_under_5 AS 'Feale under 5',
            f.male_5_to_14 AS 'Male 5 to 14',
            f.female_5_to_14 AS 'Female 5 to 14',
            f.male_15_to_29 AS 'Male 15 to 29',
            f.female_15_to_29 AS 'Female 15 to 29',
            f.male_30_to_49 AS 'Male 30 to 49',
            f.female_30_to_49 AS 'Feale 30 to 49',
            f.male_50_to_64 AS 'Male 50 to 64',
            f.female_50_to_64 AS 'Female 50 to 64'
        FROM
            user AS u
                LEFT JOIN
            file_registry AS fr ON fr.id = u.profile_picture
                LEFT JOIN
            farmer AS f ON f.user_id = u.id
                LEFT JOIN
            farmer_project AS fp ON fp.farmer_id = u.id
                LEFT JOIN
            project AS p ON fp.project_id = p.id
                LEFT JOIN
            link_disbursement_farmer AS ldf ON ldf.user_id = u.id
                LEFT JOIN
            loan_disbursement AS ld ON ldf.loan_disbursement_id = ld.id
                LEFT JOIN
            loan AS l ON ld.loan_id = l.id
                LEFT JOIN
            link_user_bank AS lub ON lub.user_id = u.id
                LEFT JOIN
            bank_details AS bd ON bd.id = lub.bank_details_id
                LEFT JOIN
            banks AS b ON bd.bank_id = b.id
                LEFT JOIN
            gnd ON gnd.id = f.gnd_id
                LEFT JOIN
            dsd ON gnd.dsd_id = dsd.id
                LEFT JOIN
            district ON dsd.district_id = district.id
                LEFT JOIN
            aggrarian_division ON aggrarian_division.id = f.aggrarian_division_id
        WHERE
           <CANO_FILTER> u.user_type IN (2) AND u.deleted_at IS NULL AND fp.deleted_at IS NULL AND (f.status IS NULL OR f.status IN (1, 2))
        LIMIT 5000;"
        ];

        $this->db->table('query_template')->where('id', '52')->update($reportPOC);

        $reportShortFarmerProfile = [
            'id'            => 76,
            'query_reference'     => 'Report Short Farmer Profile',
            'query_string'         => "SELECT 
            CONCAT(user.fname, ' ', user.lname) AS 'Name',
            project.project_name AS 'Project Name',
            user.pin AS 'NIC',
            CONCAT(farmer.address_no, ' ', farmer.address_street, ' ', farmer.address_city) AS 'Address',
            user.mobile AS 'Phone',
            farmer.whatsapp_no AS 'WhatsApp No',
            gnd.gnd AS 'GND',
            dsd.dsd AS 'DSD',
            aggrarian_division.name AS 'ASC',
            district.district AS 'District',
            obtained_loan_text.obtian_loan AS 'Benefited by Loan',
            grant_benifit_text.obtian_grant AS 'Benefited by Grant'
        FROM sapp_core.user
        LEFT JOIN farmer ON farmer.user_id = user.id
        LEFT JOIN gnd ON gnd.id = farmer.gnd_id
        LEFT JOIN dsd ON dsd.id = gnd.dsd_id
        LEFT JOIN district ON dsd.district_id = district.id
        LEFT JOIN farmer_project ON farmer_project.farmer_id = user.id
        LEFT JOIN aggrarian_division ON aggrarian_division.id = farmer.aggrarian_division_id
        LEFT JOIN project ON project.id = farmer_project.project_id
        LEFT JOIN (
            SELECT obtianed_loan.id, 
                CASE WHEN obtianed_loan.farmer_id IS NULL THEN 'Not Benifited' ELSE 'Obtained Loan' END AS obtian_loan
            FROM (
                SELECT DISTINCT user.id, loan_benifit.farmer_id
                FROM user
                LEFT JOIN (
                    SELECT link_disbursement_farmer.user_id AS farmer_id
                    FROM loan_disbursement
                    JOIN link_disbursement_farmer ON loan_disbursement.id = link_disbursement_farmer.loan_disbursement_id
                    WHERE loan_disbursement.disbursement_status NOT IN (6)
                ) AS loan_benifit ON loan_benifit.farmer_id = user.id
            ) AS obtianed_loan
        ) obtained_loan_text ON obtained_loan_text.id = user.id
        LEFT JOIN (
            SELECT obtianed_grant.id, 
                CASE WHEN obtianed_grant.farmer_id IS NULL THEN 'Not Benifited' ELSE 'Obtained Grant' END AS obtian_grant
            FROM (
                SELECT DISTINCT user.id, grant_benifit.farmer_id
                FROM user
                LEFT JOIN (
                    SELECT farmer_id
                    FROM grant_disbursement
                    WHERE disbursement_status NOT IN (4)
                ) AS grant_benifit ON grant_benifit.farmer_id = user.id
            ) AS obtianed_grant
        ) grant_benifit_text ON grant_benifit_text.id = user.id
        WHERE <CANO_FILTER> (farmer.status IS NULL OR farmer.status IN (1, 2)) AND user.deleted_at IS NULL AND user.user_type = 2 AND farmer_project.deleted_at IS NULL;"
        ];

        $this->db->table('query_template')->where('id', '76')->update($reportShortFarmerProfile);

        $reportOffFarm = [
            'id'            => 16,
            'query_reference'     => 'Report Off Farm',
            'query_string'         => "SELECT 
            project.project_name AS 'Project Name',
            off_farm_activity.activity AS 'Activity',
            off_farm_development.no_direct_benificiary AS 'No of Direct Benificiary',
            off_farm_development.no_indirect_benificiary AS 'No of Indirect Benificiary',
            off_farm_activity.estimated_cost AS 'Estimated Cost',
            off_farm_activity.implementation_agency AS 'Implementation Agency',
            off_farm_development.off_farm_dev_name AS 'Off Farm Development Name',
            nsc.nsc_paper_name AS 'NSC Paper Details',
            CONCAT('attom:52:',
                    off_farm_development.status_nsc_approval) AS 'Status of NSC Approval',
            off_farm_activity.remarks AS 'Remarks on Activity',
            off_farm_activity.agreed_amount AS 'Agreed Amount',
            off_farm_activity.admin_cost AS 'Admin Cost',
            off_payment.paid_amount AS 'Amount Paid'
        FROM
            sapp_core.off_farm_activity
              LEFT  JOIN
            (SELECT 
                off_farm_activity_id, SUM(payment_amount) AS paid_amount
            FROM
                off_farm_payment WHERE deleted_at IS NULL
            GROUP BY off_farm_activity_id) AS off_payment ON off_payment.off_farm_activity_id = off_farm_activity.id
               LEFT JOIN
            off_farm_development ON off_farm_activity.off_farm_development_id = off_farm_development.id
              LEFT  JOIN
            project ON project.id = off_farm_development.project_id
               LEFT JOIN
            (SELECT 
                nsc_paper.id,
                    CONCAT(subject, ' [', nsc_paper_no, ']') AS nsc_paper_name
            FROM
                nsc_paper) AS nsc ON nsc.id = off_farm_development.nsc_paper_id
        WHERE
            <CANO_FILTER> off_farm_development.deleted_at IS NULL;"
        ];

        $this->db->table('query_template')->where('id', '16')->update($reportOffFarm);

        $dasshboardOffFarmTable = [
            'id'            => 96,
            'query_reference'     => 'Project Dashboard Off farm Table',
            'query_string'         => "SELECT      
            off_farm_activity.activity AS 'Activity',   
            off_farm_development.no_direct_benificiary AS 'No of Direct Benificiary',   off_farm_development.no_indirect_benificiary AS 'No of Indirect Benificiary',   
            FORMAT(off_farm_activity.estimated_cost,2,0) AS 'Estimated Cost',    off_farm_activity.implementation_agency AS 'Implementation Agency',     
            off_farm_development.off_farm_dev_name AS 'Off Farm Development Name',  	FORMAT(off_farm_activity.agreed_amount,2,0) AS 'Agreed Amount',     
            FORMAT(off_farm_activity.admin_cost,2,0) AS 'Admin Cost',    
            FORMAT(off_payment.paid_amount,2,0) AS 'Amount Paid'     
            FROM sapp_core.off_farm_activity 
            JOIN     
            (Select off_farm_activity_id, SUM(payment_amount) as paid_amount 
            from off_farm_payment WHERE deleted_at IS NULL  
            GROUP BY off_farm_activity_id) AS off_payment ON off_payment.off_farm_activity_id= off_farm_activity.id  JOIN    off_farm_development ON off_farm_activity.off_farm_development_id = off_farm_development.id    JOIN project AS p ON p.id = off_farm_development.project_id  
            JOIN    (select nsc_paper.id, CONCAT (subject,' [',nsc_paper_no,']') AS nsc_paper_name from nsc_paper) AS nsc ON nsc.id =  off_farm_development.nsc_paper_id    
            WHERE <CANO_FILTER> off_farm_development.deleted_at IS NULL;"
        ];

        $this->db->table('query_template')->where('id', '96')->update($dasshboardOffFarmTable);

        $projectTopValue = [
            'id'            => 17,
            'query_reference'     => '4P Project Top value',
            'query_string'         => "SELECT 
            count(f.farmer_id) AS value 
            FROM( 
                Select farmer_project.farmer_id, project.project_type 
                from farmer_project 
                JOIN project ON farmer_project.project_id = project.id 
                Where farmer_project.deleted_at IS NULL AND project.deleted_at IS NULL AND project.project_type IN (1,2,3,4)) AS f"
        ];

        $this->db->table('query_template')->where('id', '17')->update($projectTopValue);

        $projectperecentageValue = [
            'id'            => 19,
            'query_reference'     => '4P Project percentage',
            'query_string'         => "SELECT round(count(f.farmer_id)/43000*100,2) AS value FROM(
                Select farmer_project.farmer_id, project.project_type from 
                farmer_project JOIN project 
                ON farmer_project.project_id = project.id 
                Where project.deleted_at IS NULL AND farmer_project.deleted_at IS NULL AND project.project_type IN (1,2,3,4)) AS f;"
        ];

        $this->db->table('query_template')->where('id', '19')->update($projectperecentageValue);


        $dashboardProgressBenificiary = [
            'id'            => 67,
            'query_reference'     => 'Ddashboard 4P progress',
            'query_string'         => "SELECT
            count(farmer.user_id) AS y1, 
            DATE_FORMAT(farmer.approved_date, '%Y-%M') AS x 
            FROM farmer 
            where farmer.status = 2 AND 
            farmer.deleted_at IS NULL AND 
            farmer.approved_date IS NOT NULL 
            GROUP by DATE_FORMAT(farmer.approved_date, '%Y-%M') 
            ORDER BY farmer.approved_date;"
        ];

        $this->db->table('query_template')->where('id', '67')->update($dashboardProgressBenificiary);

        $dashboardRuralFinance = [
            'id'            => 68,
            'query_reference'     => 'Ddashboard Rural finance progress',
            'query_string'         => "SELECT 
            FORMAT(sum(actual_loan_amount)/1000000,4,0) AS y1, 
            DATE_FORMAT(loan_disbursement_date, '%Y-%M') AS x
            FROM loan_disbursement
            WHERE loan_disbursement.deleted_at IS NULL AND 
            disbursement_status = 3 
            GROUP by DATE_FORMAT(loan_disbursement_date, '%Y-%M');"
        ];

        $this->db->table('query_template')->where('id', '68')->update($dashboardRuralFinance);

        $youthTop = [
            'id'            => 20,
            'query_reference'     => 'Youth Top value',
            'query_string'         => "SELECT 
            count(f.farmer_id) AS value 
            FROM(
                Select farmer_project.farmer_id, project.project_type 
                from farmer_project 
                JOIN project ON farmer_project.project_id = project.id 
                Where project.deleted_at IS NULL AND 
                farmer_project.deleted_at IS NULL AND 
                project.project_type IN (6)) AS f;"
        ];

        $this->db->table('query_template')->where('id', '20')->update($youthTop);


        $youthPresentage = [
            'id'            => 22,
            'query_reference'     => 'Youth percentage',
            'query_string'         => "SELECT 
            round(count(f.farmer_id)/2500*100,2) AS value 
            FROM(
                Select farmer_project.farmer_id, project.project_type 
                from farmer_project 
                JOIN project ON farmer_project.project_id = project.id 
                Where project.deleted_at IS NULL AND 
                farmer_project.deleted_at IS NULL AND 
                project.project_type IN (6)) AS f;"
        ];

        $this->db->table('query_template')->where('id', '22')->update($youthPresentage);

        $igTop = [
            'id'            => 23,
            'query_reference'     => 'Dashboard income generation top',
            'query_string'         => "SELECT 
            count(f.farmer_id) AS value 
            FROM(
                Select farmer_project.farmer_id, project.project_type 
                from farmer_project 
                JOIN project ON farmer_project.project_id = project.id 
                Where project.deleted_at IS NULL AND 
                farmer_project.deleted_at IS NULL AND 
                project.project_type IN (5)) AS f;"
        ];

        $this->db->table('query_template')->where('id', '23')->update($igTop);

        $igPercentage = [
            'id'            => 25,
            'query_reference'     => 'Dashboard income generation percentage',
            'query_string'         => "SELECT 
            round(count(f.farmer_id)/1500*100,2) AS value 
            FROM(
                Select farmer_project.farmer_id, project.project_type 
                from farmer_project 
                JOIN project ON farmer_project.project_id = project.id 
                Where farmer_project.deleted_at IS NULL AND 
                project.deleted_at IS NULL AND
                project.project_type IN (5)) AS f;"
        ];        

        $this->db->table('query_template')->where('id', '25')->update($igPercentage);

    }
}
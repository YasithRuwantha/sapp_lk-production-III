<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed UpdateBenifiarySeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateBenifiarySeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id'            => 52,
            'query_reference'     => 'Report POC',
            'query_string'         => "SELECT 
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
        LIMIT 5000
        ;
            "
        ];

        $this->db->table('query_template')->where('id', '52')->update($data);

    }
}
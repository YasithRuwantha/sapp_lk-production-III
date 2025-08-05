<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed UpdateQTSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateQTSeeder extends Seeder
{
    public function run()
    {
        $data = [
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
                where <CANO_FILTER> loan_disbursement.deleted_at IS NULL AND farmer_project.deleted_at IS NULL"
        ];

        $this->db->table('query_template')->where('id', '10')->update($data);

        $data2 = [
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
           where <CANO_FILTER> 
           loan_disbursement.deleted_at IS NULL
           AND farmer_project.deleted_at IS NULL  
           AND loan.deleted_at IS NULL
           order by loan_disbursement.loan_disbursement_date DESC LIMIT 10"
        ];

        $this->db->table('query_template')->where('id', '97')->update($data2);

        $data3 = [
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
           where <CANO_FILTER> grant_item_farmer.deleted_at is null  group by project_target_item.item_description  order by project_target_item.item_description) AS a"
        ];

        $this->db->table('query_template')->where('id', '98')->update($data3);

    }
}
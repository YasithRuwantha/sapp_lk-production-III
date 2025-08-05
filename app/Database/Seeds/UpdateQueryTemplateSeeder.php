<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed UpdateQueryTemplateSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateQueryTemplateSeeder extends Seeder
{
    public function run()
    {
        $data = [
                'id'            => 78,
                'query_reference'     => 'Report Project wise Grant',
                'query_string'         => "SELECT
                project.project_name AS 'Project Name',
                project_target.category_name AS 'Category',
                project_target_item.item_description AS 'Item',
                FORMAT((SUM(grant_item.total_value)/SUM(grant_item.disbursed_qty)),2,2) AS 'Average Unit Price',
                FORMAT(SUM(grant_item.disbursed_qty),0,2) AS 'QTY',
                FORMAT(SUM(grant_item.total_value),2,2) AS 'Value',
                FORMAT(SUM(grant_item.no_of_farmers),0,2) AS 'No of Farmer'
                FROM
                (SELECT 
                grant_disbursement.grant_id AS 'grant_id',
                grant_disbursement.farmer_category AS 'farmer_cat',
                grant_item_farmer.project_target_item_id AS 'item',
                min(grant_item_farmer.price) AS 'unit_price',
                sum(grant_item_farmer.qty) AS 'disbursed_qty',
                sum(grant_item_farmer.price*grant_item_farmer.qty) AS 'total_value',
                count(grant_disbursement.farmer_id) AS 'no_of_farmers'
                FROM sapp_core.grant_item_farmer
                LEFT JOIN project_target_item ON grant_item_farmer.project_target_item_id = project_target_item.id
                LEFT JOIN grant_disbursement ON grant_disbursement.id = grant_item_farmer.grant_disbursement_id
                WHERE grant_disbursement.deleted_at IS NULL
                GROUP BY (grant_disbursement.id )) AS grant_item 
                LEFT JOIN sapp_core.grant ON sapp_core.grant.id = grant_item.grant_id
                LEFT JOIN project ON project.id	= sapp_core.grant.project_id
                LEFT JOIN project_target_item ON grant_item.item = project_target_item.id
                LEFT JOIN project_target ON project_target.id = grant_item.farmer_cat
                WHERE <CANO_FILTER> project.deleted_at IS NULL AND sapp_core.grant.deleted_at IS NULL
                GROUP BY (grant_item.item)"
        ];

        $this->db->table('query_template')->where('id', '78')->update($data);

        $data2 = [
            'id'            => 17,
            'query_reference'     => '4P Project Top value',
            'query_string'         => "SELECT count(f.farmer_id) AS value FROM(
                Select farmer_project.farmer_id, project.project_type from 
                farmer_project JOIN project 
                ON farmer_project.project_id = project.id 
                Where farmer_project.deleted_at IS NULL AND project.project_type IN (1,2,3,4)) AS f"
        ];

        $this->db->table('query_template')->where('id', '17')->update($data2);

        $data3 = [
            'id'            => 57,
            'query_reference'     => 'Project dashboard credit progress',
            'query_string'         => "SELECT count(1) AS value FROM loan_disbursement
            LEFT JOIN loan ON loan_disbursement.loan_id = loan.id
            LEFT JOIN project AS p ON loan.project_id = p.id 
            WHERE <CANO_FILTER> loan_disbursement.disbursement_status = 3;
            "
        ];

        $this->db->table('query_template')->where('id', '57')->update($data3);

        $data4 = [
            'id'            => 58,
            'query_reference'     => 'Project dashboard credit progres down',
            'query_string'         => "SELECT count(1) AS value FROM loan_disbursement 
            LEFT JOIN loan ON loan_disbursement.loan_id = loan.id 
            LEFT JOIN project AS p ON loan.project_id = p.id 
            WHERE <CANO_FILTER> loan_disbursement.disbursement_status IN (1,2,3,4) 
            and loan_disbursement.deleted_at IS NULL;
            "
        ];

        $this->db->table('query_template')->where('id', '58')->update($data4);


        $data5 = [
            'id'            => 55,
            'query_reference'     => 'project dashboard 4p progress down',
            'query_string'         => "SELECT sum(pt.no_of_farmers) AS value 
            FROM project_target AS pt 
            LEFT JOIN project AS p ON pt.project_id = p.id 
            WHERE <CANO_FILTER> pt.deleted_at IS null;
            "
        ];

        $this->db->table('query_template')->where('id', '55')->update($data5);

        $data6 = [
            'id'            =>76,
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
            WHERE <CANO_FILTER> user.deleted_at IS NULL AND user.user_type = 2 AND farmer_project.deleted_at IS NULL;
            "
        ];

        $this->db->table('query_template')->where('id', '76')->update($data6);


    }
}
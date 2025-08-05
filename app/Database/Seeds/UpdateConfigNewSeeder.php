<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed UpdateConfigNewSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateConfigNewSeeder extends Seeder
{
    public function run()
    {
        $itemWiseLoanReport = [
            'id'            => 115,
            'reference	'     => 'Filter Report Laon Project',
            'value'         => '[
                {
                    "label":"Project Name",
                    "field":"project-project_name",
                    "type":"select_dynamic",
                    "options":"select project.project_name AS val, project.project_name AS label FROM loan JOIN project ON project.id = loan.project_id JOIN loan_disbursement ON loan_disbursement.loan_id = loan.id WHERE project.deleted_at is null group by project.project_name ORDER by project.project_name"
                }, 
                {
                    "label":"Disbursement Date",
                    "field":"ld-loan_disbursement_date",
                    "type":"date"
                }
             ]'
        ];

        $this->db->table('config')->where('id', '115')->update($itemWiseLoanReport);

        $filterReportLoan = [
            'id'            => 107,
            'reference	'     => 'Filter Report Project wise Loan',
            'value'         => '[
                {
                          "label": "Project Name",
                          "field": "project-project_name",
                          "type": "select_dynamic",
                          "options": "SELECT project_name AS val, project_name AS label FROM project WHERE deleted_at IS NULL"
                      },
                    {
                          "label": "Loan Scheme Name",
                          "field": "loan-loan_scheme_name",
                          "type": "select_dynamic",
                          "options": "SELECT loan.loan_scheme_name AS val, loan.loan_scheme_name AS label FROM sapp_core.loan LEFT JOIN loan_disbursement ON loan_disbursement.loan_id = loan.id WHERE loan_disbursement.deleted_at IS NULL AND loan.deleted_at IS NULL group by loan.loan_scheme_name;"
                      }
                     
                ]'
        ];

        $this->db->table('config')->where('id', '107')->update($filterReportLoan);

        $filterReportShortFarmer = [
            'id'            => 102,
            'reference	'     => 'Filter Report Short Farmer Profile',
            'value'         => '[
                {
                   "label":"GND",
                   "field":"gnd-gnd",
                   "type":"select_dynamic",
                   "options":"SELECT gnd.gnd AS val, gnd.gnd AS label FROM gnd JOIN farmer ON gnd.id =farmer.gnd_id where farmer.deleted_at is null group by gnd.gnd order by gnd.gnd"
                },
                {
                   "label":"DSD",
                   "field":"dsd-dsd",
                   "type":"select_dynamic",
                   "options":"SELECT dsd.dsd AS val, dsd.dsd AS label FROM gnd JOIN farmer ON gnd.id =farmer.gnd_id join dsd on dsd.id =gnd.dsd_id where farmer.deleted_at is null group by dsd.dsd order by dsd.dsd"
                },
                {
                   "label":"ASC",
                   "field":"aggrarian_division-name",
                   "type":"select_dynamic",
                   "options":"SELECT aggrarian_division.name AS val, aggrarian_division.name AS label FROM farmer JOIN aggrarian_division ON farmer.aggrarian_division_id = aggrarian_division.id where aggrarian_division.deleted_at is null AND farmer.deleted_at IS NULL group by aggrarian_division.name order by aggrarian_division.name"
                },
                {
                   "label":"District",
                   "field":"district-district",
                   "type":"select_dynamic",
                   "options":"SELECT district.district AS val, district.district AS label FROM gnd JOIN farmer ON gnd.id =farmer.gnd_id join dsd on dsd.id =gnd.dsd_id join district ON district.id = dsd.district_id where farmer.deleted_at is null group by district.district order by district.district"
                },
                {
                   "label":"Project Name",
                   "field":"project-project_name",
                   "type":"select_dynamic",
                   "options":"select project.project_name AS val, project.project_name as label from farmer_project JOIN project ON farmer_project.project_id = project.id where farmer_project.deleted_at is null group by project.project_name order by project.project_name"
                },
                {
                   "label":"Obtained Loan",
                   "field":"obtained_loan_text-obtian_loan",
                   "type":"select",
                   "options":{
                      "Not Benifited":"Not Benifited",
                      "Obtained Loan":"Obtained Loan"
                   }
                },
                {
                   "label":"Obtained Grant",
                   "field":"grant_benifit_text-obtian_grant",
                   "type":"select",
                   "options":{
                      "Not Benifited":"Not Benifited",
                      "Obtained Grant":"Obtained Grant"
                   }
                }
             ] '
        ];

        $this->db->table('config')->where('id', '102')->update($filterReportShortFarmer);

        $procumentNoObjection = [
         'id'            => 28,
         'reference	'     => 'procurement.no_objection',
         'value'         => '{"1":"Obtained", "2":"Not Obtained","3":"Not Applicable"}'
         ];

        $this->db->table('config')->where('id', '28')->update($procumentNoObjection);

        $filterReportGrant = [
         'id'            => 96,
         'reference	'     => 'Filter Report grant',
         'value'         => '[
            {
               "label":"Calim Name",
               "field":"grant-grant_name",
               "type":"select_dynamic",
               "options":"SELECT sapp_core.grant.grant_name AS val, sapp_core.grant.grant_name AS label FROM sapp_core.grant JOIN grant_disbursement ON grant_disbursement.grant_id = sapp_core.grant.id WHERE sapp_core.grant.deleted_at IS NULL group by grant.grant_name"
            },
            {
               "label":"Project Name",
               "field":"project-project_name",
               "type":"select_dynamic",
               "options":"SELECT project.project_name AS val, project.project_name AS label FROM grant_disbursement JOIN sapp_core.grant ON sapp_core.grant.id = grant_disbursement.grant_id JOIN project ON project.id = grant.project_id group by project.project_name"
            },
            {
               "label":"First Name",
               "field":"user-fname",
               "type":"text"
            },
            {
               "label":"Last Name",
               "field":"user-lname",
               "type":"text"
            },
            {
               "label":"Grant Item",
               "field":"disbursed_item-item_description",
               "type":"select_dynamic",
               "options":"SELECT project_target_item.item_description AS val, project_target_item.item_description AS label FROM sapp_core.project_target_item JOIN grant_item_farmer ON grant_item_farmer.project_target_item_id = project_target_item.id WHERE project_target_item.deleted_at IS NULL group by project_target_item.item_description order by project_target_item.item_description;"
            },
            {
               "label":"Disbursement Status",
               "field":"grant_disbursement-disbursement_status",
               "type":"select",
               "options":{
                  "1":"Scheduling in Progress",
                  "2":"Scheduled",
                  "3":"Disbursed",
                  "4":"Hold"
               }
            },
            {
               "label":"GND",
               "field":"gnd-gnd",
               "type":"select_dynamic",
               "options":"SELECT gnd.gnd AS val, gnd.gnd AS label FROM gnd JOIN farmer ON gnd.id =farmer.gnd_id WHERE farmer.deleted_at IS null GROUP BY gnd.gnd order by gnd.gnd ASC"
            },
            {
               "label":"DSD",
               "field":"dsd-dsd",
               "type":"select_dynamic",
               "options":"SELECT dsd.dsd AS val, dsd.dsd AS label FROM gnd JOIN farmer ON gnd.id =farmer.gnd_id JOIN dsd on dsd.id = gnd.dsd_id WHERE farmer.deleted_at iS NULL GROUP BY dsd.dsd Order by dsd.dsd ASC"
            },
            {
               "label":"ASC",
               "field":"aggrarian_division-name",
               "type":"select_dynamic",
               "options":"select aggrarian_division.name as val, aggrarian_division.name as label FROm farmer JOIN aggrarian_division ON aggrarian_division.id = farmer.aggrarian_division_id where farmer.deleted_at is null group by aggrarian_division.name order by aggrarian_division.name"
            },
            {
               "label":"District",
               "field":"district-district",
               "type":"select_dynamic",
               "options":"SELECT district.district AS val, district.district AS label FROM gnd JOIN farmer ON gnd.id =farmer.gnd_id JOIN dsd on dsd.id = gnd.dsd_id JOIN district ON district.id = dsd.district_id WHERE farmer.deleted_at iS NULL group by district.district order by district.district"
            },
            {
               "label":"Category ",
               "field":"project_target-category_name",
               "type":"select_dynamic",
               "options":"SELECT category_name AS val, category_name AS label FROM grant_disbursement JOIN sapp_core.project_target ON grant_disbursement.farmer_category = project_target.id WHERE project_target.deleted_at IS NULL GROUP BY project_target.category_name"
            },
            {
               "label":"Gender ",
               "field":"user-gender",
               "type":"select",
               "options":{
                  "1":"Male",
                  "2":"Female",
                  "3":"Gender Not Specified"
               }
            },
            {
               "label":"Disbursement From",
               "field":"sdate-grant_disbursement-date_of_grant",
               "type":"date"
               },
            {
               "label":"Disbursement To",
               "field":"edate-grant_disbursement-date_of_grant",
               "type":"date"
               }

         ]'
         ];

        $this->db->table('config')->where('id', '96')->update($filterReportGrant);
    }
}
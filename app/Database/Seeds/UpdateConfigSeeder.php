<?php

/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed UpdateConfigSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateConfigSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id'            => 106,
            'reference	'     => 'Report Project wise Grant',
            'value'         => '
                [
                    {
                       "label":"Project Name",
                       "field":"project-project_name",
                       "type":"select_dynamic",
                       "options":"SELECT project.project_name AS val, project.project_name AS label FROM grant_disbursement JOIN sapp_core.grant ON sapp_core.grant.id = grant_disbursement.grant_id JOIN project ON project.id = grant.project_id group by project.project_name order by project.project_name"
                    },
                    {
                       "label":"Item",
                       "field":"project_target_item-item_description",
                       "type":"select_dynamic",
                       "options":"SELECT project_target_item.item_description AS val, project_target_item.item_description AS label FROM project_target_item JOIN grant_item_farmer ON grant_item_farmer.project_target_item_id = project_target_item.id WHERE project_target_item.deleted_at IS NULL group by project_target_item.item_description order by project_target_item.item_description;"
                    }
                 ]
                '
        ];

        $this->db->table('config')->where('id', '106')->update($data);


        $data2 = [
            'id'            => 113,
            'reference	'     => 'Filter Report Training Count Projects',
            'value'         => '[
                {
                   "label":"Project Name",
                   "field":"t-id_project",
                   "type":"select_dynamic",
                   "options":"Select project.id as val, project.project_name AS label FROm training JOIN project ON training.id_project = project.id WHERE training.deleted_at IS null group by project.project_name ORDER by project.project_name"
                },
                {
                   "label":"Type of Training",
                   "field":"t-type_of_training",
                   "type":"select",
                   "options":{
                      "1":"Technical",
                      "2":"Financial",
                      "3":"Record keeping",
                      "4":"Gender",
                      "5":"Nutrition",
                      "6":"Environment",
                      "7":"Business Proposal Development",
                      "8":"Exposure Visit",
                "9":"Cross cutting training"
                   }
                },
                {
                   "label":"From",
                   "field":"sdate-t-start_date",
                   "type":"date"
                },
                {
                   "label":"To",
                   "field":"edate-t-start_date",
                   "type":"date"
                }
             ]'
        ];

        $this->db->table('config')->where('id', '113')->update($data2);

        $data3 = [
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
                  "options":"SELECT aggrarian_division.name AS val, aggrarian_division.name AS label FROM farmer JOIN aggrarian_division ON farmer.aggrarian_division_id = aggrarian_division.id where aggrarian_division.deleted_at is null group by aggrarian_division.name order by aggrarian_division.name"
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

        $this->db->table('config')->where('id', '102')->update($data3);

    }
}

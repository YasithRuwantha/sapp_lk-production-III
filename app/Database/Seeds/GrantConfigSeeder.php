<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed GrantConfigSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GrantConfigSeeder extends Seeder
{
    public function run()
    {
        $data = [
                'id'            => 96,
                'reference'     => 'Filter Report grant',
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
                    }
                 ]'
        ];

        $this->db->table('config')->where('id', '96')->update($data);
    }
}
<?php

/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed NewUpdateConfigSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NewUpdateConfigSeeder extends Seeder
{
    public function run()
    {
        $isStatus = [
            'id'            => 50,
            'reference	'     => 'is.status',
            'value'         => '{"1":"Ongoing", "2":"Completed", "3":"Suspended"}'
        ];

        $this->db->table('config')->where('id', '50')->update($isStatus);

        $docArchiveCat = [
            'id'            => 56,
            'reference	'     => 'doc_archive.category',
            'value'         => '{
                "1":"Business Proposal",
                "2":"Survey",
                "3":"KM Products",
                "4":"M&E - Formats",
                "5":"BD - Formats",
                "6":"HR & Admin - Formats",
                "7":"RF - Formats",
                "8":"NoC",
                "9":"RF Formats",
                "10":"SAPP Forms",
                "11":"4P Summary",
                "12":"Cabinet Paper",
                "13":"Cabinet Decision",
                "14":"NSC Paper",
                "15":"4P Agreements",
                "16":"4P Agreement Addendum",
                "17":"Programme Documents",
                "18":"Promoter Progress",
                "19":"Aid Memoires",
                "20":"Other"
             }'
        ];

        $this->db->table('config')->where('id', '56')->update($docArchiveCat);

        $docArchiveFiter = [
            'id'            => 109,
            'reference	'     => 'Filter Report Doc Archive',
            'value'         => '[
                {
                   "label":"Project Name",
                   "field":"project-project_name",
                   "type":"select_dynamic",
                   "options":"select project.project_name AS val, project.project_name AS label FROM doc_archive left JOIN project ON doc_archive.project_id = project.id group by project.project_name order by project_name ASC"
                },
                {
                   "label":"Doc Type",
                   "field":"doc_archive-category",
                   "type":"select",
                   "options": {"1":"Business Proposal", "2":"Survey", "3":"KM Products", "4":"M&E - Formats", "5":"BD - Formats",
                        "6":"HR & Admin - Formats", "7":"RF - Formats", "8":"NoC", "9":"RF Formats", "10":"SAPP Forms",
                        "11":"4P Summary", "12":"Cabinet Paper", "13":"Cabinet Decision", "14":"NSC Paper", "15":"4P Agreements",
                        "16":"4P Agreement Addendum", "17":"Programme Documents", "18":"Promoter Progress", "19":"Aid Memoires", "20":"Other"
                    }
             
                },
                {
                   "label":"Start date",
                   "field":"sdate-doc_archive-created_at",
                   "type":"date"
                },
                {
                   "label":"End date",
                   "field":"edate-doc_archive-created_at",
                   "type":"date"
                }
             ]'
        ];

        $this->db->table('config')->where('id', '109')->update($docArchiveFiter);

        $fixedAssets = [
            'id'            => 30,
            'reference	'     => 'fixed_asset_registry.remarks',
            'value'         => '{
                "1": "Laptop",
                "2": "Chair",
                "3": "Desktop Computer",
                "4": "Cupboard",
                "5": "Projector",
                "6": "Monitors",
                "7": "Water filters",
                "8": "Printer",
                "9": "Fax",
                "10": "Vehicle",
                "11": "Other"
            }'
        ];

        $this->db->table('config')->where('id', '30')->update($fixedAssets);

        $fiterInventory = [
            'id'            => 90,
            'reference	'     => 'Filter Report inventory',
            'value'         => ' [{
                "label": "Division",
                "field": "staff_meta-assigned_admin_division",
                "type": "select",
                "options":{"1": "HR & Admin",
                    "2": "BD Division",
                    "3": "M&E Division",
                    "4":"RF Division",
                    "5":"Finance",
                    "6":"Consultants",
                    "7":"Field Staffs",
                    "8":"Executive Staff"}
            }, 
           {
                "label": "Description / Model of Assets",
                "field": "fixed_asset_registry-description",
                "type": "text"
            }, 
           {
                "label": "Serial No (Manufacture)",
                "field": "fixed_asset_registry-manufactor_serial_no",
                "type": "text"
            }, 
           {
                "label": "Description / Model of Assets",
                "field": "fixed_asset_registry-remarks",
                "type": "select",
               "options":{"1": "Laptop","2": "Chair","3": "Desktop Computer","4": "Cupboard"}
            }
          
        ]'
        ];

        $this->db->table('config')->where('id', '90')->update($fiterInventory);

        $filterTraingReport = [
            'id'            => 78,
            'reference	'     => 'Filter Report Training Programmes',
            'value'         => '[{
                "label": "Project Name",
                "field": "project-project_name",
               "type":"select_dynamic",
               "options":"SELECt project.project_name as val, project.project_name as label FROM training JOIN project ON project.id =training.id_project where training.deleted_at is null group by project.project_name order by project.project_name"
            }, {
                "label": "Type of Training",
                "field": "training-type_of_training",
                "type": "select",
                "options": {
                  "1": "Technical",
                  "2": "Financial",
                  "3": "Record keeping",
                  "4": "Gender",
                  "5": "Nutrition",
                  "6": "Environment",
                  "7": "Business Proposal Development",
                  "8": "Exposure Visit",
                  "9": "Cross Cutting Training",
                  "10": "Other"
              }
            }, {
                "label": "Status",
                "field": "training-training_status",
                "type": "select",
                "options": {
                    "1": "Planned",
                    "2": "Completed",
                    "3": "Cancelled"
                }
            },
            {
                "label":"Start date",
                "field":"sdate-training-start_date",
                "type":"date"
             },
             {
                "label":"End date",
                "field":"edate-training-start_date",
                "type":"date"
                }
          ]'
        ];

        $this->db->table('config')->where('id', '78')->update($filterTraingReport);


        $typeOfTraining = [
            'id'            => 21,
            'reference	'     => 'type_of_training',
            'value'         => '{
                "1": "Technical",
                "2": "Financial",
                "3": "Record keeping",
                "4": "Gender",
                "5": "Nutrition",
                "6": "Environment",
                "7": "Business Proposal Development",
                "8": "Exposure Visit",
                "9": "Cross Cutting Training",
                "10": "Other"
            }'
        ];

        $this->db->table('config')->where('id', '21')->update($typeOfTraining);


        $filterTraingProjectReport = [
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
                    "1": "Technical",
                    "2": "Financial",
                    "3": "Record keeping",
                    "4": "Gender",
                    "5": "Nutrition",
                    "6": "Environment",
                    "7": "Business Proposal Development",
                    "8": "Exposure Visit",
                    "9": "Cross Cutting Training",
                    "10": "Other"
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

        $this->db->table('config')->where('id', '113')->update($filterTraingProjectReport);

        $filterReportCount = [
            'id'            => 114,
            'reference	'     => 'Filter Report Training Count Type',
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
                    "1": "Technical",
                    "2": "Financial",
                    "3": "Record keeping",
                    "4": "Gender",
                    "5": "Nutrition",
                    "6": "Environment",
                    "7": "Business Proposal Development",
                    "8": "Exposure Visit",
                    "9": "Cross Cutting Training",
                    "10": "Other"
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

        $this->db->table('config')->where('id', '114')->update($filterReportCount);

        $filterLoanproject = [
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
                    "label":"Type of Loan",
                    "field":"loan-type_of_loan_scheme",
                    "type":"select",
                    "options":{
                        "1": "4P",
                        "2": "Youth",
                        "3": "IG"
                    }
                },
                {
                    "label":"Loan Disbursement Status",
                    "field":"loan_disbursement-disbursement_status",
                    "type":"select",
                    "options":{
                       "1":"Registered",
                       "2":"Pending Bank Response",
                       "3":"Loan Disbursed",
                       "4":"Loan Refinanced"
                    }
                },
                {
                    "label":"Disbursement Date",
                    "field":"loan_disbursement-loan_disbursement_date",
                    "type":"date"
                }
             ]'
        ];

        $this->db->table('config')->where('id', '115')->update($filterLoanproject);

        $filterReportLoanDis = [
            'id'            => 79,
            'reference	'     => 'Filter Report Loan Disbursement',
            'value'         => '[
                {
                   "label":"Project Name",
                   "field":"project-project_name",
                   "type":"select_dynamic",
                   "options":"select project.project_name as val, project.project_name as label FROM loan JOIN project ON project.id = loan.project_id where loan.deleted_at is null group by project.project_name order by project.project_name"
                },
                {
                   "label":"Gender",
                   "field":"user-gender",
                   "type":"select",
                   "options":{
                      "1":"Male",
                      "2":"Female"
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
                   "options":"SELECT dsd.dsd AS val, dsd.dsd AS label FROM gnd JOIN farmer ON gnd.id =farmer.gnd_id JOIN dsd on dsd.id = gnd.dsd_id where farmer.deleted_at IS NULL group by dsd.dsd order by dsd.dsd"
                },
                {
                   "label":"ASC",
                   "field":"aggrarian_division-name",
                   "type":"select_dynamic",
                   "options":"select aggrarian_division.name as val, aggrarian_division.name as label FROM farmer JOIN aggrarian_division ON aggrarian_division.id = farmer.aggrarian_division_id where farmer.deleted_at IS null group by aggrarian_division.name order by aggrarian_division.name"
                },
                {
                   "label":"District",
                   "field":"district-district",
                   "type":"select_dynamic",
                   "options":"SELECT district.district AS val, district.district AS label FROM gnd JOIN farmer ON gnd.id =farmer.gnd_id JOIN dsd on dsd.id = gnd.dsd_id JOIN district oN district.id = dsd.district_id where farmer.deleted_at IS NULL group by district.district order by district.district"
                },
                {
                   "label":"Barrower Type",
                   "field":"farmer-barrower_type",
                   "type":"select",
                   "options":{
                      "1":"Main",
                      "2":"Sub"
                   }
                },
                {
                   "label":"Project Type",
                   "field":"project-project_type",
                   "type":"select",
                   "options":{
                      "1":"4P-New 4P",
                      "2":"4P-Scale Up",
                      "3":"4P-FO",
                      "4":"4P-Covid",
                      "5":"IG",
                      "6":"Youth"
                   }
                },
                {
                   "label":"Loan Scheme",
                   "field":"loan-loan_scheme_name",
                   "type":"select_dynamic",
                   "options":"SELECT loan.loan_scheme_name AS val, loan.loan_scheme_name AS label FROM loan WHERE loan.deleted_at IS NULL ORDER by loan.loan_scheme_name;"
                },
                {
                    "label":"Loan Disbursement Status",
                    "field":"loan_disbursement-disbursement_status",
                    "type":"select",
                    "options":{
                       "1":"Registered",
                       "2":"Pending Bank Response",
                       "3":"Loan Disbursed",
                       "4":"Loan Refinanced"
                    }
                },
                {
                   "label":"Disbursement From",
                   "field":"sdate-loan_disbursement-loan_disbursement_date",
                   "type":"date"
                   },
                {
                   "label":"Disbursement To",
                   "field":"edate-loan_disbursement-loan_disbursement_date",
                   "type":"date"
                   }
             ]'
        ];

        $this->db->table('config')->where('id', '79')->update($filterReportLoanDis);

        $filterRwpoerLoanType = [
            'id'            => 101,
            'reference	'     => 'Filter Report Loan Type',
            'value'         => '[
                {
                   "label":"Project Name",
                   "field":"project-project_name",
                   "type":"select_dynamic",
                   "options":"select project.project_name AS val, project.project_name AS label FROM loan JOIN project ON project.id = loan.project_id JOIN loan_disbursement ON loan_disbursement.loan_id = loan.id WHERE project.deleted_at is null group by project.project_name ORDER by project.project_name"
                },
                {
                    "label":"Type of Loan",
                    "field":"loan-type_of_loan_scheme",
                    "type":"select",
                    "options":{"1": "4P","2": "Youth", "3":"IG"}
                 },
 
                 {
                     "label":"Loan Disbursement Status",
                     "field":"ld-disbursement_status",
                     "type":"select",
                     "options":{
                        "1":"Registered",
                        "2":"Pending Bank Response",
                        "3":"Loan Disbursed",
                        "4":"Loan Refinanced"
                     }
                 },
               {
                  "label":"Disbursement From",
                  "field":"sdate-ld-loan_disbursement_date",
                  "type":"date"
               },
               {
                  "label":"Disbursement To",
                  "field":"edate-ld-loan_disbursement_date",
                  "type":"date"
               }
             ]'
        ];

        $this->db->table('config')->where('id', '101')->update($filterRwpoerLoanType);

        $reportProjectWiseGrant = [
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
                },
                {
                    "label":"Disbursement Status",
                    "field":"grant_item-disbursement_status",
                    "type":"select",
                    "options":{
                       "1":"Scheduling in Progress",
                       "2":"Scheduled",
                       "3":"Disbursed",
                       "4":"Hold"
                    }
                }
            ]'
        ];

        $this->db->table('config')->where('id', '106')->update($reportProjectWiseGrant);

        $filterReportGrantDisProject = [
            'id'            => 112,
            'reference	'     => 'Filter Report Grant Dis - Project',
            'value'         => '[
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
                   "options":"SELECT project_target_item.item_description AS val, project_target_item.item_description AS label  FROM grant_item_farmer  JOIN sapp_core.project_target_item  ON grant_item_farmer.project_target_item_id = project_target_item.id WHERE project_target_item.deleted_at IS NULL group by project_target_item.item_description order by project_target_item.item_description;"
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
                }
             ]'
        ];

        $this->db->table('config')->where('id', '112')->update($filterReportGrantDisProject);
    }
}

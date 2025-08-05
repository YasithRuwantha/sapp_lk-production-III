<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEoiApplication extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'eoi_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key eoi table',
            ], 
            'eoi_applicant_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key eoi_applicant table',
            ],             
            'bp_application_acknowladgement_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'bp_reg_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'shortlist_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'shortlist_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'shortlist_marks'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ], 
            'initial_discussion_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            '1st_imc_meeting_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            '1st_imc_remarks'          => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'feasibility_study_visit_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'feasibility_study_completion_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'feasibility_study_completion_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            '2nd_imc_meeting_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            '2nd_imc_remarks'          => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'bp_submission_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            '3rd_imc_meeting_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            '3rd_imc_remarks'          => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'bpec_meeting_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'bpec_remarks'          => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'eoi_application_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Completed", "2":"In progress"}',
            ],
            'remarks'          => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'final_bp_submission_mc_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'bpec_approval_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'nsc_approval_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'ifad_approval_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'agreement_signed_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'implementation_start_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'created_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'deleted_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (eoi_id) REFERENCES eoi(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (eoi_applicant_id) REFERENCES eoi_applicant(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('eoi_application');
    }

    public function down()
    {
        $this->forge->dropTable('eoi_application');
    }
}
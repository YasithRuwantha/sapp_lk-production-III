<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFarmerProject extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'farmer_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'project_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'contribution'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'comment' => '',
            ],
            'purpose'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'comment' => '',
            ],
            'vcm_recomendation'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Approved", "2":"Rejected", "3":"Pending"}',
            ],
            'vcm_recomendation_remark'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'rpc_recomendation'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Approved", "2":"Rejected", "3":"Pending"}',
            ],
            'rpc_recomendation_remark'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'liason_recomendation'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Approved", "2":"Rejected", "3":"Pending"}',
            ],
            'liason_recomendation_remark'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'vcm_approval_date_time'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'rpc_approval_date_time'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'liason_approval_date_time'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'project_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Refer config table row 19',
            ],
            'eligible_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Recomended Farmer", "2":"Non Recommended Farmer"}',
            ],
            'pfi_ref_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'comment' => '',
            ],
            'obtained_benifit'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Loan", "2":"Grant"}',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (farmer_id) REFERENCES user(ID)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (project_id) REFERENCES project(ID)');

        $this->forge->createTable('farmer_project');
    }

    public function down()
    {
        $this->forge->dropTable('farmer_project');
    }
}
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMatchingGrantDevelopment extends Migration
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
            'matching_grant_dev_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'project_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key project table',
            ],
            'no_direct_benificiary'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'no_indirect_benificiary'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'estimated_cost'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'implementation_ajency'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'nsc_paper_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key nsc_paper table',
            ],
            'status_nsc_approval'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Approved", "2":"Not approved"}',
            ],
            'remarks'          => [
                'type'           => 'TEXT',
                'null'           => true,
                'comment' => '',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (project_id) REFERENCES project(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (nsc_paper_id) REFERENCES nsc_paper(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('matching_grant_development');
    }

    public function down()
    {
        $this->forge->dropTable('matching_grant_development');
    }
}
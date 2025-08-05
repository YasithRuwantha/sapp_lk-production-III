<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProcurement extends Migration
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
            'procurement_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'title'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'type'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config record 27',
            ],
            'project_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key project table',
            ],
            'budget'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'procurement_agency'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'advertize_date'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'opening_date'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'doc_considered'          => [
                'type'           => 'TEXT',
                'null'           => true,
                'comment' => '',
            ],
            'tec_consent'          => [
                'type'           => 'TEXT',
                'null'           => true,
                'comment' => '',
            ],
            'procurement_consent'          => [
                'type'           => 'TEXT',
                'null'           => true,
                'comment' => '',
            ],
            'no_objection'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config record 28',
            ],
            'objection_remarks'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
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

        $this->forge->addKey('id', true);
        $this->forge->createTable('procurement');
    }

    public function down()
    {
        $this->forge->dropTable('procurement');
    }
}
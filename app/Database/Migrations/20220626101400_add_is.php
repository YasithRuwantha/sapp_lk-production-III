<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIs extends Migration
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
            'is_service_provider_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key is_service_provider table',
            ],
            'project_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key project table',
            ],
            'promoter_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key promoter table',
            ],
            'contract_start_date'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'contract_end_date'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'benificiary_male'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'benificiary_female'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'benificiary_gender_not_specified'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'contract_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config 50',
            ],
            'remark'          => [
                'type'           => 'TEXT',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (is_service_provider_id) REFERENCES is_service_provider(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (project_id) REFERENCES project(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (promoter_id) REFERENCES promoter(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('is');
    }

    public function down()
    {
        $this->forge->dropTable('is');
    }
}
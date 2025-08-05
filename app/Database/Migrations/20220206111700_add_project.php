<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProject extends Migration
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
            'project_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'comment' => 'Eg. Free Range Eggs Value Chain Project',
            ],
            'project_type'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Refer config table row 18',
            ],
            'address_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
                'null'           => true,
            ],
            'address_street'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'address_city'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'lat'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '11,8',
                'null'           => true,
            ],
            'lon'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '11,8',
                'null'           => true,
            ],
            'project_incharge_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer user table primary key',
            ],
            'est_loan_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'total_loan_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'project_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Refer config table row 19',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (project_incharge_id) REFERENCES user(ID)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('project');
    }

    public function down()
    {
        $this->forge->dropTable('project');
    }
}
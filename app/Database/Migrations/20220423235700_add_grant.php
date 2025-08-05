<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGrant extends Migration
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
            'project_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer project table primary key',
            ],
            'grant_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'grant_details'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'value'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
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
        $this->forge->createTable('grant');
    }

    public function down()
    {
        $this->forge->dropTable('grant');
    }
}
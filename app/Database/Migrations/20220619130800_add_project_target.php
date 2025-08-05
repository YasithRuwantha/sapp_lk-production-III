<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProjectTarget extends Migration
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
            'category_name'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
            ],
            'type'              => [
                'type'          => 'INT',
                'constraint'    => 2,
                'unsigned'      => true,
                'comment'       => 'Config 46',
            ],
            'qty'               => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
            'target_amount'     => [
                'type'          => 'DECIMAL',
                'constraint'    => '25,2',
                'default'       => 0.00,
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
        $this->forge->createTable('project_target');
    }

    public function down()
    {
        $this->forge->dropTable('project_target');
    }
}
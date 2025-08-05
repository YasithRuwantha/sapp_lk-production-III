<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProjectTargetItem extends Migration
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
            'project_target_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer project_target table primary key',
            ],
            'item_description'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
            ],
            'qty'               => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
            'amount'     => [
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (project_target_id) REFERENCES project_target(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('project_target_item');
    }

    public function down()
    {
        $this->forge->dropTable('project_target_item');
    }
}
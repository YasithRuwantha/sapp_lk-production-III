<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAction extends Migration
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
            'module_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer module table primary key',
            ],
            'action_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (module_id) REFERENCES module(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('module_action');
    }

    public function down()
    {
        $this->forge->dropTable('module_action');
    }
}
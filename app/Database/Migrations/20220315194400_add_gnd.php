<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGnd extends Migration
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
            'dsd_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'gnd'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (dsd_id) REFERENCES dsd(id)');
        $this->forge->addKey('id', true);
        $this->forge->createTable('gnd');
    }

    public function down()
    {
        $this->forge->dropTable('gnd');
    }
}
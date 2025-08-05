<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDsd extends Migration
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
            'district_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'dsd'          => [
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (district_id) REFERENCES district(id)');
        $this->forge->addKey('id', true);
        $this->forge->createTable('dsd');
    }

    public function down()
    {
        $this->forge->dropTable('dsd');
    }
}
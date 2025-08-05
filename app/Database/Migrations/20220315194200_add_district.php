<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDistrict extends Migration
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
            'province_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'district'          => [
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (province_id) REFERENCES province(id)');
        $this->forge->addKey('id', true);
        $this->forge->createTable('district');
    }

    public function down()
    {
        $this->forge->dropTable('district');
    }
}
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAggrarianDivision extends Migration
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
            'name'        => [
                'type'           => 'varchar',
                'constraint'     => 256,
                'null'           => true,
            ],
            'lat'        => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,6',
                'default' => 0.00,
            ],
            'lon'        => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,6',
                'default' => 0.00,
            ],
            'created_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'deleted_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('aggrarian_division');
    }

    public function down()
    {
        $this->forge->dropTable('aggrarian_division');
    }
}
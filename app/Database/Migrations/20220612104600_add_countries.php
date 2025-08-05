<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCountries extends Migration
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
            'phone_code'          => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'country_code'          => [
                'type'           => 'CHAR',
                'constraint'     => 2,
            ],
            'country_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 80,
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

        $this->forge->addKey('id', true);
        $this->forge->createTable('countries');
    }

    public function down()
    {
        $this->forge->dropTable('countries');
    }
}
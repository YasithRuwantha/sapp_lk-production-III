<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsServiceProvider extends Migration
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
            'name_service_provider'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
            ],
            'address'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
            ],
            'name_in_charge'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
            ],
            'phone_in_charge'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
            ],
            'email_in_charge'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
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
        $this->forge->createTable('is_service_provider');
    }

    public function down()
    {
        $this->forge->dropTable('is_service_provider');
    }
}
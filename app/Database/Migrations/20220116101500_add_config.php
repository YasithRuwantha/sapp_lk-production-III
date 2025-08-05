<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddConfig extends Migration
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
            'reference'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
            ],
            'value'          => [
                'type'           => 'TEXT',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('config');
    }

    public function down()
    {
        $this->forge->dropTable('config');
    }
}
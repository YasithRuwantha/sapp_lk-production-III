<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddQueryTemplate extends Migration
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
            'query_reference'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
            ],
            'query_string'          => [
                'type'           => 'TEXT',
                'null'           => true,
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
        $this->forge->createTable('query_template');
    }

    public function down()
    {
        $this->forge->dropTable('query_template');
    }
}
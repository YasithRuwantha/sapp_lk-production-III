<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFileRegistry extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'added_on'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
            ],
            'ref_table'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
            ],
            'file_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
            ],
            'relative_path'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
            ],
            'status'          => [
                'type'           => 'INT',
                'constraint'     => 1,
                'default' => 1,
                'comment' => '1-active,0-deleted',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('file_registry');
    }

    public function down()
    {
        $this->forge->dropTable('file_registry');
    }
}
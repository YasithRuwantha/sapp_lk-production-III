<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEntityLock extends Migration
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
            'table_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
            ],
            'primary_key'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'csrf_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
            ],
            'locked_at'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'locked_by'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (locked_by) REFERENCES user(ID)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('entity_lock');
    }

    public function down()
    {
        $this->forge->dropTable('entity_lock');
    }
}
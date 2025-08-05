<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsActivities extends Migration
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
            'is_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key is table',
            ],
            'activity'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
            ],
            'deadline'          => [
                'type'           => 'DATE',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (is_id) REFERENCES `is`(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('is_activities');
    }

    public function down()
    {
        $this->forge->dropTable('is_activities');
    }
}
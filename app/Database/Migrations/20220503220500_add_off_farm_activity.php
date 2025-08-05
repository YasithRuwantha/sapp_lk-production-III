<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOffFarmActivity extends Migration
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
            'off_farm_development_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key off_farm_development table',
            ],
            'activity'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'expense'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'remarks'          => [
                'type'           => 'TEXT',
                'null'           => true,
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (off_farm_development_id) REFERENCES off_farm_development(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('off_farm_activity');
    }

    public function down()
    {
        $this->forge->dropTable('off_farm_activity');
    }
}
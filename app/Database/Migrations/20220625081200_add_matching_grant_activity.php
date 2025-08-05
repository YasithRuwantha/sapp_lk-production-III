<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMatchingGrantActivity extends Migration
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
            'matching_grant_development_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key matching_grant_development table',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (matching_grant_development_id) REFERENCES matching_grant_development(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('matching_grant_activity');
    }

    public function down()
    {
        $this->forge->dropTable('matching_grant_activity');
    }
}
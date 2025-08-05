<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkMatchingGrantDevelopmentFile extends Migration
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
                'comment' => 'Refer matching_grant_development table primary key',
            ],
            'file_id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'comment' => 'Refer file_registry table primary key',
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
        $this->forge->addField('CONSTRAINT FOREIGN KEY (file_id) REFERENCES file_registry(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_matching_grant_development_file');
    }

    public function down()
    {
        $this->forge->dropTable('link_matching_grant_development_file');
    }
}